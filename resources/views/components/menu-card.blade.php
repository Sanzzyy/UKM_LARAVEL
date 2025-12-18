@props(['menu'])

<div class="border border-gray-200 rounded-lg p-4 hover:border-orange-500 hover:shadow-md cursor-pointer transition duration-200"
    onclick="addItem({{ $menu->id }}, '{{ addslashes($menu->name) }}', {{ $menu->price }})">
    <h5 class="font-semibold text-gray-800 mb-1">{{ $menu->name }}</h5>
    <p class="text-sm text-gray-600 mb-2">{{ Str::limit($menu->description, 50) }}</p>
    <p class="text-lg font-bold text-orange-600">Rp {{ number_format($menu->price, 0, ',', '.') }}</p>
</div>
