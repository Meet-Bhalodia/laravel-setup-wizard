<?php

namespace MeetBhalodia\SetupWizard\Helpers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Config;
use Exception;

class DatabaseHelper
{
    /**
     * Test database connection with provided credentials.
     */
    public function testConnection(array $credentials): void
    {
        $config = [
            'driver' => $credentials['db_connection'],
            'host' => $credentials['db_host'],
            'port' => $credentials['db_port'],
            'database' => $credentials['db_database'],
            'username' => $credentials['db_username'],
            'password' => $credentials['db_password'],
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
        ];

        // Set temporary database configuration
        Config::set('database.connections.test', $config);

        try {
            DB::connection('test')->getPdo();
        } catch (Exception $e) {
            throw new Exception('Database connection failed: ' . $e->getMessage());
        }
    }

    /**
     * Create admin user.
     */
    public function createAdminUser(array $userData): object
    {
        $userClass = config('auth.providers.users.model', 'App\\Models\\User');
        
        if (!class_exists($userClass)) {
            throw new Exception('User model not found. Please ensure you have a User model.');
        }

        $user = new $userClass();
        $user->name = $userData['name'];
        $user->email = $userData['email'];
        $user->password = Hash::make($userData['password']);
        $user->email_verified_at = now();
        $user->save();

        return $user;
    }

    /**
     * Check if users table exists.
     */
    public function usersTableExists(): bool
    {
        try {
            return DB::getSchemaBuilder()->hasTable('users');
        } catch (Exception $e) {
            return false;
        }
    }

    /**
     * Get database connection status.
     */
    public function getConnectionStatus(): array
    {
        try {
            DB::connection()->getPdo();
            return [
                'connected' => true,
                'message' => 'Database connection successful'
            ];
        } catch (Exception $e) {
            return [
                'connected' => false,
                'message' => 'Database connection failed: ' . $e->getMessage()
            ];
        }
    }
}
