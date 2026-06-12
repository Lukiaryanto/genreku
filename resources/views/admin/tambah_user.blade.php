<x-admin-layout>

    <div class="min-h-screen bg-gray-50">
        <div class="w-full">
            <div class="w-full">
                @section('sidebar_active', 'users')

                <main class="flex-1 p-6 text-gray-800">
                    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
                        <div class="flex items-center justify-between">
                            <div>
                                <h2 class="text-xl font-semibold text-gray-900">Tambah Peserta</h2>
                                <p class="mt-2 text-sm text-gray-600">Form untuk menambahkan peserta baru.</p>
                            </div>
                            <div>
                                <a href="{{ route('admin.users.index') }}"
                                    class="inline-flex items-center px-3 py-2 bg-gray-100 text-gray-700 font-medium rounded hover:bg-gray-200 transition-colors">Kembali
                                    ke Data User</a>
                            </div>
                        </div>
                        <form class="mt-6" action="{{ route('admin.users.store') }}" method="POST">
                            @csrf
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                                <div>
                                    <label for="name" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                                    <input type="text" name="name" id="name" required
                                        value="{{ old('name') }}"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm bg-white px-3 py-2 text-sm text-gray-900 placeholder-gray-400 focus:outline-none focus:border-indigo-500 focus:ring-indigo-500" />
                                    @error('name')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                                    <input type="email" name="email" id="email" required
                                        value="{{ old('email') }}"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm bg-white px-3 py-2 text-sm text-gray-900 placeholder-gray-400 focus:outline-none focus:border-indigo-500 focus:ring-indigo-500" />
                                    @error('email')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="password"
                                        class="block text-sm font-medium text-gray-700">Password</label>
                                    <input type="password" name="password" id="password" required
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm bg-white px-3 py-2 text-sm text-gray-900 placeholder-gray-400 focus:outline-none focus:border-indigo-500 focus:ring-indigo-500" />
                                    @error('password')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="role" class="block text-sm font-medium text-gray-700">Role</label>
                                    <select name="role" id="role" required
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm bg-white px-3 py-2 text-sm text-gray-900 focus:outline-none focus:border-indigo-500 focus:ring-indigo-500">
                                        <option value="peserta" {{ old('role') == 'peserta' ? 'selected' : '' }}>Peserta
                                        </option>
                                    </select>
                                    @error('role')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="mt-6">
                                <button type="submit"
                                    class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white font-medium rounded hover:bg-indigo-700 transition shadow-sm">Simpan
                                    User</button>
                            </div>
                        </form>
                    </div>
                </main>
            </div>
        </div>
    </div>

</x-admin-layout>
