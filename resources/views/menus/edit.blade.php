<x-app-layout>
    <x-slot name="title">Edit Menu</x-slot>
    <x-slot name="header">Edit Menu - {{ $menu->name }}</x-slot>

    <div class="max-w-2xl">
        <x-card>
            <form action="{{ route('menus.update', $menu) }}" method="POST">
                @csrf
                @method('PUT')

                <x-select name="category_id" label="Kategori" required>
                    <option value="">Pilih Kategori</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}"
                            {{ old('category_id', $menu->category_id) == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </x-select>

                <x-input name="name" label="Nama Menu" placeholder="Contoh: Nasi Goreng Spesial" :value="old('name', $menu->name)"
                    required />

                <div class="mb-4">
                    <label for="description" class="block text-gray-700 text-sm font-bold mb-2">Deskripsi</label>
                    <textarea name="description" id="description" rows="3"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500"
                        placeholder="Deskripsi menu">{{ old('description', $menu->description) }}</textarea>
                </div>

                <x-input name="price" type="number" label="Harga (Rp)" placeholder="15000" :value="old('price', $menu->price)"
                    step="0.01" min="0" required />

                <div class="mb-6">
                    <label class="flex items-center">
                        <input type="checkbox" name="is_available" value="1"
                            {{ old('is_available', $menu->is_available) ? 'checked' : '' }} class="mr-2">
                        <span class="text-sm text-gray-700 font-bold">Menu Tersedia</span>
                    </label>
                </div>

                <div class="flex space-x-4">
                    <x-button type="submit" variant="warning">Update Menu</x-button>
                    <a href="{{ route('menus.index') }}">
                        <x-button type="button" variant="secondary">Batal</x-button>
                    </a>
                </div>
            </form>
        </x-card>
    </div>
</x-app-layout>
