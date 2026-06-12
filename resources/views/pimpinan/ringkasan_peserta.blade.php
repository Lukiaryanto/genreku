@php
    /**
     * View: pimpinan.ringkasan_peserta
     * Variables expected: $users (Paginator of User with peserta relation), $latestNilai (map peserta_id => Penilaian)
     */
@endphp

@section('sidebar_active', 'ringkasan')

<x-admin-layout>
    <main class="p-8 font-sans text-gray-800">
        {{-- Summary Cards --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            {{-- Total Pendaftar --}}
            <div class="bg-white p-6 rounded-2xl border border-gray-200 shadow-sm group hover:border-emerald-500 transition-all duration-300 hover:shadow-md">
                <div class="text-sm font-semibold text-gray-500 uppercase tracking-wider mb-2">Total Pendaftar</div>
                <div class="text-4xl font-bold text-emerald-600 group-hover:scale-105 transition-transform duration-300">{{ $stats->total }}</div>
            </div>

            {{-- Lolos Seleksi --}}
            <div class="bg-white p-6 rounded-2xl border border-gray-200 shadow-sm group hover:border-indigo-500 transition-all duration-300 hover:shadow-md">
                <div class="text-sm font-semibold text-gray-500 uppercase tracking-wider mb-2">Lolos Seleksi</div>
                <div class="text-4xl font-bold text-indigo-600 group-hover:scale-105 transition-transform duration-300">{{ $stats->lolos }}</div>
            </div>

            {{-- Sedang Proses --}}
            <div class="bg-white p-6 rounded-2xl border border-gray-200 shadow-sm group hover:border-orange-500 transition-all duration-300 hover:shadow-md">
                <div class="text-sm font-semibold text-gray-500 uppercase tracking-wider mb-2">Sedang Proses</div>
                <div class="text-4xl font-bold text-orange-500 group-hover:scale-105 transition-transform duration-300">{{ $stats->proses }}</div>
            </div>

            {{-- Gugur --}}
            <div class="bg-white p-6 rounded-2xl border border-gray-200 shadow-sm group hover:border-red-500 transition-all duration-300 hover:shadow-md">
                <div class="text-sm font-semibold text-gray-500 uppercase tracking-wider mb-2">Gugur</div>
                <div class="text-4xl font-bold text-red-600 group-hover:scale-105 transition-transform duration-300">{{ $stats->gugur }}</div>
            </div>
        </div>

        {{-- Table Section --}}
        <div class="bg-white rounded-xl border border-gray-200 overflow-hidden shadow-sm">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">No</th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Nama</th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Jenis Kelamin</th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Alamat</th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Asal Instansi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($users as $index => $user)
                            @php $p = $user->peserta; @endphp
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $users->firstItem() + $index }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $p->nama ?? $user->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                    {{ $p->jenis_kelamin ?? '-' }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ Str::limit($p->alamat ?? '-', 30) }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $p->asal_instansi ?? '-' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-8">
            {{ $users->links() }}
        </div>
    </main>
</x-admin-layout>
