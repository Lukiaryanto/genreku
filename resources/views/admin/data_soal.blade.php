<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $title ?? 'Data Soal' }}
        </h2>
    </x-slot>

    @section('sidebar_active', 'tests')

    <div class="min-h-screen bg-white">
        <div class="w-full">
            <main class="flex-1 p-6">

                {{-- Success Alert --}}
                @if (session('success'))
                    <div class="mb-5 flex items-center gap-3 px-4 py-3 bg-green-100 border border-green-200 text-green-800 text-sm rounded-lg">
                        <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        {{ session('success') }}
                    </div>
                @endif

                {{-- Header --}}
                <div class="flex items-center justify-between mb-6">
                    <div class="flex items-center gap-3">
                        <div class="w-9 h-9 rounded-lg bg-indigo-100 flex items-center justify-center">
                            <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs text-gray-600">Admin / Tests</p>
                            <h2 class="text-base font-semibold text-gray-900 leading-tight">{{ $title ?? 'Data Soal' }}</h2>
                            <p class="text-xs text-gray-500 mt-0.5">Kelola soal ujian di sini.</p>
                        </div>
                    </div>
                    <a href="{{ route('admin.soal.create') }}" class="inline-flex items-center gap-2 px-5 py-3 bg-indigo-600 hover:bg-indigo-500 text-white text-base font-semibold rounded-lg shadow-md transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        Tambah Soal
                    </a>
                </div>

                {{-- Table Card --}}
                <div class="bg-white border border-gray-200 rounded-xl shadow-lg overflow-hidden">

                    @if (isset($soals) && $soals->count())
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200 text-sm">
                                <thead class="bg-gray-300">
                                    <tr>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-800 uppercase tracking-wider">No</th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-800 uppercase tracking-wider">Pertanyaan</th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-800 uppercase tracking-wider">Opsi A</th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-800 uppercase tracking-wider">Opsi B</th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-800 uppercase tracking-wider">Opsi C</th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-800 uppercase tracking-wider">Opsi D</th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-800 uppercase tracking-wider">Jawaban</th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-800 uppercase tracking-wider">Kategori</th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-800 uppercase tracking-wider">Dibuat</th>
                                        <th class="px-4 py-3 text-right text-xs font-medium text-gray-800 uppercase tracking-wider">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200">
                                    @foreach ($soals as $s)
                                        @php
                                            $labels = [
                                                'public_speaking' => ['label' => 'Public Speaking', 'class' => 'bg-indigo-100 text-indigo-800 border-indigo-200'],
                                                'wawasan_genre'   => ['label' => 'Wawasan Genre',   'class' => 'bg-teal-100 text-teal-800 border-teal-200'],
                                                'kepemimpinan'    => ['label' => 'Kepemimpinan',    'class' => 'bg-amber-100 text-amber-800 border-amber-200'],
                                            ];
                                            $kat = $labels[$s->kategori] ?? ['label' => '-', 'class' => 'bg-gray-200 text-gray-700 border-gray-300'];
                                        @endphp
                                        <tr class="align-top hover:bg-gray-200 odd:bg-gray-50 transition">
                                            <td class="px-4 py-3 text-gray-800">{{ $loop->iteration }}</td>
                                            <td class="px-4 py-3 text-gray-800 max-w-xs">
                                                <p class="line-clamp-2 leading-snug">{{ $s->pertanyaan }}</p>
                                            </td>
                                            <td class="px-4 py-3 text-gray-700">{{ $s->opsi_a }}</td>
                                            <td class="px-4 py-3 text-gray-700">{{ $s->opsi_b }}</td>
                                            <td class="px-4 py-3 text-gray-700">{{ $s->opsi_c }}</td>
                                            <td class="px-4 py-3 text-gray-700">{{ $s->opsi_d }}</td>
                                            <td class="px-4 py-3">
                                                <span class="inline-flex items-center justify-center w-7 h-7 rounded-lg bg-green-900/50 border border-green-700 text-green-300 text-xs font-bold">
                                                    {{ strtoupper($s->jawaban_benar) }}
                                                </span>
                                            </td>
                                            <td class="px-4 py-3">
                                                <span class="inline-flex items-center px-2 py-1 rounded-md border text-xs {{ $kat['class'] }}">
                                                    {{ $kat['label'] }}
                                                </span>
                                            </td>
                                            <td class="px-4 py-3 text-gray-700 text-xs whitespace-nowrap">
                                                {{ $s->created_at ? $s->created_at->format('Y-m-d') : '-' }}
                                            </td>
                                            <td class="px-4 py-3 text-right">
                                                <div class="inline-flex gap-2">
                                                    <a href="{{ route('admin.soal.edit', $s->id) }}"
                                                        class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-yellow-600 hover:bg-yellow-500 text-white border border-yellow-700 rounded-lg text-xs transition">
                                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                        </svg>
                                                        Edit
                                                    </a>
                                                    <form method="POST"
                                                        action="{{ route('admin.soal.destroy', $s->id) }}"
                                                        onsubmit="return confirm('Hapus soal ini?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-red-600 hover:bg-red-500 text-white border border-red-700 rounded-lg text-xs transition">
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
                    @else
                        <div class="flex flex-col items-center justify-center py-16 text-center">
                            <svg class="w-12 h-12 text-gray-600 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            <p class="text-sm text-gray-400 font-medium">Belum ada data soal</p>
                            <p class="text-xs text-gray-600 mt-1">Tambahkan soal melalui seeder atau admin CRUD.</p>
                        </div>
                    @endif

                </div>

            </main>
        </div>
    </div>

</x-admin-layout>