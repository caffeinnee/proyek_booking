<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Upload Bukti Pembayaran') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <div class="text-center mb-6">
                    <h3 class="text-lg font-bold text-gray-900">Booking #{{ $booking->id }}</h3>
                    <p class="text-gray-500">{{ $booking->lapangan->nama_lapangan }}</p>
                    <p class="text-2xl font-bold text-red-600 mt-2">Rp {{ number_format($booking->lapangan->harga_per_jam, 0, ',', '.') }}</p>
                </div>

                <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 mb-6">
                    <p class="text-sm text-yellow-700">
                        Silakan transfer ke <strong>BCA 1234567890 (a.n Booking Lapangan)</strong>, lalu upload bukti transfer di bawah ini.
                    </p>
                </div>

                <form action="{{ route('booking.payment.update', $booking) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')

                    <div class="mb-4">
                        <x-input-label for="bukti_bayar" :value="__('File Bukti Transfer')" />
                        <input type="file" name="bukti_bayar" id="bukti_bayar" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 mt-2" required accept="image/*">
                        <x-input-error :messages="$errors->get('bukti_bayar')" class="mt-2" />
                    </div>

                    <div class="flex justify-end">
                        <button type="submit" class="px-6 py-2 bg-indigo-600 text-white rounded-lg font-bold hover:bg-indigo-700 transition">
                            Kirim Bukti
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>