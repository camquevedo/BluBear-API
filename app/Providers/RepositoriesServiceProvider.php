<?php

namespace App\Providers;

use App\Repositories\Api\V1\Digimons\Interfaces\DigimonRepositoryInterface;
use App\Repositories\Api\V1\Digimons\DigimonRepository;

use App\Repositories\Api\V1\Users\User\Interfaces\UserRepositoryInterface;
use App\Repositories\Api\V1\Users\User\UserRepository;

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