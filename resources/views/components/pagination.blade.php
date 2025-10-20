@props([
    'currentPage' => 1,
    'totalItems' => 0,
    'itemsPerPage' => 3,
    'showInfo' => true,
    'preserveQuery' => true,  // Preserve existing query params
    'queryParam' => 'page',   // Query parameter name
])

@php
    // Ensure currentPage is integer
    $currentPage = (int) $currentPage;
    $totalPages = $totalItems > 0 ? ceil($totalItems / $itemsPerPage) : 1;
    $from = ($currentPage - 1) * $itemsPerPage + 1;
    $to = min($currentPage * $itemsPerPage, $totalItems);
    
    // Normalize props to local variables so static analyzers know they're assigned
    $preserveQueryLocal = isset($preserveQuery) ? $preserveQuery : true;
    $queryParamLocal = isset($queryParam) ? $queryParam : 'page';
    
    // Function to build URL with preserved query params
    $buildUrl = function($page) use ($preserveQueryLocal, $queryParamLocal) {
        if ($preserveQueryLocal) {
            $queryParams = request()->query();
            $queryParams[$queryParamLocal] = $page;
            return '?' . http_build_query($queryParams);
        }
        return "?{$queryParamLocal}={$page}";
    };
@endphp

@if ($totalPages > 1)
    <div class="mt-6 border-t border-gray-200 pt-4">
        <nav class="flex items-center justify-between">
            <!-- Mobile View -->
            <div class="flex-1 flex justify-between sm:hidden">
                <a href="{{ $buildUrl(max(1, $currentPage - 1)) }}" 
                    class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 {{ $currentPage === 1 ? 'opacity-50 cursor-not-allowed' : '' }}"
                    @if($currentPage === 1) onclick="return false;" @endif>
                    Previous
                </a>
                <a href="{{ $buildUrl(min($totalPages, $currentPage + 1)) }}" 
                    class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 {{ $currentPage === $totalPages ? 'opacity-50 cursor-not-allowed' : '' }}"
                    @if($currentPage === $totalPages) onclick="return false;" @endif>
                    Next
                </a>
            </div>
            
            <!-- Desktop View -->
            <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                @if ($showInfo)
                    <div>
                        <p class="text-sm text-gray-700">
                            Menampilkan 
                            <span class="font-medium">{{ $from }}</span> 
                            sampai 
                            <span class="font-medium">{{ $to }}</span> 
                            dari 
                            <span class="font-medium">{{ $totalItems }}</span> hasil
                        </p>
                    </div>
                @endif
                
                <div>
                    <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">
                        <!-- Previous Button -->
                        <a href="{{ $buildUrl(max(1, $currentPage - 1)) }}" 
                            class="relative inline-flex items-center p-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50 {{ $currentPage === 1 ? 'cursor-not-allowed opacity-50' : '' }}"
                            @if($currentPage === 1) onclick="return false;" @endif>
                            <span class="sr-only">Previous</span>
                            <iconify-icon icon="mdi:chevron-left" class=""></iconify-icon>
                        </a>
                        
                        <!-- Page Numbers -->
                        @for ($i = 1; $i <= $totalPages; $i++)
                            <a href="{{ $buildUrl($i) }}" 
                                aria-current="{{ $i === $currentPage ? 'page' : 'false' }}"
                                class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium {{ $i === $currentPage ? 'z-10 bg-blue-50 border-blue-500 text-blue-600' : 'bg-white text-gray-700 hover:bg-gray-50' }}">
                                {{ $i }}
                            </a>
                        @endfor
                        
                        <!-- Next Button -->
                        <a href="{{ $buildUrl(min($totalPages, $currentPage + 1)) }}" 
                            class="relative inline-flex items-center p-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50 {{ $currentPage === $totalPages ? 'cursor-not-allowed opacity-50' : '' }}"
                            @if($currentPage === $totalPages) onclick="return false;" @endif>
                            <span class="sr-only">Next</span>
                            <iconify-icon icon="mdi:chevron-right" class=""></iconify-icon>
                        </a>
                    </nav>
                </div>
            </div>
        </nav>
    </div>
@endif
