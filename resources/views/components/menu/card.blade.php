@props(['id', 'name', 'price', 'description'])

<div onclick="addItem({{ $id }}, @js($name), {{ $price }})"
    class="border border-gray-200 rounded-lg p-4
           hover:border-orange-500 hover:shadow
           cursor-pointer transition">
    <h5 class="font-semibold text-gray-800">{{ $name }}</h5>

    <p class="text-sm text-gray-600 mb-2">
        {{ Str::limit($description, 50) }}
    </p>

    <p class="text-lg font-bold text-orange-600">
        Rp {{ number_format($price, 0, ',', '.') }}
    </p>
</div>
