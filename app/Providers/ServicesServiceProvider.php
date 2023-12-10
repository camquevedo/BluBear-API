<?php

namespace App\Providers;

use App\Services\Api\V1\Digimons\DigimonService;
use App\Services\Api\V1\Digimons\Interfaces\DigimonServiceInterface;

use App\Services\Api\V1\Users\User\Interfaces\UserServiceInterface;
use App\Services\Api\V1\Users\User\UserService;
use App\Services\Api\V1\Users\User\Interfaces\UserLoginServiceInterface;
use App\Services\Api\V1\Users\User\UserLoginService;
use App\Services\Api\V1\Users\UserRole\Interfaces\UserRoleServiceInterface;
use App\Services\Api\V1\Users\UserRole\UserRoleService;
use App\Services\Api\V1\Users\Role\Interfaces\RoleServiceInterface;
use App\Services\Api\V1\Users\Role\RoleService;

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
        $this->app->bind(UserRoleServiceInterface::class, UserRoleService::class);
        $this->app->bind(RoleServiceInterface::class, RoleService::class);
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