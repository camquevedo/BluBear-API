<?php

namespace App\Providers;

use App\Services\Api\V1\Digimons\DigimonService;
use App\Services\Api\V1\Digimons\Interfaces\DigimonServiceInterface;

use App\Services\Api\V1\Users\UserService;
use App\Services\Api\V1\Users\Interfaces\UserServiceInterface;
use App\Services\Api\V1\Users\UserLoginService;
use App\Services\Api\V1\Users\Interfaces\UserLoginServiceInterface;

use Illuminate\Support\ServiceProvider;

class ServicesServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(DigimonServiceInterface::class, DigimonService::class);
        $this->app->bind(UserServiceInterface::class, UserService::class);
        $this->app->bind(UserLoginServiceInterface::class, UserLoginService::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}