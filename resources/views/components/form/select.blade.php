@props(['label', 'name', 'hint' => null])

@php
    $hasError = $errors->has($name);
@endphp

<div class="space-y-1">
    {{-- Label --}}
    <label for="{{ $name }}" class="block text-sm font-semibold text-gray-700">
        {{ $label }}
    </label>

    {{-- Select --}}
    <select name="{{ $name }}" id="{{ $name }}"
        {{ $attributes->merge([
            'class' =>
                '
                                w-full rounded-lg border px-4 py-2 text-sm bg-white
                                transition duration-200
                                focus:outline-none focus:ring-2
                                ' .
                ($hasError
                    ? 'border-red-500 focus:ring-red-400'
                    : 'border-gray-300 focus:ring-orange-500 hover:border-orange-400'),
        ]) }}>
        {{ $slot }}
    </select>

    {{-- Error --}}
    @error($name)
        <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
    @enderror

    {{-- Hint --}}
    @if ($hint && !$hasError)
        <p class="text-xs text-gray-500">{{ $hint }}</p>
    @endif
</div>
