<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Konfirmasi Pembayaran') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-2xl border border-gray-100">
                
                <div class="p-8">
                    {{-- Header Ringkasan --}}
                    <div class="text-center mb-8">
                        <span class="bg-red-50 text-red-700 text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wide border border-red-100">
                            Booking #{{ $booking->id }}
                        </span>
                        <h3 class="text-2xl font-bold text-gray-900 mt-4">{{ $booking->lapangan->nama_lapangan }}</h3>
                        
                        <div class="mt-2 flex justify-center items-baseline text-gray-600">
                            <span>Total Tagihan:</span>
                        </div>
                        <p class="text-4xl font-extrabold text-red-600 mt-1">
                            Rp {{ number_format($booking->lapangan->harga_per_jam, 0, ',', '.') }}
                        </p>
                    </div>

                    {{-- Instruksi Transfer & Kontak Mitra --}}
                    <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 mb-8 rounded-r-lg">
                        <div class="flex items-start mb-4">
                            <svg class="h-6 w-6 text-yellow-400 mr-3 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <div class="text-sm text-yellow-700">
                                <p class="font-bold mb-1">Instruksi Pembayaran:</p>
                                <p>Silakan transfer ke salah satu rekening milik <strong>{{ $booking->lapangan->user->nama_venue }}</strong> berikut ini:</p>
                            </div>
                        </div>

                        {{-- DAFTAR REKENING MITRA --}}
                        <div class="space-y-3 pl-0 md:pl-9">
                            @forelse($booking->lapangan->user->rekenings as $rek)
                                <div class="bg-white p-3 rounded border border-yellow-200 flex justify-between items-center shadow-sm">
                                    <div>
                                        <div class="font-bold text-gray-800">{{ $rek->nama_bank }}</div>
                                        <div class="text-gray-600 font-mono text-lg tracking-wide">{{ $rek->nomor_rekening }}</div>
                                        <div class="text-xs text-gray-500 uppercase">a.n {{ $rek->atas_nama }}</div>
                                    </div>
                                    <button type="button" onclick="navigator.clipboard.writeText('{{ $rek->nomor_rekening }}'); alert('Nomor rekening {{ $rek->nama_bank }} berhasil disalin!');" 
                                            class="text-xs bg-gray-100 hover:bg-gray-200 text-gray-600 px-3 py-2 rounded-lg transition font-medium border border-gray-200">
                                        Salin
                                    </button>
                                </div>
                            @empty
                                <div class="text-red-600 font-bold text-sm bg-white p-3 rounded border border-red-200">
                                    Mitra belum memasukkan nomor rekening. Silakan hubungi via WhatsApp.
                                </div>
                            @endforelse
                        </div>

                        {{-- KONTAK WA MITRA (BARU) --}}
                        <div class="mt-6 pt-4 border-t border-yellow-200 pl-0 md:pl-9">
                            <p class="text-xs font-bold text-yellow-800 mb-2 uppercase tracking-wide">Konfirmasi Pembayaran</p>
                            
                            @php
                                // Format Nomor WA: Ubah 08xx jadi 628xx
                                $noWa = $booking->lapangan->user->no_wa;
                                if(substr($noWa, 0, 1) == '0') {
                                    $noWa = '62' . substr($noWa, 1);
                                }
                                // Pesan Otomatis
                                $pesan = "Halo " . $booking->lapangan->user->nama_venue . ", saya sudah melakukan pembayaran untuk Booking ID #" . $booking->id . ". Mohon dicek ya.";
                            @endphp

                            <a href="https://wa.me/{{ $noWa }}?text={{ urlencode($pesan) }}" target="_blank" 
                               class="flex items-center justify-center w-full bg-green-500 text-white px-4 py-2.5 rounded-lg font-bold hover:bg-green-600 transition shadow-sm hover:shadow-md">
                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.506-.669-.516-.173-.009-.371-.009-.57-.009-.198 0-.52.074-.792.372-.272.297-1.04 1.017-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>
                                Konfirmasi ke WhatsApp Mitra
                            </a>
                        </div>
                        
                        <p class="text-sm text-yellow-700 mt-4 pl-0 md:pl-9">
                            Setelah transfer, jangan lupa upload bukti fotonya di bawah ini agar sistem mencatat pembayaran Anda.
                        </p>
                    </div>

                    {{-- Form Upload --}}
                    <form action="{{ route('booking.payment.update', $booking) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')

                        <div class="mb-8">
                            <label for="bukti_bayar" class="block font-bold text-sm text-gray-900 mb-2">Upload Bukti Transfer</label>
                            
                            {{-- Input File Custom Style Merah --}}
                            <input type="file" name="bukti_bayar" id="bukti_bayar" 
                                class="block w-full text-sm text-gray-500 
                                file:mr-4 file:py-2.5 file:px-4 
                                file:rounded-full file:border-0 
                                file:text-sm file:font-semibold 
                                file:bg-red-50 file:text-red-700 
                                hover:file:bg-red-100 cursor-pointer transition" 
                                required accept="image/*">
                            
                            <p class="mt-2 text-xs text-gray-400">Format yang diterima: JPG, PNG, JPEG. Maksimal 2MB.</p>
                            <x-input-error :messages="$errors->get('bukti_bayar')" class="mt-2" />
                        </div>

                        <div class="flex justify-end items-center pt-6 border-t border-gray-100 gap-4">
                            <a href="{{ route('dashboard') }}" class="text-gray-500 font-medium hover:text-gray-800 transition">Batal</a>
                            
                            <button type="submit" class="px-8 py-3 bg-red-600 text-white rounded-xl font-bold hover:bg-red-700 shadow-lg shadow-red-200 transition transform hover:-translate-y-0.5">
                                Kirim Bukti
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>