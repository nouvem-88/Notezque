@props([
    'title' => '',
    'value' => '0',
    'icon' => null,
    'trend' => null,
    'color' => 'indigo',
    'variant' => 'default' // 'default' or 'solid'
])

@php
    // Map color to Tailwind classes
    $colorMap = [
        'indigo' => ['bg' => 'bg-indigo-500', 'text' => 'text-indigo-600', 'light' => 'bg-indigo-50'],
        'blue' => ['bg' => 'bg-blue-500', 'text' => 'text-blue-600', 'light' => 'bg-blue-50'],
        'green' => ['bg' => 'bg-green-500', 'text' => 'text-green-600', 'light' => 'bg-green-50'],
        'yellow' => ['bg' => 'bg-yellow-500', 'text' => 'text-yellow-600', 'light' => 'bg-yellow-50'],
        'red' => ['bg' => 'bg-red-500', 'text' => 'text-red-600', 'light' => 'bg-red-50'],
        'purple' => ['bg' => 'bg-purple-500', 'text' => 'text-purple-600', 'light' => 'bg-purple-50'],
    ];
    
    $selectedColor = $color ?? 'indigo';
    $colors = $colorMap[$selectedColor] ?? $colorMap['indigo'];
    $iconName = $icon ?? 'activity';
@endphp

@if($variant === 'solid')
    {{-- Solid Variant (Colored Background) --}}
    <div class="flex items-center p-5 {{ $colors['bg'] }} rounded-2xl shadow-lg transform transition duration-300 hover:scale-[1.02] text-white">
        @if($icon)
            <div class="flex-shrink-0 w-14 h-14 bg-white bg-opacity-20 rounded-full flex items-center justify-center">
                <i class="fas {{ $icon }} text-2xl"></i>
            </div>
        @endif
        
        <div class="ml-5">
            <h3 class="text-sm font-medium opacity-90 uppercase tracking-wide">{{ $title }}</h3>
            <p class="text-3xl font-extrabold mt-1">{{ $value }}</p>
            @if($trend)
                <p class="text-xs mt-2 opacity-90">{{ $trend }}</p>
            @endif
        </div>
    </div>
@else
    {{-- Default Variant (White Background) --}}
    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 transition-all hover:shadow-md">
        @if($icon)
            <div class="w-12 h-12 {{ $colors['light'] }} rounded-lg flex items-center justify-center mb-4">
                <i data-lucide="{{ $iconName }}" class="w-6 h-6 {{ $colors['text'] }}"></i>
            </div>
        @endif
        
        <p class="text-sm text-gray-500 font-medium">{{ $title }}</p>
        <h3 class="text-3xl font-bold text-gray-900 mt-1">{{ $value }}</h3>
        
        @if($trend)
            <div class="flex items-center mt-3 text-sm">
                <i data-lucide="trending-up" class="w-4 h-4 text-green-500 mr-1"></i>
                <span class="text-green-600 font-medium">{{ $trend }}</span>
            </div>
        @endif
    </div>
@endif

    