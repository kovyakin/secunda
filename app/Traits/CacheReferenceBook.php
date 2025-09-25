<?php

declare(strict_types=1);

namespace App\Traits;

use App\ReferenceBook\Application\DTOs\DTO;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

trait CacheReferenceBook
{
    protected static function cacheKey(DTO $dto, string $function): string
    {
        $user = Auth::guard('api')->user();

        return 'referenceBook'.$function.$user->id. md5(serialize($dto));

    }
}