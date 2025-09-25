<?php

declare(strict_types=1);

namespace App\ReferenceBook\Infrastructure\Repositories;

use App\Models\Activities;
use Illuminate\Support\Collection;

interface EloquentActivityRepository
{
    public function getAll(): ?Collection;

    public function findByName(string $name): ?Activities;
    public function findByNameWithChild(string $name): ?Collection;
}