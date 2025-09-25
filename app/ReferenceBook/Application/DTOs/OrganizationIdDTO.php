<?php

declare(strict_types=1);

namespace App\ReferenceBook\Application\DTOs;

use Illuminate\Support\Arr;

class OrganizationIdDTO implements DTO
{
    public int $id;

    /**
     * @param  int  $id
     * OrganizationNameDTO constructor
     */
    public function __construct(int $id)
    {
        $this->id = $id;
    }


    public static function fromArray(array $data): self
    {
        return new self(
            (int)Arr::get($data, 'id'),
        );
    }
}