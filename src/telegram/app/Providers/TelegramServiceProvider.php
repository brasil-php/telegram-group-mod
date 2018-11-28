<?php

namespace Telegram\Sdk\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use Telegram\Sdk\Api as Telegram;

class TelegramServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../../routes_webhook.php' => base_path('routes/telegram.php'),
        ]);

        $this->publishes([
            __DIR__.'/../../config.php' => config_path('telegram.php'),
        ]);

        $this->mapWebRoutes();
    }

    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../../config.php', 'telegram'
        );
        
        $this->app->singleton(Telegram::class, function () {
            return new Telegram(config('telegram.token'));
        });
    }
    protected function mapWebRoutes()
    {
        Route::middleware('api')
             ->namespace('Telegram\Sdk\Controllers')
             ->prefix('/telegram')
             ->group(__DIR__.'/../../routes.php');
    }
}
