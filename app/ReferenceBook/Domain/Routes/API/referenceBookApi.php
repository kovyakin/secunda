<?php

use App\ReferenceBook\Infrastructure\API\Controllers\OrganizationController;
use Illuminate\Support\Facades\Route;


Route::middleware(['api', 'auth:sanctum'])->group(function () {
    Route::get('/organization/name', [OrganizationController::class, 'getByName']);

    Route::get('/organization/id', [OrganizationController::class, 'getById']);

    Route::get('/organizations/building', [OrganizationController::class, 'getByBuilding']);

    Route::get('/organizations/activity', [OrganizationController::class, 'getByActivity']);

    Route::post('/organizations/activity', [OrganizationController::class, 'getByActivityWithChild']);

    Route::post('/organizations/coordinates', [OrganizationController::class, 'getByCoordinates']);

    Route::fallback(function () {
        return response()->json([
            'success' => false,
            'message' => 'API endpoint not found',
            'error' => 'The requested endpoint does not exist',
        ], 404);
    });
});

