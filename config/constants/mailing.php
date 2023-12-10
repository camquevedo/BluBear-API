<?php

return [
    'sendMails' => env('MAIL_SEND_EMAILS', true),
    'mailFromName' => env('MAIL_FROM_NAME', 'dev.camquevedo'),
    'mailFromEmail' => env('MAIL_FROM_ADDRESS', 'camquevedo@dev.com'),
    'sendMailsToAdmins' => [
        env('MAIL_SEND_MAIL_TO_ADMIN', 'camquevedo@hotmail.com')
    ],
    'mailUrlApi' => env('URL_API', 'https://api.camquevedo.digimon.com'),
    'mailUrlWeb' => env('URL_WEB', 'https://www.dev.camquevedo.com'),
    'mailUrlRecoverPassword' => env('URL_RECOVER_PASSWORD', '/recuperar-contrasena/'),
    'facebookUrl' => env(
        'FACEBOOK_URL',
        'https://www.facebook.com/camquevedo/'
    ),
    'twitterUrl' => env(
        'TWITTER_URL',
        'https://twitter.com/QuevedoCamilo'
    ),
    'instagramUrl' => env(
        'INSTAGRAM_URL',
        'https://www.instagram.com/camquevedo17/'
    ),
    'gitHub' => env(
        'GIT_HUB_URL',
        'https://github.com/camquevedo'
    ),
];
