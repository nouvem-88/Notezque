@extends('layouts.admin')

@section('title', 'Konten Statis')
@section('page-title', 'Kelola Konten Statis')
@section('page-subtitle', 'Manajemen konten dan artikel NotezQue')

@section('content')
    <!-- Statistik Konten -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
        <x-stat-card
            title="Total Konten"
            :value="$total_content"
            icon="fa-file-alt"
            color="blue"
            variant="solid"
        />

        <x-stat-card
            title="Published"
            :value="$published_content"
            icon="fa-check-circle"
            color="green"
            variant="solid"
        />

        <x-stat-card
            title="Draft"
            :value="$draft_content"
            icon="fa-edit"
            color="yellow"
            variant="solid"
        />

        <x-stat-card
            title="Total Views"
            :value="number_format($total_views)"
            icon="fa-eye"
            color="purple"
            variant="solid"
        />
                
    </div>

    <!-- Filter dan Pencarian -->
    <div class="bg-white rounded-lg shadow mb-6 p-6">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between space-y-4 md:space-y-0">
            <h3 class="text-lg font-semibold text-gray-800">Daftar Konten</h3>
            <div class="flex flex-col sm:flex-row space-y-2 sm:space-y-0 sm:space-x-3">
                <div class="relative">
                    <input type="text" placeholder="Cari konten..." class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm">
                    <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                </div>
                <select class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm">
                    <option>Semua Kategori</option>
                    <option>Tutorial</option>
                    <option>Blog</option>
                    <option>Legal</option>
                    <option>Support</option>
                    <option>Announcement</option>
                </select>
                <select class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm">
                    <option>Semua Status</option>
                    <option>Published</option>
                    <option>Draft</option>
                </select>
                <button class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors text-sm font-medium">
                    <i class="fas fa-plus mr-2"></i>Tambah Konten
                </button>
            </div>
        </div>
    </div>

    <!-- Grid Konten -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($contents as $content)
            <div class="bg-white rounded-lg shadow hover:shadow-lg transition-shadow overflow-hidden">
                <!-- Header Konten -->
                <div class="p-6">
                    <div class="flex items-center justify-between mb-3">
                        <span class="px-3 py-1 text-xs font-medium rounded-full 
                            {{ $content['category'] === 'Tutorial' ? 'bg-blue-100 text-blue-800' : 
                               ($content['category'] === 'Blog' ? 'bg-green-100 text-green-800' : 
                               ($content['category'] === 'Legal' ? 'bg-purple-100 text-purple-800' : 
                               ($content['category'] === 'Support' ? 'bg-yellow-100 text-yellow-800' : 'bg-pink-100 text-pink-800'))) }}">
                            {{ $content['category'] }}
                        </span>
                        <span class="px-3 py-1 text-xs font-medium rounded-full 
                            {{ $content['status'] === 'Published' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                            {{ $content['status'] }}
                        </span>
                    </div>

                    <h3 class="text-lg font-semibold text-gray-800 mb-2 line-clamp-2">{{ $content['title'] }}</h3>
                    
                    <!-- Statistik -->
                    <div class="flex items-center space-x-4 text-sm text-gray-600 mb-4">
                        <div class="flex items-center">
                            <i class="fas fa-eye mr-1 text-gray-400"></i>
                            {{ number_format($content['views']) }}
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-calendar mr-1 text-gray-400"></i>
                            {{ date('d M Y', strtotime($content['created_at'])) }}
                        </div>
                    </div>

                    <!-- Info Update -->
                    <p class="text-xs text-gray-500 mb-4">
                        Terakhir diupdate: {{ date('d M Y', strtotime($content['updated_at'])) }}
                    </p>

                    <!-- Aksi -->
                    <div class="flex space-x-2 pt-4 border-t border-gray-100">
                        <button class="flex-1 bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors text-sm font-medium">
                            <i class="fas fa-edit mr-2"></i>Edit
                        </button>
                        <button class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors text-sm text-gray-700">
                            <i class="fas fa-eye"></i>
                        </button>
                        <button class="px-4 py-2 border border-red-300 text-red-600 rounded-lg hover:bg-red-50 transition-colors text-sm">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Pagination -->
    <div class="mt-6 bg-white rounded-lg shadow px-6 py-4 flex items-center justify-between">
        <p class="text-sm text-gray-600">Menampilkan {{ count($contents) }} dari {{ $total_content }} konten</p>
        <div class="flex space-x-1">
            <button class="px-3 py-1 border border-gray-300 rounded-md text-sm hover:bg-gray-50">Prev</button>
            <button class="px-3 py-1 bg-blue-600 text-white rounded-md text-sm">1</button>
            <button class="px-3 py-1 border border-gray-300 rounded-md text-sm hover:bg-gray-50">2</button>
            <button class="px-3 py-1 border border-gray-300 rounded-md text-sm hover:bg-gray-50">Next</button>
        </div>
    </div>
@endsection
