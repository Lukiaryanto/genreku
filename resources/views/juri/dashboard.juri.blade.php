<x-admin-layout>

    <div class="min-h-screen bg-gray-900">
        <div class="w-full">
            <div class="flex items-stretch">
                <x-juri-sidebar active="dashboard" />

                <main class="flex-1 p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <h2 class="text-2xl font-semibold text-white">Dashboard Juri</h2>
                            <p class="text-sm text-gray-300">Selamat datang, {{ Auth::user()->name ?? 'Juri' }}.</p>
                        </div>
                        <div class="flex items-center space-x-4">
                            <div class="text-sm text-gray-300">Role: <span
                                    class="font-medium text-white">{{ Auth::user()->role ?? '-' }}</span></div>
                        </div>
                    </div>

                    <div class="mt-6">
                        <div class="bg-gray-800 p-6 rounded-lg shadow text-gray-200">
                            <h3 class="text-lg font-medium">Panel Juri</h3>
                            <p class="mt-2 text-sm">Konten khusus untuk juri ditampilkan di sini.</p>
                        </div>
                    </div>
                </main>
            </div>
        </div>
    </div>

</x-admin-layout>
