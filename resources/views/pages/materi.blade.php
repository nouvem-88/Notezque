@extends('layouts.main-nav')
@section('title','File Materi')

@section('content')
{{-- Wrapper Utama --}}
<div class="min-h-screen">

    <!-- Konten Utama -->
    <main class="flex-grow bg-white rounded-tl-3xl p-6 md:p-10">
        <div class="max-w-7xl mx-auto">
            <!-- Baris Judul dan Aksi -->
            <div class="flex flex-wrap justify-between items-center gap-4 mb-8">
                <div class="flex items-center gap-3">
                    <h2 class="text-2xl md:text-3xl font-bold text-slate-800">Materi Saya</h2>
                    <div class="p-2 bg-slate-100 rounded-lg text-slate-600">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-5 w-5">
                            <rect x="3" y="3" width="7" height="7"></rect>
                            <rect x="14" y="3" width="7" height="7"></rect>
                            <rect x="14" y="14" width="7" height="7"></rect>
                            <rect x="3" y="14" width="7" height="7"></rect>
                        </svg>
                    </div>
                </div>
                <div class="flex items-center gap-2">
                    <button class="p-2 rounded-lg bg-slate-100 hover:bg-slate-200 text-slate-600 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-5 w-5">
                            <line x1="8" y1="6" x2="21" y2="6"></line>
                            <line x1="8" y1="12" x2="21" y2="12"></line>
                            <line x1="8" y1="18" x2="21" y2="18"></line>
                            <line x1="3" y1="6" x2="3.01" y2="6"></line>
                            <line x1="3" y1="12" x2="3.01" y2="12"></line>
                            <line x1="3" y1="18" x2="3.01" y2="18"></line>
                        </svg>
                    </button>
                    <button class="p-2 rounded-lg bg-blue-50 text-blue-600 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-5 w-5">
                            <rect x="3" y="3" width="7" height="7"></rect>
                            <rect x="14" y="3" width="7" height="7"></rect>
                            <rect x="14" y="14" width="7" height="7"></rect>
                            <rect x="3" y="14" width="7" height="7"></rect>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Akses Cepat -->
            <div class="mb-10">
                <h3 class="text-sm font-semibold text-slate-500 uppercase tracking-wider mb-4">Akses Cepat</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    <!-- Kartu Akses Cepat 1 -->
                    <div class="bg-slate-50 border-2 border-blue-200 rounded-xl p-4 shadow-sm hover:shadow-md transition-shadow">
                        <p class="text-xs font-semibold text-slate-400 mb-2">DIBAGIKAN DENGAN</p>
                        <div class="flex items-center -space-x-2 mb-3">
                            <img class="inline-block h-8 w-8 rounded-full ring-2 ring-white" src="https://placehold.co/32x32/f87171/ffffff?text=A" alt="">
                            <img class="inline-block h-8 w-8 rounded-full ring-2 ring-white" src="https://placehold.co/32x32/60a5fa/ffffff?text=B" alt="">
                            <img class="inline-block h-8 w-8 rounded-full ring-2 ring-white" src="https://placehold.co/32x32/34d399/ffffff?text=C" alt="">
                        </div>
                        <p class="font-bold text-slate-800">Materi Desain</p>
                    </div>
                    <!-- Kartu Akses Cepat 2 -->
                    <div class="bg-white rounded-xl p-4 shadow-sm hover:shadow-md transition-shadow border border-slate-200">
                        <p class="text-xs font-semibold text-slate-400 mb-2">DIBAGIKAN DENGAN</p>
                        <div class="flex items-center -space-x-2 mb-3">
                            <img class="inline-block h-8 w-8 rounded-full ring-2 ring-white" src="https://placehold.co/32x32/fbbf24/ffffff?text=D" alt="">
                            <img class="inline-block h-8 w-8 rounded-full ring-2 ring-white" src="https://placehold.co/32x32/a78bfa/ffffff?text=E" alt="">
                        </div>
                        <p class="font-bold text-slate-800">Dokumen Kelompok</p>
                    </div>
                    <!-- Kartu Akses Cepat 3 -->
                    <div class="bg-white rounded-xl p-4 shadow-sm hover:shadow-md transition-shadow border border-slate-200">
                        <p class="text-xs font-semibold text-slate-400 mb-2">TUGAS</p>
                        <div class="flex items-center gap-2 mb-3">
                            <div class="w-8 h-8 rounded-lg bg-blue-100 flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-5 w-5 text-blue-600">
                                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                    <polyline points="14 2 14 8 20 8"></polyline>
                                    <line x1="16" y1="13" x2="8" y2="13"></line>
                                    <line x1="16" y1="17" x2="8" y2="17"></line>
                                    <polyline points="10 9 9 9 8 9"></polyline>
                                </svg>
                            </div>
                            <img class="inline-block h-8 w-8 rounded-full ring-2 ring-white" src="https://placehold.co/32x32/f87171/ffffff?text=A" alt="">
                        </div>
                        <p class="font-bold text-slate-800">Ringkasan Proyek</p>
                    </div>
                </div>
            </div>

            <!-- Semua File/Materi -->
            <div>
                <h3 class="text-sm font-semibold text-slate-500 uppercase tracking-wider mb-4">Semua Materi</h3>
                <div class="space-y-2">
                    <!-- Header Tabel -->
                    <div class="grid grid-cols-12 gap-4 px-4 text-xs font-semibold text-slate-400 uppercase">
                        <div class="col-span-12 md:col-span-5">Nama</div>
                        <div class="hidden md:block md:col-span-2">Pemilik</div>
                        <div class="hidden md:block md:col-span-3">Terakhir Diubah</div>
                        <div class="hidden md:block md:col-span-1">Ukuran</div>
                        <div class="hidden md:block md:col-span-1"></div>
                    </div>

                    <!-- Daftar Item -->
                    {{-- Item 1 --}}
                    <div class="grid grid-cols-12 gap-4 items-center p-4 rounded-xl hover:bg-slate-50 cursor-pointer">
                        <div class="col-span-12 md:col-span-5 flex items-center gap-4">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-6 w-6 text-blue-500 flex-shrink-0">
                                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                <polyline points="14 2 14 8 20 8"></polyline>
                                <line x1="16" y1="13" x2="8" y2="13"></line>
                                <line x1="16" y1="17" x2="8" y2="17"></line>
                                <polyline points="10 9 9 9 8 9"></polyline>
                            </svg>
                            <span class="font-medium text-slate-700 truncate">Laporan Mingguan.docx</span>
                        </div>
                        <div class="hidden md:block md:col-span-2">
                            <img class="inline-block h-6 w-6 rounded-full" src="https://placehold.co/24x24/60a5fa/ffffff?text=B" alt="Owner">
                        </div>
                        <div class="hidden md:block md:col-span-3 text-sm text-slate-500">Sept 9, 2025 - 12:42 AM</div>
                        <div class="hidden md:block md:col-span-1 text-sm text-slate-500">20 MB</div>
                        <div class="col-span-12 md:col-span-1 text-right">
                            <button class="p-2 rounded-full hover:bg-slate-200 text-slate-500"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-5 w-5">
                                    <circle cx="12" cy="12" r="1"></circle>
                                    <circle cx="12" cy="5" r="1"></circle>
                                    <circle cx="12" cy="19" r="1"></circle>
                                </svg></button>
                        </div>
                    </div>
                    {{-- Item 2 --}}
                    <div class="grid grid-cols-12 gap-4 items-center p-4 rounded-xl hover:bg-slate-50 cursor-pointer bg-blue-50 border border-blue-200">
                        <div class="col-span-12 md:col-span-5 flex items-center gap-4">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-6 w-6 text-red-500 flex-shrink-0">
                                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                <polyline points="14 2 14 8 20 8"></polyline>
                                <line x1="12" y1="18" x2="12" y2="12"></line>
                                <line x1="10" y1="14" x2="14" y2="14"></line>
                            </svg>
                            <span class="font-medium text-slate-700 truncate">Presentasi Final.pdf</span>
                        </div>
                        <div class="hidden md:block md:col-span-2">
                            <img class="inline-block h-6 w-6 rounded-full" src="https://placehold.co/24x24/f87171/ffffff?text=A" alt="Owner">
                        </div>
                        <div class="hidden md:block md:col-span-3 text-sm text-slate-500">Jul 20, 2025 - 08:42 AM</div>
                        <div class="hidden md:block md:col-span-1 text-sm text-slate-500">20 MB</div>
                        <div class="col-span-12 md:col-span-1 text-right">
                            <button class="p-2 rounded-full hover:bg-slate-200 text-slate-500"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-5 w-5">
                                    <circle cx="12" cy="12" r="1"></circle>
                                    <circle cx="12" cy="5" r="1"></circle>
                                    <circle cx="12" cy="19" r="1"></circle>
                                </svg></button>
                        </div>
                    </div>
                    {{-- Item 3 --}}
                    <div class="grid grid-cols-12 gap-4 items-center p-4 rounded-xl hover:bg-slate-50 cursor-pointer">
                        <div class="col-span-12 md:col-span-5 flex items-center gap-4">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-6 w-6 text-orange-500 flex-shrink-0">
                                <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                                <line x1="3" y1="9" x2="21" y2="9"></line>
                                <line x1="3" y1="15" x2="21" y2="15"></line>
                                <line x1="9" y1="3" x2="9" y2="21"></line>
                                <line x1="15" y1="3" x2="15" y2="21"></line>
                            </svg>
                            <span class="font-medium text-slate-700 truncate">Referensi Jurnal.xlsx</span>
                        </div>
                        <div class="hidden md:block md:col-span-2 flex -space-x-2">
                            <img class="inline-block h-6 w-6 rounded-full ring-2 ring-white" src="https://placehold.co/24x24/34d399/ffffff?text=C" alt="Owner">
                            <img class="inline-block h-6 w-6 rounded-full ring-2 ring-white" src="https://placehold.co/24x24/a78bfa/ffffff?text=E" alt="Owner">
                        </div>
                        <div class="hidden md:block md:col-span-3 text-sm text-slate-500">Jul 10, 2025 - 09:42 AM</div>
                        <div class="hidden md:block md:col-span-1 text-sm text-slate-500">12 MB</div>
                        <div class="col-span-12 md:col-span-1 text-right">
                            <button class="p-2 rounded-full hover:bg-slate-200 text-slate-500"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-5 w-5">
                                    <circle cx="12" cy="12" r="1"></circle>
                                    <circle cx="12" cy="5" r="1"></circle>
                                    <circle cx="12" cy="19" r="1"></circle>
                                </svg></button>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </main>

</div>
@endsection