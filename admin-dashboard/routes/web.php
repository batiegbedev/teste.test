<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\DashboardController;

/*
|--------------------------------------------------------------------------
| Public and auth routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

// Tableau de bord principal
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Profil utilisateur
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| Admin routes (Option 2 : AdminController + noms RESTful)
|--------------------------------------------------------------------------
| On garde AdminController et on nomme les routes selon la convention
| admin.users.* (index, create, store, show, edit, update, destroy)
*/

Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        // Dashboard admin
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

        // Utilisateurs (ordre important: create avant {user})
        Route::get('/users', [AdminController::class, 'users'])->name('users.index');
        Route::get('/users/create', [AdminController::class, 'createUser'])->name('users.create');
        Route::post('/users', [AdminController::class, 'storeUser'])->name('users.store');
        Route::get('/users/{user}', [AdminController::class, 'showUser'])->name('users.show');
        Route::get('/users/{user}/edit', [AdminController::class, 'editUser'])->name('users.edit');
        Route::put('/users/{user}', [AdminController::class, 'updateUser'])->name('users.update');
        Route::delete('/users/{user}', [AdminController::class, 'deleteUser'])->name('users.destroy');

        // Permissions
        Route::get('/permissions', [PermissionController::class, 'index'])->name('permissions.index');
        Route::patch('/users/{user}/role', [PermissionController::class, 'changeRole'])->name('users.change-role');
        Route::patch('/users/{user}/status', [PermissionController::class, 'toggleStatus'])->name('users.toggle-status');
    });

/*
|--------------------------------------------------------------------------
| Recipes routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {
    Route::get('/recipes', [RecipeController::class, 'index'])->name('recipes.index');
    Route::get('/recipes/{recipe}', [RecipeController::class, 'show'])->name('recipes.show');
});

Route::middleware(['auth', 'editeur'])->group(function () {
    Route::get('/recipes/create', [RecipeController::class, 'create'])->name('recipes.create');
    Route::post('/recipes', [RecipeController::class, 'store'])->name('recipes.store');
    Route::get('/recipes/{recipe}/edit', [RecipeController::class, 'edit'])->name('recipes.edit');
    Route::put('/recipes/{recipe}', [RecipeController::class, 'update'])->name('recipes.update');
    Route::delete('/recipes/{recipe}', [RecipeController::class, 'destroy'])->name('recipes.destroy');
});

/*
|--------------------------------------------------------------------------
| Internal API routes (AJAX)
|--------------------------------------------------------------------------
*/

Route::prefix('api')->middleware(['auth'])->group(function () {
    Route::post('/recipes', [DashboardController::class, 'createRecipe'])->name('api.recipes.create');
    Route::delete('/recipes/{recipe}', [DashboardController::class, 'deleteRecipe'])->name('api.recipes.delete');
    Route::patch('/recipes/{recipe}/toggle-status', [DashboardController::class, 'toggleRecipeStatus'])->name('api.recipes.toggle-status');
    Route::get('/recipes/search', [DashboardController::class, 'searchRecipes'])->name('api.recipes.search');
    Route::get('/stats', [DashboardController::class, 'getStats'])->name('api.stats');
    Route::post('/notifications', [DashboardController::class, 'sendNotification'])->name('api.notifications.send');
});

require __DIR__ . '/auth.php';
