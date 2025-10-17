@extends('wizard-installer::layouts.app')

@section('content')
<div class="bg-white rounded-lg shadow-sm border">
    <div class="px-6 py-8">
        <div class="text-center">
            <!-- Success Icon -->
            <div class="mx-auto flex items-center justify-center h-20 w-20 rounded-full bg-green-100 mb-6">
                <svg class="h-10 w-10 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
            </div>
            
            <h1 class="text-3xl font-bold text-gray-900 mb-4">
                Installation Complete!
            </h1>
            
            <p class="text-lg text-gray-600 mb-8">
                Congratulations! Your {{ config('app.name', 'Laravel') }} application has been successfully installed and configured.
            </p>
        </div>

        <!-- Installation Summary -->
        <div class="bg-gray-50 rounded-lg p-6 mb-8">
            <h2 class="text-lg font-semibold text-gray-900 mb-4">Installation Summary</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="flex items-center">
                    <svg class="w-5 h-5 text-green-500 mr-3" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                    </svg>
                    <span class="text-sm text-gray-700">Environment configuration</span>
                </div>
                
                <div class="flex items-center">
                    <svg class="w-5 h-5 text-green-500 mr-3" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                    </svg>
                    <span class="text-sm text-gray-700">Database connection established</span>
                </div>
                
                <div class="flex items-center">
                    <svg class="w-5 h-5 text-green-500 mr-3" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                    </svg>
                    <span class="text-sm text-gray-700">Database migrations completed</span>
                </div>
                
                <div class="flex items-center">
                    <svg class="w-5 h-5 text-green-500 mr-3" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                    </svg>
                    <span class="text-sm text-gray-700">Administrator account created</span>
                </div>
            </div>
        </div>

        <!-- Next Steps -->
        <div class="bg-blue-50 border border-blue-200 rounded-lg p-6 mb-8">
            <h2 class="text-lg font-semibold text-blue-900 mb-4">Next Steps</h2>
            
            <div class="space-y-3">
                <div class="flex items-start">
                    <div class="flex-shrink-0">
                        <div class="flex items-center justify-center h-6 w-6 rounded-full bg-blue-100 text-blue-600 text-sm font-medium">
                            1
                        </div>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-blue-800">
                            <strong>Remove the installer:</strong> For security reasons, you should remove the installer package from your application.
                        </p>
                    </div>
                </div>
                
                <div class="flex items-start">
                    <div class="flex-shrink-0">
                        <div class="flex items-center justify-center h-6 w-6 rounded-full bg-blue-100 text-blue-600 text-sm font-medium">
                            2
                        </div>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-blue-800">
                            <strong>Configure your application:</strong> Set up additional features, configure email settings, and customize your application.
                        </p>
                    </div>
                </div>
                
                <div class="flex items-start">
                    <div class="flex-shrink-0">
                        <div class="flex items-center justify-center h-6 w-6 rounded-full bg-blue-100 text-blue-600 text-sm font-medium">
                            3
                        </div>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-blue-800">
                            <strong>Deploy to production:</strong> When ready, deploy your application to your production server.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Security Notice -->
        <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-6 mb-8">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                    </svg>
                </div>
                <div class="ml-3">
                    <h3 class="text-sm font-medium text-yellow-800">Important Security Notice</h3>
                    <div class="mt-2 text-sm text-yellow-700">
                        <p>
                            <strong>For security reasons, you should remove the installer package from your application.</strong>
                            The installer routes are now disabled, but it's recommended to completely remove the package.
                        </p>
                        <p class="mt-2">
                            Run: <code class="bg-yellow-100 px-2 py-1 rounded text-xs">composer remove yourname/laravel-wizard-installer</code>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="text-center">
            <a href="{{ config('app.url') }}" 
               class="inline-flex items-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition duration-150 ease-in-out">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                </svg>
                Launch Your Application
            </a>
        </div>

        <!-- Installation Info -->
        <div class="mt-8 pt-6 border-t border-gray-200">
            <div class="text-center text-sm text-gray-500">
                <p>Installation completed on {{ now()->format('F j, Y \a\t g:i A') }}</p>
                <p class="mt-1">Laravel Wizard Installer v1.0.0</p>
            </div>
        </div>
    </div>
</div>
@endsection
