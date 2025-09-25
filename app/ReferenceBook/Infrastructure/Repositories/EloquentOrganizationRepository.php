<?php

declare(strict_types=1);

namespace App\ReferenceBook\Infrastructure\Repositories;

use App\Models\Activities;
use App\Models\Buildings;
use App\Models\Organization;
use Illuminate\Support\Collection;

interface EloquentOrganizationRepository
{
    public function findByName(string $name): ?Organization;

    public function findById(int $id): ?Organization;

    public function findByBuilding(Buildings $building): ?Collection;

    public function findByActivity(Activities $activities): ?Collection;

    public function findByCoordinates(float $lat, float $lng): ?Organization;

    public function create(Organization $organization): void;

    public function update(Organization $organization): void;

    public function delete(Organization $organization): void;
}