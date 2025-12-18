@props(['label', 'name', 'type' => 'text', 'value' => null, 'hint' => null, 'icon' => null])

@php
    $hasError = $errors->has($name);
@endphp

<div class="space-y-1">
    {{-- Label --}}
    <label for="{{ $name }}" class="block text-sm font-semibold text-gray-700">
        {{ $label }}
    </label>

    {{-- Input Wrapper --}}
    <div class="relative">
        {{-- Icon (optional) --}}
        @if ($icon)
            <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                {{ $icon }}
            </span>
        @endif

        {{-- Input --}}
        <input type="{{ $type }}" name="{{ $name }}" id="{{ $name }}"
            value="{{ $value ?? old($name) }}"
            {{ $attributes->merge([
                'class' =>
                    '
                                w-full rounded-lg border px-4 py-2 text-sm
                                transition duration-200
                                focus:outline-none focus:ring-2
                                ' .
                    ($icon ? 'pl-10 ' : '') .
                    ($hasError
                        ? 'border-red-500 focus:ring-red-400'
                        : 'border-gray-300 focus:ring-orange-500 hover:border-orange-400'),
            ]) }}>
    </div>

    {{-- Error Message --}}
    @error($name)
        <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
    @enderror

    {{-- Hint --}}
    @if ($hint && !$hasError)
        <p class="text-xs text-gray-500">{{ $hint }}</p>
    @endif
</div>
