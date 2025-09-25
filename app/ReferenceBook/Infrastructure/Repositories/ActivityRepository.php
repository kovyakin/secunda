<?php

declare(strict_types=1);

namespace App\ReferenceBook\Infrastructure\Repositories;

use App\Models\Activities;
use Illuminate\Support\Collection;

class ActivityRepository implements EloquentActivityRepository
{

    public function getAll(): ?Collection
    {
        return Activities::all();
    }

    public function findByName(string $name): ?Activities
    {
        return Activities::query()->where('name', $name)->first();
    }

    public function findByNameWithChild(string $name): ?Collection
    {
        $parent = $this->findByName($name);

        return $this->getAllChildren($parent->id);
    }

    private function getAllChildren(int $parentId, ?Collection $result = null): Collection
    {
        if ($result === null) {
            $result = collect();
            $result->push($this->getById($parentId));
        }

        $children = Activities::query()->where('parent_id', $parentId)->get();

        foreach ($children as $child) {
            $result->push($child);
            $this->getAllChildren($child->id, $result);
        }

        return $result;
    }

    private function getById(int $id): ?Activities
    {
        return Activities::query()->find($id);
    }

}