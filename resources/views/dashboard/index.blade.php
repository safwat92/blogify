<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-gray-100 text-gray-900 min-h-screen flex flex-col justify-between">
        <!-- Page Content -->
        <main class="max-w-4xl w-full mx-auto p-4 sm:p-8 flex-1 flex flex-col justify-center items-center">
            <h1 class="text-3xl font-bold mb-6 text-gray-800">{{ __('Dashboard') }}</h1>
            <form action="{{ route('logout') }}" method="post">
                @csrf
                <button type="submit" class="px-5 py-2.5 bg-red-600 hover:bg-red-700 text-white font-medium rounded-lg transition-colors shadow-sm">
                    {{ __('Logout') }}
                </button>
            </form>
        </main>
    </body>
</html>
