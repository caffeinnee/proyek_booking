<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 px-4">
            
            {{-- Welcome Card --}}
            <div class="bg-white overflow-hidden shadow-sm rounded-xl mb-6 border border-gray-100">
                <div class="p-6 text-gray-900">
                    <h3 class="text-xl font-bold">Halo, {{ Auth::user()->name }}! 👋</h3>
                    <p class="text-gray-500 text-sm mt-1">Selamat datang kembali. Pantau aktivitas olahraga Anda di sini.</p>
                </div>
            </div>

            {{-- LOGIKA STATUS MITRA --}}
            @if(Auth::user()->role !== 'mitra' && !Auth::user()->is_admin)
                
                @if(Auth::user()->status_mitra === 'pending')
                    {{-- TAMPILAN JIKA SEDANG MENUNGGU PERSETUJUAN --}}
                    <div class="bg-yellow-50 overflow-hidden shadow-sm rounded-xl mb-8 border-l-4 border-yellow-400">
                        <div class="p-6 flex flex-col md:flex-row justify-between items-center gap-6 text-center md:text-left">
                            <div class="flex items-center gap-4 flex-col md:flex-row">
                                <div class="bg-yellow-100 p-3 rounded-full shrink-0">
                                    <svg class="w-8 h-8 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                </div>
                                <div>
                                    <h3 class="font-bold text-lg text-yellow-800">Pengajuan Mitra Sedang Diproses</h3>
                                    <p class="text-yellow-700 text-sm mt-1">Tim kami sedang memverifikasi data venue Anda. Mohon tunggu persetujuan Admin.</p>
                                </div>
                            </div>
                            <span class="px-4 py-2 bg-yellow-200 text-yellow-800 rounded-lg text-sm font-bold border border-yellow-300 animate-pulse">
                                Status: Menunggu
                            </span>
                        </div>
                    </div>

                @else
                    {{-- TAMPILAN JIKA BELUM DAFTAR (Promo) --}}
                    <div class="bg-gradient-to-r from-red-50 to-white overflow-hidden shadow-sm rounded-xl mb-8 border border-red-100">
                        <div class="p-6 flex flex-col md:flex-row justify-between items-center gap-6 text-center md:text-left">
                            <div>
                                <h3 class="font-bold text-lg text-red-800 flex items-center justify-center md:justify-start gap-2">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                                    Punya Lapangan Nganggur?
                                </h3>
                                <p class="text-red-600 text-sm mt-1">Daftarkan venue olahraga Anda sekarang dan dapatkan penghasilan tambahan!</p>
                            </div>
                            <a href="{{ route('mitra.create') }}" class="px-6 py-3 bg-red-600 text-white rounded-lg text-sm font-bold hover:bg-red-700 transition shadow-lg shadow-red-200 whitespace-nowrap transform hover:-translate-y-0.5">
                                + Daftarkan Venue
                            </a>
                        </div>
                    </div>
                @endif

            @endif

            <div class="bg-white overflow-hidden shadow-sm rounded-xl border border-gray-100">
                <div class="p-6">

                    @if (session('success'))
                        <div class="mb-6 p-4 bg-green-50 text-green-700 rounded-lg border border-green-100 flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            {{ session('success') }}
                        </div>
                    @endif

                    <h2 class="text-xl font-bold mb-6 text-gray-800 flex items-center">
                        Riwayat Booking Saya
                    </h2>

                    <div class="space-y-4">
                        @forelse ($myBookings as $booking)
                            <div class="p-5 bg-white border border-gray-200 rounded-xl hover:shadow-md transition duration-200 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                                
                                {{-- Informasi Booking --}}
                                <div class="w-full md:w-auto">
                                    <div class="flex items-center justify-between md:justify-start gap-3 mb-1">
                                        <strong class="text-lg text-gray-900">
                                            {{ $booking->lapangan->nama_lapangan }}
                                        </strong>
                                        {{-- Badge Status Mobile (muncul di sebelah nama lapangan di HP) --}}
                                        <span class="md:hidden px-2.5 py-0.5 text-xs font-bold rounded-full 
                                            @if($booking->status == 'pending') bg-yellow-100 text-yellow-800
                                            @elseif($booking->status == 'confirmed') bg-green-100 text-green-800
                                            @else bg-gray-100 text-gray-600 @endif">
                                            {{ ucfirst($booking->status) }}
                                        </span>
                                    </div>
                                    
                                    <div class="text-sm text-gray-600 space-y-1">
                                        <div class="flex items-center gap-2">
                                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                            {{ \Carbon\Carbon::parse($booking->tanggal_booking)->format('d F Y') }}
                                        </div>
                                        <div class="flex items-center gap-2">
                                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                            {{ \Carbon\Carbon::parse($booking->jam_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($booking->jam_selesai)->format('H:i') }}
                                        </div>
                                    </div>
                                </div>
                                
                                {{-- Status & Tombol Aksi --}}
                                <div class="w-full md:w-auto flex flex-col md:flex-row items-start md:items-center gap-3">
                                    
                                    {{-- Badge Status Desktop --}}
                                    <span class="hidden md:inline-block px-3 py-1 text-xs font-bold rounded-full 
                                        @if($booking->status == 'pending') bg-yellow-100 text-yellow-800
                                        @elseif($booking->status == 'confirmed') bg-green-100 text-green-800
                                        @else bg-gray-100 text-gray-600 @endif">
                                        {{ ucfirst($booking->status) }}
                                    </span>

                                    @if($booking->status == 'pending')
                                        <div class="flex gap-2 w-full md:w-auto">
                                            @if($booking->bukti_bayar)
                                                <span class="flex-1 md:flex-none text-center text-xs text-red-600 font-semibold border border-red-200 px-3 py-2 rounded-lg bg-red-50">
                                                    Bukti Terkirim
                                                </span>
                                            @else
                                                {{-- Tombol Upload Merah --}}
                                                <a href="{{ route('booking.payment', $booking) }}" class="flex-1 md:flex-none text-center text-xs text-white bg-red-600 px-4 py-2 rounded-lg font-bold hover:bg-red-700 transition shadow-sm">
                                                    Bayar / Upload
                                                </a>
                                            @endif

                                            <form action="{{ route('booking.user.cancel', $booking) }}" method="POST" onsubmit="return confirm('Yakin ingin membatalkan booking ini?');">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="w-full md:w-auto text-xs text-gray-600 border border-gray-300 px-3 py-2 rounded-lg hover:bg-gray-50 transition font-medium">
                                                    Batal
                                                </button>
                                            </form>
                                        </div>
                                    @endif
                                </div>

                            </div>
                        @empty
                            <div class="py-12 text-center border-2 border-dashed border-gray-200 rounded-xl bg-gray-50">
                                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                                <p class="mt-2 text-gray-500 font-medium">Anda belum memiliki riwayat booking.</p>
                                <a href="{{ route('katalog') }}" class="mt-4 inline-block px-6 py-2 bg-red-600 text-white font-bold rounded-full hover:bg-red-700 transition">
                                    Cari Lapangan Sekarang
                                </a>
                            </div>
                        @endforelse
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>