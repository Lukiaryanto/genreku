<!DOCTYPE html>
<html class="h-full bg-gray-50">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css" />
    @vite('resources/css/app.css')

</head>

<body class="h-full bg-gray-50 text-gray-800">

    <div class="min-h-full">

        <!-- Reuse admin navbar for consistent header across roles -->
        <x-admin-navbar />

        {{-- Render sidebar once for pimpinan pages. Pages can set a section 'sidebar_active' to control active menu --}}
        @php
            $sidebarActive = trim($__env->yieldContent('sidebar_active')) ?: '';
            $hasSidebar = $sidebarActive !== '';
        @endphp

        @if ($hasSidebar)
            <x-pimpinan-sidebar :active="$sidebarActive" />
        @endif

        <main class="pt-16"> {{-- reserve space for fixed header (h-16) --}}
            <div class="w-full {{ $hasSidebar ? 'pl-64' : '' }}"> {{-- add left padding only when sidebar present --}}
                @if (session('success'))
                    <div class="p-6 pb-0">
                        <div class="bg-emerald-50 border border-emerald-400 text-emerald-800 px-4 py-3 rounded-lg shadow flex items-center justify-between" role="alert">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 mr-3 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span class="block sm:inline font-medium">{{ session('success') }}</span>
                            </div>
                            <button type="button" onclick="this.parentElement.remove()" class="text-emerald-600 hover:text-emerald-800 transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                @endif
                {{ $slot }}
            </div>
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@tailwindplus/elements@1" type="module"></script>
</body>

</html>
