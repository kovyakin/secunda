<?php

declare(strict_types=1);

namespace App\ReferenceBook\Application\DTOs;

use Illuminate\Support\Arr;

class AddressBuildingDTO implements DTO
{
    public string $country;
    public string $city;
    public string $street;
    public string $house;

    /**
     * @param  string  $country
     * @param  string  $city
     * @param  string  $street
     * @param  string  $house
     * AddressBuildingDTO constructor
     */
    public function __construct(string $country, string $city, string $street, string $house)
    {
        $this->country = $country;
        $this->city = $city;
        $this->street = $street;
        $this->house = $house;
    }


    public static function fromArray(array $data): self
    {
        return new self(
            Arr::get($data, 'country'),
            Arr::get($data, 'city'),
            Arr::get($data, 'street'),
            Arr::get($data, 'house'),
        );
    }
}