<?php

namespace App\Providers;

use App\Infrastructure\Auth\AuthJwtBuilder;
use App\Infrastructure\Auth\AuthSessionBuilder;
use App\Interfaces\Auth\AuthApiInterface;
use App\Interfaces\Auth\AuthApiServiceInterface;
use App\Interfaces\Auth\AuthWebServiceInterface;
use App\Services\API\AuthApiService;
use App\Services\Web\AuthWebService;
use AuthWebInterface;
use Illuminate\Support\ServiceProvider;

class AuthProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(AuthApiInterface::class        , AuthJwtBuilder::class);
        $this->app->bind(AuthApiServiceInterface::class , AuthApiService::class);

        $this->app->bind(AuthWebInterface::class       , AuthSessionBuilder::class);
        $this->app->bind(AuthWebServiceInterface::class, AuthWebService::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
