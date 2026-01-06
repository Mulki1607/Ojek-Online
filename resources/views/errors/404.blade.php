<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Halaman Tidak Ditemukan</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- Tailwind --}}
    <script src="https://cdn.tailwindcss.com"></script>

    {{-- Font --}}
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap"
          rel="stylesheet">

    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>

<body class="min-h-screen
             bg-gradient-to-br from-slate-950 via-gray-900 to-slate-900
             text-white flex items-center justify-center px-4">

    {{-- GLOW BACKGROUND --}}
    <div class="absolute inset-0 pointer-events-none">
        <div class="absolute -top-32 -left-32 w-[500px] h-[500px] bg-green-600/10 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 right-0 w-[400px] h-[400px] bg-blue-600/10 rounded-full blur-3xl"></div>
    </div>

    {{-- CARD --}}
    <div class="relative max-w-md w-full
                bg-slate-900/80 backdrop-blur
                border border-white/10
                rounded-3xl shadow-2xl p-8 text-center">

        {{-- ICON --}}
        <div class="mx-auto mb-6 w-16 h-16
                    rounded-2xl bg-green-600/20
                    flex items-center justify-center
                    text-green-400 text-3xl">
            🛵
        </div>

        {{-- CODE --}}
        <h1 class="text-6xl font-bold tracking-tight text-white">
            404
        </h1>

        {{-- TITLE --}}
        <h2 class="mt-4 text-xl font-semibold">
            Halaman Tidak Ditemukan
        </h2>

        {{-- DESC --}}
        <p class="mt-2 text-sm text-gray-400 leading-relaxed">
            Sepertinya halaman yang kamu cari sudah tidak tersedia,
            link sudah kedaluwarsa, atau driver sedang offline.
        </p>

        {{-- DIVIDER --}}
        <div class="my-6 h-px bg-white/10"></div>

        {{-- ACTION --}}
        <div class="flex flex-col gap-3">

            @auth('driver')
                <a href="{{ route('driver.dashboard') }}"
                   class="w-full py-2.5 rounded-xl
                          bg-green-600 hover:bg-green-700
                          text-white font-semibold transition">
                    Kembali ke Dashboard Driver
                </a>

            @elseif(auth()->check())
                <a href="{{ route('user.home') }}"
                   class="w-full py-2.5 rounded-xl
                          bg-blue-600 hover:bg-blue-700
                          text-white font-semibold transition">
                    Kembali ke Beranda
                </a>

            @else
                <a href="{{ route('landing') }}"
                   class="w-full py-2.5 rounded-xl
                          bg-slate-700 hover:bg-slate-600
                          text-white font-semibold transition">
                    Kembali ke Halaman Utama
                </a>
            @endauth

            <button onclick="history.back()"
                    class="text-sm text-gray-400 hover:text-white transition">
                ← Kembali ke halaman sebelumnya
            </button>
        </div>

    </div>

</body>
</html>