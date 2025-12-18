@props(['title' => '', 'icon' => ''])

<div class="bg-white rounded-lg shadow p-6">
    @if ($title)
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-xl font-bold text-gray-800">
                @if ($icon)
                    <span class="mr-2">{{ $icon }}</span>
                @endif
                {{ $title }}
            </h3>
            @isset($actions)
                <div>{{ $actions }}</div>
            @endisset
        </div>
    @endif

    <div>
        {{ $slot }}
    </div>
</div>
