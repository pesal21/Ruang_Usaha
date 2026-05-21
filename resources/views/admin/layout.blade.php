<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard - RuangUsaha</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
</head>

<body class="bg-gray-50 text-gray-800">

    <nav class="bg-white border-b px-10 py-4 flex justify-between items-center">

        {{-- LOGO --}}
        <div class="flex items-center gap-3">
            <img src="{{ asset('Logo.png') }}" class="w-8 h-8" alt="logo">
            <span class="font-semibold text-lg">RuangUsaha</span>
        </div>

        {{-- NAVIGASI --}}
        <div class="flex items-center gap-8 text-sm font-regular">
            <a href="{{ route('admin.dashboard') }}"
                class="{{ request()->routeIs('admin.dashboard') ? 'text-blue-600 font-medium' : 'text-gray-600' }} hover:text-blue-600 transition">
                Beranda
            </a>
            <a href="{{ route('admin.umkm.data') }}"
                class="{{ request()->routeIs('admin.umkm.*') ? 'text-blue-600 font-medium' : 'text-gray-600' }} hover:text-blue-600 transition">
                Data UMKM
            </a>
            <a href="{{ route('admin.user.index') }}"
                class="{{ request()->routeIs('admin.user.*') ? 'text-blue-600 font-medium' : 'text-gray-600' }} hover:text-blue-600 transition">
                User Accounts
            </a>
            <a href="{{ route('admin.kategori.index') }}"
                class="{{ request()->routeIs('admin.kategori.*') ? 'text-blue-600 font-medium' : 'text-gray-600' }} hover:text-blue-600 transition">
                Kelola Kategori
            </a>
            <a href="{{ route('admin.blog.index') }}"
                class="{{ request()->routeIs('admin.blog.*') ? 'text-blue-600 font-medium' : 'text-gray-600' }} hover:text-blue-600 transition">
                Kelola Blog
            </a>
        </div>

        {{-- PROFILE DROPDOWN --}}
        <div class="relative" x-data="{ open: false }">
            <button @click="open = !open"
                class="flex items-center gap-3 focus:outline-none">
                <div class="text-right">
                    <p class="text-sm font-semibold">{{ auth()->user()->name }}</p>
                    <p class="text-xs text-gray-500">Admin</p>
                </div>
                <div class="w-9 h-9 rounded-full bg-gray-300 overflow-hidden flex items-center
                        justify-center text-gray-500 font-semibold text-sm">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>
            </button>

            <div x-show="open"
                x-cloak
                @click.away="open = false"
                class="absolute right-0 mt-3 w-44 bg-white border border-gray-100
                    rounded-xl shadow-xl overflow-hidden z-50">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="w-full text-left px-4 py-3 text-sm text-red-600
                           hover:bg-red-50 transition">
                        Logout
                    </button>
                </form>
            </div>
        </div>

    </nav>

    <main class="px-10 py-8">
        @yield('content')
    </main>

</body>

</html>