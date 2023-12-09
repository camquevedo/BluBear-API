<?php

return [
    'urlApi' => env('URL_API', 'https://api.camquevedo.digimon.com'),
    'urlWeb' => env('URL_WEB', 'https://www.camquevedo.digimon.com'),
    'defaultCityId' => env('DEFAULT_CITY_ID', 1),
    'defaultUserId' => env('DEFAULT_USER_ID', 1),
    'defaultPerPage' => env('DEFAULT_PER_PAGE', 10),
    'passwordValidation' => env('PASSWORD_VALIDATION', '/^(?=.*\d)(?=.*[!@#$%^&*])[A-Za-z\d!@#$%^&*]{8,16}$/'),
];