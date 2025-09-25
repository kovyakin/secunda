<?php

namespace App\Providers;

use App\ReferenceBook\Application\Services\getOrganizationService;
use App\ReferenceBook\Infrastructure\Repositories\ActivityRepository;
use App\ReferenceBook\Infrastructure\Repositories\BuildingsRepository;
use App\ReferenceBook\Infrastructure\Repositories\EloquentActivityRepository;
use App\ReferenceBook\Infrastructure\Repositories\EloquentBuildingRepository;
use App\ReferenceBook\Infrastructure\Repositories\EloquentOrganizationRepository;
use App\ReferenceBook\Infrastructure\Repositories\OrganizationsRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(EloquentOrganizationRepository::class,OrganizationsRepository::class);
        $this->app->bind(getOrganizationService::class);
        $this->app->bind(EloquentBuildingRepository::class,BuildingsRepository::class);
        $this->app->bind(EloquentActivityRepository::class,ActivityRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
