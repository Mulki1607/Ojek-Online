<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Driver Panel')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="https://cdn.tailwindcss.com"></script>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap"
          rel="stylesheet">

    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>

<body class="min-h-screen
             bg-gradient-to-br from-slate-950 via-slate-900 to-slate-800
             text-gray-200">

{{-- ================= NAVBAR DRIVER ================= --}}
<header class="bg-black/40 backdrop-blur border-b border-white/10">
    <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">

        <span class="text-lg font-bold text-green-400">
            Intat Lon Siat
        </span>

        <div class="flex items-center gap-4 text-sm">

            <a href="{{ route('driver.dashboard') }}"
               class="hover:text-white transition">
                Dashboard
            </a>

            <a href="{{ route('driver.wallet') }}"
               class="hover:text-white transition">
                Wallet
            </a>

            <form method="POST" action="{{ route('driver.logout') }}">
                @csrf
                <button class="text-red-400 hover:text-red-300 transition">
                    Logout
                </button>
            </form>

        </div>
    </div>
</header>

{{-- ================= MAIN ================= --}}
<main class="relative z-10">
    @yield('content')
</main>

</body>
</html>