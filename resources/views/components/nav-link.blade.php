@props([
    'href' => '#',
    'icon' => null,
    'active' => false,
    'badge' => null
])

@php
    $baseClasses = 'flex items-center justify-between py-3 px-4 rounded-lg transition-all duration-200 group';
    $activeClasses = $active 
        ? 'bg-indigo-600 text-white shadow-lg' 
        : 'text-gray-300 hover:bg-gray-700 hover:text-white hover:pl-5';
@endphp

<a href="{{ $href }}" class="{{ $baseClasses }} {{ $activeClasses }}">
    <div class="flex items-center">
        @if($icon)
            <i class="fas {{ $icon }} mr-3 w-5 text-center transition-transform group-hover:scale-110"></i>
        @endif
        <span class="font-medium">{{ $slot }}</span>
    </div>
    
    @if($badge)
        <span class="px-2 py-1 text-xs font-bold rounded-full {{ $active ? 'bg-white text-indigo-600' : 'bg-gray-700 text-gray-300' }}">
            {{ $badge }}
        </span>
    @endif
</a>
