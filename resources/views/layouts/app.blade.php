<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="description" content="Maro Adventure Indonesia — Adventure & Outdoor Event Organizer untuk hiking, camping, open trip, private trip, team building, dan perjalanan berbasis alam & budaya.">
    <meta name="keywords" content="Maro Adventure, Maro Adventure Indonesia, hiking, camping, open trip, private trip, mountain guide, outdoor event, team building, wisata alam, wisata budaya, adventure Indonesia">
    <meta name="author" content="Maro Adventure Indonesia">

    <meta property="og:title" content="Maro Adventure Indonesia | GO BEYOND THE TRIP">
    <meta property="og:description" content="Bukan sekadar perjalanan. Temukan pengalaman, cerita, dan ruang untuk melangkah lebih jauh bersama Maro Adventure.">
    <meta property="og:type" content="website">

    <title>@yield('title', 'Maro Adventure Indonesia | GO BEYOND THE TRIP')</title>

    <!-- Bootstrap 5 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    @stack('styles')
</head>
<body>

    @unless(request()->routeIs('login') || request()->routeIs('register'))
        @include('layouts.partials.navbar')
    @endunless

    @yield('content')

    @unless(request()->routeIs('login') || request()->routeIs('register'))
        @include('layouts.partials.footer')
        @include('layouts.partials.back-to-top')
    @endunless

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Custom JavaScript -->
    <script src="{{ asset('js/script.js') }}"></script>

    @stack('scripts')
</body>
</html>
