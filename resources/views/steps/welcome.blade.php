@extends('wizard-installer::layouts.app')

@section('content')
<div class="bg-white rounded-lg shadow-sm border">
    <div class="px-6 py-8">
        <div class="text-center">
            <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-blue-100 mb-6">
                <svg class="h-8 w-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                </svg>
            </div>
            
            <h1 class="text-3xl font-bold text-gray-900 mb-4">
                Welcome to {{ config('app.name', 'Laravel') }}
            </h1>
            
            <p class="text-lg text-gray-600 mb-8">
                This wizard will guide you through the installation process. 
                Let's get your application up and running in just a few steps.
            </p>
        </div>

        <!-- System Requirements -->
        <div class="mt-8">
            <h2 class="text-xl font-semibold text-gray-900 mb-4">System Requirements</h2>
            
            <!-- PHP Version -->
            <div class="mb-6">
                <div class="flex items-center justify-between mb-2">
                    <span class="text-sm font-medium text-gray-700">PHP Version</span>
                    <span class="text-sm {{ $requirements['php_version']['passed'] ? 'text-green-600' : 'text-red-600' }}">
                        {{ $requirements['php_version']['current'] }}
                        @if($requirements['php_version']['passed'])
                            <svg class="inline w-4 h-4 ml-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                        @else
                            <svg class="inline w-4 h-4 ml-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                            </svg>
                        @endif
                    </span>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-2">
                    <div class="bg-{{ $requirements['php_version']['passed'] ? 'green' : 'red' }}-500 h-2 rounded-full" style="width: 100%"></div>
                </div>
                <p class="text-xs text-gray-500 mt-1">
                    Required: {{ $requirements['php_version']['required'] }} or higher
                </p>
            </div>

            <!-- PHP Extensions -->
            <div class="mb-6">
                <h3 class="text-sm font-medium text-gray-700 mb-3">PHP Extensions</h3>
                <div class="grid grid-cols-2 gap-2">
                    @foreach($requirements['extensions'] as $extension => $status)
                        <div class="flex items-center">
                            <span class="text-sm text-gray-600">{{ $extension }}</span>
                            <span class="ml-auto">
                                @if($status['passed'])
                                    <svg class="w-4 h-4 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                    </svg>
                                @else
                                    <svg class="w-4 h-4 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                                    </svg>
                                @endif
                            </span>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Directory Permissions -->
            <div class="mb-6">
                <h3 class="text-sm font-medium text-gray-700 mb-3">Directory Permissions</h3>
                <div class="space-y-2">
                    @foreach($requirements['permissions'] as $path => $status)
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-600">{{ $status['description'] }}</span>
                            <span class="text-sm {{ $status['writable'] ? 'text-green-600' : 'text-red-600' }}">
                                {{ $status['writable'] ? 'Writable' : 'Not Writable' }}
                                @if($status['writable'])
                                    <svg class="inline w-4 h-4 ml-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                    </svg>
                                @else
                                    <svg class="inline w-4 h-4 ml-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                                    </svg>
                                @endif
                            </span>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex justify-end mt-8">
            @php
                $allRequirementsMet = $requirements['php_version']['passed'] && 
                                    collect($requirements['extensions'])->every('passed') && 
                                    collect($requirements['permissions'])->every('writable');
            @endphp
            
            @if($allRequirementsMet)
                <a href="{{ route('install.environment') }}" 
                   class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-150 ease-in-out">
                    Continue to Environment Setup
                    <svg class="ml-2 -mr-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                    </svg>
                </a>
            @else
                <div class="text-center">
                    <p class="text-red-600 text-sm mb-4">Please fix the requirements above before continuing.</p>
                    <button disabled class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-gray-400 bg-gray-200 cursor-not-allowed">
                        Continue to Environment Setup
                    </button>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
