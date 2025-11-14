<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Detail Order: #{{ $booking->id }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    <a href="{{ route('admin.dashboard') }}" class="text-sm text-gray-600 hover:text-red-700">&larr; Kembali ke Rekap</a>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mt-6">
                        
                        <div>
                            <h3 class="text-lg font-semibold border-b pb-2">Detail Order</h3>
                            <div class="mt-4 space-y-3 text-sm">
                                <div class="flex justify-between">
                                    <span class="text-gray-500">Pemesan:</span>
                                    <span class="font-medium">{{ $booking->user->name }} ({{ $booking->user->email }})</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-500">Lapangan:</span>
                                    <span class="font-medium">{{ $booking->lapangan->nama_lapangan }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-500">Tanggal Sewa:</span>
                                    <span class="font-medium">{{ \Carbon\Carbon::parse($booking->tanggal_booking)->format('l, d F Y') }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-500">Jadwal Sewa:</span>
                                    <span class="font-medium">
                                        {{ \Carbon\Carbon::parse($booking->jam_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($booking->jam_selesai)->format('H:i') }}
                                    </span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-500">Tanggal Order:</span>
                                    <span class="font-medium">{{ $booking->created_at->format('l, d M Y | H:i:s') }}</span>
                                </div>
                            </div>
                        </div>

                        <div>
                            <h3 class="text-lg font-semibold border-b pb-2">Pembayaran & Status</h3>

                            @if (session('success'))
                                <div class="mt-4 p-3 bg-green-100 text-green-700 rounded-lg text-sm">
                                    {{ session('success') }}
                                </div>
                            @endif

                            <div class="mt-4 space-y-3 text-sm">
                                <div class="flex justify-between">
                                    <span class="text-gray-500">Total Tagihan:</span>
                                    <span class="font-bold text-xl text-red-700">Rp {{ number_format($booking->lapangan->harga_per_jam, 0, ',', '.') }}</span>
                                </div>

                                <div class="flex justify-between items-center">
                                    <span class="text-gray-500">Status:</span>
                                    <span class="px-3 py-1 text-xs leading-5 font-semibold rounded-full
                                        @if ($booking->status == 'pending')
                                            bg-yellow-100 text-yellow-800
                                        @elseif ($booking->status == 'confirmed')
                                            bg-green-100 text-green-800
                                        @else
                                            bg-red-100 text-red-800
                                        @endif
                                    ">
                                        @if ($booking->status == 'confirmed')
                                            Lunas
                                        @elseif ($booking->status == 'cancelled')
                                            Batal
                                        @else
                                            Pending
                                        @endif
                                    </span>
                                </div>
                                @if ($booking->status == 'pending')
                                    <div class="pt-4 flex items-center space-x-3">
                                        
                                        <form action="{{ route('admin.booking.confirm', $booking) }}" method="POST" class="w-full">
                                            @csrf
                                            <button type="submit" class="w-full px-4 py-2 bg-green-600 text-white rounded-lg font-semibold text-sm hover:bg-green-700">
                                                Konfirmasi (Lunas)
                                            </button>
                                        </form>
                                        
                                        <form action="{{ route('admin.booking.cancel', $booking) }}" method="POST" class="w-full">
                                            @csrf
                                            <button type="submit" class="w-full px-4 py-2 bg-red-600 text-white rounded-lg font-semibold text-sm hover:bg-red-700">
                                                Batalkan
                                            </button>
                                        </form>
                                        
                                    </div>
                                @endif
                                </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>