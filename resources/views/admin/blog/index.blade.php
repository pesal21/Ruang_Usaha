@extends('admin.layout')

@section('content')

<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-6 relative page-enter">
    {{-- Decorative orbs --}}
    <div class="absolute -top-16 -left-16 w-48 h-48 bg-blue-200/20 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute -bottom-20 -right-20 w-64 h-64 bg-teal-200/20 rounded-full blur-3xl pointer-events-none"></div>

    {{-- ── HEADER ── --}}
    <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-4 mb-8 relative">
        <div class="card-animate" style="animation-delay: 0.1s;">
            <div class="inline-flex items-center gap-2 bg-blue-50 border border-blue-100 text-blue-600
                        px-4 py-1.5 rounded-full text-xs font-semibold mb-4 shadow-sm">
                <span class="w-1.5 h-1.5 rounded-full bg-blue-500 animate-pulse"></span>
                Admin Panel
            </div>
            <h1 class="text-3xl md:text-4xl lg:text-5xl font-extrabold text-gradient leading-tight tracking-tight">
                Kelola Blog
            </h1>
            <p class="text-gray-500 mt-2 text-base">Tambah dan kelola artikel blog UMKM.</p>
            <div class="mt-5 flex items-center gap-2">
                <span class="w-8 h-px bg-blue-200"></span>
                <span class="w-2 h-2 rounded-full bg-teal-400"></span>
                <span class="w-16 h-0.5 bg-gradient-to-r from-blue-400 to-teal-400 rounded-full"></span>
                <span class="w-2 h-2 rounded-full bg-blue-400"></span>
                <span class="w-8 h-px bg-teal-200"></span>
            </div>
        </div>

        <div class="flex items-center gap-3 card-animate" style="animation-delay: 0.15s;">
            <a href="{{ route('admin.blog.create') }}"
               class="btn-shimmer inline-flex items-center gap-2 px-5 py-2.5 bg-gradient-to-r from-blue-600 to-teal-500
                      hover:from-blue-700 hover:to-teal-600 active:scale-95 text-white text-sm font-semibold
                      rounded-2xl shadow-lg shadow-blue-200 hover:shadow-xl hover:shadow-blue-300 hover:-translate-y-0.5
                      transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-blue-400">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                </svg>
                Tambah Blog
            </a>
        </div>
    </div>

    {{-- ── SUCCESS MESSAGE ── --}}
    @if(session('success'))
    <div class="card-animate mb-6 px-5 py-4 bg-green-50 border border-green-200 text-green-700 rounded-2xl text-sm flex items-center gap-3 shadow-sm"
         style="animation-delay: 0.2s;">
        <div class="w-9 h-9 rounded-lg bg-green-100 flex items-center justify-center flex-shrink-0">
            <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
            </svg>
        </div>
        <span class="font-medium">{{ session('success') }}</span>
    </div>
    @endif

    {{-- ── TABLE CARD ── --}}
    <div class="card-animate bg-white rounded-3xl border border-gray-100 shadow-md shadow-blue-50
                overflow-hidden hover:shadow-xl hover:shadow-blue-100 transition-all duration-300"
         style="animation-delay: 0.25s;">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="text-gray-500 uppercase text-xs tracking-wider border-b border-blue-50 bg-gradient-to-r from-blue-50/60 to-teal-50/40">
                        <th class="px-6 py-4 text-left font-semibold">Gambar</th>
                        <th class="px-6 py-4 text-left font-semibold">Judul</th>
                        <th class="px-6 py-4 text-left font-semibold">Tanggal</th>
                        <th class="px-6 py-4 text-right font-semibold">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($blogs as $blog)
                    <tr class="border-t border-gray-50 hover:bg-blue-50/40 transition-colors duration-200">
                        {{-- GAMBAR --}}
                        <td class="px-6 py-4">
                            @if($blog->gambar)
                            <img src="{{ asset('storage/'.$blog->gambar) }}"
                                 alt="{{ $blog->judul }}"
                                 class="w-16 h-12 object-cover rounded-xl border border-blue-100 shadow-sm bg-gradient-to-br from-blue-50 to-teal-50">
                            @else
                            <div class="w-16 h-12 rounded-xl bg-gradient-to-br from-blue-50 to-teal-50 flex items-center justify-center text-blue-400 text-xs font-semibold shadow-sm">
                                Blog
                            </div>
                            @endif
                        </td>

                        {{-- JUDUL --}}
                        <td class="px-6 py-4">
                            <p class="font-semibold text-gray-800 line-clamp-2 max-w-md">
                                {{ $blog->judul }}
                            </p>
                        </td>

                        {{-- TANGGAL --}}
                        <td class="px-6 py-4 text-gray-500 text-xs whitespace-nowrap font-medium">
                            {{ \Carbon\Carbon::parse($blog->created_at)->format('d M Y') }}
                        </td>

                        {{-- AKSI --}}
                        <td class="px-6 py-4 text-right">
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ route('admin.blog.edit', $blog->id) }}"
                                   class="inline-flex items-center gap-1.5 px-4 py-2 bg-amber-50 hover:bg-amber-100 text-amber-700
                                          border border-amber-200 rounded-xl text-xs font-semibold transition-all duration-200
                                          hover:-translate-y-0.5 active:scale-95 shadow-sm hover:shadow">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                    Edit
                                </a>

                                <form action="{{ route('admin.blog.delete', $blog->id) }}" method="POST"
                                      onsubmit="return confirm('Yakin ingin menghapus artikel ini?') && handleDelete(this)">
                                    @csrf
                                    <button type="submit"
                                            class="inline-flex items-center gap-1.5 px-4 py-2 bg-red-50 hover:bg-red-100 text-red-500
                                                   border border-red-200 rounded-xl text-xs font-semibold transition-all duration-200
                                                   hover:-translate-y-0.5 active:scale-95 shadow-sm hover:shadow disabled:opacity-60 disabled:cursor-not-allowed">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-6 py-20 text-center text-gray-400">
                            <div class="flex flex-col items-center justify-center">
                                <div class="w-20 h-20 rounded-2xl bg-gradient-to-br from-blue-50 to-teal-50 border border-blue-100 flex items-center justify-center mb-4 shadow-sm">
                                    <svg class="w-10 h-10 text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                              d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                                    </svg>
                                </div>
                                <span class="text-gray-500 font-semibold text-base">Belum ada artikel blog.</span>
                                <p class="text-gray-400 text-sm mt-1">Klik <strong class="text-blue-600">Tambah Blog</strong> untuk memulai.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- PAGINATION --}}
        @if(method_exists($blogs, 'links'))
        <div class="px-6 py-5 border-t border-blue-50 flex justify-center">
            {{ $blogs->links() }}
        </div>
        @endif
    </div>
</div>

<style>
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
    .back-link:hover::after { transform: scaleX(1); }
</style>

<script>
    function handleDelete(form) {
        const btn = form.querySelector('button[type="submit"]');
        if (btn) {
            btn.disabled = true;
            btn.textContent = 'Menghapus...';
        }
        return true;
    }
</script>

@endsection