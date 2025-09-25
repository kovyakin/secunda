<?php

declare(strict_types=1);

namespace App\ReferenceBook\Application\DTOs;

use Illuminate\Support\Arr;

class OrganizationsCoordinatesDTO implements DTO
{
    public string $lng;
    public string $lat;
    public string $radius;

    /**
     * @param  float  $lng
     * @param  float  $lat
     * @param  int  $radius
     * OrganizationsCoordinatesDTO constructor
     */
    public function __construct(string $lng, string $lat, string $radius)
    {
        $this->lng = $lng;
        $this->lat = $lat;
        $this->radius = $radius;
    }


    public static function fromArray(array $data): self
    {
        return new self(
            Arr::get($data, 'lng'),
            Arr::get($data, 'lat'),
            Arr::get($data, 'radius'),
        );
    }
}