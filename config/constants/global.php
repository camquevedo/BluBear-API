<?php

return [
    'urlApi' => env('URL_API', 'https://api.camquevedo.digimon.com'),
    'urlWeb' => env('URL_WEB', 'https://www.camquevedo.digimon.com'),
    'defaultCityId' => env('DEFAULT_CITY_ID', 1),
    'defaultUserId' => env('DEFAULT_USER_ID', 1),
    'defaultUserSystemId' => env('DEFAULT_USER_SYSTEM_ID', 0),
    'defaultUserSystemName' => env('DEFAULT_USER_SYSTEM_NAME', 'System'),
    'defaultPerPage' => env('DEFAULT_PER_PAGE', 10),
    'defaultDocumentType' => env('DEFAULT_DOCUMENT_TYPE', 1),
    'socialMediaProviders' => [
        'google' => 1,
        'facebook' => 2,
    ],
    'documentTypes' => [
        '1' => [
            'name' => 'Cedula de ciudadania',
        ],
        '2' => [
            'name' => 'Nit',
        ],
        '3' => [
            'name' => 'Pasaporte',
        ],
    ],
    'passwordValidation' => env('PASSWORD_VALIDATION', '/^(?=.*\d)(?=.*[!@#$%^&*])[A-Za-z\d!@#$%^&*]{8,16}$/'),
    'birthdayValidation' => env('BIRTHDAY_VALIDATION', '/^(19|20)\d{2}-(0[1-9]|1[0-2])-([0-2][1-9]|3[01])$/'),
];