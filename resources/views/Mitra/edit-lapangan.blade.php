<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Lapangan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    <h3 class="text-lg font-bold mb-4">Edit Data: {{ $lapangan->nama_lapangan }}</h3>
                    
                    <form action="{{ route('mitra.lapangan.update', $lapangan->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT') <div class="mb-4">
                            <x-input-label for="nama_lapangan" :value="__('Nama Lapangan')" />
                            <x-text-input id="nama_lapangan" class="block mt-1 w-full" type="text" name="nama_lapangan" :value="old('nama_lapangan', $lapangan->nama_lapangan)" required />
                            <x-input-error :messages="$errors->get('nama_lapangan')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="jenis" :value="__('Jenis Olahraga')" />
                            <select name="jenis" id="jenis" class="block mt-1 w-full border-gray-300 focus:border-red-500 focus:ring-red-500 rounded-md shadow-sm">
                                <option value="Futsal" {{ $lapangan->jenis == 'Futsal' ? 'selected' : '' }}>Futsal</option>
                                <option value="Badminton" {{ $lapangan->jenis == 'Badminton' ? 'selected' : '' }}>Badminton</option>
                                <option value="Basket" {{ $lapangan->jenis == 'Basket' ? 'selected' : '' }}>Basket</option>
                                <option value="Voli" {{ $lapangan->jenis == 'Voli' ? 'selected' : '' }}>Voli</option>
                                <option value="Mini Soccer" {{ $lapangan->jenis == 'Mini Soccer' ? 'selected' : '' }}>Mini Soccer</option>
                                <option value="Tenis" {{ $lapangan->jenis == 'Tenis' ? 'selected' : '' }}>Tenis</option>
                                <option value="Lainnya" {{ $lapangan->jenis == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                            </select>
                        </div>

                        <div class="mb-4">
                            <x-input-label for="lokasi" :value="__('Lokasi / Kota')" />
                            <x-text-input id="lokasi" class="block mt-1 w-full" type="text" name="lokasi" :value="old('lokasi', $lapangan->lokasi)" required />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="harga_per_jam" :value="__('Harga Sewa per Jam (Rp)')" />
                            <x-text-input id="harga_per_jam" class="block mt-1 w-full" type="number" name="harga_per_jam" :value="old('harga_per_jam', $lapangan->harga_per_jam)" required />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="gambar" :value="__('Ganti Foto (Kosongkan jika tidak ingin mengubah)')" />
                            
                            @if($lapangan->gambar_url)
                                <div class="mb-2">
                                    <img src="{{ $lapangan->gambar_url }}" class="h-32 w-auto rounded object-cover border">
                                    <p class="text-xs text-gray-500">Foto saat ini</p>
                                </div>
                            @endif

                            <input type="file" name="gambar" id="gambar" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-red-50 file:text-red-700 hover:file:bg-red-100 mt-1" accept="image/*">
                        </div>

                        <div class="mt-6 flex justify-end gap-3">
                            <a href="{{ route('mitra.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded-lg font-semibold hover:bg-gray-600">Batal</a>
                            <button type="submit" class="px-6 py-2 bg-indigo-600 text-white rounded-lg font-semibold hover:bg-indigo-700">
                                Simpan Perubahan
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>