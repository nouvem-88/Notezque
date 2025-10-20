@extends('layouts.main-nav')
@section('title','Kelola Tugas')

@section('content')

<div class="min-h-screen flex flex-col">

                <!-- Konten Utama -->
        <main class="flex-grow">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                
                <!-- Judul, Filter, dan Tombol Tambah -->
                <div class="flex flex-wrap justify-between items-center gap-4 mb-8">
                    <h2 class="text-3xl font-bold text-slate-900">Daftar Tugas</h2>
                    <div class="flex items-center gap-4">
                        <!-- Filter Dropdown -->
                        <div class="relative">
                            <select class="appearance-none w-full md:w-48 bg-white border border-slate-300 text-slate-700 py-2 pl-4 pr-8 rounded-lg focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
                                <option>Semua Status</option>
                                <option>Open</option>
                                <option>In Progress</option>
                                <option>Selesai</option>
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-slate-700">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                            </div>
                        </div>
                        <!-- Tombol Tambah -->
                        <button onclick="openAddModal()" class="flex items-center gap-2 bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg shadow-md hover:bg-blue-700 transition duration-300">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" /></svg>
                            <span>Tambah Tugas</span>
                        </button>
                    </div>
                </div>


                <!-- Grid Kartu Tugas -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    
                    {{-- Contoh Kartu Tugas 1 (Open) --}}
                    <div class="bg-white rounded-xl shadow-lg p-6 transform hover:-translate-y-1 transition-transform duration-300 cursor-pointer" 
                         onclick="openDetailModal(this)"
                         data-title="Tugas Pendahuluan"
                         data-status="Open"
                         data-matkul="WebPro"
                         data-tenggat="Sabtu, 21 Juni 2025"
                         data-keterangan="Membuat halaman sesuai pembagian masing-masing anggota kelompok.">
                        <div class="flex justify-between items-start mb-4">
                            <h3 class="font-bold text-lg text-slate-800">Tugas Pendahuluan</h3>
                            <button class="text-slate-400 hover:text-red-500 z-10" onclick="event.stopPropagation(); alert('Hapus Tugas?')">
                                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                            </button>
                        </div>
                        <div class="flex items-center gap-2 mb-3">
                            <span class="text-sm font-medium text-slate-600">Status:</span>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                <svg class="w-2 h-2 mr-1.5 text-green-500" fill="currentColor" viewBox="0 0 8 8"><circle cx="4" cy="4" r="3" /></svg>
                                Open
                            </span>
                        </div>
                        <div class="text-sm text-slate-600 space-y-2">
                            <p><span class="font-semibold">Mata Kuliah:</span> WebPro</p>
                            <p><span class="font-semibold">Tenggat:</span> Sabtu, 21 Juni 2025</p>
                            <p class="mt-2"><span class="font-semibold">Keterangan:</span><br>Membuat halaman sesuai pembagian masing-masing anggota kelompok.</p>
                        </div>
                        <div class="border-t my-4"></div>
                        <div class="flex items-center text-sm text-slate-500">
                            <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.653-.124-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.653.124-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
                            <span>Kolaborator</span>
                        </div>
                    </div>

                    {{-- Contoh Kartu Tugas 2 (In Progress) --}}
                     <div class="bg-white rounded-xl shadow-lg p-6 transform hover:-translate-y-1 transition-transform duration-300 cursor-pointer"
                         onclick="openDetailModal(this)"
                         data-title="Tugas Praktek PHP"
                         data-status="In Progress"
                         data-matkul="WebPro"
                         data-tenggat="Sabtu, 21 Juni 2025"
                         data-keterangan="Mengerjakan fungsionalitas masing-masing anggota kelompok.">
                        <div class="flex justify-between items-start mb-4">
                            <h3 class="font-bold text-lg text-slate-800">Tugas Praktek PHP</h3>
                             <button class="text-slate-400 hover:text-red-500 z-10" onclick="event.stopPropagation(); alert('Hapus Tugas?')">
                                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                            </button>
                        </div>
                         <div class="flex items-center gap-2 mb-3">
                            <span class="text-sm font-medium text-slate-600">Status:</span>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                <svg class="w-2 h-2 mr-1.5 text-yellow-500" fill="currentColor" viewBox="0 0 8 8"><circle cx="4" cy="4" r="3" /></svg>
                                In Progress
                            </span>
                        </div>
                        <div class="text-sm text-slate-600 space-y-2">
                           <p><span class="font-semibold">Mata Kuliah:</span> WebPro</p>
                           <p><span class="font-semibold">Tenggat:</span> Sabtu, 21 Juni 2025</p>
                           <p class="mt-2"><span class="font-semibold">Keterangan:</span><br>Mengerjakan fungsionalitas masing-masing anggota kelompok.</p>
                        </div>
                        <div class="border-t my-4"></div>
                        <div class="flex items-center text-sm text-slate-500">
                           <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.653-.124-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.653.124-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
                           <span>Kolaborator</span>
                        </div>
                    </div>
                    
                    {{-- Contoh Kartu Tugas 3 (Selesai) --}}
                     <div class="bg-white rounded-xl shadow-lg p-6 transform hover:-translate-y-1 transition-transform duration-300 cursor-pointer"
                         onclick="openDetailModal(this)"
                         data-title="Laporan Akhir"
                         data-status="Selesai"
                         data-matkul="Manajemen Proyek"
                         data-tenggat="Jumat, 20 Juni 2025"
                         data-keterangan="Menyusun laporan akhir proyek dan presentasi.">
                        <div class="flex justify-between items-start mb-4">
                            <h3 class="font-bold text-lg text-slate-800">Laporan Akhir</h3>
                             <button class="text-slate-400 hover:text-red-500 z-10" onclick="event.stopPropagation(); alert('Hapus Tugas?')">
                                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                            </button>
                        </div>
                         <div class="flex items-center gap-2 mb-3">
                            <span class="text-sm font-medium text-slate-600">Status:</span>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                <svg class="w-2 h-2 mr-1.5 text-blue-500" fill="currentColor" viewBox="0 0 8 8"><circle cx="4" cy="4" r="3" /></svg>
                                Selesai
                            </span>
                        </div>
                        <div class="text-sm text-slate-600 space-y-2">
                           <p><span class="font-semibold">Mata Kuliah:</span> Manajemen Proyek</p>
                           <p><span class="font-semibold">Tenggat:</span> Jumat, 20 Juni 2025</p>
                           <p class="mt-2"><span class="font-semibold">Keterangan:</span><br>Menyusun laporan akhir proyek dan presentasi.</p>
                        </div>
                        <div class="border-t my-4"></div>
                        <div class="flex items-center text-sm text-slate-500">
                           <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.653-.124-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.653.124-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
                           <span>Kolaborator</span>
                        </div>
                    </div>

                    {{-- Contoh Kartu Tugas 4 (Open) --}}
                     <div class="bg-white rounded-xl shadow-lg p-6 transform hover:-translate-y-1 transition-transform duration-300 cursor-pointer"
                         onclick="openDetailModal(this)"
                         data-title="Desain UI/UX"
                         data-status="Open"
                         data-matkul="Interaksi Manusia Komputer"
                         data-tenggat="Senin, 30 Juni 2025"
                         data-keterangan="Membuat wireframe dan mockup untuk aplikasi mobile.">
                        <div class="flex justify-between items-start mb-4">
                            <h3 class="font-bold text-lg text-slate-800">Desain UI/UX</h3>
                             <button class="text-slate-400 hover:text-red-500 z-10" onclick="event.stopPropagation(); alert('Hapus Tugas?')">
                                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                            </button>
                        </div>
                         <div class="flex items-center gap-2 mb-3">
                            <span class="text-sm font-medium text-slate-600">Status:</span>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                <svg class="w-2 h-2 mr-1.5 text-green-500" fill="currentColor" viewBox="0 0 8 8"><circle cx="4" cy="4" r="3" /></svg>
                                Open
                            </span>
                        </div>
                        <div class="text-sm text-slate-600 space-y-2">
                           <p><span class="font-semibold">Mata Kuliah:</span> Interaksi Manusia Komputer</p>
                           <p><span class="font-semibold">Tenggat:</span> Senin, 30 Juni 2025</p>
                           <p class="mt-2"><span class="font-semibold">Keterangan:</span><br>Membuat wireframe dan mockup untuk aplikasi mobile.</p>
                        </div>
                        <div class="border-t my-4"></div>
                        <div class="flex items-center text-sm text-slate-500">
                           <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.653-.124-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.653.124-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
                           <span>Kolaborator</span>
                        </div>
                    </div>

                    {{-- Contoh Kartu Tugas 5 (In Progress) --}}
                     <div class="bg-white rounded-xl shadow-lg p-6 transform hover:-translate-y-1 transition-transform duration-300 cursor-pointer"
                         onclick="openDetailModal(this)"
                         data-title="Deploy ke Server"
                         data-status="In Progress"
                         data-matkul="WebPro"
                         data-tenggat="Kamis, 26 Juni 2025"
                         data-keterangan="Konfigurasi server dan deployment aplikasi.">
                        <div class="flex justify-between items-start mb-4">
                            <h3 class="font-bold text-lg text-slate-800">Deploy ke Server</h3>
                             <button class="text-slate-400 hover:text-red-500 z-10" onclick="event.stopPropagation(); alert('Hapus Tugas?')">
                                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                            </button>
                        </div>
                         <div class="flex items-center gap-2 mb-3">
                            <span class="text-sm font-medium text-slate-600">Status:</span>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                <svg class="w-2 h-2 mr-1.5 text-yellow-500" fill="currentColor" viewBox="0 0 8 8"><circle cx="4" cy="4" r="3" /></svg>
                                In Progress
                            </span>
                        </div>
                        <div class="text-sm text-slate-600 space-y-2">
                           <p><span class="font-semibold">Mata Kuliah:</span> WebPro</p>
                           <p><span class="font-semibold">Tenggat:</span> Kamis, 26 Juni 2025</p>
                           <p class="mt-2"><span class="font-semibold">Keterangan:</span><br>Konfigurasi server dan deployment aplikasi.</p>
                        </div>
                        <div class="border-t my-4"></div>
                        <div class="flex items-center text-sm text-slate-500">
                           <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.653-.124-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.653.124-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
                           <span>Kolaborator</span>
                        </div>
                    </div>
                    
                    {{-- Contoh Kartu Tugas 6 (Selesai) --}}
                     <div class="bg-white rounded-xl shadow-lg p-6 transform hover:-translate-y-1 transition-transform duration-300 cursor-pointer"
                         onclick="openDetailModal(this)"
                         data-title="Riset Keyword SEO"
                         data-status="Selesai"
                         data-matkul="Digital Marketing"
                         data-tenggat="Selasa, 17 Juni 2025"
                         data-keterangan="Mencari keyword potensial untuk halaman blog.">
                        <div class="flex justify-between items-start mb-4">
                            <h3 class="font-bold text-lg text-slate-800">Riset Keyword SEO</h3>
                             <button class="text-slate-400 hover:text-red-500 z-10" onclick="event.stopPropagation(); alert('Hapus Tugas?')">
                                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                            </button>
                        </div>
                         <div class="flex items-center gap-2 mb-3">
                            <span class="text-sm font-medium text-slate-600">Status:</span>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                <svg class="w-2 h-2 mr-1.5 text-blue-500" fill="currentColor" viewBox="0 0 8 8"><circle cx="4" cy="4" r="3" /></svg>
                                Selesai
                            </span>
                        </div>
                        <div class="text-sm text-slate-600 space-y-2">
                           <p><span class="font-semibold">Mata Kuliah:</span> Digital Marketing</p>
                           <p><span class="font-semibold">Tenggat:</span> Selasa, 17 Juni 2025</p>
                           <p class="mt-2"><span class="font-semibold">Keterangan:</span><br>Mencari keyword potensial untuk halaman blog.</p>
                        </div>
                        <div class="border-t my-4"></div>
                        <div class="flex items-center text-sm text-slate-500">
                           <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.653-.124-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.653.124-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
                           <span>Kolaborator</span>
                        </div>
                    </div>

                </div>

                <!-- Paginasi -->
                <div class="flex justify-center items-center mt-8 space-x-2">
                    <a href="#" class="px-4 py-2 text-slate-600 bg-white rounded-md hover:bg-slate-200 transition">
                        &laquo; Sebelumnya
                    </a>
                    <a href="#" class="px-4 py-2 text-white bg-blue-600 rounded-md shadow-md">1</a>
                    <a href="#" class="px-4 py-2 text-slate-600 bg-white rounded-md hover:bg-slate-200 transition">2</a>
                    <a href="#" class="px-4 py-2 text-slate-600 bg-white rounded-md hover:bg-slate-200 transition">3</a>
                    <a href="#" class="px-4 py-2 text-slate-600 bg-white rounded-md hover:bg-slate-200 transition">
                        Selanjutnya &raquo;
                    </a>
                </div>
            </div>
        </main>

    </div>

    <!-- Modal Tambah Tugas -->
    <div id="add-task-modal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-xl shadow-2xl p-8 w-full max-w-md transform transition-all" onclick="event.stopPropagation()">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-2xl font-bold">Tambah Tugas Baru</h3>
                <button onclick="closeAddModal()" class="text-slate-400 hover:text-slate-600">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                </button>
            </div>
            <form action="#" method="POST">
                @csrf
                <div class="space-y-4">
                    <div>
                        <label for="nama_tugas" class="block text-sm font-medium text-slate-700">Nama Tugas</label>
                        <input type="text" id="nama_tugas" name="nama_tugas" class="mt-1 block w-full rounded-md border-slate-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm" placeholder="Contoh: Membuat Landing Page">
                    </div>
                    <div>
                        <label for="detail_tugas" class="block text-sm font-medium text-slate-700">Keterangan</label>
                        <textarea id="detail_tugas" name="detail_tugas" rows="3" class="mt-1 block w-full rounded-md border-slate-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm" placeholder="Jelaskan detail tugas di sini..."></textarea>
                    </div>
                    <div class="flex justify-end gap-4 pt-4">
                        <button type="button" onclick="closeAddModal()" class="bg-slate-200 text-slate-700 font-semibold py-2 px-4 rounded-lg hover:bg-slate-300 transition">
                            Batal
                        </button>
                        <button type="submit" class="bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg shadow-md hover:bg-blue-700 transition">
                            Simpan Tugas
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Detail/Edit Tugas -->
    <div id="detail-modal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-xl shadow-2xl p-8 w-full max-w-md transform transition-all" onclick="event.stopPropagation()">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-2xl font-bold">Detail Tugas</h3>
                <button onclick="closeDetailModal()" class="text-slate-400 hover:text-slate-600">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                </button>
            </div>
            <form id="edit-task-form" action="#" method="POST">
                @csrf
                @method('PUT') {{-- Method spoofing untuk update --}}
                <div class="space-y-4">
                    <div>
                        <label for="edit_nama_tugas" class="block text-sm font-medium text-slate-700">Nama Tugas</label>
                        <input type="text" id="edit_nama_tugas" name="nama_tugas" class="mt-1 block w-full rounded-md border-slate-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                    </div>
                    <div>
                        <label for="edit_status" class="block text-sm font-medium text-slate-700">Status</label>
                        <select id="edit_status" name="status" class="mt-1 block w-full rounded-md border-slate-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                            <option>Open</option>
                            <option>In Progress</option>
                            <option>Selesai</option>
                        </select>
                    </div>
                    <div>
                        <label for="edit_keterangan" class="block text-sm font-medium text-slate-700">Keterangan</label>
                        <textarea id="edit_keterangan" name="keterangan" rows="3" class="mt-1 block w-full rounded-md border-slate-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"></textarea>
                    </div>
                    <div class="flex justify-end gap-4 pt-4">
                        <button type="button" onclick="closeDetailModal()" class="bg-slate-200 text-slate-700 font-semibold py-2 px-4 rounded-lg hover:bg-slate-300 transition">
                            Batal
                        </button>
                        <button type="submit" class="bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg shadow-md hover:bg-blue-700 transition">
                            Simpan Perubahan
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    
    <script>
        // --- Fungsi untuk Modal Tambah ---
        const addModal = document.getElementById('add-task-modal');
        
        function openAddModal() {
            addModal.classList.remove('hidden');
        }

        function closeAddModal() {
            addModal.classList.add('hidden');
        }

        // --- Fungsi untuk Modal Detail/Edit ---
        const detailModal = document.getElementById('detail-modal');
        const editTaskForm = document.getElementById('edit-task-form');
        const editNamaTugas = document.getElementById('edit_nama_tugas');
        const editStatus = document.getElementById('edit_status');
        const editKeterangan = document.getElementById('edit_keterangan');
        
        function openDetailModal(cardElement) {
            // Mengambil data dari atribut data-* pada kartu yang diklik
            const title = cardElement.getAttribute('data-title');
            const status = cardElement.getAttribute('data-status');
            const keterangan = cardElement.getAttribute('data-keterangan');
            const taskId = cardElement.getAttribute('data-id'); // Asumsi ada data-id

            // Mengisi form di dalam modal dengan data yang didapat
            editNamaTugas.value = title;
            editStatus.value = status;
            editKeterangan.value = keterangan;

            // Mengatur action form untuk update
            let updateUrl = `{{ url('tugas') }}/${taskId}`;
            editTaskForm.setAttribute('action', updateUrl);
            
            detailModal.classList.remove('hidden');
        }

        function closeDetailModal() {
            detailModal.classList.add('hidden');
        }
        
        // Menutup modal jika user mengklik di luar area modal
        window.onclick = function(event) {
            if (event.target == addModal) {
                closeAddModal();
            }
            if (event.target == detailModal) {
                closeDetailModal();
            }
        }

    </script>


@endsection