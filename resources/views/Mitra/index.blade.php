<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Mitra') }}
        </h2>
    </x-slot>

    <div class="py-6 md:py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
            
            @if (session('success'))
                <div x-data="{ show: true }" x-show="show" class="p-4 bg-green-100 text-green-700 rounded-lg shadow-sm border-l-4 border-green-500 flex justify-between items-center">
                    <span>{{ session('success') }}</span>
                    <button @click="show = false" class="text-green-700 font-bold">&times;</button>
                </div>
            @endif

            {{-- 1. INFO STATUS AKUN --}}
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5 relative overflow-hidden">
                <div class="absolute top-0 right-0 w-24 h-24 bg-red-50 rounded-bl-full -mr-4 -mt-4 z-0"></div>

                <div class="relative z-10 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                    <div class="flex items-center gap-4">
                        {{-- Avatar --}}
                        <div class="h-14 w-14 rounded-full flex shrink-0 items-center justify-center text-xl font-bold shadow-sm border-2 border-white text-white
                            {{ Auth::user()->is_verified ? 'bg-red-600' : 'bg-gray-400' }}">
                            {{ substr(Auth::user()->nama_venue, 0, 1) }}
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-gray-900 flex flex-wrap items-center gap-2">
                                {{ Auth::user()->nama_venue }}
                                @if(Auth::user()->is_verified)
                                    <span class="bg-red-100 text-red-700 text-[10px] px-2 py-0.5 rounded-full border border-red-200 flex items-center font-bold uppercase tracking-wide">
                                        Verified
                                    </span>
                                @else
                                    <span class="bg-gray-100 text-gray-600 text-[10px] px-2 py-0.5 rounded-full border border-gray-200 uppercase font-bold">
                                        Regular
                                    </span>
                                @endif
                            </h3>
                            <p class="text-xs text-gray-500">{{ Auth::user()->email }}</p>
                        </div>
                    </div>

                    @if(!Auth::user()->is_verified)
                        <a href="https://wa.me/6282264344393?text=Halo%20Admin,%20saya%20ingin%20upgrade%20akun%20Mitra." target="_blank" 
                           class="w-full md:w-auto flex items-center justify-center gap-3 px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition shadow-md group">
                            {{-- Ikon Petir --}}
                            <svg class="w-5 h-5 group-hover:scale-110 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                            
                            <div class="text-left">
                                <div class="font-bold text-sm leading-none">Upgrade Premium</div>
                                <div class="text-[10px] font-normal opacity-90 mt-0.5">Rp 50.000 / bulan</div>
                            </div>
                        </a>
                    @endif
                </div>
            </div>

            {{-- 2. STATISTIK (CLEAN VERSION - TANPA IKON) --}}
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 md:gap-4">
                {{-- Card 1: Pemasukan --}}
                <div class="bg-white rounded-xl shadow-sm p-4 border-t-4 border-green-500">
                    <p class="text-[10px] md:text-xs text-gray-500 font-bold uppercase mb-1">Pemasukan</p>
                    <p class="text-base sm:text-2xl font-extrabold text-gray-800 break-words leading-tight">
                        <span class="text-[10px] text-gray-400 font-normal">Rp</span> {{ number_format($totalPendapatan, 0, ',', '.') }}
                    </p>
                </div>

                {{-- Card 2: Pending --}}
                <div class="bg-white rounded-xl shadow-sm p-4 border-t-4 border-yellow-500">
                    <p class="text-[10px] md:text-xs text-gray-500 font-bold uppercase mb-1">Pending</p>
                    <p class="text-xl sm:text-2xl font-extrabold text-yellow-600">{{ $orderPending }}</p>
                </div>

                {{-- Card 3: Sukses --}}
                <div class="bg-white rounded-xl shadow-sm p-4 border-t-4 border-indigo-500">
                    <p class="text-[10px] md:text-xs text-gray-500 font-bold uppercase mb-1">Sukses</p>
                    <p class="text-xl sm:text-2xl font-extrabold text-gray-800">{{ $totalOrderSukses }}</p>
                </div>

                {{-- Card 4: Order Bulan Ini --}}
                <div class="bg-white rounded-xl shadow-sm p-4 border-t-4 border-blue-500">
                    <p class="text-[10px] md:text-xs text-gray-500 font-bold uppercase mb-1">Order Bulan Ini</p>
                    <p class="text-xl sm:text-2xl font-extrabold text-gray-800">{{ $orderBulanIni }}</p>
                </div>
            </div>

            {{-- 3. DAFTAR LAPANGAN --}}
            <div class="pt-4">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-bold text-gray-900 border-l-4 border-red-600 pl-3">Lapangan Saya</h3>
                    
                    {{-- Tombol Tambah (Versi Desktop) --}}
                    <a href="{{ route('mitra.lapangan.create') }}" class="hidden md:flex px-4 py-2 bg-gray-900 text-white rounded-lg font-bold text-xs hover:bg-gray-800 transition items-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                        Tambah Unit
                    </a>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
                    @forelse ($lapangans as $lapangan)
                        {{-- FIX: Class 'relative' WAJIB ADA di sini --}}
                        <div class="relative bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-md transition group
                            {{ $lapangan->is_featured ? 'ring-1 ring-yellow-400' : '' }}">
                            
                            {{-- Iklan Badge --}}
                            @if($lapangan->is_featured)
                                <div class="absolute top-0 right-0 bg-yellow-400 text-yellow-900 text-[10px] font-bold px-2 py-1 rounded-bl-lg z-20 shadow-sm">
                                    ðŸ”¥ IKLAN
                                </div>
                            @endif

                            {{-- Gambar --}}
                            <div class="h-40 bg-gray-200 relative overflow-hidden">
                                @if($lapangan->gambar_url)
                                    <img src="{{ $lapangan->gambar_url }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-gray-400 text-xs">No Image</div>
                                @endif
                                <div class="absolute bottom-2 left-2 bg-black/60 backdrop-blur-sm px-2 py-1 rounded text-[10px] font-bold text-white">
                                    {{ $lapangan->jenis }}
                                </div>
                            </div>
                            
                            {{-- Content --}}
                            <div class="p-4">
                                <div class="flex justify-between items-start">
                                    <h4 class="font-bold text-gray-900 truncate flex-1 mr-2">{{ $lapangan->nama_lapangan }}</h4>
                                    <p class="text-red-600 font-bold text-xs whitespace-nowrap">
                                        Rp {{ number_format($lapangan->harga_per_jam, 0, ',', '.') }}
                                    </p>
                                </div>
                                
                                <p class="text-gray-400 text-xs mt-1 mb-3 flex items-center truncate">
                                    <svg class="w-3 h-3 mr-1 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                    {{ Str::limit($lapangan->lokasi ?? 'Lokasi belum diset', 25) }}
                                </p>

                                <div class="grid grid-cols-2 gap-2 mt-2">
                                    <a href="{{ route('mitra.lapangan.edit', $lapangan->id) }}" class="py-1.5 bg-gray-50 text-gray-600 text-center text-xs font-bold rounded hover:bg-gray-100 border border-gray-200">
                                        Edit
                                    </a>
                                    
                                    @if(!$lapangan->is_featured)
                                        <a href="https://wa.me/6282264344393?text=Iklan" target="_blank" class="py-1.5 bg-yellow-50 text-yellow-700 text-center text-xs font-bold rounded hover:bg-yellow-100 border border-yellow-200">
                                            Promosi
                                        </a>
                                    @else
                                        <span class="py-1.5 bg-green-50 text-green-700 text-center text-xs font-bold rounded border border-green-200 cursor-default">
                                            Aktif
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-full py-10 flex flex-col items-center justify-center text-center bg-gray-50 rounded-xl border-2 border-dashed border-gray-300">
                            <svg class="h-10 w-10 text-gray-300 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            <p class="text-xs text-gray-500">Belum ada lapangan.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    {{-- FLOATING ACTION BUTTON (FAB) KHUSUS MOBILE --}}
    <a href="{{ route('mitra.lapangan.create') }}" 
       class="md:hidden fixed bottom-6 right-6 w-14 h-14 bg-red-600 text-white rounded-full shadow-lg shadow-red-300 flex items-center justify-center hover:scale-110 transition z-50">
        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
    </a>

    {{-- SCRIPT AUTO REFRESH --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            let currentData = {
                pendapatan: {{ $totalPendapatan }}, 
                pending: {{ $orderPending }},
                lastCheck: Date.now() 
            };
            const checkInterval = 10000; 

            setInterval(() => {
                fetch('{{ route("mitra.check.updates") }}')
                    .then(response => {
                        if (!response.ok) throw new Error('Network response was not ok');
                        return response.json();
                    })
                    .then(data => {
                        if (data.order_pending !== currentData.pending || data.total_pendapatan !== currentData.pendapatan) {
                            console.log('Perubahan terdeteksi! Refreshing...');
                            window.location.reload();
                        }
                    })
                    .catch(error => console.error('Error fetching updates:', error));
            }, checkInterval);
        });
    </script>
</x-app-layout>