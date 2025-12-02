<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Aplikasi Ojol' }}</title>

    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50 text-gray-800">

    <!-- NAVBAR -->
    <header class="bg-white shadow">
        <div class="container mx-auto flex justify-between items-center py-4 px-6">
            <h1 class="text-xl font-bold text-blue-600">Intat Lon Siat</h1>

            <nav class="space-x-6">
                <a href="/" class="hover:text-blue-600">Home</a>
                <a href="#layanan" class="hover:text-blue-600">Layanan</a>
                <a href="#tentang" class="hover:text-blue-600">Tentang</a>
            </nav>

            <div class="space-x-3">
                <a href="/login" class="px-4 py-2 border rounded hover:bg-gray-100">Login</a>
                <a href="/register" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                    Daftar
                </a>
            </div>
        </div>
    </header>

    <!-- CONTENT -->
    <main>
        @yield('content')
    </main>

    <!-- FOOTER -->
    <footer class="bg-white mt-10 py-6 text-center text-gray-600 border-t">
        <p>© {{ date('Y') }} Ojol App — Semua Hak Dilindungi</p>
    </footer>

</body>
</html>
