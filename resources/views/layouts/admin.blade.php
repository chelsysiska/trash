<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - @yield('title', 'Dashboard')</title>

    {{-- Tailwind + AlpineJS --}}
    @vite(['resources/css/app.css','resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</head>
<body class="bg-gray-100 font-sans antialiased">

<div x-data="{ open: true }" class="flex min-h-screen">

    <!-- Sidebar -->
    <aside class="bg-white shadow-md w-64 fixed inset-y-0 left-0 transform transition-transform duration-300 z-20"
           :class="open ? 'translate-x-0' : '-translate-x-64'">

        <div class="p-6 border-b flex justify-between items-center">
            <h1 class="text-xl font-bold text-gray-800">Admin Panel</h1>
            <!-- tombol close -->
            <button @click="open = false" class="text-gray-600 hover:text-gray-900">
                ✖
            </button>
        </div>

        <nav class="p-4">
            <ul class="space-y-2">
                <li>
                    <a href="{{ route('admin.dashboard') }}"
                       class="block py-2 px-4 rounded hover:bg-gray-200 {{ request()->routeIs('admin.dashboard') ? 'bg-gray-200 font-bold' : '' }}">
                        📊 Dashboard
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.riwayat') }}"
                       class="block py-2 px-4 rounded hover:bg-gray-200 {{ request()->routeIs('admin.riwayat') ? 'bg-gray-200 font-bold' : '' }}">
                        📜 Riwayat
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.nasabah.index') }}"
                        class="block py-2 px-4 rounded hover:bg-gray-200 {{ request()->routeIs('admin.nasabah.*') ? 'bg-gray-200 font-bold' : '' }}">
                        👥 Nasabah
                    </a>
                </li>
            </ul>
        </nav>
    </aside>

    <!-- Overlay (background hitam kalau sidebar terbuka) -->
    <div x-show="open" class="fixed inset-0 bg-black bg-opacity-40 z-10 md:hidden"
         @click="open = false"
         x-transition.opacity>
    </div>

    <!-- Main content -->
    <div class="flex-1 transition-all duration-300" :class="open ? 'md:ml-64' : 'ml-0'">
        <!-- Header -->
        <header class="bg-white shadow p-4 flex justify-between items-center">
            <div class="flex items-center space-x-2">
                <!-- tombol hamburger -->
                <button @click="open = !open" class="text-gray-600 hover:text-gray-900">
                    ☰
                </button>
                <h2 class="text-lg font-semibold text-gray-700">@yield('title', 'Dashboard')</h2>
            </div>
            <div class="flex items-center space-x-4">
                <span class="text-gray-600">👤 {{ Auth::user()->name ?? 'Admin' }}</span>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">
                        Logout
                    </button>
                </form>
            </div>
        </header>

        <!-- Content -->
        <main class="p-6">
            @yield('content')
        </main>
    </div>
</div>

</body>
</html>
