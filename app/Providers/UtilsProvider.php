<?php

namespace App\Providers;

use App\Interfaces\QueryBuilderInterface;
use App\Utils\QueryBuilder;
use Illuminate\Support\ServiceProvider;

class UtilsProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(QueryBuilderInterface::class, QueryBuilder::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
