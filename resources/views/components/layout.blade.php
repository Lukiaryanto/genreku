<!DOCTYPE html>
<html class="h-full bg-gray-50">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css" />
    @vite('resources/css/app.css')

</head>

<body class="h-full bg-gray-50 text-gray-900">


    <div class="min-h-full">

        <x-navbar></x-navbar>
        @if (isset($header) && $header != '')
            <x-header>{{ $header }}</x-header>
        @endif
        <main>
            <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
                {{ $slot }}
            </div>
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@tailwindplus/elements@1" type="module"></script>
</body>

</html>
