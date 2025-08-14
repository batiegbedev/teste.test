<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class PermissionController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    /**
     * Change user role
     */
    public function changeRole(Request $request, User $user): RedirectResponse
    {
        $validated = $request->validate([
            'role' => 'required|in:admin,editeur,abonne',
        ]);

        // Empêcher de changer son propre rôle
        if ($user->id === auth()->id()) {
            return back()->with('error', 'Vous ne pouvez pas changer votre propre rôle.');
        }

        $user->update(['role' => $validated['role']]);

        return back()->with('success', "Rôle de {$user->name} changé en {$validated['role']}.");
    }

    /**
     * Toggle user status (active/inactive)
     */
    public function toggleStatus(User $user): RedirectResponse
    {
        // Empêcher de désactiver son propre compte
        if ($user->id === auth()->id()) {
            return back()->with('error', 'Vous ne pouvez pas désactiver votre propre compte.');
        }

        $user->update(['is_active' => !$user->is_active]);

        $status = $user->is_active ? 'activé' : 'désactivé';
        return back()->with('success', "Compte de {$user->name} {$status}.");
    }

    /**
     * Show permissions management page
     */
    public function index(): \Illuminate\View\View
    {
        $users = User::orderBy('name')->paginate(15);
        return view('admin.permissions.index', compact('users'));
    }
}
