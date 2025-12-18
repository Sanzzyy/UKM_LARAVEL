@props(['label', 'value', 'icon', 'color' => 'blue'])

@php
    $colors = [
        'blue' => 'bg-blue-100',
        'green' => 'bg-green-100',
        'purple' => 'bg-purple-100',
        'yellow' => 'bg-yellow-100',
        'red' => 'bg-red-100',
        'orange' => 'bg-orange-100',
    ];
@endphp

<div
    class="bg-white rounded-xl shadow-sm
           p-4 sm:p-5
           flex items-center gap-3 sm:gap-4
           hover:shadow transition">

    <!-- Icon -->
    <div
        class="flex items-center justify-center
               w-10 h-10 sm:w-12 sm:h-12
               rounded-lg bg-orange-100
               text-lg sm:text-xl">
        {{ $icon }}
    </div>

    <!-- Text -->
    <div class="flex-1 min-w-0">
        <p class="text-xs sm:text-sm text-gray-500 truncate">
            {{ $label }}
        </p>

        <p class="text-lg sm:text-xl lg:text-2xl
                   font-bold text-gray-800 leading-tight truncate">
            {{ $value }}
        </p>
    </div>
</div>
