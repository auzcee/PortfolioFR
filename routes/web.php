<?php

use Illuminate\Support\Facades\Route;

// Admin routes
require base_path('routes/admin.php');

// Test routes for debugging
require base_path('routes/test.php');

// Load API routes with /api prefix
Route::prefix('api')->group(function () {
    require base_path('routes/api.php');
});
