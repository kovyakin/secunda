<?php

declare(strict_types=1);

namespace App\ReferenceBook\Domain\Entities;

class Organization
{
    private int $id;
    private string $name;

    private int $building_id;

    public function __construct(int $id, string $name, int $building_id)
    {
        $this->id = $id;
        $this->name = $name;
        $this->building_id = $building_id;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'building_id' => $this->building_id,
        ];
    }
}