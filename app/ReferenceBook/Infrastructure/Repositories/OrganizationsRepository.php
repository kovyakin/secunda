<?php

declare(strict_types=1);

namespace App\ReferenceBook\Infrastructure\Repositories;

use App\Models\Activities;
use App\Models\Buildings;
use App\Models\Organization;
use Illuminate\Support\Collection;

class OrganizationsRepository implements EloquentOrganizationRepository
{

    public function findByName(string $name): ?Organization
    {
       return Organization::query()->where('name', $name)->first();
    }

    public function findById(int $id): ?Organization
    {
        return Organization::query()->where('id', $id)->first();
    }

    public function findByBuilding(Buildings $building): ?Collection
    {
        return Organization::query()->where('building_id', $building->id)->get();
    }

    public function findByActivity(Activities $activities): ?\Illuminate\Support\Collection
    {
//       return Organization::query()->activities;
    }

    public function findByCoordinates(float $lat, float $lng): ?Organization
    {
        // TODO: Implement findByCoordinates() method.
    }

    public function create(Organization $organization): void
    {
        // TODO: Implement create() method.
    }

    public function update(Organization $organization): void
    {
        // TODO: Implement update() method.
    }

    public function delete(Organization $organization): void
    {
        // TODO: Implement delete() method.
    }
}