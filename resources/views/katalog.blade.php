<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Booking Lapangan</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-gray-100">
        <div class="min-h-screen">
            @include('layouts.public-navigation')
            <main>
                <section class="bg-red-700 text-white" style="background-image: url('{{ asset('images/hero-lapangan.jpg') }}'); background-size: cover; background-position: center; background-blend-mode: overlay; background-color: rgba(127, 29, 29, 0.7);">
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 text-center">
                        
                        <h2 class="text-3xl md:text-4xl font-bold tracking-tight mb-6">
                            DAFTARKAN VENUE MU SEKARANG
                        </h2>
                        
                        <a href="#" class="inline-block px-8 py-3 bg-white text-red-700 rounded-lg font-semibold text-lg hover:bg-gray-100 transition-colors duration-200">
                            Daftarkan Venue &rarr;
                        </a>
                    
                    </div>
                </section>
                <section class="py-12 bg-gray-100">
                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                        </div>
                </section>
                <section class="py-12 bg-gray-100">
                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                        <form action="{{ route('katalog') }}" method="GET" class="max-w-2xl mx-auto">
                            <div class="flex items-center bg-white rounded-lg shadow-lg overflow-hidden p-2">
                                <svg class="h-6 w-6 text-gray-400 mx-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                                <input type="text" name="search"
                                    placeholder="Cari nama lapangan atau jenis..."
                                    class="w-full p-3 border-0 text-gray-700 focus:ring-0"
                                    value="{{ $searchTerm ?? '' }}"> <button type="submit" class="px-6 py-3 bg-red-700 text-white rounded-lg font-medium hover:bg-red-800">
                                    Cari
                                </button>
                            </div>
                        </form>
                    </div>
                </section>

                <section class="py-12">
                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

                        <h2 class="text-2xl font-semibold mb-6">
                            @if ($searchTerm)
                                Hasil pencarian untuk: <span class="text-red-700 font-bold">"{{ $searchTerm }}"</span>
                            @else
                                Katalog Lapangan Tersedia
                            @endif
                        </h2>

                        @if($lapangans->isEmpty())
                            <div class="bg-white shadow rounded-lg p-12 text-center">
                                <h3 class="text-2xl font-semibold mb-4">Oops! Tidak ada hasil.</h3>
                                <p class="text-gray-600">Tidak ada lapangan yang cocok dengan pencarian Anda. Coba kata kunci lain.</p>
                            </div>
                        @else
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                                @foreach ($lapangans as $lapangan)
                                    <div class="bg-white shadow rounded-lg overflow-hidden transition-shadow duration-300 hover:shadow-xl">
                                        <a href="{{ route('booking.create', ['lapangan' => $lapangan->id]) }}">
                                            <img src="{{ $lapangan->gambar_url }}" alt="Foto {{ $lapangan->nama_lapangan }}" 
                                                class="w-full h-48 object-cover">
                                        </a>

                                        <div class="p-4">
                                            <span class="text-xs font-semibold text-gray-500 uppercase">Venue</span>

                                            <h3 class="text-xl font-bold text-gray-900 mt-1 truncate">{{ $lapangan->nama_lapangan }}</h3>

                                            <div class="flex items-center text-sm text-gray-600 mt-2">
                                                <svg class="w-4 h-4 text-yellow-400 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                                </svg>
                                                <span class="font-semibold">{{ $lapangan->rating }}</span>
                                                <span class="mx-2">•</span>
                                                <span>{{ $lapangan->lokasi }}</span>
                                            </div>

                                            <div class="flex items-center text-sm text-gray-500 mt-2">
                                                <span>{{ $lapangan->jenis }}</span>
                                            </div>

                                            <div class="flex justify-between items-end mt-4">
                                                <div>
                                                    <span class="text-sm text-gray-600">Mulai</span>
                                                    <p class="text-lg font-bold text-red-700">
                                                        Rp {{ number_format($lapangan->harga_per_jam, 0, ',', '.') }}
                                                        <span class="text-sm font-normal text-gray-500">/ jam</span>
                                                    </p>
                                                </div>
                                                <a href="{{ route('booking.create', ['lapangan' => $lapangan->id]) }}" 
                                                class="px-4 py-2 bg-red-700 text-white rounded-lg text-sm font-medium hover:bg-red-800">
                                                    Pesan
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