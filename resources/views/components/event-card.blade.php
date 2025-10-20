@props([
    'activities' => [],
    'showPagination' => false,
    'itemsPerPage' => 3,
    'showActions' => false,
    'compact' => false
])

@php
    $currentPage = request()->get('page', 1);
    $totalItems = count($activities);
    $totalPages = $showPagination ? ceil($totalItems / $itemsPerPage) : 1;
    
    $displayedActivities = $showPagination 
        ? array_slice($activities, ($currentPage - 1) * $itemsPerPage, $itemsPerPage)
        : $activities;
        
    // Get event colors from config
    $bulletColors = config('components.event_colors', [
        'bg-purple-500', 'bg-blue-500', 'bg-green-500', 'bg-yellow-500', 
        'bg-red-500', 'bg-pink-500', 'bg-indigo-500'
    ]);
@endphp

<div class="space-y-3">
    @forelse ($displayedActivities as $activity)
        @php
            $bulletColor = $bulletColors[$activity['id'] % count($bulletColors)];
            $tanggalAcara = \Carbon\Carbon::parse($activity['date']);
            $formatTanggal = $tanggalAcara->format('M d, Y');
            
            if ($activity['time']) {
                $waktuMulai = \Carbon\Carbon::parse($activity['time'])->format('H:i');
                $waktuSelesai = \Carbon\Carbon::parse($activity['time'])->addHour()->format('H:i');
                $waktuTampil = $waktuMulai . ' - ' . $waktuSelesai;
            } else {
                $waktuTampil = 'Sepanjang hari';
            }
        @endphp

        <div class="bg-white rounded-xl p-5 shadow-sm border border-gray-100 hover:shadow-md transition-shadow duration-200">
            <div class="flex items-start gap-4">
                <!-- Bullet Point -->
                <div class="flex-shrink-0 mt-1">
                    <div class="w-3 h-3 rounded-full {{ $bulletColor }}"></div>
                </div>
                
                <!-- Content -->
                <div class="flex-grow {{ !$compact ? 'cursor-pointer' : '' }}" 
                    @if(!$compact) onclick="openSideModalDetail('{{ $activity['id'] }}')" @endif>
                    <p class="text-sm text-gray-500 mb-2">
                        {{ $formatTanggal }} - {{ $waktuTampil }}
                    </p>
                    
                    <h4 class="font-bold text-lg text-gray-900 mb-1">
                        {{ $activity['title'] }}
                    </h4>
                </div>
                
                <!-- Action Menu -->
                @if ($showActions)
                    <div class="flex-shrink-0">
                        <div class="relative" x-data="{ open: false }">
                            <button @click="open = !open" class="text-gray-400 hover:text-gray-600 p-1">
                                <iconify-icon icon="mdi:dots-vertical" class="w-5 h-5"></iconify-icon>
                            </button>
                            
                            <div x-show="open" 
                                @click.away="open = false"
                                x-transition
                                class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg border border-gray-200 z-10"
                                style="display: none;">
                                <div class="py-1">
                                    <button onclick="event.stopPropagation(); window.openModal('edit', '{{ $activity['id'] }}');" 
                                        class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 flex items-center gap-2">
                                        <iconify-icon icon="mdi:pencil" class="w-4 h-4"></iconify-icon>
                                        Edit Acara
                                    </button>
                                    <button onclick="event.stopPropagation(); window.confirmDelete('{{ $activity['id'] }}');" 
                                        class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50 flex items-center gap-2">
                                        <iconify-icon icon="mdi:trash-can-outline" class="w-4 h-4"></iconify-icon>
                                        Hapus Acara
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="flex-shrink-0">
                        <button class="text-gray-400 hover:text-gray-600 p-1">
                            <iconify-icon icon="mdi:dots-vertical" class="w-5 h-5"></iconify-icon>
                        </button>
                    </div>
                @endif
            </div>
        </div>
    @empty
        <div class="text-center p-8 text-gray-500 bg-gray-50 rounded-lg">
            <iconify-icon icon="mdi:calendar-blank-outline" class="w-12 h-12 mx-auto mb-3 text-gray-300"></iconify-icon>
            <p class="font-semibold mb-1">Tidak ada acara</p>
            @if ($compact)
                <p class="text-sm mb-4">Waktunya bersantai!</p>
                <a href="{{ route('kalender.index') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                    <iconify-icon icon="mdi:plus-circle" class="w-4 h-4"></iconify-icon>
                    Buat Acara Baru
                </a>
            @endif
        </div>
    @endforelse
</div>

{{-- Pagination --}}
@if ($showPagination)
    <x-pagination 
        :currentPage="$currentPage"
        :totalItems="$totalItems"
        :itemsPerPage="$itemsPerPage"
    />
@endif

<style>
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>
