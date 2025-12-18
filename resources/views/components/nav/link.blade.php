@props(['active' => false])

<a
    {{ $attributes->merge([
        'class' =>
            'flex items-center px-6 py-3 transition
                hover:bg-slate-700 ' . ($active ? 'bg-slate-700 border-l-4 border-white' : ''),
    ]) }}>
    {{ $slot }}
</a>
