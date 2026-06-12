<x-peserta-layout active="dashboard">
    <main class="p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <h2 class="text-2xl font-semibold text-gray-800">Dashboard Peserta</h2>
                            <p class="text-sm text-gray-600">Selamat datang, {{ Auth::user()->name ?? 'Peserta' }}.</p>
                        </div>
                        <div class="flex items-center space-x-4">
                            <div class="text-sm text-gray-600">Role: <span
                                    class="font-medium text-gray-800">{{ Auth::user()->role ?? '-' }}</span></div>
                        </div>
                    </div>

                    <div class="mt-6 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        {{-- Biodata Status --}}
                        <div class="bg-white p-5 rounded-xl border border-gray-200 shadow-sm">
                            <div class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Biodata</div>
                            <div class="mt-3 flex items-center justify-between">
                                @php $isBiodataLengkap = !empty($peserta->no_hp) && !empty($peserta->alamat); @endphp
                                <div class="text-lg font-bold text-gray-800">{{ $isBiodataLengkap ? 'Lengkap' : 'Belum Lengkap' }}</div>
                                <div class="p-2 rounded-lg {{ $isBiodataLengkap ? 'bg-emerald-500/10 text-emerald-500' : 'bg-amber-500/10 text-amber-500' }}">
                                    @if($isBiodataLengkap)
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                    @else
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                                    @endif
                                </div>
                            </div>
                            <a href="{{ route('peserta.biodata.edit') }}" class="mt-4 text-xs font-medium text-blue-400 hover:text-blue-300 transition-colors flex items-center gap-1">
                                Update Biodata
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7m0 0l-7 7m7-7H3"/></svg>
                            </a>
                        </div>

                        {{-- Ujian Status --}}
                        <div class="bg-white p-5 rounded-xl border border-gray-200 shadow-sm">
                            <div class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Tes Online</div>
                            <div class="mt-3 flex items-center justify-between">
                                @php 
                                    $hasNilaiTes = $peserta && $peserta->penilaians->where('kategori', 'tes_soal')->first();
                                @endphp
                                <div class="text-lg font-bold text-gray-800">{{ $hasNilaiTes ? 'Sudah Dikerjakan' : 'Belum Dikerjakan' }}</div>
                                <div class="p-2 rounded-lg {{ $hasNilaiTes ? 'bg-emerald-500/10 text-emerald-500' : 'bg-blue-500/10 text-blue-500' }}">
                                    @if($hasNilaiTes)
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    @else
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3"/></svg>
                                    @endif
                                </div>
                            </div>
                            @if(!$hasNilaiTes)
                                <a href="{{ route('peserta.soal') }}" class="mt-4 text-xs font-medium text-blue-400 hover:text-blue-300 transition-colors flex items-center gap-1">
                                    Mulai Ujian
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7m0 0l-7 7m7-7H3"/></svg>
                                </a>
                            @else
                                <div class="mt-4 text-xs text-gray-500">Terima kasih telah mengerjakan.</div>
                            @endif
                        </div>

                        {{-- Hasil Seleksi Status --}}
                        <div class="bg-white p-5 rounded-xl border border-gray-200 shadow-sm">
                            <div class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Status Seleksi {{ $peserta && $peserta->created_at ? $peserta->created_at->format('Y') : date('Y') }}</div>
                            <div class="mt-3 flex items-center justify-between">
                                @php
                                    $status = ($peserta && $peserta->status_seleksi) ? $peserta->status_seleksi : 'Dalam Proses';
                                    $statusColor = 'text-blue-400';
                                    $bgColor = 'bg-blue-500/10';
                                    
                                    if (Str::contains(strtolower($status), ['rekomendasi', 'lulus', 'lolos'])) {
                                        $statusColor = 'text-emerald-400';
                                        $bgColor = 'bg-emerald-500/10';
                                    } elseif (Str::contains(strtolower($status), ['tidak', 'gagal'])) {
                                        $statusColor = 'text-red-400';
                                        $bgColor = 'bg-red-500/10';
                                    }
                                @endphp
                                <div class="text-lg font-bold text-gray-800">{{ $status }}</div>
                                <div class="p-2 rounded-lg {{ $bgColor }} {{ $statusColor }}">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                </div>
                            </div>
                            <div class="mt-4 text-xs text-gray-500">Pantau terus pengumuman di sini.</div>
                        </div>
                    </div>
                    <!-- Section Hasil Klasifikasi Potensi -->
                    @if($peserta && $peserta->hasilFuzzies && $peserta->hasilFuzzies->count() > 0)
                    <div class="mt-10">
                        <h3 class="text-xl font-semibold text-gray-800 mb-4">Klasifikasi Potensi Anda</h3>
                        
                        <!-- Summary Cards -->
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                            @foreach (['tes_soal' => 'Tes Soal', 'wawancara' => 'Wawancara', 'project' => 'Project'] as $kat => $label)
                                @php
                                    $h = $peserta->hasilFuzzies->where('kategori', $kat)->first();
                                @endphp
                                <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-200 flex justify-between items-center">
                                    <div>
                                        <h4 class="text-lg font-medium text-gray-800 mb-1">{{ $label }}</h4>
                                        <p class="text-xs text-gray-500">Status Potensi</p>
                                    </div>
                                    <div class="text-right">
                                        @if($h)
                                            <div class="text-2xl font-bold text-indigo-600 mb-1">{{ number_format($h->nilai_hasil, 2) }}</div>
                                            <div class="text-sm font-medium text-emerald-600">{{ $h->status }}</div>
                                        @else
                                            <div class="text-xl font-bold text-gray-400 mb-1">-</div>
                                            <div class="text-xs font-medium text-gray-400">Belum Dinilai</div>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Kelebihan dan Kekurangan Detail -->
                        @php
                            $details = \App\Models\FuzzyDetail::where('peserta_id', $peserta->id)->get();
                        @endphp
                        @if($details->count() > 0)
                            <h3 class="text-lg font-semibold text-gray-800 mb-4 border-b border-gray-200 pb-2">Detail Analisis Potensi (Kelebihan & Kekurangan)</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                                @foreach ($details as $detail)
                                    <div class="bg-white rounded-xl p-6 border border-gray-200 transition hover:border-gray-400">
                                        <div class="flex justify-between items-center border-b border-gray-200 pb-3 mb-4">
                                            <h4 class="text-sm font-semibold text-gray-800 uppercase tracking-wider">{{ ucwords(str_replace('_', ' ', $detail->komponen)) }}</h4>
                                            <span class="text-[10px] font-bold text-indigo-600 bg-indigo-50 border border-indigo-200 px-2 py-1 rounded uppercase">{{ str_replace('_', ' ', $detail->kategori) }}</span>
                                        </div>
                                        
                                        <div class="mb-5 flex justify-between items-end">
                                            <div class="text-xs text-gray-500">Nilai Perolehan</div>
                                            <div class="text-3xl font-bold text-gray-800 leading-none">{{ $detail->nilai_asli }}</div>
                                        </div>
                                        
                                        <div class="space-y-3">
                                            <div class="text-[10px] text-gray-500 uppercase tracking-wider mb-2 border-b border-gray-200 pb-1">Tingkat Penguasaan (Membership)</div>
                                            <div class="flex justify-between items-center text-sm">
                                                <span class="text-gray-600">Kurang (Rendah)</span>
                                                <span class="font-medium {{ $detail->rendah > 0 ? 'text-red-600' : 'text-gray-400' }}">{{ number_format($detail->rendah, 2) }}</span>
                                            </div>
                                            <div class="flex justify-between items-center text-sm">
                                                <span class="text-gray-600">Cukup (Sedang)</span>
                                                <span class="font-medium {{ $detail->sedang > 0 ? 'text-blue-600' : 'text-gray-400' }}">{{ number_format($detail->sedang, 2) }}</span>
                                            </div>
                                            <div class="flex justify-between items-center text-sm">
                                                <span class="text-gray-600">Baik (Tinggi)</span>
                                                <span class="font-medium {{ $detail->tinggi > 0 ? 'text-emerald-600' : 'text-gray-400' }}">{{ number_format($detail->tinggi, 2) }}</span>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                    @endif
    </main>
</x-peserta-layout>
