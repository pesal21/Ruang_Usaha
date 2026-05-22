@extends('admin.layout')

@section('content')

<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-6 relative">
    {{-- Orbs dekoratif --}}
    <div class="absolute -top-16 -left-16 w-48 h-48 bg-blue-200/20 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute -bottom-20 -right-20 w-64 h-64 bg-indigo-200/20 rounded-full blur-3xl pointer-events-none"></div>

    {{-- HEADER --}}
    <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-4 mb-8 relative">
        <div>
            <h1 class="text-3xl md:text-4xl font-extrabold bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent">
                UMKM Data Management
            </h1>
            <p class="text-gray-500 mt-1.5 text-base">View and approve registered businesses.</p>
        </div>
        <a href="{{ route('admin.dashboard') }}"
           class="inline-flex items-center gap-2 text-sm font-medium text-blue-600 hover:text-indigo-600 transition-colors duration-200 group">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 flex-shrink-0" fill="none"
                 viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
            </svg>
            <span class="relative">
                Back to Admin Dashboard
                <span class="absolute -bottom-0.5 left-0 w-0 h-px bg-current transition-all duration-300 group-hover:w-full"></span>
            </span>
        </a>
    </div>

    {{-- TABLE CARD --}}
    <div class="bg-white rounded-2xl shadow-md border border-gray-100 overflow-hidden hover:shadow-lg transition-shadow duration-300">

        {{-- SEARCH + FILTER BAR --}}
        <div class="flex flex-col lg:flex-row lg:items-center gap-3 px-6 py-4 border-b border-gray-100 bg-white/90 backdrop-blur-sm">
            <form method="GET" class="flex flex-col sm:flex-row sm:items-center gap-3 w-full">
                {{-- Search --}}
                <div class="relative w-full sm:w-72 group">
                    <span class="absolute left-3.5 top-1/2 -translate-y-1/2 text-gray-400 transition-colors group-focus-within:text-blue-500">
                        <img src="{{ asset('assets/img/icon_umkm/search.png') }}" alt="Search" class="w-4 h-4">
                    </span>
                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Search by name, owner..."
                        class="w-full pl-10 pr-4 py-2.5 border-2 border-gray-200 rounded-xl text-sm
                               focus:outline-none focus:border-blue-400 focus:shadow-[0_0_0_4px_rgba(59,130,246,0.15)]
                               hover:border-blue-300 transition-all duration-200 bg-white placeholder:text-gray-400">
                </div>

                {{-- Filter & Sort + Button --}}
                <div class="flex flex-wrap items-center gap-2 sm:ml-auto">
                    <select name="status"
                        class="px-4 py-2.5 border-2 border-gray-200 rounded-xl text-sm bg-white
                               focus:outline-none focus:border-blue-400 focus:ring-4 focus:ring-blue-100
                               hover:border-blue-300 text-gray-600 cursor-pointer transition-all duration-200">
                        <option value="all">⚙ All Status</option>
                        <option value="approved" @selected(request('status')=='approved')>Approved</option>
                        <option value="pending" @selected(request('status')=='pending')>Pending</option>
                        <option value="rejected" @selected(request('status')=='rejected')>Rejected</option>
                    </select>

                    <select name="sort"
                        class="px-4 py-2.5 border-2 border-gray-200 rounded-xl text-sm bg-white
                               focus:outline-none focus:border-blue-400 focus:ring-4 focus:ring-blue-100
                               hover:border-blue-300 text-gray-600 cursor-pointer transition-all duration-200">
                        <option value="">⇅ Sort</option>
                        <option value="newest" @selected(request('sort')=='newest')>Newest</option>
                        <option value="oldest" @selected(request('sort')=='oldest')>Oldest</option>
                        <option value="name" @selected(request('sort')=='name')>Name A–Z</option>
                    </select>

                    <button type="submit"
                        class="px-5 py-2.5 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700
                               active:scale-95 transition-all duration-200 text-white rounded-xl text-sm
                               font-semibold shadow-md hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
                        Search
                    </button>
                </div>
            </form>
        </div>

        {{-- TABLE --}}
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="text-gray-600 uppercase text-xs tracking-wider border-b border-gray-100 bg-gradient-to-r from-blue-50 to-indigo-50">
                        <th class="px-6 py-3.5 text-left font-semibold">Business Name</th>
                        <th class="px-6 py-3.5 text-left font-semibold">Category</th>
                        <th class="px-6 py-3.5 text-left font-semibold">Owner</th>
                        <th class="px-6 py-3.5 text-left font-semibold">Registration Date</th>
                        <th class="px-6 py-3.5 text-left font-semibold">Status</th>
                        <th class="px-6 py-3.5 text-right font-semibold">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($umkms as $umkm)
                    <tr class="border-t border-gray-50 hover:bg-blue-50/30 transition-colors duration-200">
                        {{-- BUSINESS NAME + LOGO --}}
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-full bg-gradient-to-br from-blue-100 to-indigo-100 overflow-hidden flex-shrink-0
                                            flex items-center justify-center text-blue-600 font-bold text-sm shadow-sm ring-2 ring-white">
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
                        <td class="px-6 py-4 text-gray-600">
                            {{ $umkm->kategori->nama ?? '—' }}
                        </td>

                        {{-- OWNER --}}
                        <td class="px-6 py-4 text-gray-700 font-medium">
                            {{ $umkm->user->name }}
                        </td>

                        {{-- REGISTRATION DATE --}}
                        <td class="px-6 py-4 text-gray-500">
                            {{ \Carbon\Carbon::parse($umkm->created_at)->format('d M Y') }}
                        </td>

                        {{-- STATUS --}}
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold ring-1 ring-inset
                                @if($umkm->status == 'approved') bg-green-50 text-green-700 ring-green-600/20
                                @elseif($umkm->status == 'pending') bg-yellow-50 text-yellow-700 ring-yellow-600/20
                                @else bg-red-50 text-red-600 ring-red-600/20
                                @endif">
                                {{ ucfirst($umkm->status) }}
                            </span>
                        </td>

                        {{-- ACTIONS (dropdown) --}}
                        <td class="px-6 py-4 text-right relative" x-data="{ open: false }">
                            <button
                                @click="open = !open"
                                class="w-9 h-9 inline-flex items-center justify-center rounded-full
                                       hover:bg-blue-100 active:scale-95 transition-all duration-200
                                       text-gray-500 font-bold text-lg leading-none focus:outline-none focus:ring-2 focus:ring-blue-300"
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
                                class="absolute right-0 top-full mb-2 w-48
                                    bg-white border border-gray-100 rounded-xl shadow-xl z-[999] overflow-hidden py-1">

                                <a href="{{ route('admin.user.show', $umkm->user->id) }}"
                                   class="block w-full text-left px-4 py-2.5 text-sm text-gray-700
                                          hover:bg-blue-50 transition-colors duration-150">
                                    👤 View Profile
                                </a>

                                @if($umkm->status === 'pending')
                                <form action="{{ route('admin.umkm.approve', $umkm->id) }}" method="POST">
                                    @csrf
                                    <button type="submit"
                                        class="w-full text-left px-4 py-2.5 text-sm text-green-600
                                               hover:bg-green-50 transition-colors duration-150">
                                        ✅ Approve
                                    </button>
                                </form>

                                <form action="{{ route('admin.umkm.reject', $umkm->id) }}" method="POST"
                                    onsubmit="return confirm('Yakin ingin menolak UMKM ini?')">
                                    @csrf
                                    <button type="submit"
                                        class="w-full text-left px-4 py-2.5 text-sm text-red-600
                                               hover:bg-red-50 transition-colors duration-150">
                                        ❌ Reject
                                    </button>
                                </form>
                                @else
                                <form action="{{ route('admin.user.suspend', $umkm->user->id) }}" method="POST"
                                    onsubmit="return confirm('Yakin ingin mensuspend user ini?')">
                                    @csrf
                                    <button type="submit"
                                        class="w-full text-left px-4 py-2.5 text-sm text-red-600
                                               hover:bg-red-50 transition-colors duration-150">
                                        ⛔ Suspend User
                                    </button>
                                </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-16 text-center text-gray-400">
                            <div class="flex flex-col items-center justify-center">
                                <div class="w-20 h-20 rounded-2xl bg-gradient-to-br from-blue-50 to-indigo-50 border border-blue-100 flex items-center justify-center mb-4 shadow-sm">
                                    <svg class="w-10 h-10 text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                              d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                                    </svg>
                                </div>
                                <span class="text-gray-500 font-medium text-base">Tidak ada data UMKM ditemukan.</span>
                                <p class="text-gray-400 text-sm mt-1">Coba ubah filter atau kata kunci pencarian.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- PAGINATION --}}
        @if($umkms->hasPages())
        <div class="px-6 py-4 border-t border-gray-100 flex justify-center">
            {{ $umkms->links() }}
        </div>
        @endif

    </div>
</div>

@endsection