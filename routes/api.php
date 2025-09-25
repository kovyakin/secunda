<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

require base_path('app/ReferenceBook/Domain/Routes/API/referenceBookApi.php');

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
