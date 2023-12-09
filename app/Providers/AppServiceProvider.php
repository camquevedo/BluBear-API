<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Validator::extend('invalid_password_format', function ($attribute, $value, $parameters, $validator) {
            $pattern = config('constants.global.passwordValidation');
            return preg_match($pattern, $value);
        });
    }
}
