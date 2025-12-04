<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Booking {{ $lapangan->nama_lapangan }} - {{ config('app.name') }}</title>
    
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-50 text-gray-900">
    
    <div class="min-h-screen flex flex-col">
        
        {{-- 1. Gunakan Navigasi Publik (Menu Atas) --}}
        @include('layouts.public-navigation')

        {{-- 2. Konten Utama --}}
        <main class="flex-grow py-12">
            <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 px-4">
                
                {{-- Breadcrumb (Navigasi Kecil) --}}
                <nav class="flex mb-8 text-sm text-gray-500" aria-label="Breadcrumb">
                    <ol class="inline-flex items-center space-x-1 md:space-x-3">
                        <li class="inline-flex items-center">
                            <a href="{{ route('katalog') }}" class="inline-flex items-center hover:text-red-600 transition">
                                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20"><path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path></svg>
                                Katalog
                            </a>
                        </li>
                        <li>
                            <div class="flex items-center">
                                <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                                <span class="ml-1 font-medium text-gray-700">Booking Lapangan</span>
                            </div>
                        </li>
                    </ol>
                </nav>

                {{-- Alert Error --}}
                @if (session('error'))
                    <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 text-red-700 rounded-r shadow-sm animate-pulse">
                        <div class="flex items-center">
                            <svg class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <p class="font-semibold">{{ session('error') }}</p>
                        </div>
                    </div>
                @endif

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    
                    {{-- KOLOM KIRI: Detail Lapangan (Sticky) --}}
                    <div class="md:col-span-1">
                        <div class="bg-white overflow-hidden shadow-xl rounded-2xl sticky top-24 border border-gray-100">
                            {{-- Gambar --}}
                            <div class="h-56 bg-gray-200 w-full relative group">
                                @if($lapangan->gambar_url)
                                    <img src="{{ $lapangan->gambar_url }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                                @else
                                    <div class="flex items-center justify-center h-full text-gray-400 bg-gray-100">
                                        <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    </div>
                                @endif
                                <div class="absolute top-4 left-4">
                                    <span class="bg-black/70 backdrop-blur text-white px-3 py-1 rounded-lg text-xs font-bold uppercase tracking-wider">
                                        {{ $lapangan->jenis }}
                                    </span>
                                </div>
                            </div>

                            <div class="p-6">
                                <h3 class="text-2xl font-bold text-gray-900 mb-2 leading-tight">{{ $lapangan->nama_lapangan }}</h3>
                                
                                <div class="flex items-start text-gray-600 text-sm mb-6">
                                    <svg class="w-5 h-5 mr-2 text-red-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                    <span class="leading-snug">{{ $lapangan->lokasi ?? 'Lokasi belum diset oleh mitra.' }}</span>
                                </div>

                                <div class="border-t border-gray-100 pt-4 mt-2">
                                    <p class="text-gray-500 text-xs font-semibold uppercase tracking-wide">Harga Sewa</p>
                                    <div class="flex items-baseline mt-1">
                                        <p class="text-3xl font-extrabold text-red-600">
                                            Rp {{ number_format($lapangan->harga_per_jam, 0, ',', '.') }}
                                        </p>
                                        <span class="text-gray-500 ml-2">/ jam</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- KOLOM KANAN: Form Booking --}}
                    <div class="md:col-span-2">
                        <div class="bg-white overflow-hidden shadow-xl rounded-2xl border border-gray-100">
                            <div class="p-8">
                                <div class="flex items-center justify-between mb-8 pb-4 border-b border-gray-100">
                                    <div>
                                        <h3 class="text-xl font-bold text-gray-900">Detail Reservasi</h3>
                                        <p class="text-sm text-gray-500 mt-1">Isi jadwal bermain Anda dengan benar.</p>
                                    </div>
                                    <div class="hidden sm:block">
                                        <span class="inline-flex items-center justify-center h-10 w-10 rounded-full bg-red-100 text-red-600">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                        </span>
                                    </div>
                                </div>

                                <form action="{{ route('booking.store') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="lapangan_id" value="{{ $lapangan->id }}">
                                    <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">

                                    <div class="space-y-6">
                                        {{-- Tanggal --}}
                                        <div>
                                            <label for="tanggal_booking" class="block font-bold text-sm text-gray-900 mb-2">Pilih Tanggal Main</label>
                                            <input type="date" name="tanggal_booking" id="tanggal_booking" 
                                                class="w-full rounded-xl border-gray-300 focus:border-red-500 focus:ring-red-500 shadow-sm py-3 px-4 text-gray-700 font-medium bg-gray-50 hover:bg-white transition"
                                                min="{{ date('Y-m-d') }}"
                                                required>
                                            <x-input-error :messages="$errors->get('tanggal_booking')" class="mt-2" />
                                        </div>

                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                            {{-- Jam Mulai --}}
                                            <div>
                                                <label for="jam_mulai" class="block font-bold text-sm text-gray-900 mb-2">Jam Mulai</label>
                                                <div class="relative">
                                                    <select name="jam_mulai" id="jam_mulai" 
                                                            class="block w-full rounded-xl border-gray-300 focus:border-red-500 focus:ring-red-500 shadow-sm py-3 pl-4 pr-10 appearance-none bg-gray-50 hover:bg-white transition cursor-pointer"
                                                            required>
                                                        <option value="">-- Pilih Jam --</option>
                                                        @for ($i = 8; $i <= 22; $i++)
                                                            <option value="{{ sprintf('%02d:00:00', $i) }}">{{ sprintf('%02d:00', $i) }}</option>
                                                        @endfor
                                                    </select>
                                                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-gray-500">
                                                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                                    </div>
                                                </div>
                                                <x-input-error :messages="$errors->get('jam_mulai')" class="mt-2" />
                                            </div>

                                            {{-- Jam Selesai --}}
                                            <div>
                                                <label for="jam_selesai" class="block font-bold text-sm text-gray-900 mb-2">Jam Selesai</label>
                                                <div class="relative">
                                                    <select name="jam_selesai" id="jam_selesai" 
                                                            class="block w-full rounded-xl border-gray-300 focus:border-red-500 focus:ring-red-500 shadow-sm py-3 pl-4 pr-10 appearance-none bg-gray-50 hover:bg-white transition cursor-pointer"
                                                            required>
                                                        <option value="">-- Pilih Jam --</option>
                                                        @for ($i = 9; $i <= 23; $i++)
                                                            <option value="{{ sprintf('%02d:00:00', $i) }}">{{ sprintf('%02d:00', $i) }}</option>
                                                        @endfor
                                                    </select>
                                                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-gray-500">
                                                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                                    </div>
                                                </div>
                                                <x-input-error :messages="$errors->get('jam_selesai')" class="mt-2" />
                                            </div>
                                        </div>

                                        {{-- Info Box --}}
                                        <div class="bg-blue-50 border border-blue-100 rounded-xl p-4 flex items-start">
                                            <svg class="w-5 h-5 text-blue-500 mt-0.5 mr-3 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                            <div class="text-sm text-blue-800">
                                                <p class="font-semibold mb-1">Catatan Penting:</p>
                                                <ul class="list-disc list-inside space-y-1 text-blue-700/80">
                                                    <li>Pastikan jam selesai lebih besar dari jam mulai.</li>
                                                    <li>Pembayaran dilakukan setelah booking berhasil dibuat.</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mt-10 pt-6 border-t border-gray-100 flex flex-col-reverse sm:flex-row sm:justify-end sm:items-center gap-4">
                                        <a href="{{ route('katalog') }}" class="w-full sm:w-auto px-6 py-3 text-center rounded-xl text-gray-600 font-medium hover:bg-gray-100 transition">
                                            Batal
                                        </a>
                                        <button type="submit" class="w-full sm:w-auto px-8 py-3 bg-red-600 text-white rounded-xl font-bold shadow-lg shadow-red-200 hover:bg-red-700 hover:shadow-red-300 transform transition hover:-translate-y-0.5">
                                            Lanjutkan Booking
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </main>

        {{-- 3. Footer (Opsional, agar rapi) --}}
        @include('layouts.footer')

    </div>
</body>
</html>