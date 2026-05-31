<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Profil Akun – RuangUsaha</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <script src="https://cdn.tailwindcss.com">
    </script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        /* ── Animated gradient mesh background ── */
        .hero-bg {
            background-color: #eff6ff;
            background-image:
                radial-gradient(ellipse 80% 60% at 20% -10%, rgba(96, 165, 250, .18) 0%, transparent 60%),
                radial-gradient(ellipse 60% 50% at 85% 10%, rgba(45, 212, 191, .14) 0%, transparent 55%),
                radial-gradient(ellipse 50% 40% at 50% 100%, rgba(59, 130, 246, .10) 0%, transparent 60%);
        }

        /* ── Noise texture overlay ── */
        .noise::after {
            content: '';
            position: fixed;
            inset: 0;
            pointer-events: none;
            opacity: .025;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)'/%3E%3C/svg%3E");
            background-size: 128px 128px;
            z-index: 0;
        }

        /* ── Gradient text ── */
        .text-gradient {
            background: linear-gradient(135deg, #1d4ed8 0%, #0891b2 50%, #0d9488 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* ── Animated underline for back link ── */
        .back-link {
            position: relative;
            display: inline-flex;
            align-items: center;
            gap: .35rem;
        }

        .back-link::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 1.5rem;
            right: 0;
            height: 1.5px;
            background: currentColor;
            transform: scaleX(0);
            transform-origin: left;
            transition: transform .25s ease;
        }

        .back-link:hover::after {
            transform: scaleX(1);
        }

        /* ── Button shimmer ── */
        .btn-shimmer {
            position: relative;
            overflow: hidden;
        }

        .btn-shimmer::after {
            content: '';
            position: absolute;
            top: 0;
            left: -80%;
            width: 60%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, .25), transparent);
            transition: left .5s ease;
        }

        .btn-shimmer:hover::after {
            left: 150%;
        }

        /* ── Form input focus glow ── */
        .input-field:focus {
            box-shadow: 0 0 0 4px rgba(59, 130, 246, .12), 0 4px 20px rgba(59, 130, 246, .08);
        }

        /* ── Select custom arrow ── */
        select.input-field {
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='8' fill='none'%3E%3Cpath d='M1 1l5 5 5-5' stroke='%236b7280' stroke-width='1.5' stroke-linecap='round' stroke-linejoin='round'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 14px center;
            padding-right: 36px !important;
        }

        /* ── Card shine effect ── */
        .profile-card {
            position: relative;
        }

        .profile-card::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(255, 255, 255, .6) 0%, transparent 25%);
            opacity: 0;
            transition: opacity .3s ease;
            pointer-events: none;
            border-radius: inherit;
            z-index: 1;
        }

        .profile-card:hover::before {
            opacity: 1;
        }

        /* ── Drag & drop area ── */
        .drag-area {
            border: 2px dashed #bfdbfe;
            transition: all 0.3s ease;
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(4px);
        }

        .drag-area.active {
            border-color: #3b82f6;
            background: #eff6ff;
            box-shadow: 0 0 0 6px rgba(59, 130, 246, 0.08);
        }

        .drag-area:hover {
            border-color: #93c5fd;
            background: #f8faff;
        }

        /* ── Page load fade-in for main content ── */
        @keyframes fadeInMain {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .page-enter {
            animation: fadeInMain 0.6s ease forwards;
        }

        /* ── Staggered entrance ── */
        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        .card-animate {
            animation: fadeUp .5s ease both;
        }
    </style>
</head>

<body class="hero-bg noise text-gray-800 antialiased min-h-screen flex flex-col">

    {{-- ── NAVBAR ── --}}
    @include('partials.navbar')

    {{-- ── MAIN CONTENT ── --}}
    <main class="relative z-10 flex-1 max-w-3xl mx-auto w-full px-4 sm:px-6 lg:px-8 pt-28 pb-24 page-enter">

        {{-- ── Back Link ── --}}
        <div class="mb-8 card-animate" style="animation-delay: 0.1s;">
            <a href="{{ route('beranda') }}"
                class="back-link text-sm text-blue-600 hover:text-blue-700 font-medium transition-colors duration-200">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 flex-shrink-0" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                </svg>
                Kembali ke Beranda
            </a>
        </div>

        {{-- ── Page Header ── --}}
        <div class="text-center mb-10 card-animate" style="animation-delay: 0.15s;">
            <div class="inline-flex items-center gap-2 bg-blue-50 border border-blue-100 text-blue-600
                        px-4 py-1.5 rounded-full text-xs font-semibold mb-5 shadow-sm">
                <span class="w-1.5 h-1.5 rounded-full bg-blue-500 animate-pulse"></span>
                Pengaturan Akun
            </div>
            <h1 class="text-3xl md:text-4xl lg:text-5xl font-extrabold text-gradient leading-tight tracking-tight">
                Profil Akun
            </h1>
            <p class="text-gray-500 mt-4 max-w-md mx-auto text-base leading-relaxed">
                Kelola informasi akun dan keamanan Anda.
            </p>
            <div class="mt-5 flex items-center justify-center gap-2">
                <span class="w-8 h-px bg-blue-200"></span>
                <span class="w-2 h-2 rounded-full bg-teal-400"></span>
                <span class="w-16 h-0.5 bg-gradient-to-r from-blue-400 to-teal-400 rounded-full"></span>
                <span class="w-2 h-2 rounded-full bg-blue-400"></span>
                <span class="w-8 h-px bg-teal-200"></span>
            </div>
        </div>

        {{-- SUCCESS MESSAGE --}}
        @if(session('success'))
        <div class="card-animate mb-8 px-5 py-4 bg-green-50 border border-green-200 text-green-700 rounded-2xl text-sm flex items-center gap-3"
             style="animation-delay: 0.2s;">
            <div class="w-9 h-9 rounded-lg bg-green-100 flex items-center justify-center flex-shrink-0">
                <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
                </svg>
            </div>
            <span class="font-medium">{{ session('success') }}</span>
        </div>
        @endif

        {{-- ================= FOTO PROFIL CARD ================= --}}
        <div class="profile-card card-animate bg-white rounded-3xl border border-gray-100 shadow-md shadow-blue-50
                    hover:shadow-xl hover:shadow-blue-100 transition-all duration-300 p-6 sm:p-8 mb-6"
             style="animation-delay: 0.2s;">

            <div class="flex items-center gap-3 mb-6">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-blue-100 to-teal-100
                            flex items-center justify-center shadow-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-blue-600" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                </div>
                <h2 class="text-lg font-bold text-gray-800">Foto Profil</h2>
            </div>

            <div class="grid md:grid-cols-2 gap-8">
                {{-- Foto Saat Ini --}}
                <div class="flex flex-col items-center justify-center">
                    @if(auth()->user()->profile_picture)
                    <img src="{{ asset('storage/'.auth()->user()->profile_picture) }}"
                        alt="Profile Picture"
                        class="w-28 h-28 rounded-full object-cover border-4 border-blue-100 shadow-md mb-3">
                    @else
                    <div class="w-28 h-28 rounded-full bg-gradient-to-br from-blue-500 to-teal-500 text-white flex items-center 
                                justify-center text-4xl font-bold border-4 border-blue-100 shadow-md mb-3">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>
                    @endif
                    <p class="text-xs text-gray-400 font-medium">
                        {{ auth()->user()->profile_picture ? 'Foto profil saat ini' : 'Belum ada foto profil' }}
                    </p>
                </div>

                {{-- Upload Form --}}
                <div>
                    <form method="POST" action="{{ route('profile.picture') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="drag-area rounded-2xl p-6 text-center cursor-pointer mb-3"
                            id="dragArea"
                            onclick="document.getElementById('photoInput').click()">

                            <div id="uploadPlaceholder">
                                <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-blue-50 to-teal-50
                                            flex items-center justify-center mx-auto mb-3 shadow-sm">
                                    <svg class="w-7 h-7 text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                    </svg>
                                </div>
                                <p class="text-sm text-gray-600 font-medium mb-1">
                                    <span class="text-blue-600">Klik untuk upload</span> atau seret dan lepas
                                </p>
                                <p class="text-xs text-gray-400">PNG, JPG (maks. 2MB)</p>
                            </div>

                            <div id="uploadPreview" class="hidden">
                                <img id="previewImg" src="" alt="Preview"
                                    class="w-20 h-20 rounded-full object-cover mx-auto mb-2 shadow-sm">
                                <p id="fileName" class="text-xs text-gray-500 font-medium"></p>
                                <button type="button" onclick="event.stopPropagation(); resetUpload()"
                                    class="mt-2 text-xs text-red-500 hover:text-red-600 font-semibold hover:underline transition-colors">
                                    Hapus & Ganti Foto
                                </button>
                            </div>

                            <input type="file" id="photoInput" name="profile_picture" accept="image/*" class="hidden">
                        </div>

                        @error('profile_picture')
                        <p class="text-xs text-red-500 mb-2 flex items-center gap-1">
                            <span class="w-1 h-1 rounded-full bg-red-400 flex-shrink-0"></span>
                            {{ $message }}
                        </p>
                        @enderror

                        <button type="submit"
                            class="btn-shimmer w-full py-3 bg-gradient-to-r from-blue-600 to-teal-500 text-white text-sm 
                                   font-semibold rounded-2xl shadow-md shadow-blue-200 hover:shadow-lg hover:shadow-blue-300 
                                   hover:-translate-y-0.5 active:scale-95 transition-all duration-300">
                            <span class="flex items-center justify-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                </svg>
                                Simpan Foto Profil
                            </span>
                        </button>
                    </form>
                </div>
            </div>
        </div>

        {{-- ================= INFORMASI AKUN CARD ================= --}}
        <div class="profile-card card-animate bg-white rounded-3xl border border-gray-100 shadow-md shadow-blue-50
                    hover:shadow-xl hover:shadow-blue-100 transition-all duration-300 p-6 sm:p-8 mb-6"
             style="animation-delay: 0.25s;">

            <div class="flex items-center gap-3 mb-6">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-blue-100 to-teal-100
                            flex items-center justify-center shadow-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-blue-600" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </div>
                <h2 class="text-lg font-bold text-gray-800">Informasi Akun</h2>
            </div>

            <form method="POST" action="{{ route('profile.update') }}" class="space-y-5">
                @csrf

                <div>
                    <label class="text-xs text-gray-400 uppercase tracking-wide mb-1.5 block font-semibold">
                        Nama Lengkap
                    </label>
                    <input type="text" name="name"
                        value="{{ old('name', auth()->user()->name) }}"
                        placeholder="Masukkan nama lengkap"
                        class="input-field w-full border-2 border-blue-100 rounded-2xl py-3 px-4 text-sm
                                  bg-white/80 backdrop-blur-sm focus:outline-none focus:border-blue-400
                                  transition-all duration-300 placeholder:text-gray-400 text-gray-700 font-medium">
                    @error('name')
                    <p class="text-xs text-red-500 mt-1.5 flex items-center gap-1">
                        <span class="w-1 h-1 rounded-full bg-red-400 flex-shrink-0"></span>
                        {{ $message }}
                    </p>
                    @enderror
                </div>

                <div>
                    <label class="text-xs text-gray-400 uppercase tracking-wide mb-1.5 block font-semibold">
                        Email
                    </label>
                    <input type="email" name="email"
                        value="{{ old('email', auth()->user()->email) }}"
                        placeholder="Masukkan alamat email"
                        class="input-field w-full border-2 border-blue-100 rounded-2xl py-3 px-4 text-sm
                                  bg-white/80 backdrop-blur-sm focus:outline-none focus:border-blue-400
                                  transition-all duration-300 placeholder:text-gray-400 text-gray-700 font-medium">
                    @error('email')
                    <p class="text-xs text-red-500 mt-1.5 flex items-center gap-1">
                        <span class="w-1 h-1 rounded-full bg-red-400 flex-shrink-0"></span>
                        {{ $message }}
                    </p>
                    @enderror
                </div>

                <div class="pt-2">
                    <button type="submit"
                        class="btn-shimmer inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-blue-600 to-teal-500 text-white text-sm 
                               font-semibold rounded-2xl shadow-md shadow-blue-200 hover:shadow-lg hover:shadow-blue-300 
                               hover:-translate-y-0.5 active:scale-95 transition-all duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                        </svg>
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>

        {{-- ================= UBAH PASSWORD CARD ================= --}}
        <div class="profile-card card-animate bg-white rounded-3xl border border-gray-100 shadow-md shadow-blue-50
                    hover:shadow-xl hover:shadow-blue-100 transition-all duration-300 p-6 sm:p-8"
             style="animation-delay: 0.3s;">

            <div class="flex items-center gap-3 mb-6">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-amber-100 to-orange-100
                            flex items-center justify-center shadow-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-amber-600" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                </div>
                <h2 class="text-lg font-bold text-gray-800">Ubah Password</h2>
            </div>

            <form method="POST" action="{{ route('profile.password') }}" class="space-y-5">
                @csrf

                <div>
                    <label class="text-xs text-gray-400 uppercase tracking-wide mb-1.5 block font-semibold">
                        Password Lama
                    </label>
                    <input type="password" name="password_lama"
                        placeholder="Masukkan password lama"
                        class="input-field w-full border-2 border-blue-100 rounded-2xl py-3 px-4 text-sm
                                  bg-white/80 backdrop-blur-sm focus:outline-none focus:border-blue-400
                                  transition-all duration-300 placeholder:text-gray-400 text-gray-700 font-medium">
                    @error('password_lama')
                    <p class="text-xs text-red-500 mt-1.5 flex items-center gap-1">
                        <span class="w-1 h-1 rounded-full bg-red-400 flex-shrink-0"></span>
                        {{ $message }}
                    </p>
                    @enderror
                </div>

                <div>
                    <label class="text-xs text-gray-400 uppercase tracking-wide mb-1.5 block font-semibold">
                        Password Baru
                    </label>
                    <input type="password" name="password_baru"
                        placeholder="Masukkan password baru"
                        class="input-field w-full border-2 border-blue-100 rounded-2xl py-3 px-4 text-sm
                                  bg-white/80 backdrop-blur-sm focus:outline-none focus:border-blue-400
                                  transition-all duration-300 placeholder:text-gray-400 text-gray-700 font-medium">
                </div>

                <div>
                    <label class="text-xs text-gray-400 uppercase tracking-wide mb-1.5 block font-semibold">
                        Konfirmasi Password Baru
                    </label>
                    <input type="password" name="password_baru_confirmation"
                        placeholder="Konfirmasi password baru"
                        class="input-field w-full border-2 border-blue-100 rounded-2xl py-3 px-4 text-sm
                                  bg-white/80 backdrop-blur-sm focus:outline-none focus:border-blue-400
                                  transition-all duration-300 placeholder:text-gray-400 text-gray-700 font-medium">
                </div>

                <div class="pt-2">
                    <button type="submit"
                        class="btn-shimmer inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-gray-700 to-gray-800 text-white text-sm 
                               font-semibold rounded-2xl shadow-md shadow-gray-200 hover:shadow-lg hover:shadow-gray-300 
                               hover:-translate-y-0.5 active:scale-95 transition-all duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                        Ubah Password
                    </button>
                </div>
            </form>
        </div>

    </main>

    {{-- ── FOOTER ── --}}
    @include('partials.footer')

    {{-- Script drag & drop --}}
    <script>
        const dragArea = document.getElementById('dragArea');
        const photoInput = document.getElementById('photoInput');
        const placeholder = document.getElementById('uploadPlaceholder');
        const preview = document.getElementById('uploadPreview');
        const previewImg = document.getElementById('previewImg');
        const fileName = document.getElementById('fileName');

        photoInput.addEventListener('change', () => {
            if (photoInput.files.length > 0) {
                handleFile(photoInput.files[0]);
            }
        });

        dragArea.addEventListener('dragover', e => {
            e.preventDefault();
            dragArea.classList.add('active');
        });

        dragArea.addEventListener('dragleave', () => {
            dragArea.classList.remove('active');
        });

        dragArea.addEventListener('drop', e => {
            e.preventDefault();
            dragArea.classList.remove('active');
            const file = e.dataTransfer.files[0];
            if (file) {
                if (file.size > 2 * 1024 * 1024) {
                    alert('Ukuran file maksimal 2MB');
                    return;
                }
                photoInput.files = e.dataTransfer.files;
                handleFile(file);
            }
        });

        function handleFile(file) {
            if (!file) return;
            fileName.textContent = file.name;
            if (file.type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = e => {
                    previewImg.src = e.target.result;
                };
                reader.readAsDataURL(file);
                previewImg.classList.remove('hidden');
            } else {
                previewImg.classList.add('hidden');
            }
            placeholder.classList.add('hidden');
            preview.classList.remove('hidden');
        }

        function resetUpload() {
            photoInput.value = '';
            previewImg.src = '';
            fileName.textContent = '';
            placeholder.classList.remove('hidden');
            preview.classList.add('hidden');
        }
    </script>

</body>
</html>