<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Lapangan Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-100">
                
                <div class="p-6 bg-white border-b border-gray-200">
                    
                    {{-- Form Tambah Lapangan --}}
                    <form method="POST" action="{{ route('mitra.lapangan.store') }}" enctype="multipart/form-data" class="space-y-6">
                        @csrf

                        {{-- Nama Lapangan --}}
                        <div>
                            <x-input-label for="nama_lapangan" :value="__('Nama Lapangan / Venue')" />
                            <x-text-input id="nama_lapangan" class="block mt-1 w-full" type="text" name="nama_lapangan" :value="old('nama_lapangan')" required autofocus placeholder="Contoh: Lapangan Futsal A" />
                            <x-input-error :messages="$errors->get('nama_lapangan')" class="mt-2" />
                        </div>

                        {{-- Jenis Olahraga (ADA SEPAKBOLA) --}}
                        <div>
                            <x-input-label for="jenis" :value="__('Jenis Olahraga')" />
                            <select id="jenis" name="jenis" class="block mt-1 w-full border-gray-300 focus:border-red-500 focus:ring-red-500 rounded-md shadow-sm">
                                <option value="" disabled selected>-- Pilih Jenis Olahraga --</option>
                                <option value="Futsal" {{ old('jenis') == 'Futsal' ? 'selected' : '' }}>Futsal</option>
                                <option value="Badminton" {{ old('jenis') == 'Badminton' ? 'selected' : '' }}>Badminton</option>
                                <option value="Voli" {{ old('jenis') == 'Voli' ? 'selected' : '' }}>Voli</option>
                                <option value="Basket" {{ old('jenis') == 'Basket' ? 'selected' : '' }}>Basket</option>
                                <option value="Sepakbola" {{ old('jenis') == 'Sepakbola' ? 'selected' : '' }}>Sepakbola</option>
                                <option value="Tenis" {{ old('jenis') == 'Tenis' ? 'selected' : '' }}>Tenis</option>
                                <option value="Lainnya" {{ old('jenis') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                            </select>
                            <x-input-error :messages="$errors->get('jenis')" class="mt-2" />
                        </div>

                        {{-- Lokasi --}}
                        <div>
                            <x-input-label for="lokasi" :value="__('Lokasi Lengkap')" />
                            <textarea id="lokasi" name="lokasi" rows="2" class="block mt-1 w-full border-gray-300 focus:border-red-500 focus:ring-red-500 rounded-md shadow-sm" placeholder="Alamat lengkap lapangan..." required>{{ old('lokasi') }}</textarea>
                            <x-input-error :messages="$errors->get('lokasi')" class="mt-2" />
                        </div>

                        {{-- Harga Per Jam --}}
                        <div>
                            <x-input-label for="harga_per_jam" :value="__('Harga Sewa Per Jam (Rp)')" />
                            <div class="relative mt-1 rounded-md shadow-sm">
                                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                    <span class="text-gray-500 sm:text-sm">Rp</span>
                                </div>
                                <input type="number" name="harga_per_jam" id="harga_per_jam" class="block w-full rounded-md border-gray-300 pl-10 focus:border-red-500 focus:ring-red-500 sm:text-sm" placeholder="0" value="{{ old('harga_per_jam') }}" required>
                            </div>
                            <x-input-error :messages="$errors->get('harga_per_jam')" class="mt-2" />
                        </div>

                        {{-- Upload Gambar --}}
                        <div>
                            <x-input-label for="gambar" :value="__('Foto Lapangan (Opsional)')" />
                            <input id="gambar" name="gambar" type="file" class="block w-full text-sm text-gray-500 mt-1
                                file:mr-4 file:py-2 file:px-4
                                file:rounded-full file:border-0
                                file:text-sm file:font-semibold
                                file:bg-red-50 file:text-red-700
                                hover:file:bg-red-100
                            " accept="image/*" />
                            <p class="text-xs text-gray-500 mt-1">Format: JPG, PNG, JPEG. Maks: 2MB.</p>
                            <x-input-error :messages="$errors->get('gambar')" class="mt-2" />
                        </div>

                        {{-- Tombol Aksi --}}
                        <div class="flex items-center justify-end mt-8 border-t border-gray-100 pt-6">
                            <a href="{{ route('mitra.index') }}" class="text-sm text-gray-600 hover:text-gray-900 underline mr-4">
                                Batal
                            </a>
                            
                            {{-- Tombol Merah --}}
                            <x-primary-button class="bg-red-600 hover:bg-red-700 focus:ring-red-500">
                                {{ __('Simpan Lapangan') }}
                            </x-primary-button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>