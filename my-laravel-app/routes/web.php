<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EditorController;
use App\Http\Controllers\SubscriberController;

// Home route
Route::get('/', [HomeController::class, 'index'])->name('home');

// Authentication routes
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);

// Role-based routes
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('admin', [AdminController::class, 'index'])->name('admin.dashboard');
});

Route::middleware(['auth', 'role:editor'])->group(function () {
    Route::get('editor', [EditorController::class, 'index'])->name('editor.dashboard');
});

Route::middleware(['auth', 'role:subscriber'])->group(function () {
    Route::get('subscriber', [SubscriberController::class, 'index'])->name('subscriber.dashboard');
});