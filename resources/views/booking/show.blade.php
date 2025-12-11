<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail Booking') }} #{{ $booking->id }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8 px-4">
            
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-100">
                
                {{-- Header Status --}}
                <div class="p-6 border-b border-gray-100 bg-gray-50 flex justify-between items-center">
                    <span class="text-sm text-gray-500">Dibuat pada: {{ $booking->created_at->format('d M Y, H:i') }}</span>
                    <span class="px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wide
                        @if($booking->status == 'pending') bg-yellow-100 text-yellow-800
                        @elseif($booking->status == 'confirmed') bg-green-100 text-green-800
                        @else bg-gray-100 text-gray-600 @endif">
                        {{ $booking->status }}
                    </span>
                </div>

                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        
                        {{-- Kolom Kiri: Detail Lapangan --}}
                        <div>
                            <h3 class="text-lg font-bold text-gray-900 mb-4">Informasi Sewa</h3>
                            
                            <div class="space-y-3">
                                <div>
                                    <label class="text-xs text-gray-500 uppercase font-bold">Lapangan</label>
                                    <p class="text-gray-900 font-medium">{{ $booking->lapangan->nama_lapangan }}</p>
                                    <p class="text-xs text-gray-500">{{ $booking->lapangan->jenis }}</p>
                                </div>

                                <div>
                                    <label class="text-xs text-gray-500 uppercase font-bold">Jadwal Main</label>
                                    <p class="text-gray-900">
                                        {{ \Carbon\Carbon::parse($booking->tanggal_booking)->format('l, d F Y') }}
                                    </p>
                                    <p class="text-red-600 font-bold">
                                        {{ \Carbon\Carbon::parse($booking->jam_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($booking->jam_selesai)->format('H:i') }}
                                    </p>
                                </div>

                                <div>
                                    <label class="text-xs text-gray-500 uppercase font-bold">Total Harga</label>
                                    {{-- Hitung durasi manual karena kita belum simpan total_harga --}}
                                    @php
                                        $start = \Carbon\Carbon::parse($booking->jam_mulai);
                                        $end = \Carbon\Carbon::parse($booking->jam_selesai);
                                        $durasi = $end->diffInHours($start);
                                        if($durasi < 1) $durasi = 1;
                                        $total = $durasi * $booking->lapangan->harga_per_jam;
                                    @endphp
                                    <p class="text-xl font-bold text-gray-900">Rp {{ number_format($total, 0, ',', '.') }}</p>
                                </div>
                            </div>
                        </div>

                        {{-- Kolom Kanan: Bukti & Kontak --}}
                        <div class="bg-gray-50 p-5 rounded-xl border border-gray-200">
                            <h3 class="text-sm font-bold text-gray-900 mb-3 uppercase">Bukti Pembayaran</h3>
                            
                            @if($booking->bukti_bayar)
                                <div class="mb-4">
                                    {{-- Tampilkan Gambar Bukti (Klik untuk perbesar) --}}
                                    <a href="{{ asset('storage/' . $booking->bukti_bayar) }}" target="_blank">
                                        <img src="{{ asset('storage/' . $booking->bukti_bayar) }}" 
                                             alt="Bukti Transfer" 
                                             class="w-full h-40 object-cover rounded-lg border border-gray-300 hover:opacity-90 transition">
                                    </a>
                                    <p class="text-xs text-center text-gray-500 mt-1">(Klik gambar untuk memperbesar)</p>
                                </div>
                            @else
                                <div class="mb-4 text-center py-8 bg-white rounded-lg border border-dashed border-gray-300">
                                    <p class="text-sm text-gray-400">Belum ada bukti pembayaran.</p>
                                    @if($booking->status == 'pending')
                                        <a href="{{ route('booking.payment', $booking) }}" class="inline-block mt-2 text-xs font-bold text-red-600 hover:underline">Upload Sekarang</a>
                                    @endif
                                </div>
                            @endif

                            {{-- TOMBOL WA --}}
                            @php
                                $noWa = $booking->lapangan->user->no_wa;
                                if(substr($noWa, 0, 1) == '0') $noWa = '62' . substr($noWa, 1);
                                $pesan = "Halo Admin " . $booking->lapangan->user->nama_venue . ", saya ingin menanyakan status Booking ID #" . $booking->id;
                            @endphp
                            
                            <a href="https://wa.me/{{ $noWa }}?text={{ urlencode($pesan) }}" target="_blank" 
                               class="flex items-center justify-center w-full bg-green-500 text-white py-2 rounded-lg text-sm font-bold hover:bg-green-600 transition shadow-sm mb-3">
                                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.506-.669-.516-.173-.009-.371-.009-.57-.009-.198 0-.52.074-.792.372-.272.297-1.04 1.017-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>
                                Hubungi Mitra via WhatsApp
                            </a>

                        </div>

                    </div>
                </div>

                <div class="px-6 pb-6 pt-0">
                     <a href="{{ route('dashboard') }}" class="text-sm text-gray-500 hover:text-gray-900 font-medium">
                        &larr; Kembali ke Dashboard
                     </a>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>