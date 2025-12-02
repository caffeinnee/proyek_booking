<x-guest-layout>
    
    <div class="mb-6">
        <h2 class="mt-6 text-3xl font-extrabold text-gray-900">
            Buat Akun Baru
        </h2>
        <p class="mt-2 text-sm text-gray-600">
            Bergabunglah untuk mulai memesan lapangan
        </p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-4">
        @csrf

        <div>
            <x-input-label for="name" :value="__('Nama Lengkap')" />
            <x-text-input id="name" class="block mt-1 w-full rounded-lg" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="John Doe" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Alamat Email')" />
            <x-text-input id="email" class="block mt-1 w-full rounded-lg" type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="john@example.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="no_wa" :value="__('Nomor WhatsApp')" />
            <x-text-input id="no_wa" class="block mt-1 w-full rounded-lg" type="text" name="no_wa" :value="old('no_wa')" required placeholder="08123456789" />
            <x-input-error :messages="$errors->get('no_wa')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full rounded-lg" type="password" name="password" required autocomplete="new-password" placeholder="••••••••" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="password_confirmation" :value="__('Konfirmasi Password')" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full rounded-lg" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="••••••••" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="pt-2">
            <x-primary-button class="w-full justify-center py-3 bg-red-600 hover:bg-red-700">
                {{ __('Daftar Sekarang') }}
            </x-primary-button>
        </div>
    </form>

    <div class="mt-6 text-center">
        <p class="text-sm text-gray-600">
            Sudah punya akun?
            <a href="{{ route('login') }}" class="font-medium text-red-600 hover:text-red-500">
                Masuk di sini
            </a>
        </p>
    </div>
</x-guest-layout>