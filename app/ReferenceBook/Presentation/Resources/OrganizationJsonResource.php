<?php

namespace App\ReferenceBook\Presentation\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class OrganizationJsonResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'phones' => $this->phones->map(function ($phone) {
                return $phone->phone_number;
            }),
            'building' => [
                'country' => $this->building->country,
                'city' => $this->building->city,
                'street' => $this->building->street,
                'house' => $this->building->house,
                'office' => $this->building->office,
                'latitude' => $this->building->lat,
                'longitude' => $this->building->lng,
            ],
            'activities' => $this->activities->map(function ($activity) {
                return [
                    'id' => $activity->id,
                    'name' => $activity->name,
                ];
            })


        ];
    }
}
