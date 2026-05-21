@extends('admin.layout')

@section('content')

<div class="max-w-6xl mx-auto px-4">

    {{-- HEADER --}}
    <div class="flex items-start justify-between mb-8">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">Kelola Blog</h1>
            <p class="text-gray-400 text-sm mt-1">Tambah dan kelola artikel blog UMKM.</p>
        </div>
        <a href="{{ route('admin.blog.create') }}"
            class="inline-flex items-center gap-2 px-5 py-2.5 bg-blue-600 hover:bg-blue-700 active:scale-95
                  text-white text-sm font-medium rounded-xl transition-all shadow-sm hover:shadow-md
                  focus:outline-none focus:ring-2 focus:ring-blue-400">
            + Tambah Blog
        </a>
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

    {{-- TABLE --}}
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm hover:shadow-md transition-shadow duration-300 overflow-visible">
        <table class="w-full text-sm">
            <thead>
                <tr class="text-gray-400 uppercase text-xs tracking-wide border-b border-gray-100 bg-gray-50">
                    <th class="px-6 py-3 text-left">Gambar</th>
                    <th class="px-6 py-3 text-left">Judul</th>
                    <th class="px-6 py-3 text-left">Tanggal</th>
                    <th class="px-6 py-3 text-right">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse($blogs as $blog)
                <tr class="border-t border-gray-50 hover:bg-gray-50/80 transition-colors duration-150">

                    {{-- GAMBAR --}}
                    <td class="px-6 py-4">
                        @if($blog->gambar)
                        <img src="{{ asset('storage/'.$blog->gambar) }}"
                            alt="{{ $blog->judul }}"
                            class="w-16 h-12 object-cover rounded-lg border border-gray-100">
                        @else
                        <div class="w-16 h-12 bg-gray-100 rounded-lg flex items-center
                                    justify-center text-gray-300 text-xs">
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
                    <td class="px-6 py-4 text-gray-400 text-xs whitespace-nowrap">
                        {{ \Carbon\Carbon::parse($blog->created_at)->format('d M Y') }}
                    </td>

                    {{-- AKSI --}}
                    <td class="px-6 py-4 text-right">
                        <div class="flex items-center justify-end gap-2">
                            <a href="{{ route('admin.blog.edit', $blog->id) }}"
                                class="px-3 py-1.5 bg-yellow-50 hover:bg-yellow-100 text-yellow-700
                                      border border-yellow-200 rounded-lg text-xs font-medium transition
                                      active:scale-95 inline-block">
                                Edit
                            </a>

                            <form action="{{ route('admin.blog.delete', $blog->id) }}" method="POST"
                                onsubmit="return confirm('Yakin ingin menghapus artikel ini?') && handleDelete(this)">
                                @csrf
                                <button type="submit"
                                    class="px-3 py-1.5 bg-red-50 hover:bg-red-100 text-red-600
                                           border border-red-200 rounded-lg text-xs font-medium transition
                                           active:scale-95 disabled:opacity-60 disabled:cursor-not-allowed">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </td>

                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-6 py-14 text-center text-gray-400 text-sm">
                        <div class="flex flex-col items-center">
                            <svg class="w-16 h-16 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                            </svg>
                            <span class="font-medium text-gray-500">Belum ada artikel blog.</span>
                            <p class="text-xs mt-2">Klik <strong>+ Tambah Blog</strong> untuk memulai.</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>

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