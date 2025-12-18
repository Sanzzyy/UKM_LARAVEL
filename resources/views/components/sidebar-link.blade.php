@props(['href', 'active' => false, 'icon' => ''])

<a href="{{ $href }}"
    class="
    group flex items-center gap-3
    px-6 py-3
    transition-all duration-200
    {{ $active ? 'bg-white/20 border-l-4 border-white shadow-md' : 'hover:bg-white/10' }}
   ">
    <span class="text-lg">
        {{ $icon }}
    </span>

    <span class="text-sm font-medium tracking-wide">
        {{ $slot }}
    </span>

    @if ($active)
        <span class="ml-auto w-2 h-2 rounded-full bg-white"></span>
    @endif
</a>
