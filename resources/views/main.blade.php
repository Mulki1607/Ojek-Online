<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'App' }}</title>

    <!-- TAILWIND -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

    <!-- NAVBAR SEDERHANA -->
    <nav class="bg-white shadow p-4">
        <div class="container mx-auto flex justify-between">
            <a href="/" class="font-bold text-xl">OJOL</a>

            <div class="flex gap-4">

                <a href="{{ route('login.select') }}" class="text-blue-600 hover:underline">
                    Login
                </a>

                <a href="{{ route('register.select') }}" class="text-green-600 hover:underline">
                    Daftar
                </a>

            </div>
        </div>
    </nav>

    <!-- CONTENT -->
    <main class="container mx-auto p-6">
        @yield('content')
    </main>

</body>

</html>
