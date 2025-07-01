<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token for form security -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Page Title -->
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Google Fonts or Bunny Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Vite Assets (Tailwind + JS) -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

  
    {{-- <script src="https://cdn.tailwindcss.com"></script> --}}
</head>
<body class="font-sans antialiased">

    <!-- Full Page Background Gradient -->
    <div class="min-h-screen bg-gradient-to-br from-indigo-500 to-violet-600">

        <!-- Navigation -->
        @include('layouts.navigation')

        <!-- Optional Page Header Section -->
        @isset($header)
            <header class="bg-gradient-to-br from-indigo-500 to-violet-600 shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endisset
        <!--sidebar-->
        <div class="flex">
            @auth 
            @include('components.sidebar')
            @endauth
        

        <!-- Main Page Content -->
        <main class="flex-1 p">
            {{ $slot }}
        </main>
        </div>
    </div>
</body>
</html>
