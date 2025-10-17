<?php

namespace meet-bhalodia\WizardInstaller\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Symfony\Component\HttpFoundation\Response;

/**
 * Installation Middleware
 * 
 * Prevents access to the installation wizard if the app is already installed.
 * Checks for the existence of the lock file (storage/installed by default).
 */
class InstallationMiddleware
{
    /**
     * Handle an incoming request.
     * 
     * Redirects to home if installation is already complete.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Get the lock file path from config
        $lockFile = config('wizard-installer.lock_file');
        
        // If installation is complete (lock file exists), redirect away from installer
        if (File::exists($lockFile)) {
            return redirect('/');
        }

        // Allow access to installer
        return $next($request);
    }
}
