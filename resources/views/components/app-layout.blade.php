<!DOCTYPE html>
<html lang="id">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>{{ $title ?? 'Mitra Nasi Goreng' }}</title>

        {{-- WAJIB --}}
        @vite(['resources/css/app.css', 'resources/js/app.js'])

    </head>

    <body class="bg-gray-100">
        <div x-data="{ sidebarOpen: false }" class="min-h-screen flex">

            <!-- Sidebar -->
            <x-sidebar />

            <!-- Main Content -->
            <main class="flex-1 overflow-y-auto">
                <!-- Header -->
                <x-header :title="$header ?? ($title ?? 'Dashboard')" />


                <!-- Content -->
                <div class="p-4 md:p-8">
                    <x-alert />
                    {{ $slot }}
                </div>
            </main>

        </div>
    </body>

</html>
