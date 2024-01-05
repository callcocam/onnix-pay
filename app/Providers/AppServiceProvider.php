<?php

namespace App\Providers;

use App\Core\Helpers\Countdown;
use Carbon\Carbon;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Laravel\Cashier\Cashier;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        Cashier::ignoreMigrations();

        $this->app->bind('callcocam.countdown', function ($app) {
            $carbon = new Carbon();
            $timezone = $app->config->get('app.timezone');

            return new Countdown($timezone, $carbon);
        });

        $this->app->alias('callcocam.countdown', Countdown::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Schema::defaultStringLength(191);
    }
}
