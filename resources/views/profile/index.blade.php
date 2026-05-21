<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Profil Akun – RuangUsaha</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        .drag-area {
            border: 2px dashed #cbd5e1;
            transition: border-color 0.2s, background 0.2s;
        }

        .drag-area.active {
            border-color: #3b82f6;
            background: #eff6ff;
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
                        <a href="{{ route('umkm.create') }}" class="block px-4 py-3 text-sm hover:bg-gray-100 transition">Daftarkan UMKM</a>
                        <a href="{{ route('umkm.create') }}"
                            class="block px-4 py-3 text-sm hover:bg-gray-100">
                            Buat UMKM
                        </a>
                        @endif

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                class="w-full text-left px-4 py-3 text-sm text-red-600
                                   hover:bg-red-50 transition-colors duration-200
                                   flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                </svg>
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
                @endauth
            </div>
        </div>
    </nav>
    <!-- CONTENT -->
    <main class="flex-1 max-w-3xl mx-auto w-full px-4 py-10 mt-20">

        <!-- HEADER -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Profil Akun</h1>
            <p class="text-gray-400 text-sm mt-1">Kelola informasi akun dan keamanan Anda.</p>
        </div>

        {{-- SUCCESS MESSAGE --}}
        @if(session('success'))
        <div class="mb-6 px-4 py-3 bg-green-50 border border-green-200 text-green-700
                    rounded-xl text-sm flex items-center gap-2">
            <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
            </svg>
            {{ session('success') }}
        </div>
        @endif

        <!-- ===== FOTO PROFIL ===== -->
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 mb-6">
            <h2 class="text-base font-semibold text-gray-800 mb-6">Foto Profil</h2>

            <div class="grid md:grid-cols-2 gap-8">

                {{-- FOTO SAAT INI --}}
                <div class="flex flex-col items-center justify-center">
                    @if(auth()->user()->profile_picture)
                    <img src="{{ asset('storage/'.auth()->user()->profile_picture) }}"
                        alt="Profile Picture"
                        class="w-28 h-28 rounded-full object-cover border-4 border-blue-100 shadow-sm mb-3">
                    @else
                    <div class="w-28 h-28 rounded-full bg-blue-600 text-white flex items-center
                                justify-center text-4xl font-bold border-4 border-blue-100 shadow-sm mb-3">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>
                    @endif
                    <p class="text-xs text-gray-400">
                        {{ auth()->user()->profile_picture ? 'Foto profil saat ini' : 'Belum ada foto profil' }}
                    </p>
                </div>

                {{-- UPLOAD FORM --}}
                <div>
                    <form method="POST" action="{{ route('profile.picture') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="drag-area rounded-xl p-6 text-center cursor-pointer mb-3"
                            id="dragArea"
                            onclick="document.getElementById('photoInput').click()">

                            <div id="uploadPlaceholder">
                                <svg class="w-8 h-8 text-gray-300 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                        d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                </svg>
                                <p class="text-sm text-gray-500">
                                    <span class="text-blue-600 font-medium">Klik untuk upload</span> atau seret dan lepas
                                </p>
                                <p class="text-xs text-gray-400 mt-1">PNG, JPG (maks. 2MB)</p>
                            </div>

                            <div id="uploadPreview" class="hidden">
                                <img id="previewImg" src="" alt="Preview"
                                    class="w-20 h-20 rounded-full object-cover mx-auto mb-2">
                                <p id="fileName" class="text-xs text-gray-400"></p>
                            </div>

                            <input type="file" id="photoInput" name="profile_picture" accept="image/*" class="hidden">
                        </div>

                        @error('profile_picture')
                        <p class="text-xs text-red-500 mb-2">{{ $message }}</p>
                        @enderror

                        <button type="submit"
                            class="w-full py-2.5 bg-blue-600 hover:bg-blue-700 text-white text-sm
                                   font-semibold rounded-xl transition">
                            Simpan Foto Profil
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- ===== INFORMASI AKUN ===== -->
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 mb-6">
            <h2 class="text-base font-semibold text-gray-800 mb-5">Informasi Akun</h2>

            <form method="POST" action="{{ route('profile.update') }}" class="space-y-4">
                @csrf

                <div>
                    <label class="text-xs text-gray-400 uppercase tracking-wide mb-1.5 block">Nama</label>
                    <input type="text" name="name"
                        value="{{ old('name', auth()->user()->name) }}"
                        class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm bg-gray-50
                                  focus:outline-none focus:ring-2 focus:ring-blue-500 focus:bg-white transition">
                    @error('name')
                    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="text-xs text-gray-400 uppercase tracking-wide mb-1.5 block">Email</label>
                    <input type="email" name="email"
                        value="{{ old('email', auth()->user()->email) }}"
                        class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm bg-gray-50
                                  focus:outline-none focus:ring-2 focus:ring-blue-500 focus:bg-white transition">
                    @error('email')
                    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="pt-2">
                    <button type="submit"
                        class="px-6 py-2.5 bg-blue-600 hover:bg-blue-700 text-white text-sm
                               font-semibold rounded-xl transition shadow-sm">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>

        <!-- ===== UBAH PASSWORD ===== -->
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
            <h2 class="text-base font-semibold text-gray-800 mb-5">Ubah Password</h2>

            <form method="POST" action="{{ route('profile.password') }}" class="space-y-4">
                @csrf

                <div>
                    <label class="text-xs text-gray-400 uppercase tracking-wide mb-1.5 block">Password Lama</label>
                    <input type="password" name="password_lama"
                        class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm bg-gray-50
                                  focus:outline-none focus:ring-2 focus:ring-blue-500 focus:bg-white transition">
                    @error('password_lama')
                    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="text-xs text-gray-400 uppercase tracking-wide mb-1.5 block">Password Baru</label>
                    <input type="password" name="password_baru"
                        class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm bg-gray-50
                                  focus:outline-none focus:ring-2 focus:ring-blue-500 focus:bg-white transition">
                </div>

                <div>
                    <label class="text-xs text-gray-400 uppercase tracking-wide mb-1.5 block">Konfirmasi Password Baru</label>
                    <input type="password" name="password_baru_confirmation"
                        class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm bg-gray-50
                                  focus:outline-none focus:ring-2 focus:ring-blue-500 focus:bg-white transition">
                </div>

                <div class="pt-2">
                    <button type="submit"
                        class="px-6 py-2.5 bg-gray-800 hover:bg-black text-white text-sm
                               font-semibold rounded-xl transition shadow-sm">
                        Ubah Password
                    </button>
                </div>
            </form>
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

    <script>
        const dragArea = document.getElementById('dragArea');
        const photoInput = document.getElementById('photoInput');

        ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(e => {
            dragArea.addEventListener(e, ev => {
                ev.preventDefault();
                ev.stopPropagation();
            });
        });
        ['dragenter', 'dragover'].forEach(e => dragArea.addEventListener(e, () => dragArea.classList.add('active')));
        ['dragleave', 'drop'].forEach(e => dragArea.addEventListener(e, () => dragArea.classList.remove('active')));

        dragArea.addEventListener('drop', e => {
            photoInput.files = e.dataTransfer.files;
            handleFiles(e.dataTransfer.files);
        });
        photoInput.addEventListener('change', () => handleFiles(photoInput.files));

        function handleFiles(files) {
            if (!files.length) return;
            const file = files[0];
            if (file.size > 2 * 1024 * 1024) {
                alert('Ukuran file maksimal 2MB');
                return;
            }
            const reader = new FileReader();
            reader.onload = e => {
                document.getElementById('uploadPlaceholder').classList.add('hidden');
                document.getElementById('uploadPreview').classList.remove('hidden');
                document.getElementById('previewImg').src = e.target.result;
                document.getElementById('fileName').textContent = file.name;
            };
            reader.readAsDataURL(file);
        }
    </script>

</body>

</html>