<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
        @section('title')
            {{ isset($title) ? $title : '' }}
        @show
        @if (!empty(trim($__env->yieldContent('title'))))
            {{ __(' - ') }}
        @endif
        {{ config('app.name', 'Ecommerce') }}
    </title>

    {{-- All Css  --}}
    @include('backend.admin.layouts.src.css')

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            @if (session('success'))
                showAlert('success', '{{ session('success') }}');
            @endif

            @if (session('error'))
                showAlert('error', '{{ session('error') }}');
            @endif

            @if (session('warning'))
                showAlert('warning', '{{ session('warning') }}');
            @endif
        });
    </script>
</head>

<body>
    <div class="wrapper">
        {{--  Sidebar  --}}
        @include('backend.admin.layouts.partials.sidebar')
        {{-- End sidebar --}}

        <div class="main-panel">

            {{-- Header --}}
            @include('backend.admin.layouts.partials.header')
            {{-- End Header --}}

            {{-- Main Content --}}
            <div class="container">
                <div class="page-inner">
                    @yield('content')
                </div>
            </div>
            {{-- End Main Content --}}

            {{-- Footer --}}
            @include('backend.admin.layouts.partials.footer')
            {{-- End Footer --}}
        </div>
    </div>

    {{-- All Scripts --}}
    @include('backend.admin.layouts.src.js')
</body>

</html>
