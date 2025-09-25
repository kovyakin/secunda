<?php

declare(strict_types=1);

namespace App\ReferenceBook\Infrastructure\Repositories;

use App\Models\Buildings;
use App\ReferenceBook\Domain\Entities\AddressBuilding;
use Illuminate\Support\Collection;

class BuildingsRepository implements EloquentBuildingRepository
{

    public function getByAddress(AddressBuilding $addressBuilding): Collection
    {
        return Buildings::query()
            ->where('country', $addressBuilding->getCountry())
            ->where('city', $addressBuilding->getCity())
            ->where('street', $addressBuilding->getStreet())
            ->where('house', $addressBuilding->getHouse())
            ->get();
    }
}