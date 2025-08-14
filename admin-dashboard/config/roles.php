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
            'name' => 'Administrateur',
            'description' => 'Accès complet à toutes les fonctionnalités',
            'permissions' => [
                'manage_users',
                'manage_recipes',
                'manage_content',
                'view_statistics',
                'manage_settings',
            ],
        ],
        'editeur' => [
            'name' => 'Éditeur',
            'description' => 'Peut créer et modifier du contenu',
            'permissions' => [
                'create_recipes',
                'edit_own_recipes',
                'delete_own_recipes',
                'view_recipes',
            ],
        ],
        'abonne' => [
            'name' => 'Abonné',
            'description' => 'Accès en lecture seule au contenu',
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
