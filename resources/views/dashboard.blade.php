<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-bold">Halo, {{ Auth::user()->name }}! 👋</h3>
                    <p class="text-gray-500 text-sm mt-1">Selamat datang kembali di Booking Lapangan. Mau main olahraga apa hari ini?</p>
                </div>
            </div>

            @if(Auth::user()->role !== 'mitra' && !Auth::user()->is_admin)
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                    <div class="p-6 bg-red-50 border-l-4 border-red-700 flex flex-col sm:flex-row justify-between items-center gap-4">
                        <div>
                            <h3 class="font-bold text-lg text-red-800">Punya Lapangan Nganggur?</h3>
                            <p class="text-red-600 text-sm">Daftarkan venue olahraga Anda sekarang dan dapatkan penghasilan tambahan!</p>
                        </div>
                        <a href="{{ route('mitra.create') }}" class="px-6 py-3 bg-red-700 text-white rounded-lg text-sm font-bold hover:bg-red-800 transition shadow-md whitespace-nowrap">
                            + Daftarkan Venue
                        </a>
                    </div>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-gray-50 border-t border-gray-200">

                    @if (session('success'))
                        <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-lg">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="mt-2">
                        <h2 class="text-xl font-semibold mb-4">Riwayat Booking Saya</h2>

                        @forelse ($myBookings as $booking)
                            <div class="p-4 bg-white shadow rounded-lg border border-gray-100 mb-3 flex flex-col md:flex-row justify-between items-start md:items-center">
                                <div>
                                    <strong class="text-lg text-indigo-600">
                                        {{ $booking->lapangan->nama_lapangan }}
                                    </strong>
                                    <p class="text-sm text-gray-600">Tanggal: {{ \Carbon\Carbon::parse($booking->tanggal_booking)->format('d F Y') }}</p>
                                    <p class="text-sm text-gray-500">
                                        Jam: {{ \Carbon\Carbon::parse($booking->jam_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($booking->jam_selesai)->format('H:i') }}
                                    </p>
                                </div>
                                <div class="mt-2 md:mt-0">
                                    <span class="px-3 py-1 text-xs font-bold rounded-full 
                                        @if($booking->status == 'confirmed') bg-green-100 text-green-800 
                                        @elseif($booking->status == 'cancelled') bg-red-100 text-red-800 
                                        @else bg-yellow-100 text-yellow-800 @endif">
                                        {{ ucfirst($booking->status) }}
                                    </span>
                                </div>
                            </div>
                        @empty
                            <div class="p-8 text-center border-2 border-dashed border-gray-300 rounded-lg">
                                <p class="text-gray-500">Anda belum memiliki riwayat booking.</p>
                                <a href="{{ route('katalog') }}" class="text-red-700 font-bold hover:underline mt-2 inline-block">Cari Lapangan Sekarang</a>
                            </div>
                        @endforelse
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>