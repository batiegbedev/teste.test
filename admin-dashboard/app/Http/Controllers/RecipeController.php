<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

class RecipeController extends Controller
{
    public function __construct()
    {
        // All users must be authenticated
        $this->middleware('auth');
    }

    /**
     * Display all recipes
     */
    public function index(): View
    {
        $recipes = Recipe::with('user')
            ->when(!auth()->user()->isAdmin(), fn($query) => $query->published())
            ->orderBy('created_at', 'desc')
            ->paginate(12);

        return view('recipes.index', compact('recipes'));
    }

    /**
     * Show form to create a new recipe
     */
    public function create()
    {
        return view('recipes.create');
    }

    /**
     * Store a new recipe
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'ingredients' => 'required|string',
            'instructions' => 'required|string',
            'cooking_time' => 'required|integer|min:1',
            'difficulty' => 'required|in:facile,moyen,difficile',
            'servings' => 'required|integer|min:1',
            'image_path' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image_path')) {
            $path = $request->file('image_path')->store('recipes', 'public');
            $validated['image_path'] = 'storage/' . $path;
        }

        $validated['user_id'] = auth()->id();
        $validated['status'] = 'draft';

        Recipe::create($validated);

        return redirect()->route('recipes.index')
            ->with('success', 'Recipe created successfully.');
    }

    /**
     * Display a recipe
     */
    public function show(Recipe $recipe): View
    {
        if (
            !$recipe->isPublished()
            && $recipe->user_id !== auth()->id()
            && !auth()->user()->hasAnyRole(['admin', 'editeur'])
        ) {
            abort(404);
        }

        return view('recipes.show', compact('recipe'));
    }

    /**
     * Show form to edit a recipe
     */
    public function edit(Recipe $recipe): View
{
    $user = auth()->user();

    if (
        $user->id !== $recipe->user_id &&
        !$user->isAdmin() &&
        $user->role !== 'editeur'
    ) {
        abort(403, 'Vous n’avez pas la permission d’éditer cette recette.');
    }

    return view('recipes.edit', compact('recipe'));
}

    /**
     * Update a recipe
     */
    public function update(Request $request, Recipe $recipe): RedirectResponse
    {
        $user = auth()->user();

if (
    $user->id !== $recipe->user_id &&
    !$user->isAdmin() &&
    $user->role !== 'editeur'
) {
    abort(403, 'Vous n’avez pas la permission de modifier cette recette.');
}


        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'ingredients' => 'required|string',
            'instructions' => 'required|string',
            'cooking_time' => 'required|integer|min:1',
            'difficulty' => 'required|in:facile,moyen,difficile',
            'servings' => 'required|integer|min:1',
            'image_path' => 'nullable|image|max:2048',
        ]);

        if ($request->has('delete_image') && $recipe->image_path) {
            Storage::disk('public')->delete(str_replace('storage/', '', $recipe->image_path));
            $recipe->image_path = null;
        }

        if ($request->hasFile('image_path')) {
            if ($recipe->image_path) {
                Storage::disk('public')->delete(str_replace('storage/', '', $recipe->image_path));
            }
            $path = $request->file('image_path')->store('recipes', 'public');
            $validated['image_path'] = 'storage/' . $path;
        }

        $recipe->update($validated);

        return redirect()->route('recipes.show', $recipe)
            ->with('success', 'Recipe updated successfully.');
    }

    /**
     * Delete a recipe
     */
    public function destroy(Recipe $recipe): RedirectResponse
    {
        if ($recipe->user_id !== auth()->id() && !auth()->user()->isAdmin()) {
            abort(403, 'You can only delete your own recipes.');
        }

        if ($recipe->image_path) {
            Storage::disk('public')->delete(str_replace('storage/', '', $recipe->image_path));
        }

        $recipe->delete();

        return redirect()->route('recipes.index')
            ->with('success', 'Recipe deleted successfully.');
    }
    
}
