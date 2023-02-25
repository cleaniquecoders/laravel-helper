<?php

namespace CleaniqueCoders\LaravelHelper;

use Illuminate\Support\ServiceProvider;

class LaravelHelperServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        /*
         * Configuration
         */
        $this->publishes([
            __DIR__.'/../config/helper.php' => config_path('helper.php'),
        ], 'laravel-helper-config');
        $this->mergeConfigFrom(
            __DIR__.'/../config/helper.php',
            'helper'
        );

        /*
         * View
         */
        $this->loadViewsFrom(__DIR__.'/../views', 'laravel-helper-view');
        $this->publishes([
            __DIR__.'/../views' => resource_path('views/vendor/laravel-helper'),
        ]);
    }

    /**
     * Register the application services.
     */
    public function register()
    {
    }
}
