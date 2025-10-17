<?php

namespace MeetBhalodia\SetupWizard\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use MeetBhalodia\SetupWizard\Http\Controllers\InstallationController;
use MeetBhalodia\SetupWizard\Http\Middleware\InstallationMiddleware;
use MeetBhalodia\SetupWizard\Console\Commands\InstallCommand;
use MeetBhalodia\SetupWizard\Console\Commands\UninstallCommand;

/**
 * Wizard Installer Service Provider
 * 
 * Registers all package components including routes, views, config,
 * middleware, and artisan commands for the Laravel installation wizard.
 */
class SetupWizardServiceProvider extends ServiceProvider
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
            __DIR__.'/../../config/setup-wizard.php',
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
            __DIR__.'/../../resources/views' => resource_path('views/vendor/setup-wizard'),
        ], 'wizard-views');

        // Load package views from resources/views
        $this->loadViewsFrom(__DIR__.'/../../resources/views', 'setup-wizard');

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
            'prefix' => config('setup-wizard.route_prefix', 'install'),
            'middleware' => ['web'],
            'namespace' => 'MeetBhalodia\\SetupWizard\\Http\\Controllers',
        ], function () {
            $this->loadRoutesFrom(__DIR__.'/../../routes/web.php');
        });
    }
}
