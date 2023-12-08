<?php

namespace App\Providers;

use App\Services\Api\V1\Digimons\DigimonService;
use App\Services\Api\V1\Digimons\Interfaces\DigimonServiceInterface;

use App\Services\Api\V1\Users\User\UserService;
use App\Services\Api\V1\Users\User\Interfaces\UserServiceInterface;

use App\Services\Api\V1\Users\User\UserLoginService;
use App\Services\Api\V1\Users\User\Interfaces\UserLoginServiceInterface;

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