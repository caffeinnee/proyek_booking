<footer class="bg-gray-900 text-gray-400 mt-auto">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            
            <div>
                <h3 class="text-lg font-semibold text-white mb-4">Booking Lapangan</h3>
                <p class="text-sm">
                    Platform termudah untuk mencari dan memesan lapangan olahraga favorit Anda secara online.
                </p>
            </div>
            
            <div>
                <h3 class="text-lg font-semibold text-white mb-4">Link Cepat</h3>
                <ul class="space-y-2 text-sm">
                    <li><a href="{{ route('welcome') }}" class="hover:text-white">Beranda</a></li>
                    <li><a href="{{ route('katalog') }}" class="hover:text-white">Katalog</a></li>
                    
                    @auth
                        <li><a href="{{ route('dashboard') }}" class="hover:text-white">Dashboard Saya</a></li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <a href="{{ route('logout') }}" class="hover:text-white"
                                   onclick="event.preventDefault(); this.closest('form').submit();">
                                    Log Out
                                </a>
                            </form>
                        </li>
                    @else
                        <li><a href="{{ route('login') }}" class="hover:text-white">Login</a></li>
                        <li><a href="{{ route('register') }}" class="hover:text-white">Register</a></li>
                    @endguest
                </ul>
            </div>
            
            <div>
                <h3 class="text-lg font-semibold text-white mb-4">Kontak Kami</h3>
                <ul class="space-y-2 text-sm">
                    <li>Email: info@bookinglapangan.com</li>
                    <li>Telepon: (021) 123-4567</li>
                    <li>Alamat: Jl. Koding No. 1, Jakarta</li>
                </ul>
            </div>
            
        </div>
        
        <div class="mt-8 border-t border-gray-700 pt-8 text-center text-sm">
            &copy; {{ date('Y') }} Proyek Booking Lapangan. Dibuat dengan Laravel.
        </div>
    </div>
</footer>