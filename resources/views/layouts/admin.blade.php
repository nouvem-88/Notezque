<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - NotezQue</title> <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-50 font-sans antialiased">
    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        <aside class="w-64 bg-white shadow-lg flex-shrink-0 hidden md:flex flex-col">
            <div class="p-6 border-b border-gray-200">
                <h1 class="text-2xl font-bold text-blue-600 flex items-center">
                    <i class="fas fa-clipboard-list mr-2"></i>
                    NotezQue
                </h1>
                <p class="text-xs text-gray-500 mt-1">Productivity Organizer</p>
            </div>
            
            <nav class="flex-1 p-4 space-y-2">
                <a href="#" class="flex items-center px-4 py-3 text-blue-600 bg-blue-50 rounded-lg font-medium transition-colors">
                    <i class="fas fa-chart-line w-5 mr-3"></i>
                    Dashboard
                </a>
                <a href="#" class="flex items-center px-4 py-3 text-gray-700 hover:bg-gray-100 rounded-lg transition-colors">
                    <i class="fas fa-users w-5 mr-3"></i>
                    Pengguna
                </a>
                <a href="#" class="flex items-center px-4 py-3 text-gray-700 hover:bg-gray-100 rounded-lg transition-colors">
                    <i class="fas fa-file-alt w-5 mr-3"></i>
                    Konten Statis
                </a>
                <a href="#" class="flex items-center px-4 py-3 text-gray-700 hover:bg-gray-100 rounded-lg transition-colors">
                    <i class="fas fa-chart-bar w-5 mr-3"></i>
                    Statistik
                </a>
            </nav>

            <div class="p-4 border-t border-gray-200">
                <div class="bg-blue-50 rounded-lg p-4">
                    <h3 class="font-semibold text-sm text-gray-800 mb-1">Butuh Bantuan?</h3>
                    <p class="text-xs text-gray-600 mb-3">Hubungi tim support kami</p>
                    <button class="w-full bg-blue-600 text-white text-sm py-2 rounded-md hover:bg-blue-700 transition-colors">
                        Hubungi Support
                    </button>
                </div>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Topbar -->
            <header class="bg-white shadow-sm border-b border-gray-200 z-10">
                <div class="flex items-center justify-between px-6 py-4">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-800">Dashboard</h2>
                        <p class="text-sm text-gray-500">Selamat datang kembali di NotezQue</p>
                    </div>
                    
                    <div class="flex items-center space-x-4">
                        <!-- Notifikasi -->
                        <button class="relative p-2 text-gray-600 hover:bg-gray-100 rounded-lg transition-colors">
                            <i class="fas fa-bell text-xl"></i>
                            <span class="absolute top-1 right-1 w-2 h-2 bg-red-500 rounded-full"></span>
                        </button>
                        
                        <!-- Profil Admin -->
                        <div class="flex items-center space-x-3 pl-3 border-l border-gray-200">
                            <div class="text-right">
                                <p class="text-sm font-semibold text-gray-800">Admin NotezQue</p>
                                <p class="text-xs text-gray-500">Administrator</p>
                            </div>
                            <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-blue-600 rounded-full flex items-center justify-center text-white font-bold">
                                AN
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Main Content Area -->
            <main class="flex-1 overflow-y-auto bg-gray-50 p-6">
                <!-- Kartu Statistik -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
                    <!-- Total Pengguna -->
                    <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 hover:shadow-md transition-shadow">
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                                <i class="fas fa-users text-blue-600 text-xl"></i>
                            </div>
                            <span class="text-green-500 text-sm font-semibold flex items-center">
                                <i class="fas fa-arrow-up mr-1"></i> 12%
                            </span>
                        </div>
                        <h3 class="text-gray-500 text-sm font-medium mb-1">Total Pengguna</h3>
                        <p class="text-3xl font-bold text-gray-800">{{ number_format($statistics['total_users']) }}</p>
                    </div>

                    <!-- Tugas Aktif -->
                    <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 hover:shadow-md transition-shadow">
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                                <i class="fas fa-tasks text-purple-600 text-xl"></i>
                            </div>
                            <span class="text-green-500 text-sm font-semibold flex items-center">
                                <i class="fas fa-arrow-up mr-1"></i> 8%
                            </span>
                        </div>
                        <h3 class="text-gray-500 text-sm font-medium mb-1">Tugas Aktif</h3>
                        <p class="text-3xl font-bold text-gray-800">{{ number_format($statistics['active_tasks']) }}</p>
                    </div>

                    <!-- Aktivitas Hari Ini -->
                    <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 hover:shadow-md transition-shadow">
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                                <i class="fas fa-chart-line text-green-600 text-xl"></i>
                            </div>
                            <span class="text-green-500 text-sm font-semibold flex items-center">
                                <i class="fas fa-arrow-up mr-1"></i> 24%
                            </span>
                        </div>
                        <h3 class="text-gray-500 text-sm font-medium mb-1">Aktivitas Hari Ini</h3>
                        <p class="text-3xl font-bold text-gray-800">{{ number_format($statistics['today_activities']) }}</p>
                    </div>

                    <!-- Kolaborasi -->
                    <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 hover:shadow-md transition-shadow">
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-12 h-12 bg-orange-100 rounded-lg flex items-center justify-center">
                                <i class="fas fa-user-friends text-orange-600 text-xl"></i>
                            </div>
                            <span class="text-green-500 text-sm font-semibold flex items-center">
                                <i class="fas fa-arrow-up mr-1"></i> 15%
                            </span>
                        </div>
                        <h3 class="text-gray-500 text-sm font-medium mb-1">Kolaborasi</h3>
                        <p class="text-3xl font-bold text-gray-800">{{ number_format($statistics['collaborations']) }}</p>
                    </div>
                </div>

                <!-- Grid untuk Grafik dan Aktivitas -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
                    <!-- Grafik Placeholder -->
                    <div class="lg:col-span-2 bg-white rounded-xl shadow-sm p-6 border border-gray-100">
                        <h3 class="text-lg font-bold text-gray-800 mb-4">Statistik Pengguna Bulanan</h3>
                        <div class="bg-gradient-to-br from-blue-50 to-purple-50 rounded-lg h-64 flex items-center justify-center">
                            <div class="text-center">
                                <i class="fas fa-chart-area text-6xl text-blue-400 mb-3"></i>
                                <p class="text-gray-600 font-medium">Grafik akan ditampilkan di sini</p>
                                <p class="text-sm text-gray-500 mt-1">Integrasi Chart.js atau library lainnya</p>
                            </div>
                        </div>
                    </div>

                    <!-- Aktivitas Terbaru -->
                    <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
                        <h3 class="text-lg font-bold text-gray-800 mb-4">Aktivitas Terbaru</h3>
                        <div class="space-y-4">
                            @foreach($recent_activities as $activity)
                                <div class="flex items-start space-x-3 pb-4 border-b border-gray-100 last:border-0">
                                    <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center flex-shrink-0">
                                        <i class="fas fa-user text-blue-600 text-xs"></i>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-semibold text-gray-800 truncate">{{ $activity['user'] }}</p>
                                        <p class="text-xs text-gray-600 mt-1">{{ $activity['action'] }}</p>
                                        <p class="text-xs text-gray-400 mt-1">{{ $activity['time'] }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Tabel Daftar Pengguna -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <div class="flex items-center justify-between">
                            <h3 class="text-lg font-bold text-gray-800">Daftar Pengguna</h3>
                            <button class="px-4 py-2 bg-blue-600 text-white text-sm rounded-lg hover:bg-blue-700 transition-colors flex items-center">
                                <i class="fas fa-plus mr-2"></i> Tambah Pengguna
                            </button>
                        </div>
                    </div>
                    
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-gray-50 border-b border-gray-200">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">ID</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Nama</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Email</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Role</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Tugas Selesai</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Tanggal Bergabung</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @foreach($users as $user)
                                    <tr class="hover:bg-gray-50 transition-colors">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 font-medium">{{ $user['id'] }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="w-8 h-8 bg-gradient-to-br from-blue-400 to-blue-600 rounded-full flex items-center justify-center text-white text-xs font-bold mr-3">
                                                    {{ strtoupper(substr($user['name'], 0, 2)) }}
                                                </div>
                                                <span class="text-sm font-medium text-gray-800">{{ $user['name'] }}</span>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $user['email'] }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-3 py-1 text-xs font-semibold rounded-full 
                                                {{ $user['role'] == 'Admin' ? 'bg-red-100 text-red-800' : '' }}
                                                {{ $user['role'] == 'Moderator' ? 'bg-purple-100 text-purple-800' : '' }}
                                                {{ $user['role'] == 'User' ? 'bg-blue-100 text-blue-800' : '' }}">
                                                {{ $user['role'] }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-3 py-1 text-xs font-semibold rounded-full 
                                                {{ $user['status'] == 'Active' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                                {{ $user['status'] }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 font-semibold">{{ $user['tasks_completed'] }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ date('d M Y', strtotime($user['joined_date'])) }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                                            <button class="text-blue-600 hover:text-blue-800 mr-3" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="text-red-600 hover:text-red-800" title="Hapus">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="px-6 py-4 border-t border-gray-200 bg-gray-50">
                        <div class="flex items-center justify-between">
                            <p class="text-sm text-gray-600">Menampilkan <span class="font-semibold">{{ count($users) }}</span> pengguna</p>
                            <div class="flex space-x-2">
                                <button class="px-3 py-1 border border-gray-300 rounded-md text-sm text-gray-600 hover:bg-gray-100 transition-colors">
                                    Sebelumnya
                                </button>
                                <button class="px-3 py-1 bg-blue-600 text-white rounded-md text-sm hover:bg-blue-700 transition-colors">
                                    1
                                </button>
                                <button class="px-3 py-1 border border-gray-300 rounded-md text-sm text-gray-600 hover:bg-gray-100 transition-colors">
                                    2
                                </button>
                                <button class="px-3 py-1 border border-gray-300 rounded-md text-sm text-gray-600 hover:bg-gray-100 transition-colors">
                                    Selanjutnya
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
</body>
</html>