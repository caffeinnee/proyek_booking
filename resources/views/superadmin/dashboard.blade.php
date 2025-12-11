<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Panel Super Admin') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            
            {{-- Alert Success/Error --}}
            @if(session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4 shadow-sm rounded-r flex items-center">
                    <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4 shadow-sm rounded-r flex items-center">
                    <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    {{ session('error') }}
                </div>
            @endif

            {{-- 1. KARTU STATISTIK --}}
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border-l-4 border-blue-500">
                    <div class="text-gray-500 text-sm font-bold uppercase">Total User</div>
                    <div class="text-3xl font-extrabold text-blue-600">{{ $totalUser }}</div>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border-l-4 border-orange-500">
                    <div class="text-gray-500 text-sm font-bold uppercase">Total Mitra</div>
                    <div class="text-3xl font-extrabold text-orange-600">{{ $totalMitra }}</div>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border-l-4 border-green-500">
                    <div class="text-gray-500 text-sm font-bold uppercase">Total Lapangan</div>
                    <div class="text-3xl font-extrabold text-green-600">{{ $totalLapangan }}</div>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border-l-4 border-purple-500">
                    <div class="text-gray-500 text-sm font-bold uppercase">Total Transaksi</div>
                    <div class="text-3xl font-extrabold text-purple-600">{{ $totalBooking }}</div>
                </div>
            </div>

            {{-- 2. TABEL VERIFIKASI MITRA (Hanya Muncul Jika Ada Data) --}}
            @if(isset($pendingMitras) && $pendingMitras->count() > 0)
                <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg border-2 border-yellow-400">
                    <div class="p-6 border-b border-gray-200 bg-yellow-50 flex justify-between items-center">
                        <div>
                            <h3 class="text-lg font-bold text-gray-900 flex items-center">
                                <span class="bg-yellow-400 text-white rounded-full h-6 w-6 flex items-center justify-center mr-2 text-sm">!</span>
                                Permintaan Verifikasi Mitra
                            </h3>
                            <p class="text-sm text-gray-600 ml-8">Setujui permintaan ini agar user bisa mengelola lapangan.</p>
                        </div>
                        <span class="bg-red-600 text-white text-xs font-bold px-3 py-1 rounded-full animate-pulse">
                            {{ $pendingMitras->count() }} Menunggu
                        </span>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-white">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase">Nama User</th>
                                    <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase">Nama Venue</th>
                                    <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase">Alamat</th>
                                    <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase">Kontak WA</th>
                                    <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($pendingMitras as $calon)
                                    <tr class="bg-yellow-50/50">
                                        <td class="px-6 py-4 whitespace-nowrap font-bold text-gray-900">{{ $calon->name }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $calon->nama_venue }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">{{ Str::limit($calon->alamat, 20) }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $calon->no_wa }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium flex gap-2">
                                            <form action="{{ route('super.mitra.approve', $calon->id) }}" method="POST">
                                                @csrf @method('PATCH')
                                                <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded-lg text-xs font-bold hover:bg-green-700 shadow-sm transition transform hover:scale-105">
                                                    ✔ Terima
                                                </button>
                                            </form>
                                            <form action="{{ route('super.mitra.reject', $calon->id) }}" method="POST" onsubmit="return confirm('Tolak pengajuan ini?');">
                                                @csrf @method('PATCH')
                                                <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-lg text-xs font-bold hover:bg-red-700 shadow-sm transition transform hover:scale-105">
                                                    ✖ Tolak
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif

            {{-- 3. TABEL DAFTAR USER --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-200">
                <div class="p-6 border-b border-gray-200 bg-gray-50 flex justify-between items-center">
                    <h3 class="text-lg font-bold text-gray-900 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                        Daftar Pengguna Aplikasi
                    </h3>
                    <a href="{{ route('super.admin.create') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 transition ease-in-out duration-150">
                        + Tambah Admin
                    </a>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Nama & Role</th>
                                <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Email</th>
                                <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">WA</th>
                                <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Bergabung</th>
                                <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($allUsers as $u)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="text-sm font-bold text-gray-900 mr-2">{{ $u->name }}</div>
                                            
                                            {{-- TOMBOL VERIFIED (PERBAIKAN: MERAH & RAPI) --}}
                                            <form action="{{ route('super.user.verify', $u->id) }}" method="POST" class="inline-block pt-1">
                                                @csrf @method('PATCH')
                                                <button type="submit" title="Klik untuk Ubah Status Verified" 
                                                    class="transition transform hover:scale-110 focus:outline-none">
                                                    @if($u->is_verified)
                                                        {{-- Ikon Centang Merah Solid (Verified) --}}
                                                        <svg class="w-5 h-5 text-red-600 fill-current" viewBox="0 0 20 20">
                                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                                        </svg>
                                                    @else
                                                        {{-- Ikon Centang Abu Outline (Unverified) --}}
                                                        <svg class="w-5 h-5 text-gray-300 hover:text-red-400 fill-current" viewBox="0 0 20 20">
                                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                                        </svg>
                                                    @endif
                                                </button>
                                            </form>
                                        </div>
                                        
                                        {{-- Badge Role --}}
                                        <div class="mt-1">
                                            @if($u->is_admin) <span class="px-2 text-xs font-semibold rounded-full bg-red-100 text-red-800">Admin</span>
                                            @elseif($u->role === 'mitra') <span class="px-2 text-xs font-semibold rounded-full bg-orange-100 text-orange-800">Mitra</span>
                                            @else <span class="px-2 text-xs font-semibold rounded-full bg-gray-100 text-gray-800">User</span>
                                            @endif
                                        </div>
                                    </td>
                                    
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $u->email }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $u->no_wa ?? '-' }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $u->created_at->diffForHumans() }}</td>
                                    
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        @if($u->id !== Auth::id())
                                            <form action="{{ route('super.users.destroy', $u->id) }}" method="POST" onsubmit="return confirm('PERINGATAN: Menghapus user ini akan menghapus semua data terkait (booking, lapangan, dll). Yakin?');">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900 font-bold hover:underline">Hapus</button>
                                            </form>
                                        @else
                                            <span class="text-gray-400 italic text-xs">Akun Anda</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="p-4 bg-gray-50 border-t border-gray-200">
                    {{ $allUsers->appends(['venues_page' => request('venues_page')])->links() }}
                </div>
            </div>

            {{-- 4. TABEL SEMUA LAPANGAN --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-200">
                <div class="p-6 border-b border-gray-200 bg-gray-50 flex justify-between items-center">
                    <h3 class="text-lg font-bold text-gray-900 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                        Daftar Semua Venue
                    </h3>
                    <span class="bg-gray-200 text-gray-700 text-xs font-bold px-3 py-1 rounded-full">Total: {{ $totalLapangan }}</span>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Info Venue</th>
                                <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Pemilik</th>
                                <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Lokasi</th>
                                <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Harga</th>
                                <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($allVenues as $venue)
                                <tr class="hover:bg-gray-50 transition {{ $venue->is_featured ? 'bg-yellow-50' : '' }}">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="h-10 w-10 rounded-lg bg-gray-200 overflow-hidden flex-shrink-0">
                                                @if($venue->gambar_url)
                                                    <img src="{{ $venue->gambar_url }}" class="h-full w-full object-cover">
                                                @else
                                                    <div class="h-full w-full flex items-center justify-center text-gray-400 text-xs">Img</div>
                                                @endif
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-bold text-gray-900 flex items-center gap-1">
                                                    {{ $venue->nama_lapangan }}
                                                    @if($venue->is_featured)
                                                        <span class="text-xs bg-yellow-400 text-yellow-900 px-1.5 py-0.5 rounded font-bold">AD</span>
                                                    @endif
                                                </div>
                                                <div class="text-xs text-gray-500 bg-gray-100 px-2 py-0.5 rounded inline-block mt-1">{{ $venue->jenis }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900 font-medium">{{ $venue->user->name ?? 'Deleted' }}</div>
                                        <div class="text-xs text-gray-500">{{ $venue->user->no_wa ?? '-' }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        <span title="{{ $venue->lokasi }}">{{ Str::limit($venue->lokasi, 20) }}</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 font-bold">
                                        Rp {{ number_format($venue->harga_per_jam, 0, ',', '.') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium flex gap-3 items-center">
                                        {{-- TOMBOL IKLAN (TOGGLE) --}}
                                        <form action="{{ route('super.lapangan.feature', $venue->id) }}" method="POST">
                                            @csrf @method('PATCH')
                                            <button type="submit" 
                                                class="flex items-center gap-1 px-3 py-1 rounded border {{ $venue->is_featured ? 'bg-yellow-100 text-yellow-700 border-yellow-300' : 'bg-gray-100 text-gray-600 border-gray-300 hover:bg-gray-200' }}"
                                                title="{{ $venue->is_featured ? 'Matikan Iklan' : 'Aktifkan Iklan' }}">
                                                <svg class="w-4 h-4" fill="{{ $venue->is_featured ? 'currentColor' : 'none' }}" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 18.657A8 8 0 016.343 7.343S7 9 9 10c0-2 .5-5 2.986-7C14 5 16.09 5.777 17.656 7.343A7.975 7.975 0 0120 13a7.975 7.975 0 01-2.343 5.657z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.879 16.121A3 3 0 1012.015 11L11 14H9c0 .768.293 1.536.879 2.121z"></path></svg>
                                                <span class="text-xs font-bold">{{ $venue->is_featured ? 'ON' : 'OFF' }}</span>
                                            </button>
                                        </form>

                                        {{-- TOMBOL HAPUS --}}
                                        <form action="{{ route('mitra.destroy', $venue->id) }}" method="POST" onsubmit="return confirm('PERINGATAN ADMIN: Menghapus venue ini akan menghapus SEMUA booking terkait. Lanjutkan?');">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900 font-bold" title="Hapus Paksa">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="p-4 bg-gray-50 border-t border-gray-200">
                    {{ $allVenues->appends(['users_page' => request('users_page')])->links() }}
                </div>
            </div>

        </div>
    </div>
</x-app-layout>