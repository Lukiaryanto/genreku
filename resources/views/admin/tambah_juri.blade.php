<x-admin-layout>
    @section('sidebar_active', 'events')

    <main class="p-6 text-gray-800">
        <div class="max-w-4xl mx-auto">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h2 class="text-2xl font-bold text-gray-900">Tambah Juri</h2>
                    <p class="mt-1 text-sm text-gray-600">Tambahkan akun juri baru beserta informasi detailnya.</p>
                </div>
                <a href="{{ route('admin.juri.index') }}" class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-900 transition">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                    Kembali
                </a>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                <form action="{{ route('admin.juri.store') }}" method="POST">
                    @csrf
                    
                    <div class="p-8 space-y-8">
                        <!-- Akun Section -->
                        <div>
                            <h3 class="text-lg font-medium text-gray-900 border-b border-gray-200 pb-2 mb-4">Informasi Akun</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap</label>
                                    <input name="name" type="text" class="w-full bg-white border border-gray-300 shadow-sm text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block p-2.5 transition" placeholder="Masukkan nama lengkap akun" required />
                                </div>
                                
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                                    <input name="email" type="email" class="w-full bg-white border border-gray-300 shadow-sm text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block p-2.5 transition" placeholder="email@contoh.com" required />
                                </div>

                                <div class="md:col-span-2">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                                    <input name="password" type="password" class="w-full bg-white border border-gray-300 shadow-sm text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block p-2.5 transition" placeholder="Minimal 8 karakter" required />
                                </div>
                            </div>
                        </div>

                        <!-- Profil Juri Section -->
                        <div>
                            <h3 class="text-lg font-medium text-gray-900 border-b border-gray-200 pb-2 mb-4">Profil Juri</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="md:col-span-2">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Nama Tampil Juri (dengan Gelar)</label>
                                    <input name="nama" type="text" class="w-full bg-white border border-gray-300 shadow-sm text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block p-2.5 transition" placeholder="Contoh: Dr. Budi Santoso, M.Kom" required />
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Keahlian (Bidang Penilaian)</label>
                                    <input name="keahlian" type="text" class="w-full bg-white border border-gray-300 shadow-sm text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block p-2.5 transition" placeholder="Contoh: Pemrograman Web" />
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Instansi</label>
                                    <input name="instansi" type="text" class="w-full bg-white border border-gray-300 shadow-sm text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block p-2.5 transition" placeholder="Contoh: Universitas Indonesia" />
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-gray-50 px-8 py-5 border-t border-gray-200 flex items-center justify-end gap-3">
                        <a href="{{ route('admin.juri.index') }}" class="px-5 py-2.5 text-sm font-medium text-gray-700 hover:text-gray-900 bg-white hover:bg-gray-50 border border-gray-300 rounded-lg transition shadow-sm">
                            Batal
                        </a>
                        <button type="submit" class="px-5 py-2.5 text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 rounded-lg transition shadow-sm flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            Simpan Data Juri
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </main>
</x-admin-layout>
