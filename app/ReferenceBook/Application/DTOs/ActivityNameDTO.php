<?php

declare(strict_types=1);

namespace App\ReferenceBook\Application\DTOs;

use Illuminate\Support\Arr;

class ActivityNameDTO implements DTO
{
    public string $name;

    /**
     * @param  string  $name
     * OrganizationNameDTO constructor
     */
    public function __construct(string $name)
    {
        $this->name = $name;
    }


    public static function fromArray(array $data): self
    {
        return new self(
            Arr::get($data, 'name'),
        );
    }
}