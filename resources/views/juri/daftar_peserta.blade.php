@section('sidebar_active', 'daftar_peserta')

<x-admin-layout>
    <main class="p-8 font-sans text-gray-800">
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-gray-900">Daftar Nilai Peserta</h1>
            <p class="text-gray-600 mt-2">Berikut daftar peserta beserta rekapitulasi detail nilai wawancara dan project.</p>
        </div>

        <div class="bg-white rounded-xl border border-gray-200 overflow-hidden shadow-sm">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th rowspan="2" scope="col" class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider border-b border-gray-200 align-middle">No</th>
                            <th rowspan="2" scope="col" class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider border-b border-gray-200 align-middle">Nama</th>
                            <th colspan="3" scope="col" class="px-4 py-2 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider border-b border-gray-200">Wawancara</th>
                            <th colspan="3" scope="col" class="px-4 py-2 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider border-b border-gray-200 border-l border-gray-200">Project</th>
                            <th rowspan="2" scope="col" class="px-4 py-3 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider border-b border-gray-200 align-middle border-l border-gray-200">Status</th>
                            <th rowspan="2" scope="col" class="px-4 py-3 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider border-b border-gray-200 align-middle">Aksi</th>
                        </tr>
                        <tr>
                            <!-- Wawancara Details -->
                            <th scope="col" class="px-2 py-2 text-center text-[10px] font-semibold text-gray-600 uppercase tracking-wider" title="Public Speaking">PS</th>
                            <th scope="col" class="px-2 py-2 text-center text-[10px] font-semibold text-gray-600 uppercase tracking-wider" title="Wawasan GenRe">WG</th>
                            <th scope="col" class="px-2 py-2 text-center text-[10px] font-semibold text-gray-600 uppercase tracking-wider" title="Kepemimpinan">Kep</th>
                            <!-- Project Details -->
                            <th scope="col" class="px-2 py-2 text-center text-[10px] font-semibold text-gray-600 uppercase tracking-wider border-l border-gray-200" title="Public Speaking">PS</th>
                            <th scope="col" class="px-2 py-2 text-center text-[10px] font-semibold text-gray-600 uppercase tracking-wider" title="Wawasan GenRe">WG</th>
                            <th scope="col" class="px-2 py-2 text-center text-[10px] font-semibold text-gray-600 uppercase tracking-wider" title="Kepemimpinan">Kep</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse ($pesertas as $peserta)
                            @php
                                $wawancara = $peserta->penilaians->where('kategori', 'wawancara')->first();
                                $project = $peserta->penilaians->where('kategori', 'project')->first();
                                $sudahDinilai = ($wawancara || $project);
                            @endphp
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-600">{{ $loop->iteration }}</td>
                                <td class="px-4 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $peserta->nama ?? $peserta->user?->name ?? 'Peserta' }}</td>
                                
                                <!-- Wawancara Scores -->
                                <td class="px-2 py-4 whitespace-nowrap text-sm text-gray-600 text-center">{{ $wawancara->public_speaking ?? '-' }}</td>
                                <td class="px-2 py-4 whitespace-nowrap text-sm text-gray-600 text-center">{{ $wawancara->wawasan_genre ?? '-' }}</td>
                                <td class="px-2 py-4 whitespace-nowrap text-sm text-gray-600 text-center">{{ $wawancara->kepemimpinan ?? '-' }}</td>
                                
                                <!-- Project Scores -->
                                <td class="px-2 py-4 whitespace-nowrap text-sm text-gray-600 text-center border-l border-gray-200">{{ $project->public_speaking ?? '-' }}</td>
                                <td class="px-2 py-4 whitespace-nowrap text-sm text-gray-600 text-center">{{ $project->wawasan_genre ?? '-' }}</td>
                                <td class="px-2 py-4 whitespace-nowrap text-sm text-gray-600 text-center">{{ $project->kepemimpinan ?? '-' }}</td>
                                
                                <td class="px-4 py-4 whitespace-nowrap text-sm text-center border-l border-gray-200">
                                    @if($sudahDinilai)
                                        <span class="inline-flex items-center px-2 py-1 rounded-md text-xs font-medium bg-emerald-100 text-emerald-800 border border-emerald-200">
                                            Sudah dinilai
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2 py-1 rounded-md text-xs font-medium bg-orange-100 text-orange-800 border border-orange-200">
                                            Belum dinilai
                                        </span>
                                    @endif
                                </td>
                                <td class="px-4 py-4 whitespace-nowrap text-sm text-center">
                                    <div class="flex items-center justify-center space-x-4">
                                        @if ($wawancara)
                                            <div class="flex items-center gap-1.5 px-2 py-1 bg-gray-100 rounded-lg border border-gray-200">
                                                <span class="text-[10px] text-indigo-600 uppercase font-black" title="Wawancara">W</span>
                                                <a href="{{ route('penilaian.edit', $wawancara->id) }}"
                                                    class="text-gray-500 hover:text-indigo-600 transition-colors" title="Edit Wawancara">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                                    </svg>
                                                </a>
                                            </div>
                                        @else
                                            <a href="{{ route('juri.input_wawancara', ['peserta_id' => $peserta->id]) }}" class="flex items-center gap-1.5 px-2 py-1 bg-indigo-50 hover:bg-indigo-100 rounded-lg border border-indigo-200 transition-colors" title="Input Wawancara">
                                                <span class="text-[10px] text-indigo-600 uppercase font-black">W</span>
                                                <svg class="w-4 h-4 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                                </svg>
                                            </a>
                                        @endif

                                        @if ($project)
                                            <div class="flex items-center gap-1.5 px-2 py-1 bg-gray-100 rounded-lg border border-gray-200">
                                                <span class="text-[10px] text-emerald-600 uppercase font-black" title="Project">P</span>
                                                <a href="{{ route('penilaian.edit', $project->id) }}"
                                                    class="text-gray-500 hover:text-emerald-600 transition-colors" title="Edit Project">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                                    </svg>
                                                </a>
                                            </div>
                                        @else
                                            <a href="{{ route('juri.input_project', ['peserta_id' => $peserta->id]) }}" class="flex items-center gap-1.5 px-2 py-1 bg-emerald-50 hover:bg-emerald-100 rounded-lg border border-emerald-200 transition-colors" title="Input Project">
                                                <span class="text-[10px] text-emerald-600 uppercase font-black">P</span>
                                                <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                                </svg>
                                            </a>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="10" class="px-6 py-8 text-center text-gray-500">Tidak ada data peserta.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</x-admin-layout>
