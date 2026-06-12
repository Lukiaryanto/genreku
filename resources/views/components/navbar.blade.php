<nav class="bg-gradient-to-r from-blue-800 to-blue-700 shadow-lg sticky top-0 z-50 border-b border-blue-600/50">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex h-[72px] items-center justify-between">
            <div class="flex items-center gap-3">
                <a href="/" class="flex items-center gap-3 group">
                    <div class="w-10 h-10 bg-white/10 rounded-xl p-1.5 backdrop-blur-sm border border-white/20 group-hover:bg-white/20 transition-all">
                        <img src="{{ asset('images/logo-genre.png') }}" alt="Logo GenRe" class="w-full h-full object-contain drop-shadow-md" />
                    </div>
                    <span class="text-white font-bold text-lg tracking-wide hidden sm:block group-hover:text-blue-100 transition-colors">Forum GenRe Kuningan</span>
                </a>
            </div>
            
            <div class="hidden md:block">
                <div class="ml-10 flex items-center space-x-8">
                    <a href="/" aria-current="page"
                        class="{{ request()->is('/') ? 'text-white font-semibold after:content-[\'\'] after:absolute after:w-full after:h-0.5 after:bg-white after:bottom-0 after:left-0' : 'text-blue-100 hover:text-white font-medium relative hover:after:content-[\'\'] hover:after:absolute hover:after:w-full hover:after:h-0.5 hover:after:bg-blue-300 hover:after:bottom-0 hover:after:left-0' }} relative py-2 text-sm transition-all duration-300">
                        Beranda
                    </a>
                    <a href="/about"
                        class="{{ request()->is('about') ? 'text-white font-semibold after:content-[\'\'] after:absolute after:w-full after:h-0.5 after:bg-white after:bottom-0 after:left-0' : 'text-blue-100 hover:text-white font-medium relative hover:after:content-[\'\'] hover:after:absolute hover:after:w-full hover:after:h-0.5 hover:after:bg-blue-300 hover:after:bottom-0 hover:after:left-0' }} relative py-2 text-sm transition-all duration-300">
                        Tentang Kami
                    </a>
                    
                    <a href="/login"
                        class="ml-2 inline-flex items-center justify-center gap-2 rounded-full bg-white px-6 py-2.5 text-sm font-bold text-blue-700 shadow-md hover:bg-blue-50 hover:shadow-lg hover:-translate-y-0.5 transition-all duration-300">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                        </svg>
                        Masuk
                    </a>
                </div>
            </div>
            <div class="-mr-2 flex md:hidden">
                <!-- Mobile menu button -->
                <button type="button" command="--toggle" commandfor="mobile-menu"
                    class="relative inline-flex items-center justify-center rounded-lg p-2 text-blue-100 hover:bg-white/10 hover:text-white focus:outline-none transition-colors">
                    <span class="absolute -inset-0.5"></span>
                    <span class="sr-only">Buka menu utama</span>
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" data-slot="icon"
                        aria-hidden="true" class="size-6 in-aria-expanded:hidden">
                        <path d="M4 6h16M4 12h16M4 18h16" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" data-slot="icon"
                        aria-hidden="true" class="size-6 not-in-aria-expanded:hidden">
                        <path d="M6 18 18 6M6 6l12 12" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <el-disclosure id="mobile-menu" hidden class="block md:hidden bg-blue-800/95 backdrop-blur-md border-t border-blue-700 absolute w-full shadow-xl">
        <div class="space-y-2 px-4 pt-3 pb-6">
            <a href="/" aria-current="page"
                class="{{ request()->is('/') ? 'bg-blue-900/50 text-white' : 'text-blue-100 hover:bg-blue-700/50 hover:text-white' }} block rounded-xl px-4 py-3 text-base font-semibold transition-colors">
                Beranda
            </a>
            <a href="/about" aria-current="page"
                class="{{ request()->is('about') ? 'bg-blue-900/50 text-white' : 'text-blue-100 hover:bg-blue-700/50 hover:text-white' }} block rounded-xl px-4 py-3 text-base font-semibold transition-colors">
                Tentang Kami
            </a>
            <div class="pt-4 mt-2 border-t border-blue-700/50">
                <a href="/login"
                    class="flex items-center justify-center gap-2 w-full rounded-xl bg-white px-4 py-3 text-base font-bold text-blue-700 shadow hover:bg-blue-50 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                    </svg>
                    Masuk
                </a>
            </div>
        </div>
    </el-disclosure>
</nav>
