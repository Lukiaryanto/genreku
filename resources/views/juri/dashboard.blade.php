@section('sidebar_active', 'dashboard')

<x-admin-layout>
    <main class="p-8 font-sans text-gray-800">
        <!-- Summary Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
            <!-- Card 1 -->
            <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-200">
                <h3 class="text-sm font-medium text-gray-500 mb-4">Peserta Dinilai</h3>
                <div class="text-4xl font-bold text-emerald-600 mb-2">{{ $dinilai }}</div>
                <p class="text-sm text-gray-500">dari {{ $totalPeserta }} peserta</p>
            </div>
            
            <!-- Card 2 -->
            <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-200">
                <h3 class="text-sm font-medium text-gray-500 mb-4">Belum Dinilai</h3>
                <div class="text-4xl font-bold text-orange-600 mb-2">{{ $belumDinilai }}</div>
                <p class="text-sm text-gray-500">Harap segera input</p>
            </div>

            <!-- Card 3 -->
            <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-200">
                <h3 class="text-sm font-medium text-gray-500 mb-4">Rata-rata Nilai</h3>
                <div class="text-4xl font-bold text-indigo-600 mb-2">{{ $rataRata }}</div>
                <p class="text-sm text-gray-500">Nilai juri</p>
            </div>
        </div>

        <!-- Header Section -->
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-xl font-bold text-gray-900">Peserta Belum Dinilai</h2>
            <a href="{{ route('juri.input_wawancara') }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors shadow-sm">
                Input Nilai 
                <svg class="ml-2 -mr-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
            </a>
        </div>

        <!-- Table Section -->
        <div class="bg-white rounded-xl border border-gray-200 overflow-hidden shadow-sm">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-4 text-left text-sm font-semibold text-gray-600">Nama</th>
                        <th scope="col" class="px-6 py-4 text-left text-sm font-semibold text-gray-600">Asal</th>
                        <th scope="col" class="px-6 py-4 text-left text-sm font-semibold text-gray-600">Nilai Tes</th>
                        <th scope="col" class="px-6 py-4 text-left text-sm font-semibold text-gray-600">Status Penilaian</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($belumDinilaiList as $peserta)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                            {{ $peserta->nama }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                            {{ $peserta->asal }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                            {{ $peserta->nilai_tes }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-orange-100 text-orange-800">
                                Belum dinilai
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-6 py-8 text-center text-gray-500">
                            Semua peserta telah dinilai.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </main>
</x-admin-layout>
