@props([
    'label' => '',
    'name' => '',
    'required' => false,
])

<div class="mb-4">
    @if ($label)
        <label for="{{ $name }}" class="block text-gray-700 text-sm font-bold mb-2">
            {{ $label }}
            @if ($required)
                <span class="text-red-500">*</span>
            @endif
        </label>
    @endif

    <select name="{{ $name }}" id="{{ $name }}" {{ $required ? 'required' : '' }}
        {{ $attributes->merge(['class' => 'w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500']) }}>
        {{ $slot }}
    </select>
</div>
