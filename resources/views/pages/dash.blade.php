@extends('layouts.main-nav')

@section('title', 'Dashboard')
@section('content')
        <!-- Wrapper untuk Dashboard, menggunakan palet warna Notezque (v4/v5) -->
        <div class="p-4 md:p-8 bg-v4-background min-h-screen">
            <!-- KONTEN UTAMA DASHBOARD -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                {{-- Card 1: Solid variant with colored background --}}
                <x-stat-card 
                    title="Total Acara" 
                    value="24" 
                    icon="calendar-range" 
                    color="blue" 
                    trend="+1 Sejak Minggu Lalu"
                />
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
                <!-- KOLOM KIRI (Course Cards & My Courses) - 8/12 -->
                <div class="lg:col-span-8 space-y-8">


                    <!-- BAGIAN 2: DAFTAR KURSUSKU (My Courses) -->
                    <div>
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-2xl font-bold text-v4-text">Daftar Tugas Mendatang</h3>
                            <a href="#" class="text-sm font-semibold text-v4-primary hover:underline">Lihat Semua</a>
                        </div>

                        <div class="bg-white rounded-2xl p-6 shadow-xl border border-gray-100">
                            <table class="min-w-full divide-y divide-gray-100">
                                <thead>
                                    <tr class="text-left text-xs font-semibold uppercase text-gray-500">
                                        <th class="py-3 px-1 md:px-4">Tugas</th>
                                        <th class="hidden md:table-cell py-3 px-4">Tenggat</th>
                                        <th class="py-3 px-4 text-center">Kategori</th>
                                        <th class="py-3 px-4 text-right">Status</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-50 text-v4-text">

                                    <!-- Item 1 -->
                                    <tr class="hover:bg-v4-subtle/50 transition duration-150 cursor-pointer">
                                        <td class="py-4 px-1 md:px-4 flex items-center space-x-3">
                                            <div class="w-2 h-2 rounded-full bg-v4-primary"></div>
                                            <span class="font-medium">Web Design Dasar</span>
                                        </td>
                                        <td class="hidden md:table-cell py-4 px-4 text-sm text-gray-500">30 Oktober</td>
                                        <td class="text-center">
                                            <span class="text-xs font-semibold  bg-blue-200 rounded-md py-1 px-6 ">#TUBES</span>
                                        </td>
                                        <td class="py-4 px-4 text-right">
                                            <span class="text-xs font-medium text-gray-700 bg-green-300 px-3 py-1 rounded-full">Selesai</span>
                                        </td>
                                    </tr>

                                    <!-- Item 2 -->
                                    <tr class="hover:bg-v4-subtle/50 transition duration-150 cursor-pointer">
                                        <td class="py-4 px-1 md:px-4 flex items-center space-x-3">
                                            <div class="w-2 h-2 rounded-full bg-red-400"></div>
                                            <span class="font-medium">Statistika Probabilitas</span>
                                        </td>
                                        <td class="hidden md:table-cell py-4 px-4 text-sm text-gray-500">14 Mei</td>
                                        <td class="text-center">
                                            <span class="text-xs font-semibold  bg-blue-200 rounded-md py-1 px-6 ">#TUBES</span>
                                        </td>
                                        <td class="py-4 px-4 text-right">
                                            <span class="text-xs font-medium text-gray-700 bg-yellow-300 px-3 py-1 rounded-full">Proses</span>
                                        </td>
                                    </tr>

                                    <!-- Item 3 -->
                                    <tr class="hover:bg-v4-subtle/50 transition duration-150 cursor-pointer">
                                        <td class="py-4 px-1 md:px-4 flex items-center space-x-3">
                                            <div class="w-2 h-2 rounded-full bg-purple-500"></div>
                                            <span class="font-medium">Data Mining dengan Python</span>
                                        </td>
                                        <td class="hidden md:table-cell py-4 px-4 text-sm text-gray-500">17 Mei</td>
                                        <td class="text-center">
                                            <span class="text-xs font-semibold  bg-orange-200 rounded-md py-1 px-6 ">#Homework</span>
                                        </td>
                                        <td class="py-4 px-4 text-right">
                                            <span class="text-xs font-medium text-gray-700 bg-yellow-300 px-3 py-1 rounded-full">Proses</span>
                                        </td>
                                    </tr>

                                    <!-- Item 4 -->
                                    <tr class="hover:bg-v4-subtle/50 transition duration-150 cursor-pointer">
                                        <td class="py-4 px-1 md:px-4 flex items-center space-x-3">
                                            <div class="w-2 h-2 rounded-full bg-yellow-500"></div>
                                            <span class="font-medium">Basis Data II</span>
                                        </td>
                                        <td class="hidden md:table-cell py-4 px-4 text-sm text-gray-500">26 Mei</td>
                                        <td class="text-center">
                                            <span class="text-xs font-semibold  bg-emerald-400  rounded-md py-1 px-6 ">#Praktikum</span>
                                        </td>
                                        <td class="py-4 px-4 text-right">
                                            <span class="text-xs font-medium text-gray-700 bg-gray-100 px-3 py-1 rounded-full">Belum dimulai</span>
                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- BAGIAN 1: KARTU KURSUS BARU (New Courses) -->
                    <div>
                        <h3 class="text-2xl font-bold mb-4 text-v4-text">Materi Saat ini</h3>
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                            <!-- Kartu 1: Geografi (Ilustrasi Peta) -->
                            <div
                                class="group bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 cursor-pointer border border-gray-100">
                                <div class="bg-orange-100 p-4 relative">
                                    <!-- Ilustrasi Sederhana -->
                                    <div class="h-24 flex items-center justify-center">
                                        <i data-lucide="map"
                                            class="w-12 h-12 text-orange-500 opacity-80 group-hover:scale-110 transition duration-300"></i>
                                    </div>
                                </div>
                                <div class="p-4">
                                    <h4 class="font-bold text-lg text-v4-text">Geografi Regional</h4>
                                    <p class="text-sm text-gray-500 mb-3">12 SKS / 4 Tugas Aktif</p>
                                    <div class="flex items-center justify-between text-xs text-v4-primary font-medium">
                                        <span class="bg-v4-primary/10 px-2 py-1 rounded-full">Avanza, S.Kom.</span>
                                        <i data-lucide="chevron-right" class="w-4 h-4 group-hover:translate-x-1 transition"></i>
                                    </div>
                                </div>
                            </div>

                            <!-- Kartu 2: Algoritma (Ilustrasi Code) -->
                            <div
                                class="group bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 cursor-pointer border border-gray-100">
                                <div class="bg-v4-primary/10 p-4 relative">
                                    <!-- Ilustrasi Sederhana -->
                                    <div class="h-24 flex items-center justify-center">
                                        <i data-lucide="code"
                                            class="w-12 h-12 text-v4-primary opacity-80 group-hover:scale-110 transition duration-300"></i>
                                    </div>
                                </div>
                                <div class="p-4">
                                    <h4 class="font-bold text-lg text-v4-text">Algoritma & Struktur Data</h4>
                                    <p class="text-sm text-gray-500 mb-3">15 SKS / 6 Tugas Aktif</p>
                                    <div class="flex items-center justify-between text-xs text-v4-primary font-medium">
                                        <span class="bg-v4-primary/10 px-2 py-1 rounded-full">Budi, M.Sc.</span>
                                        <i data-lucide="chevron-right" class="w-4 h-4 group-hover:translate-x-1 transition"></i>
                                    </div>
                                </div>
                            </div>

                            <!-- Kartu 3: Fotografi (Ilustrasi Kamera) -->
                            <div
                                class="group bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 cursor-pointer border border-gray-100">
                                <div class="bg-v4-secondary/20 p-4 relative">
                                    <!-- Ilustrasi Sederhana -->
                                    <div class="h-24 flex items-center justify-center">
                                        <i data-lucide="camera"
                                            class="w-12 h-12 text-v4-secondary opacity-80 group-hover:scale-110 transition duration-300"></i>
                                    </div>
                                </div>
                                <div class="p-4">
                                    <h4 class="font-bold text-lg text-v4-text">Pengantar Fotografi Digital</h4>
                                    <p class="text-sm text-gray-500 mb-3">8 SKS / 2 Tugas Aktif</p>
                                    <div class="flex items-center justify-between text-xs text-v4-primary font-medium">
                                        <span class="bg-v4-primary/10 px-2 py-1 rounded-full">Citra, S.T.</span>
                                        <i data-lucide="chevron-right" class="w-4 h-4 group-hover:translate-x-1 transition"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- KOLOM KANAN (Calendar & Acara)-->
                <div class="lg:col-span-4 space-y-4 ">

                    <!-- BAGIAN 1: KALENDER MINI AKADEMIK -->
                    <div class="bg-white rounded-2xl p-6 shadow-xl border border-gray-100">
                           <x-calendar
                                hcell="50px"
                                :activities="$semua_aktivitas ?? []"
                            /> 
                    </div>

                    <!-- BAGIAN 2: DAFTAR ACARA MINI  -->
                    <div class="bg-white rounded-2xl p-6 shadow-xl border border-gray-100">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-2xl font-bold text-v4-text">
                                <i data-lucide="bell-ring" class="w-6 h-6 inline mr-2 text-v4-primary"></i> Acara Mendatang
                            </h3>
                            <a href="{{ route('kalender.index') }}" class="text-sm font-semibold text-v4-primary hover:underline flex items-center gap-1">
                                Lihat Semua
                                <i data-lucide="arrow-right" class="w-4 h-4"></i>
                            </a>
                        </div>

                        @if(isset($acaraMendatang) && count($acaraMendatang) > 0)
                            <div class="space-y-2">
                                <x-event-card 
                                    :activities="$acaraMendatang" 
                                    :compact="true" 
                                />
                            </div>
                        @else
                            <div class="text-center py-8">
                                <i data-lucide="calendar-x" class="w-12 h-12 mx-auto text-gray-400 mb-3"></i>
                                <p class="text-gray-500">Tidak ada acara mendatang</p>
                            </div>
                        @endif
                    </div>

                    <!-- BAGIAN 3: UPGRADE (Premium Subscription) -->
                    <div class="bg-gradient-to-br from-v4-primary to-blue-500 rounded-2xl p-6 shadow-xl relative overflow-hidden">
                        <!-- Ilustrasi Sederhana -->
                        <div class="absolute -top-10 -right-10 w-24 h-24 bg-white/10 rounded-full"></div>
                        <div class="absolute -bottom-10 -left-10 w-32 h-32 bg-white/10 rounded-full"></div>

                        <div class="relative z-10 flex flex-col items-start">
                            <i data-lucide="star" class="w-8 h-8 text-yellow-300 mb-3 fill-yellow-300"></i>
                            <h3 class="text-xl font-bold text-white mb-2">Langganan Premium</h3>
                            <p class="text-sm text-blue-100 mb-4">
                                Buka fitur kolaborasi tak terbatas, penyimpanan cloud, dan analitik performa tugas.
                            </p>
                            <button
                                class="bg-white text-v4-primary font-bold py-2 px-5 rounded-full shadow-lg hover:bg-gray-100 transition duration-300">
                                Detail Lebih Lanjut
                            </button>
                        </div>
                    </div>
                </div> 
                    </div>


    <

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
