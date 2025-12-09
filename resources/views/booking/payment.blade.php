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

                    {{-- Instruksi Transfer (Dinamis Sesuai Mitra) --}}
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
                                    {{-- Tombol Salin --}}
                                    <button type="button" onclick="navigator.clipboard.writeText('{{ $rek->nomor_rekening }}'); alert('Nomor rekening {{ $rek->nama_bank }} berhasil disalin!');" 
                                            class="text-xs bg-gray-100 hover:bg-gray-200 text-gray-600 px-3 py-2 rounded-lg transition font-medium border border-gray-200">
                                        Salin
                                    </button>
                                </div>
                            @empty
                                <div class="text-red-600 font-bold text-sm bg-red-50 p-3 rounded border border-red-200">
                                    Mitra belum memasukkan nomor rekening. Silakan hubungi via WhatsApp untuk info pembayaran.
                                </div>
                            @endforelse
                        </div>
                        
                        <p class="text-sm text-yellow-700 mt-4 pl-0 md:pl-9">
                            Setelah transfer, silakan upload bukti fotonya di bawah ini agar pesanan Anda segera diproses.
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