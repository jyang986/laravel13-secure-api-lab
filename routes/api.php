<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// PUBLIC ROUTES
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// AUTHENTICATED ROUTES
Route::middleware('auth:sanctum')->group(function () {

    // User endpoint
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    // Profile endpoint
    Route::get('/profile', function (Request $request) {
        return response()->json([
            'message' => 'This is a protected route.',
            'user' => $request->user(),
        ]);
    });

    // Logout endpoint
    Route::post('/logout', [AuthController::class, 'logout']);

    // ADMIN AND STUDENT CAN ACCESS
    Route::get('/students', function () {
        return response()->json([
            'message' => 'Students list.',
        ]);
    })->middleware('role:admin,student');

    // ADMIN DASHBOARD ONLY
    Route::get('/admin/dashboard', function () {
        return response()->json([
            'message' => 'Welcome to Admin Dashboard!',
        ]);
    })->middleware('admin');

    // STUDENT DASHBOARD ONLY
    Route::get('/student/dashboard', function () {
        return response()->json([
            'message' => 'Welcome to Student Dashboard!',
        ]);
    })->middleware('role:student');

});

// EXISTING SAMPLE ROUTE
Route::get('/sample', function () {
    return response()->json([
        'message' => 'This is a sample route.',
    ]);
});

// PUBLIC HELLO ROUTE
Route::get('/hello', function () {
    return response()->json([
        'message' => 'Welcome to the Laravel 13 API',
    ]);
});
