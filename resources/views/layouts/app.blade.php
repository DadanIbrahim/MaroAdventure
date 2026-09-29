<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $title ?? 'MARO Adventure' }}</title>

    @vite([
        'resources/css/app.css',
        'resources/js/app.js'
    ])
</head>

<body
    x-data="{
        scrolled: false,
        mobileMenu: false,
        lightbox: false,
        lightboxImage: '',
        showTop: false
    }"
    @scroll.window="
        scrolled = window.scrollY > 50;
        showTop = window.scrollY > 500;
    "
    @keydown.escape.window="
        lightbox = false;
        mobileMenu = false;
    "
    class="bg-white text-gray-900"
>

    @yield('content')

</body>
</html>