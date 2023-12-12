<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
        Schema::defaultStringLength(191);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrap();

        Validator::extend('invalid_password_format', function ($attribute, $value, $parameters, $validator) {
            $pattern = config('constants.global.passwordValidation');
            return preg_match($pattern, $value);
        });

        if (config('app.env') === 'production')
            URL::forceScheme('https');
    }
}
