<nav class="bg-white shadow-sm border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">

            <div class="flex items-center">
                <a href="{{ route('welcome') }}" class="font-bold text-lg shrink-0">
                    Booking Lapangan
                </a>

                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">

                    <a href="{{ route('welcome') }}"
                       class="inline-flex items-center px-1 pt-1 border-b-2 font-medium text-sm
                              {{ request()->routeIs('welcome') ? 'border-red-500 text-gray-900' : 'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700' }}">
                        {{ __('Beranda') }}
                    </a>

                    <a href="{{ route('katalog') }}"
                       class="inline-flex items-center px-1 pt-1 border-b-2 font-medium text-sm
                              {{ request()->routeIs('katalog') ? 'border-red-500 text-gray-900' : 'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700' }}">
                        {{ __('Katalog') }}
                    </a>
                </div>
            </div>

            <div class="flex items-center">
                @if (Route::has('login'))
                    @auth
                        <div class="flex items-center sm:ms-6">
                            <x-dropdown align="right" width="48">
                                <x-slot name="trigger">
                                    <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                        <div>{{ Auth::user()->name }}</div>
                                        <div class="ms-1"><svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" /></svg></div>
                                    </button>
                                </x-slot>
                                <x-slot name="content">
                                    <x-dropdown-link :href="route('dashboard')">{{ __('Dashboard') }}</x-dropdown-link>

                                    @if(Auth::user()->is_admin)
                                        <x-dropdown-link :href="route('admin.dashboard')" >{{ __('Admin Dashboard') }}</x-dropdown-link>
                                    @endif
                                    <x-dropdown-link :href="route('profile.edit')">{{ __('Profile') }}</x-dropdown-link>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">{{ __('Log Out') }}</x-dropdown-link>
                                    </form>
                                </x-slot>
                            </x-dropdown>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="font-semibold text-gray-600 hover:text-gray-900 mr-4">Log in</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="font-semibold text-gray-600 hover:text-gray-900">Register</a>
                        @endif
                    @endauth
                @endif
            </div>

            </div>
    </div>
</nav>