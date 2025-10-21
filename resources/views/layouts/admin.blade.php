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
                <a href="{{ route('admin.dashboard') }}" 
                   class="flex items-center px-4 py-3 rounded-lg font-medium transition-colors {{ Request::is('admin/dashboard') || Request::is('admin') ? 'text-blue-600 bg-blue-50' : 'text-gray-700 hover:bg-gray-100' }}">
                    <i class="fas fa-chart-line w-5 mr-3"></i>
                    Dashboard
                </a>
                <a href="{{ route('admin.users') }}" 
                   class="flex items-center px-4 py-3 rounded-lg font-medium transition-colors {{ Request::is('admin/users') ? 'text-blue-600 bg-blue-50' : 'text-gray-700 hover:bg-gray-100' }}">
                    <i class="fas fa-users w-5 mr-3"></i>
                    Pengguna
                </a>
                <a href="{{ route('admin.content') }}" 
                   class="flex items-center px-4 py-3 rounded-lg font-medium transition-colors {{ Request::is('admin/content') ? 'text-blue-600 bg-blue-50' : 'text-gray-700 hover:bg-gray-100' }}">
                    <i class="fas fa-file-alt w-5 mr-3"></i>
                    Konten Statis
                </a>
                <a href="{{ route('admin.statistics') }}" 
                   class="flex items-center px-4 py-3 rounded-lg font-medium transition-colors {{ Request::is('admin/statistics') ? 'text-blue-600 bg-blue-50' : 'text-gray-700 hover:bg-gray-100' }}">
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
                        <h2 class="text-2xl font-bold text-gray-800">@yield('page-title', 'Dashboard')</h2>
                        <p class="text-sm text-gray-500">@yield('page-subtitle', 'Selamat datang kembali di NotezQue')</p>
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
                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>