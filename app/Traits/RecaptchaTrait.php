<?php

namespace App\Traits;

use Illuminate\Support\Facades\Http;

trait RecaptchaTrait
{
    private static function recaptcha(string $token): bool
    {
        $config = config('constants.google.recaptcha');
        if (!$config['validate']) {
            return true;
        }

        $basePath = $config['path'];
        $secret = $config['secret'];

        $url = $basePath . '?secret=' . $secret . '&response=' . $token;

        $request = Http::get($url);
        $response = $request->object();

        return $response->success;
    }
}
