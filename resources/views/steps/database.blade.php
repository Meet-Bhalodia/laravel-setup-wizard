@extends('wizard-installer::layouts.app')

@section('content')
<div class="bg-white rounded-lg shadow-sm border">
    <div class="px-6 py-8">
        <div class="mb-8">
            <h1 class="text-2xl font-bold text-gray-900 mb-2">Database Setup</h1>
            <p class="text-gray-600">
                Test your database connection and run the necessary migrations to set up your database.
            </p>
        </div>

        <!-- Database Connection Test -->
        <div class="bg-gray-50 rounded-lg p-6 mb-6">
            <h2 class="text-lg font-semibold text-gray-900 mb-4">Database Connection Test</h2>
            
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600">
                        Test the database connection with your configured settings.
                    </p>
                </div>
                <button type="button" 
                        id="test-connection-btn"
                        class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-150 ease-in-out">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    Test Connection
                </button>
            </div>

            <!-- Connection Status -->
            <div id="connection-status" class="mt-4 hidden">
                <div class="rounded-md p-4">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg id="connection-icon" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <!-- Success icon -->
                                <path id="success-icon" fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                <!-- Error icon -->
                                <path id="error-icon" class="hidden" fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p id="connection-message" class="text-sm font-medium"></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Database Migrations -->
        <div class="bg-gray-50 rounded-lg p-6">
            <h2 class="text-lg font-semibold text-gray-900 mb-4">Database Migrations</h2>
            
            <div class="mb-4">
                <p class="text-sm text-gray-600 mb-4">
                    Run the database migrations to create the necessary tables for your application.
                </p>
                
                <div class="bg-white rounded-md p-4 border">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-blue-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-gray-700">
                                This will run <code class="bg-gray-100 px-1 py-0.5 rounded text-xs">php artisan migrate</code> to set up your database tables.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <form method="POST" action="{{ route('install.database.migrate') }}" id="migrate-form">
                @csrf
                <button type="submit" 
                        id="migrate-btn"
                        class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition duration-150 ease-in-out">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path>
                    </svg>
                    Run Migrations
                </button>
            </form>
        </div>

        <!-- Action Buttons -->
        <div class="flex justify-between mt-8">
            <a href="{{ route('install.environment') }}" 
               class="inline-flex items-center px-6 py-3 border border-gray-300 text-base font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-150 ease-in-out">
                <svg class="mr-2 -ml-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd"></path>
                </svg>
                Back
            </a>

            <a href="{{ route('install.admin') }}" 
               id="continue-btn"
               class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-150 ease-in-out opacity-50 cursor-not-allowed"
               style="pointer-events: none;">
                Continue to Admin Setup
                <svg class="ml-2 -mr-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                </svg>
            </a>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const testBtn = document.getElementById('test-connection-btn');
    const migrateBtn = document.getElementById('migrate-btn');
    const continueBtn = document.getElementById('continue-btn');
    const statusDiv = document.getElementById('connection-status');
    const messageEl = document.getElementById('connection-message');
    const successIcon = document.getElementById('success-icon');
    const errorIcon = document.getElementById('error-icon');
    const connectionIcon = document.getElementById('connection-icon');

    let connectionTested = false;
    let migrationsRun = false;

    // Test database connection
    testBtn.addEventListener('click', function() {
        testBtn.disabled = true;
        testBtn.innerHTML = '<svg class="animate-spin -ml-1 mr-3 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>Testing...';

        fetch('{{ route("install.database.test") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                db_connection: '{{ config("database.default") }}',
                db_host: '{{ config("database.connections." . config("database.default") . ".host") }}',
                db_port: '{{ config("database.connections." . config("database.default") . ".port") }}',
                db_database: '{{ config("database.connections." . config("database.default") . ".database") }}',
                db_username: '{{ config("database.connections." . config("database.default") . ".username") }}',
                db_password: '{{ config("database.connections." . config("database.default") . ".password") }}'
            })
        })
        .then(response => response.json())
        .then(data => {
            statusDiv.classList.remove('hidden');
            
            if (data.success) {
                statusDiv.querySelector('.rounded-md').className = 'rounded-md p-4 bg-green-50 border border-green-200';
                connectionIcon.className = 'h-5 w-5 text-green-400';
                successIcon.classList.remove('hidden');
                errorIcon.classList.add('hidden');
                messageEl.textContent = data.message;
                messageEl.className = 'text-sm font-medium text-green-800';
                connectionTested = true;
                updateContinueButton();
            } else {
                statusDiv.querySelector('.rounded-md').className = 'rounded-md p-4 bg-red-50 border border-red-200';
                connectionIcon.className = 'h-5 w-5 text-red-400';
                successIcon.classList.add('hidden');
                errorIcon.classList.remove('hidden');
                messageEl.textContent = data.message;
                messageEl.className = 'text-sm font-medium text-red-800';
            }
        })
        .catch(error => {
            statusDiv.classList.remove('hidden');
            statusDiv.querySelector('.rounded-md').className = 'rounded-md p-4 bg-red-50 border border-red-200';
            connectionIcon.className = 'h-5 w-5 text-red-400';
            successIcon.classList.add('hidden');
            errorIcon.classList.remove('hidden');
            messageEl.textContent = 'Connection test failed: ' + error.message;
            messageEl.className = 'text-sm font-medium text-red-800';
        })
        .finally(() => {
            testBtn.disabled = false;
            testBtn.innerHTML = '<svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>Test Connection';
        });
    });

    // Handle migration form submission
    document.getElementById('migrate-form').addEventListener('submit', function(e) {
        e.preventDefault();
        
        migrateBtn.disabled = true;
        migrateBtn.innerHTML = '<svg class="animate-spin -ml-1 mr-3 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>Running...';

        fetch(this.action, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => {
            if (response.ok) {
                migrationsRun = true;
                updateContinueButton();
                migrateBtn.innerHTML = '<svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>Migrations Complete';
                migrateBtn.className = 'inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-green-600 cursor-not-allowed';
            } else {
                throw new Error('Migration failed');
            }
        })
        .catch(error => {
            migrateBtn.disabled = false;
            migrateBtn.innerHTML = '<svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>Run Migrations';
            alert('Migration failed: ' + error.message);
        });
    });

    function updateContinueButton() {
        if (connectionTested && migrationsRun) {
            continueBtn.classList.remove('opacity-50');
            continueBtn.style.pointerEvents = 'auto';
        }
    }
});
</script>
@endpush
