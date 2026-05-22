<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Pilih UMKM – RuangUsaha</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        /* Card shine effect */
        .umkm-card::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(255,255,255,.6) 0%, transparent 50%);
            opacity: 0;
            transition: opacity .3s ease;
            pointer-events: none;
            border-radius: inherit;
        }
        .umkm-card:hover::before { opacity: 1; }

        /* Animasi masuk */
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(20px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        .card-animate {
            animation: fadeUp .5s ease both;
        }
    </style>
</head>

<body class="bg-gradient-to-br from-blue-50 via-white to-sky-50 text-gray-800 min-h-screen flex flex-col">

    {{-- Navbar --}}
    @include('partials.navbar')

    {{-- Main Content --}}
    <main class="flex-1 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-28 pb-20">

        {{-- Back Link --}}
        <div class="mb-6">
            <a href="{{ route('beranda') }}"
               class="inline-flex items-center gap-1.5 text-sm text-blue-600 hover:text-blue-700 font-medium transition-colors duration-200 group">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 flex-shrink-0" fill="none"
                     viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
                </svg>
                <span class="relative">
                    Kembali ke Beranda
                    <span class="absolute -bottom-0.5 left-0 w-0 h-px bg-current transition-all duration-300 group-hover:w-full"></span>
                </span>
            </a>
        </div>

        {{-- Header --}}
        <div class="text-center mb-12">
            <div class="inline-flex items-center gap-2 bg-blue-50 border border-blue-100 text-blue-600
                        px-4 py-1.5 rounded-full text-xs font-semibold mb-5 shadow-sm">
                <span class="w-1.5 h-1.5 rounded-full bg-blue-500 animate-pulse"></span>
                Dashboard UMKM
            </div>

            <h1 class="text-3xl md:text-4xl lg:text-5xl font-extrabold bg-gradient-to-r from-blue-700 to-cyan-600 bg-clip-text text-transparent leading-tight">
                Pilih UMKM
            </h1>
            <p class="text-gray-500 mt-3 max-w-md mx-auto text-sm md:text-base">
                Pilih usaha yang ingin kamu kelola dan pantau perkembangannya.
            </p>

            {{-- Decorative divider --}}
            <div class="mt-6 flex items-center justify-center gap-2">
                <span class="w-8 h-px bg-blue-200"></span>
                <span class="w-2 h-2 rounded-full bg-teal-400"></span>
                <span class="w-16 h-0.5 bg-gradient-to-r from-blue-400 to-teal-400 rounded-full"></span>
                <span class="w-2 h-2 rounded-full bg-blue-400"></span>
                <span class="w-8 h-px bg-teal-200"></span>
            </div>
        </div>

        {{-- Grid UMKM --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5">
            @forelse($umkms as $index => $umkm)
            <a href="{{ route('umkm.dashboard', $umkm->id) }}"
               class="umkm-card card-animate group relative bg-white rounded-2xl border border-gray-100
                      shadow-md shadow-blue-50 overflow-hidden hover:shadow-2xl hover:shadow-blue-200
                      hover:-translate-y-2 transition-all duration-300 flex flex-col items-center p-6"
               style="animation-delay: {{ $index * 0.1 }}s">

                {{-- Logo --}}
                <div class="w-20 h-20 mb-5 rounded-2xl overflow-hidden flex items-center justify-center
                            shadow-md group-hover:shadow-lg transition-shadow duration-300
                            {{ $umkm->logo ? 'bg-gray-100' : 'bg-gradient-to-br from-blue-500 to-cyan-500 text-white' }}">
                    @if($umkm->logo)
                        <img src="{{ asset('storage/'.$umkm->logo) }}"
                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    @else
                        <span class="text-2xl font-bold">
                            {{ strtoupper(substr($umkm->nama_usaha, 0, 1)) }}
                        </span>
                    @endif
                </div>

                {{-- Nama Usaha --}}
                <h3 class="font-bold text-gray-900 group-hover:text-blue-700 transition-colors duration-200 text-center text-sm md:text-base leading-snug">
                    {{ $umkm->nama_usaha }}
                </h3>

                {{-- Label "Kelola" --}}
                <span class="mt-4 inline-block text-xs font-semibold text-blue-600 border border-blue-200 
                             rounded-lg px-4 py-2 group-hover:bg-blue-600 group-hover:text-white 
                             group-hover:border-blue-600 transition-all duration-300">
                    Kelola →
                </span>
            </a>
            @empty
            {{-- Empty State --}}
            <div class="col-span-full flex flex-col items-center justify-center py-20 text-center">
                <div class="w-24 h-24 rounded-3xl bg-gradient-to-br from-blue-50 to-teal-50 border 
                            border-blue-100 flex items-center justify-center mb-6 shadow-sm">
                    <svg class="w-12 h-12 text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.2"
                              d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0H5m14 0h2M5 21H3M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                    </svg>
                </div>
                <h3 class="text-gray-700 font-bold text-lg mb-2">Belum ada UMKM</h3>
                <p class="text-gray-400 text-sm max-w-xs leading-relaxed">
                    Kamu belum mendaftarkan usaha. 
                    <a href="{{ route('umkm.create') }}" class="text-blue-600 font-semibold hover:underline">
                        Daftarkan sekarang
                    </a>
                </p>
            </div>
            @endforelse
        </div>

    </main>

    {{-- Footer --}}
    @include('partials.footer')

    <script>
        function toggleDropdown() {
            document.getElementById('profileDropdown').classList.toggle('hidden');
        }
        document.addEventListener('click', function(e) {
            const dropdown = document.getElementById('profileDropdown');
            if (dropdown && !e.target.closest('.relative')) {
                dropdown.classList.add('hidden');
            }
        });
    </script>

</body>
</html>