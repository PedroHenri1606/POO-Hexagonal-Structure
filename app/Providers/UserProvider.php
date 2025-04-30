<?php

namespace App\Providers;

use App\Interfaces\User\UserRepositoryInterface;
use App\Interfaces\User\UserServiceApiInterface;
use App\Interfaces\User\UserServiceWebInterface;
use App\Repositories\UserRepository;
use App\Services\API\UserApiService;
use App\Services\Web\UserWebService;
use Illuminate\Support\ServiceProvider;

class UserProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(UserServiceApiInterface::class, UserApiService::class);
        $this->app->bind(UserServiceWebInterface::class, UserWebService::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
