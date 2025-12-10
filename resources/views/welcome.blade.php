<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name', 'Booking Lapangan') }}</title>
        
        <link rel="icon" href="{{ asset('images/logo.png') }}" type="image/png">

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-gray-100 text-gray-900">
        <div class="min-h-screen flex flex-col"> 
            
            @include('layouts.public-navigation')

            <main class="flex-grow"> 
                
                {{-- Hero Section --}}
                <section class="relative bg-gray-900 text-white">
                    <div class="absolute inset-0 overflow-hidden">
                        <img src="{{ asset('images/hero-lapangan.jpg') }}" alt="Background Lapangan" class="w-full h-full object-cover object-center opacity-40">
                        <div class="absolute inset-0 bg-gray-900 bg-opacity-50"></div>
                    </div>
                    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-32 text-center">
                        <h1 class="text-4xl md:text-6xl font-extrabold tracking-tight mb-6">
                            Temukan & Booking <span class="text-red-500">Lapangan Olahraga</span>
                        </h1>
                        <p class="text-lg md:text-xl text-gray-300 mb-10 max-w-2xl mx-auto">
                            Cara termudah untuk mencari, membandingkan, dan memesan lapangan olahraga favorit Anda dalam hitungan menit.
                        </p>
                        
                        {{-- Form Pencarian --}}
                        <form action="{{ route('katalog') }}" method="GET" class="max-w-3xl mx-auto relative">
                            <div class="flex items-center bg-white rounded-full shadow-2xl p-2 pl-6">
                                <svg class="h-6 w-6 text-gray-400 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                                <input type="text" name="search"
                                    placeholder="Cari lapangan futsal, badminton, atau lokasi..."
                                    class="w-full p-3 border-none focus:ring-0 text-gray-800 placeholder-gray-500 bg-transparent text-lg"
                                    autocomplete="off">
                                <button type="submit" class="px-8 py-3 bg-red-600 text-white rounded-full font-bold text-lg hover:bg-red-700 transition duration-300 shadow-md">
                                    Cari
                                </button>
                            </div>
                        </form>
                    </div>
                </section>

                {{-- Kategori Olahraga --}}
                <section class="py-20 bg-gray-50">
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                        <div class="text-center mb-12">
                            <h2 class="text-3xl font-bold text-gray-900">Pilih Olahraga Favoritmu</h2>
                            <p class="mt-4 text-gray-600">Temukan lapangan berdasarkan jenis olahraga yang ingin kamu mainkan.</p>
                        </div>
                        
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                            {{-- Futsal --}}
                            <a href="{{ route('katalog', ['search' => 'futsal']) }}" class="group block p-8 bg-white rounded-2xl shadow-sm hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 border border-gray-100">
                                <div class="flex justify-center mb-6">
                                    <div class="p-4 bg-red-50 rounded-full group-hover:bg-red-100 transition-colors">
                                        <img src="{{ asset('images/icon-futsal.svg') }}" alt="Futsal" class="h-12 w-12">
                                    </div>
                                </div>
                                <h3 class="text-lg font-bold text-gray-900 text-center group-hover:text-red-600 transition-colors">Futsal</h3>
                            </a>
                            
                            {{-- Badminton --}}
                            <a href="{{ route('katalog', ['search' => 'badminton']) }}" class="group block p-8 bg-white rounded-2xl shadow-sm hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 border border-gray-100">
                                <div class="flex justify-center mb-6">
                                    <div class="p-4 bg-blue-50 rounded-full group-hover:bg-blue-100 transition-colors">
                                        <img src="{{ asset('images/icon-badminton.svg') }}" alt="Badminton" class="h-12 w-12">
                                    </div>
                                </div>
                                <h3 class="text-lg font-bold text-gray-900 text-center group-hover:text-blue-600 transition-colors">Badminton</h3>
                            </a>
                            
                            {{-- Voli --}}
                            <a href="{{ route('katalog', ['search' => 'voli']) }}" class="group block p-8 bg-white rounded-2xl shadow-sm hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 border border-gray-100">
                                <div class="flex justify-center mb-6">
                                    <div class="p-4 bg-yellow-50 rounded-full group-hover:bg-yellow-100 transition-colors">
                                        <img src="{{ asset('images/icon-voli.png') }}" alt="Voli" class="h-12 w-12">
                                    </div>
                                </div>
                                <h3 class="text-lg font-bold text-gray-900 text-center group-hover:text-yellow-600 transition-colors">Voli</h3>
                            </a>

                            {{-- Lainnya --}}
                            <a href="{{ route('katalog') }}" class="group block p-8 bg-white rounded-2xl shadow-sm hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 border border-gray-100">
                                <div class="flex justify-center mb-6">
                                    <div class="p-4 bg-green-50 rounded-full group-hover:bg-green-100 transition-colors">
                                        <img src="{{ asset('images/icon-lainnya.svg') }}" alt="Lainnya" class="h-12 w-12">
                                    </div>
                                </div>
                                <h3 class="text-lg font-bold text-gray-900 text-center group-hover:text-green-600 transition-colors">Semua Lapangan</h3>
                            </a>
                        </div>
                    </div>
                </section>

                {{-- Keunggulan --}}
                <section class="py-20 bg-white">
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                        <div class="text-center mb-16">
                            <h2 class="text-3xl font-bold text-gray-900">Mengapa Memilih Kami?</h2>
                            <div class="w-24 h-1 bg-red-500 mx-auto mt-4 rounded-full"></div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                            {{-- Fitur 1 --}}
                            <div class="p-8 text-center bg-white rounded-xl hover:bg-gray-50 transition duration-300 border border-transparent hover:border-gray-100">
                                <div class="inline-flex items-center justify-center w-20 h-20 mb-6 bg-red-100 rounded-full text-red-600">
                                    <img src="{{ asset('images/icon-mudah.svg') }}" alt="Mudah" class="h-10 w-10">
                                </div>
                                <h3 class="text-xl font-bold mb-3 text-gray-900">Mudah & Praktis</h3>
                                <p class="text-gray-600 leading-relaxed">
                                    Cari dan booking lapangan olahraga favorit Anda langsung dari smartphone, kapan saja dan di mana saja.
                                </p>
                            </div>
                            
                            {{-- Fitur 2 --}}
                            <div class="p-8 text-center bg-white rounded-xl hover:bg-gray-50 transition duration-300 border border-transparent hover:border-gray-100">
                                <div class="inline-flex items-center justify-center w-20 h-20 mb-6 bg-blue-100 rounded-full text-blue-600">
                                    <img src="{{ asset('images/icon-pilihan-banyak.svg') }}" alt="Pilihan" class="h-10 w-10">
                                </div>
                                <h3 class="text-xl font-bold mb-3 text-gray-900">Banyak Pilihan</h3>
                                <p class="text-gray-600 leading-relaxed">
                                    Tersedia berbagai jenis lapangan olahraga dengan lokasi yang tersebar, memberikan Anda fleksibilitas maksimal.
                                </p>
                            </div>
                            
                            {{-- Fitur 3 --}}
                            <div class="p-8 text-center bg-white rounded-xl hover:bg-gray-50 transition duration-300 border border-transparent hover:border-gray-100">
                                <div class="inline-flex items-center justify-center w-20 h-20 mb-6 bg-green-100 rounded-full text-green-600">
                                    <img src="{{ asset('images/icon-cek-detail.svg') }}" alt="Detail" class="h-10 w-10">
                                </div>
                                <h3 class="text-xl font-bold mb-3 text-gray-900">Info Transparan</h3>
                                <p class="text-gray-600 leading-relaxed">
                                    Lihat foto, harga, fasilitas, dan jadwal ketersediaan lapangan secara real-time sebelum Anda memesan.
                                </p>
                            </div>
                        </div>
                    </div>
                </section>

                {{-- Call to Action (Mitra) --}}
                <section class="py-20 bg-gray-900 text-white relative overflow-hidden">
                    {{-- Dekorasi background abstrak --}}
                    <div class="absolute top-0 right-0 -mr-20 -mt-20 w-96 h-96 rounded-full bg-red-600 opacity-20 blur-3xl"></div>
                    <div class="absolute bottom-0 left-0 -ml-20 -mb-20 w-80 h-80 rounded-full bg-blue-600 opacity-20 blur-3xl"></div>

                    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                        <h2 class="text-3xl md:text-4xl font-bold mb-6">Punya Venue Olahraga?</h2>
                        <p class="text-xl text-gray-300 mb-10 max-w-2xl mx-auto">
                            Bergabunglah dengan ribuan pemilik lapangan lainnya. Kelola jadwal, terima pesanan online, dan tingkatkan pendapatan bisnis Anda bersama kami.
                        </p>
                        
                        {{-- Tombol Daftar Mitra --}}
                        <div class="flex flex-col sm:flex-row justify-center gap-4">
                            <a href="{{ route('mitra.create') }}" class="px-8 py-4 bg-red-600 text-white text-lg font-bold rounded-lg hover:bg-red-700 transition shadow-lg transform hover:-translate-y-1">
                                Daftarkan Venue Sekarang
                            </a>
                            <a href="#" class="px-8 py-4 bg-transparent border-2 border-white text-white text-lg font-bold rounded-lg hover:bg-white hover:text-gray-900 transition">
                                Pelajari Lebih Lanjut
                            </a>
                        </div>
                    </div>
                </section>

                {{-- Testimonial --}}
                <section class="py-20 bg-white">
                    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
                        <div class="bg-gray-50 rounded-2xl p-10 md:p-14 shadow-sm relative text-center">
                            <svg class="absolute top-6 left-6 h-12 w-12 text-gray-300 opacity-50" fill="currentColor" viewBox="0 0 32 32" aria-hidden="true">
                                <path d="M9.333 7C5.8 7 3 9.8 3 13.333c0 3.533 2.8 6.333 6.333 6.333 1.04 0 2.013-.253 2.853-.707l.867.867C12.333 20.547 11.5 21 10.6 21c-4.56 0-8.267-3.707-8.267-8.267C2.333 8.173 5.507 5 9.333 5c1.467 0 2.853.373 4.053 1.04l-.867.867C11.667 7.253 10.533 7 9.333 7zM22.667 7c-3.533 0-6.333 2.8-6.333 6.333 0 3.533 2.8 6.333 6.333 6.333 1.04 0 2.013-.253 2.853-.707l.867.867c-.72.72-1.587 1.067-2.48 1.067-4.56 0-8.267-3.707-8.267-8.267C14.333 8.173 17.507 5 21.333 5c1.467 0 2.853.373 4.053 1.04l-.867.867C23.667 7.253 22.533 7 21.333 7z" />
                            </svg>
                            
                            <blockquote class="text-xl md:text-2xl font-medium text-gray-800 leading-relaxed mb-8">
                                "Aplikasi ini benar-benar mengubah cara saya berolahraga. Mencari lapangan jadi sangat mudah, tidak perlu lagi telepon sana-sini untuk cek jadwal kosong."
                            </blockquote>
                            
                            <div class="flex items-center justify-center space-x-4">
                                <div class="h-12 w-12 rounded-full bg-gray-300 flex items-center justify-center text-xl font-bold text-gray-600">
                                    AD
                                </div>
                                <div class="text-left">
                                    <div class="font-bold text-gray-900">Andi Pratama</div>
                                    <div class="text-sm text-gray-500">Pengguna Setia</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                {{-- Media Partner (Logo) --}}
                <section class="py-12 bg-gray-50 border-t border-gray-100">
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                        <p class="text-center text-sm font-semibold text-gray-500 uppercase tracking-wide mb-8">
                            Diliput Oleh Media Ternama
                        </p>
                        <div class="flex flex-wrap justify-center items-center gap-8 md:gap-16 opacity-60 grayscale hover:grayscale-0 transition-all duration-500">
                            <span class="text-2xl font-bold text-gray-800">Kompas.id</span>
                            <span class="text-2xl font-bold text-gray-800">Liputan6</span>
                            <span class="text-2xl font-bold text-gray-800">Bola.com</span>
                            <span class="text-2xl font-bold text-gray-800">Suara.com</span>
                            <span class="text-2xl font-bold text-gray-800">Detik</span>
                        </div>
                    </div>
                </section>
                
            </main>

            @include('layouts.footer')

        </div>
    </body>
</html>