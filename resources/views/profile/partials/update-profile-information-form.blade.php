<section>
    <header>
        <h2 class="text-xl font-bold text-gray-900">
            {{ __('Informasi Profil') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Perbarui nama dan alamat email akun Anda. Termasuk No. WhatsApp jika Anda Mitra.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" :value="__('Nama Lengkap')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full rounded-lg" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full rounded-lg" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800">
                        {{ __('Alamat email Anda belum terverifikasi.') }}

                        <button form="send-verification" class="underline text-sm text-red-600 hover:text-red-800 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                            {{ __('Klik di sini untuk kirim ulang email verifikasi.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ __('Link verifikasi baru telah dikirim ke alamat email Anda.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>
        
        {{-- Tambahkan field No. WA jika user memiliki kolom no_wa --}}
        @if(isset($user->no_wa))
        <div>
            <x-input-label for="no_wa" :value="__('Nomor WhatsApp')" />
            <x-text-input id="no_wa" name="no_wa" type="text" class="mt-1 block w-full rounded-lg" :value="old('no_wa', $user->no_wa)" autocomplete="no_wa" />
            <p class="mt-1 text-xs text-gray-500">Nomor ini digunakan untuk notifikasi booking.</p>
            <x-input-error class="mt-2" :messages="$errors->get('no_wa')" />
        </div>
        @endif


        <div class="flex items-center gap-4">
            {{-- Tombol Simpan Merah --}}
            <button type="submit" class="px-5 py-2 bg-red-600 text-white rounded-lg font-bold hover:bg-red-700 transition">
                {{ __('Simpan Perubahan') }}
            </button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-green-600"
                >{{ __('Berhasil disimpan.') }}</p>
            @endif
        </div>
    </form>
</section>