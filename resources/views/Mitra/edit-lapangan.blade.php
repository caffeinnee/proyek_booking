<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Lapangan') }}: {{ $lapangan->nama_lapangan }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg border border-gray-100">
                <div class="p-6 text-gray-900">
                    
                    <h3 class="text-xl font-bold mb-6">Perbarui Detail Lapangan</h3>
                    
                    @if (session('success'))
                        <div class="mb-4 p-4 bg-green-50 text-green-700 rounded-lg border border-green-100 flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            {{ session('success') }}
                        </div>
                    @endif

                    {{-- Form menggunakan method PUT untuk update --}}
                    <form action="{{ route('mitra.lapangan.update', $lapangan->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT') {{-- Wajib menggunakan method PUT untuk fungsi update --}}

                        {{-- NAMA LAPANGAN --}}
                        <div class="mb-4">
                            <x-input-label for="nama_lapangan" :value="__('Nama Lapangan')" />
                            <x-text-input id="nama_lapangan" class="block mt-1 w-full rounded-lg" type="text" name="nama_lapangan" :value="old('nama_lapangan', $lapangan->nama_lapangan)" required placeholder="Contoh: Lapangan A (Sintetis)" />
                            <x-input-error :messages="$errors->get('nama_lapangan')" class="mt-2" />
                        </div>

                        {{-- JENIS OLAHRAGA --}}
                        <div class="mb-4">
                            <x-input-label for="jenis" :value="__('Jenis Olahraga')" />
                            <select name="jenis" id="jenis" class="block mt-1 w-full rounded-lg border-gray-300 focus:border-red-500 focus:ring-red-500 shadow-sm cursor-pointer">
                                @php
                                    $jenisOptions = ['Futsal', 'Badminton', 'Basket', 'Voli', 'Mini Soccer', 'Tenis', 'Lainnya'];
                                @endphp
                                @foreach($jenisOptions as $option)
                                    <option value="{{ $option }}" {{ old('jenis', $lapangan->jenis) == $option ? 'selected' : '' }}>{{ $option }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('jenis')" class="mt-2" />
                        </div>

                        {{-- LOKASI --}}
                        <div class="mb-4">
                            <x-input-label for="lokasi" :value="__('Lokasi / Kota')" />
                            <x-text-input id="lokasi" class="block mt-1 w-full rounded-lg" type="text" name="lokasi" :value="old('lokasi', $lapangan->lokasi)" required />
                            <x-input-error :messages="$errors->get('lokasi')" class="mt-2" />
                        </div>

                        {{-- HARGA PER JAM --}}
                        <div class="mb-6">
                            <x-input-label for="harga_per_jam" :value="__('Harga Sewa per Jam (Rp)')" />
                            <x-text-input id="harga_per_jam" class="block mt-1 w-full rounded-lg" type="number" name="harga_per_jam" :value="old('harga_per_jam', $lapangan->harga_per_jam)" required placeholder="100000" />
                            <x-input-error :messages="$errors->get('harga_per_jam')" class="mt-2" />
                        </div>

                        {{-- GAMBAR SAAT INI & INPUT GAMBAR BARU --}}
                        <div class="mb-8 p-4 border border-gray-200 rounded-lg bg-gray-50">
                            <x-input-label :value="__('Foto Lapangan Saat Ini')" class="mb-3 text-base font-bold" />
                            @if($lapangan->gambar_url)
                                <img src="{{ $lapangan->gambar_url }}" alt="Foto Lapangan" class="w-full h-48 object-cover rounded-lg mb-4 border border-gray-300 shadow-sm">
                            @else
                                <p class="text-gray-500 mb-4">Belum ada foto yang diunggah.</p>
                            @endif

                            <x-input-label for="gambar" :value="__('Ganti Foto Lapangan')" />
                            <input type="file" name="gambar" id="gambar" class="block w-full text-sm text-gray-500 
                                file:mr-4 file:py-2.5 file:px-4 
                                file:rounded-full file:border-0 
                                file:text-sm file:font-semibold 
                                file:bg-red-50 file:text-red-700 
                                hover:file:bg-red-100 mt-2 transition cursor-pointer" 
                                accept="image/*">
                            <p class="text-xs text-gray-500 mt-1">Biarkan kosong jika tidak ingin mengganti foto. Maks: 2MB.</p>
                            <x-input-error :messages="$errors->get('gambar')" class="mt-2" />
                        </div>

                        <div class="mt-6 flex justify-end gap-3 border-t border-gray-100 pt-6">
                            <a href="{{ route('mitra.index') }}" class="px-6 py-3 bg-gray-500 text-white rounded-lg font-bold hover:bg-gray-600 transition">Batal</a>
                            <button type="submit" class="px-8 py-3 bg-red-600 text-white rounded-lg font-bold hover:bg-red-700 transition shadow-lg shadow-red-200 transform hover:-translate-y-0.5">
                                Simpan Perubahan
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>