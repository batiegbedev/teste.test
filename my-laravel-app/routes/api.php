<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;

// Public routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Protected routes
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', [UserController::class, 'show']);
    Route::put('/user', [UserController::class, 'update']);
    
    // Role-based routes
    Route::middleware('role:administrator')->group(function () {
        Route::resource('posts', PostController::class);
    });

    Route::middleware('role:editor')->group(function () {
        Route::put('/posts/{post}', [PostController::class, 'update']);
    });

    Route::middleware('role:subscriber')->group(function () {
        Route::get('/posts', [PostController::class, 'index']);
    });
});