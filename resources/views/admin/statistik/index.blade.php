@extends('layouts.admin')

@section('page-title', 'Statistik & Analisis')
@section('page-subtitle', 'Laporan lengkap aktivitas sistem')

@section('content')
<div class="space-y-6">
    <!-- Overview Stats -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl shadow-sm p-6 text-white">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-white/20 rounded-lg flex items-center justify-center">
                    <i class="fas fa-users text-2xl"></i>
                </div>
                <i class="fas fa-arrow-up text-sm"></i>
            </div>
            <h3 class="text-3xl font-bold mb-1">{{ $totalUsers ?? 0 }}</h3>
            <p class="text-blue-100 text-sm">Total Pengguna</p>
        </div>

        <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-xl shadow-sm p-6 text-white">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-white/20 rounded-lg flex items-center justify-center">
                    <i class="fas fa-user-check text-2xl"></i>
                </div>
                <i class="fas fa-arrow-up text-sm"></i>
            </div>
            <h3 class="text-3xl font-bold mb-1">{{ $activeUsers ?? 0 }}</h3>
            <p class="text-green-100 text-sm">Pengguna Aktif (7 Hari)</p>
        </div>

        <div class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl shadow-sm p-6 text-white">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-white/20 rounded-lg flex items-center justify-center">
                    <i class="fas fa-sticky-note text-2xl"></i>
                </div>
                <i class="fas fa-arrow-up text-sm"></i>
            </div>
            <h3 class="text-3xl font-bold mb-1">{{ $totalCatatan ?? 0 }}</h3>
            <p class="text-purple-100 text-sm">Total Catatan</p>
        </div>

        <div class="bg-gradient-to-br from-orange-500 to-orange-600 rounded-xl shadow-sm p-6 text-white">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-white/20 rounded-lg flex items-center justify-center">
                    <i class="fas fa-folder text-2xl"></i>
                </div>
                <i class="fas fa-arrow-up text-sm"></i>
            </div>
            <h3 class="text-3xl font-bold mb-1">{{ $totalMateri ?? 0 }}</h3>
            <p class="text-orange-100 text-sm">Total Materi</p>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Activity Timeline -->
        <div class="bg-white rounded-xl shadow-sm p-6">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-lg font-bold text-gray-800">Timeline Aktivitas</h3>
                <select class="px-4 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500">
                    <option>14 Hari Terakhir</option>
                    <option>30 Hari Terakhir</option>
                    <option>90 Hari Terakhir</option>
                </select>
            </div>
            
            <div class="space-y-3">
                @forelse($events ?? [] as $event)
                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                            <i class="fas fa-calendar-day text-blue-600"></i>
                        </div>
                        <div>
                            <p class="font-semibold text-gray-800">{{ \Carbon\Carbon::parse($event->date)->format('d M Y') }}</p>
                            <p class="text-xs text-gray-500">{{ \Carbon\Carbon::parse($event->date)->diffForHumans() }}</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="text-2xl font-bold text-gray-800">{{ $event->cnt }}</p>
                        <p class="text-xs text-gray-500">aktivitas</p>
                    </div>
                </div>
                @empty
                <div class="text-center py-8">
                    <i class="fas fa-chart-line text-gray-300 text-4xl mb-3"></i>
                    <p class="text-gray-500">Belum ada data aktivitas</p>
                </div>
                @endforelse
            </div>
        </div>

        <!-- User Growth -->
        <div class="bg-white rounded-xl shadow-sm p-6">
            <h3 class="text-lg font-bold text-gray-800 mb-6">Pertumbuhan Pengguna</h3>
            
            <div class="space-y-4">
                @php
                    $months = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun'];
                    $growth = [45, 52, 61, 73, 85, 92];
                @endphp
                @foreach($months as $index => $month)
                <div class="space-y-2">
                    <div class="flex items-center justify-between">
                        <span class="text-sm font-semibold text-gray-700">{{ $month }}</span>
                        <span class="text-sm font-bold text-blue-600">{{ $growth[$index] }} users</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-3 overflow-hidden">
                        <div class="bg-gradient-to-r from-blue-500 to-blue-600 h-full rounded-full transition-all duration-500" 
                             style="width: {{ $growth[$index] }}%"></div>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="mt-6 p-4 bg-blue-50 rounded-lg">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600">Rata-rata Pertumbuhan</p>
                        <p class="text-2xl font-bold text-blue-600 mt-1">+15.7%</p>
                    </div>
                    <div class="w-14 h-14 bg-blue-100 rounded-full flex items-center justify-center">
                        <i class="fas fa-chart-line text-blue-600 text-xl"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Detailed Stats -->
    <div class="bg-white rounded-xl shadow-sm overflow-hidden">
        <div class="p-6 border-b border-gray-200">
            <h3 class="text-lg font-bold text-gray-800">Statistik Detail</h3>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Metrik</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Hari Ini</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Minggu Ini</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Bulan Ini</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Trend</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 font-semibold text-gray-800">
                            <i class="fas fa-user-plus text-blue-600 mr-2"></i>
                            Registrasi Baru
                        </td>
                        <td class="px-6 py-4 text-gray-600">8</td>
                        <td class="px-6 py-4 text-gray-600">47</td>
                        <td class="px-6 py-4 text-gray-600">189</td>
                        <td class="px-6 py-4">
                            <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-xs font-semibold">
                                <i class="fas fa-arrow-up mr-1"></i>
                                +12%
                            </span>
                        </td>
                    </tr>
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 font-semibold text-gray-800">
                            <i class="fas fa-sticky-note text-purple-600 mr-2"></i>
                            Catatan Dibuat
                        </td>
                        <td class="px-6 py-4 text-gray-600">24</td>
                        <td class="px-6 py-4 text-gray-600">156</td>
                        <td class="px-6 py-4 text-gray-600">612</td>
                        <td class="px-6 py-4">
                            <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-xs font-semibold">
                                <i class="fas fa-arrow-up mr-1"></i>
                                +8%
                            </span>
                        </td>
                    </tr>
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 font-semibold text-gray-800">
                            <i class="fas fa-tasks text-orange-600 mr-2"></i>
                            Tugas Diselesaikan
                        </td>
                        <td class="px-6 py-4 text-gray-600">31</td>
                        <td class="px-6 py-4 text-gray-600">198</td>
                        <td class="px-6 py-4 text-gray-600">823</td>
                        <td class="px-6 py-4">
                            <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-xs font-semibold">
                                <i class="fas fa-arrow-up mr-1"></i>
                                +15%
                            </span>
                        </td>
                    </tr>
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 font-semibold text-gray-800">
                            <i class="fas fa-sign-in-alt text-green-600 mr-2"></i>
                            Login Aktif
                        </td>
                        <td class="px-6 py-4 text-gray-600">67</td>
                        <td class="px-6 py-4 text-gray-600">412</td>
                        <td class="px-6 py-4 text-gray-600">1,834</td>
                        <td class="px-6 py-4">
                            <span class="px-3 py-1 bg-yellow-100 text-yellow-700 rounded-full text-xs font-semibold">
                                <i class="fas fa-minus mr-1"></i>
                                0%
                            </span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Export Section -->
    <div class="bg-white rounded-xl shadow-sm p-6">
        <div class="flex items-center justify-between">
            <div>
                <h3 class="font-bold text-gray-800">Export Laporan</h3>
                <p class="text-sm text-gray-500 mt-1">Download laporan statistik dalam berbagai format</p>
            </div>
            <div class="flex items-center space-x-3">
                <button class="px-6 py-3 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors font-semibold">
                    <i class="fas fa-file-excel mr-2"></i>
                    Excel
                </button>
                <button class="px-6 py-3 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors font-semibold">
                    <i class="fas fa-file-pdf mr-2"></i>
                    PDF
                </button>
                <button class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors font-semibold">
                    <i class="fas fa-file-csv mr-2"></i>
                    CSV
                </button>
            </div>
        </div>
    </div>
</div>
@endsection
