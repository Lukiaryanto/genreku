@props(['active' => ''])

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

        <!-- Header -->
        <x-peserta-header :title="$header ?? ''" />

        <!-- Sidebar -->
        <x-peserta-sidebar :active="$active" />

        <main class="pt-16"> {{-- reserve space for fixed header (h-16) --}}
            <div class="lg:pl-64 w-full"> {{-- sidebar only shifts on desktop --}}
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
                <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
                    {{ $slot }}
                </div>
            </div>
        </main>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/@tailwindplus/elements@1" type="module"></script>

    {{-- Mobile Sidebar Toggle Script --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const toggleBtn = document.getElementById('sidebar-toggle');
            const sidebar   = document.getElementById('peserta-sidebar');
            const overlay   = document.getElementById('sidebar-overlay');
            let isOpen = false;

            function openSidebar() {
                sidebar.style.transform = 'translateX(0)';
                if (overlay) { overlay.style.display = 'block'; }
                isOpen = true;
            }

            function closeSidebar() {
                sidebar.style.transform = 'translateX(-100%)';
                if (overlay) { overlay.style.display = 'none'; }
                isOpen = false;
            }

            // On desktop (>=1024px): sidebar always visible, no overlay
            function handleResize() {
                if (window.innerWidth >= 1024) {
                    sidebar.style.transform = 'translateX(0)';
                    if (overlay) { overlay.style.display = 'none'; }
                    isOpen = true;
                } else {
                    if (isOpen) return; // keep open if user opened it
                    closeSidebar();
                }
            }

            // Initialize based on current viewport
            handleResize();
            window.addEventListener('resize', handleResize);

            // Hamburger button
            if (toggleBtn) {
                toggleBtn.addEventListener('click', function () {
                    isOpen ? closeSidebar() : openSidebar();
                });
            }

            // Overlay click to close
            if (overlay) {
                overlay.addEventListener('click', closeSidebar);
            }

            // Close sidebar when nav link is clicked on mobile
            if (sidebar) {
                sidebar.querySelectorAll('a').forEach(function (link) {
                    link.addEventListener('click', function () {
                        if (window.innerWidth < 1024) closeSidebar();
                    });
                });
            }

            // Expose closeSidebar globally for overlay onclick fallback
            window.closeSidebar = closeSidebar;
        });
    </script>
</body>

</html>
