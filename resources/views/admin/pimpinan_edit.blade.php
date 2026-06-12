<x-admin-layout>

    @section('sidebar_active', 'events')

    <div class="min-h-screen bg-white">
        <div class="w-full">
            <main class="flex-1 p-6">

                {{-- Header --}}
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-9 h-9 rounded-lg bg-indigo-900 flex items-center justify-center">
                        <svg class="w-5 h-5 text-indigo-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-xs text-gray-700">Admin / Pimpinan</p>
                        <h2 class="text-base font-semibold text-gray-800 leading-tight">Edit Pimpinan</h2>
                    </div>
                </div>

                {{-- Form Card --}}
                <div class="bg-white border border-gray-200 rounded-xl shadow-lg p-6">
                    <form action="{{ route('admin.pimpinan.update', $pimpinan->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 gap-5">

                            {{-- Nama --}}
                            <div>
                                <label class="block text-xs font-semibold text-gray-800 uppercase tracking-wide mb-1.5">
                                    Nama
                                </label>
                                <div class="relative">
                                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-500">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                    </span>
                                    <input name="nama" value="{{ old('nama', $pimpinan->nama) }}" required
                                        placeholder="Nama pimpinan"
                                        class="w-full pl-9 pr-4 py-2.5 bg-white border border-gray-600 text-gray-800 text-sm rounded-lg placeholder-gray-500
                                               focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition" />
                                </div>
                                @error('nama')
                                    <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Email --}}
                            <div>
                                <label class="block text-xs font-semibold text-gray-800 uppercase tracking-wide mb-1.5">
                                    Email
                                </label>
                                <div class="relative">
                                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-500">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                        </svg>
                                    </span>
                                    <input name="email" type="email" value="{{ old('email', $pimpinan->email) }}"
                                        placeholder="email@contoh.com"
                                        class="w-full pl-9 pr-4 py-2.5 bg-white border border-gray-600 text-gray-800 text-sm rounded-lg placeholder-gray-500
                                               focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition" />
                                </div>
                                @error('email')
                                    <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Password --}}
                            <div>
                                <label class="block text-xs font-semibold text-gray-800 uppercase tracking-wide mb-1.5">
                                    Password
                                </label>
                                <div class="relative">
                                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-500">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                        </svg>
                                    </span>
                                    <input name="password" type="password"
                                        placeholder="Biarkan kosong jika tidak diubah"
                                        class="w-full pl-9 pr-4 py-2.5 bg-white border border-gray-600 text-gray-800 text-sm rounded-lg placeholder-gray-500
                                               focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition" />
                                </div>
                                <p class="mt-1 text-xs text-gray-500">Kosongkan jika tidak ingin mengubah password.</p>
                                @error('password')
                                    <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Jabatan --}}
                            <div>
                                <label class="block text-xs font-semibold text-gray-800 uppercase tracking-wide mb-1.5">
                                    Jabatan
                                </label>
                                <div class="relative">
                                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-500">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                        </svg>
                                    </span>
                                    <input name="jabatan" value="{{ old('jabatan', $pimpinan->jabatan) }}"
                                        placeholder="Jabatan pimpinan"
                                        class="w-full pl-9 pr-4 py-2.5 bg-white border border-gray-600 text-gray-800 text-sm rounded-lg placeholder-gray-500
                                               focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition" />
                                </div>
                                @error('jabatan')
                                    <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                        </div>

                        {{-- Action Buttons --}}
                        <div class="mt-6 pt-5 border-t border-gray-800 flex justify-end gap-3">
                            <a href="{{ route('admin.data_pimpinan.index') }}" class="inline-flex items-center gap-2 px-4 py-2.5 border border-gray-300 text-gray-800 rounded-lg hover:bg-gray-100 transition">Kembali</a>
                            <button type="submit"
                                class="inline-flex items-center gap-2 px-5 py-2.5 bg-indigo-600 hover:bg-indigo-500 text-white text-sm font-medium rounded-lg transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4" />
                                </svg>
                                Simpan
                            </button>
                        </div>
                    </form>
                </div>

            </main>
        </div>
    </div>

</x-admin-layout>