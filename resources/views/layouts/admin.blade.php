<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Admin Panel')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- Tailwind --}}
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen
             bg-gradient-to-br from-slate-950 via-gray-900 to-slate-900
             text-gray-200 overflow-x-hidden">

{{-- ================= HEADER ================= --}}
<header class="sticky top-0 z-40
               bg-slate-900/80 backdrop-blur
               border-b border-white/10">

    <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">

        {{-- LEFT --}}
        <div class="flex items-center gap-4">
            <button id="toggleSidebar"
                    class="text-xl text-gray-300 hover:text-white">
                ☰
            </button>

            <span class="font-semibold tracking-wide text-white">
                ILS ADMIN
            </span>
        </div>

        {{-- RIGHT --}}
        <div class="flex items-center gap-4">
            <button id="toggleInsight"
                    title="Top Statistik"
                    class="text-xl hover:text-blue-400">
                📊
            </button>

            <form method="POST" action="{{ route('admin.logout') }}">
                @csrf
                <button class="text-sm text-red-400 hover:text-red-500">
                    Logout
                </button>
            </form>
        </div>
    </div>
</header>

{{-- ================= MAIN ================= --}}
<div class="flex max-w-7xl mx-auto relative">

    {{-- SIDEBAR --}}
    <aside id="sidebar"
        class="fixed top-[64px] left-0 w-64
               h-[calc(100vh-64px)]
               bg-slate-900/90 backdrop-blur
               border-r border-white/10
               transform transition-transform duration-300">

        <nav class="p-4 space-y-1 text-sm">

            <a href="{{ route('admin.dashboard') }}"
               class="block px-4 py-2 rounded-lg
                      hover:bg-white/10 text-gray-300 hover:text-white">
                Dashboard
            </a>

            <a href="{{ route('admin.users.index') }}"
               class="block px-4 py-2 rounded-lg
                      hover:bg-white/10 text-gray-300 hover:text-white">
                User Management
            </a>

            <a href="{{ route('admin.drivers.index') }}"
               class="block px-4 py-2 rounded-lg
                      hover:bg-white/10 text-gray-300 hover:text-white">
                Driver Management
            </a>
        </nav>
    </aside>

    {{-- CONTENT --}}
    <main class="flex-1 ml-64 p-6">
        @yield('content')
    </main>
</div>

{{-- ================= INSIGHT PANEL ================= --}}
<div id="insightPanel"
     class="fixed top-0 right-0 w-80 h-full
            bg-slate-900/95 backdrop-blur
            border-l border-white/10
            transform translate-x-full
            transition-transform duration-300 z-50">

    {{-- HEADER --}}
    <div class="p-4 border-b border-white/10 flex justify-between items-center">
        <h3 class="font-medium text-white">
            Top Statistik
        </h3>
        <button id="closeInsight"
                class="text-gray-400 hover:text-red-500">
            ✕
        </button>
    </div>

    {{-- BODY --}}
    <div class="p-4 space-y-4 text-sm">

        <div class="border-l-4 border-yellow-400 pl-3">
            <p class="text-xs text-gray-400">Top Rating Driver</p>
            <p class="font-semibold text-white">
                {{ $topRatedDriver->name ?? '-' }}
            </p>
            <p class="text-yellow-400">
                ★ {{ number_format($topRatedDriver->avg_rating ?? 0, 1) }}
            </p>
        </div>

        <div class="border-l-4 border-blue-400 pl-3">
            <p class="text-xs text-gray-400">Order Terbanyak</p>
            <p class="font-semibold text-white">
                {{ $mostActiveDriver->name ?? '-' }}
            </p>
            <p class="text-gray-400">
                {{ $mostActiveDriver->total_orders ?? 0 }} order
            </p>
        </div>

        <div class="border-l-4 border-green-400 pl-3 opacity-60">
            <p class="text-xs text-gray-400">Top Fee Contributor</p>
            <p class="italic text-gray-500">
                (Wallet belum aktif)
            </p>
        </div>

    </div>
</div>

{{-- ================= FOOTER ================= --}}
<footer class="text-center text-xs text-gray-500 py-4">
    © {{ date('Y') }} ILS Admin Panel
</footer>

{{-- ================= SCRIPT ================= --}}
<script>
    const sidebar = document.getElementById('sidebar');
    const toggleSidebar = document.getElementById('toggleSidebar');
    let sidebarOpen = true;

    toggleSidebar.addEventListener('click', () => {
        sidebarOpen = !sidebarOpen;
        sidebar.classList.toggle('-translate-x-full');
        document.querySelector('main').classList.toggle('ml-64');
    });

    const insightPanel = document.getElementById('insightPanel');
    document.getElementById('toggleInsight').addEventListener('click', () => {
        insightPanel.classList.toggle('translate-x-full');
    });

    document.getElementById('closeInsight').addEventListener('click', () => {
        insightPanel.classList.add('translate-x-full');
    });
</script>

</body>
</html>