<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Menjadi Mitra') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    <h3 class="text-lg font-bold mb-4">Lengkapi Data Venue Anda</h3>
                    <p class="mb-6 text-gray-600 text-sm">Bergabunglah sebagai mitra kami untuk mengelola lapangan Anda dengan lebih mudah.</p>
                    
                    {{-- Form ini mengarah ke route mitra.store untuk update role jadi 'mitra' --}}
                    <form action="{{ route('mitra.store') }}" method="POST">
                        @csrf

                        <div class="mb-4">
                            <x-input-label for="nama_venue" :value="__('Nama Venue / Gedung Olahraga')" />
                            <x-text-input id="nama_venue" class="block mt-1 w-full" type="text" name="nama_venue" :value="old('nama_venue')" required autofocus placeholder="Contoh: GOR Sejahtera" />
                            <x-input-error :messages="$errors->get('nama_venue')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="alamat" :value="__('Alamat Lengkap')" />
                            <textarea id="alamat" name="alamat" class="block mt-1 w-full border-gray-300 focus:border-red-500 focus:ring-red-500 rounded-md shadow-sm" rows="3" required placeholder="Alamat lengkap venue Anda...">{{ old('alamat') }}</textarea>
                            <x-input-error :messages="$errors->get('alamat')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="no_wa" :value="__('Nomor WhatsApp (Aktif)')" />
                            <x-text-input id="no_wa" class="block mt-1 w-full" type="text" name="no_wa" :value="old('no_wa')" required placeholder="08123456789" />
                            <p class="text-xs text-gray-500 mt-1">Nomor ini akan digunakan penyewa untuk menghubungi Anda.</p>
                            <x-input-error :messages="$errors->get('no_wa')" class="mt-2" />
                        </div>

                        <div class="mt-6 flex justify-end gap-3">
                            <a href="{{ route('dashboard') }}" class="px-4 py-2 bg-gray-500 text-white rounded-lg font-semibold hover:bg-gray-600">Batal</a>
                            <button type="submit" class="px-6 py-2 bg-red-600 text-white rounded-lg font-semibold hover:bg-red-700">
                                Daftar Mitra
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>