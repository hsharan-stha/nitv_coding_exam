<?php

namespace App\Providers;

use App\Repositories\Profile\ProfileRepository;
use App\Repositories\Profile\ProfileRepositoryInterface;
use App\Repositories\User\UserRepository;
use App\Repositories\User\UserRepositoryInterface;
use App\Services\Profile\ProfileService;
use App\Services\Profile\ProfileServiceInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryAndServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            UserRepositoryInterface::class,
            UserRepository::class
        );

        $this->app->bind(
            ProfileRepositoryInterface::class,
            ProfileRepository::class
        );
        $this->app->bind(
            ProfileServiceInterface::class,
            ProfileService::class
        );

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
