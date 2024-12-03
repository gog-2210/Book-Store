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

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/@heroicons/vue@1.0.6/dist/heroicons-vue.cjs.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="antialiased bg-gray-100 flex flex-col min-h-screen">

    @include('components.alerts')
    @include('admin.inc.sidebar')

    <div class="flex flex-1">
        <div class="flex-1 flex flex-col w-full ml-64 h-screen overflow-hidden">

            @include('admin.inc.header')

            <div class="w-full h-full overflow-auto p-4">
                @yield('content')
            </div>

            @include('admin.inc.footer')

        </div>
    </div>
</body>

</html>
