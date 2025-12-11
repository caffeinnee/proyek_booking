<nav x-data="{ open: false }" class="bg-white border-b border-gray-100 md:border-b-0 md:border-r w-full md:w-64 md:min-h-screen flex-shrink-0">
    
    <div class="px-4 sm:px-6 lg:px-4">
        <div class="flex justify-between h-16 md:h-auto md:flex-col">
            
            {{-- LOGO (Mengarah ke Beranda) --}}
            <div class="flex items-center md:justify-center md:py-6 md:border-b md:border-gray-100 md:mb-6">
                <a href="{{ route('welcome') }}" class="flex items-center gap-2">
                    <x-application-logo class="block h-9 w-auto fill-current text-red-600" />
                    <span class="font-bold text-xl text-gray-800 hidden md:block">Booking<span class="text-red-600">App</span></span>
                </a>
            </div>

            {{-- TOMBOL HAMBURGER (HP) --}}
            <div class="-me-2 flex items-center md:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-red-600 hover:bg-red-50 focus:outline-none transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            {{-- MENU SIDEBAR (DESKTOP) --}}
            <div class="hidden md:flex md:flex-col md:space-y-2">
                
                <p class="px-3 text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2 mt-2">Menu Utama</p>
                
                <a href="{{ route('welcome') }}" 
                   class="flex items-center w-full px-3 py-2 rounded-lg transition duration-150 ease-in-out group 
                   {{ request()->routeIs('welcome') ? 'bg-red-50 text-red-700 font-bold' : 'text-gray-600 hover:bg-red-50 hover:text-red-700' }}">
                    <svg class="w-5 h-5 mr-3 {{ request()->routeIs('welcome') ? 'text-red-700' : 'text-gray-400 group-hover:text-red-700' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                    {{ __('Beranda') }}
                </a>

                <a href="{{ route('dashboard') }}" 
                   class="flex items-center w-full px-3 py-2 rounded-lg transition duration-150 ease-in-out group 
                   {{ request()->routeIs('dashboard') ? 'bg-red-50 text-red-700 font-bold' : 'text-gray-600 hover:bg-red-50 hover:text-red-700' }}">
                    <svg class="w-5 h-5 mr-3 {{ request()->routeIs('dashboard') ? 'text-red-700' : 'text-gray-400 group-hover:text-red-700' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                    {{ __('Dashboard') }}
                </a>

                <a href="{{ route('katalog') }}" 
                   class="flex items-center w-full px-3 py-2 rounded-lg transition duration-150 ease-in-out group
                   {{ request()->routeIs('katalog') ? 'bg-red-50 text-red-700 font-bold' : 'text-gray-600 hover:bg-red-50 hover:text-red-700' }}">
                    <svg class="w-5 h-5 mr-3 {{ request()->routeIs('katalog') ? 'text-red-700' : 'text-gray-400 group-hover:text-red-700' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                    {{ __('Katalog') }}
                </a>

                @if(Auth::user()->is_admin || Auth::user()->role === 'mitra')
                    <p class="px-3 text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2 mt-6">Manajemen</p>
                    
                    @if(Auth::user()->role === 'mitra')
                        <a href="{{ route('admin.dashboard') }}" 
                           class="flex items-center w-full px-3 py-2 rounded-lg transition duration-150 ease-in-out group
                           {{ request()->routeIs('admin.dashboard') ? 'bg-red-50 text-red-700 font-bold' : 'text-gray-600 hover:bg-red-50 hover:text-red-700' }}">
                            <svg class="w-5 h-5 mr-3 {{ request()->routeIs('admin.dashboard') ? 'text-red-700' : 'text-gray-400 group-hover:text-red-700' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                            {{ __('Kelola Orderan') }}
                        </a>
                        
                        {{-- Menu Mitra dibuat standar tapi tetap responsif merah saat di-hover --}}
                        <a href="{{ route('mitra.index') }}" 
                           class="flex items-center w-full px-3 py-2 rounded-lg transition duration-150 ease-in-out group
                           {{ request()->routeIs('mitra.index') ? 'bg-red-50 text-red-700 font-bold' : 'text-gray-600 hover:bg-red-50 hover:text-red-700' }}">
                            <svg class="w-5 h-5 mr-3 {{ request()->routeIs('mitra.index') ? 'text-red-700' : 'text-gray-400 group-hover:text-red-700' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                            {{ __('Kelola Lapangan') }}
                        </a>

                        <a href="{{ route('mitra.rekening.index') }}" 
                           class="flex items-center w-full px-3 py-2 rounded-lg transition duration-150 ease-in-out group
                           {{ request()->routeIs('mitra.rekening.index') ? 'bg-red-50 text-red-700 font-bold' : 'text-gray-600 hover:bg-red-50 hover:text-red-700' }}">
                            <svg class="w-5 h-5 mr-3 {{ request()->routeIs('mitra.rekening.index') ? 'text-red-700' : 'text-gray-400 group-hover:text-red-700' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
                            {{ __('Kelola Rekening') }}
                        </a>
                    @endif

                    @if(Auth::user()->is_admin)
                        <a href="{{ route('super.dashboard') }}" 
                           class="flex items-center w-full px-3 py-2 rounded-lg transition duration-150 ease-in-out group
                           {{ request()->routeIs('super.dashboard') ? 'bg-red-50 text-red-700 font-bold' : 'text-gray-600 hover:bg-red-50 hover:text-red-700' }}">
                            <svg class="w-5 h-5 mr-3 {{ request()->routeIs('super.dashboard') ? 'text-red-700' : 'text-gray-400 group-hover:text-red-700' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                            {{ __('Super Admin') }}
                        </a>
                    @endif
                @endif

                <div class="mt-auto pt-6 border-t border-gray-100">
                    <div class="flex items-center px-3 mb-3">
                        <div class="font-medium text-sm text-gray-800 flex items-center gap-1">
                            {{ Auth::user()->name }}
                            @if(Auth::user()->is_verified)
                                <svg class="w-4 h-4 text-red-500 fill-current" viewBox="0 0 20 20" title="Verified Partner">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                </svg>
                            @endif
                        </div>
                    </div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();" class="flex items-center w-full px-3 py-2 rounded-lg text-gray-600 hover:bg-red-50 hover:text-red-700 transition duration-150 ease-in-out group">
                            <svg class="w-5 h-5 mr-3 text-gray-400 group-hover:text-red-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                            {{ __('Log Out') }}
                        </a>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- MENU MOBILE (TAMPILAN HP) --}}
    <div :class="{'block': open, 'hidden': ! open}" class="hidden md:hidden border-t border-gray-100 bg-white">
        
        {{-- Info User --}}
        <div class="pt-4 pb-2 px-4 border-b border-gray-100 bg-gray-50">
            <div class="flex items-center">
                <div class="shrink-0">
                    <div class="h-10 w-10 rounded-full bg-red-100 flex items-center justify-center text-red-600 font-bold text-lg border border-red-200">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>
                </div>
                <div class="ml-3">
                    <div class="font-bold text-base text-gray-800">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>
            </div>
        </div>

        <div class="pt-2 pb-3 space-y-1">
            <a href="{{ route('welcome') }}" 
               class="block w-full ps-3 pe-4 py-3 border-l-4 text-start text-base font-medium transition duration-150 ease-in-out
               {{ request()->routeIs('welcome') ? 'border-red-600 text-red-700 bg-red-50 font-bold' : 'border-transparent text-gray-600 hover:text-red-600 hover:bg-red-50 hover:border-red-300' }}">
                {{ __('Beranda') }}
            </a>

            <a href="{{ route('dashboard') }}" 
               class="block w-full ps-3 pe-4 py-3 border-l-4 text-start text-base font-medium transition duration-150 ease-in-out
               {{ request()->routeIs('dashboard') ? 'border-red-600 text-red-700 bg-red-50 font-bold' : 'border-transparent text-gray-600 hover:text-red-600 hover:bg-red-50 hover:border-red-300' }}">
                {{ __('Dashboard') }}
            </a>
            
            <a href="{{ route('katalog') }}" 
               class="block w-full ps-3 pe-4 py-3 border-l-4 text-start text-base font-medium transition duration-150 ease-in-out
               {{ request()->routeIs('katalog') ? 'border-red-600 text-red-700 bg-red-50 font-bold' : 'border-transparent text-gray-600 hover:text-red-600 hover:bg-red-50 hover:border-red-300' }}">
                {{ __('Katalog') }}
            </a>
            
            @if(Auth::user()->is_admin || Auth::user()->role === 'mitra')
                <div class="border-t border-gray-100 my-2 pt-2 px-4 text-xs font-semibold text-gray-400 uppercase tracking-wider">
                    Manajemen
                </div>
                
                @if(Auth::user()->role === 'mitra')
                    <a href="{{ route('admin.dashboard') }}" 
                       class="block w-full ps-3 pe-4 py-3 border-l-4 text-start text-base font-medium transition duration-150 ease-in-out
                       {{ request()->routeIs('admin.dashboard') ? 'border-red-600 text-red-700 bg-red-50 font-bold' : 'border-transparent text-gray-600 hover:text-red-600 hover:bg-red-50 hover:border-red-300' }}">
                        {{ __('Kelola Orderan') }}
                    </a>
                    <a href="{{ route('mitra.index') }}" 
                       class="block w-full ps-3 pe-4 py-3 border-l-4 text-start text-base font-medium transition duration-150 ease-in-out
                       {{ request()->routeIs('mitra.index') ? 'border-red-600 text-red-700 bg-red-50 font-bold' : 'border-transparent text-gray-600 hover:text-red-600 hover:bg-red-50 hover:border-red-300' }}">
                        {{ __('Kelola Lapangan') }}
                    </a>
                    <a href="{{ route('mitra.rekening.index') }}" 
                       class="block w-full ps-3 pe-4 py-3 border-l-4 text-start text-base font-medium transition duration-150 ease-in-out
                       {{ request()->routeIs('mitra.rekening.index') ? 'border-red-600 text-red-700 bg-red-50 font-bold' : 'border-transparent text-gray-600 hover:text-red-600 hover:bg-red-50 hover:border-red-300' }}">
                        {{ __('Kelola Rekening') }}
                    </a>
                @endif

                @if(Auth::user()->is_admin)
                    <a href="{{ route('super.dashboard') }}" 
                       class="block w-full ps-3 pe-4 py-3 border-l-4 text-start text-base font-medium transition duration-150 ease-in-out
                       {{ request()->routeIs('super.dashboard') ? 'border-red-600 text-red-700 bg-red-50 font-bold' : 'border-transparent text-gray-600 hover:text-red-600 hover:bg-red-50 hover:border-red-300' }}">
                        {{ __('Super Admin') }}
                    </a>
                @endif
            @endif
            
            <div class="border-t border-gray-100 my-2"></div>
            
            <a href="{{ route('profile.edit') }}" 
               class="block w-full ps-3 pe-4 py-3 border-l-4 text-start text-base font-medium transition duration-150 ease-in-out
               {{ request()->routeIs('profile.edit') ? 'border-red-600 text-red-700 bg-red-50 font-bold' : 'border-transparent text-gray-600 hover:text-red-600 hover:bg-red-50 hover:border-red-300' }}">
                {{ __('Edit Profil') }}
            </a>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();" 
                   class="block w-full ps-3 pe-4 py-3 border-l-4 border-transparent text-start text-base font-medium text-red-600 hover:bg-red-50 hover:border-red-200 transition duration-150 ease-in-out">
                    {{ __('Log Out') }}
                </a>
            </form>
        </div>
    </div>
</nav>