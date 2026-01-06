<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'ILS Admin')</title>
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

<body class="min-h-screen bg-slate-900 text-slate-100">

<div class="min-h-screen grid grid-cols-1 lg:grid-cols-2">

    {{-- LEFT PANEL (DESKTOP BRANDING) --}}
    <aside class="hidden lg:flex flex-col justify-between
                  bg-gradient-to-br from-slate-950 via-slate-900 to-slate-800
                  px-16 py-14">

        <div>
            {{-- BRAND --}}
            <div class="flex items-center gap-4 mb-10">
                <div class="w-12 h-12 rounded-xl
                            bg-red-600/20 text-red-400
                            flex items-center justify-center
                            text-xl font-bold">
                    A
                </div>

                <div>
                    <h1 class="text-lg font-semibold tracking-wide">
                        ILS ADMIN
                    </h1>
                    <p class="text-xs text-slate-400">
                        Internal Management System
                    </p>
                </div>
            </div>

            {{-- DESCRIPTION --}}
            <p class="text-slate-300 leading-relaxed max-w-md">
                Panel ini digunakan untuk mengelola sistem internal:
                driver, user, transaksi, laporan, dan pengaturan sistem.
            </p>

            <ul class="mt-8 space-y-3 text-sm text-slate-400">
                <li>• Akses terbatas administrator</li>
                <li>• Aktivitas tercatat & diaudit</li>
                <li>• Data bersifat sensitif</li>
            </ul>
        </div>

        {{-- FOOTER LEFT --}}
        <p class="text-xs text-slate-500">
            © {{ date('Y') }} Intat Lon Siat — Internal Use Only
        </p>
    </aside>

    {{-- RIGHT PANEL (FORM AREA) --}}
    <main class="flex items-center justify-center px-6 py-12">

        <div class="w-full max-w-md">

            {{-- MOBILE BRAND --}}
            <div class="lg:hidden text-center mb-8">
                <div class="mx-auto mb-3 w-12 h-12 rounded-xl
                            bg-red-600/20 text-red-400
                            flex items-center justify-center
                            font-bold">
                    A
                </div>
                <h2 class="font-semibold text-lg">ILS ADMIN</h2>
                <p class="text-xs text-slate-400">
                    Internal System Access
                </p>
            </div>

            {{-- FORM CONTAINER --}}
            <div class="bg-white/5 backdrop-blur
                        border border-white/10
                        rounded-2xl shadow-xl
                        px-8 py-10">

                @yield('content')

            </div>
        </div>

    </main>

</div>

</body>
</html>