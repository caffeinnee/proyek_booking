<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Cara Pesan - {{ config('app.name') }}</title>
        <link rel="icon" href="{{ asset('images/logo.png') }}" type="image/png">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-gray-50 text-gray-900">
        <div class="min-h-screen flex flex-col">
            
            @include('layouts.public-navigation')

            <main class="flex-grow py-16">
                <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
                    
                    {{-- Header --}}
                    <div class="text-center mb-16">
                        <h1 class="text-3xl md:text-4xl font-extrabold text-gray-900 mb-4">Panduan Pemesanan</h1>
                        <p class="text-lg text-gray-600 max-w-2xl mx-auto">Ikuti 4 langkah mudah ini untuk mulai bermain olahraga favoritmu tanpa ribet.</p>
                    </div>

                    <div class="relative">
                        {{-- Garis Konektor (Hanya Desktop) --}}
                        <div class="hidden md:block absolute left-8 top-0 bottom-0 w-0.5 bg-gray-200 ml-0.5 -z-10"></div>

                        {{-- Langkah 1 --}}
                        <div class="flex gap-8 mb-12 relative bg-white p-6 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition-shadow">
                            <div class="flex-shrink-0">
                                <div class="w-16 h-16 rounded-full bg-red-100 flex items-center justify-center text-red-600 font-bold text-2xl shadow-sm border-4 border-white">
                                    1
                                </div>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold text-gray-900 mb-2">Cari & Pilih Lapangan</h3>
                                <p class="text-gray-600 leading-relaxed mb-4">
                                    Buka halaman <a href="{{ route('katalog') }}" class="text-red-600 font-semibold hover:underline">Katalog</a>. Gunakan fitur pencarian untuk menemukan lapangan olahraga yang sesuai dengan lokasi dan jenis olahraga yang kamu inginkan (Futsal, Badminton, Basket, dll).
                                </p>
                                <a href="{{ route('katalog') }}" class="inline-flex items-center text-sm font-medium text-red-600 hover:text-red-800">
                                    Lihat Katalog &rarr;
                                </a>
                            </div>
                        </div>

                        {{-- Langkah 2 --}}
                        <div class="flex gap-8 mb-12 relative bg-white p-6 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition-shadow">
                            <div class="flex-shrink-0">
                                <div class="w-16 h-16 rounded-full bg-red-100 flex items-center justify-center text-red-600 font-bold text-2xl shadow-sm border-4 border-white">
                                    2
                                </div>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold text-gray-900 mb-2">Isi Detail Booking</h3>
                                <p class="text-gray-600 leading-relaxed">
                                    Klik tombol <strong>"Pesan"</strong> pada lapangan pilihanmu. Pilih tanggal main dan jam mulai serta selesai. Pastikan jadwal yang kamu pilih masih tersedia (belum dibooking orang lain).
                                </p>
                            </div>
                        </div>

                        {{-- Langkah 3 --}}
                        <div class="flex gap-8 mb-12 relative bg-white p-6 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition-shadow">
                            <div class="flex-shrink-0">
                                <div class="w-16 h-16 rounded-full bg-red-100 flex items-center justify-center text-red-600 font-bold text-2xl shadow-sm border-4 border-white">
                                    3
                                </div>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold text-gray-900 mb-2">Lakukan Pembayaran</h3>
                                <p class="text-gray-600 leading-relaxed mb-3">
                                    Setelah booking dibuat, status pesananmu adalah <span class="bg-yellow-100 text-yellow-800 px-2 py-0.5 rounded text-xs font-bold uppercase tracking-wide">Pending</span>. 
                                </p>
                                <ul class="list-disc list-inside text-gray-600 space-y-1 mb-3 ml-1">
                                    <li>Transfer biaya sewa ke nomor rekening yang tertera.</li>
                                    <li>Upload foto bukti transfer di menu Dashboard.</li>
                                </ul>
                                <p class="text-sm text-gray-500 italic">
                                    *Jika tidak ada rekening, hubungi nomor WhatsApp pemilik lapangan.
                                </p>
                            </div>
                        </div>

                        {{-- Langkah 4 --}}
                        <div class="flex gap-8 relative bg-white p-6 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition-shadow">
                            <div class="flex-shrink-0">
                                <div class="w-16 h-16 rounded-full bg-green-100 flex items-center justify-center text-green-600 font-bold text-2xl shadow-sm border-4 border-white">
                                    4
                                </div>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold text-gray-900 mb-2">Konfirmasi & Main!</h3>
                                <p class="text-gray-600 leading-relaxed">
                                    Tunggu Admin/Mitra memverifikasi pembayaranmu. Jika valid, status akan berubah menjadi <span class="bg-green-100 text-green-800 px-2 py-0.5 rounded text-xs font-bold uppercase tracking-wide">Confirmed</span>. Datang ke lokasi sesuai jadwal dan selamat bermain!
                                </p>
                            </div>
                        </div>

                    </div>

                    {{-- CTA Footer --}}
                    <div class="mt-16 text-center">
                        <p class="text-gray-500 mb-6 text-lg">Sudah paham caranya?</p>
                        <a href="{{ route('katalog') }}" class="inline-block px-10 py-4 bg-red-600 text-white rounded-full font-bold text-lg hover:bg-red-700 transition shadow-lg hover:shadow-red-200 transform hover:-translate-y-1">
                            Cari Lapangan Sekarang
                        </a>
                    </div>

                </div>
            </main>

            @include('layouts.footer')
            
        </div>
    </body>
</html>