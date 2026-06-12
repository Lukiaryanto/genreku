<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $title ?? 'Tambah Soal' }}
        </h2>
    </x-slot>

    <div class="min-h-screen bg-white">
        <div class="w-full">
            <div class="flex items-stretch">
                @section('sidebar_active', 'tests')

                <main class="flex-1 p-6">
                    <div class="bg-white p-8 rounded-xl shadow-xl border border-gray-200">
                        <div class="mb-6 pb-4 border-b border-gray-200">
                            <h3 class="text-2xl font-bold text-gray-800 tracking-tight">Tambah Soal Baru</h3>
                            <p class="text-sm text-gray-400 mt-1">Masukkan pertanyaan, opsi jawaban, dan kunci jawaban dengan teliti.</p>
                        </div>

                        <form method="POST" action="{{ route('admin.soal.store') }}" class="space-y-6">
                            @csrf

                            <div>
                                <label class="block text-sm font-semibold text-gray-800 mb-2">Pertanyaan</label>
                                <textarea name="pertanyaan" rows="4" class="block w-full rounded-lg border-gray-300 bg-white text-gray-800 focus:border-indigo-500 focus:ring focus:ring-indigo-500/20 transition-all placeholder-gray-400" placeholder="Ketikkan pertanyaan di sini...">{{ old('pertanyaan') }}</textarea>
                                @error('pertanyaan')
                                    <p class="text-sm text-red-400 mt-2 flex items-center"><svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="bg-white p-6 rounded-lg border border-gray-200">
                                <h4 class="text-md font-medium text-gray-800 mb-4 flex items-center">
                                    <svg class="w-5 h-5 mr-2 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"></path></svg>
                                    Opsi Jawaban
                                </h4>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-800 mb-1">Opsi A</label>
                                        <input type="text" name="opsi_a" value="{{ old('opsi_a') }}" class="block w-full rounded-lg border-gray-300 bg-white text-gray-800 focus:border-indigo-500 focus:ring focus:ring-indigo-500/20 transition-all" placeholder="Jawaban A" />
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-800 mb-1">Opsi B</label>
                                        <input type="text" name="opsi_b" value="{{ old('opsi_b') }}" class="block w-full rounded-lg border-gray-300 bg-white text-gray-800 focus:border-indigo-500 focus:ring focus:ring-indigo-500/20 transition-all" placeholder="Jawaban B" />
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-800 mb-1">Opsi C</label>
                                        <input type="text" name="opsi_c" value="{{ old('opsi_c') }}" class="block w-full rounded-lg border-gray-300 bg-white text-gray-800 focus:border-indigo-500 focus:ring focus:ring-indigo-500/20 transition-all" placeholder="Jawaban C" />
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-800 mb-1">Opsi D</label>
                                        <input type="text" name="opsi_d" value="{{ old('opsi_d') }}" class="block w-full rounded-lg border-gray-300 bg-white text-gray-800 focus:border-indigo-500 focus:ring focus:ring-indigo-500/20 transition-all" placeholder="Jawaban D" />
                                    </div>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-semibold text-gray-800 mb-2">Jawaban Benar</label>
                                    <select name="jawaban_benar" class="block w-full rounded-lg border-gray-300 bg-white text-gray-800 focus:border-green-500 focus:ring focus:ring-green-500/20 transition-all">
                                        <option value="" disabled selected class="text-gray-500">Pilih Jawaban Benar...</option>
                                        @foreach (['a', 'b', 'c', 'd'] as $k)
                                            <option value="{{ $k }}"
                                                {{ old('jawaban_benar') === $k ? 'selected' : '' }}>Opsi {{ strtoupper($k) }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('jawaban_benar')
                                        <p class="text-sm text-red-400 mt-2 flex items-center"><svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label class="block text-sm font-semibold text-gray-800 mb-2">Kategori</label>
                                    <select name="kategori" class="block w-full rounded-lg border-gray-300 bg-white text-gray-800 focus:border-indigo-500 focus:ring focus:ring-indigo-500/20 transition-all">
                                        <option value="" disabled selected class="text-gray-500">Pilih Kategori...</option>
                                        <option value="public_speaking"
                                            {{ old('kategori') === 'public_speaking' ? 'selected' : '' }}>Public Speaking
                                        </option>
                                        <option value="wawasan_genre"
                                            {{ old('kategori') === 'wawasan_genre' ? 'selected' : '' }}>Wawasan Genre
                                        </option>
                                        <option value="kepemimpinan"
                                            {{ old('kategori') === 'kepemimpinan' ? 'selected' : '' }}>Kepemimpinan
                                        </option>
                                    </select>
                                    @error('kategori')
                                        <p class="text-sm text-red-400 mt-2 flex items-center"><svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="mt-8 pt-6 border-t border-gray-200 flex flex-col-reverse sm:flex-row sm:justify-end gap-3">
                                <a href="{{ route('admin.data_soal') }}" class="inline-flex items-center gap-2 px-4 py-2.5 bg-white border border-gray-300 text-gray-800 rounded-lg hover:bg-gray-100 transition">Batal</a>
                                <button type="submit" class="w-full sm:w-auto px-6 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg transition-all shadow-lg shadow-indigo-500/30 flex items-center justify-center font-medium">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path></svg>
                                    Simpan Soal
                                </button>
                            </div>
                        </form>
                    </div>
                </main>
            </div>
        </div>
    </div>
</x-admin-layout>
