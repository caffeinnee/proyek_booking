<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Kelola Lapangan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            
            @if (session('success'))
                <div class="p-4 bg-green-100 text-green-700 rounded-lg shadow-sm border-l-4 border-green-500">
                    {{ session('success') }}
                </div>
            @endif

            {{-- 1. INFO STATUS AKUN & CARA UPGRADE --}}
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                    <div class="flex items-center gap-4">
                        <div class="h-14 w-14 rounded-full flex items-center justify-center text-xl font-bold
                            {{ Auth::user()->is_verified ? 'bg-red-100 text-red-600' : 'bg-gray-100 text-gray-500' }}">
                            {{ substr(Auth::user()->nama_venue, 0, 1) }}
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-gray-900 flex items-center gap-2">
                                {{ Auth::user()->nama_venue }}
                                @if(Auth::user()->is_verified)
                                    <span class="bg-red-100 text-red-700 text-xs px-2 py-0.5 rounded-full border border-red-200 flex items-center">
                                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                                        Verified Partner
                                    </span>
                                @else
                                    <span class="bg-gray-100 text-gray-600 text-xs px-2 py-0.5 rounded-full border border-gray-200">
                                        Regular Partner
                                    </span>
                                @endif
                            </h3>
                            <p class="text-sm text-gray-500">{{ Auth::user()->email }}</p>
                        </div>
                    </div>

                    {{-- Tombol Upgrade (DENGAN HARGA) --}}
                    @if(!Auth::user()->is_verified)
                        <a href="https://wa.me/6281234567890?text=Halo%20Admin,%20saya%20ingin%20upgrade%20akun%20Mitra%20menjadi%20Verified." target="_blank" 
                           class="flex items-center gap-2 px-5 py-2.5 bg-red-600 text-white rounded-lg font-bold text-sm hover:bg-red-700 transition shadow-md hover:-translate-y-0.5 transform">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            <div>
                                Dapatkan Verified
                                <span class="block text-[10px] font-normal opacity-90 text-red-100">Rp 50.000 / bulan</span>
                            </div>
                        </a>
                    @endif
                </div>
            </div>

            {{-- 2. STATISTIK --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                <div class="bg-white rounded-xl shadow-sm p-6 border-l-4 border-green-500">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-green-100 text-green-600 mr-4">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 font-bold uppercase">Total Pemasukan</p>
                            <p class="text-xl lg:text-2xl font-extrabold text-gray-800 truncate" title="Rp {{ number_format($totalPendapatan, 0, ',', '.') }}">
                                Rp {{ number_format($totalPendapatan, 0, ',', '.') }}
                            </p>
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-xl shadow-sm p-6 border-l-4 border-blue-500">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-blue-100 text-blue-600 mr-4">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 font-bold uppercase">Order Bulan Ini</p>
                            <p class="text-2xl font-extrabold text-gray-800">{{ $orderBulanIni }}</p>
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-xl shadow-sm p-6 border-l-4 border-indigo-500">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-indigo-100 text-indigo-600 mr-4">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 font-bold uppercase">Total Sukses</p>
                            <p class="text-2xl font-extrabold text-gray-800">{{ $totalOrderSukses }}</p>
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-xl shadow-sm p-6 border-l-4 border-yellow-500">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-yellow-100 text-yellow-600 mr-4">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 font-bold uppercase">Perlu Diproses</p>
                            <p class="text-2xl font-extrabold text-yellow-600">{{ $orderPending }}</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- 3. DAFTAR LAPANGAN --}}
            <div>
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-xl font-bold text-gray-900">Daftar Lapangan Saya</h3>
                    <a href="{{ route('mitra.lapangan.create') }}" class="px-5 py-2.5 bg-red-600 text-white rounded-lg font-bold text-sm hover:bg-red-700 transition shadow-lg shadow-red-200 flex items-center transform hover:-translate-y-0.5">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                        Tambah Lapangan
                    </a>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @forelse ($lapangans as $lapangan)
                        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden hover:shadow-md transition relative 
                            {{ $lapangan->is_featured ? 'ring-2 ring-yellow-400' : '' }}">
                            
                            {{-- Status IKLAN --}}
                            @if($lapangan->is_featured)
                                <div class="absolute top-0 right-0 bg-yellow-400 text-yellow-900 text-xs font-bold px-3 py-1 rounded-bl-lg z-10 shadow-sm">
                                    🔥 IKLAN AKTIF
                                </div>
                            @endif

                            <div class="h-48 bg-gray-100 relative group">
                                @if($lapangan->gambar_url)
                                    <img src="{{ $lapangan->gambar_url }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-gray-400">No Image</div>
                                @endif
                                <div class="absolute top-2 left-2 bg-white/90 backdrop-blur-sm px-2 py-1 rounded text-xs font-bold shadow-sm text-gray-700">
                                    {{ $lapangan->jenis }}
                                </div>
                            </div>
                            
                            <div class="p-4">
                                <h4 class="font-bold text-lg text-gray-900 truncate" title="{{ $lapangan->nama_lapangan }}">{{ $lapangan->nama_lapangan }}</h4>
                                <div class="flex items-center text-gray-500 text-xs mt-1 mb-2">
                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                    {{ Str::limit($lapangan->lokasi ?? 'Lokasi belum diset', 30) }}
                                </div>

                                <div class="flex justify-between items-end mb-4">
                                    <p class="text-red-600 font-bold text-sm">Rp {{ number_format($lapangan->harga_per_jam, 0, ',', '.') }} <span class="text-gray-400 font-normal">/ jam</span></p>
                                    
                                    {{-- Tombol Promosi (DENGAN HARGA) --}}
                                    @if(!$lapangan->is_featured)
                                        <a href="https://wa.me/6281234567890?text=Halo%20Admin,%20saya%20ingin%20pasang%20iklan%20untuk%20lapangan:%20{{ $lapangan->nama_lapangan }}" target="_blank" 
                                           class="text-xs bg-yellow-100 text-yellow-800 px-3 py-1.5 rounded-lg hover:bg-yellow-200 transition font-bold border border-yellow-200">
                                            ⚡ Iklan (Rp 20rb/Minggu)
                                        </a>
                                    @endif
                                </div>
                                
                                <div class="flex gap-2 pt-3 border-t border-gray-100">
                                    <a href="{{ route('mitra.lapangan.edit', $lapangan->id) }}" class="flex-1 py-2 bg-gray-50 text-center text-gray-600 text-xs font-bold rounded-lg hover:bg-gray-100 border border-gray-200 transition">
                                        Edit
                                    </a>
                                    <form action="{{ route('mitra.destroy', $lapangan->id) }}" method="POST" class="flex-1" onsubmit="return confirm('Apakah Anda yakin ingin menghapus lapangan ini? Data tidak bisa dikembalikan.');">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="w-full py-2 bg-white text-red-600 text-xs font-bold rounded-lg border border-red-200 hover:bg-red-50 transition">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-full text-center py-16 bg-white rounded-xl border-2 border-dashed border-gray-300">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                            <h3 class="mt-2 text-sm font-medium text-gray-900">Belum ada lapangan</h3>
                            <p class="mt-1 text-sm text-gray-500">Mulai sewakan tempat olahraga Anda sekarang.</p>
                            <div class="mt-6">
                                <a href="{{ route('mitra.lapangan.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                    Tambah Lapangan Baru
                                </a>
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>

        </div>
    </div>
</x-app-layout>