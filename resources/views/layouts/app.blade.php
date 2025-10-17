<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - Installation Wizard</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- TailwindCSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Custom Styles -->
    <style>
        .step-indicator {
            transition: all 0.3s ease;
        }
        .step-indicator.active {
            background-color: #3b82f6;
            color: white;
        }
        .step-indicator.completed {
            background-color: #10b981;
            color: white;
        }
    </style>
</head>
<body class="bg-gray-50 min-h-screen">
    <div class="min-h-screen flex flex-col">
        <!-- Header -->
        <header class="bg-white shadow-sm border-b">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center py-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <h1 class="text-2xl font-bold text-gray-900">
                                {{ config('app.name', 'Laravel') }}
                            </h1>
                        </div>
                    </div>
                    <div class="text-sm text-gray-500">
                        Installation Wizard
                    </div>
                </div>
            </div>
        </header>

        <!-- Progress Bar -->
        <div class="bg-white border-b">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="py-4">
                    <div class="flex items-center justify-between">
                        @php
                            $steps = config('wizard-installer.steps');
                            $currentStep = request()->route()->getName();
                            $stepNames = array_keys($steps);
                            $currentIndex = array_search(str_replace('install.', '', $currentStep), $stepNames);
                        @endphp
                        
                        @foreach($steps as $key => $step)
                            <div class="flex items-center">
                                <div class="step-indicator flex items-center justify-center w-8 h-8 rounded-full border-2 border-gray-300 text-sm font-medium
                                    @if($currentIndex !== false && array_search($key, $stepNames) <= $currentIndex) active @endif
                                    @if($currentIndex !== false && array_search($key, $stepNames) < $currentIndex) completed @endif">
                                    @if($currentIndex !== false && array_search($key, $stepNames) < $currentIndex)
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                        </svg>
                                    @else
                                        {{ array_search($key, $stepNames) + 1 }}
                                    @endif
                                </div>
                                <div class="ml-3 hidden sm:block">
                                    <p class="text-sm font-medium text-gray-900">{{ $step['title'] }}</p>
                                    <p class="text-xs text-gray-500">{{ $step['description'] }}</p>
                                </div>
                            </div>
                            
                            @if(!$loop->last)
                                <div class="hidden sm:block flex-1 mx-4">
                                    <div class="h-0.5 bg-gray-200"></div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <main class="flex-1">
            <div class="max-w-4xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
                @if(session('success'))
                    <div class="mb-6 bg-green-50 border border-green-200 rounded-md p-4">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-green-800">{{ session('success') }}</p>
                            </div>
                        </div>
                    </div>
                @endif

                @if(session('error'))
                    <div class="mb-6 bg-red-50 border border-red-200 rounded-md p-4">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-red-800">{{ session('error') }}</p>
                            </div>
                        </div>
                    </div>
                @endif

                @yield('content')
            </div>
        </main>

        <!-- Footer -->
        <footer class="bg-white border-t">
            <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center">
                    <div class="text-sm text-gray-500">
                        Laravel Wizard Installer v1.0.0
                    </div>
                    <div class="text-sm text-gray-500">
                        Made with ❤️ for Laravel
                    </div>
                </div>
            </div>
        </footer>
    </div>

    <!-- JavaScript -->
    <script>
        // CSRF Token for AJAX requests
        window.Laravel = {
            csrfToken: '{{ csrf_token() }}'
        };

        // Add CSRF token to all AJAX requests
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    
    @stack('scripts')
</body>
</html>
