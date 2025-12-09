<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Kelola Rekening Bank') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 px-4">
            
            @if (session('success'))
                <div class="mb-6 p-4 bg-green-50 text-green-700 rounded-lg flex items-center shadow-sm border border-green-100">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    {{ session('success') }}
                </div>
            @endif

            {{-- Form Tambah --}}
            <div class="bg-white p-6 rounded-xl shadow-sm mb-8 border border-gray-100">
                <h3 class="text-lg font-bold mb-4 text-gray-900">Tambah Rekening Baru</h3>
                <form action="{{ route('mitra.rekening.store') }}" method="POST" class="flex flex-col md:flex-row gap-4">
                    @csrf
                    <div class="flex-1">
                        <label class="text-xs font-bold text-gray-500 uppercase">Nama Bank</label>
                        <input type="text" name="nama_bank" placeholder="Contoh: BCA" class="w-full mt-1 rounded-lg border-gray-300 focus:border-red-500 focus:ring-red-500" required>
                    </div>
                    <div class="flex-1">
                        <label class="text-xs font-bold text-gray-500 uppercase">Nomor Rekening</label>
                        <input type="number" name="nomor_rekening" placeholder="1234567890" class="w-full mt-1 rounded-lg border-gray-300 focus:border-red-500 focus:ring-red-500" required>
                    </div>
                    <div class="flex-1">
                        <label class="text-xs font-bold text-gray-500 uppercase">Atas Nama</label>
                        <input type="text" name="atas_nama" placeholder="Nama Pemilik" class="w-full mt-1 rounded-lg border-gray-300 focus:border-red-500 focus:ring-red-500" required>
                    </div>
                    <div class="flex items-end">
                        <button type="submit" class="w-full md:w-auto bg-red-600 text-white px-6 py-2.5 rounded-lg font-bold hover:bg-red-700 transition shadow-md">
                            + Tambah
                        </button>
                    </div>
                </form>
            </div>

            <h3 class="text-lg font-bold mb-4 text-gray-800">Daftar Rekening Saya</h3>

            {{-- Daftar Rekening --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @forelse($rekenings as $rek)
                    <div class="bg-white p-6 rounded-xl shadow-sm border-l-4 border-red-500 flex justify-between items-center relative overflow-hidden group hover:shadow-md transition">
                        <div>
                            <h4 class="font-bold text-xl text-gray-900">{{ $rek->nama_bank }}</h4>
                            <p class="text-2xl font-mono text-gray-600 my-1 tracking-wider">{{ $rek->nomor_rekening }}</p>
                            <p class="text-xs text-gray-500 uppercase font-semibold">a.n {{ $rek->atas_nama }}</p>
                        </div>
                        <form action="{{ route('mitra.rekening.destroy', $rek->id) }}" method="POST" onsubmit="return confirm('Hapus rekening ini?');">
                            @csrf @method('DELETE')
                            <button class="text-gray-400 hover:text-red-600 font-bold p-2 rounded-full hover:bg-red-50 transition" title="Hapus">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                            </button>
                        </form>
                    </div>
                @empty
                    <div class="col-span-full text-center py-12 text-gray-500 bg-white rounded-xl border border-gray-200">
                        <svg class="mx-auto h-12 w-12 text-gray-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
                        <p class="font-medium">Belum ada rekening terdaftar.</p>
                        <p class="text-sm">Tambahkan rekening agar user bisa melakukan pembayaran.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>