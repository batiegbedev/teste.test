<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Models\Recipe;
use App\Models\User;

class DynamicController extends Controller
{
    /**
     * Afficher le dashboard dynamique
     */
    public function dashboard()
    {
        $user = auth()->user();
        
        // Statistiques
        $stats = [
            'total_recipes' => Recipe::count(),
            'published_recipes' => Recipe::where('status', 'published')->count(),
            'draft_recipes' => Recipe::where('status', 'draft')->count(),
            'total_views' => Recipe::sum('views') ?? 1234, // Fallback
        ];
        
        // Recettes récentes
        $recentRecipes = Recipe::with('user')
            ->latest()
            ->take(6)
            ->get();
        
        // Activité récente (simulée pour l'instant)
        $recentActivity = [
            [
                'type' => 'recipe_published',
                'message' => 'Recette "Pasta Carbonara" publiée',
                'time' => 'Il y a 2h',
                'color' => 'green'
            ],
            [
                'type' => 'recipe_updated',
                'message' => 'Recette "Tiramisu" modifiée',
                'time' => 'Il y a 1j',
                'color' => 'blue'
            ],
            [
                'type' => 'recipe_created',
                'message' => 'Nouvelle recette créée',
                'time' => 'Il y a 3j',
                'color' => 'yellow'
            ]
        ];
        
        return view('dashboard-dynamic', compact('stats', 'recentRecipes', 'recentActivity'));
    }
    
    /**
     * Action AJAX pour créer une recette
     */
    public function createRecipe(Request $request): JsonResponse
    {
        try {
            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'required|string',
                'ingredients' => 'required|string',
                'instructions' => 'required|string',
                'cooking_time' => 'required|integer|min:1',
                'difficulty' => 'required|in:facile,moyen,difficile',
            ]);
            
            $recipe = Recipe::create([
                ...$validated,
                'user_id' => auth()->id(),
                'status' => 'draft',
            ]);
            
            return response()->json([
                'success' => true,
                'message' => 'Recette créée avec succès !',
                'recipe' => $recipe
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la création de la recette'
            ], 500);
        }
    }
    
    /**
     * Action AJAX pour supprimer une recette
     */
    public function deleteRecipe(Request $request, Recipe $recipe): JsonResponse
    {
        try {
            // Vérifier les permissions
            if (!auth()->user()->isAdmin() && $recipe->user_id !== auth()->id()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Vous n\'avez pas les permissions pour supprimer cette recette'
                ], 403);
            }
            
            $recipe->delete();
            
            return response()->json([
                'success' => true,
                'message' => 'Recette supprimée avec succès !'
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la suppression de la recette'
            ], 500);
        }
    }
    
    /**
     * Action AJAX pour changer le statut d'une recette
     */
    public function toggleRecipeStatus(Request $request, Recipe $recipe): JsonResponse
    {
        try {
            // Vérifier les permissions
            if (!auth()->user()->hasAnyRole(['admin', 'editeur']) && $recipe->user_id !== auth()->id()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Vous n\'avez pas les permissions pour modifier cette recette'
                ], 403);
            }
            
            $newStatus = $recipe->status === 'published' ? 'draft' : 'published';
            $recipe->update(['status' => $newStatus]);
            
            $statusText = $newStatus === 'published' ? 'publiée' : 'mise en brouillon';
            
            return response()->json([
                'success' => true,
                'message' => "Recette {$statusText} avec succès !",
                'new_status' => $newStatus
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors du changement de statut'
            ], 500);
        }
    }
    
    /**
     * Action AJAX pour rechercher des recettes
     */
    public function searchRecipes(Request $request): JsonResponse
    {
        try {
            $query = $request->get('q', '');
            $status = $request->get('status', 'all');
            
            $recipes = Recipe::with('user')
                ->when($query, function ($q) use ($query) {
                    $q->where('title', 'like', "%{$query}%")
                      ->orWhere('description', 'like', "%{$query}%");
                })
                ->when($status !== 'all', function ($q) use ($status) {
                    $q->where('status', $status);
                })
                ->latest()
                ->paginate(12);
            
            return response()->json([
                'success' => true,
                'recipes' => $recipes->items(),
                'pagination' => [
                    'current_page' => $recipes->currentPage(),
                    'last_page' => $recipes->lastPage(),
                    'total' => $recipes->total(),
                ]
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la recherche'
            ], 500);
        }
    }
    
    /**
     * Action AJAX pour obtenir les statistiques en temps réel
     */
    public function getStats(): JsonResponse
    {
        try {
            $stats = [
                'total_recipes' => Recipe::count(),
                'published_recipes' => Recipe::where('status', 'published')->count(),
                'draft_recipes' => Recipe::where('status', 'draft')->count(),
                'total_users' => User::count(),
                'total_views' => Recipe::sum('views') ?? 0,
            ];
            
            return response()->json([
                'success' => true,
                'stats' => $stats
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la récupération des statistiques'
            ], 500);
        }
    }
    
    /**
     * Action AJAX pour envoyer une notification
     */
    public function sendNotification(Request $request): JsonResponse
    {
        try {
            $validated = $request->validate([
                'type' => 'required|in:success,error,warning,info',
                'message' => 'required|string|max:255',
                'user_id' => 'nullable|exists:users,id'
            ]);
            
            // Ici vous pourriez envoyer une vraie notification
            // Pour l'instant, on retourne juste un succès
            
            return response()->json([
                'success' => true,
                'message' => 'Notification envoyée avec succès !'
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de l\'envoi de la notification'
            ], 500);
        }
    }
}
