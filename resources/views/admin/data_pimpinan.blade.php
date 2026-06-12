@section('sidebar_active', 'pimpinan')

<x-admin-layout>
    <main class="p-6">
        {{-- Header --}}
        <div class="flex items-center justify-between mb-6">
                    <div class="flex items-center gap-3">
                        <div class="w-9 h-9 rounded-lg bg-indigo-900 flex items-center justify-center">
                            <svg class="w-5 h-5 text-indigo-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500">Admin / Pimpinan</p>
                            <h3 class="text-base font-semibold text-white leading-tight">Daftar Pimpinan</h3>
                        </div>
                    </div>
                    <a href="{{ route('admin.pimpinan.create') }}"
                        class="inline-flex items-center gap-2 px-5 py-2.5 bg-indigo-700 hover:bg-indigo-600 text-white text-sm font-semibold rounded-md shadow-md transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        Tambah Pimpinan
                    </a>
                </div>

                {{-- Table Card --}}
                <div class="bg-white border border-gray-200 rounded-xl shadow-lg overflow-hidden">
                    @if (isset($pimpinans) && $pimpinans->count())
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-100">
                                    <tr>
                                        <th class="px-5 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider w-12">
                                            No
                                        </th>
                                        <th class="px-5 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">
                                            Nama
                                        </th>
                                        <th class="px-5 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">
                                            Jabatan
                                        </th>
                                        <th class="px-5 py-3 text-right text-xs font-medium text-gray-400 uppercase tracking-wider">
                                            Aksi
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200">
                                    @foreach ($pimpinans as $p)
                                        @php
                                            $initials = collect(explode(' ', $p->nama ?? 'N A'))
                                                ->map(fn($w) => strtoupper($w[0] ?? ''))
                                                ->take(2)
                                                ->implode('');
                                            $colors = ['bg-indigo-900 text-indigo-300', 'bg-teal-900 text-teal-300', 'bg-amber-900 text-amber-300', 'bg-pink-900 text-pink-300'];
                                            $color = $colors[$loop->index % count($colors)];
                                        @endphp
                                        <tr class="hover:bg-gray-100 transition">
                                            <td class="px-5 py-4 text-sm text-gray-600">
                                                {{ $loop->iteration + ($pimpinans->currentPage() - 1) * $pimpinans->perPage() }}
                                            </td>
                                            <td class="px-5 py-4">
                                                <div class="flex items-center gap-3">
                                                    <div class="w-8 h-8 rounded-full {{ $color }} flex items-center justify-center text-xs font-semibold flex-shrink-0">
                                                        {{ $initials }}
                                                    </div>
                                                    <span class="text-sm font-medium text-black">{{ $p->nama ?? '-' }}</span>
                                                </div>
                                            </td>
                                            <td class="px-5 py-4 text-sm text-gray-600">
                                                {{ $p->jabatan ?? '-' }}
                                            </td>
                                            <td class="px-5 py-4 text-right">
                                                <div class="inline-flex gap-2">
                                                    <a href="{{ route('admin.pimpinan.edit', $p->id) }}"
                                                        class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-blue-600 hover:bg-blue-700 text-white border border-blue-600 rounded-full text-xs transition shadow-sm">
                                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                        </svg>
                                                        Edit
                                                    </a>
                                                    <form action="{{ route('admin.pimpinan.destroy', $p->id) }}"
                                                        method="POST" class="inline"
                                                        onsubmit="return confirm('Hapus pimpinan ini?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-red-600 hover:bg-red-700 text-white border border-red-600 rounded-full text-xs transition shadow-md focus:outline-none focus:ring-2 focus:ring-red-500">
                                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                            </svg>
                                                            Hapus
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        {{-- Pagination --}}
                        <div class="px-5 py-3 border-t border-gray-200 flex items-center justify-between">
                            <p class="text-xs text-gray-500">
                                Menampilkan {{ $pimpinans->firstItem() }}–{{ $pimpinans->lastItem() }}
                                dari {{ $pimpinans->total() }} data
                            </p>
                            <div>{{ $pimpinans->links() }}</div>
                        </div>
                    @else
                        <div class="flex flex-col items-center justify-center py-16 text-center">
                            <svg class="w-12 h-12 text-gray-600 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <p class="text-sm text-gray-400 font-medium">Tidak ada data pimpinan</p>
                            <p class="text-xs text-gray-600 mt-1">Mulai dengan menambahkan pimpinan baru</p>
                        </div>
                    @endif
                </div>

            </main>
</x-admin-layout>