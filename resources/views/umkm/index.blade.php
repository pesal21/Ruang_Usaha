<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Daftar UMKM Bontang</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>

<body class="bg-gray-50 text-gray-800">

    <!-- ================= NAVBAR ================= -->
    <nav class="fixed top-0 w-full bg-white border-b z-50">
        <div class="relative h-16 px-6 flex items-center">

            <!-- LEFT : LOGO -->
            <div class="absolute left-6 flex items-center gap-2">
                <a href="{{ route('beranda') }}" class="inline-flex items-center gap-2">
                    <img src="{{ asset('Logo.png') }}" class="w-8 h-8" alt="logo">
                    <span class="text-lg font-semibold">RuangUsaha</span>
                </a>
            </div>

            <!-- CENTER : MENU -->
            <div class="mx-auto hidden md:flex items-center gap-8 text-sm font-regular">
                <a href="{{ route('beranda') }}" class="hover:text-blue-600 transition">Beranda</a>
                <a href="{{ route('umkm.index') }}" class="text-blue-600 transition">Daftar UMKM</a>
                @auth
                <a href="{{ route('umkm.pilih') }}" class="hover:text-blue-600">Pilih UMKM</a>
                @endauth
                <a href="{{ route('blog.index') }}" class="hover:text-blue-600 transition">
                    Blog
                </a>
            </div>

            <!-- RIGHT : AUTH / PROFILE -->
            <div class="absolute right-6 flex items-center gap-3">
                @guest
                <a href="{{ route('login') }}" class="px-4 py-2 text-sm border rounded-md">LOGIN</a>
                <a href="{{ route('register') }}" class="px-4 py-2 text-sm bg-blue-600 text-white rounded-md">SIGN UP</a>
                @endguest

                @auth
                <div class="relative">
                    <button onclick="toggleDropdown()" class="flex items-center gap-3 focus:outline-none">
                        <div class="text-right hidden md:block">
                            <p class="text-sm font-medium leading-tight">{{ auth()->user()->name }}</p>
                            <p class="text-xs text-gray-500">Pelaku UMKM</p>
                        </div>
                        @if(auth()->user()->profile_picture)
                        <img src="{{ asset('storage/'.auth()->user()->profile_picture) }}"
                            alt="Profile"
                            class="w-9 h-9 rounded-full object-cover border-2 border-blue-600 hover:shadow-md transition">
                        @else
                        <div class="w-9 h-9 rounded-full bg-blue-600 text-white flex items-center justify-center font-semibold hover:shadow-md transition">
                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                        </div>
                        @endif
                    </button>

                    <div id="profileDropdown" class="hidden absolute right-0 mt-3 w-48 bg-white border rounded-xl shadow-lg overflow-hidden">
                        <a href="{{ route('profile.index') }}" class="block px-4 py-3 text-sm hover:bg-gray-100">Profil Akun</a>

                        @if(auth()->user()->umkm)
                        <a href="{{ route('umkm.dashboard', auth()->user()->umkm->id) }}" class="block px-4 py-3 text-sm hover:bg-gray-100">Dashboard UMKM</a>
                        @else
                        <a href="{{ route('umkm.create') }}" class="block px-4 py-3 text-sm hover:bg-gray-100">Daftarkan UMKM</a>
                        @endif

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full text-left px-4 py-3 text-sm hover:bg-gray-100">Logout</button>
                        </form>
                    </div>
                </div>
                @endauth
            </div>
        </div>
    </nav>

    <!-- ================= CONTENT ================= -->
    <section class="max-w-7xl mx-auto px-6 pt-28 pb-20">

        <!-- BACK LINK -->
        <div class="mb-6">
            <a href="{{ route('beranda') }}" class="inline-flex items-center gap-1 text-sm text-blue-600 hover:text-blue-700 hover:underline transition-colors duration-200">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                </svg>
                Kembali
            </a>
        </div>

        <!-- HEADER -->
        <h1 class="text-4xl font-bold text-center">Daftar UMKM Bontang</h1>
        <p class="text-gray-500 text-center mt-3 max-w-xl mx-auto">
            Jelajahi dan temukan berbagai usaha lokal yang ada di Bontang.
        </p>

        <!-- SEARCH -->
        <form method="GET" class="max-w-xl mx-auto mt-10 relative">
            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35M17 11A6 6 0 1 1 5 11a6 6 0 0 1 12 0z" />
                </svg>
            </span>
            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Cari UMKM berdasarkan nama, kategori, atau lokasi..."
                class="w-full pl-12 pr-6 py-3 border border-gray-200 rounded-xl bg-white 
                       focus:outline-none focus:ring-2 focus:ring-blue-200 hover:border-gray-300 
                       text-sm shadow-sm transition-colors duration-200">
        </form>

        <!-- TOTAL + FILTER BAR -->
        <div class="mt-8 flex flex-col sm:flex-row items-center justify-between gap-4">

            <!-- Total & Add Button -->
            <div class="flex items-center gap-4">
                @auth
                <a href="{{ route('umkm.create') }}"
                    class="inline-flex items-center gap-2 px-4 py-2 bg-blue-600 text-white text-sm rounded-lg 
                           hover:bg-blue-700 active:scale-95 transition-all duration-200 font-medium shadow-sm hover:shadow-md">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                    </svg>
                    Add New UMKM
                </a>
                @endauth

                <div class="flex items-center gap-2 text-sm text-gray-600 font-medium">
                    <img src="{{ asset('assets/img/icon_umkm/umkm.svg') }}" class="w-4 h-4" alt="UMKM Icon">
                    <span><strong>{{ $umkms->total() }}</strong> UMKM Telah Terdaftar</span>
                </div>
            </div>

            <!-- Filters -->
            <form method="GET" class="flex items-center gap-3 flex-wrap">
                <input type="hidden" name="search" value="{{ request('search') }}">

                <select name="kategori"
                    class="border border-gray-200 bg-white px-4 py-2 rounded-lg text-sm shadow-sm
                           focus:outline-none focus:ring-2 focus:ring-blue-200 hover:border-gray-300 
                           cursor-pointer transition-colors duration-200">
                    <option value="">Semua Kategori</option>
                    @foreach($kategoris as $k)
                    <option value="{{ $k->id }}">
                        {{ $k->nama }}
                    </option>
                    @endforeach
                </select>

                <select name="sort"
                    class="border border-gray-200 bg-white px-4 py-2 rounded-lg text-sm shadow-sm
                           focus:outline-none focus:ring-2 focus:ring-blue-200 hover:border-gray-300 
                           cursor-pointer transition-colors duration-200">
                    <option value="terbaru" {{ request('sort','terbaru')=='terbaru' ? 'selected' : '' }}>Urutkan: Terbaru</option>
                    <option value="terlama" {{ request('sort')=='terlama' ? 'selected' : '' }}>Urutkan: Terlama</option>
                    <option value="nama_asc" {{ request('sort')=='nama_asc' ? 'selected' : '' }}>Nama: A–Z</option>
                    <option value="nama_desc" {{ request('sort')=='nama_desc' ? 'selected' : '' }}>Nama: Z–A</option>
                </select>

                <button type="submit"
                    class="px-4 py-2 bg-gray-100 rounded-lg text-sm hover:bg-gray-200 active:scale-95 transition-all duration-200 shadow-sm">
                    Filter
                </button>
            </form>
        </div>

        <!-- GRID UMKM — 4 kolom sesuai desain -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mt-8">
            @forelse($umkms as $u)
            <a href="{{ route('umkm.show', $u->id) }}"
                class="bg-white rounded-2xl shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 overflow-hidden flex flex-col border border-gray-100">

                <!-- FOTO -->
                <div class="h-40 bg-gray-100 flex items-center justify-center overflow-hidden">
                    @if($u->logo)
                    <img src="{{ asset('storage/'.$u->logo) }}"
                        class="w-full h-full object-cover">
                    @else
                    <div class="text-gray-300 text-sm">No Image</div>
                    @endif
                </div>

                <!-- KONTEN -->
                <div class="p-4 flex flex-col flex-1">

                    <h3 class="font-semibold text-base leading-snug">{{ $u->nama_usaha }}</h3>

                    <p class="text-xs text-gray-400 mt-1 flex items-center gap-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 21c-4.418 0-8-4.03-8-9a8 8 0 1 1 16 0c0 4.97-3.582 9-8 9z" />
                            <circle cx="12" cy="12" r="3" fill="currentColor" stroke="none" />
                        </svg>
                        {{ $u->alamat_lengkap }}
                    </p>

                    <!-- BADGES -->
                    <div class="flex flex-wrap gap-1.5 mt-3">
                        <span class="text-xs bg-blue-50 text-blue-600 px-2.5 py-0.5 rounded-full font-medium">
                            {{ $u->kategori_usaha }}
                        </span>

                        @if($u->jenis_umkm === 'Toko Fisik')
                        <span class="text-xs bg-green-50 text-green-600 px-2.5 py-0.5 rounded-full font-medium">
                            Toko Fisik
                        </span>
                        @elseif($u->jenis_umkm === 'Toko Online')
                        <span class="text-xs bg-purple-50 text-purple-600 px-2.5 py-0.5 rounded-full font-medium">
                            Toko Online
                        </span>
                        @endif
                    </div>

                    <!-- TOMBOL LIHAT DETAIL -->
                    <div class="mt-auto pt-4">
                        <div class="text-center text-sm border border-gray-200 rounded-lg py-2 
                                    hover:bg-gray-50 hover:border-gray-300 active:scale-95 transition-all duration-200 text-gray-600 font-medium">
                            Lihat Detail
                        </div>
                    </div>
                </div>
            </a>
            @empty
            <div class="col-span-full flex flex-col items-center justify-center py-16 text-gray-400">
                <svg class="w-16 h-16 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                        d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                </svg>
                <span class="text-gray-500 font-medium">Belum ada UMKM yang terdaftar.</span>
                <p class="text-gray-400 text-xs mt-2">Coba kembali lagi nanti.</p>
            </div>
            @endforelse
        </div>

        <!-- PAGINATION -->
        <div class="mt-12">
            {{ $umkms->withQueryString()->links() }}
        </div>

    </section>

    <!-- ================= FOOTER ================= -->
    <footer style="background-color: #1e2a3a;" class="text-gray-300">
        <div class="max-w-7xl mx-auto px-10 py-16 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-12">

            <!-- Brand -->
            <div>
                <h2 class="text-white font-bold text-xl mb-4">RuangUsaha</h2>
                <p class="text-sm leading-relaxed" style="color: #8fa3b8;">
                    Menghubungkan dan memberdayakan<br>usaha lokal di Bontang.
                </p>
                <div class="flex items-center gap-5 mt-6">
                    <!-- Facebook -->
                    <a href="#" style="color: #8fa3b8;" class="hover:text-white transition transform hover:scale-110">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z" />
                        </svg>
                    </a>
                    <!-- Instagram -->
                    <a href="#" style="color: #8fa3b8;" class="hover:text-white transition transform hover:scale-110">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                            <rect x="2" y="2" width="20" height="20" rx="5" ry="5" />
                            <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z" />
                            <line x1="17.5" y1="6.5" x2="17.51" y2="6.5" />
                        </svg>
                    </a>
                    <!-- Twitter / X -->
                    <a href="#" style="color: #8fa3b8;" class="hover:text-white transition transform hover:scale-110">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z" />
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Perusahaan -->
            <div>
                <h3 class="text-white font-bold text-base mb-5">Perusahaan</h3>
                <ul class="space-y-3 text-sm" style="color: #8fa3b8;">
                    <li><a href="#" class="hover:text-white transition hover:translate-x-1 inline-block">Tentang Kami</a></li>
                    <li><a href="#" class="hover:text-white transition hover:translate-x-1 inline-block">Kontak</a></li>
                    <li><a href="#" class="hover:text-white transition hover:translate-x-1 inline-block">Dukungan</a></li>
                </ul>
            </div>

            <!-- Tautan Cepat -->
            <div>
                <h3 class="text-white font-bold text-base mb-5">Tautan Cepat</h3>
                <ul class="space-y-3 text-sm" style="color: #8fa3b8;">
                    <li><a href="#" class="hover:text-white transition hover:translate-x-1 inline-block">Bagikan Lokasi</a></li>
                    <li><a href="#" class="hover:text-white transition hover:translate-x-1 inline-block">Lacak Pesanan</a></li>
                    <li><a href="#" class="hover:text-white transition hover:translate-x-1 inline-block">FAQs</a></li>
                </ul>
            </div>

            <!-- Legal -->
            <div>
                <h3 class="text-white font-bold text-base mb-5">Legal</h3>
                <ul class="space-y-3 text-sm" style="color: #8fa3b8;">
                    <li><a href="#" class="hover:text-white transition hover:translate-x-1 inline-block">Syarat & Ketentuan</a></li>
                    <li><a href="#" class="hover:text-white transition hover:translate-x-1 inline-block">Kebijakan Privasi</a></li>
                </ul>
            </div>

        </div>

        <!-- Divider + Copyright -->
        <div style="border-top: 1px solid #2d3f52;">
            <div class="max-w-7xl mx-auto px-10 py-6 text-center text-sm" style="color: #8fa3b8;">
                © 2025 RuangUsaha. All Rights Reserved.
            </div>
        </div>
    </footer>

    <script>
        function toggleDropdown() {
            document.getElementById('profileDropdown').classList.toggle('hidden');
        }

        // Close dropdown when clicking outside
        document.addEventListener('click', function(e) {
            const dropdown = document.getElementById('profileDropdown');
            if (dropdown && !e.target.closest('.relative')) {
                dropdown.classList.add('hidden');
            }
        });
    </script>

</body>

</html>