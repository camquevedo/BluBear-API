<?php

namespace App\Providers;

use App\Repositories\Api\V1\Digimons\Interfaces\DigimonRepositoryInterface;
use App\Repositories\Api\V1\Digimons\DigimonRepository;

use App\Repositories\Api\V1\Users\User\Interfaces\UserRepositoryInterface;
use App\Repositories\Api\V1\Users\User\UserRepository;
use App\Repositories\Api\V1\Users\UserRole\Interfaces\UserRoleRepositoryInterface;
use App\Repositories\Api\V1\Users\UserRole\UserRoleRepository;
use App\Repositories\Api\V1\Users\Role\Interfaces\RoleRepositoryInterface;
use App\Repositories\Api\V1\Users\Role\RoleRepository;

use Illuminate\Support\ServiceProvider;

class RepositoriesServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(DigimonRepositoryInterface::class, DigimonRepository::class);
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(UserRoleRepositoryInterface::class, UserRoleRepository::class);
        $this->app->bind(RoleRepositoryInterface::class, RoleRepository::class);
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