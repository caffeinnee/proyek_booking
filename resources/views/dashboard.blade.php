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
                    {{ __("You're logged in!") }}
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-gray-50 border-t border-gray-200">

                    @if (session('success'))
                        <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-lg">
                            {{ session('success') }}
                        </div>
                    @endif

                    <h2 class="text-xl font-semibold mb-4">Daftar Lapangan Tersedia</h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        @foreach ($lapangans as $lapangan)
                            <div class="p-4 bg-white shadow rounded-lg border border-gray-100">
                                <strong class="text-lg text-indigo-600">{{ $lapangan->nama_lapangan }}</strong>
                                <p class="text-sm mt-1">Jenis: {{ $lapangan->jenis }}</p>
                                <p class="text-md font-bold mt-2">
                                    Harga: Rp {{ number_format($lapangan->harga_per_jam, 0, ',', '.') }} / jam
                                </p>
                                <a href="{{ route('booking.create', ['lapangan' => $lapangan->id]) }}" class="inline-block mt-3 px-4 py-2 bg-indigo-600 text-white rounded-lg text-sm font-medium hover:bg-indigo-700">
                                    Pesan Sekarang
                                </a>
                            </div>
                        @endforeach
                    </div>

                    <div class="mt-8">
                        <h2 class="text-xl font-semibold mb-4">Riwayat Booking Saya</h2>

                        @forelse ($myBookings as $booking)
                            <div class="p-4 bg-white shadow rounded-lg border border-gray-100 mb-3">
                                <strong class="text-lg text-blue-600">
                                    {{ $booking->lapangan->nama_lapangan }}
                                </strong>
                                <p>Tanggal: {{ \Carbon\Carbon::parse($booking->tanggal_booking)->format('d F Y') }}</p>
                                <p>Status: <span class="font-medium text-yellow-600">Pending</span></p>
                            </div>
                        @empty
                            <div class="p-4 bg-white shadow rounded-lg border border-gray-100">
                                <p>Anda belum memiliki riwayat booking.</p>
                            </div>
                        @endforelse
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>