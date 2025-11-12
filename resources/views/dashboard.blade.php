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