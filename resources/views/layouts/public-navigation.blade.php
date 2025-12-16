<nav x-data="{ open: false }" class="bg-white shadow-md border-b border-gray-100 sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center"> 
            
            {{-- LOGO & BRAND --}}
            <div class="shrink-0 flex items-center gap-3">
                <a href="{{ route('welcome') }}" class="flex items-center">
                    <x-application-logo class="block h-10 w-auto fill-current text-red-600" />
                </a>
                <a href="{{ route('welcome') }}" class="font-bold text-xl text-gray-900 hover:text-red-700 transition tracking-tight">
                    {{ config('app.name') }}
                </a>
            </div>

            {{-- MENU DESKTOP --}}
            <div class="hidden sm:flex flex-1 justify-center space-x-8">
                @php
                    // PERBAIKAN HANYA DI SINI: Hapus 'pages.' agar rute terbaca
                    $navLinks = [
                        ['route' => 'welcome', 'label' => 'Beranda'],
                        ['route' => 'katalog', 'label' => 'Katalog'],
                        ['route' => 'cara-pesan', 'label' => 'Cara Pesan'], 
                        ['route' => 'tentang-kami', 'label' => 'Tentang Kami'],
                    ];
                @endphp

                @foreach($navLinks as $link)
                    <a href="{{ route($link['route']) }}"
                       class="inline-flex items-center px-1 pt-1 border-b-2 text-sm font-bold transition duration-150 ease-in-out
                              {{ request()->routeIs($link['route']) 
                                    ? 'border-red-600 text-red-700' 
                                    : 'border-transparent text-gray-700 hover:text-red-600 hover:border-red-300' }}">
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
                                    <button class="inline-flex items-center px-4 py-2 border border-gray-200 text-sm leading-4 font-bold rounded-full text-gray-700 bg-gray-50 hover:bg-white hover:text-red-700 hover:border-red-200 focus:outline-none transition ease-in-out duration-150 shadow-sm">
                                        <div class="flex items-center gap-1">
                                            {{ Auth::user()->name }}
                                            
                                            {{-- IKON VERIFIED MERAH (DESKTOP) --}}
                                            @if(Auth::user()->is_verified)
                                                <svg class="w-4 h-4 text-red-600 flex-shrink-0" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                                </svg>
                                            @endif
                                        </div>
                                        <div class="ms-1"><svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" /></svg></div>
                                    </button>
                                </x-slot>
                                <x-slot name="content">
                                    @if(Auth::user()->is_admin)
                                        <x-dropdown-link :href="route('super.dashboard')" class="font-bold">{{ __('Super Admin Panel') }}</x-dropdown-link>
                                    @endif
                                    
                                    @if(Auth::user()->role === 'mitra')
                                        <x-dropdown-link :href="route('mitra.index')" class="font-bold">{{ __('Area Mitra') }}</x-dropdown-link>
                                    @endif
                                    
                                    <x-dropdown-link :href="route('dashboard')">{{ __('Dashboard') }}</x-dropdown-link>
                                    <x-dropdown-link :href="route('profile.edit')">{{ __('Profile') }}</x-dropdown-link>
                                    
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();" class="text-red-600 font-semibold">{{ __('Log Out') }}</x-dropdown-link>
                                    </form>
                                </x-slot>
                            </x-dropdown>
                        </div>
                    @else
                        <div class="flex items-center gap-3">
                            <a href="{{ route('login') }}" class="font-bold text-gray-700 hover:text-red-600 transition">Masuk</a>
                            <a href="{{ route('register') }}" class="px-5 py-2.5 bg-red-600 text-white rounded-full font-bold text-sm shadow-md hover:bg-red-700 hover:shadow-lg transition transform hover:-translate-y-0.5">
                                Daftar Sekarang
                            </a>
                        </div>
                    @endauth
                @endif
            </div>
            
            {{-- TOMBOL HAMBURGER (MOBILE) --}}
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-600 hover:text-red-600 hover:bg-red-50 focus:outline-none focus:bg-red-50 focus:text-red-600 transition duration-150 ease-in-out">
                    <svg class="h-7 w-7" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

        </div>
    </div>

    {{-- MENU MOBILE (TAMPILAN HP) --}}
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-white border-t border-gray-100 shadow-lg absolute w-full left-0 z-50">
        <div class="pt-2 pb-3 space-y-1 px-2">
            @foreach($navLinks as $link)
                <a href="{{ route($link['route']) }}" 
                   class="block w-full ps-3 pe-4 py-3 border-l-4 text-start text-base font-bold transition duration-150 ease-in-out rounded-r-lg
                   {{ request()->routeIs($link['route']) 
                        ? 'border-red-600 text-red-700 bg-red-50' 
                        : 'border-transparent text-gray-700 hover:text-red-600 hover:bg-gray-50 hover:border-red-300' }}">
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
                            <div class="h-10 w-10 rounded-full bg-red-600 flex items-center justify-center text-white font-bold text-lg shadow-sm border-2 border-white">
                                {{ substr(Auth::user()->name, 0, 1) }}
                            </div>
                        </div>
                        <div class="ml-3">
                            <div class="font-bold text-base text-gray-900 flex items-center gap-1">
                                {{ Auth::user()->name }}
                                
                                {{-- IKON VERIFIED MERAH (MOBILE) --}}
                                @if(Auth::user()->is_verified)
                                    <svg class="w-4 h-4 text-red-600 flex-shrink-0" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                    </svg>
                                @endif
                            </div>
                            <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                        </div>
                    </div>

                    <div class="mt-3 space-y-1 px-2">
                        @if(Auth::user()->is_admin)
                            <a href="{{ route('super.dashboard') }}" class="block w-full ps-3 pe-4 py-2 border-l-4 border-transparent text-start text-base font-bold text-gray-700 hover:text-gray-900 hover:bg-gray-100 rounded-r-lg transition">
                                {{ __('Panel Super Admin') }}
                            </a>
                        @endif
                        
                        @if(Auth::user()->role === 'mitra')
                            <a href="{{ route('mitra.index') }}" class="block w-full ps-3 pe-4 py-2 border-l-4 border-transparent text-start text-base font-bold text-gray-700 hover:text-red-700 hover:bg-red-50 hover:border-red-300 rounded-r-lg transition">
                                {{ __('Area Mitra') }}
                            </a>
                        @endif
                        
                        <a href="{{ route('dashboard') }}" class="block w-full ps-3 pe-4 py-2 border-l-4 border-transparent text-start text-base font-medium text-gray-600 hover:text-gray-900 hover:bg-white hover:border-gray-300 rounded-r-lg transition">
                            {{ __('Dashboard Saya') }}
                        </a>
                        <a href="{{ route('profile.edit') }}" class="block w-full ps-3 pe-4 py-2 border-l-4 border-transparent text-start text-base font-medium text-gray-600 hover:text-gray-900 hover:bg-white hover:border-gray-300 rounded-r-lg transition">
                            {{ __('Edit Profil') }}
                        </a>
                        
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();" class="block w-full ps-3 pe-4 py-2 border-l-4 border-transparent text-start text-base font-bold text-red-600 hover:bg-red-50 hover:border-red-200 rounded-r-lg transition">
                                {{ __('Keluar (Log Out)') }}
                            </a>
                        </form>
                    </div>
                @else
                    <div class="px-4 space-y-3 pb-2">
                        <a href="{{ route('login') }}" class="block w-full text-center px-4 py-3 bg-white border-2 border-gray-200 rounded-xl text-gray-800 font-bold hover:bg-gray-50 hover:border-gray-300 transition">
                            Masuk Akun
                        </a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="block w-full text-center px-4 py-3 bg-red-600 rounded-xl text-white font-bold shadow-md hover:bg-red-700 transition">
                                Daftar Sekarang
                            </a>
                        @endif
                    </div>
                @endauth
            @endif
        </div>
    </div>
</nav>