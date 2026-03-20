<?php

use App\Http\Controllers\Admin\ApplicationController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\JobController;
use App\Http\Controllers\Admin\PortfolioController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

// Admin auth routes (public)
Route::prefix('admin')->group(function () {
    Route::get('/login', [AuthController::class, 'loginForm'])->name('admin.login');
    Route::post('/login', [AuthController::class, 'login'])->name('admin.login.store');
});

// Admin protected routes
Route::prefix('admin')->middleware(['admin', 'log-activity'])->group(function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('admin.logout');
    
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    
    // Users
    Route::get('/users', [UserController::class, 'index'])->name('admin.users.index');
    Route::get('/users/{user}', [UserController::class, 'show'])->name('admin.users.show');
    Route::post('/users/{user}/suspend', [UserController::class, 'suspend'])->name('admin.users.suspend');
    Route::post('/users/{user}/activate', [UserController::class, 'activate'])->name('admin.users.activate');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('admin.users.destroy');
    
    // Portfolios
    Route::get('/portfolios', [PortfolioController::class, 'index'])->name('admin.portfolios.index');
    Route::get('/portfolios/{portfolio}', [PortfolioController::class, 'show'])->name('admin.portfolios.show');
    Route::post('/portfolios/{portfolio}/approve', [PortfolioController::class, 'approve'])->name('admin.portfolios.approve');
    Route::post('/portfolios/{portfolio}/reject', [PortfolioController::class, 'reject'])->name('admin.portfolios.reject');
    
    // Jobs
    Route::get('/jobs', [JobController::class, 'index'])->name('admin.jobs.index');
    Route::get('/jobs/{job}', [JobController::class, 'show'])->name('admin.jobs.show');
    Route::post('/jobs/{job}/feature', [JobController::class, 'feature'])->name('admin.jobs.feature');
    Route::post('/jobs/{job}/status', [JobController::class, 'updateStatus'])->name('admin.jobs.updateStatus');
    
    // Applications
    Route::get('/applications', [ApplicationController::class, 'index'])->name('admin.applications.index');
    Route::get('/applications/export', [ApplicationController::class, 'export'])->name('admin.applications.export');
    Route::get('/applications/{application}', [ApplicationController::class, 'show'])->name('admin.applications.show');
    Route::post('/applications/{application}/status', [ApplicationController::class, 'updateStatus'])->name('admin.applications.updateStatus');
});
