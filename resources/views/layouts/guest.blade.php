<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Booking Lapangan') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
        
        <div class="min-h-screen flex bg-white">
            
            <div class="hidden lg:block lg:w-1/2 relative bg-gray-900">
                {{-- Gambar Background --}}
                <img src="{{ asset('images/hero-lapangan.jpg') }}" 
                    alt="Background Sport" 
                    class="absolute inset-0 w-full h-full object-cover opacity-60">
                
                {{-- Text di atas gambar --}}
                <div class="absolute bottom-0 left-0 p-12 text-white z-10">
                    <h2 class="text-4xl font-bold mb-4">Sewa Lapangan Mudah & Cepat</h2>
                    <p class="text-lg text-gray-200">
                        Atur jadwal olahraga Anda tanpa ribet. Cek ketersediaan, booking, dan mainkan pertandingan terbaik Anda.
                    </p>
                </div>
            </div>

            <div class="flex-1 flex flex-col justify-center py-12 px-4 sm:px-6 lg:flex-none lg:px-20 xl:px-24 w-full lg:w-1/2">
                <div class="mx-auto w-full max-w-sm lg:w-96">
                    
                    {{-- Logo Brand --}}
                    <div class="mb-8 text-center lg:text-left">
                        <a href="/" class="inline-block">
                            <x-application-logo class="h-12 w-auto" />
                        </a>
                    </div>

                    {{-- Slot Form Login/Register akan muncul di sini --}}
                    {{ $slot }}

                </div>
            </div>
        </div>
    </body>
</html>