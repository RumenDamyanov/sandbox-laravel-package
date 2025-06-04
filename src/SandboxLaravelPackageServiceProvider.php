<?php
// Main service provider for the Sandbox Laravel Package
// Handles config publishing and merging for Laravel applications

namespace Rumenx\SandboxLaravelPackage;

use Illuminate\Support\ServiceProvider;

class SandboxLaravelPackageServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any package services.
     *
     * Publishes the package config file to the application's config directory.
     */
    public function boot()
    {
        // Publish config for artisan vendor:publish
        $this->publishes([
            __DIR__.'/../config/sandbox-laravel-package.php' => config_path('sandbox-laravel-package.php'),
        ], 'config');
    }

    /**
     * Register any application services.
     *
     * Merges the package config with the application's config.
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/sandbox-laravel-package.php',
            'sandbox-laravel-package'
        );
    }
}

// Helper for config_path to support non-Laravel environments (e.g., during testing)
if (!function_exists('config_path')) {
    function config_path($path = '') {
        return __DIR__ . '/../config' . ($path ? DIRECTORY_SEPARATOR . $path : $path);
    }
}
