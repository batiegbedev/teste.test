<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Models\Recipe;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if ($user->role === 'admin') {
            return view('dashboard.admin', [
                'totalRecipes'     => Recipe::count(),
                'publishedRecipes' => Recipe::where('status', 'published')->count(),
                'usersCount'       => User::count(),
                'totalViews'       => Recipe::sum('views') ?? 0,
                'recentRecipes'    => Recipe::with('user')->latest()->take(5)->get(),
                'recentActivities' => $this->getRecentActivity(),
                // ✅ Ajout d'une recette pour la vue admin.blade.php
                'recipe'           => Recipe::latest()->first(),
            ]);
        }

        if ($user->role === 'editeur') {
            return view('dashboard.editeur', [
                'recentRecipes' => $this->getRecentRecipes(),
            ]);
        }

        // Abonné: la vue attend "recentRecipes" (publiées)
        return view('dashboard.abonne', [
            'recentRecipes' => Recipe::where('status', 'published')
                ->latest()
                ->take(6)
                ->get(),
        ]);
    }

    private function getRecentRecipes()
    {
        return Recipe::with('user')->latest()->take(6)->get();
    }
    

    private function getRecentActivity()
    {
        return [
            ['description' => 'Nouvel utilisateur inscrit',           'time' => 'il y a 3h',  'color' => 'green'],
            ['description' => 'Publication de "Gâteau au chocolat"',  'time' => 'il y a 1j',  'color' => 'blue'],
            ['description' => 'Recette "Salade César" modifiée',      'time' => 'il y a 2j',  'color' => 'yellow'],
        ];
    }

    public function createRecipe(Request $request): JsonResponse
    {
        try {
            $validated = $request->validate([
                'title'         => 'required|string|max:255',
                'description'   => 'required|string',
                'ingredients'   => 'required|string',
                'instructions'  => 'required|string',
                'cooking_time'  => 'required|integer|min:1',
                'difficulty'    => 'required|in:facile,moyen,difficile',
            ]);

            $recipe = Recipe::create([
                ...$validated,
                'user_id' => auth()->id(),
                'status'  => 'draft',
                'views'   => 0,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Recette créée avec succès !',
                'recipe'  => $recipe,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la création de la recette',
            ], 500);
        }
    }

    public function deleteRecipe(Request $request, Recipe $recipe): JsonResponse
    {
        try {
            if (!auth()->user()->isAdmin() && $recipe->user_id !== auth()->id()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Vous n\'avez pas les permissions pour supprimer cette recette',
                ], 403);
            }

            $recipe->delete();

            return response()->json([
                'success' => true,
                'message' => 'Recette supprimée avec succès !',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la suppression de la recette',
            ], 500);
        }
    }

    public function toggleRecipeStatus(Request $request, Recipe $recipe): JsonResponse
    {
        try {
            if (!auth()->user()->hasAnyRole(['admin', 'editeur']) && $recipe->user_id !== auth()->id()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Vous n\'avez pas les permissions pour modifier cette recette',
                ], 403);
            }

            $newStatus = $recipe->status === 'published' ? 'draft' : 'published';
            $recipe->update(['status' => $newStatus]);

            $statusText = $newStatus === 'published' ? 'publiée' : 'mise en brouillon';

            return response()->json([
                'success'    => true,
                'message'    => "Recette {$statusText} avec succès !",
                'new_status' => $newStatus,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors du changement de statut',
            ], 500);
        }
        
    }

    public function searchRecipes(Request $request): JsonResponse
    {
        try {
            $query  = $request->get('q', '');
            $status = $request->get('status', 'all');

            $recipes = Recipe::with('user')
                ->when($query, function ($q) use ($query) {
                    $q->where(function ($q2) use ($query) {
                        $q2->where('title', 'like', "%{$query}%")
                           ->orWhere('description', 'like', "%{$query}%");
                    });
                })
                ->when($status !== 'all', fn ($q) => $q->where('status', $status))
                ->latest()
                ->paginate(12);

            return response()->json([
                'success'    => true,
                'recipes'    => $recipes->items(),
                'pagination' => [
                    'current_page' => $recipes->currentPage(),
                    'last_page'    => $recipes->lastPage(),
                    'total'        => $recipes->total(),
                ],
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la recherche',
            ], 500);
        }
    }

    public function getStats(): JsonResponse
    {
        try {
            $stats = [
                'total_recipes'     => Recipe::count(),
                'published_recipes' => Recipe::where('status', 'published')->count(),
                'draft_recipes'     => Recipe::where('status', 'draft')->count(),
                'total_users'       => User::count(),
                'total_views'       => Recipe::sum('views') ?? 0,
            ];

            return response()->json([
                'success' => true,
                'stats'   => $stats,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la récupération des statistiques',
            ], 500);
        }
    }

    public function sendNotification(Request $request): JsonResponse
    {
        try {
            $validated = $request->validate([
                'type'    => 'required|in:success,error,warning,info',
                'message' => 'required|string|max:255',
                'user_id' => 'nullable|exists:users,id',
            ]);

            // À implémenter: envoi réel (events, jobs, notifications...)

            return response()->json([
                'success' => true,
                'message' => 'Notification envoyée avec succès !',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de l\'envoi de la notification',
            ], 500);
        }
    }
    
}
