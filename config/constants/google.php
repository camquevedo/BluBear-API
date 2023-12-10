<?php
return [
    'recaptcha' => [
        'path' => env(
            'GOOGLE_RECAPTCHA_PATH',
            'https://www.google.com/recaptcha/api/siteverify'
        ),
        'secret' => env('GOOGLE_RECAPTCHA_SECRET', ''),
        'validate' => env('GOOGLE_RECAPTCHA_VALIDATE', false),
    ],
];
