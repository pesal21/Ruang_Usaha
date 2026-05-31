<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Edit Profil UMKM – RuangUsaha</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

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
        .form-card {
            position: relative;
        }

        .form-card::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(255, 255, 255, .6) 0%, transparent 50%);
            opacity: 0;
            transition: opacity .3s ease;
            pointer-events: none;
            border-radius: inherit;
            z-index: 1;
        }

        .form-card:hover::before {
            opacity: 1;
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
    <main class="relative z-10 flex-1 max-w-3xl mx-auto w-full px-4 sm:px-6 lg:px-8 pt-28 pb-24">

        {{-- ── Back Link ── --}}
        <div class="mb-8">
            <a href="{{ route('umkm.dashboard', $umkm->id) }}"
                class="back-link text-sm text-blue-600 hover:text-blue-700 font-medium transition-colors duration-200">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 flex-shrink-0" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                </svg>
                Kembali ke Dashboard
            </a>
        </div>

        {{-- ── Page Header ── --}}
        <div class="text-center mb-10">
            <div class="inline-flex items-center gap-2 bg-blue-50 border border-blue-100 text-blue-600
                        px-4 py-1.5 rounded-full text-xs font-semibold mb-5 shadow-sm">
                <span class="w-1.5 h-1.5 rounded-full bg-blue-500 animate-pulse"></span>
                Pengaturan UMKM
            </div>
            <h1 class="text-3xl md:text-4xl lg:text-5xl font-extrabold text-gradient leading-tight tracking-tight">
                Edit Profil UMKM
            </h1>
            <p class="text-gray-500 mt-3 max-w-md mx-auto text-sm md:text-base">
                Perbarui informasi usaha Anda agar tetap akurat dan menarik.
            </p>
            <div class="mt-5 flex items-center justify-center gap-2">
                <span class="w-8 h-px bg-blue-200"></span>
                <span class="w-2 h-2 rounded-full bg-teal-400"></span>
                <span class="w-16 h-0.5 bg-gradient-to-r from-blue-400 to-teal-400 rounded-full"></span>
                <span class="w-2 h-2 rounded-full bg-blue-400"></span>
                <span class="w-8 h-px bg-teal-200"></span>
            </div>
        </div>

        {{-- ── FORM CARD ── --}}
        <div class="form-card card-animate bg-white rounded-3xl border border-gray-100 shadow-md shadow-blue-50
                    hover:shadow-xl hover:shadow-blue-100 transition-all duration-300 p-6 sm:p-8">

            <form action="{{ route('umkm.update', $umkm->id) }}"
                method="POST"
                enctype="multipart/form-data"
                class="space-y-6">
                @csrf
                @method('PUT')

                {{-- ERROR MESSAGES --}}
                @if ($errors->any())
                <div class="bg-red-50 border border-red-200 rounded-2xl p-4 flex items-start gap-3">
                    <div class="w-9 h-9 rounded-lg bg-red-100 flex items-center justify-center flex-shrink-0 mt-0.5">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-red-500" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-red-700 mb-1">Perbaiki kesalahan berikut:</p>
                        <ul class="text-sm text-red-600 space-y-0.5">
                            @foreach ($errors->all() as $error)
                            <li class="flex items-center gap-1.5">
                                <span class="w-1 h-1 rounded-full bg-red-400 flex-shrink-0"></span>
                                {{ $error }}
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                @endif

                {{-- LOGO --}}
                <div>
                    <label class="text-xs text-gray-400 uppercase tracking-wide mb-2 block font-semibold">
                        Logo Usaha
                    </label>

                    @if($umkm->logo)
                    <div class="mb-3 flex items-center gap-4">
                        <div class="w-20 h-20 rounded-2xl overflow-hidden border border-blue-100 bg-gradient-to-br from-blue-50 to-teal-50 shadow-sm flex-shrink-0">
                            <img src="{{ asset('storage/'.$umkm->logo) }}"
                                alt="Logo"
                                class="w-full h-full object-cover">
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 font-medium">Logo saat ini</p>
                            <p class="text-xs text-gray-400 mt-0.5">Unggah file baru untuk mengganti</p>
                        </div>
                    </div>
                    @endif

                    <input type="file" name="logo" accept="image/*"
                        class="w-full text-sm text-gray-600 border-2 border-blue-100 rounded-2xl
                                  px-4 py-3 file:mr-4 file:py-2 file:px-4 file:rounded-xl
                                  file:border-0 file:text-xs file:font-semibold
                                  file:bg-gradient-to-r file:from-blue-500 file:to-teal-500 file:text-white
                                  hover:file:from-blue-600 hover:file:to-teal-600
                                  file:transition-all file:duration-200 file:cursor-pointer
                                  file:shadow-md file:shadow-blue-200
                                  bg-white/80 backdrop-blur-sm focus:outline-none
                                  input-field transition-all duration-300">
                    <p class="text-xs text-gray-400 mt-1.5">Kosongkan jika tidak ingin mengganti logo. Format: JPG, PNG. Maks 2MB.</p>
                </div>

                {{-- NAMA + KATEGORI --}}
                <div class="grid md:grid-cols-2 gap-5">
                    <div>
                        <label class="text-xs text-gray-400 uppercase tracking-wide mb-1.5 block font-semibold">
                            Nama Usaha <span class="text-red-400">*</span>
                        </label>
                        <input type="text" name="nama_usaha"
                            value="{{ old('nama_usaha', $umkm->nama_usaha) }}"
                            required
                            placeholder="Masukkan nama usaha"
                            class="input-field w-full border-2 border-blue-100 rounded-2xl py-3 px-4 text-sm
                                      bg-white/80 backdrop-blur-sm focus:outline-none focus:border-blue-400
                                      transition-all duration-300 placeholder:text-gray-400 text-gray-700 font-medium">
                    </div>

                    <div>
                        <label class="text-xs text-gray-400 uppercase tracking-wide mb-1.5 block font-semibold">
                            Kategori Usaha <span class="text-red-400">*</span>
                        </label>
                        <select name="kategori_id" required
                            class="input-field w-full border-2 border-blue-100 rounded-2xl py-3 px-4 text-sm
                                       bg-white/80 backdrop-blur-sm focus:outline-none focus:border-blue-400
                                       transition-all duration-300 text-gray-700 font-medium cursor-pointer">
                            @foreach($kategoris as $kategori)
                            <option value="{{ $kategori->id }}"
                                {{ old('kategori_id', $umkm->kategori_id) == $kategori->id ? 'selected' : '' }}>
                                {{ $kategori->nama }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                {{-- DESKRIPSI --}}
                <div>
                    <label class="text-xs text-gray-400 uppercase tracking-wide mb-1.5 block font-semibold">
                        Deskripsi <span class="text-red-400">*</span>
                    </label>
                    <textarea name="deskripsi" rows="4" required
                        placeholder="Deskripsikan usaha Anda secara singkat dan menarik..."
                        class="input-field w-full border-2 border-blue-100 rounded-2xl py-3 px-4 text-sm
                                     bg-white/80 backdrop-blur-sm focus:outline-none focus:border-blue-400
                                     transition-all duration-300 placeholder:text-gray-400 text-gray-700
                                     font-medium resize-none">{{ old('deskripsi', $umkm->deskripsi) }}</textarea>
                </div>

                {{-- ALAMAT --}}
                <div>
                    <label class="text-xs text-gray-400 uppercase tracking-wide mb-1.5 block font-semibold">
                        Alamat Lengkap <span class="text-red-400">*</span>
                    </label>
                    <textarea name="alamat_lengkap" rows="2" required
                        placeholder="Tuliskan alamat lengkap usaha Anda..."
                        class="input-field w-full border-2 border-blue-100 rounded-2xl py-3 px-4 text-sm
                                     bg-white/80 backdrop-blur-sm focus:outline-none focus:border-blue-400
                                     transition-all duration-300 placeholder:text-gray-400 text-gray-700
                                     font-medium resize-none">{{ old('alamat_lengkap', $umkm->alamat_lengkap) }}</textarea>
                </div>

                {{-- JENIS + JAM --}}
                <div class="grid md:grid-cols-2 gap-5">
                    <div>
                        <label class="text-xs text-gray-400 uppercase tracking-wide mb-1.5 block font-semibold">
                            Jenis UMKM <span class="text-red-400">*</span>
                        </label>
                        <select name="jenis_umkm" required
                            class="input-field w-full border-2 border-blue-100 rounded-2xl py-3 px-4 text-sm
                                       bg-white/80 backdrop-blur-sm focus:outline-none focus:border-blue-400
                                       transition-all duration-300 text-gray-700 font-medium cursor-pointer">
                            <option value="Toko Fisik" {{ old('jenis_umkm', $umkm->jenis_umkm) == 'Toko Fisik'  ? 'selected' : '' }}>Toko Fisik</option>
                            <option value="Toko Online" {{ old('jenis_umkm', $umkm->jenis_umkm) == 'Toko Online' ? 'selected' : '' }}>Toko Online</option>
                        </select>
                    </div>

                    <div>
                        <label class="text-xs text-gray-400 uppercase tracking-wide mb-1.5 block font-semibold">
                            Jam Operasional <span class="text-red-400">*</span>
                        </label>
                        <input type="text" name="jam_operasional"
                            value="{{ old('jam_operasional', $umkm->jam_operasional) }}"
                            placeholder="Contoh: 08.00 - 21.00 WITA"
                            required
                            class="input-field w-full border-2 border-blue-100 rounded-2xl py-3 px-4 text-sm
                                      bg-white/80 backdrop-blur-sm focus:outline-none focus:border-blue-400
                                      transition-all duration-300 placeholder:text-gray-400 text-gray-700 font-medium">
                    </div>
                </div>

                {{-- KONTAK + SOSMED --}}
                <div class="grid md:grid-cols-2 gap-5">
                    <div>
                        <label class="text-xs text-gray-400 uppercase tracking-wide mb-1.5 block font-semibold">
                            Kontak / WhatsApp
                        </label>
                        <input type="text" name="kontak"
                            value="{{ old('kontak', $umkm->kontak) }}"
                            placeholder="081234567890"
                            class="input-field w-full border-2 border-blue-100 rounded-2xl py-3 px-4 text-sm
                                      bg-white/80 backdrop-blur-sm focus:outline-none focus:border-blue-400
                                      transition-all duration-300 placeholder:text-gray-400 text-gray-700 font-medium">
                    </div>

                    <div>
                        <label class="text-xs text-gray-400 uppercase tracking-wide mb-1.5 block font-semibold">
                            Sosial Media <span class="text-gray-400 font-normal normal-case text-xs">(opsional)</span>
                        </label>
                        <input type="text" name="sosial_media"
                            value="{{ old('sosial_media', $umkm->sosial_media) }}"
                            placeholder="https://instagram.com/namausaha"
                            class="input-field w-full border-2 border-blue-100 rounded-2xl py-3 px-4 text-sm
                                      bg-white/80 backdrop-blur-sm focus:outline-none focus:border-blue-400
                                      transition-all duration-300 placeholder:text-gray-400 text-gray-700 font-medium">
                    </div>
                </div>

                {{-- BUTTONS --}}
                <div class="flex flex-col sm:flex-row gap-3 pt-6 border-t-2 border-blue-50">
                    <button type="submit"
                        class="btn-shimmer inline-flex items-center justify-center gap-2 px-6 py-3
                               bg-gradient-to-r from-blue-600 to-teal-500 text-white
                               font-semibold text-sm rounded-2xl shadow-lg shadow-blue-200
                               hover:shadow-xl hover:shadow-blue-300 hover:-translate-y-0.5
                               active:scale-95 transition-all duration-200">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                        </svg>
                        Simpan Perubahan
                    </button>
                    <a href="{{ route('umkm.dashboard', $umkm->id) }}"
                        class="inline-flex items-center justify-center gap-2 px-6 py-3
                              border-2 border-blue-200 text-blue-700 font-semibold text-sm
                              rounded-2xl hover:bg-blue-50 hover:border-blue-300
                              hover:-translate-y-0.5 active:scale-95 transition-all duration-200">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                        Batal
                    </a>
                </div>

            </form>
        </div>

    </main>

    {{-- ── FOOTER ── --}}
    @include('partials.footer')

</body>

</html>