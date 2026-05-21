<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Kelola Produk & Foto – RuangUsaha</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>

<body class="bg-gray-50 text-gray-800 min-h-screen flex flex-col">

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
                <a href="{{ route('umkm.pilih') }}" class="text-blue-600 transition">Pilih UMKM</a>
                <a href="{{ route('blog.index') }}" class="hover:text-blue-600 transition">
                    Blog
                </a>
            </div>

            <!-- RIGHT : AUTH / PROFILE -->
            <div class="absolute right-6 flex items-center gap-3">
                @guest
                <a href="{{ route('login') }}" class="px-4 py-2 text-sm border rounded-md hover:border-blue-600 hover:text-blue-600 transition">LOGIN</a>
                <a href="{{ route('register') }}" class="px-4 py-2 text-sm bg-blue-600 text-white rounded-md hover:bg-blue-700 active:scale-95 transition-all">SIGN UP</a>
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

                    <div id="profileDropdown" class="hidden absolute right-0 mt-3 w-48 bg-white border rounded-xl shadow-xl overflow-hidden z-50">
                        <a href="{{ route('profile.index') }}" class="block px-4 py-3 text-sm hover:bg-gray-100 transition">Profil Akun</a>

                        @if(auth()->user()->umkm)
                        <a href="{{ route('umkm.dashboard', auth()->user()->umkm->id) }}" class="block px-4 py-3 text-sm hover:bg-gray-100 transition">Dashboard UMKM</a>
                        @else
                        <a href="{{ route('umkm.create') }}"
                            class="block px-4 py-3 text-sm hover:bg-gray-100">
                            Buat UMKM
                        </a>
                        @endif

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full text-left px-4 py-3 text-sm hover:bg-gray-100 transition">Logout</button>
                        </form>
                    </div>
                </div>
                @endauth
            </div>
        </div>
    </nav>

    <!-- ================= CONTENT ================= -->
    <main class="px-6 md:px-20 py-20 flex-grow">

        <div class="mb-6">
            <a href="{{ route('umkm.dashboard', $umkm->id) }}" class="inline-flex items-center gap-1 text-blue-600 text-sm hover:text-blue-700 hover:underline transition-colors duration-200">
                < Kembali
                    </a>
        </div>

        <div class="mt-8 mb-8">
            <h1 class="text-4xl font-bold text-gray-900">Kelola Produk & Foto</h1>
        </div>

        <div class="grid lg:grid-cols-2 gap-10">

            <!-- ================= PRODUK ================= -->
            <section>
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-xl font-bold text-gray-900">Daftar Produk</h2>
                    <a href="{{ route('umkm.produk.create', $umkm->id) }}"
                        class="inline-flex items-center gap-2 bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-blue-700 transition">
                        <span class="text-lg">+</span> Tambah Produk Baru
                    </a>
                </div>

                @if($produk->count())
                <div class="space-y-3">
                    @foreach($produk as $item)
                    <div class="bg-white border border-gray-200 rounded-lg p-4 flex gap-4 items-start hover:border-blue-300 transition">

                        @if($item->foto_produk)
                        <img src="{{ asset('storage/'.$item->foto_produk) }}"
                            class="w-14 h-14 rounded-lg object-cover flex-shrink-0">
                        @else
                        <div class="w-14 h-14 bg-gray-100 rounded-lg flex items-center justify-center text-gray-300 text-lg flex-shrink-0">
                            📷
                        </div>
                        @endif

                        <div class="flex-1 min-w-0">
                            <h3 class="font-semibold text-gray-800 text-sm">{{ $item->nama_produk }}</h3>
                            <p class="text-xs text-gray-500">Makaoran</p>

                            @if($item->harga)
                            <p class="text-sm text-blue-600 font-semibold mt-1">
                                Rp {{ number_format($item->harga) }}
                            </p>
                            @endif
                        </div>

                        <div class="flex gap-2 flex-shrink-0">
                            <a href="{{ route('produk.edit', $item->id) }}"
                                class="text-blue-600 hover:text-blue-800 transition text-lg" title="Edit">
                                ✎
                            </a>

                            <form action="{{ route('produk.destroy', $item->id) }}"
                                method="POST"
                                onsubmit="return confirm('Hapus produk ini?')"
                                class="inline">
                                @csrf
                                @method('DELETE')
                                <button class="text-red-500 hover:text-red-700 transition text-lg" type="submit" title="Delete">
                                    🗑
                                </button>
                            </form>
                        </div>

                    </div>
                    @endforeach
                </div>
                @else
                <div class="bg-white border border-gray-200 rounded-lg p-12 text-center text-gray-400">
                    <div class="text-5xl mb-3">📦</div>
                    <p class="font-medium text-gray-500">Belum ada produk</p>
                    <p class="text-sm mt-1">Tambahkan produk pertama Anda</p>
                </div>
                @endif

            </section>

            <!-- ================= GALERI ================= -->
            <section>
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-xl font-bold text-gray-900">Galeri Foto Usaha</h2>
                    <button onclick="document.getElementById('fotoInput').click()"
                        class="inline-flex items-center gap-2 bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-blue-700 transition">
                        <span class="text-lg">+</span> Tambah Foto Baru
                    </button>
                </div>

                <form action="{{ route('umkm.galeri.store', $umkm->id) }}"
                    method="POST"
                    enctype="multipart/form-data"
                    id="galeriFoto">
                    @csrf
                    <input type="file" name="foto" id="fotoInput" required
                        class="hidden"
                        onchange="document.getElementById('galeriFoto').submit()">
                </form>

                <div class="grid grid-cols-3 gap-4">
                    @forelse($umkm->galeri ?? [] as $foto)
                    <div class="relative group">
                        <img src="{{ asset('storage/'.$foto->foto) }}"
                            class="rounded-lg object-cover h-40 w-full shadow-sm hover:shadow-md transition">
                        <form action="{{ route('umkm.galeri.destroy', $foto->id) }}" method="POST"
                            onsubmit="return confirm('Hapus foto ini?')"
                            class="absolute top-2 right-2 opacity-0 group-hover:opacity-100 transition">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 text-white p-2 rounded-lg text-sm hover:bg-red-600">
                                🗑
                            </button>
                        </form>
                    </div>
                    @empty
                    <div class="col-span-3 bg-gray-50 border-2 border-dashed border-gray-300 rounded-lg p-12 text-center">
                        <div class="text-5xl mb-3 text-gray-300">📷</div>
                        <p class="text-gray-500 font-medium">Belum ada foto</p>
                        <p class="text-gray-400 text-sm mt-1">Klik tombol di atas untuk menambahkan foto</p>
                    </div>
                    @endforelse
                </div>
            </section>

        </div>
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

    <!-- ================= SCRIPT ================= -->
    <script>
        function toggleDropdown() {
            document.getElementById('profileDropdown').classList.toggle('hidden');
        }

        document.addEventListener('click', function(e) {
            const dropdown = document.getElementById('profileDropdown');
            const button = e.target.closest('button');

            if (!e.target.closest('#profileDropdown') && !button) {
                dropdown.classList.add('hidden');
            }
        });
    </script>

</body>

</html>