<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Lapangan Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    <h3 class="text-lg font-bold mb-4">Detail Lapangan</h3>
                    
                    <form action="{{ route('mitra.lapangan.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-4">
                            <x-input-label for="nama_lapangan" :value="__('Nama Lapangan')" />
                            <x-text-input id="nama_lapangan" class="block mt-1 w-full" type="text" name="nama_lapangan" required placeholder="Contoh: Lapangan A (Sintetis)" />
                            <x-input-error :messages="$errors->get('nama_lapangan')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="jenis" :value="__('Jenis Olahraga')" />
                            <select name="jenis" id="jenis" class="block mt-1 w-full border-gray-300 focus:border-red-500 focus:ring-red-500 rounded-md shadow-sm">
                                <option value="Futsal">Futsal</option>
                                <option value="Badminton">Badminton</option>
                                <option value="Basket">Basket</option>
                                <option value="Voli">Voli</option>
                                <option value="Mini Soccer">Mini Soccer</option>
                                <option value="Tenis">Tenis</option>
                                <option value="Lainnya">Lainnya</option> </select>
                        </div>

                        <div class="mb-4">
                            <x-input-label for="lokasi" :value="__('Lokasi / Kota')" />
                            <x-text-input id="lokasi" class="block mt-1 w-full" type="text" name="lokasi" :value="Auth::user()->alamat" required />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="harga_per_jam" :value="__('Harga Sewa per Jam (Rp)')" />
                            <x-text-input id="harga_per_jam" class="block mt-1 w-full" type="number" name="harga_per_jam" required placeholder="100000" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="gambar" :value="__('Foto Lapangan')" />
                            <input type="file" name="gambar" id="gambar" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-red-50 file:text-red-700 hover:file:bg-red-100 mt-1" required accept="image/*">
                            <p class="text-xs text-gray-500 mt-1">Format: JPG, PNG, JPEG. Maks: 2MB.</p>
                            <x-input-error :messages="$errors->get('gambar')" class="mt-2" />
                        </div>
                        <div class="mt-6 flex justify-end gap-3">
                            <a href="{{ route('mitra.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded-lg font-semibold hover:bg-gray-600">Batal</a>
                            <button type="submit" class="px-6 py-2 bg-indigo-600 text-white rounded-lg font-semibold hover:bg-indigo-700">
                                Simpan Lapangan
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>