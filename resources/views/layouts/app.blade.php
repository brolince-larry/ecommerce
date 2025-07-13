<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <!-- Page Title -->
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Vite Assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-100 text-gray-900">

    <!-- Page Wrapper -->
    <div class="min-h-screen flex flex-col">

        <!-- Top Navigation -->
        @include('layouts.navigation')

        <!-- Page Header (optional) -->
        @isset($header)
            <header class="bg-gray-300 shadow-sm border-b border-gray-400">
                <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endisset

        <!-- Responsive Layout: Sidebar + Content -->
        <div class="flex flex-1 min-h-0">
            
            <!-- Sidebar (hidden on small screens) -->
            @auth
                <aside class="hidden md:block w-64 bg-white shadow border-r border-gray-200">
                    @include('components.sidebar')
                </aside>
            @endauth

            <!-- Main Content Area -->
            <main class="flex-1 p-4 sm:p-6 md:p-8 overflow-y-auto">
                
               
                {{ $slot }}
            </main>
        </div>

    </div>

</body>
</html>
