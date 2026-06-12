<x-admin-layout>
    @section('sidebar_active', 'fuzzy_config')

    <main class="p-8 font-sans text-gray-800">
        <div class="mb-8">
            <h1 class="text-2xl font-bold text-gray-800 tracking-tight">Pengaturan Membership Function</h1>
            <p class="text-gray-400 mt-2">Atur range nilai fungsi keanggotaan Fuzzy Sugeno secara dinamis.</p>
        </div>

        @if (session('success'))
            <div class="mb-6 rounded-xl bg-emerald-900/40 border border-emerald-700 p-4 text-emerald-300 text-sm font-medium">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('admin.fuzzy_config.update') }}" method="POST">
            @csrf
            @method('PUT')

            {{-- Membership Function Ranges --}}
            <div class="bg-white rounded-2xl border border-gray-200 shadow-xl overflow-hidden mb-8">
                <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                    <h2 class="text-lg font-bold text-gray-800 flex items-center gap-2">
                        <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"/></svg>
                        Fungsi Keanggotaan (Membership Function)
                    </h2>
                    <p class="text-gray-500 text-xs mt-1">Range input nilai peserta (skala 0 — 100)</p>
                </div>

                {{-- Visual Preview --}}
                <div class="px-6 pt-5 pb-2">
                    <div class="bg-gray-50 rounded-xl p-4 border border-gray-200">
                        <div class="flex items-end justify-between h-24 relative">
                            {{-- Rendah --}}
                            <div class="flex flex-col items-center flex-1">
                                <span class="text-[10px] font-bold text-orange-600 uppercase mb-1">Rendah</span>
                                <div class="w-full h-12 bg-gradient-to-r from-orange-400/60 to-orange-100/20 rounded-l-lg border border-orange-400/50 flex items-center justify-center">
                                    <span class="text-xs font-mono text-orange-700 font-semibold" id="preview-rendah">0 — <span class="sedang-min-val">40</span> — <span class="rendah-max-val">50</span></span>
                                </div>
                            </div>
                            {{-- Sedang --}}
                            <div class="flex flex-col items-center flex-1 -mx-2">
                                <span class="text-[10px] font-bold text-blue-600 uppercase mb-1">Sedang</span>
                                <div class="w-full h-16 bg-gradient-to-r from-blue-100/30 via-blue-400/50 to-blue-100/30 rounded-lg border border-blue-400/50 flex items-center justify-center relative">
                                    <span class="text-xs font-mono text-blue-700 font-semibold"><span class="sedang-min-val">40</span> — <span class="sedang-peak-val">60</span> — <span class="sedang-max-val">80</span></span>
                                </div>
                            </div>
                            {{-- Tinggi --}}
                            <div class="flex flex-col items-center flex-1">
                                <span class="text-[10px] font-bold text-emerald-600 uppercase mb-1">Tinggi</span>
                                <div class="w-full h-12 bg-gradient-to-l from-emerald-400/60 to-emerald-100/20 rounded-r-lg border border-emerald-400/50 flex items-center justify-center">
                                    <span class="text-xs font-mono text-emerald-700 font-semibold"><span class="tinggi-min-val">75</span> — 100</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        @foreach ($membership as $i => $cfg)
                            <div class="bg-white rounded-xl p-4 border border-gray-200 hover:border-blue-500/40 transition-colors">
                                <input type="hidden" name="configs[m{{ $i }}][id]" value="{{ $cfg->id }}">
                                <label class="block text-sm font-semibold text-gray-800 mb-1">{{ $cfg->label }}</label>
                                <p class="text-[11px] text-gray-500 mb-3">{{ $cfg->keterangan }}</p>
                                <input type="number" step="any" name="configs[m{{ $i }}][value]" value="{{ $cfg->value }}"
                                    data-key="{{ $cfg->key }}"
                                    class="fuzzy-input w-full rounded-lg bg-white border border-gray-300 px-4 py-2.5 text-gray-800 font-mono text-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                                    required>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- Konstanta Output Sugeno --}}
            <div class="bg-white rounded-2xl border border-gray-200 shadow-xl overflow-hidden mb-8">
                <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                    <h2 class="text-lg font-bold text-gray-800 flex items-center gap-2">
                        <svg class="w-5 h-5 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                        Konstanta Output Sugeno (Orde Nol)
                    </h2>
                    <p class="text-gray-500 text-xs mt-1">Nilai Z yang digunakan dalam rule base (skala 0 — 1)</p>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        @foreach ($output as $i => $cfg)
                            <div class="bg-white rounded-xl p-4 border border-gray-200 hover:border-emerald-500/40 transition-colors">
                                <input type="hidden" name="configs[o{{ $i }}][id]" value="{{ $cfg->id }}">
                                <label class="block text-sm font-semibold text-gray-800 mb-1">{{ $cfg->label }}</label>
                                <p class="text-[11px] text-gray-500 mb-3">{{ $cfg->keterangan }}</p>
                                <input type="number" step="0.01" min="0" max="1" name="configs[o{{ $i }}][value]" value="{{ $cfg->value }}"
                                    class="w-full rounded-lg bg-white border border-gray-300 px-4 py-2.5 text-gray-800 font-mono text-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition"
                                    required>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- Threshold Interpretasi --}}
            <div class="bg-white rounded-2xl border border-gray-200 shadow-xl overflow-hidden mb-8">
                <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                    <h2 class="text-lg font-bold text-gray-800 flex items-center gap-2">
                        <svg class="w-5 h-5 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        Threshold Interpretasi Status
                    </h2>
                    <p class="text-gray-500 text-xs mt-1">Batas nilai Z untuk menentukan status akhir klasifikasi</p>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @foreach ($threshold as $i => $cfg)
                            <div class="bg-white rounded-xl p-4 border border-gray-200 hover:border-orange-500/40 transition-colors">
                                <input type="hidden" name="configs[t{{ $i }}][id]" value="{{ $cfg->id }}">
                                <label class="block text-sm font-semibold text-gray-800 mb-1">{{ $cfg->label }}</label>
                                <p class="text-[11px] text-gray-500 mb-3">{{ $cfg->keterangan }}</p>
                                <input type="number" step="0.01" min="0" max="1" name="configs[t{{ $i }}][value]" value="{{ $cfg->value }}"
                                    class="w-full rounded-lg bg-white border border-gray-300 px-4 py-2.5 text-gray-800 font-mono text-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition"
                                    required>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- Submit --}}
            <div class="flex items-center justify-end gap-4">
                <a href="{{ route('admin.klasifikasi.index') }}" class="px-6 py-3 rounded-xl border border-gray-300 text-gray-600 hover:bg-gray-100 transition font-medium">Batal</a>
                <button type="submit" class="px-8 py-3 bg-blue-600 hover:bg-blue-500 text-white font-bold rounded-xl transition shadow-lg shadow-blue-900/40 flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </main>

    {{-- Live Preview Script --}}
    <script>
        document.querySelectorAll('.fuzzy-input').forEach(input => {
            input.addEventListener('input', function() {
                const key = this.dataset.key;
                const val = this.value;
                const el = document.querySelector('.' + key.replace('_', '-') + '-val');
                if (el) el.textContent = val;
            });
        });
    </script>
</x-admin-layout>
