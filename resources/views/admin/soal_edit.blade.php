<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $title ?? 'Edit Soal' }}
        </h2>
    </x-slot>

    @section('sidebar_active', 'tests')

            <div class="min-h-screen bg-gray-50">
        <div class="w-full">
                        <main class="flex-1 p-6 bg-white">

                {{-- Header --}}
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-9 h-9 rounded-lg bg-indigo-100 flex items-center justify-center">
                        <svg class="w-5 h-5 text-indigo-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <div>
                                                 <p class="text-xs text-gray-500">Admin / Soal</p>
                                                 <h2 class="text-base font-semibold text-gray-900 leading-tight">{{ $title ?? 'Edit Soal' }}</h2>
                    </div>
                </div>

                {{-- Success Alert --}}
                @if (session('success'))
                    <div class="mb-5 flex items-center gap-3 px-4 py-3 bg-green-900/40 border border-green-700 text-green-300 text-sm rounded-lg">
                        <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        {{ session('success') }}
                    </div>
                @endif

                {{-- Form Card --}}
                                <div class="bg-white border border-gray-200 rounded-xl shadow-lg p-6">
                    <form method="POST" action="{{ route('admin.soal.update', $soal->id) }}">
                        @csrf
                        @method('PUT')

                        {{-- Pertanyaan --}}
                        <div class="mb-6">
                            <label class="block text-xs font-semibold text-gray-400 uppercase tracking-wide mb-1.5">
                                Pertanyaan
                            </label>
                            <textarea name="pertanyaan" rows="3"
                                placeholder="Tulis pertanyaan di sini..."
                                                    class="w-full px-4 py-2.5 bg-white border border-gray-300 text-gray-900 text-sm rounded-lg placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition resize-none">{{ old('pertanyaan', $soal->pertanyaan) }}</textarea>
                            @error('pertanyaan')
                                <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Divider --}}
                        <div class="flex items-center gap-3 mb-5">
                            <span class="text-xs font-semibold text-gray-400 uppercase tracking-wide">Pilihan Jawaban</span>
                            <div class="flex-1 border-t border-gray-200"></div>
                        </div>

                        {{-- Opsi A–D --}}
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                            @foreach (['a' => 'Opsi A', 'b' => 'Opsi B', 'c' => 'Opsi C', 'd' => 'Opsi D'] as $key => $label)
                                <div>
                                    <label class="block text-xs font-semibold text-gray-400 uppercase tracking-wide mb-1.5">
                                        {{ $label }}
                                    </label>
                                    <div class="relative">
                                        <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                                            <span class="w-5 h-5 rounded bg-indigo-900 text-indigo-300 text-xs font-bold flex items-center justify-center">
                                                {{ strtoupper($key) }}
                                            </span>
                                        </span>
                                        <input type="text" name="opsi_{{ $key }}"
                                            value="{{ old('opsi_' . $key, $soal->{'opsi_' . $key}) }}"
                                            placeholder="Isi opsi {{ strtoupper($key) }}"
                                                                                        class="w-full pl-10 pr-4 py-2.5 bg-white border border-gray-300 text-gray-900 text-sm rounded-lg placeholder-gray-500
                                                   focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition" />
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        {{-- Divider --}}
                        <div class="flex items-center gap-3 mb-5">
                            <span class="text-xs font-semibold text-gray-400 uppercase tracking-wide">Pengaturan Soal</span>
                            <div class="flex-1 border-t border-gray-200"></div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-6">

                            {{-- Jawaban Benar --}}
                            <div>
                                <label class="block text-xs font-semibold text-gray-400 uppercase tracking-wide mb-1.5">
                                    Jawaban Benar
                                </label>
                                <div class="relative">
                                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-500">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </span>
                                    <select name="jawaban_benar"
                                        class="w-full pl-9 pr-4 py-2.5 bg-white border border-gray-200 text-gray-800 text-sm rounded-lg
                                               focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition appearance-none">
                                        @foreach (['a', 'b', 'c', 'd'] as $k)
                                            <option value="{{ $k }}"
                                                {{ old('jawaban_benar', $soal->jawaban_benar) === $k ? 'selected' : '' }}>
                                                Opsi {{ strtoupper($k) }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            {{-- Kategori --}}
                            <div>
                                <label class="block text-xs font-semibold text-gray-400 uppercase tracking-wide mb-1.5">
                                    Kategori
                                </label>
                                <div class="relative">
                                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-500">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A2 2 0 013 12V7a4 4 0 014-4z" />
                                        </svg>
                                    </span>
                                    <select name="kategori"
                                        class="w-full pl-9 pr-4 py-2.5 bg-white border border-gray-200 text-gray-800 text-sm rounded-lg
                                               focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition appearance-none">
                                        <option value="public_speaking"
                                            {{ old('kategori', $soal->kategori) === 'public_speaking' ? 'selected' : '' }}>
                                            Public Speaking
                                        </option>
                                        <option value="wawasan_genre"
                                            {{ old('kategori', $soal->kategori) === 'wawasan_genre' ? 'selected' : '' }}>
                                            Wawasan Genre
                                        </option>
                                        <option value="kepemimpinan"
                                            {{ old('kategori', $soal->kategori) === 'kepemimpinan' ? 'selected' : '' }}>
                                            Kepemimpinan
                                        </option>
                                    </select>
                                </div>
                            </div>

                        </div>

                        {{-- Action Buttons --}}
                                                <div class="pt-5 border-t border-gray-200 flex justify-end gap-3">
                            <a href="{{ route('admin.data_soal') }}"
                                class="inline-flex items-center gap-2 px-4 py-2.5 rounded-lg border border-gray-600 text-sm text-gray-300
                                       hover:bg-gray-700 hover:text-white transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                                Batal
                            </a>
                            <button type="submit"
                                class="inline-flex items-center gap-2 px-5 py-2.5 bg-indigo-600 hover:bg-indigo-500 text-white text-sm font-medium rounded-lg transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4" />
                                </svg>
                                Simpan Perubahan
                            </button>
                        </div>

                    </form>
                </div>

            </main>
        </div>
    </div>

</x-admin-layout>