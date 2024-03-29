<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            @include('layouts.navigation')

            @if (isset($header))
                <header class="bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            @if (session('success'))
                <div class="pt-6 max-w-7xl mx-auto sm:px-6 lg:px-8 transition-opacity ease-out duration-300">
                    <div class="bg-green-500 overflow-hidden shadow-sm sm:rounded-lg">
                        <p class="p-6 text-lg font-medium text-gray-100" role="alert">
                            {{ session('success') }}
                        </p>
                    </div>
                </div>
            @endif
            @if (session('error'))
                <div class="pt-6 max-w-7xl mx-auto sm:px-6 lg:px-8 transition-opacity ease-out duration-300">
                    <div class="bg-red-600 overflow-hidden shadow-sm sm:rounded-lg">
                        <p class="p-6 text-lg font-medium text-gray-100" role="alert">
                            {{ session('error') }}
                        </p>
                    </div>
                </div>
            @endif
            <main>
                {{ $slot }}
            </main>
        </div>
    </body>
</html>