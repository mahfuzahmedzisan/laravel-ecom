<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="@yield('meta_description', 'Default description')">
    <meta name="keywords" content="@yield('meta_keywords', 'Default keywords')">

    {{-- Boxicons CDN Link --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/boxicons/2.1.0/css/boxicons.min.css" />

    <title>
        @section('title')
            {{ isset($title) ? $title : '' }}
        @show
        @if (!empty(trim($__env->yieldContent('title'))))
            {{ __(' - ') }}
        @endif
        {{ config('app.name', 'Ecommerce') }}
    </title>

    {{-- Custom CSS Link --}}
    @stack('css-links')


    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Custom CSS --}}
    @stack('css')

</head>

<body>
    @include('backend.user.layouts.partials.header')

    @yield('content')

    @include('backend.user.layouts.partials.footer')

    {{-- Boxicons CDN Link --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/boxicons/2.1.0/dist/boxicons.min.js"></script>
    {{-- Custom JS Links --}}
    @stack('js-links')
    {{-- Custom JS --}}
    @stack('js')
</body>

</html>
