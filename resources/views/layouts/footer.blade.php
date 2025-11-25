<footer class="bg-gray-900 border-t-4 border-red-700 text-gray-300 mt-auto">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-8">
            
            <div class="col-span-1 lg:col-span-1">
                <a href="/" class="text-2xl font-extrabold text-white tracking-wider flex items-center gap-2">
                    <svg class="w-8 h-8 text-red-600" fill="currentColor" viewBox="0 0 20 20"><path d="M10 2a8 8 0 100 16 8 8 0 000-16zm0 14a6 6 0 110-12 6 6 0 010 12z"/></svg>
                    Booking<span class="text-red-600">Lapangan</span>
                </a>
                <p class="mt-4 text-sm leading-relaxed text-gray-400">
                    Platform penyewaan lapangan olahraga #1. Cari, booking, dan mainkan olahraga favoritmu tanpa ribet.
                </p>
                
                <div class="flex space-x-4 mt-6">
                    <a href="#" class="text-gray-400 hover:text-white transition">
                        <span class="sr-only">Instagram</span>
                        <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-white transition">
                        <span class="sr-only">Twitter</span>
                        <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24"><path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84" /></svg>
                    </a>
                </div>
            </div>

            <div>
                <h3 class="text-sm font-bold text-white uppercase tracking-wider mb-4">Navigasi</h3>
                <ul class="space-y-3">
                    <li><a href="{{ route('welcome') }}" class="text-sm hover:text-white hover:underline decoration-red-500 underline-offset-4 transition">Beranda</a></li>
                    <li><a href="{{ route('katalog') }}" class="text-sm hover:text-white hover:underline decoration-red-500 underline-offset-4 transition">Cari Lapangan</a></li>
                    <li><a href="{{ route('pages.cara-pesan') }}" class="text-sm hover:text-white hover:underline decoration-red-500 underline-offset-4 transition">Cara Pesan</a></li>
                </ul>
            </div>

            <div>
                <h3 class="text-sm font-bold text-white uppercase tracking-wider mb-4">Perusahaan</h3>
                <ul class="space-y-3">
                    <li><a href="{{ route('pages.tentang-kami') }}" class="text-sm hover:text-white hover:underline decoration-red-500 underline-offset-4 transition">Tentang Kami</a></li>
                    
                    @if(Auth::check() && Auth::user()->role !== 'mitra' && !Auth::user()->is_admin)
                        <li><a href="{{ route('mitra.create') }}" class="text-sm font-bold text-red-400 hover:text-red-300 transition">Daftar Jadi Mitra</a></li>
                    @endif
                    
                    <li><a href="#" class="text-sm hover:text-white transition">Syarat & Ketentuan</a></li>
                    <li><a href="#" class="text-sm hover:text-white transition">Kebijakan Privasi</a></li>
                </ul>
            </div>

            <div>
                <h3 class="text-sm font-bold text-white uppercase tracking-wider mb-4">Hubungi Kami</h3>
                <ul class="space-y-4">
                    <li class="flex items-start">
                        <svg class="w-5 h-5 text-red-600 mr-3 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        <span class="text-sm">Jl. Koding No. 1, Jakarta Selatan, Indonesia</span>
                    </li>
                    <li class="flex items-center">
                        <svg class="w-5 h-5 text-red-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                        <span class="text-sm">(021) 123-4567</span>
                    </li>
                    <li class="flex items-center">
                        <svg class="w-5 h-5 text-red-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                        <span class="text-sm">info@bookinglapangan.com</span>
                    </li>
                </ul>
            </div>
        </div>

        <div class="border-t border-gray-800 pt-8 flex flex-col md:flex-row justify-between items-center">
            <p class="text-sm text-gray-500">&copy; {{ date('Y') }} Booking Lapangan. All rights reserved.</p>
            <div class="flex space-x-6 mt-4 md:mt-0">
                <span class="text-xs text-gray-600">Dibuat dengan Laravel & ❤️ oleh Kelompok Anda</span>
            </div>
        </div>
    </div>
</footer>