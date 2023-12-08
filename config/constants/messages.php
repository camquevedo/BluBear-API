<?php

$locale = env('APP_LOCALE', 'en');

if ($locale === 'es') {
    return [
        'error' => [
            'general' => 'Error en la solicitud',
            'recaptcha' => 'Error validando el recaptcha',
            'login' => 'Error en el inicio de sesión',
            'validation' => 'Datos inválidos en la solicitud',
            'entityNotFound' => 'No se ha encontrado la entidad',
            'entityNotCreated' => 'No se ha creado la entidad',
            'entityNotUpdated' => 'No se ha editado la entidad',
            'entityNotDeleted' => 'No se ha eliminado la entidad',
            'export' => 'Error exportando',
            'listAll' => 'Error listando ',
            'list' => 'Error listando individualmente ',
            'save' => 'Error guardando ',
            'update' => 'Error editando ',
            'delete' => 'Error eliminando ',
        ],
        'success' => [
            'general' => 'La solicitud se ha completado exitosamente',
            'login' => 'La sesión se ha iniciado exitosamente',
            'listAll' => 'Se han listado exitosamente ',
            'list' => 'Se ha obtenido exitosamente el detalle de ',
            'save' => 'Se ha creado exitosamente ',
            'update' => 'Se ha editado exitosamente ',
            'delete' => 'Se ha eliminado exitosamente ',
            'validate' => 'Se ha validado exitosamente ',
        ],

        'entities' => [
            'user' => 'lss usuarios',
            'digimon' => 'los digimons',
        ]
    ];
}

return [
    'error' => [
        'general' => 'Error in the request',
        'recaptcha' => 'Error validating recaptcha',
        'login' => 'Error logging in',
        'validation' => 'Invalid data in the request',
        'entityNotFound' => 'The entity was not found',
        'entityNotCreated' => 'The entity was not created',
        'entityNotUpdated' => 'The entity was not edited',
        'entityNotDeleted' => 'The entity was not deleted',
        'export' => 'Error exporting',
        'listAll' => 'Error listing ',
        'list' => 'Error listing individually ',
        'save' => 'Error saving ',
        'update' => 'Error editing ',
        'delete' => 'Error deleting ',
    ],
    'success' => [
        'general' => 'The request has been successfully completed',
        'login' => 'The session has been successfully started',
        'listAll' => 'Successfully listed ',
        'list' => 'Successfully obtained the details of ',
        'save' => 'Successfully created ',
        'update' => 'Successfully edited ',
        'delete' => 'Successfully deleted ',
        'validate' => 'Successfully validated ',
    ],
    
    'entities' => [
        'user' => 'the users',
        'digimon' => 'the digimons',
    ]
];
