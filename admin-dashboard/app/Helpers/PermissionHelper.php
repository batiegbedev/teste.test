<?php

namespace App\Helpers;

use App\Models\User;

class PermissionHelper
{
    /**
     * Check if user has permission
     */
    public static function hasPermission(User $user, string $permission): bool
    {
        $roleConfig = config("roles.roles.{$user->role}");
        
        if (!$roleConfig) {
            return false;
        }

        return in_array($permission, $roleConfig['permissions']);
    }

    /**
     * Check if user can manage another user
     */
    public static function canManageUser(User $manager, User $target): bool
    {
        // Un utilisateur ne peut pas se gérer lui-même
        if ($manager->id === $target->id) {
            return false;
        }

        $hierarchy = config('roles.hierarchy');
        $managerRole = $manager->role;
        $targetRole = $target->role;

        return in_array($targetRole, $hierarchy[$managerRole] ?? []);
    }

    /**
     * Get available roles for a user to assign
     */
    public static function getAssignableRoles(User $user): array
    {
        $hierarchy = config('roles.hierarchy');
        $userRole = $user->role;

        return $hierarchy[$userRole] ?? [];
    }

    /**
     * Get role display name
     */
    public static function getRoleName(string $role): string
    {
        return config("roles.roles.{$role}.name", $role);
    }

    /**
     * Get role description
     */
    public static function getRoleDescription(string $role): string
    {
        return config("roles.roles.{$role}.description", '');
    }

    /**
     * Get all available roles
     */
    public static function getAllRoles(): array
    {
        return array_keys(config('roles.roles', []));
    }
}
