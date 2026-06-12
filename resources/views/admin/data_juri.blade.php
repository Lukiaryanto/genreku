@section('sidebar_active', 'events')

<x-admin-layout>
    <main class="p-6 text-gray-800">
                <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
                    @if (session('success'))
                        <div class="mb-4 rounded bg-green-600 p-3 text-white text-sm">{{ session('success') }}</div>
                    @endif

                    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                        <div>
                            <h2 class="text-xl font-semibold text-gray-900">Data Juri</h2>
                            <p class="mt-2 text-sm text-gray-600">Kelola data juri kompetisi.</p>
                        </div>
                        <div class="flex flex-wrap items-center gap-3">
                            {{-- Filter Tahun --}}
                            <form action="{{ route('admin.juri.index') }}" method="GET" class="flex items-center gap-2">
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

                            <a href="{{ route('admin.juri.create') }}"
                                class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-lg hover:bg-indigo-500 transition shadow-sm">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                                Tambah Juri
                            </a>
                        </div>
                    </div>

                    <div class="mt-6 overflow-x-auto rounded-lg border border-gray-200">
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
                                        Instansi</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">
                                        Email</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">
                                        Bidang Penilaian</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">
                                        Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($juris as $user)
                                    @php $juri = $user->juri; @endphp
                                    <tr class="hover:bg-gray-50 transition-colors">
                                        <td class="px-6 py-4 text-sm text-gray-600">
                                            {{ $loop->iteration + ($juris->currentPage() - 1) * $juris->perPage() }}</td>
                                        <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $juri->nama }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-600">
                                            {{ optional($user->peserta)->asal_instansi ?? (optional($juri)->instansi ?? '-') }}
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-600">{{ $user->email }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-600">
                                            {{ optional($juri)->keahlian ?? '-' }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-600">
                                            @if ($juri)
                                                <a href="{{ route('admin.juri.edit', $juri->id) }}"
                                                    class="px-2 py-1 bg-blue-600 hover:bg-blue-700 transition-colors text-white rounded text-xs">Edit</a>
                                                <form action="{{ route('admin.juri.destroy', $juri->id) }}"
                                                    method="POST" class="inline"
                                                    onsubmit="return confirm('Hapus juri ini?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="px-2 py-1 bg-red-600 hover:bg-red-700 transition-colors text-white rounded text-xs">Hapus</button>
                                                </form>
                                            @else
                                                <a href="{{ route('admin.juri.create', ['user_id' => $user->id]) }}"
                                                    class="text-green-600 hover:underline">Tambah Juri</a>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="px-6 py-8 text-center text-sm text-gray-500">Belum ada
                                            data juri.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4">{{ $juris->links() }}</div>
                </div>
            </main>
</x-admin-layout>
