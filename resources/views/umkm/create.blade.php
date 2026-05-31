<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir Pendaftaran Usaha – RuangUsaha</title>

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
        .input-field {
            transition: all 0.3s ease;
        }
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
            display: none;
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

        /* ── Page load fade-in ── */
        @keyframes fadeInMain {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .page-enter {
            animation: fadeInMain 0.6s ease forwards;
        }

        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .card-animate {
            animation: fadeUp .5s ease both;
        }

        /* ── Decorative grid pattern ── */
        .bg-grid {
            background-image: 
                linear-gradient(rgba(59, 130, 246, 0.03) 1px, transparent 1px),
                linear-gradient(90deg, rgba(59, 130, 246, 0.03) 1px, transparent 1px);
            background-size: 40px 40px;
        }
    </style>
</head>

<body class="hero-bg noise text-gray-800 antialiased min-h-screen flex flex-col">

    {{-- ── NAVBAR ── --}}
    @include('partials.navbar')

    {{-- ── MAIN CONTENT ── --}}
    <main class="relative z-10 flex-1 max-w-4xl mx-auto w-full px-4 sm:px-6 lg:px-8 pt-28 pb-24 page-enter">

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
        <div class="text-center mb-12 card-animate" style="animation-delay: 0.15s;">
            <div class="inline-flex items-center gap-2 bg-blue-50 border border-blue-100 text-blue-600
                        px-4 py-1.5 rounded-full text-xs font-semibold mb-5 shadow-sm">
                <span class="w-1.5 h-1.5 rounded-full bg-blue-500 animate-pulse"></span>
                Pendaftaran UMKM
            </div>
            <h1 class="text-3xl md:text-4xl lg:text-5xl font-extrabold text-gradient leading-tight tracking-tight">
                Bergabung Bersama RuangUsaha!
            </h1>
            <p class="text-gray-500 mt-4 max-w-md mx-auto text-base leading-relaxed">
                Daftarkan usahamu untuk memperluas jangkauan dan dikenal oleh masyarakat Bontang.
            </p>
            {{-- Decorative divider --}}
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
                    hover:shadow-2xl hover:shadow-blue-100 transition-all duration-500 p-6 sm:p-10 bg-grid"
             style="animation-delay: 0.2s;">

            {{-- Header dengan ikon --}}
            <div class="flex items-center gap-4 mb-10 pb-6 border-b border-gray-100">
                <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-blue-500 to-teal-500
                            flex items-center justify-center shadow-lg shadow-blue-200 flex-shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-white" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0H5m14 0h2M5 21H3M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                    </svg>
                </div>
                <div>
                    <h2 class="text-xl font-bold text-gray-900">Formulir Pendaftaran Usaha</h2>
                    <p class="text-sm text-gray-500 mt-0.5">Isi data usaha Anda dengan lengkap dan benar</p>
                </div>
            </div>

            <form action="{{ route('umkm.store') }}" method="POST" enctype="multipart/form-data" onsubmit="return handleSubmit(this)">
                @csrf

                {{-- ERROR MESSAGES --}}
                @if ($errors->any())
                <div class="bg-red-50 border border-red-200 rounded-2xl p-4 mb-8 flex items-start gap-3">
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

                {{-- ================= BAGIAN 1: INFORMASI DASAR ================= --}}
                <div class="mb-10">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-9 h-9 rounded-xl bg-gradient-to-br from-blue-100 to-blue-200 
                                    flex items-center justify-center shadow-sm flex-shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-blue-600" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                        <h3 class="text-base font-bold text-gray-800">Informasi Dasar</h3>
                    </div>

                    <div class="grid md:grid-cols-2 gap-5">
                        {{-- Nama Usaha --}}
                        <div>
                            <label class="text-xs text-gray-500 uppercase tracking-wide mb-1.5 flex items-center gap-1.5 font-semibold">
                                {{-- Ikon untuk Nama Usaha --}}
                                <svg class="w-3.5 h-3.5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0H5m14 0h2M5 21H3"/>
                                </svg>
                                Nama Usaha <span class="text-red-400">*</span>
                            </label>
                            <div class="relative">
                                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0H5m14 0h2M5 21H3"/>
                                    </svg>
                                </span>
                                <input type="text" name="nama_usaha" value="{{ old('nama_usaha') }}" required
                                    placeholder="Kedai Kopi Senja"
                                    class="input-field w-full border-2 border-blue-100 rounded-2xl py-3 pl-11 pr-4 text-sm
                                              bg-white/80 backdrop-blur-sm focus:outline-none focus:border-blue-400
                                              transition-all duration-300 placeholder:text-gray-300 text-gray-700 font-medium">
                            </div>
                        </div>

                        {{-- Kategori Usaha --}}
                        <div>
                            <label class="text-xs text-gray-500 uppercase tracking-wide mb-1.5 flex items-center gap-1.5 font-semibold">
                                {{-- Ikon untuk Kategori --}}
                                <svg class="w-3.5 h-3.5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A2 2 0 013 12V7a4 4 0 014-4z"/>
                                </svg>
                                Kategori Usaha <span class="text-red-400">*</span>
                            </label>
                            <div class="relative">
                                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A2 2 0 013 12V7a4 4 0 014-4z"/>
                                    </svg>
                                </span>
                                <select name="kategori_id" required
                                    class="input-field w-full border-2 border-blue-100 rounded-2xl py-3 pl-11 pr-4 text-sm
                                               bg-white/80 backdrop-blur-sm focus:outline-none focus:border-blue-400
                                               transition-all duration-300 text-gray-700 font-medium cursor-pointer appearance-none"
                                    style="background-image: url('data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 width=%2212%22 height=%228%22 fill=%22none%22%3E%3Cpath d=%22M1 1l5 5 5-5%22 stroke=%22%236b7280%22 stroke-width=%221.5%22 stroke-linecap=%22round%22 stroke-linejoin=%22round%22/%3E%3C/svg%3E'); background-repeat: no-repeat; background-position: right 14px center; padding-right: 36px;">
                                    <option value="">Pilih kategori</option>
                                    @foreach ($kategoris as $kategori)
                                    <option value="{{ $kategori->id }}" {{ old('kategori_id') == $kategori->id ? 'selected' : '' }}>
                                        {{ $kategori->nama }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    {{-- Deskripsi --}}
                    <div class="mt-5">
                        <label class="text-xs text-gray-500 uppercase tracking-wide mb-1.5 flex items-center gap-1.5 font-semibold">
                            {{-- Ikon untuk Deskripsi --}}
                            <svg class="w-3.5 h-3.5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            Deskripsi Singkat Usaha <span class="text-red-400">*</span>
                        </label>
                        <textarea name="deskripsi" required rows="3"
                            placeholder="Jelaskan secara singkat tentang usaha Anda..."
                            class="input-field w-full border-2 border-blue-100 rounded-2xl py-3 px-4 text-sm
                                         bg-white/80 backdrop-blur-sm focus:outline-none focus:border-blue-400
                                         transition-all duration-300 placeholder:text-gray-300 text-gray-700
                                         font-medium resize-none">{{ old('deskripsi') }}</textarea>
                    </div>
                </div>

                {{-- ================= BAGIAN 2: DETAIL USAHA ================= --}}
                <div class="mb-10">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-9 h-9 rounded-xl bg-gradient-to-br from-teal-100 to-emerald-200 
                                    flex items-center justify-center shadow-sm flex-shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-teal-600" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0H5m14 0h2M5 21H3M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                        </div>
                        <h3 class="text-base font-bold text-gray-800">Detail Usaha</h3>
                    </div>

                    {{-- Alamat Lengkap --}}
                    <div class="mb-5">
                        <label class="text-xs text-gray-500 uppercase tracking-wide mb-1.5 flex items-center gap-1.5 font-semibold">
                            {{-- Ikon untuk Alamat --}}
                            <svg class="w-3.5 h-3.5 text-teal-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            Alamat Lengkap <span class="text-red-400">*</span>
                        </label>
                        <div class="relative">
                            <span class="absolute left-4 top-4 text-gray-400">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                            </span>
                            <input type="text" name="alamat_lengkap" value="{{ old('alamat_lengkap') }}" required
                                placeholder="Jalan, Kelurahan, Kecamatan, Kota"
                                class="input-field w-full border-2 border-blue-100 rounded-2xl py-3 pl-11 pr-4 text-sm
                                          bg-white/80 backdrop-blur-sm focus:outline-none focus:border-blue-400
                                          transition-all duration-300 placeholder:text-gray-300 text-gray-700 font-medium">
                        </div>
                    </div>

                    {{-- Jenis UMKM + Jam Operasional --}}
                    <div class="grid md:grid-cols-2 gap-5 mb-5">
                        <div>
                            <label class="text-xs text-gray-500 uppercase tracking-wide mb-1.5 flex items-center gap-1.5 font-semibold">
                                {{-- Ikon untuk Jenis UMKM --}}
                                <svg class="w-3.5 h-3.5 text-teal-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0H5m14 0h2M5 21H3M12 7v4m0 4h.01"/>
                                </svg>
                                Jenis UMKM <span class="text-red-400">*</span>
                            </label>
                            <div class="relative">
                                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0H5m14 0h2M5 21H3M12 7v4m0 4h.01"/>
                                    </svg>
                                </span>
                                <select name="jenis_umkm" required
                                    class="input-field w-full border-2 border-blue-100 rounded-2xl py-3 pl-11 pr-4 text-sm
                                               bg-white/80 backdrop-blur-sm focus:outline-none focus:border-blue-400
                                               transition-all duration-300 text-gray-700 font-medium cursor-pointer appearance-none"
                                    style="background-image: url('data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 width=%2212%22 height=%228%22 fill=%22none%22%3E%3Cpath d=%22M1 1l5 5 5-5%22 stroke=%22%236b7280%22 stroke-width=%221.5%22 stroke-linecap=%22round%22 stroke-linejoin=%22round%22/%3E%3C/svg%3E'); background-repeat: no-repeat; background-position: right 14px center; padding-right: 36px;">
                                    <option value="">Pilih jenis</option>
                                    <option value="Toko Fisik" {{ old('jenis_umkm') == 'Toko Fisik' ? 'selected' : '' }}>Toko Fisik</option>
                                    <option value="Toko Online" {{ old('jenis_umkm') == 'Toko Online' ? 'selected' : '' }}>Toko Online</option>
                                </select>
                            </div>
                        </div>
                        <div>
                            <label class="text-xs text-gray-500 uppercase tracking-wide mb-1.5 flex items-center gap-1.5 font-semibold">
                                {{-- Ikon untuk Jam Operasional --}}
                                <svg class="w-3.5 h-3.5 text-teal-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                Jam Operasional <span class="text-red-400">*</span>
                            </label>
                            <div class="relative">
                                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </span>
                                <input type="text" name="jam_operasional" value="{{ old('jam_operasional') }}" required
                                    placeholder="09:00 - 21:00 WITA"
                                    class="input-field w-full border-2 border-blue-100 rounded-2xl py-3 pl-11 pr-4 text-sm
                                              bg-white/80 backdrop-blur-sm focus:outline-none focus:border-blue-400
                                              transition-all duration-300 placeholder:text-gray-300 text-gray-700 font-medium">
                            </div>
                        </div>
                    </div>

                    {{-- Kontak --}}
                    <div>
                        <label class="text-xs text-gray-500 uppercase tracking-wide mb-1.5 flex items-center gap-1.5 font-semibold">
                            {{-- Ikon untuk Kontak --}}
                            <svg class="w-3.5 h-3.5 text-teal-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                            </svg>
                            Nomor Kontak / WhatsApp <span class="text-red-400">*</span>
                        </label>
                        <div class="relative">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                </svg>
                            </span>
                            <input type="text" name="kontak" value="{{ old('kontak') }}" required
                                placeholder="0812-3456-7890"
                                class="input-field w-full border-2 border-blue-100 rounded-2xl py-3 pl-11 pr-4 text-sm
                                          bg-white/80 backdrop-blur-sm focus:outline-none focus:border-blue-400
                                          transition-all duration-300 placeholder:text-gray-300 text-gray-700 font-medium">
                        </div>
                    </div>
                </div>

                {{-- ================= BAGIAN 3: LOGO & SOSIAL MEDIA ================= --}}
                <div class="mb-6">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-9 h-9 rounded-xl bg-gradient-to-br from-orange-100 to-amber-200 
                                    flex items-center justify-center shadow-sm flex-shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-orange-600" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <h3 class="text-base font-bold text-gray-800">Logo & Media Sosial</h3>
                    </div>

                    <div class="grid md:grid-cols-2 gap-6">
                        {{-- Upload Logo --}}
                        <div>
                            <label class="text-xs text-gray-500 uppercase tracking-wide mb-1.5 flex items-center gap-1.5 font-semibold">
                                {{-- Ikon untuk Logo --}}
                                <svg class="w-3.5 h-3.5 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                Logo / Foto Usaha <span class="text-red-400">*</span>
                            </label>
                            <div class="drag-area rounded-2xl p-6 text-center cursor-pointer"
                                id="dragArea"
                                onclick="document.getElementById('logoInput').click()">

                                <div id="uploadPlaceholder">
                                    <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-blue-100 to-teal-100
                                                flex items-center justify-center mx-auto mb-3 shadow-sm">
                                        <svg class="w-7 h-7 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                        </svg>
                                    </div>
                                    <p class="text-sm text-gray-600 font-medium">
                                        <span class="text-blue-600">Klik untuk upload</span> atau seret dan lepas
                                    </p>
                                    <p class="text-xs text-gray-400 mt-1">PNG, JPG, PDF (maks. 5MB)</p>
                                </div>

                                <div id="uploadPreview" class="hidden">
                                    <img id="previewImg" src="" alt="Preview"
                                        class="max-h-24 mx-auto rounded-xl object-contain shadow-sm">
                                    <p id="fileName" class="text-xs text-gray-500 mt-2 font-medium"></p>
                                    <button type="button" onclick="event.stopPropagation(); resetUpload()"
                                        class="mt-2 text-xs text-red-500 hover:text-red-600 font-semibold hover:underline transition-colors">
                                        Hapus & Ganti File
                                    </button>
                                </div>

                                <input type="file" id="logoInput" name="logo" accept=".png,.jpg,.jpeg,.pdf" class="hidden">
                            </div>
                        </div>

                        {{-- Sosial Media --}}
                        <div>
                            <label class="text-xs text-gray-500 uppercase tracking-wide mb-1.5 flex items-center gap-1.5 font-semibold">
                                {{-- Ikon untuk Sosial Media --}}
                                <svg class="w-3.5 h-3.5 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/>
                                </svg>
                                Tautan Sosial Media <span class="text-gray-400 font-normal">(opsional)</span>
                            </label>
                            <div class="relative mb-4">
                                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/>
                                    </svg>
                                </span>
                                <input type="text" name="sosial_media" value="{{ old('sosial_media') }}"
                                    placeholder="https://instagram.com/namausaha"
                                    class="input-field w-full border-2 border-blue-100 rounded-2xl pl-11 pr-4 py-3 text-sm
                                              bg-white/80 backdrop-blur-sm focus:outline-none focus:border-blue-400
                                              transition-all duration-300 placeholder:text-gray-300 text-gray-700 font-medium">
                            </div>
                            <p class="text-xs text-gray-400 leading-relaxed">
                                Cantumkan tautan Instagram, Facebook, atau website Anda untuk memudahkan pelanggan menemukan usaha.
                            </p>
                        </div>
                    </div>
                </div>

                {{-- Submit Button --}}
                <div class="pt-6 border-t border-gray-100">
                    <button type="submit"
                        class="btn-shimmer w-full py-4 bg-gradient-to-r from-blue-600 to-teal-500 text-white font-semibold rounded-2xl 
                               shadow-lg shadow-blue-200 hover:shadow-xl hover:shadow-blue-300 hover:-translate-y-0.5 active:scale-[0.98] 
                               transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-blue-400 disabled:opacity-70 disabled:cursor-not-allowed"
                        id="submitBtn">
                        <span class="flex items-center justify-center gap-2 text-base">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                            </svg>
                            Daftarkan Usaha Sekarang
                        </span>
                    </button>
                </div>
            </form>
        </div>

    </main>

    {{-- ── FOOTER ── --}}
    @include('partials.footer')

    {{-- Scripts --}}
    <script>
        function handleSubmit(form) {
            const btn = document.getElementById('submitBtn');
            btn.disabled = true;
            const span = btn.querySelector('span');
            span.innerHTML = `
                <svg class="animate-spin w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                Mengirim...
            `;
            return true;
        }

        // Drag & Drop
        const dragArea = document.getElementById('dragArea');
        const logoInput = document.getElementById('logoInput');
        const placeholder = document.getElementById('uploadPlaceholder');
        const preview = document.getElementById('uploadPreview');
        const previewImg = document.getElementById('previewImg');
        const fileName = document.getElementById('fileName');

        logoInput.addEventListener('change', () => {
            if (logoInput.files.length > 0) {
                handleFile(logoInput.files[0]);
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
                logoInput.files = e.dataTransfer.files;
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
            logoInput.value = '';
            previewImg.src = '';
            fileName.textContent = '';
            placeholder.classList.remove('hidden');
            preview.classList.add('hidden');
        }
    </script>
</body>
</html>