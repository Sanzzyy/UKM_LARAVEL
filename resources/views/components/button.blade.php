@props([
    'type' => 'button',
    'variant' => 'primary',
    'size' => 'md',
    'icon' => null,
])

@php
    $variants = [
        'primary' => 'bg-sky-500 hover:bg-sky-600 text-white',
        'secondary' => 'bg-gray-300 hover:bg-gray-400 text-gray-800',
        'success' => 'bg-green-500 hover:bg-green-600 text-white',
        'danger' => 'bg-red-500 hover:bg-red-600 text-white',
        'info' => 'bg-blue-500 hover:bg-blue-600 text-white',
        'warning' => 'bg-yellow-500 hover:bg-yellow-600 text-white',
    ];

    $sizes = [
        'sm' => 'px-3 py-1 text-sm',
        'md' => 'px-6 py-2',
        'lg' => 'px-8 py-3 text-lg',
    ];
@endphp

<button type="{{ $type }}"
    {{ $attributes->merge(['class' => $variants[$variant] . ' ' . $sizes[$size] . ' rounded-lg font-semibold transition duration-200 inline-flex items-center justify-center']) }}>
    @if ($icon)
        <span class="mr-2">{{ $icon }}</span>
    @endif
    {{ $slot }}
</button>
