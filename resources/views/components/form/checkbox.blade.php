@props(['label', 'name'])

<label class="inline-flex items-center space-x-2">
    <input type="checkbox" name="{{ $name }}" value="1" {{ old($name, true) ? 'checked' : '' }}
        class="rounded border-gray-300 text-orange-600 focus:ring-orange-500">
    <span class="text-sm font-semibold text-gray-700">{{ $label }}</span>
</label>
