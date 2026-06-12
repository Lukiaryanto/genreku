@props(['active' => ''])

<aside class="w-64 fixed top-16 left-0 bg-blue-800 border-r border-blue-900/50 flex flex-col"
    style="height: calc(100vh - 4rem);">

    {{-- Brand Header --}}
    <div class="px-5 py-5 border-b border-blue-700/50">
        <div class="flex items-center gap-3">
            <div class="w-8 h-8 rounded-lg bg-blue-600 flex items-center justify-center flex-shrink-0">
                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3" />
                </svg>
            </div>
            <div>
                <div class="text-sm font-semibold text-white">Juri Panel</div>
                <p class="text-xs text-blue-200 leading-tight">Panel untuk tugas juri.</p>
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
                $link('dashboard',       'Dashboard',             '/juri'),
                $link('daftar_peserta',  'Daftar Peserta',        route('juri.daftar_peserta')),
                $link('nilai',           'Input Nilai Wawancara', route('juri.input_wawancara')),
                $link('project',         'Input Nilai Project',   route('juri.input_project')),
            ];
        @endphp

        <p class="px-3 mb-2 text-xs font-semibold text-blue-200 uppercase tracking-widest">Menu</p>

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

                            @case('daftar_peserta')
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
                            @break

                            @case('nilai')
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-3 3v-3z" />
                            @break

                            @case('project')
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                            @break

                            @case('penilaian')
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 17v-6a2 2 0 012-2h2a2 2 0 012 2v6" />
                            @break

                            @case('info')
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 16h-1v-4h-1" />
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