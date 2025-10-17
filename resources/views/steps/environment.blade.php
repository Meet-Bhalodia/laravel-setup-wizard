@extends('wizard-installer::layouts.app')

@section('content')
<div class="bg-white rounded-lg shadow-sm border">
    <div class="px-6 py-8">
        <div class="mb-8">
            <h1 class="text-2xl font-bold text-gray-900 mb-2">Environment Setup</h1>
            <p class="text-gray-600">
                Configure your application environment settings. These values will be saved to your .env file.
            </p>
        </div>

        <form method="POST" action="{{ route('install.environment.process') }}" class="space-y-6">
            @csrf
            
            <!-- Application Settings -->
            <div class="bg-gray-50 rounded-lg p-6">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Application Settings</h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="app_name" class="block text-sm font-medium text-gray-700 mb-2">
                            Application Name
                        </label>
                        <input type="text" 
                               id="app_name" 
                               name="app_name" 
                               value="{{ old('app_name', config('app.name', 'Laravel')) }}"
                               class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('app_name') border-red-300 @enderror"
                               required>
                        @error('app_name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="app_url" class="block text-sm font-medium text-gray-700 mb-2">
                            Application URL
                        </label>
                        <input type="url" 
                               id="app_url" 
                               name="app_url" 
                               value="{{ old('app_url', config('app.url', 'http://localhost')) }}"
                               class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('app_url') border-red-300 @enderror"
                               required>
                        @error('app_url')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Database Settings -->
            <div class="bg-gray-50 rounded-lg p-6">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Database Settings</h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="db_connection" class="block text-sm font-medium text-gray-700 mb-2">
                            Database Connection
                        </label>
                        <select id="db_connection" 
                                name="db_connection" 
                                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('db_connection') border-red-300 @enderror">
                            <option value="mysql" {{ old('db_connection', 'mysql') == 'mysql' ? 'selected' : '' }}>MySQL</option>
                            <option value="pgsql" {{ old('db_connection') == 'pgsql' ? 'selected' : '' }}>PostgreSQL</option>
                            <option value="sqlite" {{ old('db_connection') == 'sqlite' ? 'selected' : '' }}>SQLite</option>
                        </select>
                        @error('db_connection')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="db_host" class="block text-sm font-medium text-gray-700 mb-2">
                            Database Host
                        </label>
                        <input type="text" 
                               id="db_host" 
                               name="db_host" 
                               value="{{ old('db_host', '127.0.0.1') }}"
                               class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('db_host') border-red-300 @enderror"
                               required>
                        @error('db_host')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="db_port" class="block text-sm font-medium text-gray-700 mb-2">
                            Database Port
                        </label>
                        <input type="number" 
                               id="db_port" 
                               name="db_port" 
                               value="{{ old('db_port', '3306') }}"
                               class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('db_port') border-red-300 @enderror"
                               required>
                        @error('db_port')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="db_database" class="block text-sm font-medium text-gray-700 mb-2">
                            Database Name
                        </label>
                        <input type="text" 
                               id="db_database" 
                               name="db_database" 
                               value="{{ old('db_database', 'laravel') }}"
                               class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('db_database') border-red-300 @enderror"
                               required>
                        @error('db_database')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="db_username" class="block text-sm font-medium text-gray-700 mb-2">
                            Database Username
                        </label>
                        <input type="text" 
                               id="db_username" 
                               name="db_username" 
                               value="{{ old('db_username', 'root') }}"
                               class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('db_username') border-red-300 @enderror"
                               required>
                        @error('db_username')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="db_password" class="block text-sm font-medium text-gray-700 mb-2">
                            Database Password
                        </label>
                        <input type="password" 
                               id="db_password" 
                               name="db_password" 
                               value="{{ old('db_password') }}"
                               class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('db_password') border-red-300 @enderror">
                        @error('db_password')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex justify-between">
                <a href="{{ route('install.welcome') }}" 
                   class="inline-flex items-center px-6 py-3 border border-gray-300 text-base font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-150 ease-in-out">
                    <svg class="mr-2 -ml-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd"></path>
                    </svg>
                    Back
                </a>

                <button type="submit" 
                        class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-150 ease-in-out">
                    Continue to Database Setup
                    <svg class="ml-2 -mr-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                    </svg>
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
