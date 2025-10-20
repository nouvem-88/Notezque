@props(['title', 'value', 'icon', 'color' => 'indigo'])

@php
    $bgClass = 'bg-' . $color . '-500';
    $iconBgClass = 'bg-' . $color . '-600';
    $shadowClass = 'shadow-lg shadow-' . $color . '-200/50';
@endphp

<div
    class="flex items-center p-5 {{$bgClass}} rounded-2xl {{$shadowClass}} transform transition duration-300 hover:scale-[1.02] text-white">
    <!-- Icon -->
    <div class="flex-shrink-0 w-14 h-14 {{$iconBgClass}} rounded-full flex items-center justify-center text-2xl">
        <i class="fas {{ $icon }}"></i>
    </div>

    <!-- Data -->
    <div class="ml-5">
        <h3 class="text-sm font-medium opacity-80 uppercase">{{ $title }}</h3>
        <p class="text-3xl font-extrabold mt-1">{{ $value }}</p>
    </div>
</div>