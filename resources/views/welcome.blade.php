<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Booking Lapangan</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-gray-100">
        <div class="min-h-screen flex flex-col"> @include('layouts.public-navigation')

            <main class="flex-grow"> 
                <section class="bg-red-700 text-white" style="background-image: url('{{ asset('images/hero-lapangan.jpg') }}'); background-size: cover; background-position: center; background-blend-mode: overlay; background-color: rgba(17, 24, 39, 0.7);">
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 text-center">
                        <h1 class="text-4xl md:text-5xl font-extrabold mb-4">Temukan & Booking Lapangan Olahraga</h1>
                        <p class="text-xl text-red-100 mb-8">Cara termudah untuk bermain olahraga favorit Anda.</p>
                        
                        <form action="{{ route('katalog') }}" method="GET" class="max-w-2xl mx-auto">
                            <div class="flex items-center bg-white rounded-lg shadow-lg overflow-hidden p-2">
                                <svg class="h-6 w-6 text-gray-400 mx-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                                <input type="text" name="search"
                                       placeholder="Cari nama lapangan atau jenis (cth: Sintetis)"
                                       class="w-full p-3 border-0 text-gray-700 focus:ring-0">
                                <button type="submit" class="px-6 py-3 bg-red-700 text-white rounded-lg font-medium hover:bg-red-800">
                                    Cari
                                </button>
                            </div>
                        </form>
                    </div>
                </section>

                <section class="py-16 bg-gray-50">
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                        <h2 class="text-3xl font-bold text-center mb-8">Pilih Olahraga Favoritmu</h2>
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-6 text-center">
                            
                            <a href="{{ route('katalog', ['search' => 'futsal']) }}" class="block p-6 bg-white rounded-lg shadow-md hover:shadow-xl transition-shadow">
                                <div class="flex justify-center mb-4 h-16 w-16 mx-auto">
                                    <img src="{{ asset('images/icon-futsal.svg') }}" alt="Ikon Futsal" class="h-16 w-16">
                                </div>
                                <h3 class="text-xl font-semibold">Futsal</h3>
                            </a>
                            
                            <a href="{{ route('katalog', ['search' => 'matras']) }}" class="block p-6 bg-white rounded-lg shadow-md hover:shadow-xl transition-shadow">
                                <div class="flex justify-center mb-4 h-16 w-16 mx-auto">
                                    <img src="{{ asset('images/icon-badminton.svg') }}" alt="Ikon Badminton" class="h-16 w-16">
                                </div>
                                <h3 class="text-xl font-semibold">Badminton</h3>
                            </a>
                            
                            <a href="{{ route('katalog', ['search' => 'voli']) }}" class="block p-6 bg-white rounded-lg shadow-md hover:shadow-xl transition-shadow">
                                <div class="flex justify-center mb-4 h-16 w-16 mx-auto">
                                    <img src="{{ asset('images/icon-voli.png') }}" alt="Ikon Voli" class="h-16 w-16">
                                </div>
                                <h3 class="text-xl font-semibold">Voli</h3>
                            </a>
                            <a href="{{ route('katalog') }}" class="block p-6 bg-white rounded-lg shadow-md hover:shadow-xl transition-shadow">
                                <div class="flex justify-center mb-4 h-16 w-16 mx-auto">
                                    <img src="{{ asset('images/icon-lainnya.svg') }}" alt="Ikon Olahraga Lainnya" class="h-16 w-16">
                                </div>
                                <h3 class="text-xl font-semibold">Lainnya</h3>
                            </a>
                            
                        </div>
                    </div>
                </section>

                <section class="py-16 bg-white">
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                        <h2 class="text-3xl font-bold mb-12">Mengapa Memakai Booking Lapangan?</h2>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                            
                            <div class="p-6">
                                <div class="flex justify-center mb-4">
                                    <img src="{{ asset('images/icon-mudah.svg') }}" alt="Mudah & Praktis Icon" class="h-20 w-20">
                                </div>
                                <h3 class="text-xl font-semibold mb-2">Mudah & Praktis</h3>
                                <p class="text-gray-600">
                                    Cari dan booking lapangan olahraga, cukup dari ponsel pintar Anda kapanpun, dimanapun.
                                </p>
                            </div>
                            
                            <div class="p-6">
                                <div class="flex justify-center mb-4">
                                    <img src="{{ asset('images/icon-pilihan-banyak.svg') }}" alt="Pilihan Olahraga Icon" class="h-20 w-20">
                                </div>
                                <h3 class="text-xl font-semibold mb-2">Banyak Pilihan Olahraga & Lapangan</h3>
                                <p class="text-gray-600">
                                    Kamu bisa temukan beragam jenis olahraga di Booking Lapangan dan memilih lokasi yang kamu suka.
                                </p>
                            </div>
                            
                            <div class="p-6">
                                <div class="flex justify-center mb-4">
                                    <img src="{{ asset('images/icon-cek-detail.svg') }}" alt="Cek Detail Icon" class="h-20 w-20">
                                </div>
                                <h3 class="text-xl font-semibold mb-2">Cek Detail Lapangan Tanpa Lokasi</h3>
                                <p class="text-gray-600">
                                    Bingung pilih lapangan yang mana? Kamu bisa cek detail tiap lapangan tanpa harus bolak balik ke lokasi.
                                </p>
                            </div>
                            
                        </div>
                    </div>
                </section>

                <section class="py-16 bg-gray-100">
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                        <h2 class="text-3xl font-bold mb-12">Mengapa mendaftarkan venue-mu ke Booking Lapangan?</h2>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                            
                            <div class="p-6">
                                <div class="flex justify-center mb-4">
                                    <img src="{{ asset('images/icon-bisnis.svg') }}" alt="Mudah & Praktis Icon" class="h-20 w-20">
                                </div>
                                <h3 class="text-xl font-semibold mb-2">Permudah Bisnis</h3>
                                <p class="text-gray-600">
                                    Pasang listing venue di Booking Lapangan, proses mudah dan instan.
                                </p>
                            </div>
                            
                            <div class="p-6">
                                <div class="flex justify-center mb-4">
                                    <img src="{{ asset('images/icon-listing-gratis.svg') }}" alt="Listing Gratis Icon" class="h-20 w-20">
                                </div>
                                <h3 class="text-xl font-semibold mb-2">Listing Gratis</h3>
                                <p class="text-gray-600">
                                    Di Booking Lapangan bisa listing venue gratis, tanpa biaya apa pun.
                                </p>
                            </div>
                            
                            <div class="p-6">
                                <div class="flex justify-center mb-4">
                                    <img src="{{ asset('images/icon-jangkauan-luas.svg') }}" alt="Jangkauan Luas Icon" class="h-20 w-20">
                                </div>
                                <h3 class="text-xl font-semibold mb-2">Jangkauan Lebih Banyak Customer</h3>
                                <p class="text-gray-600">
                                    Dapatkan lebih banyak customer secara online, dengan memasang listing venue di Booking Lapangan.
                                </p>
                            </div>
                            
                        </div>
                    </div>
                </section>

                <section class="py-16 bg-white">
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                        <h2 class="text-3xl font-bold mb-8">Punya Venue Olahraga?</h2>
                        <a href="#" class="inline-block px-8 py-4 bg-red-700 text-white text-lg font-semibold rounded-lg hover:bg-red-800 transition-colors duration-300">
                            Daftarkan Sekarang
                        </a>
                    </div>
                </section>

                <section class="py-16 bg-gray-50">
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                        <h2 class="text-3xl font-bold mb-10">Apa kata Kawan AYO?</h2>
                        <div class="max-w-3xl mx-auto">
                            <div class="p-8 md:p-12 bg-white rounded-lg shadow-xl relative">
                                <svg class="absolute top-0 left-0 h-16 w-16 text-red-100 transform -translate-x-6 -translate-y-6" fill="currentColor" viewBox="0 0 32 32" aria-hidden="true">
                                    <path d="M9.333 7C5.8 7 3 9.8 3 13.333c0 3.533 2.8 6.333 6.333 6.333 1.04 0 2.013-.253 2.853-.707l.867.867C12.333 20.547 11.5 21 10.6 21c-4.56 0-8.267-3.707-8.267-8.267C2.333 8.173 5.507 5 9.333 5c1.467 0 2.853.373 4.053 1.04l-.867.867C11.667 7.253 10.533 7 9.333 7zM22.667 7c-3.533 0-6.333 2.8-6.333 6.333 0 3.533 2.8 6.333 6.333 6.333 1.04 0 2.013-.253 2.853-.707l.867.867c-.72.72-1.587 1.067-2.48 1.067-4.56 0-8.267-3.707-8.267-8.267C14.333 8.173 17.507 5 21.333 5c1.467 0 2.853.373 4.053 1.04l-.867.867C23.667 7.253 22.533 7 21.333 7z" />
                                </svg>
                                <blockquote class="text-xl md:text-2xl text-gray-700 italic leading-relaxed">
                                    "Aplikasi ini memudahkan pencarian aktivitas olahraga, mengembangkan komunitas olahraga, dan memesan tempat olahraga. Ini adalah ekosistem olahraga yang menyeluruh."
                                </blockquote>
                                <div class="mt-8">
                                    <p class="font-semibold text-lg text-gray-900">Messi</p>
                                    <p class="text-gray-500">Pemain SepakBola Profesional</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <section class="py-16 bg-white">
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                        <h3 class="text-center text-xl font-semibold text-gray-600 mb-10">
                            TELAH DILIPUT OLEH:
                        </h3>
                        <div class="flex flex-wrap justify-center items-center gap-x-12 gap-y-6 opacity-70">
                            <span class="text-3xl font-bold text-gray-400">Kompas.id</span>
                            <span class="text-3xl font-bold text-gray-400">LIPUTAN 6</span>
                            <span class="text-3xl font-bold text-gray-400">BOLA.COM</span>
                            <span class="text-3xl font-bold text-gray-400">SUARA.COM</span>
                            <span class="text-3xl font-bold text-gray-400">KOMINFO</span>
                        </div>
                    </div>
                </section>
                
            </main>

            @include('layouts.footer')

        </div>
    </body>
</html>