<?php

declare(strict_types=1);

namespace App\ReferenceBook\Domain\Entities;

class Activity
{
    private int $id;
    private string $name;
    private string $parent_id;

    /**
     * @param  string  $name
     * @param  string  $parent_id
     * Activity constructor
     */
    public function __construct(string $name, string $parent_id)
    {
        $this->name = $name;
        $this->parent_id = $parent_id;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getParentId(): string
    {
        return $this->parent_id;
    }


}