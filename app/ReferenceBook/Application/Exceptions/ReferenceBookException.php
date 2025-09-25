<?php

namespace App\ReferenceBook\Application\Exceptions;

use Exception;

class ReferenceBookException extends Exception
{
    public static function errorRequest(): static
    {
        return new static('Ошибка запроса');
    }
}
