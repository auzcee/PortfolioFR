<?php

// Simple test endpoint
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

Route::get('/test-db', function () {
    try {
        DB::connection()->getPdo();
        return response()->json(['status' => 'Database connected']);
    } catch (\Throwable $e) {
        return response()->json(['error' => $e->getMessage()], 500);
    }
});

Route::post('/test-register', function (\Illuminate\Http\Request $request) {
    try {
        // Test validation
        $validated = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);
        
        return response()->json(['success' => true, 'data' => $validated], 201);
    } catch (\Throwable $e) {
        return response()->json(['error' => $e->getMessage()], 422);
    }
});
