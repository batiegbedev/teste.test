<?php

return [
    /*
    |--------------------------------------------------------------------------
    | User Roles Configuration
    |--------------------------------------------------------------------------
    |
    | This file contains the configuration for user roles and their permissions
    | in the application.
    |
    */

    'roles' => [
        'admin' => [
            'name' => 'Administrator',
            'description' => 'Full access to all features',
            'permissions' => [
                'manage_users',
                'manage_recipes',
                'manage_content',
                'view_statistics',
                'manage_settings',
            ],
        ],
        'editeur' => [
            'name' => 'Editor',
            'description' => 'Can create and edit content',
            'permissions' => [
                'create_recipes',
                'edit_own_recipes',
                'delete_own_recipes',
                'view_recipes',
            ],
        ],
        'abonne' => [
            'name' => 'Subscriber',
            'description' => 'Read-only access to content',
            'permissions' => [
                'view_recipes',
                'view_profile',
            ],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Default Role
    |--------------------------------------------------------------------------
    |
    | The default role assigned to new users when they register.
    |
    */
    'default_role' => 'abonne',

    /*
    |--------------------------------------------------------------------------
    | Role Hierarchy
    |--------------------------------------------------------------------------
    |
    | Define which roles can manage other roles.
    |
    */
    'hierarchy' => [
        'admin' => ['admin', 'editeur', 'abonne'],
        'editeur' => ['abonne'],
        'abonne' => [],
    ],
];
