<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Berhasil – RuangUsaha</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        body { font-family: 'Poppins', sans-serif; }

        /* ── Animated gradient mesh background ── */
        .hero-bg {
            background-color: #eff6ff;
            background-image:
                radial-gradient(ellipse 80% 60% at 20% -10%, rgba(96,165,250,.18) 0%, transparent 60%),
                radial-gradient(ellipse 60% 50% at 85% 10%,  rgba(45,212,191,.14) 0%, transparent 55%),
                radial-gradient(ellipse 50% 40% at 50% 100%, rgba(59,130,246,.10) 0%, transparent 60%);
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

        /* ── Button shimmer ── */
        .btn-shimmer {
            position: relative; overflow: hidden;
        }
        .btn-shimmer::after {
            content: '';
            position: absolute; top: 0; left: -80%; width: 60%; height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,.25), transparent);
            transition: left .5s ease;
        }
        .btn-shimmer:hover::after { left: 150%; }

        /* ── Pulse ring animation ── */
        @keyframes pulse-ring {
            0%   { transform: scale(1); opacity: 0.6; }
            100% { transform: scale(1.6); opacity: 0; }
        }
        .pulse-ring {
            animation: pulse-ring 2s ease-out infinite;
        }

        /* ── Checkmark bounce ── */
        @keyframes checkBounce {
            0%   { transform: scale(0); opacity: 0; }
            50%  { transform: scale(1.3); opacity: 1; }
            70%  { transform: scale(0.9); }
            100% { transform: scale(1); opacity: 1; }
        }
        .check-bounce {
            animation: checkBounce 0.6s cubic-bezier(0.34, 1.56, 0.64, 1) both;
        }

        /* ── Page load fade-in ── */
        @keyframes fadeInMain {
            from { opacity: 0; transform: translateY(10px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        .page-enter { animation: fadeInMain 0.6s ease forwards; }

        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(20px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        .card-animate { animation: fadeUp .5s ease both; }

        /* ── Step connector line ── */
        .step-line {
            position: absolute;
            top: 50%;
            left: 50%;
            width: 100%;
            height: 2px;
            background: #e5e7eb;
            transform: translateY(-50%);
            z-index: 0;
        }
        .step-line.completed {
            background: linear-gradient(to right, #10b981, #34d399);
        }
        .step-line.active {
            background: linear-gradient(to right, #10b981, #fbbf24);
        }
    </style>
</head>

<body class="hero-bg noise text-gray-800 antialiased min-h-screen flex flex-col">

    {{-- ── NAVBAR ── --}}
    @include('partials.navbar')

    {{-- ── MAIN CONTENT ── --}}
    <main class="relative z-10 flex-1 flex items-center justify-center px-4 sm:px-6 lg:px-8 pt-28 pb-20 page-enter">
        <div class="text-center max-w-xl w-full">

            {{-- ═══════ IKON SUKSES DENGAN PULSE RING ═══════ --}}
            <div class="card-animate mx-auto mb-8 relative flex items-center justify-center" style="animation-delay: 0.15s;">
                {{-- Pulse ring luar --}}
                <div class="absolute w-24 h-24 rounded-full bg-green-400/20 pulse-ring"></div>
                <div class="absolute w-24 h-24 rounded-full bg-green-400/15 pulse-ring" style="animation-delay: 0.4s;"></div>

                {{-- Circle utama --}}
                <div class="relative w-28 h-28 rounded-full bg-gradient-to-br from-green-400 to-emerald-500 
                            flex items-center justify-center shadow-xl shadow-green-200 z-10">
                    <svg class="w-14 h-14 text-white check-bounce" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                    </svg>
                </div>
            </div>

            {{-- ═══════ HEADER ═══════ --}}
            <div class="card-animate mb-8" style="animation-delay: 0.2s;">
                <div class="inline-flex items-center gap-2 bg-green-50 border border-green-100 text-green-600
                            px-4 py-1.5 rounded-full text-xs font-semibold mb-5 shadow-sm">
                    <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span>
                    Pendaftaran Berhasil
                </div>
                <h1 class="text-3xl md:text-4xl lg:text-5xl font-extrabold text-gradient leading-tight tracking-tight">
                    Pendaftaran Berhasil!
                </h1>
                <p class="text-gray-500 mt-4 max-w-sm mx-auto text-base leading-relaxed">
                    Terima kasih telah mendaftarkan usaha Anda di RuangUsaha.
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

            {{-- ═══════ CARD STATUS MENUNGGU ═══════ --}}
            <div class="card-animate bg-white rounded-3xl border border-amber-100 shadow-md shadow-amber-50
                        hover:shadow-xl hover:shadow-amber-100 transition-all duration-300 
                        px-6 py-5 mb-8 text-left"
                 style="animation-delay: 0.25s;">
                <div class="flex items-start gap-4">
                    <div class="flex-shrink-0 w-10 h-10 rounded-xl bg-gradient-to-br from-amber-100 to-yellow-200 
                                flex items-center justify-center shadow-sm">
                        <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div class="min-w-0">
                        <p class="font-bold text-gray-800 text-sm mb-1">Menunggu Persetujuan</p>
                        <p class="text-xs text-gray-500 leading-relaxed">
                            UMKM Anda sedang ditinjau oleh tim admin RuangUsaha.
                            Proses verifikasi biasanya membutuhkan <span class="font-semibold text-gray-700">1–2 hari kerja</span>.
                            Anda akan dihubungi jika sudah disetujui.
                        </p>
                    </div>
                </div>
            </div>

            {{-- ═══════ PROGRESS STEPS ═══════ --}}
            <div class="card-animate mb-10" style="animation-delay: 0.3s;">
                <div class="flex items-center justify-between relative">
                    {{-- Step 1: Selesai --}}
                    <div class="flex flex-col items-center relative z-10">
                        <div class="w-10 h-10 rounded-full bg-gradient-to-br from-green-400 to-emerald-500 
                                    flex items-center justify-center shadow-md shadow-green-200 mb-2">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                            </svg>
                        </div>
                        <span class="text-xs font-semibold text-green-700">Terkirim</span>
                    </div>

                    {{-- Connector --}}
                    <div class="flex-1 mx-2 h-1 rounded-full bg-gradient-to-r from-green-400 to-amber-400 relative z-0"></div>

                    {{-- Step 2: Sedang Berjalan --}}
                    <div class="flex flex-col items-center relative z-10">
                        <div class="w-10 h-10 rounded-full bg-gradient-to-br from-amber-400 to-orange-500 
                                    flex items-center justify-center shadow-md shadow-amber-200 mb-2 relative">
                            <span class="text-white font-bold text-sm">2</span>
                            {{-- Pulse indicator --}}
                            <span class="absolute inset-0 rounded-full bg-amber-400 animate-ping opacity-30"></span>
                        </div>
                        <span class="text-xs font-semibold text-amber-700">Ditinjau</span>
                    </div>

                    {{-- Connector --}}
                    <div class="flex-1 mx-2 h-1 rounded-full bg-gray-200 relative z-0"></div>

                    {{-- Step 3: Belum --}}
                    <div class="flex flex-col items-center relative z-10">
                        <div class="w-10 h-10 rounded-full bg-gray-100 border-2 border-gray-200
                                    flex items-center justify-center mb-2">
                            <span class="text-gray-400 font-bold text-sm">3</span>
                        </div>
                        <span class="text-xs font-medium text-gray-400">Aktif</span>
                    </div>
                </div>
            </div>

            {{-- ═══════ TOMBOL AKSI ═══════ --}}
            <div class="card-animate flex flex-col sm:flex-row gap-3 justify-center" style="animation-delay: 0.35s;">
                <a href="{{ route('beranda') }}"
                   class="btn-shimmer inline-flex items-center justify-center gap-2 px-6 py-3.5 
                          bg-gradient-to-r from-blue-600 to-teal-500 text-white text-sm font-semibold rounded-2xl 
                          shadow-lg shadow-blue-200 hover:shadow-xl hover:shadow-blue-300 hover:-translate-y-0.5 
                          active:scale-95 transition-all duration-300">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                    Kembali ke Beranda
                </a>
                <a href="{{ route('umkm.index') }}"
                   class="inline-flex items-center justify-center gap-2 px-6 py-3.5 border-2 border-blue-200 
                          text-blue-700 text-sm font-semibold rounded-2xl hover:bg-blue-50 hover:border-blue-300 
                          hover:-translate-y-0.5 active:scale-95 transition-all duration-300 shadow-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0H5m14 0h2M5 21H3M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                    </svg>
                    Lihat Daftar UMKM
                </a>
            </div>

        </div>
    </main>

    {{-- ── FOOTER ── --}}
    @include('partials.footer')

</body>
</html>