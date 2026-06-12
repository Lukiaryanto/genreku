<x-admin-layout>
    <main class="p-8 font-sans text-gray-800 print:bg-white print:p-0">
        {{-- Header Section - Hidden on Print if needed, but usually we want report title --}}
        <div class="flex items-center justify-between mb-8 print:hidden">
            <div>
                <h1 class="text-2xl font-bold text-gray-900 tracking-tight">Laporan Rekapitulasi Penilaian</h1>
                <p class="text-gray-500 mt-2">Daftar lengkap hasil seleksi dan klasifikasi seluruh peserta.</p>
            </div>
            <button onclick="window.print()" class="inline-flex items-center gap-2 px-5 py-2.5 bg-blue-600 hover:bg-blue-500 text-white font-semibold rounded-xl transition shadow-lg shadow-blue-900/40">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                </svg>
                Unduh PDF (Cetak)
            </button>
        </div>

        {{-- Report Content --}}
        <div class="bg-white rounded-2xl border border-gray-200 shadow-xl overflow-hidden print:bg-white print:border-none print:shadow-none">
            {{-- Print-only Report Header --}}
            <div class="hidden print:block p-8 border-b border-gray-200 text-center">
                <h1 class="text-2xl font-bold text-gray-900 uppercase">Laporan Rekapitulasi Penilaian</h1>
                <p class="text-gray-600 mt-1">Forum GenRe Kabupaten Kuningan</p>
                <div class="mt-4 text-sm text-gray-500">Tanggal Cetak: {{ date('d F Y') }}</div>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 print:divide-gray-300">
                    <thead class="bg-gray-50 print:bg-gray-100">
                        <tr>
                            <th rowspan="2" scope="col" class="col-no px-3 py-4 text-center text-[10px] font-bold text-gray-500 uppercase tracking-wider print:text-gray-700 align-middle">No</th>
                            <th rowspan="2" scope="col" class="col-nama px-3 py-4 text-left text-[10px] font-bold text-gray-500 uppercase tracking-wider print:text-gray-700 align-middle">Nama Lengkap</th>
                            <th rowspan="2" scope="col" class="col-lp px-3 py-4 text-center text-[10px] font-bold text-gray-500 uppercase tracking-wider print:text-gray-700 align-middle">L/P</th>
                            <th rowspan="2" scope="col" class="col-hp px-3 py-4 text-center text-[10px] font-bold text-gray-500 uppercase tracking-wider print:text-gray-700 align-middle">No. HP</th>
                            <th rowspan="2" scope="col" class="col-email px-3 py-4 text-center text-[10px] font-bold text-gray-500 uppercase tracking-wider print:text-gray-700 align-middle">Email</th>
                            <th rowspan="2" scope="col" class="col-alamat px-3 py-4 text-center text-[10px] font-bold text-gray-500 uppercase tracking-wider print:text-gray-700 align-middle">Alamat</th>
                            <th rowspan="2" scope="col" class="col-instansi px-3 py-4 text-center text-[10px] font-bold text-gray-500 uppercase tracking-wider print:text-gray-700 align-middle">Asal Instansi</th>
                            <th colspan="2" scope="col" class="px-3 py-2 text-center text-[10px] font-bold text-gray-500 uppercase tracking-wider print:text-gray-700 border-l border-gray-200 print:border-gray-300">Tes Soal</th>
                            <th colspan="2" scope="col" class="px-3 py-2 text-center text-[10px] font-bold text-gray-500 uppercase tracking-wider print:text-gray-700 border-l border-gray-200 print:border-gray-300">Wawancara</th>
                            <th colspan="2" scope="col" class="px-3 py-2 text-center text-[10px] font-bold text-gray-500 uppercase tracking-wider print:text-gray-700 border-l border-gray-200 print:border-gray-300">Project</th>
                        </tr>
                        <tr>
                            {{-- Tes Soal --}}
                            <th scope="col" class="col-nilai px-2 py-2 text-center text-[9px] font-bold text-gray-600 uppercase border-l border-gray-200 print:border-gray-300">Nilai (Z)</th>
                            <th scope="col" class="col-status px-2 py-2 text-center text-[9px] font-bold text-gray-600 uppercase">Status</th>
                            {{-- Wawancara --}}
                            <th scope="col" class="col-nilai px-2 py-2 text-center text-[9px] font-bold text-gray-600 uppercase border-l border-gray-200 print:border-gray-300">Nilai (Z)</th>
                            <th scope="col" class="col-status px-2 py-2 text-center text-[9px] font-bold text-gray-600 uppercase">Status</th>
                            {{-- Project --}}
                            <th scope="col" class="col-nilai px-2 py-2 text-center text-[9px] font-bold text-gray-600 uppercase border-l border-gray-200 print:border-gray-300">Nilai (Z)</th>
                            <th scope="col" class="col-status px-2 py-2 text-center text-[9px] font-bold text-gray-600 uppercase">Status</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200 print:bg-white print:divide-gray-200">
                        @foreach ($pesertas as $index => $p)
                            @php
                                $tesSoal = $p->hasilFuzzies->where('kategori', 'tes_soal')->first();
                                $wawancara = $p->hasilFuzzies->where('kategori', 'wawancara')->first();
                                $project = $p->hasilFuzzies->where('kategori', 'project')->first();
                            @endphp
                            <tr class="hover:bg-gray-50 transition-colors print:hover:bg-transparent">
                                <td class="px-3 py-4 whitespace-nowrap text-xs text-center text-gray-600 print:text-gray-600">{{ $index + 1 }}</td>
                                <td class="px-3 py-4 text-xs font-semibold text-gray-900 print:text-gray-900 text-left">{{ $p->nama }}</td>
                                <td class="px-3 py-4 whitespace-nowrap text-xs text-center text-gray-600 print:text-gray-700">{{ $p->jenis_kelamin == 'Laki-laki' ? 'L' : 'P' }}</td>
                                <td class="px-3 py-4 whitespace-nowrap text-xs text-center text-gray-600 print:text-gray-700">{{ $p->no_hp ?? '-' }}</td>
                                <td class="px-3 py-4 text-xs text-center text-gray-600 print:text-gray-700 break-all">{{ $p->user->email ?? '-' }}</td>
                                <td class="px-3 py-4 text-xs text-center text-gray-600 print:text-gray-700">{{ $p->alamat ?? '-' }}</td>
                                <td class="px-3 py-4 text-xs text-center text-gray-600 print:text-gray-700">{{ $p->asal_instansi ?? '-' }}</td>
                                
                                {{-- Tes Soal --}}
                                <td class="px-2 py-4 whitespace-nowrap text-xs text-center font-mono text-blue-600 print:text-blue-700 border-l border-gray-200 print:border-gray-300">
                                    {{ $tesSoal ? number_format($tesSoal->nilai_hasil, 2) : '-' }}
                                </td>
                                <td class="px-2 py-4 whitespace-nowrap text-center">
                                    @if($tesSoal)
                                        @php
                                            $c = 'bg-gray-100 text-gray-600';
                                            if($tesSoal->status == 'Sangat Kompeten') $c = 'bg-emerald-100 text-emerald-700 border border-emerald-200 print:bg-emerald-100 print:text-emerald-800 print:border-emerald-300';
                                            elseif($tesSoal->status == 'Cukup Kompeten') $c = 'bg-blue-100 text-blue-700 border border-blue-200 print:bg-blue-100 print:text-blue-800 print:border-blue-300';
                                            elseif($tesSoal->status == 'Kurang Kompeten') $c = 'bg-orange-100 text-orange-700 border border-orange-200 print:bg-orange-100 print:text-orange-800 print:border-orange-300';
                                        @endphp
                                        <span class="inline-flex items-center px-1.5 py-0.5 rounded text-[9px] font-bold uppercase {{ $c }} print-badge">
                                            {{ $tesSoal->status }}
                                        </span>
                                    @else
                                        <span class="text-gray-500 text-[10px]">-</span>
                                    @endif
                                </td>

                                {{-- Wawancara --}}
                                <td class="px-2 py-4 whitespace-nowrap text-xs text-center font-mono text-emerald-600 print:text-emerald-700 border-l border-gray-200 print:border-gray-300">
                                    {{ $wawancara ? number_format($wawancara->nilai_hasil, 2) : '-' }}
                                </td>
                                <td class="px-2 py-4 whitespace-nowrap text-center">
                                    @if($wawancara)
                                        @php
                                            $c = 'bg-gray-100 text-gray-600';
                                            if($wawancara->status == 'Sangat Kompeten') $c = 'bg-emerald-100 text-emerald-700 border border-emerald-200 print:bg-emerald-100 print:text-emerald-800 print:border-emerald-300';
                                            elseif($wawancara->status == 'Cukup Kompeten') $c = 'bg-blue-100 text-blue-700 border border-blue-200 print:bg-blue-100 print:text-blue-800 print:border-blue-300';
                                            elseif($wawancara->status == 'Kurang Kompeten') $c = 'bg-orange-100 text-orange-700 border border-orange-200 print:bg-orange-100 print:text-orange-800 print:border-orange-300';
                                        @endphp
                                        <span class="inline-flex items-center px-1.5 py-0.5 rounded text-[9px] font-bold uppercase {{ $c }} print-badge">
                                            {{ $wawancara->status }}
                                        </span>
                                    @else
                                        <span class="text-gray-500 text-[10px]">-</span>
                                    @endif
                                </td>

                                {{-- Project --}}
                                <td class="px-2 py-4 whitespace-nowrap text-xs text-center font-mono text-orange-600 print:text-orange-700 border-l border-gray-200 print:border-gray-300">
                                    {{ $project ? number_format($project->nilai_hasil, 2) : '-' }}
                                </td>
                                <td class="px-2 py-4 whitespace-nowrap text-center">
                                    @if($project)
                                        @php
                                            $c = 'bg-gray-100 text-gray-600';
                                            if($project->status == 'Sangat Kompeten') $c = 'bg-emerald-100 text-emerald-700 border border-emerald-200 print:bg-emerald-100 print:text-emerald-800 print:border-emerald-300';
                                            elseif($project->status == 'Cukup Kompeten') $c = 'bg-blue-100 text-blue-700 border border-blue-200 print:bg-blue-100 print:text-blue-800 print:border-blue-300';
                                            elseif($project->status == 'Kurang Kompeten') $c = 'bg-orange-100 text-orange-700 border border-orange-200 print:bg-orange-100 print:text-orange-800 print:border-orange-300';
                                        @endphp
                                        <span class="inline-flex items-center px-1.5 py-0.5 rounded text-[9px] font-bold uppercase {{ $c }} print-badge">
                                            {{ $project->status }}
                                        </span>
                                    @else
                                        <span class="text-gray-500 text-[10px]">-</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Footer for print --}}
            <div class="hidden print:block mt-12 px-8 pb-12">
                <div class="flex justify-between">
                    <div class="text-center">
                        <p class="text-sm text-gray-600">Mengetahui,</p>
                        <p class="text-sm font-bold text-gray-900 mt-16 underline">Ketua Forum GenRe</p>
                    </div>
                    <div class="text-center">
                        <p class="text-sm text-gray-600">Dicetak Pada,</p>
                        <p class="text-sm font-bold text-gray-900 mt-16">{{ date('d F Y') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <style>
        @media print {
            @page {
                size: landscape;
                margin: 10mm;
            }
            body {
                background-color: white !important;
                color: black !important;
                margin: 0 !important;
                padding: 0 !important;
                width: 100% !important;
            }
            /* Hide non-essential elements */
            nav, aside, header, footer, .print\:hidden, button, .sidebar, .navbar {
                display: none !important;
            }
            /* Reset layout constraints */
            main {
                padding: 0 !important;
                margin: 0 !important;
                width: 100% !important;
                max-width: none !important;
            }
            .pl-64, .pt-16 {
                padding-left: 0 !important;
                padding-top: 0 !important;
            }
            /* Table optimization for print */
            .bg-gray-800 {
                background-color: white !important;
                border: none !important;
            }
            table {
                width: 100% !important;
                border-collapse: collapse !important;
                table-layout: fixed !important; /* Force fit */
            }
            th, td {
                border: 1px solid #ddd !important;
                padding: 4px 2px !important;
                font-size: 7pt !important; /* Extremely compact */
                word-wrap: break-word !important;
                white-space: normal !important;
            }
            th {
                background-color: #f3f4f6 !important;
                color: black !important;
                font-weight: bold !important;
            }
            /* Custom column widths for print to prevent cutting */
            .col-no { width: 3%; }
            .col-nama { width: 12%; }
            .col-lp { width: 3%; }
            .col-hp { width: 8%; }
            .col-email { width: 12%; }
            .col-alamat { width: 15%; }
            .col-instansi { width: 10%; }
            .col-nilai { width: 6%; }
            .col-status { width: 8%; }

            /* Badge status for print */
            .print-badge {
                border: 1px solid #ccc !important;
                padding: 1px 3px !important;
                border-radius: 2px !important;
                font-size: 6pt !important;
                background: transparent !important;
                color: black !important;
            }
        }
    </style>
</x-admin-layout>
