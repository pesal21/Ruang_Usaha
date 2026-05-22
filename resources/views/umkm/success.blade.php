<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Berhasil – RuangUsaha</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: "Poppins", sans-serif;
        }
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fadeup {
            animation: fadeUp 0.6s ease both;
        }
        .delay-1 { animation-delay: 0.1s; }
        .delay-2 { animation-delay: 0.2s; }
        .delay-3 { animation-delay: 0.3s; }
        .delay-4 { animation-delay: 0.4s; }
    </style>
</head>

<body class="bg-gradient-to-br from-blue-50 via-white to-sky-50 text-gray-800 min-h-screen flex flex-col">

    {{-- Navbar (partial) --}}
    @include('partials.navbar')

    {{-- Main Content --}}
    <main class="flex-1 flex items-center justify-center px-4 pt-24 pb-16">
        <div class="text-center max-w-xl w-full">

            {{-- Icon Sukses dengan dekorasi cincin --}}
            <div class="animate-fadeup delay-1 mx-auto mb-8 relative">
                <div class="w-28 h-28 mx-auto rounded-full bg-gradient-to-br from-green-100 to-emerald-100 
                            border-2 border-green-200 flex items-center justify-center shadow-lg shadow-green-100
                            transition-all duration-300 hover:shadow-xl hover:shadow-green-200 hover:scale-105">
                    <svg class="w-14 h-14 text-green-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                    </svg>
                </div>
                {{-- Lingkaran dekoratif di belakang --}}
                <div class="absolute -top-2 -right-2 w-8 h-8 bg-green-200 rounded-full opacity-40 -z-10"></div>
                <div class="absolute -bottom-2 -left-2 w-6 h-6 bg-emerald-200 rounded-full opacity-30 -z-10"></div>
            </div>

            {{-- Judul --}}
            <h1 class="animate-fadeup delay-1 text-3xl md:text-4xl font-extrabold bg-gradient-to-r from-blue-700 to-cyan-600 bg-clip-text text-transparent mb-2">
                Pendaftaran Berhasil!
            </h1>

            {{-- Deskripsi --}}
            <p class="animate-fadeup delay-2 text-gray-500 text-sm md:text-base leading-relaxed mb-8 max-w-sm mx-auto">
                Terima kasih telah mendaftarkan usaha Anda di RuangUsaha.
            </p>

            {{-- Card Status Menunggu --}}
            <div class="animate-fadeup delay-2 bg-white/80 backdrop-blur-sm border border-yellow-200 rounded-2xl 
                        px-6 py-5 mb-10 text-left shadow-md shadow-yellow-50 hover:shadow-lg transition-shadow duration-300">
                <div class="flex items-start gap-4">
                    <div class="flex-shrink-0 w-10 h-10 bg-yellow-100 rounded-full flex items-center justify-center mt-0.5">
                        <svg class="w-5 h-5 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div>
                        <p class="font-semibold text-yellow-800 text-sm mb-1">Menunggu Persetujuan</p>
                        <p class="text-xs text-yellow-700 leading-relaxed">
                            UMKM Anda sedang ditinjau oleh tim admin RuangUsaha.
                            Proses verifikasi biasanya membutuhkan 1–2 hari kerja.
                            Anda akan dihubungi jika sudah disetujui.
                        </p>
                    </div>
                </div>
            </div>

            {{-- Steps --}}
            <div class="animate-fadeup delay-2 grid grid-cols-3 gap-3 mb-10">
                <!-- Step 1: Selesai -->
                <div class="bg-white rounded-2xl border border-green-100 p-4 shadow-sm shadow-green-50 
                            hover:shadow-md transition-all duration-300 hover:-translate-y-1">
                    <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-2">
                        <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                    <p class="text-xs text-green-700 font-medium text-center">Formulir dikirim</p>
                </div>
                <!-- Step 2: Sedang berjalan -->
                <div class="bg-white rounded-2xl border border-yellow-200 p-4 shadow-sm shadow-yellow-50 
                            hover:shadow-md transition-all duration-300 hover:-translate-y-1 relative overflow-hidden">
                    {{-- efek pulse --}}
                    <div class="absolute inset-0 bg-yellow-50 opacity-30 animate-pulse"></div>
                    <div class="w-10 h-10 bg-yellow-100 rounded-full flex items-center justify-center mx-auto mb-2 relative z-10">
                        <span class="text-yellow-600 font-bold text-sm">2</span>
                    </div>
                    <p class="text-xs text-yellow-700 font-medium text-center relative z-10">Ditinjau admin</p>
                </div>
                <!-- Step 3: Belum aktif -->
                <div class="bg-white rounded-2xl border border-gray-100 p-4 opacity-60 hover:opacity-80 transition-opacity duration-300">
                    <div class="w-10 h-10 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-2">
                        <span class="text-gray-400 font-bold text-sm">3</span>
                    </div>
                    <p class="text-xs text-gray-400 text-center">UMKM aktif</p>
                </div>
            </div>

            {{-- Tombol Aksi --}}
            <div class="animate-fadeup delay-3 flex flex-col sm:flex-row gap-3 justify-center">
                <a href="{{ route('beranda') }}"
                   class="px-6 py-3.5 bg-gradient-to-r from-blue-600 to-cyan-500 text-white text-sm font-semibold rounded-xl 
                          shadow-lg shadow-blue-200 hover:shadow-xl hover:shadow-blue-300 hover:scale-[1.02] active:scale-95 
                          transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-blue-400">
                    Kembali ke Beranda
                </a>
                <a href="{{ route('umkm.index') }}"
                   class="px-6 py-3.5 border-2 border-blue-200 text-blue-700 text-sm font-semibold rounded-xl 
                          hover:bg-blue-50 hover:border-blue-300 active:scale-95 transition-all duration-300 
                          shadow-sm hover:shadow-md focus:outline-none focus:ring-2 focus:ring-blue-300">
                    Lihat Daftar UMKM
                </a>
            </div>

        </div>
    </main>

</body>
</html>