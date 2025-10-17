<?php

namespace YourName\WizardInstaller\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use YourName\WizardInstaller\Http\Controllers\InstallationController;
use YourName\WizardInstaller\Http\Middleware\InstallationMiddleware;
use YourName\WizardInstaller\Console\Commands\InstallCommand;
use YourName\WizardInstaller\Console\Commands\UninstallCommand;

/**
 * Wizard Installer Service Provider
 * 
 * Registers all package components including routes, views, config,
 * middleware, and artisan commands for the Laravel installation wizard.
 */
class WizardServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     * 
     * Merges package configuration with application config.
     */
    public function register(): void
    {
        // Merge package config with application config
        $this->mergeConfigFrom(
            __DIR__.'/../../config/wizard-installer.php',
            'wizard-installer'
        );
    }

    /**
     * Bootstrap services.
     * 
     * Publishes assets, registers routes, middleware, and commands.
     */
    public function boot(): void
    {
        // Publish configuration with 'wizard-config' tag
        $this->publishes([
            __DIR__.'/../../config/wizard-installer.php' => config_path('wizard-installer.php'),
        ], 'wizard-config');

        // Publish views with 'wizard-views' tag
        $this->publishes([
            __DIR__.'/../../resources/views' => resource_path('views/vendor/wizard-installer'),
        ], 'wizard-views');

        // Load package views from resources/views
        $this->loadViewsFrom(__DIR__.'/../../resources/views', 'wizard-installer');

        // Register installation middleware
        $this->app['router']->aliasMiddleware('wizard.installed', InstallationMiddleware::class);

        // Register installation routes
        $this->registerRoutes();

        // Register artisan commands (only in console)
        if ($this->app->runningInConsole()) {
            $this->commands([
                InstallCommand::class,
                UninstallCommand::class,
            ]);
        }
    }

    /**
     * Register the package routes.
     * 
     * All routes are prefixed with the configured route_prefix (default: 'install')
     * and use the 'web' middleware group.
     */
    protected function registerRoutes(): void
    {
        Route::group([
            'prefix' => config('wizard-installer.route_prefix', 'install'),
            'middleware' => ['web'],
            'namespace' => 'YourName\\WizardInstaller\\Http\\Controllers',
        ], function () {
            $this->loadRoutesFrom(__DIR__.'/../../routes/web.php');
        });
    }
}
