<?php

declare(strict_types=1);

namespace App\ReferenceBook\Application\DTOs;

interface DTO
{
    public static function fromArray(array $data): self;
}