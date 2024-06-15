<?php

namespace App\Providers;

use App\Helpers\ItemsHelper;
use App\Helpers\StockRequestsHelper;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(ItemsHelper::class, function () {
            return new ItemsHelper();
        });

        $this->app->bind(StockRequestsHelper::class, function () {
            return new StockRequestsHelper();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
