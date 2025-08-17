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

        // Prevent changing own role
        if ($user->id === auth()->id()) {
            return back()->with('error', 'You cannot change your own role.');
        }

        $user->update(['role' => $validated['role']]);

        return back()->with('success', "Role of {$user->name} changed to {$validated['role']}.");
    }

    /**
     * Toggle user status (active/inactive)
     */
    public function toggleStatus(User $user): RedirectResponse
    {
        // Prevent disabling own account
        if ($user->id === auth()->id()) {
            return back()->with('error', 'You cannot deactivate your own account.');
        }

        $user->update(['is_active' => !$user->is_active]);

        $status = $user->is_active ? 'activated' : 'deactivated';
        return back()->with('success', "Account of {$user->name} {$status}.");
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
