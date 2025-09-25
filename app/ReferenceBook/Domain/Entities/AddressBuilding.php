<?php

declare(strict_types=1);

namespace App\ReferenceBook\Domain\Entities;

class AddressBuilding
{
    private string $country;
    private string $city;
    private string $street;
    private string $house;

    /**
     * @param  string  $country
     * @param  string  $city
     * @param  string  $street
     * @param  string  $house
     * AddressBuilding constructor
     */
    public function __construct(string $country, string $city, string $street, string $house)
    {
        $this->country = $country;
        $this->city = $city;
        $this->street = $street;
        $this->house = $house;
    }

    public function getCountry(): string
    {
        return $this->country;
    }

    public function getCity(): string
    {
        return $this->city;
    }

    public function getStreet(): string
    {
        return $this->street;
    }

    public function getHouse(): string
    {
        return $this->house;
    }


    public function toArray(): array
    {
        return [
            'country' => $this->country,
            'city' => $this->city,
            'street' => $this->street,
            'house' => $this->house,
        ];
    }

}