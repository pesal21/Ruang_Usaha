@extends('admin.layout')

@section('content')

<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-6 relative">
    {{-- Orbs dekoratif --}}
    <div class="absolute -top-16 -left-16 w-48 h-48 bg-blue-200/20 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute -bottom-20 -right-20 w-64 h-64 bg-cyan-200/20 rounded-full blur-3xl pointer-events-none"></div>

    {{-- HEADER --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8 relative">
        <div>
            <h1 class="text-3xl md:text-4xl font-extrabold bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent">
                Kelola Blog
            </h1>
            <p class="text-gray-500 mt-1.5 text-base">Tambah dan kelola artikel blog UMKM.</p>
        </div>
        <a href="{{ route('admin.blog.create') }}"
           class="inline-flex items-center gap-2 px-5 py-2.5 bg-gradient-to-r from-blue-600 to-indigo-600
                  hover:from-blue-700 hover:to-indigo-700 active:scale-95 text-white text-sm font-semibold
                  rounded-xl shadow-md hover:shadow-lg transition-all duration-200
                  focus:outline-none focus:ring-2 focus:ring-blue-400">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/>
            </svg>
            Tambah Blog
        </a>
    </div>

    {{-- SUCCESS MESSAGE --}}
    @if(session('success'))
    <div class="mb-6 px-4 py-3 bg-green-50 border border-green-200 text-green-700
                rounded-xl text-sm flex items-center gap-2 shadow-sm">
        <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
        </svg>
        {{ session('success') }}
    </div>
    @endif

    {{-- TABLE CARD --}}
    <div class="bg-white rounded-2xl shadow-md border border-gray-100 overflow-hidden hover:shadow-lg transition-shadow duration-300">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="text-gray-600 uppercase text-xs tracking-wider border-b border-gray-100 bg-gradient-to-r from-blue-50 to-indigo-50">
                        <th class="px-6 py-3.5 text-left font-semibold">Gambar</th>
                        <th class="px-6 py-3.5 text-left font-semibold">Judul</th>
                        <th class="px-6 py-3.5 text-left font-semibold">Tanggal</th>
                        <th class="px-6 py-3.5 text-right font-semibold">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($blogs as $blog)
                    <tr class="border-t border-gray-50 hover:bg-blue-50/30 transition-colors duration-200">
                        {{-- GAMBAR --}}
                        <td class="px-6 py-4">
                            @if($blog->gambar)
                            <img src="{{ asset('storage/'.$blog->gambar) }}"
                                 alt="{{ $blog->judul }}"
                                 class="w-16 h-12 object-cover rounded-lg border border-gray-100 shadow-sm ring-2 ring-white">
                            @else
                            <div class="w-16 h-12 bg-gray-100 rounded-lg flex items-center justify-center text-gray-300 text-xs shadow-sm ring-2 ring-white">
                                N/A
                            </div>
                            @endif
                        </td>

                        {{-- JUDUL --}}
                        <td class="px-6 py-4">
                            <p class="font-medium text-gray-800 line-clamp-2 max-w-md">
                                {{ $blog->judul }}
                            </p>
                        </td>

                        {{-- TANGGAL --}}
                        <td class="px-6 py-4 text-gray-500 text-xs whitespace-nowrap">
                            {{ \Carbon\Carbon::parse($blog->created_at)->format('d M Y') }}
                        </td>

                        {{-- AKSI --}}
                        <td class="px-6 py-4 text-right">
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ route('admin.blog.edit', $blog->id) }}"
                                   class="inline-flex items-center px-3 py-1.5 bg-amber-50 hover:bg-amber-100 text-amber-700
                                          border border-amber-200 rounded-lg text-xs font-medium transition-all duration-200
                                          active:scale-95 shadow-sm hover:shadow">
                                    ✏️ Edit
                                </a>

                                <form action="{{ route('admin.blog.delete', $blog->id) }}" method="POST"
                                      onsubmit="return confirm('Yakin ingin menghapus artikel ini?') && handleDelete(this)">
                                    @csrf
                                    <button type="submit"
                                            class="inline-flex items-center px-3 py-1.5 bg-red-50 hover:bg-red-100 text-red-600
                                                   border border-red-200 rounded-lg text-xs font-medium transition-all duration-200
                                                   active:scale-95 shadow-sm hover:shadow disabled:opacity-60 disabled:cursor-not-allowed">
                                        🗑️ Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-6 py-16 text-center text-gray-400">
                            <div class="flex flex-col items-center justify-center">
                                <div class="w-20 h-20 rounded-2xl bg-gradient-to-br from-blue-50 to-indigo-50 border border-blue-100 flex items-center justify-center mb-4 shadow-sm">
                                    <svg class="w-10 h-10 text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                              d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                                    </svg>
                                </div>
                                <span class="font-medium text-gray-500 text-base">Belum ada artikel blog.</span>
                                <p class="text-sm mt-1">
                                    Klik <strong class="text-blue-600">+ Tambah Blog</strong> untuk memulai.
                                </p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- PAGINATION --}}
        @if(method_exists($blogs, 'links'))
        <div class="px-6 py-4 border-t border-gray-100 flex justify-center">
            {{ $blogs->links() }}
        </div>
        @endif
    </div>
</div>

<script>
    // Mencegah double‑submit pada tombol hapus
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