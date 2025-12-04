<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Kelola Lapangan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-10">
            
            @if (session('success'))
                <div class="p-4 bg-green-100 text-green-700 rounded-lg shadow-sm border-l-4 border-green-500">
                    {{ session('success') }}
                </div>
            @endif

{{-- STATISTIK BISNIS --}}
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-8">
                
                {{-- Card 1: Total Pemasukan --}}
                <div class="bg-white rounded-xl shadow-sm p-6 border-l-4 border-green-500">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-green-100 text-green-600 mr-4">
                            {{-- Icon Uang --}}
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 font-bold uppercase">Total Pemasukan</p>
                            <p class="text-2xl font-extrabold text-gray-800">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</p>
                        </div>
                    </div>
                </div>

                {{-- Card 2: Orderan Bulan Ini --}}
                <div class="bg-white rounded-xl shadow-sm p-6 border-l-4 border-blue-500">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-blue-100 text-blue-600 mr-4">
                            {{-- Icon Grafik --}}
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 font-bold uppercase">Order Bulan Ini</p>
                            <p class="text-2xl font-extrabold text-gray-800">{{ $orderBulanIni }} <span class="text-sm font-normal text-gray-400">booking</span></p>
                        </div>
                    </div>
                </div>

                {{-- Card 3: Total Sukses --}}
                <div class="bg-white rounded-xl shadow-sm p-6 border-l-4 border-indigo-500">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-indigo-100 text-indigo-600 mr-4">
                            {{-- Icon Jempol/Ceklis --}}
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 font-bold uppercase">Total Sukses</p>
                            <p class="text-2xl font-extrabold text-gray-800">{{ $totalOrderSukses }} <span class="text-sm font-normal text-gray-400">kali</span></p>
                        </div>
                    </div>
                </div>

                {{-- Card 4: Menunggu Konfirmasi (Pending) --}}
                <div class="bg-white rounded-xl shadow-sm p-6 border-l-4 border-yellow-500">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-yellow-100 text-yellow-600 mr-4">
                            {{-- Icon Jam --}}
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 font-bold uppercase">Perlu Diproses</p>
                            <p class="text-2xl font-extrabold text-yellow-600">{{ $orderPending }} <span class="text-sm font-normal text-gray-400">booking</span></p>
                        </div>
                    </div>
                </div>

            </div>
            <div>
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-xl font-bold text-gray-900">Daftar Lapangan Saya</h3>
                    <a href="{{ route('mitra.lapangan.create') }}" class="px-5 py-2.5 bg-red-600 text-white rounded-lg font-bold text-sm hover:bg-red-700 transition shadow-lg shadow-red-200 flex items-center transform hover:-translate-y-0.5">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                        Tambah Lapangan
                    </a>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @forelse ($lapangans as $lapangan)
                        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden hover:shadow-md transition">
                            <div class="h-40 bg-gray-100 relative">
                                @if($lapangan->gambar_url)
                                    <img src="{{ $lapangan->gambar_url }}" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-gray-400">No Image</div>
                                @endif
                                {{-- Label Jenis Lapangan --}}
                                <div class="absolute top-2 right-2 bg-white/90 backdrop-blur-sm px-2 py-1 rounded text-xs font-bold shadow-sm text-gray-700">
                                    {{ $lapangan->jenis }}
                                </div>
                            </div>
                            
                            <div class="p-4">
                                <h4 class="font-bold text-lg text-gray-900 truncate" title="{{ $lapangan->nama_lapangan }}">{{ $lapangan->nama_lapangan }}</h4>
                                
                                {{-- Lokasi Singkat --}}
                                <div class="flex items-center text-gray-500 text-xs mt-1 mb-2">
                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                    {{ Str::limit($lapangan->lokasi ?? 'Lokasi belum diset', 30) }}
                                </div>

                                <p class="text-red-600 font-bold text-sm">Rp {{ number_format($lapangan->harga_per_jam, 0, ',', '.') }} <span class="text-gray-400 font-normal">/ jam</span></p>
                                
                                <div class="mt-4 flex gap-2">
                                    <a href="{{ route('mitra.lapangan.edit', $lapangan->id) }}" class="flex-1 py-2 bg-yellow-50 text-center text-yellow-700 text-xs font-bold rounded-lg hover:bg-yellow-100 border border-yellow-200 transition">
                                        Edit
                                    </a>
                                    <form action="{{ route('mitra.destroy', $lapangan->id) }}" method="POST" class="flex-1" onsubmit="return confirm('Apakah Anda yakin ingin menghapus lapangan ini? Data tidak bisa dikembalikan.');">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="w-full py-2 bg-red-50 text-red-700 text-xs font-bold rounded-lg border border-red-200 hover:bg-red-100 transition">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-3 text-center py-16 bg-white rounded-xl border-2 border-dashed border-gray-300">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                            <h3 class="mt-2 text-sm font-medium text-gray-900">Belum ada lapangan</h3>
                            <p class="mt-1 text-sm text-gray-500">Mulai sewakan tempat olahraga Anda sekarang.</p>
                            <div class="mt-6">
                                <a href="{{ route('mitra.lapangan.create') }}" 
                                class="inline-flex items-center px-4 py-3 border border-transparent shadow-lg shadow-red-200 text-sm font-bold rounded-xl text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition transform hover:-translate-y-0.5">
                                    <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                        <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                                    </svg>
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