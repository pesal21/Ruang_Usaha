@extends('admin.layout')

@section('content')

<div class="max-w-6xl mx-auto px-4">

    {{-- HEADER --}}
    <div class="flex items-start justify-between mb-8">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">UMKM Data Management</h1>
            <p class="text-gray-400 mt-1 text-sm">View and approve registered businesses.</p>
        </div>
        <a href="{{ route('admin.dashboard') }}"
            class="inline-flex items-center gap-2 px-5 py-2.5 border border-gray-300
                  rounded-xl text-sm font-medium text-gray-700 bg-white hover:bg-gray-50
                  hover:border-gray-400 active:scale-95 shadow-sm transition-all duration-200">
            ← Back to Admin Dashboard
        </a>
    </div>

    {{-- TABLE CARD --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-visible hover:shadow-md transition-shadow duration-300">

        {{-- SEARCH + FILTER BAR --}}
        <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100">
            <form method="GET" class="flex items-center gap-3 w-full">
                {{-- Search --}}
                <div class="relative w-72">
                    <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">
                        <img src="{{ asset('assets/img/icon_umkm/search.png') }}" alt="Search icon" class="w-4 h-4">
                    </span>
                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Search by name, owner..."
                        class="pl-9 pr-4 py-2 border border-gray-200 rounded-xl text-sm w-full
                               focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-400
                               hover:border-gray-300 transition-colors duration-200">
                </div>

                {{-- Filter & Sort buttons (right side) --}}
                <div class="ml-auto flex gap-2">
                    <select name="status"
                        class="px-4 py-2 border border-gray-200 rounded-xl text-sm
                                   focus:outline-none focus:ring-2 focus:ring-blue-500
                                   hover:border-gray-300 transition-colors duration-200
                                   text-gray-600 cursor-pointer">
                        <option value="all">⚙ Filter</option>
                        <option value="approved" @selected(request('status')=='approved' )>Approved</option>
                        <option value="pending" @selected(request('status')=='pending' )>Pending</option>
                        <option value="rejected" @selected(request('status')=='rejected' )>Rejected</option>
                    </select>

                    <select name="sort"
                        class="px-4 py-2 border border-gray-200 rounded-xl text-sm
                                   focus:outline-none focus:ring-2 focus:ring-blue-500
                                   hover:border-gray-300 transition-colors duration-200
                                   text-gray-600 cursor-pointer">
                        <option value="">⇅ Sort</option>
                        <option value="newest" @selected(request('sort')=='newest' )>Newest</option>
                        <option value="oldest" @selected(request('sort')=='oldest' )>Oldest</option>
                        <option value="name" @selected(request('sort')=='name' )>Name A–Z</option>
                    </select>

                    <button type="submit"
                        class="px-5 py-2 bg-blue-600 hover:bg-blue-700 active:scale-95
                                   transition-all duration-200 text-white rounded-xl text-sm
                                   font-medium focus:outline-none focus:ring-2 focus:ring-blue-400">
                        Cari
                    </button>
                </div>
            </form>
        </div>

        {{-- TABLE --}}
        <table class="w-full text-sm">
            <thead>
                <tr class="text-gray-400 uppercase text-xs tracking-wide border-b border-gray-100">
                    <th class="px-6 py-3 text-left">Business Name</th>
                    <th class="px-6 py-3 text-left">Category</th>
                    <th class="px-6 py-3 text-left">Owner</th>
                    <th class="px-6 py-3 text-left">Registration Date</th>
                    <th class="px-6 py-3 text-left">Status</th>
                    <th class="px-6 py-3 text-right">Actions</th>
                </tr>
            </thead>

            <tbody>
                @forelse($umkms as $umkm)
                <tr class="border-t border-gray-50 hover:bg-gray-50/80 transition-colors duration-150">

                    {{-- BUSINESS NAME + LOGO --}}
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-3">
                            {{-- Logo / Avatar --}}
                            <div class="w-10 h-10 rounded-full bg-gray-200 overflow-hidden flex-shrink-0
                                        flex items-center justify-center text-gray-500 font-bold text-sm
                                        ring-2 ring-white shadow-sm">
                                @if($umkm->logo)
                                <img src="{{ asset('storage/' . $umkm->logo) }}"
                                    alt="{{ $umkm->nama_usaha }}"
                                    class="w-full h-full object-cover">
                                @else
                                {{ strtoupper(substr($umkm->nama_usaha, 0, 1)) }}
                                @endif
                            </div>
                            <span class="font-medium text-gray-800">{{ $umkm->nama_usaha }}</span>
                        </div>
                    </td>

                    {{-- CATEGORY --}}
                    <td class="px-6 py-4 text-gray-500">
                        {{ $umkm->kategori->nama ?? 'Tidak ada kategori' }}
                    </td>

                    {{-- OWNER --}}
                    <td class="px-6 py-4 text-gray-600">
                        {{ $umkm->user->name }}
                    </td>

                    {{-- REGISTRATION DATE --}}
                    <td class="px-6 py-4 text-gray-500">
                        {{ \Carbon\Carbon::parse($umkm->created_at)->format('Y-m-d') }}
                    </td>

                    {{-- STATUS --}}
                    <td class="px-6 py-4">
                        <span class="inline-flex px-3 py-1 rounded-full text-xs font-medium shadow-sm transition-colors duration-200
                            @if($umkm->status == 'approved') bg-green-100 text-green-700
                            @elseif($umkm->status == 'pending') bg-yellow-100 text-yellow-700
                            @else bg-red-100 text-red-600
                            @endif">
                            {{ ucfirst($umkm->status) }}
                        </span>
                    </td>

                    {{-- ACTIONS (dropdown) --}}
                    <td class="px-6 py-4 text-right relative" x-data="{ open: false }">
                        <button
                            @click="open = !open"
                            class="w-8 h-8 inline-flex items-center justify-center rounded-full
                                   hover:bg-gray-200 active:scale-95 transition-all duration-200
                                   text-gray-500 font-bold text-base tracking-tighter focus:outline-none"
                            title="Actions">
                            •••
                        </button>

                        <div
                            x-show="open"
                            x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 scale-95 translate-y-1"
                            x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                            x-transition:leave="transition ease-in duration-150"
                            x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                            x-transition:leave-end="opacity-0 scale-95 translate-y-1"
                            x-cloak
                            @click.away="open = false"
                            class="absolute right-4 top-full mt-1 w-44
                                   bg-white border border-gray-100 rounded-xl shadow-xl z-50
                                   overflow-hidden">

                            <button
                                onclick="window.location.href='{{ route("admin.user.show", $umkm->user->id) }}'"
                                class="block w-full text-left px-4 py-3 text-sm text-gray-700
                                       hover:bg-gray-50 transition-colors duration-150 rounded-t-xl">
                                👤 View Profile
                            </button>

                            @if($umkm->status === 'pending')
                            <form action="{{ route('admin.umkm.approve', $umkm->id) }}" method="POST">
                                @csrf
                                <button type="submit"
                                    class="w-full text-left px-4 py-3 text-sm text-green-600
                                               hover:bg-green-50 transition-colors duration-150">
                                    ✅ Approve
                                </button>
                            </form>

                            <form action="{{ route('admin.umkm.reject', $umkm->id) }}" method="POST"
                                onsubmit="return confirm('Yakin ingin menolak UMKM ini?')">
                                @csrf
                                <button type="submit"
                                    class="w-full text-left px-4 py-3 text-sm text-red-600
                                               hover:bg-red-50 transition-colors duration-150 rounded-b-xl">
                                    ❌ Reject
                                </button>
                            </form>
                            @else
                            <form action="{{ route('admin.user.suspend', $umkm->user->id) }}" method="POST"
                                onsubmit="return confirm('Yakin ingin mensuspend user ini?')">
                                @csrf
                                <button type="submit"
                                    class="w-full text-left px-4 py-3 text-sm text-red-600
                                               hover:bg-red-50 transition-colors duration-150 rounded-b-xl">
                                    ⛔ Suspend User
                                </button>
                            </form>
                            @endif
                        </div>
                    </td>

                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-14 text-center text-gray-400 text-sm">
                        <div class="flex flex-col items-center justify-center">
                            <svg class="w-16 h-16 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                            </svg>
                            <span class="text-gray-500 font-medium">Tidak ada data UMKM ditemukan.</span>
                            <p class="text-gray-400 text-xs mt-2">Coba ubah filter atau kata kunci pencarian.</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>

        {{-- PAGINATION --}}
        @if($umkms->hasPages())
        <div class="px-6 py-4 border-t border-gray-100 flex justify-center">
            {{ $umkms->links() }}
        </div>
        @endif

    </div>

</div>

@endsection