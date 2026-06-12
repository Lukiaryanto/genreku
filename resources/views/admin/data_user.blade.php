<x-admin-layout>

    <div class="min-h-screen bg-gray-50">
        <div class="w-full">
            <div class="w-full">
                @section('sidebar_active', 'users')

                <main class="flex-1 p-6 text-gray-800">
                    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
                        @if (session('success'))
                            <div class="mb-4 rounded bg-green-600 p-3 text-white text-sm">
                                {{ session('success') }}
                            </div>
                        @endif
                        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                            <div>
                                <h2 class="text-xl font-semibold text-gray-900">Data Peserta</h2>
                                <p class="mt-2 text-sm text-gray-600">Daftar peserta kompetisi yang terdaftar.</p>
                            </div>
                            <div class="flex flex-wrap items-center gap-3">
                                {{-- Filter Tahun --}}
                                <form action="{{ route('admin.users.index') }}" method="GET" class="flex items-center gap-2">
                                    <select name="tahun" onchange="this.form.submit()" 
                                        class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2">
                                        <option value="">Semua Tahun</option>
                                        @foreach ($availableYears as $year)
                                            <option value="{{ $year }}" {{ request('tahun') == $year ? 'selected' : '' }}>
                                                Tahun {{ $year }}
                                            </option>
                                        @endforeach
                                    </select>
                                </form>

                                <a href="/users/create"
                                    class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-lg hover:bg-indigo-500 transition shadow-sm">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                                    Tambah Peserta
                                </a>
                            </div>
                        </div>

                        <div class="mt-6">
                            <div class="mb-4 flex items-center justify-between">
                                <div class="text-sm text-gray-600">Menampilkan {{ $users->total() }} peserta</div>
                                {{-- <div>
                                    <a href="{{ route('admin.users.create') }}"
                                        class="px-3 py-2 bg-green-600 text-white rounded">Tambah User</a>
                                </div> --}}
                            </div>

                            <div class="overflow-x-auto rounded-lg border border-gray-200">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">
                                                No</th>
                                            <th
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">
                                                Nama Lengkap</th>
                                            <th
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">
                                                Tanggal Lahir</th>
                                            <th
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">
                                                Pendidikan</th>
                                            <th
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">
                                                Status Seleksi</th>
                                            <th
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">
                                                Aksi</th>
                                        </tr>
                                    </thead>

                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @forelse ($users as $user)
                                            <tr class="hover:bg-gray-50 transition-colors">
                                                <td class="px-6 py-4 text-sm text-gray-600">
                                                    {{ $loop->iteration + ($users->currentPage() - 1) * $users->perPage() }}
                                                </td>
                                                <td class="px-6 py-4 text-sm text-gray-900 font-medium">
                                                    {{ optional($user->peserta)->nama ?? '-' }}</td>
                                                <td class="px-6 py-4 text-sm text-gray-600">
                                                    {{ $user->peserta && $user->peserta->tanggal_lahir ? $user->peserta->tanggal_lahir->format('Y-m-d') : '-' }}
                                                </td>
                                                <td class="px-6 py-4 text-sm text-gray-600">
                                                    {{ optional($user->peserta)->asal_instansi ?? '-' }}</td>
                                                <td class="px-6 py-4 text-sm text-gray-600">D
                                                    {{ optional($user->peserta)->status_seleksi ?? '-' }}</td>
                                                <td class="px-6 py-4 text-sm text-gray-600">
                                                    @if ($user->peserta)
                                                        <a href="{{ route('admin.peserta.show', $user->peserta->id) }}"
                                                            class="px-2 py-1 bg-blue-600 hover:bg-blue-700 text-white rounded text-xs transition-colors">Lihat Detail</a>
                                                        {{-- <a href="{{ route('admin.peserta.show', $user->peserta->id) }}"
                                                            class="px-2 py-1 bg-yellow-500 text-black rounded text-xs ml-2">Edit</a> --}}
                                                        <form
                                                            action="{{ route('admin.peserta.destroy', $user->peserta->id) }}"
                                                            method="POST" class="inline ml-2"
                                                            onsubmit="return confirm('Hapus peserta ini?');">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button
                                                                class="px-2 py-1 bg-red-600 hover:bg-red-700 text-white rounded text-xs transition-colors">Hapus</button>
                                                        </form>
                                                    @else
                                                        <a href="{{ route('admin.users.edit', $user->id) }}"
                                                            class="px-2 py-1 bg-green-600 hover:bg-green-700 text-white rounded text-xs transition-colors">Edit
                                                            User</a>
                                                    @endif
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6" class="px-6 py-8 text-center text-sm text-gray-500">
                                                    Tidak ada data peserta.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>

                            <div class="mt-4">{{ $users->links() }}</div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
    </div>

</x-admin-layout>
