@section('sidebar_active', 'dashboard')

<x-admin-layout>
    <main class="p-6 text-gray-800">

                <!-- Main content -->
                <main class="flex-1 p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <h2 class="text-2xl font-semibold text-gray-900">Dashboard</h2>
                            <p class="text-sm text-gray-600">Selamat datang, {{ Auth::user()->name ?? 'Admin' }}.</p>
                        </div>
                        <div class="flex items-center space-x-4">
                            <div class="text-sm text-gray-600">Role: <span
                                    class="font-medium text-gray-900">{{ Auth::user()->role ?? '-' }}</span></div>
                        </div>
                    </div>

                    <div class="mt-6 grid grid-cols-1 sm:grid-cols-3 gap-6">
                        <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm relative overflow-hidden">
                            <div class="text-sm font-medium text-gray-500">Total Peserta</div>
                            <div class="mt-2 text-4xl font-bold text-teal-600">{{ $total_peserta ?? 0 }}</div>
                            <div class="mt-2 text-xs text-gray-500">Terdaftar di sistem</div>
                        </div>

                        <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm relative overflow-hidden">
                            <div class="text-sm font-medium text-gray-500">Sudah Tes</div>
                            <div class="mt-2 text-4xl font-bold text-indigo-600">{{ $sudah_tes ?? 0 }}</div>
                            <div class="mt-2 text-xs text-gray-500">{{ $persen_sudah ?? 0 }}% dari total</div>
                        </div>

                        <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm relative overflow-hidden">
                            <div class="text-sm font-medium text-gray-500">Belum Tes</div>
                            <div class="mt-2 text-4xl font-bold text-orange-600">{{ $belum_tes ?? 0 }}</div>
                            <div class="mt-2 text-xs text-gray-500">{{ $persen_belum ?? 0 }}% dari total</div>
                        </div>
                    </div>     
                    <div class="mt-8">
                        <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
                            <div class="p-6 border-b border-gray-200 flex justify-between items-center bg-white">
                                <h3 class="text-lg font-medium text-gray-900">Pendaftar Terbaru</h3>
                                <a href="{{ route('admin.users.index') }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-700 bg-gray-50 border border-gray-200 px-3 py-1.5 rounded-lg transition-colors">Lihat semua</a>
                            </div>
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Nama</th>
                                            <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Asal Daerah</th>
                                            <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Tanggal Daftar</th>
                                            <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-200 bg-white">
                                        @forelse ($pendaftar_terbaru as $pendaftar)
                                            <tr class="hover:bg-gray-50 transition-colors">
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $pendaftar->nama ?? '-' }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $pendaftar->alamat ?? $pendaftar->asal_instansi ?? '-' }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $pendaftar->created_at->format('d M Y') }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                                    @php
                                                        $isSudahDinilai = $pendaftar->hasilFuzzies->first() !== null;
                                                        $status = $isSudahDinilai ? 'Sudah dinilai' : 'Belum dinilai';
                                                        $badgeColor = $isSudahDinilai ? 'bg-emerald-100 text-emerald-800 border-emerald-200' : 'bg-orange-100 text-orange-800 border-orange-200';
                                                    @endphp
                                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium border {{ $badgeColor }}">
                                                        {{ $status }}
                                                    </span>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4" class="px-6 py-8 text-center text-gray-500">Belum ada pendaftar terbaru.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
            </main>
</x-admin-layout>
