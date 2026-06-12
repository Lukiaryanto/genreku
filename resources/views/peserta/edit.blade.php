<x-peserta-layout active="biodata">
    <x-slot name="header">{{ $title ?? 'Edit Biodata' }}</x-slot>

    <div class="max-w-3xl mx-auto px-6 py-10">
        <div class="bg-white shadow rounded-lg p-6 border border-gray-200">
            @if (session('success'))
                <div class="mb-4 rounded bg-green-600 p-3 text-white text-sm">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="mb-4 rounded bg-red-600 p-3 text-white text-sm">{{ session('error') }}</div>
            @endif

            <form action="{{ route('peserta.biodata.update') }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                <div class="grid gap-4">
                    <div class="grid md:grid-cols-2 gap-4">
                        <label class="block">
                            <span class="text-sm font-medium text-gray-700">Nama</span>
                            <input type="text" name="nama" value="{{ old('nama', $peserta->nama) }}"
                                class="mt-1 block w-full rounded bg-white border border-gray-300 px-3 py-2 text-gray-800 focus:ring-2 focus:ring-indigo-500"
                                required>
                            @error('nama')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </label>

                        <label class="block">
                            <span class="text-sm font-medium text-gray-700">Tanggal Lahir</span>
                            <input type="date" name="tanggal_lahir"
                                value="{{ old('tanggal_lahir', $peserta && $peserta->tanggal_lahir ? $peserta->tanggal_lahir->format('Y-m-d') : '') }}"
                                class="mt-1 block w-full rounded bg-white border border-gray-300 px-3 py-2 text-gray-800 focus:ring-2 focus:ring-indigo-500">
                            @error('tanggal_lahir')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </label>
                    </div>

                    <label class="block">
                        <span class="text-sm font-medium text-gray-700">Alamat</span>
                        <textarea name="alamat" rows="3"
                            class="mt-1 block w-full rounded bg-white border border-gray-300 px-3 py-2 text-gray-800 focus:ring-2 focus:ring-indigo-500">{{ old('alamat', $peserta->alamat) }}</textarea>
                        @error('alamat')
                            <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </label>

                    <div class="grid md:grid-cols-2 gap-4">
                        <label class="block">
                            <span class="text-sm font-medium text-gray-700">No. WhatsApp / HP</span>
                            <input type="text" name="no_hp" value="{{ old('no_hp', $peserta->no_hp) }}"
                                class="mt-1 block w-full rounded bg-white border border-gray-300 px-3 py-2 text-gray-800 focus:ring-2 focus:ring-indigo-500"
                                placeholder="08123456789">
                            @error('no_hp')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </label>

                        <label class="block">
                            <span class="text-sm font-medium text-gray-700">Jenis Kelamin</span>
                            <select name="jenis_kelamin" class="mt-1 block w-full rounded bg-white border border-gray-300 px-3 py-2 text-gray-800 focus:ring-2 focus:ring-indigo-500">
                                <option value="">Pilih...</option>
                                <option value="Laki-laki" {{ old('jenis_kelamin', $peserta->jenis_kelamin) == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="Perempuan" {{ old('jenis_kelamin', $peserta->jenis_kelamin) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                            @error('jenis_kelamin')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </label>
                    </div>

                    <label class="block">
                        <span class="text-sm font-medium text-gray-700">Asal Instansi</span>
                        <input type="text" name="asal_instansi"
                            value="{{ old('asal_instansi', $peserta->asal_instansi) }}"
                            class="mt-1 block w-full rounded bg-white border border-gray-300 px-3 py-2 text-gray-800 focus:ring-2 focus:ring-indigo-500">
                        @error('asal_instansi')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </label>

                    <div class="flex items-center justify-end gap-3 mt-2">
                        <a href="{{ url('/') }}"
                            class="px-4 py-2 rounded border border-gray-300 text-gray-700 hover:bg-gray-50">Batal</a>
                        <button type="submit"
                            class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-500">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-peserta-layout>
