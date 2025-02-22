<!DOCTYPE html>
@include('elements.base')
@php
    $colorMap = [
        'red' => '#D44714',
        'green' => '#1AAC22',
        'blue' => '#517FB9',
        'orange' => '#F0B100',
    ];

    $theme = theme_config('color', 'orange');
    $themeColor = $colorMap[$theme] ?? $theme;
@endphp
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="@yield('description', setting('description', ''))">
    <meta name="theme-color" content="{{ $themeColor }}">
    <meta name="author" content="pkhemae,akira_fr">
    @if (str_starts_with(\Azuriom\Azuriom::version(), '1.0.'))
        <meta http-equiv="refresh" content="1">
        @php themes()->changeTheme(null); @endphp
    @endif
    <meta property="og:title" content="@yield('title')">
    <meta property="og:type" content="@yield('type', 'website')">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="{{ favicon() }}">
    <meta property="og:description" content="@yield('description', setting('description', ''))">
    <meta property="og:site_name" content="{{ site_name() }}">
    @stack('meta')

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') | {{ site_name() }}</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ favicon() }}">

    <!-- Scripts -->
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}" defer></script>
    <script src="{{ asset('vendor/axios/axios.min.js') }}" defer></script>
    <script src="{{ asset('js/script.js') }}" defer></script>
    <script src="{{ theme_asset('js/app.js') }}" defer></script>

    <!-- Page level scripts -->
    @stack('scripts')

    <!-- Fonts -->
    <link href="{{ asset('vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/base.css') }}" rel="stylesheet">
    <link href="{{ theme_asset('css/style.css') }}" rel="stylesheet">
    @stack('styles')
    <style>
        :root {
            --primary-color: {{ $themeColor }};
        }
    </style>
    @include('elements.theme-color', ['color' => $themeColor])

</head>
<body>
    <div id="app">
        <header>
            @include('elements.navbar')
        </header>

        @yield('app')
    </div>

    @include('elements.footer')

    @stack('footer-scripts')
</body>

</html>
