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
                                            {{-- Tombol TERIMA --}}
                                            <form action="{{ route('super.mitra.approve', $calon->id) }}" method="POST">
                                                @csrf @method('PATCH')
                                                <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded-lg text-xs font-bold hover:bg-green-700 shadow-sm transition transform hover:scale-105">
                                                    ✔ Terima
                                                </button>
                                            </form>
                                            
                                            {{-- Tombol TOLAK --}}
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

            {{-- 3. TABEL DAFTAR SEMUA USER --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">   
                <div class="p-6 border-b border-gray-200 bg-gray-50 flex justify-between items-center">
                    <h3 class="text-lg font-bold text-gray-900">Daftar Pengguna Aplikasi</h3>
                    
                    {{-- TOMBOL TAMBAH ADMIN --}}
                    <a href="{{ route('super.admin.create') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        + Tambah Admin
                    </a>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Role</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Bergabung</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($allUsers as $u)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">{{ $u->name }}</div>
                                        <div class="text-xs text-gray-500">{{ $u->email }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($u->is_admin)
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Admin</span>
                                        @elseif($u->role === 'mitra')
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-orange-100 text-orange-800">Mitra</span>
                                        @else
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">User</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $u->created_at->diffForHumans() }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        @if($u->id !== Auth::id())
                                            <form action="{{ route('super.users.destroy', $u->id) }}" method="POST" onsubmit="return confirm('Hapus user ini?');">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900 font-bold hover:underline">Hapus</button>
                                            </form>
                                        @else
                                            <span class="text-gray-400 text-xs italic">Anda</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="p-4">
                    {{ $allUsers->appends(['venues_page' => request('venues_page')])->links() }}
                </div>
            </div>

            {{-- 4. TABEL DAFTAR SEMUA LAPANGAN --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 border-b border-gray-200 bg-gray-50 flex justify-between items-center">
                    <h3 class="text-lg font-bold text-gray-900">Daftar Semua Venue</h3>
                    <span class="bg-gray-200 text-gray-800 text-xs font-bold px-2 py-1 rounded">Total: {{ $totalLapangan }}</span>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Venue</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Pemilik</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Harga</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($allVenues as $venue)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-bold text-gray-900">{{ $venue->nama_lapangan }}</div>
                                        <div class="text-xs text-gray-500">{{ $venue->jenis }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $venue->user->name ?? 'Deleted User' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-900">
                                        Rp {{ number_format($venue->harga_per_jam, 0, ',', '.') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <form action="{{ route('mitra.destroy', $venue->id) }}" method="POST" onsubmit="return confirm('Hapus lapangan ini?');">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900 font-bold hover:underline">Hapus Paksa</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="p-4">
                    {{ $allVenues->appends(['users_page' => request('users_page')])->links() }}
                </div>
            </div>

        </div>
    </div>
</x-app-layout>