<?php

namespace Database\Seeders;

use App\Models\Recipe;
use App\Models\User;
use Illuminate\Database\Seeder;

class RecipeSeeder extends Seeder
{
    public function run(): void
    {
        // Create admin user
        $admin = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Administrator',
                'password' => bcrypt('password'),
                'role' => 'admin',
            ]
        );

        // Create editor user
        $editor = User::firstOrCreate(
            ['email' => 'editor@example.com'],
            [
                'name' => 'Head Editor',
                'password' => bcrypt('password'),
                'role' => 'editor',
            ]
        );

        // Recipes data
        $recipes = [
            [
                'title' => 'Pasta Carbonara',
                'description' => 'Delicious pasta carbonara recipe',
                'ingredients' => "400g spaghetti\n200g pancetta\n4 eggs\n100g parmesan",
                'instructions' => "1. Cook the pasta\n2. Fry the pancetta\n3. Mix with the eggs",
                'cooking_time' => 20,
                'difficulty' => 'medium',
                'status' => 'published',
                'servings' => 4,
                'user_id' => $editor->id,
            ],
            [
                'title' => 'Tiramisu',
                'description' => 'Classic Italian dessert',
                'ingredients' => "6 eggs\n500g mascarpone\nLadyfingers",
                'instructions' => "1. Prepare the cream\n2. Dip the biscuits\n3. Layer them alternately",
                'cooking_time' => 30,
                'difficulty' => 'easy',
                'status' => 'published',
                'servings' => 6,
                'user_id' => $editor->id,
            ],
        ];

        // Insert recipes into database
        foreach ($recipes as $recipeData) {
            Recipe::firstOrCreate(
                ['title' => $recipeData['title']],
                $recipeData
            );
        }
    }
}
