<nav x-data="{ open: false }" class="bg-white shadow-sm border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center"> 
            <div class="shrink-0 flex items-center gap-3">
                <a href="{{ route('welcome') }}" class="flex items-center">
                    <x-application-logo class="block h-14 w-auto fill-current text-red-600" />
                </a>
                <a href="{{ route('welcome') }}" class="font-bold text-xl text-gray-800 hover:text-red-700 transition">
                    {{ config('app.name') }}
                </a>
            </div>

            <div class="hidden sm:flex flex-1 justify-center space-x-8">
                <a href="{{ route('welcome') }}"
                   class="inline-flex items-center px-1 pt-1 border-b-2 font-medium text-sm transition duration-150 ease-in-out
                          {{ request()->routeIs('welcome') ? 'border-red-500 text-gray-900' : 'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700' }}">
                    {{ __('Beranda') }}
                </a>
                <a href="{{ route('katalog') }}"
                   class="inline-flex items-center px-1 pt-1 border-b-2 font-medium text-sm transition duration-150 ease-in-out
                          {{ request()->routeIs('katalog') ? 'border-red-500 text-gray-900' : 'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700' }}">
                    {{ __('Katalog') }}
                </a>
                <a href="{{ route('pages.cara-pesan') }}"
                    class="inline-flex items-center px-1 pt-1 border-b-2 font-medium text-sm transition duration-150 ease-in-out
                    {{ request()->routeIs('pages.cara-pesan') ? 'border-red-500 text-gray-900' : 'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700' }}">
                    {{ __('Cara Pesan') }}
                </a>
                <a href="{{ route('pages.tentang-kami') }}"
                    class="inline-flex items-center px-1 pt-1 border-b-2 font-medium text-sm transition duration-150 ease-in-out
                    {{ request()->routeIs('pages.tentang-kami') ? 'border-red-500 text-gray-900' : 'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700' }}">
                    {{ __('Tentang Kami') }}
                </a>
            </div>

            <div class="hidden sm:flex items-center justify-end"> 
                @if (Route::has('login'))
                    @auth
                        <div class="ms-3 relative">
                            <x-dropdown align="right" width="48">
                                <x-slot name="trigger">
                                    <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                        <div>{{ Auth::user()->name }}</div>
                                        <div class="ms-1"><svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" /></svg></div>
                                    </button>
                                </x-slot>
                                <x-slot name="content">
                                    @if(Auth::user()->is_admin)
                                        <x-dropdown-link :href="route('super.dashboard')" class="font-bold text-red-600">{{ __('Super Admin Panel') }}</x-dropdown-link>
                                    @endif
                                    @if(Auth::user()->role === 'mitra')
                                        <x-dropdown-link :href="route('mitra.index')" class="font-bold text-red-600">{{ __('Area Mitra') }}</x-dropdown-link>
                                    @endif
                                    <x-dropdown-link :href="route('dashboard')">{{ __('Dashboard') }}</x-dropdown-link>
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
            
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

        </div>
    </div>

    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('welcome')" :active="request()->routeIs('welcome')">
                {{ __('Beranda') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('katalog')" :active="request()->routeIs('katalog')">
                {{ __('Katalog') }}
            </x-responsive-nav-link>
        </div>

        <div class="pt-4 pb-1 border-t border-gray-200">
            @if (Route::has('login'))
                @auth
                    <div class="px-4">
                        <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                        <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                    </div>
                    <div class="mt-3 space-y-1">
                        @if(Auth::user()->is_admin)
                            <x-responsive-nav-link :href="route('super.dashboard')" class="font-bold text-red-600">{{ __('Super Admin Panel') }}</x-responsive-nav-link>
                        @endif
                        @if(Auth::user()->role === 'mitra')
                            <x-responsive-nav-link :href="route('mitra.index')" class="font-bold text-red-600">{{ __('Area Mitra') }}</x-responsive-nav-link>
                        @endif
                        <x-responsive-nav-link :href="route('dashboard')">{{ __('Dashboard') }}</x-responsive-nav-link>
                        <x-responsive-nav-link :href="route('profile.edit')">{{ __('Profile') }}</x-responsive-nav-link>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-responsive-nav-link>
                        </form>
                    </div>
                @else
                    <div class="space-y-1">
                        <x-responsive-nav-link :href="route('login')">{{ __('Log in') }}</x-responsive-nav-link>
                        @if (Route::has('register'))
                            <x-responsive-nav-link :href="route('register')">{{ __('Register') }}</x-responsive-nav-link>
                        @endif
                    </div>
                @endauth
            @endif
        </div>
    </div>
</nav>