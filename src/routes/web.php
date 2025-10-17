<?php

use Illuminate\Support\Facades\Route;
use meet-bhalodia\WizardInstaller\Http\Controllers\InstallationController;

/*
|--------------------------------------------------------------------------
| Installation Wizard Routes
|--------------------------------------------------------------------------
|
| These routes handle the installation wizard process.
| All routes are prefixed with '/install' (configurable in wizard-installer.php)
| and protected by 'wizard.installed' middleware to prevent access after installation.
|
*/

Route::middleware(['wizard.installed'])->group(function () {
    // Step 1: Welcome - System requirements check
    Route::get('/', [InstallationController::class, 'welcome'])
        ->name('install.welcome');
    
    // Step 2: Environment Setup - Configure .env file
    Route::get('/environment', [InstallationController::class, 'environment'])
        ->name('install.environment');
    Route::post('/environment', [InstallationController::class, 'processEnvironment'])
        ->name('install.environment.process');
    
    // Step 3: Database Setup - Test connection and run migrations
    Route::get('/database', [InstallationController::class, 'database'])
        ->name('install.database');
    Route::post('/database/test', [InstallationController::class, 'testDatabase'])
        ->name('install.database.test');
    Route::post('/database/migrate', [InstallationController::class, 'runMigrations'])
        ->name('install.database.migrate');
    
    // Step 4: Admin User - Create administrator account
    Route::get('/admin', [InstallationController::class, 'admin'])
        ->name('install.admin');
    Route::post('/admin', [InstallationController::class, 'processAdmin'])
        ->name('install.admin.process');
    
    // Step 5: Complete - Installation finished
    Route::get('/complete', [InstallationController::class, 'complete'])
        ->name('install.complete');
});
