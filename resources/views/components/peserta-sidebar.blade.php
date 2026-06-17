@props(['active' => ''])

{{-- Mobile Overlay --}}
<div id="sidebar-overlay"
    class="fixed inset-0 z-30 bg-black/50 backdrop-blur-sm lg:hidden transition-opacity duration-300"
    style="display:none;"
    onclick="closeSidebar()">
</div>

<aside id="peserta-sidebar"
    class="fixed top-16 left-0 z-40 w-64 bg-blue-800 border-r border-blue-900/50 flex flex-col
           transition-transform duration-300 ease-in-out"
    style="height: calc(100vh - 4rem); transform: translateX(-100%);">


    {{-- Brand Header --}}
    <div class="px-5 py-5 border-b border-blue-700/50">
        <div class="flex items-center gap-3">
            <div class="w-8 h-8 rounded-lg bg-blue-600 flex items-center justify-center flex-shrink-0">
                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
            </div>
            <div>
                <div class="text-sm font-semibold text-white">Peserta Panel</div>
                <p class="text-xs text-blue-200 leading-tight">Manajemen akun peserta.</p>
            </div>
        </div>
    </div>

    {{-- Navigation --}}
    <nav class="flex-1 px-3 py-4 overflow-y-auto">
        @php
            $link = fn($key, $label, $href = '#') => [
                'key' => $key,
                'label' => $label,
                'href' => $href,
            ];

            $links = [
                $link('dashboard', 'Dashboard', '/peserta'),
                $link('biodata',   'Biodata',   route('peserta.biodata.edit')),
                $link('soal',      'Ujian',     route('peserta.soal')),
            ];
        @endphp

        <p class="px-3 mb-2 text-xs font-semibold text-blue-200 uppercase tracking-widest">Menu Utama</p>

        @foreach ($links as $item)
            @php
                $isActive = $active === $item['key'];
            @endphp

            <a href="{{ $item['href'] }}"
                class="flex items-center gap-3 px-3 py-2.5 mt-0.5 rounded-lg text-sm transition group
                       {{ $isActive
                            ? 'bg-white/20 text-white font-medium shadow-md'
                            : 'text-blue-100 hover:bg-blue-700 hover:text-white' }}">

                <span class="w-8 h-8 rounded-md flex items-center justify-center flex-shrink-0 transition
                             {{ $isActive ? 'bg-white/20' : 'bg-blue-700 group-hover:bg-blue-600' }}">
                    <svg class="w-4 h-4 {{ $isActive ? 'text-white' : 'text-blue-200 group-hover:text-white' }}"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        @switch($item['key'])
                            @case('dashboard')
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 12l2-2m0 0l7-7 7 7M13 5v6h6" />
                            @break

                            @case('biodata')
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            @break

                            @case('soal')
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            @break
                        @endswitch
                    </svg>
                </span>

                {{ $item['label'] }}

                @if ($isActive)
                    <span class="ml-auto w-1.5 h-1.5 rounded-full bg-white/60"></span>
                @endif
            </a>
        @endforeach
    </nav>

    {{-- Logout --}}
    <div class="px-3 py-4 border-t border-blue-700/50">
        <form method="POST" action="{{ route('logout') }}"
            onsubmit="return confirm('Apakah Anda yakin ingin keluar?');">
            @csrf
            <button type="submit"
                class="w-full flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm text-blue-100
                       hover:bg-red-700/40 hover:text-red-100 transition group">
                <span class="w-8 h-8 rounded-md bg-blue-700 group-hover:bg-red-800/60 flex items-center justify-center flex-shrink-0 transition">
                    <svg class="w-4 h-4 text-blue-200 group-hover:text-red-200 transition" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                    </svg>
                </span>
                Logout
            </button>
        </form>
    </div>

</aside>
