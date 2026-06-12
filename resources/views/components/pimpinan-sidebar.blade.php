@props(['active' => ''])

<aside class="w-64 fixed top-16 left-0 bg-blue-800 border-r border-blue-900/50 flex flex-col"
    style="height: calc(100vh - 4rem);">

    {{-- Brand Header --}}
    <div class="px-5 py-5 border-b border-blue-700/50">
        <div class="flex items-center gap-3">
            <div class="w-8 h-8 rounded-lg bg-blue-600 flex items-center justify-center flex-shrink-0 text-white">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                </svg>
            </div>
            <div>
                <div class="text-sm font-semibold text-white">Pimpinan</div>
                <p class="text-xs text-blue-200 leading-tight">Laporan & ringkasan.</p>
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
                $link('ringkasan', 'Ringkasan Peserta', route('pimpinan.ringkasan')),
                $link('nilai',     'Laporan Rekapitulasi',       route('pimpinan.rekap_nilai')),
            ];
        @endphp

        <p class="px-3 mb-2 text-xs font-semibold text-blue-200 uppercase tracking-widest">Menu Laporan</p>

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
                            @case('ringkasan')
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 12l2-2m0 0l7-7 7 7M13 5v6h6" />
                            @break

                            @case('daftar_peserta')
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
                            @break

                            @case('nilai')
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 17v-6a2 2 0 012-2h2a2 2 0 012 2v6" />
                            @break

                            @case('download')
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3" />
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
