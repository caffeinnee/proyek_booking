<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Kelola Rekening Bank') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            
            {{-- Form Tambah --}}
            <div class="bg-white p-6 rounded-lg shadow-sm mb-6 border border-gray-100">
                <h3 class="text-lg font-bold mb-4">Tambah Rekening Baru</h3>
                <form action="{{ route('mitra.rekening.store') }}" method="POST" class="flex flex-col md:flex-row gap-4">
                    @csrf
                    <input type="text" name="nama_bank" placeholder="Nama Bank (Cth: BCA)" class="rounded-lg border-gray-300 w-full" required>
                    <input type="number" name="nomor_rekening" placeholder="No. Rekening" class="rounded-lg border-gray-300 w-full" required>
                    <input type="text" name="atas_nama" placeholder="Atas Nama" class="rounded-lg border-gray-300 w-full" required>
                    <button type="submit" class="bg-indigo-600 text-white px-6 py-2 rounded-lg font-bold hover:bg-indigo-700">Tambah</button>
                </form>
            </div>

            {{-- Daftar Rekening --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @foreach($rekenings as $rek)
                    <div class="bg-white p-6 rounded-xl shadow-sm border-l-4 border-indigo-500 flex justify-between items-center">
                        <div>
                            <h4 class="font-bold text-xl text-gray-800">{{ $rek->nama_bank }}</h4>
                            <p class="text-2xl font-mono text-gray-600 my-1">{{ $rek->nomor_rekening }}</p>
                            <p class="text-sm text-gray-500 uppercase">{{ $rek->atas_nama }}</p>
                        </div>
                        <form action="{{ route('mitra.rekening.destroy', $rek->id) }}" method="POST" onsubmit="return confirm('Hapus rekening ini?');">
                            @csrf @method('DELETE')
                            <button class="text-red-500 hover:text-red-700 font-bold bg-red-50 p-2 rounded-lg">Hapus</button>
                        </form>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>