<header class="bg-white shadow px-4 py-4 flex items-center justify-between">
    <div class="flex items-center gap-3">

        <!-- Hamburger -->
        <button @click="sidebarOpen = true" class="md:hidden text-2xl text-gray-600">
            ☰
        </button>

        <h2 class="text-xl font-semibold text-gray-800">
            {{ $title }}
        </h2>

    </div>
</header>
