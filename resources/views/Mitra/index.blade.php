<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Area Mitra') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-10">
            
            @if (session('success'))
                <div class="p-4 bg-green-100 text-green-700 rounded-lg shadow-sm border-l-4 border-green-500">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 border-b border-gray-200 flex justify-between items-center">
                    <h3 class="text-xl font-bold text-gray-900">Orderan Masuk</h3>
                    <span class="bg-red-100 text-red-800 text-xs font-semibold px-2.5 py-0.5 rounded">{{ $bookings->where('status', 'pending')->count() }} Pending</span>
                </div>
                
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Pemesan</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Lapangan</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Jadwal</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($bookings as $booking)
                                <tr>
                                    <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $booking->user->name }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-500">{{ $booking->lapangan->nama_lapangan }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-500">
                                        {{ \Carbon\Carbon::parse($booking->tanggal_booking)->format('d M') }} <br>
                                        <span class="text-xs">{{ \Carbon\Carbon::parse($booking->jam_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($booking->jam_selesai)->format('H:i') }}</span>
                                    </td>
                                    <td class="px-6 py-4 text-sm">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                            @if($booking->status == 'confirmed') bg-green-100 text-green-800 
                                            @elseif($booking->status == 'cancelled') bg-red-100 text-red-800 
                                            @else bg-yellow-100 text-yellow-800 @endif">
                                            {{ ucfirst($booking->status) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-sm font-medium">
                                        <a href="{{ route('admin.booking.show', $booking) }}" class="text-indigo-600 hover:text-indigo-900">Detail</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-4 text-center text-gray-500 text-sm">Belum ada orderan masuk.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div>
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-xl font-bold text-gray-900">Lapangan Saya</h3>
                    <a href="{{ route('mitra.lapangan.create') }}" class="px-5 py-2.5 bg-indigo-600 text-white rounded-lg font-bold text-sm hover:bg-indigo-700 transition shadow-md flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                        Tambah Lapangan
                    </a>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @forelse ($lapangans as $lapangan)
                        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                            <div class="h-40 bg-gray-100 relative">
                                @if($lapangan->gambar_url)
                                    <img src="{{ $lapangan->gambar_url }}" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-gray-400">No Image</div>
                                @endif
                            </div>
                            <div class="p-4">
                                <h4 class="font-bold text-lg text-gray-900 truncate">{{ $lapangan->nama_lapangan }}</h4>
                                <p class="text-red-600 font-bold text-sm mt-1">Rp {{ number_format($lapangan->harga_per_jam, 0, ',', '.') }} / jam</p>
                                <div class="mt-4 flex gap-2">
                                    <button class="flex-1 py-1.5 bg-yellow-50 text-yellow-700 text-xs font-bold rounded border border-yellow-200">Edit</button>
                                    <form action="{{ route('mitra.destroy', $lapangan->id) }}" method="POST" class="flex-1" onsubmit="return confirm('Hapus lapangan?');">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="w-full py-1.5 bg-red-50 text-red-700 text-xs font-bold rounded border border-red-200">Hapus</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-3 text-center py-10 bg-white rounded-lg text-gray-500 border-2 border-dashed">
                            Belum ada lapangan.
                        </div>
                    @endforelse
                </div>
            </div>

        </div>
    </div>
</x-app-layout>