<?php

namespace MeetBhalodia\SetupWizard\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use MeetBhalodia\SetupWizard\Helpers\EnvironmentHelper;
use MeetBhalodia\SetupWizard\Helpers\DatabaseHelper;
use MeetBhalodia\SetupWizard\Helpers\FileHelper;

/**
 * Installation Controller
 * 
 * Handles all steps of the Laravel setup wizard:
 * - Welcome screen with requirements check
 * - Environment configuration (.env file)
 * - Database connection testing and migrations
 * - Admin user creation
 * - Installation completion
 */
class InstallationController extends Controller
{
    /** @var EnvironmentHelper Helper for managing .env file */
    protected EnvironmentHelper $environmentHelper;
    
    /** @var DatabaseHelper Helper for database operations */
    protected DatabaseHelper $databaseHelper;
    
    /** @var FileHelper Helper for file system operations */
    protected FileHelper $fileHelper;

    /**
     * Constructor - Inject helper dependencies
     */
    public function __construct(
        EnvironmentHelper $environmentHelper,
        DatabaseHelper $databaseHelper,
        FileHelper $fileHelper
    ) {
        $this->environmentHelper = $environmentHelper;
        $this->databaseHelper = $databaseHelper;
        $this->fileHelper = $fileHelper;
    }

    /**
     * Show the installation welcome step.
     */
    public function welcome(): View
    {
        $requirements = $this->checkRequirements();
        
        return view('setup-wizard::steps.welcome', compact('requirements'));
    }

    /**
     * Show the environment setup step.
     */
    public function environment(): View
    {
        return view('setup-wizard::steps.environment');
    }

    /**
     * Process environment setup.
     */
    public function processEnvironment(Request $request): RedirectResponse
    {
        $request->validate([
            'app_name' => 'required|string|max:255',
            'app_url' => 'required|url',
            'db_connection' => 'required|string',
            'db_host' => 'required|string',
            'db_port' => 'required|integer',
            'db_database' => 'required|string',
            'db_username' => 'required|string',
            'db_password' => 'nullable|string',
        ]);

        $envData = $request->only([
            'app_name', 'app_url', 'db_connection', 'db_host',
            'db_port', 'db_database', 'db_username', 'db_password'
        ]);

        $this->environmentHelper->updateEnvironment($envData);

        return redirect()->route('install.database');
    }

    /**
     * Show the database setup step.
     */
    public function database(): View
    {
        return view('setup-wizard::steps.database');
    }

    /**
     * Test database connection.
     */
    public function testDatabase(Request $request)
    {
        $request->validate([
            'db_connection' => 'required|string',
            'db_host' => 'required|string',
            'db_port' => 'required|integer',
            'db_database' => 'required|string',
            'db_username' => 'required|string',
            'db_password' => 'nullable|string',
        ]);

        try {
            $this->databaseHelper->testConnection($request->all());
            return response()->json(['success' => true, 'message' => 'Database connection successful']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 400);
        }
    }

    /**
     * Run database migrations.
     */
    public function runMigrations(): RedirectResponse
    {
        try {
            Artisan::call('migrate', ['--force' => true]);
            return redirect()->route('install.admin');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Migration failed: ' . $e->getMessage());
        }
    }

    /**
     * Show the admin user creation step.
     */
    public function admin(): View
    {
        return view('setup-wizard::steps.admin');
    }

    /**
     * Process admin user creation.
     */
    public function processAdmin(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        try {
            $user = $this->databaseHelper->createAdminUser($request->all());
            
            // Create installation lock file
            $this->fileHelper->createInstallationLock();
            
            return redirect()->route('install.complete');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to create admin user: ' . $e->getMessage());
        }
    }

    /**
     * Show the installation complete step.
     */
    public function complete(): View
    {
        return view('setup-wizard::steps.complete');
    }

    /**
     * Check system requirements.
     */
    protected function checkRequirements(): array
    {
        $requirements = config('setup-wizard.requirements');
        $results = [];

        // Check PHP version
        $results['php_version'] = [
            'required' => $requirements['php_version'],
            'current' => PHP_VERSION,
            'passed' => version_compare(PHP_VERSION, $requirements['php_version'], '>=')
        ];

        // Check extensions
        $results['extensions'] = [];
        foreach ($requirements['extensions'] as $extension) {
            $results['extensions'][$extension] = [
                'required' => $extension,
                'passed' => extension_loaded($extension)
            ];
        }

        // Check permissions
        $results['permissions'] = [];
        foreach ($requirements['permissions'] as $path => $description) {
            $fullPath = base_path($path);
            $results['permissions'][$path] = [
                'path' => $fullPath,
                'writable' => is_writable($fullPath),
                'description' => $description
            ];
        }

        return $results;
    }
}
