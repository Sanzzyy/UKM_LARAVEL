<x-app-layout>
    <x-slot name="title">Kelola Menu</x-slot>
    <x-slot name="header">Kelola Menu</x-slot>

    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6 gap-3">
        <h2 class="text-xl font-bold text-gray-800">Daftar Menu</h2>

        <a href="{{ route('menus.create') }}">
            <x-button variant="primary">
                Tambah Menu
            </x-button>
        </a>
    </div>

    <!-- Table Card -->
    <x-card>
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm">
                <thead class="bg-gray-100 text-gray-600 uppercase text-xs">
                    <tr>
                        <th class="px-6 py-3 text-left">No</th>
                        <th class="px-6 py-3 text-left">Nama Menu</th>
                        <th class="px-6 py-3 text-left">Kategori</th>
                        <th class="px-6 py-3 text-left">Harga</th>
                        <th class="px-6 py-3 text-left">Status</th>
                        <th class="px-6 py-3 text-left">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-200 bg-white">
                    @forelse ($menus as $menu)
                        <tr class="hover:bg-gray-50 transition">
                            <!-- Nomor -->
                            <td class="px-6 py-4 text-gray-900">
                                {{ $menus->firstItem() + $loop->index }}
                            </td>

                            <!-- Nama -->
                            <td class="px-6 py-4">
                                <div class="font-semibold text-gray-800">
                                    {{ $menu->name }}
                                </div>
                                <div class="text-gray-500 text-xs">
                                    {{ Str::limit($menu->description, 50) }}
                                </div>
                            </td>

                            <!-- Kategori -->
                            <td class="px-6 py-4 text-gray-600">
                                {{ $menu->category->name }}
                            </td>

                            <!-- Harga -->
                            <td class="px-6 py-4 font-semibold text-gray-800">
                                Rp {{ number_format($menu->price, 0, ',', '.') }}
                            </td>

                            <!-- Status -->
                            <td class="px-6 py-4">
                                @if ($menu->is_available)
                                    <span
                                        class="inline-flex px-3 py-1 text-xs font-semibold rounded-full
                                               bg-green-100 text-green-700">
                                        Tersedia
                                    </span>
                                @else
                                    <span
                                        class="inline-flex px-3 py-1 text-xs font-semibold rounded-full
                                               bg-red-100 text-red-700">
                                        Tidak Tersedia
                                    </span>
                                @endif
                            </td>

                            <!-- Aksi -->
                            <td class="px-6 py-4">
                                <div class="flex gap-2">
                                    <a href="{{ route('menus.edit', $menu) }}">
                                        <x-button size="sm" variant="warning">
                                            Edit
                                        </x-button>
                                    </a>

                                    <form action="{{ route('menus.destroy', $menu) }}" method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus menu ini?')">
                                        @csrf
                                        @method('DELETE')

                                        <x-button size="sm" variant="danger">
                                            Hapus
                                        </x-button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-6 text-center text-gray-500">
                                Belum ada menu
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <x-pagination :paginator="$menus" />


    </x-card>
</x-app-layout>
