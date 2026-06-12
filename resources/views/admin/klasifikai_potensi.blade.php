<x-admin-layout>
    @section('sidebar_active', 'klasifikasi')

    <div class="min-h-screen bg-white">
        <div class="w-full">
            <main class="flex-1 p-8 font-sans text-gray-800">
                <div class="mb-6">
                    <h1 class="text-2xl font-semibold text-gray-900">Klasifikasi Potensi</h1>
                    <p class="text-gray-500 mt-1 text-sm">Daftar hasil akhir klasifikasi (Sugeno Fuzzy) untuk setiap peserta di semua kategori.</p>
                </div>

                <div class="bg-white rounded-xl border border-gray-200 overflow-hidden shadow-sm">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead>
                                <tr class="bg-gray-50">
                                    <th rowspan="2" class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider border-b border-gray-200 align-middle">No</th>
                                    <th rowspan="2" class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider border-b border-gray-200 align-middle">Nama Peserta</th>
                                    <th colspan="2" class="px-6 py-2 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider border-b border-l border-gray-200">Tes Soal</th>
                                    <th colspan="2" class="px-6 py-2 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider border-b border-l border-gray-200">Wawancara</th>
                                    <th colspan="2" class="px-6 py-2 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider border-b border-l border-gray-200">Project</th>
                                    <th rowspan="2" class="px-6 py-4 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider border-b border-l border-gray-200 align-middle">Aksi</th>
                                </tr>
                                <tr class="bg-gray-50">
                                    <th class="px-4 py-2 text-center text-[10px] font-medium text-gray-500 uppercase tracking-wider border-l border-gray-200">Nilai (Z)</th>
                                    <th class="px-4 py-2 text-center text-[10px] font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                    <th class="px-4 py-2 text-center text-[10px] font-medium text-gray-500 uppercase tracking-wider border-l border-gray-200">Nilai (Z)</th>
                                    <th class="px-4 py-2 text-center text-[10px] font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                    <th class="px-4 py-2 text-center text-[10px] font-medium text-gray-500 uppercase tracking-wider border-l border-gray-200">Nilai (Z)</th>
                                    <th class="px-4 py-2 text-center text-[10px] font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-100">
                                @forelse ($pesertas as $peserta)
                                    @php
                                        $tesSoal   = $peserta->hasilFuzzies->where('kategori', 'tes_soal')->first();
                                        $wawancara = $peserta->hasilFuzzies->where('kategori', 'wawancara')->first();
                                        $project   = $peserta->hasilFuzzies->where('kategori', 'project')->first();

                                        $badgeClass = fn($status) => match($status) {
                                            'Sangat Kompeten' => 'bg-green-50 text-green-700 border-green-200',
                                            'Cukup Kompeten'  => 'bg-blue-50 text-blue-700 border-blue-200',
                                            'Kurang Kompeten' => 'bg-amber-50 text-amber-700 border-amber-200',
                                            default           => 'bg-gray-100 text-gray-500 border-gray-200',
                                        };
                                    @endphp
                                    <tr class="hover:bg-gray-50 transition-colors">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $loop->iteration }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $peserta->nama ?? '-' }}</td>

                                        <!-- Tes Soal -->
                                        <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-900 text-center font-semibold border-l border-gray-200">
                                            {{ $tesSoal ? number_format($tesSoal->nilai_hasil, 2) : '-' }}
                                        </td>
                                        <td class="px-4 py-4 whitespace-nowrap text-sm text-center">
                                            @if($tesSoal)
                                                <span class="inline-flex items-center px-2 py-1 rounded text-[10px] font-medium border {{ $badgeClass($tesSoal->status) }}">
                                                    {{ $tesSoal->status }}
                                                </span>
                                            @else
                                                <span class="text-gray-400 text-xs">-</span>
                                            @endif
                                        </td>

                                        <!-- Wawancara -->
                                        <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-900 text-center font-semibold border-l border-gray-200">
                                            {{ $wawancara ? number_format($wawancara->nilai_hasil, 2) : '-' }}
                                        </td>
                                        <td class="px-4 py-4 whitespace-nowrap text-sm text-center">
                                            @if($wawancara)
                                                <span class="inline-flex items-center px-2 py-1 rounded text-[10px] font-medium border {{ $badgeClass($wawancara->status) }}">
                                                    {{ $wawancara->status }}
                                                </span>
                                            @else
                                                <span class="text-gray-400 text-xs">-</span>
                                            @endif
                                        </td>

                                        <!-- Project -->
                                        <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-900 text-center font-semibold border-l border-gray-200">
                                            {{ $project ? number_format($project->nilai_hasil, 2) : '-' }}
                                        </td>
                                        <td class="px-4 py-4 whitespace-nowrap text-sm text-center">
                                            @if($project)
                                                <span class="inline-flex items-center px-2 py-1 rounded text-[10px] font-medium border {{ $badgeClass($project->status) }}">
                                                    {{ $project->status }}
                                                </span>
                                            @else
                                                <span class="text-gray-400 text-xs">-</span>
                                            @endif
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-center border-l border-gray-200">
                                            <a href="{{ route('admin.klasifikasi.show', $peserta->id) }}"
                                               class="inline-flex items-center px-3 py-1.5 bg-indigo-600/20 text-indigo-700 border border-indigo-500/30 hover:bg-indigo-600/40 text-xs font-medium rounded transition-colors">
                                                Lihat Detail
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="9" class="px-6 py-10 text-center text-gray-400 text-sm">Tidak ada data klasifikasi.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </main>
        </div>
    </div>
</x-admin-layout>