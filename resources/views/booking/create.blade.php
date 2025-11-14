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
                    
                    @if (session('error'))
                        <div class="mb-4 p-4 bg-red-100 text-red-700 rounded-lg text-sm">
                            {{ session('error') }}
                        </div>
                    @endif

                    <p class="mb-2 text-lg">Jenis: {{ $lapangan->jenis }}</p>
                    <p class="mb-4 text-lg">Harga: Rp {{ number_format($lapangan->harga_per_jam, 0, ',', '.') }} / jam</p>

                    <form action="{{ route('booking.store') }}" method="POST">
                        @csrf

                        <input type="hidden" name="lapangan_id" value="{{ $lapangan->id }}">
                        <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                        
                        <div class="mt-4">
                            <label for="tanggal_booking" class="block font-medium text-sm text-gray-700">Pilih Tanggal</label>
                            <input type="date" name="tanggal_booking" id="tanggal_booking" 
                                class="block mt-1 w-full md:w-1/2 rounded-md shadow-sm border-gray-300 focus:border-red-500 focus:ring-red-500"
                                required>
                            <x-input-error :messages="$errors->get('tanggal_booking')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <label for="jam_mulai" class="block font-medium text-sm text-gray-700">Jam Mulai</label>
                            <select name="jam_mulai" id="jam_mulai" 
                                    class="block mt-1 w-full md:w-1/2 rounded-md shadow-sm border-gray-300 focus:border-red-500 focus:ring-red-500"
                                    required>
                                <option value="">Pilih jam</option>
                                @for ($i = 8; $i <= 22; $i++)
                                    <option value="{{ sprintf('%02d:00:00', $i) }}">{{ sprintf('%02d:00', $i) }}</option>
                                @endfor
                            </select>
                            <x-input-error :messages="$errors->get('jam_mulai')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <label for="jam_selesai" class="block font-medium text-sm text-gray-700">Jam Selesai</label>
                            <select name="jam_selesai" id="jam_selesai" 
                                    class="block mt-1 w-full md:w-1/2 rounded-md shadow-sm border-gray-300 focus:border-red-500 focus:ring-red-500"
                                    required>
                                <option value="">Pilih jam</option>
                                @for ($i = 9; $i <= 23; $i++)
                                    <option value="{{ sprintf('%02d:00:00', $i) }}">{{ sprintf('%02d:00', $i) }}</option>
                                @endfor
                            </select>
                            <p class="mt-1 text-sm text-gray-500">Misal: Jika main 1 jam, pilih Jam Mulai 09:00 dan Jam Selesai 10:00.</p>
                            <x-input-error :messages="$errors->get('jam_selesai')" class="mt-2" />
                        </div>
                        <div class="mt-6">
                            <button type="submit" class="px-6 py-2 bg-red-700 text-white rounded-lg hover:bg-red-800">
                                Booking Sekarang
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>