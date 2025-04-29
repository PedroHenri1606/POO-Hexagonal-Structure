<?php

namespace App\Providers;

use App\Infrastructure\Database\SqlQueryBuilder;
use App\Interfaces\QueryBuilderInterface;
use Illuminate\Support\ServiceProvider;

class InfrastructureProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(QueryBuilderInterface::class, SqlQueryBuilder::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
