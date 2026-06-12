<x-admin-layout>
    @section('sidebar_active', 'klasifikasi')

    <div class="min-h-screen bg-white">
        <div class="w-full">
            <div class="w-full">
                <main class="flex-1 p-8 font-sans text-gray-800">
                    
                    <div class="mb-8 flex items-center space-x-4">
                        <a href="{{ route('admin.klasifikasi.index') }}" class="text-gray-400 hover:text-white transition-colors">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                        </a>
                        <div>
                            <h1 class="text-2xl font-bold text-gray-800">Detail Klasifikasi: {{ $peserta->nama ?? '-' }}</h1>
                            <p class="text-gray-400 mt-1">Detail perhitungan Sugeno Fuzzy untuk semua kategori.</p>
                        </div>
                    </div>

                    <!-- Summary Cards -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                        @foreach (['tes_soal' => 'Tes Soal', 'wawancara' => 'Wawancara', 'project' => 'Project'] as $kat => $label)
                            @php
                                $h = $peserta->hasilFuzzies->where('kategori', $kat)->first();
                            @endphp
                            <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-200 flex justify-between items-center">
                                <div>
                                    <h3 class="text-lg font-medium text-gray-800 mb-1">{{ $label }}</h3>
                                    <p class="text-xs text-gray-400">Nilai Defuzzifikasi (Z)</p>
                                </div>
                                <div class="text-right">
                                    @if($h)
                                        <div class="text-3xl font-bold text-indigo-400 mb-1">{{ number_format($h->nilai_hasil, 2) }}</div>
                                        @php
                                            $statusColor = match(strtolower($h->status)) {
                                                'sangat kompeten' => 'text-emerald-600 bg-emerald-50 border-emerald-200',
                                                'cukup kompeten' => 'text-amber-600 bg-amber-50 border-amber-200',
                                                'kurang kompeten' => 'text-red-600 bg-red-50 border-red-200',
                                                default => 'text-gray-600 bg-gray-50 border-gray-200',
                                            };
                                        @endphp
                                        <div class="text-xs font-semibold px-2 py-0.5 rounded-full border inline-block {{ $statusColor }}">{{ $h->status }}</div>
                                    @else
                                        <div class="text-xl font-bold text-gray-500 mb-1">-</div>
                                        <div class="text-xs font-medium text-gray-500">Belum ada</div>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <h2 class="text-lg font-semibold text-gray-800 mb-4 border-b border-gray-200 pb-2">Detail Fuzzifikasi per Kategori</h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @forelse ($details as $detail)
                            <div class="bg-white rounded-xl p-6 border border-gray-200">
                                <div class="flex justify-between items-center border-b border-gray-200 pb-3 mb-4">
                                    <h4 class="text-sm font-semibold text-gray-800 uppercase tracking-wider">{{ str_replace('_', ' ', $detail->komponen) }}</h4>
                                    <span class="text-xs text-indigo-600 bg-indigo-100 border border-indigo-200 px-2 py-1 rounded uppercase">{{ str_replace('_', ' ', $detail->kategori) }}</span>
                                </div>
                                
                                <div class="mb-5 flex justify-between items-end">
                                    <div class="text-xs text-gray-400">Nilai Asli</div>
                                    <div class="text-3xl font-bold text-gray-800 leading-none">{{ $detail->nilai_asli }}</div>
                                </div>
                                
                                <div class="space-y-3">
                                    <div class="text-[10px] text-gray-600 uppercase tracking-wider mb-2 border-b border-gray-200 pb-1">Nilai Keanggotaan (Membership)</div>
                                    <div class="flex justify-between items-center text-sm">
                                        <span class="text-gray-500">Rendah</span>
                                        <span class="font-semibold {{ $detail->rendah > 0 ? 'text-red-500' : 'text-gray-300' }}">{{ number_format($detail->rendah, 2) }}</span>
                                    </div>
                                    <div class="flex justify-between items-center text-sm">
                                        <span class="text-gray-500">Sedang</span>
                                        <span class="font-semibold {{ $detail->sedang > 0 ? 'text-amber-500' : 'text-gray-300' }}">{{ number_format($detail->sedang, 2) }}</span>
                                    </div>
                                    <div class="flex justify-between items-center text-sm">
                                        <span class="text-gray-500">Tinggi</span>
                                        <span class="font-semibold {{ $detail->tinggi > 0 ? 'text-emerald-500' : 'text-gray-300' }}">{{ number_format($detail->tinggi, 2) }}</span>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-span-full py-8 text-center text-gray-400">
                                Tidak ada detail fuzzifikasi untuk peserta ini.
                            </div>
                        @endforelse
                    </div>

                </main>
            </div>
        </div>
    </div>
</x-admin-layout>
