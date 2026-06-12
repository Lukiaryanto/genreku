@props(['title' => ''])

<header class="fixed top-0 left-0 right-0 z-50 bg-blue-700 border-b border-blue-800/50 shadow-md">
    <div class="w-full px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">
            
            {{-- Title Section --}}
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 flex items-center justify-center">
                    <img src="{{ asset('images/logo-genre.png') }}" alt="Logo GenRe" class="w-full h-full object-contain drop-shadow-md" />
                </div>
                <div>
                    <h2 class="text-sm font-bold text-white tracking-wide uppercase">{{ $title ?: 'FORUM GENRE KUNINGAN' }}</h2>

                </div>
            </div>

            {{-- User Profile Section --}}
            <div class="flex items-center gap-4">
                <div class="flex flex-col items-end">
                    <span class="text-sm font-semibold text-white leading-none">{{ Auth::user()->name ?? 'Peserta' }}</span>
                    <span class="text-[10px] text-blue-200 font-bold uppercase tracking-tighter mt-1">Peserta Terverifikasi</span>
                </div>
                
                <div class="relative group">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-blue-400 to-blue-600 flex items-center justify-center text-white font-black shadow-lg shadow-blue-900/40 border border-blue-300/30 group-hover:scale-105 transition-transform duration-200">
                        {{ strtoupper(substr(Auth::user()->name ?? 'P', 0, 1)) }}
                    </div>
                    <div class="absolute -bottom-0.5 -right-0.5 w-3.5 h-3.5 bg-green-400 border-2 border-blue-700 rounded-full"></div>
                </div>
            </div>

        </div>
    </div>
</header>

