<x-admin-layout>
    @section('sidebar_active', 'users')

    <div class="min-h-screen bg-gray-50 py-8 font-sans text-gray-800">
        <div class="max-w-4xl mx-auto px-4">
            <!-- Header Section -->
            <div class="mb-8 flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">Detail & Edit Peserta</h1>
                    <p class="text-gray-600 mt-1">Kelola informasi profil dan status seleksi peserta.</p>
                </div>
                <a href="{{ route('admin.users.index') }}" class="flex items-center text-sm text-gray-500 hover:text-gray-900 transition-colors">
                    <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    Kembali ke Daftar
                </a>
            </div>

            @if (session('success'))
                <div class="mb-6 p-4 bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-xl flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
                <form method="POST" action="{{ route('admin.peserta.update', $peserta->id) }}" class="p-8">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Left Column -->
                        <div class="space-y-6">
                            <div>
                                <label class="block text-xs font-semibold text-gray-600 uppercase tracking-wider mb-2">Nama Lengkap</label>
                                <input name="nama" value="{{ old('nama', $peserta->nama) }}"
                                    class="w-full bg-white border border-gray-300 rounded-xl px-4 py-3 text-gray-900 focus:outline-none focus:border-indigo-500 focus:ring-indigo-500 transition-colors shadow-sm" />
                                @error('nama') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label class="block text-xs font-semibold text-gray-600 uppercase tracking-wider mb-2">Email (Read-only)</label>
                                <input value="{{ $peserta->user->email ?? '' }}" readonly
                                    class="w-full bg-gray-100 border border-gray-200 rounded-xl px-4 py-3 text-gray-500 cursor-not-allowed" />
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-xs font-semibold text-gray-600 uppercase tracking-wider mb-2">Tanggal Lahir</label>
                                    <input name="tanggal_lahir" type="date"
                                        value="{{ old('tanggal_lahir', $peserta->tanggal_lahir ? $peserta->tanggal_lahir->format('Y-m-d') : '') }}"
                                        class="w-full bg-white border border-gray-300 rounded-xl px-4 py-3 text-gray-900 focus:outline-none focus:border-indigo-500 focus:ring-indigo-500 transition-colors shadow-sm" />
                                </div>
                                <div>
                                    <label class="block text-xs font-semibold text-gray-600 uppercase tracking-wider mb-2">Jenis Kelamin</label>
                                    <select name="jenis_kelamin" class="w-full bg-white border border-gray-300 rounded-xl px-4 py-3 text-gray-900 focus:outline-none focus:border-indigo-500 focus:ring-indigo-500 transition-colors shadow-sm">
                                        <option value="">Pilih...</option>
                                        <option value="Laki-laki" {{ old('jenis_kelamin', $peserta->jenis_kelamin) == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                        <option value="Perempuan" {{ old('jenis_kelamin', $peserta->jenis_kelamin) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                    </select>
                                </div>
                            </div>

                            <div>
                                <label class="block text-xs font-semibold text-gray-600 uppercase tracking-wider mb-2">No. WhatsApp / HP</label>
                                <div class="relative">
                                    <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-gray-500">+62</span>
                                    <input name="no_hp" value="{{ old('no_hp', $peserta->no_hp) }}" placeholder="8123456789"
                                        class="w-full bg-white border border-gray-300 rounded-xl pl-12 pr-4 py-3 text-gray-900 focus:outline-none focus:border-indigo-500 focus:ring-indigo-500 transition-colors shadow-sm" />
                                </div>
                            </div>
                        </div>

                        <!-- Right Column -->
                        <div class="space-y-6">
                            <div>
                                <label class="block text-xs font-semibold text-gray-600 uppercase tracking-wider mb-2">Asal Instansi</label>
                                <input name="asal_instansi" value="{{ old('asal_instansi', $peserta->asal_instansi) }}"
                                    class="w-full bg-white border border-gray-300 rounded-xl px-4 py-3 text-gray-900 focus:outline-none focus:border-indigo-500 focus:ring-indigo-500 transition-colors shadow-sm" />
                            </div>

                            <div>
                                <label class="block text-xs font-semibold text-gray-600 uppercase tracking-wider mb-2">Status Seleksi</label>
                                <select name="status_seleksi" class="w-full bg-white border border-gray-300 rounded-xl px-4 py-3 text-gray-900 focus:outline-none focus:border-indigo-500 focus:ring-indigo-500 transition-colors shadow-sm">
                                    @foreach(['Pending', 'Verifikasi', 'Lolos', 'Gagal'] as $status)
                                        <option value="{{ $status }}" {{ old('status_seleksi', $peserta->status_seleksi) == $status ? 'selected' : '' }}>{{ $status }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label class="block text-xs font-semibold text-gray-600 uppercase tracking-wider mb-2">Alamat Lengkap</label>
                                <textarea name="alamat" rows="4"
                                    class="w-full bg-white border border-gray-300 rounded-xl px-4 py-3 text-gray-900 focus:outline-none focus:border-indigo-500 focus:ring-indigo-500 transition-colors shadow-sm">{{ old('alamat', $peserta->alamat) }}</textarea>
                            </div>
                        </div>
                    </div>

                    <div class="mt-10 flex items-center justify-between border-t border-gray-200 pt-8">
                        <button type="button" onclick="confirmDelete()" class="text-sm text-red-600 hover:text-red-700 font-medium transition-colors">
                            Hapus Peserta
                        </button>
                        <div class="flex space-x-4">
                            <a href="{{ route('admin.users.index') }}" class="px-6 py-3 bg-gray-100 text-gray-700 border border-gray-300 rounded-xl hover:bg-gray-200 transition-colors font-medium">
                                Batalkan
                            </a>
                            <button type="submit" class="px-8 py-3 bg-indigo-600 text-white rounded-xl hover:bg-indigo-700 transition-all font-bold shadow-sm">
                                Simpan Perubahan
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            <form id="delete-form" method="POST" action="{{ route('admin.peserta.destroy', $peserta->id) }}" class="hidden">
                @csrf
                @method('DELETE')
            </form>
        </div>
    </div>

    <script>
        function confirmDelete() {
            if (confirm('Apakah Anda yakin ingin menghapus peserta ini? Semua data terkait (termasuk user login) akan dihapus secara permanen.')) {
                document.getElementById('delete-form').submit();
            }
        }
    </script>
</x-admin-layout>
