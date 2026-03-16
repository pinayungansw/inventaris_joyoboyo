<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Inventaris Ruangan') — Perumda</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-slate-50 text-slate-800" style="font-family: 'Plus Jakarta Sans', sans-serif;">
    <div class="max-w-4xl mx-auto px-4 py-8">
        @yield('content')
    </div>

    {{-- Footer --}}
    <footer class="text-center py-6 text-xs text-slate-400">
        &copy; {{ date('Y') }} Perumda Pasar Joyoboyo Kota Kediri &bull; Sistem Inventaris Aset
    </footer>

    @stack('scripts')
</body>

</html>