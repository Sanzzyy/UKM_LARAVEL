@props(['label', 'name', 'rows' => 3])

@php
    $hasError = $errors->has($name);

    $value = old($name);

    if ($value === null) {
        $value = trim($slot);
    }
@endphp

<div class="space-y-1">
    {{-- Label --}}
    <label for="{{ $name }}" class="block text-sm font-semibold text-gray-700">
        {{ $label }}
    </label>

    {{-- Textarea --}}
    <textarea name="{{ $name }}" id="{{ $name }}" rows="{{ $rows }}"
        {{ $attributes->merge([
            'class' =>
                '
                        w-full rounded-lg border px-4 py-2 text-sm
                        transition duration-200
                        focus:outline-none focus:ring-2
                        ' .
                ($hasError
                    ? 'border-red-500 focus:ring-red-400'
                    : 'border-gray-300 focus:ring-orange-500 hover:border-orange-400'),
        ]) }}>{{ $value }}</textarea>

    {{-- Error --}}
    @error($name)
        <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
    @enderror
</div>
