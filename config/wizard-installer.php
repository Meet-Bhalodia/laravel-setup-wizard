<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Installation Route Prefix
    |--------------------------------------------------------------------------
    |
    | The prefix for all installation routes. Default is 'install'.
    |
    */
    'route_prefix' => env('WIZARD_INSTALLER_PREFIX', 'install'),

    /*
    |--------------------------------------------------------------------------
    | Installation Steps
    |--------------------------------------------------------------------------
    |
    | Define the steps that will be shown in the installation wizard.
    |
    */
    'steps' => [
        'welcome' => [
            'title' => 'Welcome',
            'description' => 'Welcome to the installation wizard',
            'view' => 'wizard-installer::steps.welcome',
        ],
        'environment' => [
            'title' => 'Environment Setup',
            'description' => 'Configure your application environment',
            'view' => 'wizard-installer::steps.environment',
        ],
        'database' => [
            'title' => 'Database Setup',
            'description' => 'Configure database connection and run migrations',
            'view' => 'wizard-installer::steps.database',
        ],
        'admin' => [
            'title' => 'Admin User',
            'description' => 'Create your admin user account',
            'view' => 'wizard-installer::steps.admin',
        ],
        'complete' => [
            'title' => 'Installation Complete',
            'description' => 'Your application is ready to use',
            'view' => 'wizard-installer::steps.complete',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Installation Requirements
    |--------------------------------------------------------------------------
    |
    | Define the minimum requirements for installation.
    |
    */
    'requirements' => [
        'php_version' => '8.2.0',
        'extensions' => [
            'openssl',
            'pdo',
            'mbstring',
            'tokenizer',
            'xml',
            'ctype',
            'json',
            'bcmath',
        ],
        'permissions' => [
            'storage' => 'storage/',
            'bootstrap/cache' => 'bootstrap/cache/',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Installation Lock File
    |--------------------------------------------------------------------------
    |
    | The file that will be created to lock the installation process.
    |
    */
    'lock_file' => storage_path('app/installed.lock'),

    /*
    |--------------------------------------------------------------------------
    | Default Admin User
    |--------------------------------------------------------------------------
    |
    | Default values for the admin user creation step.
    |
    */
    'default_admin' => [
        'name' => 'Administrator',
        'email' => 'admin@example.com',
    ],

    /*
    |--------------------------------------------------------------------------
    | Styling Options
    |--------------------------------------------------------------------------
    |
    | Customize the appearance of the installation wizard.
    |
    */
    'styling' => [
        'primary_color' => '#3b82f6', // Blue
        'success_color' => '#10b981', // Green
        'error_color' => '#ef4444',   // Red
        'warning_color' => '#f59e0b', // Amber
    ],

    /*
    |--------------------------------------------------------------------------
    | Storage Path
    |--------------------------------------------------------------------------
    |
    | The path where the installation lock file will be stored.
    | Default: storage/installed (relative to storage_path())
    |
    */
    'storage_path' => env('WIZARD_STORAGE_PATH', 'installed'),
];
