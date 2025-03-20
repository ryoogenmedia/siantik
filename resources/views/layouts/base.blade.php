<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- font -->
    <link rel="stylesheet" href="{{ asset('assets/fonts/fonts.css') }}">
    <!-- Icons -->
    <link rel="stylesheet" href="{{ asset('assets/fonts/font-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('icon/line-awesome/css/line-awesome.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet"type="text/css" href="{{ asset('assets/css/nouislider.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/swiper-bundle.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/styles.css') }}" />
    {{-- <link rel="manifest" href="{{ asset('assets/_manifest.json') }}" data-pwa-version="set_in_manifest_and_pwa_js"> --}}
    <!-- Favicon and Touch Icons  -->
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">

    <title>SIANTIK APP | @yield('title')</title>

    <!-- Livewire Styles -->
    @livewireStyles

    <!-- Component Style -->
    @yield('styles')
</head>

<body class="app-wallet">

    @yield('content')

    <!-- Livewire Styles -->
    @livewireScripts

    <script type="text/javascript" src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/swiper-bundle.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/carousel.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/nouislider.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/rangle-slider.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/count-down.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/init.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/main.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/multiple-modal.js') }}"></script>

    @stack('scripts')
</body>

</html>
