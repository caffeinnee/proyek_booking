<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Verifikasi Mitra') }}
            </h2>
            <a href="{{ route('super.dashboard') }}" class="text-sm text-gray-600 hover:text-gray-900">
                &larr; Kembali ke Dashboard
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            
            {{-- Kartu Detail --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-200">
                
                <div class="p-6 bg-gray-50 border-b border-gray-200 flex justify-between items-start">
                    <div>
                        <h3 class="text-2xl font-bold text-gray-900">{{ $mitra->nama_venue }}</h3>
                        <p class="text-gray-500">Diajukan oleh: {{ $mitra->name }}</p>
                    </div>
                    <span class="px-3 py-1 text-sm font-bold rounded-full 
                        {{ $mitra->status_mitra === 'pending' ? 'bg-yellow-100 text-yellow-800' : '' }}
                        {{ $mitra->status_mitra === 'approved' ? 'bg-green-100 text-green-800' : '' }}
                        {{ $mitra->status_mitra === 'rejected' ? 'bg-red-100 text-red-800' : '' }}">
                        Status: {{ ucfirst($mitra->status_mitra ?? 'User Biasa') }}
                    </span>
                </div>

                <div class="p-6 space-y-6">
                    {{-- Grid Informasi --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase">Alamat Lengkap</label>
                            <p class="mt-1 text-gray-900 text-lg">{{ $mitra->alamat }}</p>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase">Kontak WhatsApp</label>
                            <div class="mt-1 flex items-center">
                                <span class="text-gray-900 text-lg mr-2">{{ $mitra->no_wa }}</span>
                                <a href="https://wa.me/{{ $mitra->no_wa }}" target="_blank" class="text-green-600 hover:text-green-700 text-sm font-semibold underline">
                                    Chat via WA
                                </a>
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase">Email Akun</label>
                            <p class="mt-1 text-gray-900">{{ $mitra->email }}</p>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase">Tanggal Bergabung</label>
                            <p class="mt-1 text-gray-900">{{ $mitra->created_at->format('d F Y') }}</p>
                        </div>

                    </div>

                    {{-- Tombol Aksi (Hanya muncul jika Pending) --}}
                    @if($mitra->status_mitra === 'pending')
                        <div class="border-t border-gray-100 pt-6 mt-6">
                            <h4 class="font-bold text-gray-900 mb-4">Keputusan Admin:</h4>
                            
                            <div class="flex gap-4">
                                {{-- Tombol Terima --}}
                                <form action="{{ route('super.mitra.approve', $mitra->id) }}" method="POST" class="flex-1">
                                    @csrf @method('PATCH')
                                    <button type="submit" class="w-full justify-center py-3 bg-green-600 text-white rounded-lg font-bold hover:bg-green-700 shadow-md transition flex items-center">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                        Terima Pengajuan
                                    </button>
                                </form>

                                {{-- Tombol Tolak --}}
                                <form action="{{ route('super.mitra.reject', $mitra->id) }}" method="POST" class="flex-1" onsubmit="return confirm('Yakin ingin menolak pengajuan ini?');">
                                    @csrf @method('PATCH')
                                    <button type="submit" class="w-full justify-center py-3 bg-white border-2 border-red-200 text-red-600 rounded-lg font-bold hover:bg-red-50 transition flex items-center">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                        Tolak Pengajuan
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endif

                </div>
            </div>

        </div>
    </div>
</x-app-layout>