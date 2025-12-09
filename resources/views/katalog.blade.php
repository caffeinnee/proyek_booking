<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Katalog Lapangan - {{ config('app.name') }}</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-gray-50 text-gray-900">
        <div class="min-h-screen flex flex-col">
            
            @include('layouts.public-navigation')

            <main class="flex-grow">
                
                {{-- HERO SECTION --}}
                <section class="relative h-[400px] flex items-center justify-center bg-gray-900">
                    {{-- Background Image Fixed --}}
                    <div class="absolute inset-0 overflow-hidden">
                        <img src="{{ asset('images/hero-lapangan.jpg') }}" 
                             alt="Background" 
                             class="w-full h-full object-cover object-center opacity-40">
                        {{-- Overlay Gradient --}}
                        <div class="absolute inset-0 bg-gradient-to-t from-gray-900 via-transparent to-gray-900/50"></div>
                    </div>

                    <div class="relative z-10 w-full max-w-4xl px-4 text-center">
                        <h1 class="text-3xl md:text-5xl font-extrabold text-white mb-2 tracking-tight">
                            Jelajahi Arena Olahraga
                        </h1>
                        <p class="text-gray-200 text-lg mb-8">Temukan lapangan terbaik untuk pertandingan serumu.</p>
                        
                        {{-- Search Form --}}
                        <form action="{{ route('katalog') }}" method="GET">
                            <div class="relative max-w-2xl mx-auto group">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">
                                    <svg class="w-6 h-6 text-gray-400 group-focus-within:text-red-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                                </div>
                                <input type="text" name="search"
                                    class="block w-full p-4 pl-12 text-sm text-gray-900 border-none rounded-full bg-white shadow-2xl focus:ring-4 focus:ring-red-500/30 placeholder-gray-400 transition-all"
                                    placeholder="Cari nama lapangan, lokasi, atau jenis olahraga (misal: Futsal)..."
                                    value="{{ $searchTerm ?? '' }}"
                                    autocomplete="off">
                                <button type="submit" class="absolute right-2.5 bottom-2.5 bg-red-600 text-white hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 font-bold rounded-full text-sm px-6 py-2 transition-transform transform active:scale-95">
                                    Cari
                                </button>
                            </div>
                        </form>
                    </div>
                </section>

                {{-- CATALOG GRID --}}
                <section class="py-16">
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

                        {{-- Header Hasil --}}
                        <div class="flex flex-col md:flex-row justify-between items-end mb-8 border-b border-gray-200 pb-4">
                            <div>
                                <h2 class="text-2xl font-bold text-gray-800">
                                    @if ($searchTerm)
                                        Hasil pencarian: <span class="text-red-600">"{{ $searchTerm }}"</span>
                                    @else
                                        Daftar Lapangan Tersedia
                                    @endif
                                </h2>
                                <p class="text-sm text-gray-500 mt-1">Menampilkan {{ $lapangans->count() }} venue olahraga</p>
                            </div>
                            
                            @if($searchTerm)
                                <a href="{{ route('katalog') }}" class="text-sm text-red-600 hover:text-red-800 font-semibold mt-2 md:mt-0 hover:underline">
                                    Reset Pencarian &larr;
                                </a>
                            @endif
                        </div>

                        {{-- Content --}}
                        @if($lapangans->isEmpty())
                            <div class="flex flex-col items-center justify-center py-20 bg-white rounded-3xl border border-dashed border-gray-300">
                                <div class="p-6 bg-red-50 rounded-full mb-4">
                                    <svg class="w-12 h-12 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                </div>
                                <h3 class="text-xl font-bold text-gray-900">Tidak ada lapangan ditemukan</h3>
                                <p class="text-gray-500 mt-2 text-center max-w-md">Kami tidak menemukan hasil untuk kata kunci "<strong>{{ $searchTerm }}</strong>". Coba gunakan kata kunci yang lebih umum.</p>
                                <a href="{{ route('katalog') }}" class="mt-6 px-6 py-2 bg-gray-900 text-white rounded-lg hover:bg-gray-800 transition">Lihat Semua Lapangan</a>
                            </div>
                        @else
                            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                                @foreach ($lapangans as $lapangan)
                                    <div class="group bg-white rounded-2xl shadow-sm hover:shadow-xl transition-all duration-300 border border-gray-100 flex flex-col overflow-hidden h-full">
                                        
                                        {{-- Image Area --}}
                                        <a href="{{ route('booking.create', ['lapangan' => $lapangan->id]) }}" class="relative h-56 overflow-hidden bg-gray-100 block">
                                            @if($lapangan->gambar_url)
                                                <img src="{{ $lapangan->gambar_url }}" 
                                                     alt="{{ $lapangan->nama_lapangan }}" 
                                                     class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                                            @else
                                                <div class="w-full h-full flex flex-col items-center justify-center text-gray-400">
                                                    <svg class="w-12 h-12 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                                    <span class="text-xs">Tidak ada foto</span>
                                                </div>
                                            @endif
                                            
                                            {{-- Badge Kategori --}}
                                            <div class="absolute top-4 left-4">
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-white/90 text-gray-800 backdrop-blur shadow-sm">
                                                    {{ $lapangan->jenis }}
                                                </span>
                                            </div>
                                        </a>

                                        {{-- Detail Area --}}
                                        <div class="p-5 flex flex-col flex-grow">
                                            
                                            {{-- Rating & Lokasi Kecil --}}
                                            <div class="flex items-center justify-between mb-2">
                                                <div class="flex items-center text-xs font-medium text-gray-500">
                                                    <svg class="w-3.5 h-3.5 mr-1 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                                    {{ Str::limit($lapangan->lokasi, 20) }}
                                                </div>
                                                <div class="flex items-center bg-yellow-50 px-2 py-1 rounded text-xs font-bold text-yellow-700">
                                                    <svg class="w-3 h-3 text-yellow-500 mr-1" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                                    {{ $lapangan->rating ?? 'New' }}
                                                </div>
                                            </div>

                                            <h3 class="text-lg font-bold text-gray-900 mb-1 leading-tight group-hover:text-red-600 transition-colors truncate">
                                                <a href="{{ route('booking.create', ['lapangan' => $lapangan->id]) }}">
                                                    {{ $lapangan->nama_lapangan }}
                                                </a>
                                            </h3>
                                            
                                            <p class="text-sm text-gray-500 mb-4 line-clamp-2">
                                                Lapangan berkualitas dengan fasilitas lengkap untuk menunjang permainan Anda.
                                            </p>

                                            {{-- Spacer --}}
                                            <div class="flex-grow"></div>

                                            {{-- Footer Card --}}
                                            <div class="pt-4 border-t border-gray-100 flex items-center justify-between mt-auto">
                                                <div>
                                                    <span class="text-xs text-gray-400 block">Harga Sewa</span>
                                                    <span class="text-lg font-extrabold text-gray-900">
                                                        Rp {{ number_format($lapangan->harga_per_jam, 0, ',', '.') }}
                                                    </span>
                                                    <span class="text-xs font-normal text-gray-500">/jam</span>
                                                </div>
                                                <a href="{{ route('booking.create', ['lapangan' => $lapangan->id]) }}" 
                                                   class="inline-flex items-center justify-center w-10 h-10 bg-red-50 text-red-600 rounded-full hover:bg-red-600 hover:text-white transition-all shadow-sm group-hover:shadow-md">
                                                    <svg class="w-5 h-5 transform group-hover:translate-x-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                                                </a>
                                            </div>

                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                        
                    </div>
                </section>
                
            </main>
            
            @include('layouts.footer')
        </div>
    </body>
</html>