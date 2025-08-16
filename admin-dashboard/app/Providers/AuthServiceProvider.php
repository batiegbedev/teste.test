<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
use App\Models\Recipe;
use App\Models\User as AdminUser;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // Exemple : Recipe::class => RecipePolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        // 🔐 Gate pour créer une recette
        Gate::define('create-recipes', function ($user) {
             // Autorise tous les utilisateurs authentifiés
            return !is_null($user);
        });
        

        // 🔐 Gate pour gérer les utilisateurs
        Gate::define('manage-users', function (User $user) {
            return $user->role === 'admin';
        });
    }
}
