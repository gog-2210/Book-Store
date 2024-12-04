<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Book Store')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">

    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    <meta name="csrf-token" content="{{ csrf_token() }}">


    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="antialiased">
    <a href="{{ route('chat.getUsers') }}"
        class="fixed bottom-4 right-4 bg-blue-500 text-white px-6 py-3 rounded-full shadow-lg hover:bg-blue-600 transition-all">
        Chat
    </a>
    <div class="site-wrap">
        @include('components.alerts')
        @include('client.inc.header')
        <div class="content-wrapper px-8 md:px-16 lg:px-20">
            @yield('content')
        </div>

    </div>
    @include('client.inc.footer')
</body>

</html>
