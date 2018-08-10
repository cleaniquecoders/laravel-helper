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
            __DIR__ . '/../config/helper.php' => config_path('helper.php'),
        ], 'laravel-helper');
        $this->mergeConfigFrom(
            __DIR__ . '/../config/helper.php', 'helper'
        );
    }

    /**
     * Register the application services.
     */
    public function register()
    {
    }
}
