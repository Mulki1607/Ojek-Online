<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Intat Lon Siat')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- Tailwind CDN --}}
    <script src="https://cdn.tailwindcss.com"></script>

    {{-- Font --}}
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap"
          rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>

<body class="bg-slate-950 text-gray-100 min-h-screen flex flex-col">

{{-- ======================================================
| NAVBAR (GUEST – CLEAN & BRAND ONLY)
====================================================== --}}
<header class="relative z-20">
    <div class="bg-slate-950/80 backdrop-blur border-b border-white/5">
        <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">

            {{-- BRAND --}}
            <a href="{{ route('landing') }}"
               class="flex items-center gap-2 text-lg font-bold tracking-wide">
                <span class="text-green-500">ILS</span>
                <span class="text-white">OJOL</span>
            </a>

            {{-- SUBTLE RIGHT INFO (OPTIONAL / DECORATIVE) --}}
            <span class="hidden md:inline text-xs text-gray-400 tracking-wide">
                Transportasi • Kurir • Delivery
            </span>
        </div>
    </div>

    {{-- ACCENT LINE --}}
    <div class="h-[2px] bg-gradient-to-r from-transparent via-green-500/40 to-transparent"></div>
</header>

{{-- ======================================================
| MAIN CONTENT
====================================================== --}}
<main class="flex-1">
    @yield('content')
</main>

{{-- ======================================================
| FOOTER (DARK – CLEAN BUT ALIVE)
====================================================== --}}
<footer class="mt-24 bg-slate-900 border-t border-white/5">
    <div class="max-w-7xl mx-auto px-6 py-10 grid grid-cols-1 md:grid-cols-3 gap-8 text-sm">

        {{-- BRAND --}}
        <div>
            <h3 class="font-bold text-white mb-2">
                Intat Lon Siat
            </h3>
            <p class="text-gray-400 leading-relaxed">
                Platform transportasi & pengiriman modern
                yang menghubungkan pengguna dengan driver
                terpercaya secara cepat dan transparan.
            </p>
        </div>

        {{-- LINKS --}}
        <div>
            <h4 class="font-semibold text-white mb-3">
                Informasi
            </h4>
            <ul class="space-y-2 text-gray-400">
                <li><a href="#" class="hover:text-green-500">Tentang Kami</a></li>
                <li><a href="#" class="hover:text-green-500">Kebijakan Privasi</a></li>
                <li><a href="#" class="hover:text-green-500">Syarat & Ketentuan</a></li>
            </ul>
        </div>

        {{-- SUPPORT --}}
        <div>
            <h4 class="font-semibold text-white mb-3">
                Bantuan
            </h4>
            <ul class="space-y-2 text-gray-400">
                <li><a href="#" class="hover:text-green-500">Pusat Bantuan</a></li>
                <li><a href="#" class="hover:text-green-500">Hubungi Kami</a></li>
            </ul>
        </div>
    </div>

    {{-- COPYRIGHT --}}
    <div class="border-t border-white/5 py-4 text-center text-xs text-gray-500">
        © {{ date('Y') }} Intat Lon Siat — All rights reserved.
    </div>
</footer>

</body>
</html>