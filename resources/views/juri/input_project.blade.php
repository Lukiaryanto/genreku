@section('sidebar_active', 'project')

<x-admin-layout>
    <main class="p-6 text-gray-800">
        {{-- Header --}}
        <div class="flex items-center gap-3 mb-6">
            <div class="w-9 h-9 rounded-lg bg-emerald-50 flex items-center justify-center text-emerald-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                </svg>
            </div>
            <div>
                <p class="text-xs text-gray-500">Juri / Penilaian</p>
                <h2 class="text-base font-semibold text-gray-900 leading-tight">Input Nilai Project</h2>
                <p class="text-xs text-gray-500 mt-0.5">Berikan penilaian project untuk peserta.</p>
            </div>
        </div>

        {{-- Error Alert --}}
        @if ($errors->any())
            <div class="mb-5 flex items-start gap-3 px-4 py-3 bg-red-50 border border-red-200 text-red-600 text-sm rounded-lg">
                <svg class="w-4 h-4 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <ul class="list-disc pl-4 space-y-0.5">
                    @foreach ($errors->all() as $err)
                        <li>{{ $err }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('penilaian.store') }}" method="POST" class="space-y-5">
            @csrf
            <input type="hidden" name="kategori" value="project">

            {{-- Pilih Peserta --}}
            <div class="bg-white border border-gray-200 rounded-xl p-5 shadow-sm">
                <label for="peserta_id" class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-3">
                    Pilih Peserta
                </label>
                <div class="relative">
                    <select name="peserta_id" id="peserta_id" required
                        class="block w-full px-4 py-2.5 bg-gray-50 border border-gray-200 text-gray-900 text-sm rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition appearance-none">
                        <option value="">-- Pilih Peserta --</option>
                        @foreach ($peserta as $p)
                            <option value="{{ $p->id }}" {{ request('peserta_id') == $p->id ? 'selected' : '' }}>{{ $p->nama }}</option>
                        @endforeach
                    </select>
                    <div class="absolute inset-y-0 right-0 flex items-center px-3 pointer-events-none text-gray-500">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </div>
                </div>
            </div>

            {{-- Input Nilai Penilaian --}}
            <div>
                <p class="text-sm font-semibold text-gray-900 mb-3">Nilai Penilaian Project</p>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

                    {{-- Public Speaking --}}
                    <div class="bg-white border border-gray-200 rounded-xl p-5 border-l-4 border-l-emerald-500 shadow-sm">
                        <p class="text-xs text-gray-500 leading-snug mb-3">Public Speaking</p>
                        <p class="text-3xl font-bold text-gray-900 mb-4" id="displayPublicSpeaking">0</p>
                        <input type="range" name="public_speaking" id="public_speaking" min="0" max="100"
                            value="0" class="w-full accent-emerald-600"
                            oninput="displayPublicSpeaking.innerText = this.value" />
                        <div class="flex justify-between text-xs text-gray-400 mt-1">
                            <span>0</span><span>100</span>
                        </div>
                    </div>

                    {{-- Wawasan Genre --}}
                    <div class="bg-white border border-gray-200 rounded-xl p-5 border-l-4 border-l-emerald-500 shadow-sm">
                        <p class="text-xs text-gray-500 leading-snug mb-3">Wawasan Genre</p>
                        <p class="text-3xl font-bold text-gray-900 mb-4" id="displayWawasan">0</p>
                        <input type="range" name="wawasan_genre" id="wawasan_genre" min="0" max="100"
                            value="0" class="w-full accent-emerald-600"
                            oninput="displayWawasan.innerText = this.value" />
                        <div class="flex justify-between text-xs text-gray-400 mt-1">
                            <span>0</span><span>100</span>
                        </div>
                    </div>

                    {{-- Kepemimpinan --}}
                    <div class="bg-white border border-gray-200 rounded-xl p-5 border-l-4 border-l-emerald-500 shadow-sm">
                        <p class="text-xs text-gray-500 leading-snug mb-3">Kepemimpinan</p>
                        <p class="text-3xl font-bold text-gray-900 mb-4" id="displayKepemimpinan">0</p>
                        <input type="range" name="kepemimpinan" id="kepemimpinan" min="0" max="100"
                            value="0" class="w-full accent-emerald-600"
                            oninput="displayKepemimpinan.innerText = this.value" />
                        <div class="flex justify-between text-xs text-gray-400 mt-1">
                            <span>0</span><span>100</span>
                        </div>
                    </div>

                </div>
            </div>

            {{-- Submit --}}
            <div class="flex justify-end pt-1">
                <button type="submit"
                    class="inline-flex items-center gap-2 px-5 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-medium rounded-lg transition shadow-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                    </svg>
                    Simpan Nilai Project
                </button>
            </div>

        </form>
    </main>
</x-admin-layout>