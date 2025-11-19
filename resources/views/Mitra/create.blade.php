<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Registrasi Mitra Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    <div class="mb-6 text-center">
                        <h3 class="text-lg font-bold">Gabung Sebagai Mitra</h3>
                        <p class="text-gray-500 text-sm">Lengkapi data bisnis Anda untuk mulai mengelola lapangan.</p>
                    </div>
                    
                    <form action="{{ route('mitra.store') }}" method="POST">
                        @csrf

                        <div class="mb-4">
                            <x-input-label for="nama_venue" :value="__('Nama Venue / GOR')" />
                            <x-text-input id="nama_venue" class="block mt-1 w-full" type="text" name="nama_venue" required placeholder="Contoh: Galaxy Futsal Center" />
                            <x-input-error :messages="$errors->get('nama_venue')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="alamat" :value="__('Alamat Lengkap Venue')" />
                            <textarea name="alamat" id="alamat" rows="3" class="block mt-1 w-full border-gray-300 focus:border-red-500 focus:ring-red-500 rounded-md shadow-sm" required placeholder="Jl. Sudirman No. 10..."></textarea>
                            <x-input-error :messages="$errors->get('alamat')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="no_wa" :value="__('Nomor WhatsApp Bisnis')" />
                            <x-text-input id="no_wa" class="block mt-1 w-full" type="text" name="no_wa" :value="Auth::user()->no_wa" required />
                            <p class="text-xs text-gray-500 mt-1">*Pastikan nomor ini aktif untuk dihubungi pelanggan.</p>
                        </div>

                        <div class="mt-6 flex justify-end">
                            <button type="submit" class="px-6 py-2 bg-red-700 text-white rounded-lg font-semibold hover:bg-red-800 transition">
                                Simpan & Aktifkan Akun Mitra
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>