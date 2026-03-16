<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Inventaris Aset') — Perumda</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-slate-50 text-slate-800" style="font-family: 'Plus Jakarta Sans', sans-serif;">
    <div class="flex min-h-screen">
        {{-- Sidebar --}}
        <aside id="sidebar"
            class="fixed inset-y-0 left-0 z-30 w-64 transform bg-gradient-to-b from-slate-900 via-slate-800 to-slate-900 text-white transition-transform duration-300 ease-in-out lg:translate-x-0 -translate-x-full">
            <div class="px-6 py-6 bg-white border-b border-slate-100 flex justify-center">
                <img src="{{ asset('perumda.png') }}" alt="Logo Perumda" class="h-12 w-auto object-contain">
            </div>

            <nav class="mt-4 px-3 space-y-1 text-sm">
                <a href="{{ route('dashboard') }}"
                    class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition {{ request()->routeIs('dashboard') ? 'bg-blue-600/30 text-blue-200' : 'text-slate-300 hover:bg-white/5 hover:text-white' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    Dashboard
                </a>

                <div class="pt-3 pb-1">
                    <span class="px-3 text-[10px] font-semibold tracking-wider text-slate-500 uppercase">Master
                        Data</span>
                </div>

                <a href="{{ route('master.lokasi.index') }}"
                    class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition {{ request()->routeIs('master.lokasi.*') ? 'bg-blue-600/30 text-blue-200' : 'text-slate-300 hover:bg-white/5 hover:text-white' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    Lokasi
                </a>
                <a href="{{ route('master.ruangan.index') }}"
                    class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition {{ request()->routeIs('master.ruangan.*') ? 'bg-blue-600/30 text-blue-200' : 'text-slate-300 hover:bg-white/5 hover:text-white' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                    </svg>
                    Ruangan
                </a>
                <a href="{{ route('master.klasifikasi.index') }}"
                    class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition {{ request()->routeIs('master.klasifikasi.*') ? 'bg-blue-600/30 text-blue-200' : 'text-slate-300 hover:bg-white/5 hover:text-white' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                    </svg>
                    Klasifikasi
                </a>
                <a href="{{ route('master.jenis-barang.index') }}"
                    class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition {{ request()->routeIs('master.jenis-barang.*') ? 'bg-blue-600/30 text-blue-200' : 'text-slate-300 hover:bg-white/5 hover:text-white' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                    </svg>
                    Jenis Barang
                </a>

                <div class="pt-3 pb-1">
                    <span
                        class="px-3 text-[10px] font-semibold tracking-wider text-slate-500 uppercase">Inventaris</span>
                </div>

                <a href="{{ route('aset.index') }}"
                    class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition {{ request()->routeIs('aset.*') ? 'bg-blue-600/30 text-blue-200' : 'text-slate-300 hover:bg-white/5 hover:text-white' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                    </svg>
                    Data Aset
                </a>
                <a href="{{ route('mutasi.index') }}"
                    class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition {{ request()->routeIs('mutasi.*') ? 'bg-blue-600/30 text-blue-200' : 'text-slate-300 hover:bg-white/5 hover:text-white' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4" />
                    </svg>
                    Mutasi Barang
                </a>

                <div class="pt-3 pb-1">
                    <span class="px-3 text-[10px] font-semibold tracking-wider text-slate-500 uppercase">Laporan</span>
                </div>

                <a href="{{ route('laporan.index') }}"
                    class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition {{ request()->routeIs('laporan.*') ? 'bg-blue-600/30 text-blue-200' : 'text-slate-300 hover:bg-white/5 hover:text-white' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    Laporan & Export
                </a>
                <a href="{{ route('qr.batch') }}"
                    class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition {{ request()->routeIs('qr.*') ? 'bg-blue-600/30 text-blue-200' : 'text-slate-300 hover:bg-white/5 hover:text-white' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z" />
                    </svg>
                    Cetak QR Code
                </a>
            </nav>
        </aside>

        {{-- Main Content --}}
        <div class="flex-1 lg:ml-64 relative">

            {{-- Bauhaus Background Shapes --}}
            {{-- macOS Glassmorphism Global Styles --}}
            <style>
                :root {
                    --glass-bg: rgba(255, 255, 255, 0.7);
                    --glass-border: rgba(255, 255, 255, 0.3);
                    --glass-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.07);
                    --mac-accent: #1C7791;
                }

                .glass-card {
                    background: var(--glass-bg);
                    backdrop-filter: blur(12px);
                    -webkit-backdrop-filter: blur(12px);
                    border: 1px solid var(--glass-border);
                    box-shadow: var(--glass-shadow);
                }

                /* Standardized macOS Buttons */
                .btn-mac-primary {
                    background: linear-gradient(180deg, #1C7791 0%, #166075 100%);
                    border: 1px solid rgba(255, 255, 255, 0.1);
                    box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1), inset 0 1px 0 rgba(255, 255, 255, 0.1);
                    @apply inline-flex items-center gap-2 rounded-xl px-5 py-2.5 text-sm font-semibold text-white transition-all active:scale-[0.97] hover:brightness-110;
                }

                .btn-mac-glass {
                    background: rgba(255, 255, 255, 0.5);
                    backdrop-filter: blur(8px);
                    border: 1px solid rgba(255, 255, 255, 0.4);
                    box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
                    @apply inline-flex items-center gap-2 rounded-xl px-4 py-2 text-sm font-bold text-slate-600 transition-all hover:bg-white/80 hover:text-slate-900 active:scale-[0.97];
                }

                .btn-mac-danger {
                    background: linear-gradient(180deg, #ef4444 0%, #dc2626 100%);
                    border: 1px solid rgba(255, 255, 255, 0.1);
                    @apply inline-flex items-center gap-2 rounded-xl px-4 py-2 text-xs font-bold text-white transition-all active:scale-[0.97] hover:brightness-110 shadow-sm;
                }

                /* Bauhaus Accents with more Depth */
                .bh {
                    position: fixed;
                    z-index: 0;
                    pointer-events: none;
                    border-radius: 50%;
                    filter: blur(60px);
                }

                .bh-1 {
                    width: 500px;
                    height: 500px;
                    background: rgba(28, 119, 145, 0.1);
                    top: -100px;
                    right: -100px;
                }

                .bh-2 {
                    width: 400px;
                    height: 400px;
                    background: rgba(0, 69, 0, 0.08);
                    bottom: -100px;
                    left: 10%;
                }

                .bh-3 {
                    width: 300px;
                    height: 300px;
                    background: rgba(180, 212, 0, 0.1);
                    top: 30%;
                    right: 5%;
                }
            </style>

            <div class="bh bh-1"></div>
            <div class="bh bh-2"></div>
            <div class="bh bh-3"></div>

            {{-- Top Bar --}}
            <header
                class="sticky top-0 z-20 flex h-16 items-center justify-between border-b border-slate-200/50 bg-white/60 backdrop-blur-xl px-4 lg:px-8">
                <div class="flex items-center gap-4">
                    <button onclick="document.getElementById('sidebar').classList.toggle('-translate-x-full')"
                        class="lg:hidden p-2 rounded-xl hover:bg-white/50 transition-colors">
                        <svg class="w-5 h-5 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                    <h2 class="text-base font-extrabold text-slate-800 tracking-tight">@yield('page-title', 'Dashboard')
                    </h2>
                </div>
                <div class="flex items-center gap-5">
                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-[0.1em] hidden sm:inline">{{
    now()->translatedFormat('l, d F Y') }}</span>
                    <div class="h-4 w-px bg-slate-200/60 hidden sm:block"></div>
                    <div class="flex items-center gap-3">
                        <div
                            class="flex h-8 w-8 items-center justify-center rounded-xl bg-gradient-to-br from-[#004500] to-[#1C7791] text-[10px] font-black text-white shadow-sm ring-2 ring-white">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </div>
                        <span class="text-xs font-bold text-slate-700 hidden sm:inline tracking-tight">{{
    Auth::user()->name }}</span>
                    </div>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit"
                            class="flex items-center gap-2 rounded-xl px-3 py-1.5 text-[10px] font-black uppercase tracking-wider text-slate-400 hover:bg-red-50 hover:text-red-500 transition-all active:scale-95">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                            </svg>
                            Keluar
                        </button>
                    </form>
                </div>
            </header>

            {{-- Flash Messages --}}
            @if(session('success'))
                <div class="mx-4 lg:mx-8 mt-4 relative z-10">
                    <div
                        class="flex items-center gap-3 rounded-xl bg-emerald-50 border border-emerald-200 px-4 py-3 text-sm text-emerald-700">
                        <svg class="w-5 h-5 text-emerald-500 shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                clip-rule="evenodd" />
                        </svg>
                        {{ session('success') }}
                    </div>
                </div>
            @endif

            @if($errors->any())
                <div class="mx-4 lg:mx-8 mt-4 relative z-10">
                    <div class="rounded-xl bg-red-50 border border-red-200 px-4 py-3 text-sm text-red-700">
                        <ul class="list-disc list-inside">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            {{-- Page Content --}}
            <main class="p-4 lg:p-8 relative z-10">
                @yield('content')
            </main>
        </div>
    </div>

    {{-- Overlay for mobile sidebar --}}
    <div id="sidebar-overlay" class="fixed inset-0 z-20 bg-black/50 lg:hidden hidden"
        onclick="document.getElementById('sidebar').classList.add('-translate-x-full'); this.classList.add('hidden')">
    </div>

    @stack('scripts')
</body>

</html>ack('scripts')
</body>

</html>