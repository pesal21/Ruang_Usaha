<footer class="bg-gray-900 text-gray-300 relative overflow-hidden">
    {{-- Decorative gradient blobs --}}
    <div class="absolute top-0 left-0 w-64 h-64 bg-blue-500/5 rounded-full -translate-x-1/2 -translate-y-1/2 blur-3xl pointer-events-none"></div>
    <div class="absolute bottom-0 right-0 w-80 h-80 bg-teal-500/5 rounded-full translate-x-1/3 translate-y-1/3 blur-3xl pointer-events-none"></div>
    <div class="absolute top-1/2 left-1/2 w-96 h-96 bg-blue-400/3 rounded-full -translate-x-1/2 -translate-y-1/2 blur-3xl pointer-events-none"></div>
    
    <div class="relative max-w-7xl mx-auto px-6 py-16 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-12">
        
        {{-- Brand --}}
        <div>
            <div class="flex items-center gap-2 mb-4">
                <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-blue-500 to-teal-500 flex items-center justify-center shadow-sm">
                    <img src="{{ asset('Logo.png') }}" class="w-5 h-5" alt="logo">
                </div>
                <h2 class="text-white font-bold text-xl">RuangUsaha</h2>
            </div>
            <p class="text-sm text-gray-400 leading-relaxed">
                Menghubungkan dan memberdayakan<br>usaha lokal di Bontang.
            </p>

            {{-- Social Media Icons --}}
            <div class="flex items-center gap-4 mt-6">
                <a href="#" class="w-9 h-9 rounded-xl bg-gray-800 hover:bg-blue-600 text-gray-400 hover:text-white flex items-center justify-center transition-all duration-300 hover:shadow-lg hover:shadow-blue-600/30 hover:-translate-y-1">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/>
                    </svg>
                </a>

                <a href="#" class="w-9 h-9 rounded-xl bg-gray-800 hover:bg-gradient-to-br from-pink-500 to-purple-500 text-gray-400 hover:text-white flex items-center justify-center transition-all duration-300 hover:shadow-lg hover:shadow-pink-500/30 hover:-translate-y-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                        <rect x="2" y="2" width="20" height="20" rx="5"/>
                        <path d="M16 11.37A4 4 0 1 1 12.63 8"/>
                        <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/>
                    </svg>
                </a>

                <a href="#" class="w-9 h-9 rounded-xl bg-gray-800 hover:bg-blue-500 text-gray-400 hover:text-white flex items-center justify-center transition-all duration-300 hover:shadow-lg hover:shadow-blue-500/30 hover:-translate-y-1">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231z"/>
                    </svg>
                </a>
            </div>
        </div>

        {{-- Perusahaan --}}
        <div>
            <h3 class="text-white font-semibold text-base mb-5 flex items-center gap-2">
                <span class="w-1.5 h-1.5 rounded-full bg-blue-400"></span>
                Perusahaan
            </h3>
            <ul class="space-y-3 text-sm text-gray-400">
                <li>
                    <a href="#" class="footer-link inline-flex items-center gap-1.5 hover:text-white transition-all duration-300 hover:translate-x-2">
                        <svg class="w-3 h-3 opacity-0 -translate-x-2 transition-all duration-300 group-hover:opacity-100 group-hover:translate-x-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                        </svg>
                        Tentang Kami
                    </a>
                </li>
                <li>
                    <a href="#" class="footer-link inline-flex items-center gap-1.5 hover:text-white transition-all duration-300 hover:translate-x-2">
                        <svg class="w-3 h-3 opacity-0 -translate-x-2 transition-all duration-300 group-hover:opacity-100 group-hover:translate-x-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                        </svg>
                        Kontak
                    </a>
                </li>
                <li>
                    <a href="#" class="footer-link inline-flex items-center gap-1.5 hover:text-white transition-all duration-300 hover:translate-x-2">
                        <svg class="w-3 h-3 opacity-0 -translate-x-2 transition-all duration-300 group-hover:opacity-100 group-hover:translate-x-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                        </svg>
                        Dukungan
                    </a>
                </li>
            </ul>
        </div>

        {{-- Tautan Cepat --}}
        <div>
            <h3 class="text-white font-semibold text-base mb-5 flex items-center gap-2">
                <span class="w-1.5 h-1.5 rounded-full bg-teal-400"></span>
                Tautan Cepat
            </h3>
            <ul class="space-y-3 text-sm text-gray-400">
                <li>
                    <a href="#" class="footer-link inline-flex items-center gap-1.5 hover:text-white transition-all duration-300 hover:translate-x-2">
                        <svg class="w-3 h-3 opacity-0 -translate-x-2 transition-all duration-300 group-hover:opacity-100 group-hover:translate-x-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                        </svg>
                        Bagikan Lokasi
                    </a>
                </li>
                <li>
                    <a href="#" class="footer-link inline-flex items-center gap-1.5 hover:text-white transition-all duration-300 hover:translate-x-2">
                        <svg class="w-3 h-3 opacity-0 -translate-x-2 transition-all duration-300 group-hover:opacity-100 group-hover:translate-x-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                        </svg>
                        Lacak Pesanan
                    </a>
                </li>
                <li>
                    <a href="#" class="footer-link inline-flex items-center gap-1.5 hover:text-white transition-all duration-300 hover:translate-x-2">
                        <svg class="w-3 h-3 opacity-0 -translate-x-2 transition-all duration-300 group-hover:opacity-100 group-hover:translate-x-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                        </svg>
                        FAQs
                    </a>
                </li>
            </ul>
        </div>

        {{-- Legal --}}
        <div>
            <h3 class="text-white font-semibold text-base mb-5 flex items-center gap-2">
                <span class="w-1.5 h-1.5 rounded-full bg-orange-400"></span>
                Legal
            </h3>
            <ul class="space-y-3 text-sm text-gray-400">
                <li>
                    <a href="#" class="footer-link inline-flex items-center gap-1.5 hover:text-white transition-all duration-300 hover:translate-x-2">
                        <svg class="w-3 h-3 opacity-0 -translate-x-2 transition-all duration-300 group-hover:opacity-100 group-hover:translate-x-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                        </svg>
                        Syarat & Ketentuan
                    </a>
                </li>
                <li>
                    <a href="#" class="footer-link inline-flex items-center gap-1.5 hover:text-white transition-all duration-300 hover:translate-x-2">
                        <svg class="w-3 h-3 opacity-0 -translate-x-2 transition-all duration-300 group-hover:opacity-100 group-hover:translate-x-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                        </svg>
                        Kebijakan Privasi
                    </a>
                </li>
            </ul>
        </div>

    </div>

    {{-- Copyright Bar --}}
    <div class="relative border-t border-gray-800">
        <div class="max-w-7xl mx-auto px-6 py-6 text-center text-sm text-gray-500 flex flex-col sm:flex-row items-center justify-between gap-2">
            <p>&copy; {{ date('Y') }} RuangUsaha. All Rights Reserved.</p>
            <p class="text-gray-600">
                Dibuat dengan 
                <span class="text-red-400 animate-pulse inline-block">❤</span> 
                di Bontang
            </p>
        </div>
    </div>
</footer>

<style>
    .footer-link {
        position: relative;
    }
    .footer-link::after {
        content: '';
        position: absolute;
        bottom: -2px;
        left: 0;
        width: 0;
        height: 1.5px;
        background: linear-gradient(to right, #3b82f6, #0d9488);
        transition: width 0.3s ease;
    }
    .footer-link:hover::after {
        width: 100%;
    }
</style>