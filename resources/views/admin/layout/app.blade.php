<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Book Store - Admin')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="antialiased bg-gray-100 flex flex-col min-h-screen">
    <a class="nav-link" href="{{ route('chat.getUsers') }}">Chat</a>

    @include('components.alerts')
    {{-- Sidebar --}}
    @include('admin.inc.sidebar')

    <div class="flex flex-1">
        {{-- Main Content --}}

        <div class="flex-1 flex flex-col w-full ml-64 h-screen overflow-hidden">
            {{-- Header --}}
            @include('admin.inc.header')

            {{-- Content --}}
            <div class="w-full h-full overflow-auto p-4">
                @yield('content')
            </div>

            {{-- Footer --}}
            @include('admin.inc.footer')
        </div>
    </div>
</body>

</html>
