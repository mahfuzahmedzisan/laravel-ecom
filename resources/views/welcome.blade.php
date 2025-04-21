<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Ecommerce') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    <!-- Styles / Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <div class="flex flex-col items-center justify-center min-h-screen py-4 bg-gray-100 sm:py-0">
        <div>
            <h1 class="text-4xl font-bold text-gray-800">Welcome to Laravel</h1>
            <p class="mt-2 text-lg text-gray-600 text-center">This is a simple Laravel application.</p>
        </div>

        <div class="mt-6">
            @auth('web')
                <a href="{{ route('user.dashboard') }}"
                    class="px-4 py-2 text-sm font-medium text-white bg-amber-600 border border-transparent rounded-md hover:bg-amber-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-amber-500">Dashboard</a>
            @else
                <a href="{{ route('login') }}"
                    class="px-4 py-2 text-sm font-medium text-white bg-indigo-600 border border-transparent rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Login</a>
                <a href="{{ route('register') }}"
                    class="ml-4 px-4 py-2 text-sm font-medium text-white bg-emerald-600 border border-transparent rounded-md hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500">Register</a>
            @endauth

            @auth('admin')
                <a href="{{ route('admin.dashboard') }}"
                    class="px-4 py-2 text-sm font-medium text-white bg-rose-600 border border-transparent rounded-md hover:bg-rose-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-rose-500">Admin
                    Dashboard</a>
            @else
                <a href="{{ route('admin.login') }}"
                    class="ml-4 px-4 py-2 text-sm font-medium text-white bg-purple-600 border border-transparent rounded-md hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500">Admin
                    Login</a>
            @endauth
        </div>
    </div>
</body>

</html>
