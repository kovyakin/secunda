<?php

namespace App\ReferenceBook\Presentation\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class OrganizationCoordinatesResource extends ResourceCollection
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {

        return [
            'organizations'=>
                OrganizationCollectResource::collection($this->collection['organizations']),

            'buildings'=> $this->collection['buildings']->map(function ($building) {
                return [
                    'country'=>$building->country,
                    'city'=>$building->city,
                    'street'=>$building->street,
                    'house'=>$building->house,
                ]; //todo переделать
            })
        ];
    }
}
