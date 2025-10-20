@extends('layouts.admin')

@section('title', 'Statistik')
@section('page-title', 'Statistik & Analisis')
@section('page-subtitle', 'Laporan performa dan analisis NotezQue')

@section('content')
    <!-- Ringkasan Statistik -->
    <div class="grid grid-cols-1 md:grid-cols-5 gap-6 mb-6">
        <x-stat-card
            title="Total Pengguna"
            :value="number_format($summary['total_users'])"
            icon="fa-users"
            color="blue"
            variant="solid"
        />

        <x-stat-card
            title="Total Tugas"
            :value="number_format($summary['total_tasks'])"
            icon="fa-tasks"
            color="green"
            variant="solid"
        />

        <x-stat-card
            title="Tugas Selesai"
            :value="number_format($summary['completed_tasks'])"
            icon="fa-check-circle"
            color="purple"
            variant="solid"
        />

        <x-stat-card
            title="Kolaborasi Aktif"
            :value="number_format($summary['active_collaborations'])"
            icon="fa-user-friends"
            color="yellow"
            variant="solid"
        />

        <x-stat-card
            title="Pertumbuhan"
            :value="'+' . $summary['growth_rate'] . '%'"
            icon="fa-chart-line"
            color="indigo"
            variant="solid"
        />
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
        <!-- Grafik Aktivitas Harian -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-gray-800">Aktivitas 7 Hari Terakhir</h3>
                <select class="text-sm border border-gray-300 rounded-md px-3 py-1 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option>7 Hari</option>
                    <option>30 Hari</option>
                    <option>90 Hari</option>
                </select>
            </div>
            
            <div class="space-y-3">
                @foreach($daily_stats as $stat)
                    <div class="border-b border-gray-100 pb-3 last:border-b-0">
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-sm font-medium text-gray-700">{{ date('D, d M', strtotime($stat['date'])) }}</span>
                            <span class="text-sm text-gray-600">{{ $stat['users'] }} pengguna aktif</span>
                        </div>
                        <div class="grid grid-cols-3 gap-3">
                            <div class="bg-blue-50 rounded p-2 text-center">
                                <p class="text-xs text-gray-600">Pengguna</p>
                                <p class="text-lg font-bold text-blue-600">{{ $stat['users'] }}</p>
                            </div>
                            <div class="bg-green-50 rounded p-2 text-center">
                                <p class="text-xs text-gray-600">Tugas</p>
                                <p class="text-lg font-bold text-green-600">{{ $stat['tasks'] }}</p>
                            </div>
                            <div class="bg-purple-50 rounded p-2 text-center">
                                <p class="text-xs text-gray-600">Kolaborasi</p>
                                <p class="text-lg font-bold text-purple-600">{{ $stat['collaborations'] }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Statistik per Kategori -->
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Tugas per Kategori</h3>
            <div class="space-y-4">
                @foreach($category_stats as $category)
                    <div>
                        <div class="flex items-center justify-between mb-2">
                            <div class="flex items-center">
                                <div class="w-8 h-8 rounded-lg flex items-center justify-center mr-3
                                    {{ $category['category'] === 'Pekerjaan' ? 'bg-blue-100' : 
                                       ($category['category'] === 'Pribadi' ? 'bg-green-100' : 
                                       ($category['category'] === 'Belajar' ? 'bg-purple-100' : 'bg-yellow-100')) }}">
                                    <i class="fas {{ $category['category'] === 'Pekerjaan' ? 'fa-briefcase text-blue-600' : 
                                       ($category['category'] === 'Pribadi' ? 'fa-user text-green-600' : 
                                       ($category['category'] === 'Belajar' ? 'fa-book text-purple-600' : 'fa-heart text-yellow-600')) }}"></i>
                                </div>
                                <span class="text-sm font-medium text-gray-700">{{ $category['category'] }}</span>
                            </div>
                            <span class="text-sm font-semibold text-gray-800">{{ number_format($category['tasks']) }} tugas</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <div class="flex-1 bg-gray-200 rounded-full h-3 overflow-hidden">
                                <div class="h-3 rounded-full transition-all duration-500
                                    {{ $category['category'] === 'Pekerjaan' ? 'bg-blue-600' : 
                                       ($category['category'] === 'Pribadi' ? 'bg-green-600' : 
                                       ($category['category'] === 'Belajar' ? 'bg-purple-600' : 'bg-yellow-600')) }}" 
                                    style="width: {{ $category['percentage'] }}%"></div>
                            </div>
                            <span class="text-sm font-medium text-gray-600 w-10 text-right">{{ $category['percentage'] }}%</span>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Total -->
            <div class="mt-6 pt-4 border-t border-gray-200">
                <div class="flex items-center justify-between">
                    <span class="text-sm font-semibold text-gray-800">Total Tugas</span>
                    <span class="text-lg font-bold text-gray-900">{{ number_format(array_sum(array_column($category_stats, 'tasks'))) }}</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Top Performers -->
    <div class="bg-white rounded-lg shadow">
        <div class="p-6 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-800">Top Performers</h3>
            <p class="text-sm text-gray-600 mt-1">Pengguna dengan performa terbaik bulan ini</p>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Rank</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Pengguna</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tugas Selesai</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kolaborasi</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Performance</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Badge</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($top_users as $index => $user)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    @if($index === 0)
                                        <div class="w-8 h-8 bg-yellow-400 rounded-full flex items-center justify-center text-white font-bold">
                                            <i class="fas fa-crown"></i>
                                        </div>
                                    @elseif($index === 1)
                                        <div class="w-8 h-8 bg-gray-400 rounded-full flex items-center justify-center text-white font-bold">
                                            {{ $index + 1 }}
                                        </div>
                                    @elseif($index === 2)
                                        <div class="w-8 h-8 bg-orange-400 rounded-full flex items-center justify-center text-white font-bold">
                                            {{ $index + 1 }}
                                        </div>
                                    @else
                                        <div class="w-8 h-8 bg-gray-200 rounded-full flex items-center justify-center text-gray-700 font-bold">
                                            {{ $index + 1 }}
                                        </div>
                                    @endif
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 bg-gradient-to-br from-blue-400 to-blue-600 rounded-full flex items-center justify-center text-white font-semibold mr-3">
                                        {{ substr($user['name'], 0, 1) }}
                                    </div>
                                    <span class="text-sm font-medium text-gray-900">{{ $user['name'] }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <i class="fas fa-check-circle text-green-500 mr-2"></i>
                                    <span class="text-sm font-semibold text-gray-800">{{ $user['tasks_completed'] }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <i class="fas fa-users text-purple-500 mr-2"></i>
                                    <span class="text-sm font-semibold text-gray-800">{{ $user['collaborations'] }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="w-32 bg-gray-200 rounded-full h-2 mr-2">
                                        <div class="bg-gradient-to-r from-blue-500 to-green-500 h-2 rounded-full" 
                                            style="width: {{ min(($user['tasks_completed'] / 70) * 100, 100) }}%"></div>
                                    </div>
                                    <span class="text-xs font-medium text-gray-600">{{ min(round(($user['tasks_completed'] / 70) * 100), 100) }}%</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($index === 0)
                                    <span class="px-3 py-1 text-xs font-medium rounded-full bg-yellow-100 text-yellow-800">
                                        <i class="fas fa-trophy mr-1"></i>Champion
                                    </span>
                                @elseif($user['tasks_completed'] >= 50)
                                    <span class="px-3 py-1 text-xs font-medium rounded-full bg-blue-100 text-blue-800">
                                        <i class="fas fa-star mr-1"></i>Star Performer
                                    </span>
                                @else
                                    <span class="px-3 py-1 text-xs font-medium rounded-full bg-gray-100 text-gray-800">
                                        <i class="fas fa-medal mr-1"></i>Top Contributor
                                    </span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
