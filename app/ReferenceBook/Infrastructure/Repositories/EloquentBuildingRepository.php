<?php

declare(strict_types=1);

namespace App\ReferenceBook\Infrastructure\Repositories;

use App\ReferenceBook\Domain\Entities\AddressBuilding;
use Illuminate\Support\Collection;

interface EloquentBuildingRepository
{
    public function getByAddress(AddressBuilding $addressBuilding): Collection;
}