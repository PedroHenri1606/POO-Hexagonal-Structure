<?php

namespace App\Providers;

use App\Infrastructure\Auth\AuthJwtBuilder;
use App\Interfaces\Auth\AuthInfrastructureInterface;
use App\Interfaces\Auth\AuthServiceInterface;
use App\Services\API\AuthServiceApi;
use Illuminate\Support\ServiceProvider;

class AuthProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(AuthInfrastructureInterface::class, AuthJwtBuilder::class);
        $this->app->bind(AuthServiceInterface::class       , AuthServiceApi::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
