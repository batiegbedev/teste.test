<?php

namespace Database\Seeders;

use App\Models\Recipe;
use App\Models\User;
use Illuminate\Database\Seeder;

class RecipeSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Administrateur',
                'password' => bcrypt('password'),
                'role' => 'admin',
            ]
        );

        $editor = User::firstOrCreate(
            ['email' => 'editeur@example.com'],
            [
                'name' => 'Chef Éditeur',
                'password' => bcrypt('password'),
                'role' => 'editeur',
            ]
        );

        $recipes = [
            [
                'title' => 'Pasta Carbonara',
                'description' => 'Délicieuse recette de pâtes à la carbonara',
                'ingredients' => "400g de spaghetti\n200g de pancetta\n4 œufs\n100g de parmesan",
                'instructions' => "1. Cuire les pâtes\n2. Faire revenir la pancetta\n3. Mélanger avec les œufs",
                'cooking_time' => 20,
                'difficulty' => 'moyen',
                'status' => 'published',
                'servings' => 4,
                'user_id' => $editor->id,
            ],
            [
                'title' => 'Tiramisu',
                'description' => 'Dessert italien classique',
                'ingredients' => "6 œufs\n500g de mascarpone\nBiscuits à la cuillère",
                'instructions' => "1. Préparer la crème\n2. Tremper les biscuits\n3. Alterner les couches",
                'cooking_time' => 30,
                'difficulty' => 'facile',
                'status' => 'published',
                'servings' => 6,
                'user_id' => $editor->id,
            ],
        ];

        foreach ($recipes as $recipeData) {
            Recipe::firstOrCreate(
                ['title' => $recipeData['title']],
                $recipeData
            );
        }
    }
}
