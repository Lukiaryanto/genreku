@props(['active' => ''])

<aside class="w-64 fixed top-16 left-0 bg-blue-800 border-r border-blue-900/50 flex flex-col"
    style="height: calc(100vh - 4rem);">

    {{-- Brand Header --}}
    <div class="px-5 py-5 border-b border-blue-700/50">
        <div class="flex items-center gap-3">
            <div class="w-8 h-8 rounded-lg bg-blue-600 flex items-center justify-center flex-shrink-0">
                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                </svg>
            </div>
            <div>
                <div class="text-sm font-semibold text-white">Admin Panel</div>
                <p class="text-xs text-blue-200 leading-tight">Control panel manajemen</p>
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
                $link('dashboard',   'Dashboard',           '/admin'),
                $link('users',       'Data Peserta',        '/users'),
                $link('events',      'Data Juri',           route('admin.juri.index')),
                $link('pimpinan',    'Data Pimpinan',       route('admin.data_pimpinan.index')),
                $link('tests',       'Kelola Tes Soal',     route('admin.data_soal')),
                $link('klasifikasi', 'Klasifikasi Potensi', route('admin.klasifikasi.index')),
                $link('fuzzy_config', 'Pengaturan Fuzzy',    route('admin.fuzzy_config.index')),
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

                            @case('users')
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5.121 17.804A13.937 13.937 0 0112 15c2.5 0 4.847.63 6.879 1.804M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            @break

                            @case('events')
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 17v-6a2 2 0 012-2h2a2 2 0 012 2v6" />
                            @break

                            @case('pimpinan')
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
                            @break

                            @case('tests')
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            @break

                            @case('klasifikasi')
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                            @break

                            @case('fuzzy_config')
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.066 2.573c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.573 1.066c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.066-2.573c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            @break

                            @case('reports')
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3" />
                            @break

                            @case('settings')
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8c1.657 0 3-1.343 3-3S13.657 2 12 2 9 3.343 9 5s1.343 3 3 3zM6 20v-1a4 4 0 014-4h4a4 4 0 014 4v1" />
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
        <form method="POST" action="{{ route('logout') }}" onsubmit="return confirm('Apakah Anda yakin ingin keluar?');">
            @csrf
            <button type="submit"
                class="w-full flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm text-blue-100
                       hover:bg-red-700/40 hover:text-red-100 transition group">
                <span class="w-8 h-8 rounded-md bg-blue-700 group-hover:bg-red-800/60 flex items-center justify-center flex-shrink-0 transition">
                    <svg class="w-4 h-4 text-blue-200 group-hover:text-red-200 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                    </svg>
                </span>
                Logout
            </button>
        </form>
    </div>

</aside>