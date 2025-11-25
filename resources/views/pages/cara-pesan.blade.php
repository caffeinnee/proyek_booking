<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Cara Pesan - Booking Lapangan</title>
        
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-gray-100">
        <div class="min-h-screen flex flex-col">
            
            @include('layouts.public-navigation')

            <main class="flex-grow py-12">
                <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-8 border border-gray-200">
                        
                        <h1 class="text-3xl font-extrabold text-gray-900 mb-8 text-center">
                            Panduan Pemesanan
                        </h1>
                        
                        <div class="space-y-10">
                            <div class="flex gap-6 items-start">
                                <div class="flex-shrink-0 w-12 h-12 rounded-full bg-red-100 flex items-center justify-center text-red-700 font-bold text-2xl shadow-sm">
                                    1
                                </div>
                                <div>
                                    <h3 class="text-xl font-bold text-gray-900 mb-2">Cari & Pilih Lapangan</h3>
                                    <p class="text-gray-600 leading-relaxed">
                                        Buka halaman <a href="{{ route('katalog') }}" class="text-red-600 hover:underline">Katalog</a>. Gunakan fitur pencarian untuk menemukan lapangan olahraga yang sesuai dengan lokasi dan jenis olahraga yang Anda inginkan.
                                    </p>
                                </div>
                            </div>

                            <div class="flex gap-6 items-start">
                                <div class="flex-shrink-0 w-12 h-12 rounded-full bg-red-100 flex items-center justify-center text-red-700 font-bold text-2xl shadow-sm">
                                    2
                                </div>
                                <div>
                                    <h3 class="text-xl font-bold text-gray-900 mb-2">Isi Detail Booking</h3>
                                    <p class="text-gray-600 leading-relaxed">
                                        Klik tombol <strong>"Pesan Sekarang"</strong> pada lapangan pilihanmu. Pilih tanggal dan jam main yang tersedia, lalu klik tombol Booking.
                                    </p>
                                </div>
                            </div>

                            <div class="flex gap-6 items-start">
                                <div class="flex-shrink-0 w-12 h-12 rounded-full bg-red-100 flex items-center justify-center text-red-700 font-bold text-2xl shadow-sm">
                                    3
                                </div>
                                <div>
                                    <h3 class="text-xl font-bold text-gray-900 mb-2">Lakukan Pembayaran</h3>
                                    <p class="text-gray-600 leading-relaxed">
                                        Pesananmu akan berstatus <span class="bg-yellow-100 text-yellow-800 px-2 py-0.5 rounded text-sm font-bold">Pending</span>. Silakan transfer biaya sewa ke rekening pemilik lapangan atau hubungi nomor WhatsApp yang tertera di detail lapangan.
                                    </p>
                                </div>
                            </div>

                            <div class="flex gap-6 items-start">
                                <div class="flex-shrink-0 w-12 h-12 rounded-full bg-green-100 flex items-center justify-center text-green-700 font-bold text-2xl shadow-sm">
                                    4
                                </div>
                                <div>
                                    <h3 class="text-xl font-bold text-gray-900 mb-2">Konfirmasi & Main!</h3>
                                    <p class="text-gray-600 leading-relaxed">
                                        Setelah pembayaran dikonfirmasi oleh Mitra, status akan berubah menjadi <span class="bg-green-100 text-green-800 px-2 py-0.5 rounded text-sm font-bold">Lunas</span>. Datang ke lokasi, tunjukkan bukti booking di Dashboard kamu, dan selamat bermain!
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="mt-12 text-center border-t pt-8">
                            <p class="text-gray-500 mb-4">Sudah siap berolahraga?</p>
                            <a href="{{ route('katalog') }}" class="inline-block px-8 py-3 bg-red-700 text-white rounded-lg font-bold text-lg hover:bg-red-800 transition shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                                Cari Lapangan Sekarang
                            </a>
                        </div>

                    </div>
                </div>
            </main>

            @include('layouts.footer')
            
        </div>
    </body>
</html>