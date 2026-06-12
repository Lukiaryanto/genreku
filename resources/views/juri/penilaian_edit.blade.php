@section('sidebar_active', 'daftar_peserta')

<x-admin-layout>
    <main class="p-6 text-gray-800">
        {{-- Header --}}
        <div class="flex items-center gap-3 mb-6">
            <div class="w-9 h-9 rounded-lg bg-indigo-50 flex items-center justify-center text-indigo-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                </svg>
            </div>
            <div>
                <p class="text-xs text-gray-500">Juri / Penilaian</p>
                <h2 class="text-base font-semibold text-gray-900 leading-tight">Edit Nilai {{ ucfirst($penilaian->kategori) }}</h2>
                <p class="text-xs text-gray-500 mt-0.5">Memperbarui data nilai untuk <b>{{ $penilaian->peserta->nama }}</b>.</p>
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

        <form action="{{ route('penilaian.update', $penilaian->id) }}" method="POST" class="space-y-5">
            @csrf
            @method('PUT')

            {{-- Peserta Info (Read Only) --}}
            <div class="bg-white border border-gray-200 rounded-xl p-5 shadow-sm">
                <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-2">
                    Peserta
                </label>
                <p class="text-gray-900 font-medium">{{ $penilaian->peserta->nama }} ({{ $penilaian->peserta->asal }})</p>
                <p class="text-xs text-gray-500 mt-1">Kategori: <span class="capitalize">{{ $penilaian->kategori }}</span></p>
            </div>

            {{-- Input Nilai Penilaian --}}
            <div>
                <p class="text-sm font-semibold text-gray-900 mb-3">Nilai Penilaian</p>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

                    {{-- Public Speaking --}}
                    <div class="bg-white border border-gray-200 rounded-xl p-5 shadow-sm">
                        <p class="text-xs text-gray-500 leading-snug mb-3">Public Speaking</p>
                        <p class="text-3xl font-bold text-gray-900 mb-4" id="displayPublicSpeaking">{{ $penilaian->public_speaking }}</p>
                        <input type="range" name="public_speaking" id="public_speaking" min="0" max="100"
                            value="{{ $penilaian->public_speaking }}" class="w-full accent-indigo-600"
                            oninput="displayPublicSpeaking.innerText = this.value" />
                        <div class="flex justify-between text-xs text-gray-400 mt-1">
                            <span>0</span><span>100</span>
                        </div>
                    </div>

                    {{-- Wawasan Genre --}}
                    <div class="bg-white border border-gray-200 rounded-xl p-5 shadow-sm">
                        <p class="text-xs text-gray-500 leading-snug mb-3">Wawasan Genre</p>
                        <p class="text-3xl font-bold text-gray-900 mb-4" id="displayWawasan">{{ $penilaian->wawasan_genre }}</p>
                        <input type="range" name="wawasan_genre" id="wawasan_genre" min="0" max="100"
                            value="{{ $penilaian->wawasan_genre }}" class="w-full accent-indigo-600"
                            oninput="displayWawasan.innerText = this.value" />
                        <div class="flex justify-between text-xs text-gray-400 mt-1">
                            <span>0</span><span>100</span>
                        </div>
                    </div>

                    {{-- Kepemimpinan --}}
                    <div class="bg-white border border-gray-200 rounded-xl p-5 shadow-sm">
                        <p class="text-xs text-gray-500 leading-snug mb-3">Kepemimpinan</p>
                        <p class="text-3xl font-bold text-gray-900 mb-4" id="displayKepemimpinan">{{ $penilaian->kepemimpinan }}</p>
                        <input type="range" name="kepemimpinan" id="kepemimpinan" min="0" max="100"
                            value="{{ $penilaian->kepemimpinan }}" class="w-full accent-indigo-600"
                            oninput="displayKepemimpinan.innerText = this.value" />
                        <div class="flex justify-between text-xs text-gray-400 mt-1">
                            <span>0</span><span>100</span>
                        </div>
                    </div>

                </div>
            </div>

            {{-- Submit --}}
            <div class="flex justify-between items-center pt-2">
                <a href="{{ route('juri.daftar_peserta') }}" class="text-sm text-gray-500 hover:text-gray-900 transition-colors flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Kembali
                </a>
                <button type="submit"
                    class="inline-flex items-center gap-2 px-6 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-lg transition shadow-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    Perbarui Nilai
                </button>
            </div>

        </form>
    </main>
</x-admin-layout>
