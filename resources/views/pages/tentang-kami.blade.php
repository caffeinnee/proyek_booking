<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Tentang Kami - {{ config('app.name') }}</title>
        <link rel="icon" href="{{ asset('images/logo.png') }}" type="image/png">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-gray-50 text-gray-900">
        <div class="min-h-screen flex flex-col">
            
            @include('layouts.public-navigation')

            <main class="flex-grow">
                
                {{-- Hero Header --}}
                <div class="bg-white py-20 border-b border-gray-100">
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                        <h1 class="text-4xl md:text-5xl font-extrabold text-gray-900 mb-6 tracking-tight">
                            Mengenal <span class="text-red-600">Booking Lapangan</span>
                        </h1>
                        <p class="text-xl text-gray-500 max-w-3xl mx-auto leading-relaxed">
                            Platform digital yang memudahkan pecinta olahraga menemukan lapangan terbaik dan membantu pemilik venue mengelola bisnis mereka secara efisien.
                        </p>
                    </div>
                </div>

                {{-- Visi & Misi --}}
                <div class="py-20 bg-gray-50">
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-16 items-center">
                            <div class="relative">
                                <div class="absolute inset-0 bg-red-600 transform translate-x-3 translate-y-3 rounded-2xl"></div>
                                <img src="https://images.unsplash.com/photo-1526628953301-3e589a6a8b74?w=800&q=80" alt="Team working" class="relative rounded-2xl shadow-xl z-10 w-full h-auto object-cover">
                            </div>
                            
                            <div>
                                <h2 class="text-3xl font-bold text-gray-900 mb-6">Solusi Digital untuk Komunitas Olahraga</h2>
                                <div class="space-y-6 text-gray-600 text-lg leading-relaxed">
                                    <p>
                                        Kami memahami betapa sulitnya mencari jadwal lapangan yang kosong, menelepon satu per satu venue, dan proses pembayaran yang rumit.
                                    </p>
                                    <p>
                                        Oleh karena itu, kami hadir dengan visi menciptakan ekosistem olahraga yang inklusif, di mana:
                                    </p>
                                    <ul class="space-y-4 mt-4">
                                        <li class="flex items-start">
                                            <svg class="h-6 w-6 text-red-500 mr-3 mt-1 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                            <span><strong>Pemain</strong> dapat memesan lapangan dalam hitungan detik.</span>
                                        </li>
                                        <li class="flex items-start">
                                            <svg class="h-6 w-6 text-red-500 mr-3 mt-1 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                            <span><strong>Mitra Venue</strong> dapat mengelola jadwal dan pendapatan dengan mudah.</span>
                                        </li>
                                        <li class="flex items-start">
                                            <svg class="h-6 w-6 text-red-500 mr-3 mt-1 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                            <span><strong>Komunitas</strong> olahraga dapat tumbuh dan berkembang lebih pesat.</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- TIM PENGEMBANG --}}
                <div class="py-20 bg-white">
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                        <h2 class="text-3xl font-bold text-gray-900 mb-4">Tim di Balik Layar</h2>
                        <p class="text-gray-500 max-w-2xl mx-auto mb-16">
                            Kami adalah kelompok mahasiswa yang berdedikasi untuk memberikan solusi teknologi terbaik bagi dunia olahraga.
                        </p>
                        
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-10">
                            
                            {{-- Anggota 1 --}}
                            <div class="group bg-white rounded-2xl p-8 shadow-sm hover:shadow-xl transition-all duration-300 border border-gray-100 transform hover:-translate-y-2">
                                <div class="relative w-32 h-32 mx-auto mb-6">
                                    <div class="absolute inset-0 bg-red-100 rounded-full transform rotate-6 transition-transform group-hover:rotate-12"></div>
                                    <img class="relative w-32 h-32 rounded-full object-cover border-4 border-white shadow-md" 
                                         src="https://ui-avatars.com/api/?name=Muhammad+Faiz+Mahmuda&background=ef4444&color=fff&size=128" alt="Muhammad Faiz Mahmuda">
                                </div>
                                <h3 class="text-lg font-bold text-gray-900 mb-1">Muhammad Faiz Mahmuda</h3>
                                <p class="text-red-600 font-medium text-sm uppercase tracking-wide">Project Manager</p>
                                <p class="text-gray-400 text-xs mt-2">Fullstack Developer</p>
                            </div>

                            {{-- Anggota 2 --}}
                            <div class="group bg-white rounded-2xl p-8 shadow-sm hover:shadow-xl transition-all duration-300 border border-gray-100 transform hover:-translate-y-2">
                                <div class="relative w-32 h-32 mx-auto mb-6">
                                    <div class="absolute inset-0 bg-blue-100 rounded-full transform -rotate-3 transition-transform group-hover:-rotate-6"></div>
                                    <img class="relative w-32 h-32 rounded-full object-cover border-4 border-white shadow-md" 
                                         src="https://ui-avatars.com/api/?name=Davi+Ade+Atma+Gunawan&background=3b82f6&color=fff&size=128" alt="Davi Ade Atma Gunawan">
                                </div>
                                <h3 class="text-lg font-bold text-gray-900 mb-1">Davi Ade Atma Gunawan</h3>
                                <p class="text-blue-600 font-medium text-sm uppercase tracking-wide">Backend Lead</p>
                                <p class="text-gray-400 text-xs mt-2">Database Architect</p>
                            </div>

                            {{-- Anggota 3 --}}
                            <div class="group bg-white rounded-2xl p-8 shadow-sm hover:shadow-xl transition-all duration-300 border border-gray-100 transform hover:-translate-y-2">
                                <div class="relative w-32 h-32 mx-auto mb-6">
                                    <div class="absolute inset-0 bg-yellow-100 rounded-full transform rotate-3 transition-transform group-hover:rotate-6"></div>
                                    <img class="relative w-32 h-32 rounded-full object-cover border-4 border-white shadow-md" 
                                         src="https://ui-avatars.com/api/?name=Ayu+Safira&background=eab308&color=fff&size=128" alt="Ayu Safira">
                                </div>
                                <h3 class="text-lg font-bold text-gray-900 mb-1">Ayu Safira</h3>
                                <p class="text-yellow-600 font-medium text-sm uppercase tracking-wide">Frontend Developer</p>
                                <p class="text-gray-400 text-xs mt-2">UI/UX Designer</p>
                            </div>

                            {{-- Anggota 4 --}}
                            <div class="group bg-white rounded-2xl p-8 shadow-sm hover:shadow-xl transition-all duration-300 border border-gray-100 transform hover:-translate-y-2">
                                <div class="relative w-32 h-32 mx-auto mb-6">
                                    <div class="absolute inset-0 bg-green-100 rounded-full transform -rotate-6 transition-transform group-hover:-rotate-12"></div>
                                    <img class="relative w-32 h-32 rounded-full object-cover border-4 border-white shadow-md" 
                                         src="https://ui-avatars.com/api/?name=Siti+Adilah&background=22c55e&color=fff&size=128" alt="Siti Adilah">
                                </div>
                                <h3 class="text-lg font-bold text-gray-900 mb-1">Siti Adilah</h3>
                                <p class="text-green-600 font-medium text-sm uppercase tracking-wide">System Analyst</p>
                                <p class="text-gray-400 text-xs mt-2">Quality Assurance</p>
                            </div>

                        </div>
                    </div>
                </div>

            </main>

            @include('layouts.footer')
            
        </div>
    </body>
</html>