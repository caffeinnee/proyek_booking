<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Tentang Kami - Booking Lapangan</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-gray-100">
        <div class="min-h-screen flex flex-col">
            
            @include('layouts.public-navigation')

            <main class="flex-grow">
                
                <div class="bg-white py-16 border-b border-gray-200">
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                        <h1 class="text-4xl font-extrabold text-gray-900 mb-4">
                            Tentang <span class="text-red-700">Booking Lapangan</span>
                        </h1>
                        <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                            Kami percaya bahwa olahraga harus mudah diakses oleh siapa saja. Misi kami adalah menghubungkan pemilik lapangan dengan pecinta olahraga melalui teknologi yang simpel dan efisien.
                        </p>
                    </div>
                </div>

                <div class="py-16 bg-gray-50">
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
                            <div>
                                <img src="https://images.unsplash.com/photo-1526628953301-3e589a6a8b74?w=800&q=80" alt="Team working" class="rounded-lg shadow-lg">
                            </div>
                            <div>
                                <h2 class="text-3xl font-bold text-gray-900 mb-6">Solusi Digital untuk Olahraga</h2>
                                <div class="space-y-4 text-gray-600 text-lg">
                                    <p>
                                        Booking Lapangan lahir dari kesulitan yang sering kami alami sendiri: susah cari jadwal kosong, harus telepon sana-sini, dan sistem pembayaran yang ribet.
                                    </p>
                                    <p>
                                        Dengan aplikasi ini, kami ingin menciptakan ekosistem di mana:
                                    </p>
                                    <ul class="list-disc pl-5 space-y-2 mt-2">
                                        <li><strong>Pemain</strong> bisa booking dalam hitungan detik.</li>
                                        <li><strong>Pemilik Lapangan (Mitra)</strong> bisa mengelola bisnis dengan mudah.</li>
                                        <li><strong>Komunitas</strong> olahraga bisa tumbuh lebih besar.</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="py-16 bg-white">
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                        <h2 class="text-3xl font-bold text-gray-900 mb-12">Tim Pengembang</h2>
                        
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                            
                            <div class="bg-gray-50 rounded-lg p-6 hover:shadow-lg transition duration-300">
                                <img class="w-32 h-32 rounded-full mx-auto mb-4 object-cover border-4 border-red-100" 
                                     src="https://ui-avatars.com/api/?name=Faiz&background=ef4444&color=fff" alt="Foto Anggota">
                                <h3 class="text-xl font-bold text-gray-900">Faiz</h3>
                                <p class="text-red-600 font-medium">Project Manager</p>
                                <p class="text-gray-500 text-sm mt-2">Fullstack Developer</p>
                            </div>

                            <div class="bg-gray-50 rounded-lg p-6 hover:shadow-lg transition duration-300">
                                <img class="w-32 h-32 rounded-full mx-auto mb-4 object-cover border-4 border-red-100" 
                                     src="https://ui-avatars.com/api/?name=Anggota+2&background=ef4444&color=fff" alt="Foto Anggota">
                                <h3 class="text-xl font-bold text-gray-900">Nama Teman 1</h3>
                                <p class="text-red-600 font-medium">UI/UX Designer</p>
                                <p class="text-gray-500 text-sm mt-2">Frontend Developer</p>
                            </div>

                            <div class="bg-gray-50 rounded-lg p-6 hover:shadow-lg transition duration-300">
                                <img class="w-32 h-32 rounded-full mx-auto mb-4 object-cover border-4 border-red-100" 
                                     src="https://ui-avatars.com/api/?name=Anggota+3&background=ef4444&color=fff" alt="Foto Anggota">
                                <h3 class="text-xl font-bold text-gray-900">Nama Teman 2</h3>
                                <p class="text-red-600 font-medium">Backend Developer</p>
                                <p class="text-gray-500 text-sm mt-2">Database Administrator</p>
                            </div>

                            <div class="bg-gray-50 rounded-lg p-6 hover:shadow-lg transition duration-300">
                                <img class="w-32 h-32 rounded-full mx-auto mb-4 object-cover border-4 border-red-100" 
                                     src="https://ui-avatars.com/api/?name=Anggota+4&background=ef4444&color=fff" alt="Foto Anggota">
                                <h3 class="text-xl font-bold text-gray-900">Nama Teman 3</h3>
                                <p class="text-red-600 font-medium">System Analyst</p>
                                <p class="text-gray-500 text-sm mt-2">Quality Assurance</p>
                            </div>

                        </div>
                    </div>
                </div>

            </main>

            @include('layouts.footer')
            
        </div>
    </body>
</html>