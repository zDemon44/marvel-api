<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HeroController;
use App\Http\Controllers\MisionController;

Route::prefix('auth')->group(function () {

    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);

    Route::middleware('auth:api')->group(function () {
        Route::get('/me', [AuthController::class, 'me']);
        Route::post('/logout', [AuthController::class, 'logout']);
    });

});

Route::middleware('auth:api')->group(function () {

    Route::get('/heroes', [HeroController::class, 'index']);
    Route::get('/heroes/{id}', [HeroController::class, 'show']);

    Route::middleware('role:ADMIN')->group(function () {
        Route::post('/heroes', [HeroController::class, 'store']);
        Route::put('/heroes/{id}', [HeroController::class, 'update']);
        Route::delete('/heroes/{id}', [HeroController::class, 'destroy']);
    });
    
    Route::get('/misiones', [MisionController::class, 'index']);
    Route::get('/misiones/{id}', [MisionController::class, 'show']);

    Route::middleware('role:ADMIN')->group(function () {
        Route::post('/misiones', [MisionController::class, 'store']);
        Route::put('/misiones/{id}', [MisionController::class, 'update']);
        Route::delete('/misiones/{id}', [MisionController::class, 'destroy']);
    });
});

