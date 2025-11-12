<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Formulir Booking
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    <h3 class="text-2xl font-semibold mb-4">
                        Anda akan memesan: <strong>{{ $lapangan->nama_lapangan }}</strong>
                    </h3>
                    
                    <p class="mb-2 text-lg">Jenis: {{ $lapangan->jenis }}</p>
                    <p class="mb-4 text-lg">Harga: Rp {{ number_format($lapangan->harga_per_jam, 0, ',', '.') }} / jam</p>

                    <form action="{{ route('booking.store') }}" method="POST">
                        @csrf

                        <input type="hidden" name="lapangan_id" value="{{ $lapangan->id }}">
                        <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                        <div class="mt-4">
                            <label for="tanggal_booking" class="block font-medium text-sm text-gray-700">Pilih Tanggal</label>
                            <input type="date" name="tanggal_booking" id="tanggal_booking" class="block mt-1 w-full md:w-1/2 rounded-md shadow-sm border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                        </div>
                        
                        <div class="mt-6">
                            <button type="submit" class="px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">
                                Cek Ketersediaan
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>