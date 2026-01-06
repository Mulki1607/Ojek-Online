<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Aplikasi Ojol' }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen bg-gradient-to-br from-gray-950 via-gray-900 to-gray-800 text-gray-100">

{{-- ================= HEADER ================= --}}
<header class="bg-gray-900 border-b border-gray-800 sticky top-0 z-50">
    <div class="max-w-7xl mx-auto flex items-center justify-between px-6 py-4">

        {{-- LEFT --}}
        <div class="flex items-center gap-4">
            <button id="toggleMenu"
                    class="md:hidden text-2xl font-bold text-gray-200">
                ☰
            </button>

            <span class="text-xl font-bold text-emerald-400 tracking-wide">
                Intat Lon Siat
            </span>
        </div>

        {{-- DESKTOP MENU --}}
        <div class="hidden md:flex items-center gap-4 text-sm">

            {{-- ================= USER ================= --}}
            @auth
                @if (!View::hasSection('hideWalletIcon'))
                <a href="{{ route('user.wallet') }}"
                   title="Dompet Saya"
                   class="relative flex items-center justify-center
                          w-11 h-11 rounded-full
                          bg-emerald-900/40 hover:bg-emerald-900/70 transition">

                    <svg xmlns="http://www.w3.org/2000/svg"
                         class="w-6 h-6 text-emerald-300"
                         fill="none"
                         viewBox="0 0 24 24"
                         stroke="currentColor">
                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-2m4-4h-4m0 0l-2 2m2-2l-2-2" />
                    </svg>
                </a>
                @endif

                <a href="{{ route('user.home') }}"
                   class="hover:text-emerald-400 transition">
                    Home
                </a>

                <form method="POST" action="{{ route('user.logout') }}">
                    @csrf
                    <button class="text-red-400 hover:text-red-500 transition">
                        Logout
                    </button>
                </form>

            {{-- ================= DRIVER ================= --}}
            @elseauth('driver')

                <a href="{{ route('driver.dashboard') }}"
                   class="hover:text-emerald-400 transition">
                    Home
                </a>

                <form method="POST" action="{{ route('driver.logout') }}">
                    @csrf
                    <button class="text-red-400 hover:text-red-500 transition">
                        Logout
                    </button>
                </form>

            {{-- ================= GUEST ================= --}}
            @else

                <a href="{{ route('login.select') }}"
                   class="px-4 py-2 border border-gray-700 rounded
                          hover:bg-gray-800 transition">
                    Login
                </a>

                <a href="{{ route('register.select') }}"
                   class="px-4 py-2 bg-emerald-600 text-white rounded
                          hover:bg-emerald-700 transition">
                    Daftar
                </a>

            @endauth
        </div>
    </div>

    {{-- ================= MOBILE MENU ================= --}}
    <div id="mobileMenu"
         class="hidden md:hidden bg-gray-900 border-t border-gray-800 px-6 py-4 space-y-3 text-sm">

        @auth
            <a href="{{ route('user.home') }}"
               class="block hover:text-emerald-400">
                Home
            </a>

            <a href="{{ route('user.wallet') }}"
               class="block hover:text-emerald-400">
                Dompet Saya
            </a>

            <form method="POST" action="{{ route('user.logout') }}">
                @csrf
                <button class="text-red-400">
                    Logout
                </button>
            </form>

        @elseauth('driver')
            <a href="{{ route('driver.dashboard') }}"
               class="block hover:text-emerald-400">
                Home
            </a>

            <form method="POST" action="{{ route('driver.logout') }}">
                @csrf
                <button class="text-red-400">
                    Logout
                </button>
            </form>

        @else
            <a href="{{ route('landing') }}"
               class="block hover:text-emerald-400">
                Home
            </a>

            <hr class="border-gray-700">

            <a href="{{ route('login.select') }}"
               class="block px-4 py-2 border border-gray-700 rounded text-center">
                Login
            </a>

            <a href="{{ route('register.select') }}"
               class="block px-4 py-2 bg-emerald-600 text-white rounded text-center">
                Daftar
            </a>
        @endauth
    </div>
</header>

{{-- ================= MAIN ================= --}}
<main class="min-h-screen">
    @yield('content')
</main>

{{-- ================= FOOTER ================= --}}
<footer class="bg-gray-900 border-t border-gray-800 py-6 text-center text-gray-400 text-sm">
    © {{ date('Y') }} Ojol App
</footer>

<script>
    document.getElementById('toggleMenu')
        ?.addEventListener('click', () => {
            document.getElementById('mobileMenu')
                .classList.toggle('hidden');
        });
</script>

</body>
</html>