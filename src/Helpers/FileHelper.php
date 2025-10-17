<?php

namespace MeetBhalodia\SetupWizard\Helpers;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class FileHelper
{
    /**
     * Create setup lock file.
     */
    public function createInstallationLock(): void
    {
        $lockFile = config('setup-wizard.lock_file');
        $lockContent = json_encode([
            'installed_at' => now()->toISOString(),
            'version' => '1.0.0',
            'app_name' => config('app.name'),
        ], JSON_PRETTY_PRINT);

        File::put($lockFile, $lockContent);
    }

    /**
     * Remove setup lock file.
     */
    public function removeInstallationLock(): void
    {
        $lockFile = config('setup-wizard.lock_file');
        
        if (File::exists($lockFile)) {
            File::delete($lockFile);
        }
    }

    /**
     * Check if setup is complete.
     */
    public function isInstalled(): bool
    {
        $lockFile = config('setup-wizard.lock_file');
        return File::exists($lockFile);
    }

    /**
     * Get setup information.
     */
    public function getInstallationInfo(): ?array
    {
        $lockFile = config('setup-wizard.lock_file');
        
        if (!File::exists($lockFile)) {
            return null;
        }

        $content = File::get($lockFile);
        return json_decode($content, true);
    }

    /**
     * Ensure storage directories exist and are writable.
     */
    public function ensureStorageDirectories(): array
    {
        $directories = [
            'storage/app',
            'storage/framework/cache',
            'storage/framework/sessions',
            'storage/framework/views',
            'storage/logs',
            'bootstrap/cache',
        ];

        $results = [];

        foreach ($directories as $directory) {
            $fullPath = base_path($directory);
            
            if (!File::exists($fullPath)) {
                File::makeDirectory($fullPath, 0755, true);
            }

            $results[$directory] = [
                'exists' => File::exists($fullPath),
                'writable' => is_writable($fullPath),
                'path' => $fullPath,
            ];
        }

        return $results;
    }

    /**
     * Set proper permissions for storage directories.
     */
    public function setStoragePermissions(): void
    {
        $directories = [
            'storage/app',
            'storage/framework/cache',
            'storage/framework/sessions',
            'storage/framework/views',
            'storage/logs',
            'bootstrap/cache',
        ];

        foreach ($directories as $directory) {
            $fullPath = base_path($directory);
            
            if (File::exists($fullPath)) {
                chmod($fullPath, 0755);
            }
        }
    }
}
