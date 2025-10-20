@extends('layouts.admin')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')
@section('page-subtitle', 'Selamat datang kembali di NotezQue')

@section('content')
    <!-- Kartu Statistik Ringkasan -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
        <!-- Kartu 1: Total Pengguna -->
        <x-stat-card
            title="Total Pengguna"
            :value="number_format($statistics['total_users'])"
            icon="fa-users"
            color="blue"
            variant="solid"
        />

        <!-- Kartu 2: Tugas Aktif -->
        <x-stat-card
            title="Tugas Aktif"
            :value="number_format($statistics['active_tasks'])"
            icon="fa-list-check"
            color="green"
            variant="solid"
        />

        <!-- Kartu 3: Aktivitas Hari Ini -->
        <x-stat-card
            title="Aktivitas Hari Ini"
            :value="number_format($statistics['today_activities'])"
            icon="fa-chart-line"
            color="yellow"
            variant="solid"
        />

        <!-- Kartu 4: Kolaborasi -->
        <x-stat-card
            title="Kolaborasi"
            :value="number_format($statistics['collaborations'])"
            icon="fa-user-group"
            color="purple"
            variant="solid"
        />
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
        <!-- Grafik Placeholder -->
        <div class="lg:col-span-2 bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-gray-800">Grafik Aktivitas Pengguna</h3>
                <select class="text-sm border border-gray-300 rounded-md px-3 py-1 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option>7 Hari Terakhir</option>
                    <option>30 Hari Terakhir</option>
                    <option>3 Bulan Terakhir</option>
                </select>
            </div>
            <div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-lg p-8 flex items-center justify-center h-80">
                <div class="text-center">
                    <i class="fas fa-chart-area text-6xl text-blue-400 mb-4"></i>
                    <p class="text-gray-600 font-medium">Grafik Aktivitas</p>
                    <p class="text-sm text-gray-500">Placeholder untuk Chart.js atau library grafik lainnya</p>
                </div>
            </div>
        </div>

        <!-- Aktivitas Terbaru -->
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Aktivitas Terbaru</h3>
            <div class="space-y-4">
                @foreach($recent_activities as $activity)
                    <div class="flex items-start space-x-3 pb-4 border-b border-gray-100 last:border-b-0">
                        <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-check text-blue-600 text-xs"></i>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm text-gray-800"><span class="font-semibold">{{ $activity['user'] }}</span> {{ $activity['action'] }}</p>
                            <p class="text-xs text-gray-500 mt-1">{{ $activity['time'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
            <a href="#" class="block text-center text-blue-600 hover:text-blue-700 font-medium text-sm mt-4">
                Lihat Semua Aktivitas <i class="fas fa-arrow-right ml-1"></i>
            </a>
        </div>
    </div>

    <!-- Tabel Pengguna -->
    <div class="bg-white rounded-lg shadow">
        <div class="p-6 border-b border-gray-200">
            <div class="flex items-center justify-between">
                <h3 class="text-lg font-semibold text-gray-800">Pengguna Terbaru</h3>
                <a href="{{ route('admin.users') }}" class="text-blue-600 hover:text-blue-700 font-medium text-sm">
                    Lihat Semua <i class="fas fa-arrow-right ml-1"></i>
                </a>
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Role</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tugas Selesai</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($users as $user)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="w-8 h-8 bg-gradient-to-br from-blue-400 to-blue-600 rounded-full flex items-center justify-center text-white font-semibold text-sm mr-3">
                                        {{ substr($user['name'], 0, 1) }}
                                    </div>
                                    <span class="text-sm font-medium text-gray-900">{{ $user['name'] }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $user['email'] }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 py-1 text-xs font-medium rounded-full 
                                    {{ $user['role'] === 'Admin' ? 'bg-purple-100 text-purple-800' : ($user['role'] === 'Moderator' ? 'bg-blue-100 text-blue-800' : 'bg-gray-100 text-gray-800') }}">
                                    {{ $user['role'] }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 py-1 text-xs font-medium rounded-full 
                                    {{ $user['status'] === 'Active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ $user['status'] }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $user['tasks_completed'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
