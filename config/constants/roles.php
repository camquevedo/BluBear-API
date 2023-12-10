<?php

return [
    'access' => [
        'user' => explode(
            ',',
            env(
                'ROLES_WITH_USER_ACCESS',
                'user,editor,admin,superadmin'
            )
        ),

        'editor' => explode(
            ',',
            env('ROLES_WITH_EDITOR_ACCESS', 'editor,superadmin')
        ),

        'admin' => explode(
            ',',
            env('ROLES_WITH_ADMIN_ACCESS', 'admin,superadmin')
        ),

        'superadmin' => explode(
            ',',
            env('ROLES_WITH_SUPERADMIN_ACCESS', 'superadmin')
        ),
    ],
];
