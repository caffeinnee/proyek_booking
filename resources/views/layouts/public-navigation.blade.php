<nav x-data="{ open: false }" class="bg-white shadow-sm border-b border-gray-100 sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center"> 
            
            {{-- LOGO & BRAND --}}
            <div class="shrink-0 flex items-center gap-3">
                <a href="{{ route('welcome') }}" class="flex items-center">
                    <x-application-logo class="block h-10 w-auto fill-current text-red-600" />
                </a>
                <a href="{{ route('welcome') }}" class="font-bold text-xl text-gray-800 hover:text-red-700 transition">
                    {{ config('app.name') }}
                </a>
            </div>

            {{-- MENU DESKTOP (Tampilan Laptop) --}}
            <div class="hidden sm:flex flex-1 justify-center space-x-8">
                @php
                    $navLinks = [
                        ['route' => 'welcome', 'label' => 'Beranda'],
                        ['route' => 'katalog', 'label' => 'Katalog'],
                        ['route' => 'pages.cara-pesan', 'label' => 'Cara Pesan'],
                        ['route' => 'pages.tentang-kami', 'label' => 'Tentang Kami'],
                    ];
                @endphp

                @foreach($navLinks as $link)
                    <a href="{{ route($link['route']) }}"
                       class="inline-flex items-center px-1 pt-1 border-b-2 font-medium text-sm transition duration-150 ease-in-out
                              {{ request()->routeIs($link['route']) 
                                    ? 'border-red-600 text-gray-900 font-bold' 
                                    : 'border-transparent text-gray-500 hover:border-gray-300 hover:text-red-600' }}">
                        {{ $link['label'] }}
                    </a>
                @endforeach
            </div>

            {{-- TOMBOL LOGIN/PROFILE (DESKTOP) --}}
            <div class="hidden sm:flex items-center justify-end"> 
                @if (Route::has('login'))
                    @auth
                        <div class="ms-3 relative">
                            <x-dropdown align="right" width="48">
                                <x-slot name="trigger">
                                    <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-full text-gray-500 bg-gray-50 hover:text-red-600 hover:bg-red-50 focus:outline-none transition ease-in-out duration-150">
                                        <div class="font-bold">{{ Auth::user()->name }}</div>
                                        <div class="ms-1"><svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" /></svg></div>
                                    </button>
                                </x-slot>
                                <x-slot name="content">
                                    @if(Auth::user()->is_admin)
                                        <x-dropdown-link :href="route('super.dashboard')" class="font-bold text-red-600 border-l-4 border-transparent hover:border-red-600 bg-red-50">{{ __('Super Admin Panel') }}</x-dropdown-link>
                                    @endif
                                    @if(Auth::user()->role === 'mitra')
                                        <x-dropdown-link :href="route('mitra.index')" class="font-bold text-red-600 border-l-4 border-transparent hover:border-red-600 bg-red-50">{{ __('Area Mitra') }}</x-dropdown-link>
                                    @endif
                                    <x-dropdown-link :href="route('dashboard')">{{ __('Dashboard') }}</x-dropdown-link>
                                    <x-dropdown-link :href="route('profile.edit')">{{ __('Profile') }}</x-dropdown-link>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();" class="text-red-600 hover:bg-red-50">{{ __('Log Out') }}</x-dropdown-link>
                                    </form>
                                </x-slot>
                            </x-dropdown>
                        </div>
                    @else
                        <div class="flex gap-2">
                            <a href="{{ route('login') }}" class="px-4 py-2 text-sm font-bold text-gray-600 hover:text-red-600 transition">Log in</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="px-4 py-2 text-sm font-bold text-white bg-red-600 rounded-lg hover:bg-red-700 shadow-md shadow-red-200 transition">Register</a>
                            @endif
                        </div>
                    @endauth
                @endif
            </div>
            
            {{-- TOMBOL HAMBURGER (MOBILE) --}}
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-red-600 hover:bg-red-50 focus:outline-none focus:bg-red-50 focus:text-red-600 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

        </div>
    </div>

    {{-- MENU MOBILE (Tampilan HP) --}}
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-white border-t border-gray-100 shadow-inner">
        <div class="pt-2 pb-3 space-y-1">
            @foreach($navLinks as $link)
                <a href="{{ route($link['route']) }}" 
                   class="block w-full ps-3 pe-4 py-3 border-l-4 text-start text-base font-medium transition duration-150 ease-in-out
                   {{ request()->routeIs($link['route']) 
                        ? 'border-red-600 text-red-700 bg-red-50' 
                        : 'border-transparent text-gray-600 hover:text-red-600 hover:bg-gray-50 hover:border-gray-300' }}">
                    {{ $link['label'] }}
                </a>
            @endforeach
        </div>

        {{-- PROFIL USER DI MOBILE --}}
        <div class="pt-4 pb-4 border-t border-gray-200 bg-gray-50">
            @if (Route::has('login'))
                @auth
                    <div class="px-4 mb-3 flex items-center">
                        <div class="shrink-0">
                            <div class="h-10 w-10 rounded-full bg-red-100 flex items-center justify-center text-red-600 font-bold text-xl">
                                {{ substr(Auth::user()->name, 0, 1) }}
                            </div>
                        </div>
                        <div class="ml-3">
                            <div class="font-bold text-base text-gray-800">{{ Auth::user()->name }}</div>
                            <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                        </div>
                    </div>

                    <div class="mt-3 space-y-1">
                        @if(Auth::user()->is_admin)
                            <a href="{{ route('super.dashboard') }}" class="block w-full ps-3 pe-4 py-2 border-l-4 border-transparent text-start text-base font-bold text-red-600 hover:bg-red-100 hover:border-red-600 transition">
                                {{ __('Super Admin Panel') }}
                            </a>
                        @endif
                        @if(Auth::user()->role === 'mitra')
                            <a href="{{ route('mitra.index') }}" class="block w-full ps-3 pe-4 py-2 border-l-4 border-transparent text-start text-base font-bold text-red-600 hover:bg-red-100 hover:border-red-600 transition">
                                {{ __('Area Mitra') }}
                            </a>
                        @endif
                        
                        <a href="{{ route('dashboard') }}" class="block w-full ps-3 pe-4 py-2 border-l-4 border-transparent text-start text-base font-medium text-gray-600 hover:text-gray-800 hover:bg-white transition">
                            {{ __('Dashboard') }}
                        </a>
                        <a href="{{ route('profile.edit') }}" class="block w-full ps-3 pe-4 py-2 border-l-4 border-transparent text-start text-base font-medium text-gray-600 hover:text-gray-800 hover:bg-white transition">
                            {{ __('Profile') }}
                        </a>
                        
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();" class="block w-full ps-3 pe-4 py-2 border-l-4 border-transparent text-start text-base font-medium text-red-600 hover:bg-red-50 hover:border-red-200 transition">
                                {{ __('Log Out') }}
                            </a>
                        </form>
                    </div>
                @else
                    <div class="px-4 space-y-3">
                        <a href="{{ route('login') }}" class="block w-full text-center px-4 py-3 bg-white border border-gray-300 rounded-lg text-gray-700 font-bold hover:bg-gray-50 transition">
                            {{ __('Log in') }}
                        </a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="block w-full text-center px-4 py-3 bg-red-600 rounded-lg text-white font-bold shadow-md hover:bg-red-700 transition">
                                {{ __('Register Sekarang') }}
                            </a>
                        @endif
                    </div>
                @endauth
            @endif
        </div>
    </div>
</nav>