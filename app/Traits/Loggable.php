<?php

declare(strict_types=1);

namespace App\Traits;

use Illuminate\Support\Facades\Log;
use Throwable;

trait Loggable
{
    protected static function logError(Throwable $exception, array $context = []): void
    {
        $logData = [
            'timestamp' => now()->toDateTimeString(),
            'error' => $exception->getMessage(),
            'exception' => get_class($exception),
            'file' => $exception->getFile(),
            'line' => $exception->getLine(),
            'class' => static::class,
            'context' => $context,
        ];

        Log::error('System error ', $logData);
    }
}