<?php

declare(strict_types=1);

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ApartmentController;
use App\Http\Controllers\Api\CondominiumController;
use App\Models\Condominium;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::post('/login', [AuthController::class, 'login']);

/*
|--------------------------------------------------------------------------
| Protected Routes (Sanctum)
|--------------------------------------------------------------------------
| Aqui o usuário deve enviar o "Bearer Token" no Header da requisição.
*/

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::prefix('apartments')->group(function () {
        Route::post('/', [ApartmentController::class, 'store']);
        Route::get('/', [ApartmentController::class, 'index']);
    });

    Route::prefix('condominium')->group(function() {
        Route::post('/add', [CondominiumController::class, 'store']);
    });
});

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
