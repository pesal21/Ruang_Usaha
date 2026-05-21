@extends('admin.layout')

@section('content')

<div class="max-w-5xl mx-auto px-4">

    {{-- HEADER --}}
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">Detail User</h1>
            <p class="text-gray-400 text-sm mt-1">Informasi akun pengguna</p>
        </div>
        <a href="{{ route('admin.user.index') }}"
            class="inline-flex items-center gap-2 px-5 py-2.5 border border-gray-300
                  rounded-xl text-sm font-medium text-gray-700 bg-white hover:bg-gray-50
                  hover:border-gray-400 active:scale-95 shadow-sm transition-all duration-200">
            ← Back to User Accounts
        </a>
    </div>

    {{-- USER CARD --}}
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm hover:shadow-md transition-shadow duration-300 p-8">

        {{-- AVATAR + NAMA --}}
        <div class="flex items-center gap-5 mb-8 pb-8 border-b border-gray-100">
            <div class="w-16 h-16 rounded-full bg-blue-600 text-white
                        flex items-center justify-center text-2xl font-bold flex-shrink-0
                        ring-4 ring-blue-100 shadow-md">
                @if($user->profile_picture)
                <img src="{{ asset('storage/' . $user->profile_picture) }}"
                    alt="{{ $user->name }}"
                    class="w-full h-full object-cover rounded-full">
                @else
                {{ strtoupper(substr($user->name, 0, 1)) }}
                @endif
            </div>
            <div>
                <h2 class="text-xl font-semibold text-gray-800">{{ $user->name }}</h2>
                <p class="text-gray-400 text-sm">{{ $user->email }}</p>
            </div>
        </div>

        {{-- DETAIL GRID --}}
        <div class="grid md:grid-cols-2 gap-8">

            <div>
                <p class="text-xs text-gray-400 uppercase tracking-wide mb-1">Role</p>
                <p class="font-medium text-gray-700">
                    {{ $user->role === 'admin' ? 'Admin' : 'Business Owner' }}
                </p>
            </div>

            <div>
                <p class="text-xs text-gray-400 uppercase tracking-wide mb-1">Status Akun</p>
                <span class="inline-flex px-3 py-1 rounded-full text-xs font-medium shadow-sm transition-colors duration-200
                    {{ $user->status === 'active'
                        ? 'bg-green-100 text-green-700'
                        : 'bg-orange-100 text-orange-600' }}">
                    {{ ucfirst($user->status) }}
                </span>
            </div>

            <div>
                <p class="text-xs text-gray-400 uppercase tracking-wide mb-1">Tanggal Daftar</p>
                <p class="text-gray-700">{{ $user->created_at->format('d M Y') }}</p>
            </div>

            <div>
                <p class="text-xs text-gray-400 uppercase tracking-wide mb-1">UMKM</p>
                <p class="text-gray-700">
                    {{ $user->umkm ? $user->umkm->nama_usaha : 'Belum memiliki UMKM' }}
                </p>
            </div>

        </div>

        {{-- ACTION BUTTONS --}}
        <div class="flex gap-3 mt-8 pt-8 border-t border-gray-100">
            @if($user->status === 'active')
            <form action="{{ route('admin.user.suspend', $user->id) }}" method="POST"
                onsubmit="return confirm('Yakin ingin mensuspend user ini?') && handleActionSubmit(this)">
                @csrf
                <button type="submit"
                    class="px-5 py-2.5 bg-red-600 hover:bg-red-700 active:scale-95 text-white
                               rounded-xl text-sm font-medium transition-all duration-200
                               disabled:opacity-60 disabled:cursor-not-allowed
                               focus:outline-none focus:ring-2 focus:ring-red-400">
                    Deactivate Account
                </button>
            </form>
            @else
            <form action="{{ route('admin.user.activate', $user->id) }}" method="POST"
                onsubmit="return confirm('Aktifkan kembali user ini?') && handleActionSubmit(this)">
                @csrf
                <button type="submit"
                    class="px-5 py-2.5 bg-green-600 hover:bg-green-700 active:scale-95 text-white
                               rounded-xl text-sm font-medium transition-all duration-200
                               disabled:opacity-60 disabled:cursor-not-allowed
                               focus:outline-none focus:ring-2 focus:ring-green-400">
                    ✅ Activate User
                </button>
            </form>
            @endif
        </div>

    </div>

</div>

<script>
    // Mencegah double submit dengan mengubah tombol menjadi "Processing..."
    function handleActionSubmit(form) {
        const btn = form.querySelector('button[type="submit"]');
        if (btn) {
            btn.disabled = true;
            btn.innerHTML = 'Processing...';
        }
        return true;
    }
</script>

@endsection