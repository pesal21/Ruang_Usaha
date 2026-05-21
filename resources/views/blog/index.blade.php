<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Blog – RuangUsaha</title>
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
                <a href="{{ route('umkm.index') }}" class="hover:text-blue-600 transition">Daftar UMKM</a>
                @auth
                <a href="{{ route('umkm.pilih') }}" class="hover:text-blue-600">Pilih UMKM</a>
                @endauth
                <a href="{{ route('blog.index') }}" class="text-blue-600 transition">
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

    <!-- CONTENT -->
    <main class="max-w-6xl mx-auto px-6 pt-24 pb-20">

        <!-- BACK -->
        <div class="mb-6">
            <a href="{{ route('beranda') }}"
                class="inline-flex items-center gap-1 text-sm text-blue-600 hover:underline transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
                Kembali
            </a>
        </div>

        <!-- HERO TEXT -->
        <div class="text-center mb-10">
            <h1 class="text-4xl font-bold text-gray-900 mb-3">Berita & Blog Terkini</h1>
            <p class="text-gray-400 text-sm max-w-md mx-auto leading-relaxed">
                Informasi dan wawasan terbaru seputar dunia usaha, ekonomi, dan
                pemberdayaan UMKM di Bontang.
            </p>
        </div>

        <!-- SEARCH + FILTER -->
        <div class="flex flex-col md:flex-row items-center gap-3 mb-10">
            <div class="relative w-full md:w-72">
                <span class="absolute left-3.5 top-1/2 -translate-y-1/2 text-gray-400">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </span>
                <input type="text" placeholder="Cari artikel..."
                    class="w-full pl-10 pr-4 py-2.5 border border-gray-200 rounded-xl text-sm
                              bg-white focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div class="ml-auto flex gap-3">
                <select class="px-4 py-2.5 border border-gray-200 rounded-xl text-sm bg-white
                               focus:outline-none focus:ring-2 focus:ring-blue-500 text-gray-600">
                    <option>Semua Kategori</option>
                    <option>Ekonomi Dan UMKM</option>
                    <option>Informasi</option>
                </select>

                <select class="px-4 py-2.5 border border-gray-200 rounded-xl text-sm bg-white
                               focus:outline-none focus:ring-2 focus:ring-blue-500 text-gray-600">
                    <option>Urutkan: Terbaru</option>
                    <option>Urutkan: Terlama</option>
                </select>
            </div>
        </div>

        <!-- GRID BLOG -->
        <div class="grid md:grid-cols-3 gap-6 mb-12">
            @forelse ($blogs as $blog)
            <a href="{{ route('blog.show', $blog->id) }}"
                class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden
                      hover:shadow-md transition group block">

                {{-- GAMBAR --}}
                @if($blog->gambar)
                <div class="overflow-hidden">
                    <img src="{{ asset('storage/'.$blog->gambar) }}"
                        alt="{{ $blog->judul }}"
                        class="w-full h-48 object-cover group-hover:scale-105 transition duration-300">
                </div>
                @else
                <div class="w-full h-48 bg-gray-100 flex items-center justify-center text-gray-300 text-sm">
                    Tidak ada gambar
                </div>
                @endif

                <div class="p-5">

                    {{-- JUDUL --}}
                    <h2 class="font-bold text-gray-900 mt-1 mb-2 leading-snug
                               group-hover:text-blue-600 transition line-clamp-3">
                        {{ $blog->judul }}
                    </h2>

                    {{-- EXCERPT --}}
                    <p class="text-gray-500 text-xs leading-relaxed mb-3 line-clamp-3">
                        {{ \Illuminate\Support\Str::limit($blog->konten ?? $blog->isi ?? '', 120) }}
                    </p>

                    {{-- TANGGAL --}}
                    <p class="text-xs text-gray-400">
                        {{ \Carbon\Carbon::parse($blog->created_at)->translatedFormat('d F Y') }}
                    </p>
                </div>
            </a>
            @empty
            <div class="col-span-3 text-center py-16 text-gray-400 text-sm">
                Belum ada artikel blog.
            </div>
            @endforelse
        </div>

        {{-- PAGINATION --}}
        @if(method_exists($blogs, 'links'))
        <div class="flex justify-center">
            {{ $blogs->links() }}
        </div>
        @endif

    </main>

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
        document.addEventListener('click', function(e) {
            const dropdown = document.getElementById('profileDropdown');
            if (!e.target.closest('.relative')) {
                dropdown?.classList.add('hidden');
            }
        });
    </script>

</body>

</html>