<aside
    class="fixed inset-y-0 left-0 z-40 w-64
           bg-gradient-to-b from-slate-700 to-slate-800
           text-white
           transform -translate-x-full md:translate-x-0
           transition-transform duration-300 ease-in-out
           md:static md:inset-0"
    :class="{ 'translate-x-0': sidebarOpen }">

    <!-- Brand & User -->
    <div class="p-6 border-b border-white/10">

        <!-- User Info -->
        <div class="mt-4 flex items-center gap-3">
            <!-- Avatar -->
            <div
                class="w-10 h-10 rounded-full bg-orange-500/90
                       flex items-center justify-center
                       font-bold text-lg text-white">
                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
            </div>

            <!-- Name & Role -->
            <div class="leading-tight">
                <p class="text-sm font-semibold">
                    {{ auth()->user()->name }}
                </p>
                <span
                    class="inline-flex items-center px-2 py-0.5
                           text-xs rounded-full
                           bg-orange-500/20 text-orange-200">
                    {{ ucfirst(auth()->user()->role) }}
                </span>
            </div>
        </div>
    </div>

    <!-- Navigation -->
    <nav class="mt-4 px-3 space-y-1">
        <x-sidebar-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')" icon="📊">
            Dashboard
        </x-sidebar-link>

        @if (auth()->user()->isAdmin())
            <x-sidebar-link href="{{ route('menus.index') }}" :active="request()->routeIs('menus.*')" icon="🍴">
                Kelola Menu
            </x-sidebar-link>
        @endif

        <x-sidebar-link href="{{ route('transactions.index') }}" :active="request()->routeIs('transactions.index')" icon="📝">
            Riwayat Transaksi
        </x-sidebar-link>

        @if (auth()->user()->isKasir() || auth()->user()->isAdmin())
            <x-sidebar-link href="{{ route('transactions.create') }}" :active="request()->routeIs('transactions.create')" icon="💳">
                Transaksi Baru
            </x-sidebar-link>
        @endif
    </nav>

    <!-- Logout -->
    <div class="absolute bottom-0 w-full p-4 border-t border-white/10">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit"
                class="w-full flex items-center justify-center gap-2
                       bg-red-500/90 hover:bg-red-600
                       py-2.5 rounded-lg
                       transition font-semibold">
                Keluar
            </button>
        </form>
    </div>
</aside>

<!-- Overlay Mobile -->
<div x-show="sidebarOpen" x-transition.opacity class="fixed inset-0 bg-black/40 backdrop-blur-sm z-30 md:hidden"
    @click="sidebarOpen = false">
</div>
