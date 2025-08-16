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
        // Tous les utilisateurs doivent être connectés
        $this->middleware('auth');
    }

    /**
     * Affiche toutes les recettes
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
     * Formulaire de création
     */
    public function create()
    {
        // ✅ Plus de Gate ici → tout utilisateur authentifié peut créer
        return view('recipes.create');
    }

    /**
     * Enregistre une nouvelle recette
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'ingredients' => 'required|string',
            'instructions' => 'required|string',
            'cooking_time' => 'required|integer|min:1',
            'difficulty' => 'required|in:facile,moyenne,difficile',
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
            ->with('success', 'Recette créée avec succès.');
    }

    /**
     * Affiche une recette
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
     * Formulaire d'édition
     */
    public function edit(Recipe $recipe): View
    {
        if ($recipe->user_id !== auth()->id() && !auth()->user()->isAdmin()) {
            abort(403, 'Vous ne pouvez éditer que vos propres recettes.');
        }

        return view('recipes.edit', compact('recipe'));
    }

    /**
     * Met à jour une recette
     */
    public function update(Request $request, Recipe $recipe): RedirectResponse
    {
        if ($recipe->user_id !== auth()->id() && !auth()->user()->isAdmin()) {
            abort(403, 'Vous ne pouvez éditer que vos propres recettes.');
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'ingredients' => 'required|string',
            'instructions' => 'required|string',
            'cooking_time' => 'required|integer|min:1',
            'difficulty' => 'required|in:facile,moyenne,difficile',
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
            ->with('success', 'Recette mise à jour avec succès.');
    }

    /**
     * Supprime une recette
     */
    public function destroy(Recipe $recipe): RedirectResponse
    {
        if ($recipe->user_id !== auth()->id() && !auth()->user()->isAdmin()) {
            abort(403, 'Vous ne pouvez supprimer que vos propres recettes.');
        }

        if ($recipe->image_path) {
            Storage::disk('public')->delete(str_replace('storage/', '', $recipe->image_path));
        }

        $recipe->delete();

        return redirect()->route('recipes.index')
            ->with('success', 'Recette supprimée avec succès.');
    }
}
