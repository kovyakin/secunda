<?php

namespace App\ReferenceBook\Infrastructure\API\Controllers;

use App\Http\Controllers\Controller;
use App\ReferenceBook\Application\Services\getOrganizationService;
use App\ReferenceBook\Infrastructure\Requests\ActivityNameRequest;
use App\ReferenceBook\Infrastructure\Requests\AddressBuildingRequest;
use App\ReferenceBook\Infrastructure\Requests\OrganizationIdRequest;
use App\ReferenceBook\Infrastructure\Requests\OrganizationNameRequest;
use App\ReferenceBook\Infrastructure\Requests\OrganizationsCoordinatesRequest;
use App\ReferenceBook\Presentation\Resources\OrganizationCollectResource;
use App\ReferenceBook\Presentation\Resources\OrganizationCoordinatesResource;
use App\ReferenceBook\Presentation\Resources\OrganizationJsonResource;
use App\Traits\CacheReferenceBook;
use Illuminate\Support\Facades\Cache;


class OrganizationController extends Controller
{
    use CacheReferenceBook;

    public function __construct(
        private readonly getOrganizationService $organization
    ) {
    }

     /**
     * @OA\Get(
     *     path="/organization/id",
     *     summary="Вывод информации об организации по её идентификатору",
     *     tags={"Вывод информации об организации по её идентификатору"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="query",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Success",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="data",
     *                 type="object",
     *                 example={
     *                     "id": 6,
     *                     "name": "ОАО ТекстильТяжХозСнаб",
     *                     "phones": {
     *                         "(35222) 03-5053",
     *                         "(35222) 13-8860",
     *                         "(812) 534-80-43",
     *                         "8-800-319-9298"
     *                     },
     *                     "building": {
     *                         "country": "Западная Сахара",
     *                         "city": "Ступино",
     *                         "street": "Русаков Street",
     *                         "house": "94",
     *                         "office": "94",
     *                         "latitude": "79.82550300",
     *                         "longitude": "137.93060800"
     *                     },
     *                     "activities": {
     *                         {"id": 2, "name": "et voluptatum"},
     *                         {"id": 4, "name": "nisi culpa"}
     *                     }
     *                 }
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthenticated/Unauthorized",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Unauthorized.")
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Unprocessable Content",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="message",
     *                 type="object",
     *                 example={
     *                     "success": false,
     *                     "message": "Validation failed",
     *                     "errors": {
     *                         "name": {
     *                             "Поле id должно быть целым числом."
     *                         }
     *                     }
     *                 }
     *             )
     *         )
     *     )
     * )
     * @throws \App\ReferenceBook\Application\Exceptions\ReferenceBookException
     */
    public function getById(OrganizationIdRequest $request): OrganizationJsonResource
    {
        $dto = $request->getDTO();

        $cacheKey = static::cacheKey($dto, __FUNCTION__);

        return Cache::remember($cacheKey, 3600, function () use ($dto) {
            $organization = $this->organization->getById($dto->id);
            return OrganizationJsonResource::make($organization);
        });
    }

    /**
     * @OA\Get(
     *     path="/organization/name",
     *     summary="Поиск организации по названию",
     *     tags={"Поиск организации по названию"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="name",
     *         in="query",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Success",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="data",
     *                 type="object",
     *                 example={
     *                     "id": 6,
     *                     "name": "ОАО ТекстильТяжХозСнаб",
     *                     "phones": {
     *                         "(35222) 03-5053",
     *                         "(35222) 13-8860",
     *                         "(812) 534-80-43",
     *                         "8-800-319-9298"
     *                     },
     *                     "building": {
     *                         "country": "Западная Сахара",
     *                         "city": "Ступино",
     *                         "street": "Русаков Street",
     *                         "house": "94",
     *                         "office": "94",
     *                         "latitude": "79.82550300",
     *                         "longitude": "137.93060800"
     *                     },
     *                     "activities": {
     *                         {"id": 2, "name": "et voluptatum"},
     *                         {"id": 4, "name": "nisi culpa"}
     *                     }
     *                 }
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthenticated/Unauthorized",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Unauthorized.")
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Unprocessable Content",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="message",
     *                 type="object",
     *                 example={
     *                     "success": false,
     *                     "message": "Validation failed",
     *                     "errors": {
     *                         "name": {
     *                             "Поле name должно содержать минимум 3 символа."
     *                         }
     *                     }
     *                 }
     *             )
     *         )
     *     )
     * )
     * @throws \App\ReferenceBook\Application\Exceptions\ReferenceBookException
     */
    public function getByName(OrganizationNameRequest $request): OrganizationJsonResource
    {
        $dto = $request->getDTO();

        $cacheKey = static::cacheKey($dto, __FUNCTION__);

        return Cache::remember($cacheKey, 3600, function () use ($dto) {
            $organization = $this->organization->getByName($dto->name);
            return OrganizationJsonResource::make($organization);
        });
    }

    /**
     * @OA\Get(
     *     path="/organizations/building",
     *     summary="Cписок всех организаций находящихся в конкретном здании",
     *     tags={"Cписок всех организаций находящихся в конкретном здании"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="country",
     *         in="query",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *          @OA\Parameter(
     *          name="city",
     *          in="query",
     *          required=true,
     *          @OA\Schema(type="string")
     *      ),
     *          @OA\Parameter(
     *           name="street",
     *           in="query",
     *           required=true,
     *           @OA\Schema(type="string")
     *       ),
     *           @OA\Parameter(
     *            name="house",
     *            in="query",
     *            required=true,
     *            @OA\Schema(type="string")
     *        ),
     *     @OA\Response(
     *         response=200,
     *         description="Success",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="data",
     *                 type="object",
     *                 example={
     *                     "id": 6,
     *                     "name": "ОАО ТекстильТяжХозСнаб",
     *                     "phones": {
     *                         "(35222) 03-5053",
     *                         "(35222) 13-8860",
     *                         "(812) 534-80-43",
     *                         "8-800-319-9298"
     *                     },
     *                     "building": {
     *                         "country": "Западная Сахара",
     *                         "city": "Ступино",
     *                         "street": "Русаков Street",
     *                         "house": "94",
     *                         "office": "94",
     *                         "latitude": "79.82550300",
     *                         "longitude": "137.93060800"
     *                     },
     *                     "activities": {
     *                         {"id": 2, "name": "et voluptatum"},
     *                         {"id": 4, "name": "nisi culpa"}
     *                     }
     *                 }
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthenticated/Unauthorized",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Unauthorized.")
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Unprocessable Content",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="message",
     *                 type="object",
     *                 example={
     *                     "success": false,
     *                     "message": "Validation failed",
     *                     "errors": {
     *                         "country": {
     *                             "Поле страна обязательно для заполнения."
     *                         }
     *                     }
     *                 }
     *             )
     *         )
     *     ),
     *          @OA\Response(
     *          response=404,
     *          description="Not Found",
     *          @OA\JsonContent(
     *              @OA\Property(
     *                  property="message",
     *                  type="object",
     *                  example={
     *                      "success": false,
     *                      "message": "API endpoint not found",
     *                      "error": "The requested endpoint does not exist"
     *                  }
     *              )
     *          )
     *      )
     * )
     * @throws \App\ReferenceBook\Application\Exceptions\ReferenceBookException
     */
    public function getByBuilding(AddressBuildingRequest $request
    ): \Illuminate\Http\Resources\Json\AnonymousResourceCollection {
        $dto = $request->getDTO();

        $cacheKey = static::cacheKey($dto, __FUNCTION__);

        return Cache::remember($cacheKey, 3600, function () use ($dto) {
            $organizations = $this->organization->getByBuilding($dto);
            return OrganizationCollectResource::collection($organizations);
        });
    }

    /**
     * @OA\Get(
     *     path="/organizations/activity",
     *     summary="Список всех организаций, которые относятся к указанному виду деятельности",
     *     tags={"Список всех организаций, которые относятся к указанному виду деятельности"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="name",
     *         in="query",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="Success",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="data",
     *                 type="object",
     *                 example={
     *                     "id": 6,
     *                     "name": "ОАО ТекстильТяжХозСнаб",
     *                     "phones": {
     *                         "(35222) 03-5053",
     *                         "(35222) 13-8860",
     *                         "(812) 534-80-43",
     *                         "8-800-319-9298"
     *                     },
     *                     "building": {
     *                         "country": "Западная Сахара",
     *                         "city": "Ступино",
     *                         "street": "Русаков Street",
     *                         "house": "94",
     *                         "office": "94",
     *                         "latitude": "79.82550300",
     *                         "longitude": "137.93060800"
     *                     },
     *                     "activities": {
     *                         {"id": 2, "name": "et voluptatum"},
     *                         {"id": 4, "name": "nisi culpa"}
     *                     }
     *                 }
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthenticated/Unauthorized",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Unauthorized.")
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Unprocessable Content",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="message",
     *                 type="object",
     *                 example={
     *                     "success": false,
     *                     "message": "Validation failed",
     *                     "errors": {
     *                         "name": {
     *                             "Поле name должно содержать минимум 3 символа."
     *                         }
     *                     }
     *                 }
     *             )
     *         )
     *     ),
     *          @OA\Response(
     *          response=404,
     *          description="Not Found",
     *          @OA\JsonContent(
     *              @OA\Property(
     *                  property="message",
     *                  type="object",
     *                  example={
     *                      "success": false,
     *                      "message": "API endpoint not found",
     *                      "error": "The requested endpoint does not exist"
     *                  }
     *              )
     *          )
     *      )
     * )
     * @throws \App\ReferenceBook\Application\Exceptions\ReferenceBookException
     */
    public function getByActivity(ActivityNameRequest $request
    ): \Illuminate\Http\Resources\Json\AnonymousResourceCollection {
        $dto = $request->getDTO();

        $cacheKey = static::cacheKey($dto, __FUNCTION__);

        return Cache::remember($cacheKey, 3600, function () use ($dto) {
            $organizations = $this->organization->getByActivity($dto);
            return OrganizationCollectResource::collection($organizations);
        });
    }

    /**
     * @OA\Post(
     *     path="/organizations/activity",
     *     summary="Искать организации по виду деятельности",
     *     tags={"Искать организации по виду деятельности"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="name",
     *         in="query",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="Success",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="data",
     *                 type="object",
     *                 example={
     *                     "id": 6,
     *                     "name": "ОАО ТекстильТяжХозСнаб",
     *                     "phones": {
     *                         "(35222) 03-5053",
     *                         "(35222) 13-8860",
     *                         "(812) 534-80-43",
     *                         "8-800-319-9298"
     *                     },
     *                     "building": {
     *                         "country": "Западная Сахара",
     *                         "city": "Ступино",
     *                         "street": "Русаков Street",
     *                         "house": "94",
     *                         "office": "94",
     *                         "latitude": "79.82550300",
     *                         "longitude": "137.93060800"
     *                     },
     *                     "activities": {
     *                         {"id": 2, "name": "et voluptatum"},
     *                         {"id": 4, "name": "nisi culpa"}
     *                     }
     *                 }
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthenticated/Unauthorized",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Unauthorized.")
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Unprocessable Content",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="message",
     *                 type="object",
     *                 example={
     *                     "success": false,
     *                     "message": "Validation failed",
     *                     "errors": {
     *                         "name": {
     *                             "Поле name должно содержать минимум 3 символа."
     *                         }
     *                     }
     *                 }
     *             )
     *         )
     *     ),
     *          @OA\Response(
     *          response=404,
     *          description="Not Found",
     *          @OA\JsonContent(
     *              @OA\Property(
     *                  property="message",
     *                  type="object",
     *                  example={
     *                      "success": false,
     *                      "message": "API endpoint not found",
     *                      "error": "The requested endpoint does not exist"
     *                  }
     *              )
     *          )
     *      )
     * )
     * @throws \App\ReferenceBook\Application\Exceptions\ReferenceBookException
     */
    public function getByActivityWithChild(ActivityNameRequest $request
    ): \Illuminate\Http\Resources\Json\AnonymousResourceCollection {
        $dto = $request->getDTO();

        $cacheKey = static::cacheKey($dto, __FUNCTION__);

        return Cache::remember($cacheKey, 3600, function () use ($dto) {
            $organizations = $this->organization->getByActivityWithChild($dto);
            return OrganizationCollectResource::collection($organizations);
        });
    }

    /**
     * @OA\Post(
     *     path="/organizations/coordinates",
     *     summary="Список организаций, которые находятся в заданной  области",
     *     tags={"Список организаций, которые находятся в заданной  области"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="lng",
     *         in="query",
     *         required=true,
     *         @OA\Schema(type="number")
     *     ),
     *          @OA\Parameter(
     *          name="lat",
     *          in="query",
     *          required=true,
     *          @OA\Schema(type="number")
     *      ),
     *          @OA\Parameter(
     *          name="radius",
     *          in="query",
     *          required=true,
     *          @OA\Schema(type="number")
     *      ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="Success",
     *          @OA\JsonContent(
     *      @OA\Property(
     *          property="data",
     *          type="object",
     *          example={
     *              "data": {
     *                  "organizations": {
     *                      {
     *                          {
     *                              "id": 1,
     *                              "name": "ООО ПивСантех",
     *                              "phones": {},
     *                              "building": {
     *                                  "country": "Филиппины",
     *                                  "city": "Видное",
     *                                  "street": "Иванов Street",
     *                                  "house": "33",
     *                                  "office": "87",
     *                                  "latitude": "-50.33575200",
     *                                  "longitude": "-11.65273000"
     *                              },
     *                              "activities": {
     *                                  {
     *                                      "id": 4,
     *                                      "name": "nisi culpa"
     *                                  },
     *                                  {
     *                                      "id": 1,
     *                                      "name": "quia magnam"
     *                                  },
     *                                  {
     *                                      "id": 2,
     *                                      "name": "et voluptatum"
     *                                  },
     *                                  {
     *                                      "id": 6,
     *                                      "name": "sed rerum"
     *                                  }
     *                              }
     *                          }
     *                      },
     *                      {
     *                          {
     *                              "id": 23,
     *                              "name": "ПАО МетизДизайнМяс",
     *                              "phones": {
     *                                  "(812) 781-79-91",
     *                                  "+7 (922) 459-7485",
     *                                  "+7 (922) 794-5414"
     *                              },
     *                              "building": {
     *                                  "country": "Филиппины",
     *                                  "city": "Видное",
     *                                  "street": "Иванов Street",
     *                                  "house": "33",
     *                                  "office": "89",
     *                                  "latitude": "-50.33575200",
     *                                  "longitude": "-11.65273000"
     *                              },
     *                              "activities": {
     *                                  {
     *                                      "id": 1,
     *                                      "name": "quia magnam"
     *                                  },
     *                                  {
     *                                      "id": 3,
     *                                      "name": "vel voluptas"
     *                                  },
     *                                  {
     *                                      "id": 2,
     *                                      "name": "et voluptatum"
     *                                  },
     *                                  {
     *                                      "id": 1,
     *                                      "name": "quia magnam"
     *                                  }
     *                              }
     *                          }
     *                      }
     *                  },
     *                  "buildings": {
     *                      {
     *                          "country": "Филиппины",
     *                          "city": "Видное",
     *                          "street": "Иванов Street",
     *                          "house": "33"
     *                      }
     *                  }
     *              }
     *          }
     *      )
     *  )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthenticated/Unauthorized",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Unauthorized.")
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Unprocessable Content",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="message",
     *                 type="object",
     *                 example={
     *                     "success": false,
     *                     "message": "Validation failed",
     *                     "errors": {
     *                         "lng": {
     *                             "Поле lng обязательно."
     *                         }
     *                     }
     *                 }
     *             )
     *         )
     *     ),
     * )
     * @throws \App\ReferenceBook\Application\Exceptions\ReferenceBookException
     */
    public function getByCoordinates(OrganizationsCoordinatesRequest $request): OrganizationCoordinatesResource
    {
        $dto = $request->getDTO();

        $cacheKey = static::cacheKey($dto, __FUNCTION__);

        return Cache::remember($cacheKey, 3600, function () use ($dto) {
            $request = $this->organization->getOrganizationsByCoordinates($dto);

            return OrganizationCoordinatesResource::make([
                'organizations' => $request['organizations'],
                'buildings' => $request['buildings'],
            ]);
        });

    }

}
