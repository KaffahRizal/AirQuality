<!DOCTYPE html>
<html>

<head>
    <title>@yield('title', 'Air Quality Indonesia')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    @stack('head')
</head>

<body class="bg-gradient-to-b from-blue-100 to-white min-h-screen flex flex-col">
    <header class="bg-blue-700 text-white py-6 shadow-md">
        <div class="container mx-auto px-4 flex flex-col items-center gap-2">
            <h1 class="text-3xl font-bold text-center">@yield('header', 'Air Quality Indonesia')</h1>
            <p class="text-center mt-2 text-blue-100">@yield('subtitle', 'Pantau kualitas udara di berbagai kota secara Real-Time dan interaktif')</p>
            @yield('header-actions')
        </div>
    </header>
    <main class="flex-1 flex flex-col items-center justify-center py-8">
        <div class="w-full max-w-5xl rounded-lg shadow-lg bg-white p-4">
            @yield('content')
        </div>
    </main>
    <footer class="bg-blue-700 text-white py-4 mt-8 text-center">
        <span>&copy; {{ date('Y') }} Air Quality Indonesia &mdash; Data & Visualisasi Kelompok AirQuality</span>
    </footer>

    <!-- Muat jQuery sebelum script lain -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    @stack('scripts')
</body>

</html>
