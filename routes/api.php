<?php

use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\PortfolioController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    // Auth routes (public)
    Route::post('/auth/login', [AuthController::class, 'login']);
    Route::post('/auth/register', [AuthController::class, 'register']);

    // Protected routes
    Route::middleware('auth:sanctum')->group(function () {
        // User routes
        Route::get('/users/me', function (Request $request) {
            return $request->user();
        });

        // Portfolio routes (delta sync enabled)
        Route::get('/portfolios', [PortfolioController::class, 'index']);
        Route::post('/portfolios', [PortfolioController::class, 'store']);
        Route::put('/portfolios/{portfolio}', [PortfolioController::class, 'update']);
        Route::delete('/portfolios/{portfolio}', [PortfolioController::class, 'destroy']);
        Route::post('/portfolios/{id}/restore', [PortfolioController::class, 'restore']);
    });
});
