<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Data Nilai') }}
        </h2>
    </x-slot>

    <div class="min-h-screen bg-gray-900">
        <div class="w-full">
            <main class="flex-1 p-6">
                <div class="bg-gray-800 p-6 rounded-lg shadow">
                    <div class="flex items-center justify-between">
                        <div>
                            <h2 class="text-xl font-semibold text-white">Data Nilai</h2>
                            <p class="mt-2 text-sm text-gray-300">Daftar peserta dan nilai terbaru.</p>
                        </div>
                    </div>

                    <div class="mt-6 overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-700">
                            <thead>
                                <tr>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                        No</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                        Nama</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                        Alamat</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                        Asal Instansi</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                        Nilai Terbaru</th>
                                </tr>
                            </thead>
                            <tbody class="bg-gray-800 divide-y divide-gray-700">
                                @forelse ($users as $user)
                                    @php
                                        $p = $user->peserta;
                                        $n = $p ? $latestNilai[$p->id] ?? null : null;
                                    @endphp
                                    <tr>
                                        <td class="px-6 py-4 text-sm text-gray-300">
                                            {{ $loop->iteration + ($users->currentPage() - 1) * $users->perPage() }}
                                        </td>
                                        <td class="px-6 py-4 text-sm text-white">{{ optional($p)->nama ?? $user->name }}
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-300">{{ optional($p)->alamat ?? '-' }}
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-300">
                                            {{ optional($p)->asal_instansi ?? '-' }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-300">
                                            {{ $n ? $n->nilai_tes ?? '-' : '-' }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-6 py-4 text-center text-sm text-gray-400">Tidak ada
                                            peserta.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4">{{ $users->links() }}</div>
                </div>
            </main>
        </div>
    </div>
</x-admin-layout>
