<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class RecipeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display all recipes
     */
    public function index(): View
    {
        $recipes = Recipe::with('user')
            ->when(!auth()->user()->isAdmin(), function ($query) {
                return $query->published();
            })
            ->orderBy('created_at', 'desc')
            ->paginate(12);

        return view('recipes.index', compact('recipes'));
    }

    /**
     * Show recipe creation form
     */
    public function create(): View
    {
        $this->middleware('editeur');
        return view('recipes.create');
    }

    /**
     * Store new recipe
     */
    public function store(Request $request): RedirectResponse
    {
        $this->middleware('editeur');
        
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'ingredients' => 'required|string',
            'instructions' => 'required|string',
            'cooking_time' => 'required|integer|min:1',
            'difficulty' => 'required|in:facile,moyen,difficile',
            'servings' => 'required|integer|min:1',
        ]);

        $validated['user_id'] = auth()->id();
        $validated['status'] = 'draft';

        Recipe::create($validated);

        return redirect()->route('recipes.index')
            ->with('success', 'Recette créée avec succès.');
    }

    /**
     * Show recipe details
     */
    public function show(Recipe $recipe): View
    {
        // Vérifier que l'utilisateur peut voir cette recette
        if (!$recipe->isPublished() && !auth()->user()->hasAnyRole(['admin', 'editeur'])) {
            abort(404);
        }

        return view('recipes.show', compact('recipe'));
    }

    /**
     * Show recipe edit form
     */
    public function edit(Recipe $recipe): View
    {
        $this->middleware('editeur');
        
        // Vérifier que l'utilisateur peut éditer cette recette
        if ($recipe->user_id !== auth()->id() && !auth()->user()->isAdmin()) {
            abort(403, 'Vous ne pouvez éditer que vos propres recettes.');
        }

        return view('recipes.edit', compact('recipe'));
    }

    /**
     * Update recipe
     */
    public function update(Request $request, Recipe $recipe): RedirectResponse
    {
        $this->middleware('editeur');
        
        // Vérifier que l'utilisateur peut éditer cette recette
        if ($recipe->user_id !== auth()->id() && !auth()->user()->isAdmin()) {
            abort(403, 'Vous ne pouvez éditer que vos propres recettes.');
        }
        
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'ingredients' => 'required|string',
            'instructions' => 'required|string',
            'cooking_time' => 'required|integer|min:1',
            'difficulty' => 'required|in:facile,moyen,difficile',
            'servings' => 'required|integer|min:1',
        ]);

        $recipe->update($validated);

        return redirect()->route('recipes.show', $recipe)
            ->with('success', 'Recette mise à jour avec succès.');
    }

    /**
     * Delete recipe
     */
    public function destroy(Recipe $recipe): RedirectResponse
    {
        $this->middleware('editeur');
        
        // Vérifier que l'utilisateur peut supprimer cette recette
        if ($recipe->user_id !== auth()->id() && !auth()->user()->isAdmin()) {
            abort(403, 'Vous ne pouvez supprimer que vos propres recettes.');
        }

        $recipe->delete();

        return redirect()->route('recipes.index')
            ->with('success', 'Recette supprimée avec succès.');
    }
}
