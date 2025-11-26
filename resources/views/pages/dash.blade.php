@extends('layouts.main-nav')
@section('disableGlobalVariabel', true)

@section('title', 'Dashboard')
@section('content')
        <!-- Wrapper konsisten seperti halaman File Materi -->
        <div class="min-h-screen">
            <main class="flex-grow bg-white dark:bg-[#2d2d2d] rounded-tl-3xl p-6 md:p-10">
                <div class="max-w-7xl mx-auto">
            
            <!-- Page Header -->
            <div class="mb-8">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-2xl md:text-3xl font-bold text-slate-800 dark:text-white">Dashboard</h1>
                        <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">Selamat datang kembali, {{ Auth::user()->name }}!</p>
                    </div>
                    <div class="text-right">
                        <p class="text-xs text-slate-400 dark:text-slate-500 uppercase tracking-wider">{{ \Carbon\Carbon::now()->format('l') }}</p>
                        <p class="text-lg font-bold text-slate-800 dark:text-white">{{ \Carbon\Carbon::now()->format('d M Y') }}</p>
                    </div>
                </div>
            </div>

            <!-- Stats Overview -->
            <div class="mb-10">
                <h3 class="text-sm font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-4">Ringkasan</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                    <!-- Stat Card: Total Acara -->
                    <div class="bg-slate-50 dark:bg-[#3d3d3d] border-2 border-blue-200 dark:border-blue-900/50 rounded-xl p-4 shadow-sm hover:shadow-md transition-shadow">
                        <div class="flex items-center justify-between mb-3">
                            <div class="w-12 h-12 rounded-lg bg-blue-100 dark:bg-blue-900/50 flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-6 w-6 text-blue-600 dark:text-blue-400">
                                    <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                    <line x1="16" y1="2" x2="16" y2="6"></line>
                                    <line x1="8" y1="2" x2="8" y2="6"></line>
                                    <line x1="3" y1="10" x2="21" y2="10"></line>
                                </svg>
                            </div>
                            <span class="text-3xl font-bold text-slate-800 dark:text-white">{{ Auth::user()->activities()->count() }}</span>
                        </div>
                        <p class="text-xs font-semibold text-slate-400 dark:text-slate-500 uppercase">Total Acara</p>
                        <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">Termasuk mendatang</p>
                    </div>

                    <!-- Stat Card: Total Catatan -->
                    <div class="bg-white dark:bg-[#3d3d3d] rounded-xl p-4 shadow-sm hover:shadow-md transition-shadow border border-slate-200 dark:border-slate-700/50">
                        <div class="flex items-center justify-between mb-3">
                            <div class="w-12 h-12 rounded-lg bg-purple-100 dark:bg-purple-900/50 flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-6 w-6 text-purple-600 dark:text-purple-400">
                                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                    <polyline points="14 2 14 8 20 8"></polyline>
                                    <line x1="16" y1="13" x2="8" y2="13"></line>
                                    <line x1="16" y1="17" x2="8" y2="17"></line>
                                    <polyline points="10 9 9 9 8 9"></polyline>
                                </svg>
                            </div>
                            <span class="text-3xl font-bold text-slate-800 dark:text-white">{{ Auth::user()->notes()->count() }}</span>
                        </div>
                        <p class="text-xs font-semibold text-slate-400 dark:text-slate-500 uppercase">Total Catatan</p>
                        <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">Catatan pribadi</p>
                    </div>

                    <!-- Stat Card: Total Tugas -->
                    <div class="bg-white dark:bg-[#3d3d3d] rounded-xl p-4 shadow-sm hover:shadow-md transition-shadow border border-slate-200 dark:border-slate-700/50">
                        <div class="flex items-center justify-between mb-3">
                            <div class="w-12 h-12 rounded-lg bg-green-100 dark:bg-green-900/50 flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-6 w-6 text-green-600 dark:text-green-400">
                                    <path d="M9 5H7a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-2"></path>
                                    <path d="M9 3v4a2 2 0 0 0 2 2h2a2 2 0 0 0 2-2V3"></path>
                                    <line x1="10" y1="17" x2="14" y2="17"></line>
                                    <line x1="10" y1="13" x2="14" y2="13"></line>
                                </svg>
                            </div>
                            <span class="text-3xl font-bold text-slate-800 dark:text-white">{{ Auth::user()->tasks()->count() }}</span>
                        </div>
                        <p class="text-xs font-semibold text-slate-400 dark:text-slate-500 uppercase">Total Tugas</p>
                        <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">{{ Auth::user()->tasks()->where('status', 'completed')->count() }} selesai</p>
                    </div>

                    <!-- Quick Action Card -->
                    <div class="bg-gradient-to-br from-blue-500 to-blue-600 dark:from-blue-600 dark:to-blue-700 rounded-xl p-4 shadow-sm hover:shadow-md transition-shadow cursor-pointer">
                        <div class="flex items-center justify-between mb-3">
                            <div class="w-12 h-12 rounded-lg bg-white/20 dark:bg-white/10 flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-6 w-6 text-white">
                                    <line x1="12" y1="5" x2="12" y2="19"></line>
                                    <line x1="5" y1="12" x2="19" y2="12"></line>
                                </svg>
                            </div>
                        </div>
                        <p class="text-xs font-semibold text-white uppercase">Quick Action</p>
                        <p class="text-xs text-blue-100 mt-1">Tambah Acara Baru</p>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Main Content Area - 2/3 -->
                <div class="lg:col-span-2 space-y-6">
                    
                    <!-- Acara Mendatang Section -->
                    <div>
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-sm font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Acara Mendatang</h3>
                            <a href="{{ route('kalender.index') }}" class="text-sm text-blue-600 dark:text-blue-400 hover:text-blue-700 dark:hover:text-blue-300 font-medium flex items-center gap-1">
                                Lihat Semua
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <polyline points="9 18 15 12 9 6"></polyline>
                                </svg>
                            </a>
                        </div>

                        @if(isset($acaraMendatang) && count($acaraMendatang) > 0)
                            <div class="space-y-2">
                                @foreach($acaraMendatang as $activity)
                                    <div class="p-4 rounded-xl bg-white dark:bg-[#3d3d3d] border border-slate-200 dark:border-slate-700/50 hover:bg-slate-50 dark:hover:bg-[#404040] transition cursor-pointer">
                                        <div class="flex items-start justify-between">
                                            <div class="flex-1">
                                                <div class="flex items-center gap-2 mb-1">
                                                    <div class="w-2 h-2 rounded-full bg-blue-500 dark:bg-blue-400"></div>
                                                    <h4 class="font-bold text-slate-800 dark:text-white">{{ $activity->title }}</h4>
                                                </div>
                                                @if($activity->desk)
                                                    <p class="text-sm text-slate-600 dark:text-slate-300 mb-2">{{ $activity->desk }}</p>
                                                @endif
                                                <div class="flex items-center gap-4 text-xs text-slate-500 dark:text-slate-400">
                                                    <span class="flex items-center gap-1">
                                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                                        </svg>
                                                        {{ \Carbon\Carbon::parse($activity->date)->format('d M Y') }}
                                                    </span>
                                                    @if($activity->time)
                                                        <span class="flex items-center gap-1">
                                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                            </svg>
                                                            {{ $activity->time }}
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                            <span class="text-xs px-2 py-1 rounded-full bg-blue-100 dark:bg-blue-900/50 text-blue-700 dark:text-blue-300">Upcoming</span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="p-8 text-center bg-slate-50 dark:bg-[#3d3d3d] rounded-xl border border-slate-200 dark:border-slate-700/50">
                                <svg class="w-12 h-12 mx-auto text-slate-400 dark:text-slate-500 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                <p class="text-slate-500 dark:text-slate-400 text-sm">Tidak ada acara mendatang</p>
                            </div>
                        @endif
                    </div>

                    <!-- Catatan Terbaru Section -->
                    <div>
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-sm font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Catatan Terbaru</h3>
                            <a href="{{ route('catatan') }}" class="text-sm text-blue-600 dark:text-blue-400 hover:text-blue-700 dark:hover:text-blue-300 font-medium flex items-center gap-1">
                                Lihat Semua
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <polyline points="9 18 15 12 9 6"></polyline>
                                </svg>
                            </a>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @forelse(Auth::user()->notes()->latest()->take(4)->get() as $note)
                                <div class="p-4 rounded-xl bg-white dark:bg-[#3d3d3d] border border-slate-200 dark:border-slate-700/50 hover:bg-slate-50 dark:hover:bg-[#404040] transition cursor-pointer">
                                    <h4 class="font-bold text-slate-800 dark:text-white mb-1">{{ $note->title }}</h4>
                                    <p class="text-sm text-slate-600 dark:text-slate-300 line-clamp-2">{{ $note->content }}</p>
                                    <p class="text-xs text-slate-400 dark:text-slate-500 mt-2">{{ $note->created_at->diffForHumans() }}</p>
                                </div>
                            @empty
                                <div class="col-span-2 p-8 text-center bg-slate-50 dark:bg-[#3d3d3d] rounded-xl border border-slate-200 dark:border-slate-700/50">
                                    <svg class="w-12 h-12 mx-auto text-slate-400 dark:text-slate-500 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                    </svg>
                                    <p class="text-slate-500 dark:text-slate-400 text-sm">Belum ada catatan</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>

                <!-- Sidebar - 1/3 -->
                <div class="lg:col-span-1 space-y-6">
                    
                    <!-- Quick Links -->
                    <div class="bg-slate-50 dark:bg-[#3d3d3d] rounded-xl p-4 border border-slate-200 dark:border-slate-700/50">
                        <h3 class="text-sm font-semibold text-slate-500 dark:text-slate-300 uppercase tracking-wider mb-4">Quick Links</h3>
                        <div class="space-y-2">
                            <a href="{{ route('kalender.index') }}" class="flex items-center gap-3 p-3 rounded-lg bg-white dark:bg-[#404040] border border-slate-200 dark:border-slate-700/50 hover:bg-blue-50 dark:hover:bg-blue-900/30 hover:border-blue-300 dark:hover:border-blue-700 transition">
                                <div class="w-8 h-8 rounded-lg bg-blue-100 dark:bg-blue-900/50 flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-blue-600 dark:text-blue-400">
                                        <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                        <line x1="16" y1="2" x2="16" y2="6"></line>
                                        <line x1="8" y1="2" x2="8" y2="6"></line>
                                        <line x1="3" y1="10" x2="21" y2="10"></line>
                                    </svg>
                                </div>
                                <span class="text-sm font-medium text-slate-700 dark:text-slate-200">Kalender</span>
                            </a>
                            <a href="{{ route('catatan') }}" class="flex items-center gap-3 p-3 rounded-lg bg-white dark:bg-[#404040] border border-slate-200 dark:border-slate-700/50 hover:bg-purple-50 dark:hover:bg-purple-900/30 hover:border-purple-300 dark:hover:border-purple-700 transition">
                                <div class="w-8 h-8 rounded-lg bg-purple-100 dark:bg-purple-900/50 flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-purple-600 dark:text-purple-400">
                                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                        <polyline points="14 2 14 8 20 8"></polyline>
                                    </svg>
                                </div>
                                <span class="text-sm font-medium text-slate-700 dark:text-slate-200">Catatan</span>
                            </a>
                            <a href="{{ route('tugas.index') }}" class="flex items-center gap-3 p-3 rounded-lg bg-white dark:bg-[#404040] border border-slate-200 dark:border-slate-700/50 hover:bg-green-50 dark:hover:bg-green-900/30 hover:border-green-300 dark:hover:border-green-700 transition">
                                <div class="w-8 h-8 rounded-lg bg-green-100 dark:bg-green-900/50 flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-green-600 dark:text-green-400">
                                        <path d="M9 5H7a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-2"></path>
                                        <path d="M9 3v4a2 2 0 0 0 2 2h2a2 2 0 0 0 2-2V3"></path>
                                    </svg>
                                </div>
                                <span class="text-sm font-medium text-slate-700">Tugas</span>
                            </a>
                        </div>
                    </div>

                    <!-- Activity Summary -->
                    <div class="bg-white rounded-xl p-4 border border-slate-200 shadow-sm">
                        <h3 class="text-sm font-semibold text-slate-500 uppercase tracking-wider mb-4">Aktivitas Minggu Ini</h3>
                        <div class="space-y-3">
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-slate-600">Acara Dijadwalkan</span>
                                <span class="text-sm font-bold text-slate-800">{{ Auth::user()->activities()->whereBetween('date', [now()->startOfWeek(), now()->endOfWeek()])->count() }}</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-slate-600">Tugas Selesai</span>
                                <span class="text-sm font-bold text-green-600">{{ Auth::user()->tasks()->where('status', 'completed')->whereBetween('updated_at', [now()->startOfWeek(), now()->endOfWeek()])->count() }}</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-slate-600">Catatan Dibuat</span>
                                <span class="text-sm font-bold text-slate-800">{{ Auth::user()->notes()->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->count() }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Upgrade Banner -->
                    <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl p-6 shadow-sm relative overflow-hidden">
                        <div class="absolute -top-10 -right-10 w-24 h-24 bg-white/10 rounded-full"></div>
                        <div class="absolute -bottom-10 -left-10 w-32 h-32 bg-white/10 rounded-full"></div>
                        <div class="relative z-10">
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="currentColor" class="text-yellow-300 mb-3">
                                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                            </svg>
                            <h3 class="text-lg font-bold text-white mb-2">Upgrade Premium</h3>
                            <p class="text-sm text-blue-100 mb-4">Dapatkan fitur eksklusif dan penyimpanan unlimited</p>
                            <button class="bg-white text-blue-600 font-semibold py-2 px-4 rounded-lg hover:bg-blue-50 transition text-sm">
                                Lihat Detail
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            </main>
        </div>
            </div>
        </div>

        <script src="https://unpkg.com/lucide@latest"></script>
        <script>
            // Ini adalah kode JavaScript untuk menginisialisasi Lucide Icons
            // Di lingkungan Blade/Laravel, pastikan skrip ini dijalankan setelah konten di-load.
            document.addEventListener('DOMContentLoaded', () => {
                if (typeof lucide !== 'undefined') {
                    lucide.createIcons();
                } else {
                    // console.warn("Lucide library not loaded. Icons may not render.");
                }
            });
        </script>

@endsection
