<?php

declare(strict_types=1);

namespace App\ReferenceBook\Application\Services;

use App\Models\Activities;
use App\Models\Buildings;
use App\ReferenceBook\Application\DTOs\AddressBuildingDTO;
use App\ReferenceBook\Application\Exceptions\ReferenceBookException;
use App\ReferenceBook\Domain\Entities\AddressBuilding;
use App\ReferenceBook\Infrastructure\Repositories\EloquentActivityRepository;
use App\ReferenceBook\Infrastructure\Repositories\EloquentBuildingRepository;
use App\ReferenceBook\Infrastructure\Repositories\EloquentOrganizationRepository;
use App\Traits\Loggable;
use Illuminate\Support\Collection;

readonly class getOrganizationService
{

    use Loggable;


    public function __construct(
        private EloquentOrganizationRepository $repositoryOrganization,
        private EloquentBuildingRepository $repositoryBuilding,
        private EloquentActivityRepository $repositoryActivity
    ) {
    }

    /**
     * @throws \App\ReferenceBook\Application\Exceptions\ReferenceBookException
     */
    public function getByName(string $name): ?\App\Models\Organization
    {
        try {
            return $this->repositoryOrganization->findByName($name);
        } catch (\Throwable $exception) {
            static::logError($exception);
            throw ReferenceBookException::errorRequest();
        }
    }

    /**
     * @throws \App\ReferenceBook\Application\Exceptions\ReferenceBookException
     */
    public function getById(int $id): ?\App\Models\Organization
    {
        try {
            return $this->repositoryOrganization->findById($id);
        } catch (\Throwable $exception) {
            static::logError($exception);
            throw ReferenceBookException::errorRequest();
        }
    }

    /**
     * @throws \App\ReferenceBook\Application\Exceptions\ReferenceBookException
     */
    public function getByBuilding($request): ?Collection
    {
        try {
            $building = $this->createAddressBuilding($request);

            $addresses = $this->repositoryBuilding->getByAddress($building);

            $organizations = collect();

            $addresses->each(function (Buildings $building) use (&$organizations) {
                $organizations->push($this->repositoryOrganization->findByBuilding($building));
            });

            return $organizations;
        } catch (\Throwable $exception) {
            static::logError($exception);
            throw ReferenceBookException::errorRequest();
        }
    }

    /**
     * @throws \App\ReferenceBook\Application\Exceptions\ReferenceBookException
     */
    public function getByActivity($request): ?Collection
    {
        try {
            $activity = $this->repositoryActivity->findByName($request->name);

            return collect([$activity->organization]);
        } catch (\Throwable $exception) {
            static::logError($exception);
            throw ReferenceBookException::errorRequest();
        }
    }

    /**
     * @throws \App\ReferenceBook\Application\Exceptions\ReferenceBookException
     */
    public function getByActivityWithChild($request): ?Collection
    {
        try {
            $activity = $this->repositoryActivity->findByNameWithChild($request->name);

            return $this->getOrganizationsByBuildings($activity);
        } catch (\Throwable $exception) {
            static::logError($exception);
            throw ReferenceBookException::errorRequest();
        }
    }

    /**
     * @throws \App\ReferenceBook\Application\Exceptions\ReferenceBookException
     */
    public function getOrganizationsByCoordinates($request): ?array
    {
        try {
            $buildings = $this->getBuildingsByCoordinates($request);

            return [
                'organizations' => $this->getOrganizationsByBuildingsCoordinates($buildings),
                'buildings' => $buildings->unique(function ($building) {
                    return implode('|', [
                        $building->country,
                        $building->city,
                        $building->street,
                        $building->house
                    ]);
                })
            ];
        } catch (\Throwable $exception) {
            static::logError($exception);
            throw ReferenceBookException::errorRequest();
        }
    }

    /**
     * @throws \App\ReferenceBook\Application\Exceptions\ReferenceBookException
     */
    public function getBuildingsByCoordinates($request): ?Collection
    {
        try {
            return Buildings::query()->whereRaw(
                'ST_Distance_Sphere(point(lng, lat), point(?, ?)) < ?',
                [$request->lng, $request->lat, $request->radius]
            )->get();
        } catch (\Throwable $exception) {
            static::logError($exception);
            throw ReferenceBookException::errorRequest();
        }
    }

    /**
     * @throws \App\ReferenceBook\Application\Exceptions\ReferenceBookException
     */
    private function createAddressBuilding(AddressBuildingDTO $dto): AddressBuilding
    {
        try {
            return new AddressBuilding(
                $dto->country,
                $dto->city,
                $dto->street,
                $dto->house
            );
        } catch (\Throwable $exception) {
            static::logError($exception);
            throw ReferenceBookException::errorRequest();
        }
    }

    /**
     * @throws \App\ReferenceBook\Application\Exceptions\ReferenceBookException
     */
    private function getOrganizationsByBuildings(?Collection $data): ?Collection
    {
        try {
            $result = collect();

            $data->each(function (Activities $activity) use (&$result) {
                if ($activity->organization->isNotEmpty()) {
                    $result->push($activity->organization);
                }
            });
            return $result;
        } catch (\Throwable $exception) {
            static::logError($exception);
            throw ReferenceBookException::errorRequest();
        }
    }

    /**
     * @throws \App\ReferenceBook\Application\Exceptions\ReferenceBookException
     */
    private function getOrganizationsByBuildingsCoordinates(?Collection $data): ?Collection
    {
        try {
            $organizations = collect();

            $data->each(function (Buildings $building) use (&$organizations) {
                if ($building->organization->isNotEmpty()) {
                    $organizations->push($building->organization);
                }
            });
            return $organizations;
        } catch (\Throwable $exception) {
            static::logError($exception);
            throw ReferenceBookException::errorRequest();
        }
    }
}