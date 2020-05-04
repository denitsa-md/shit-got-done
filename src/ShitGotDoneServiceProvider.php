<?php

namespace Denitsa\ShitGotDone;

use Denitsa\ShitGotDone\Console\ShitGotDoneCommand;
use Illuminate\Support\ServiceProvider;

class ShitGotDoneServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        /*
         * Optional methods to load your package assets
         */
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'shit-got-done');
        // $this->loadViewsFrom(__DIR__.'/../resources/views', 'shit-got-done');
        // $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        // $this->loadRoutesFrom(__DIR__.'/routes.php');

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/config.php' => config_path('shit-got-done.php'),
            ], 'config');

            // Publishing the views.
            /*$this->publishes([
                __DIR__.'/../resources/views' => resource_path('views/vendor/shit-got-done'),
            ], 'views');*/

            // Publishing assets.
            /*$this->publishes([
                __DIR__.'/../resources/assets' => public_path('vendor/shit-got-done'),
            ], 'assets');*/

            // Publishing the translation files.
            /*$this->publishes([
                __DIR__.'/../resources/lang' => resource_path('lang/vendor/shit-got-done'),
            ], 'lang');*/
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'shit-got-done');

        // Register the main class to use with the facade
        $this->app->singleton('shit-got-done', function () {
            return new ShitGotDone;
        });

        // Registering package commands.
        $this->commands([ShitGotDoneCommand::class]);
    }
}
