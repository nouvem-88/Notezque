@extends('layouts.main-nav')
@section('title', 'Kelola Tugas')

@section('content')

    <div class="min-h-screen flex flex-col">

        <!-- Konten Utama -->
        <main class="flex-grow">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

                {{-- Menampilkan notifikasi sukses --}}
                @if(session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                        <span class="block sm:inline">{{ session('success') }}</span>
                    </div>
                @endif

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
                    {{-- Loop ini akan mengambil data dari $tasks di controller --}}
                    @foreach($tasks as $task)
                        <div class="bg-white rounded-xl shadow-lg p-6 transform hover:-translate-y-1 transition-transform duration-300 cursor-pointer" 
                             onclick="openDetailModal(this)"
                             data-id="{{ $task['id'] }}"
                             data-title="{{ $task['title'] }}"
                             data-status="{{ $task['status'] }}"
                             data-matkul="{{ $task['matkul'] }}"
                             data-tenggat="{{ $task['tenggat'] }}"
                             data-keterangan="{{ $task['keterangan'] }}">

                            <div class="flex justify-between items-start mb-4">
                                <h3 class="font-bold text-lg text-slate-800">{{ $task['title'] }}</h3>
                                {{-- Form untuk hapus --}}
                                <form action="{{ route('tugas.destroy', $task['id']) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus tugas ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-slate-400 hover:text-red-500 z-10" onclick="event.stopPropagation();">
                                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </form>
                            </div>

                            <div class="flex items-center gap-2 mb-3">
                                <span class="text-sm font-medium text-slate-600">Status:</span>

                                {{-- Status Badge Dinamis --}}
                                @if($task['status'] == 'Open')
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        <svg class="w-2 h-2 mr-1.5 text-green-500" fill="currentColor" viewBox="0 0 8 8"><circle cx="4" cy="4" r="3" /></svg>
                                        Open
                                    </span>
                                @elseif($task['status'] == 'In Progress')
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                        <svg class="w-2 h-2 mr-1.5 text-yellow-500" fill="currentColor" viewBox="0 0 8 8"><circle cx="4" cy="4" r="3" /></svg>
                                        In Progress
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                        <svg class="w-2 h-2 mr-1.5 text-blue-500" fill="currentColor" viewBox="0 0 8 8"><circle cx="4" cy="4" r="3" /></svg>
                                        Selesai
                                    </span>
                                @endif
                            </div>

                            <div class="text-sm text-slate-600 space-y-2">
                                <p><span class="font-semibold">Mata Kuliah:</span> {{ $task['matkul'] }}</p>
                                <p><span class="font-semibold">Tenggat:</span> 
                                    @if(!empty($task['tenggat']))
                                        {{ \Carbon\Carbon::createFromFormat('Y-m-d', $task['tenggat'])->format('l, d F Y') }}
                                    @else
                                        <span class="text-red-500">Tidak valid</span>
                                    @endif
                                </p>
                                <p class="mt-2"><span class="font-semibold">Keterangan:</span><br>{{ Str::limit($task['keterangan'], 100) }}</p>
                            </div>

                            <div class="border-t my-4"></div>
                            <div class="flex items-center text-sm text-slate-500">
                                <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.653-.124-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.653.124-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
                                <span>Kolaborator</span>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Paginasi (jika menggunakan data dari database) -->
                <div class="flex justify-center items-center mt-8 space-x-2">
                    {{-- Di sini nanti akan ada link paginasi dari Laravel --}}
                </div>
            </div>
        </main>
    </div>

    <!-- Modal Tambah Tugas -->
    <div id="add-task-modal" class="fixed inset-0 bg-black bg-opacity-50 z-50 items-center justify-center p-4 hidden">
        <div class="bg-white rounded-xl shadow-2xl p-8 w-full max-w-md transform transition-all" onclick="event.stopPropagation()">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-2xl font-bold">Tambah Tugas Baru</h3>
                <button onclick="closeAddModal()" class="text-slate-400 hover:text-slate-600">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                </button>
            </div>
            <form action="{{ route('tugas.store') }}" method="POST">
                @csrf
                <div class="space-y-4">
                    <div>
                        <label for="nama_tugas" class="block text-sm font-medium text-slate-700">Nama Tugas</label>
                        <input type="text" id="nama_tugas" name="nama_tugas" class="mt-1 block w-full rounded-md border-slate-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm" placeholder="Contoh: Membuat Landing Page" required>
                    </div>
                    <div>
                        <label for="matkul" class="block text-sm font-medium text-slate-700">Mata Kuliah</label>
                        <input type="text" id="matkul" name="matkul" class="mt-1 block w-full rounded-md border-slate-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm" placeholder="Contoh: Web Programming" required>
                    </div>
                    <div>
                        <label for="tenggat" class="block text-sm font-medium text-slate-700">Tenggat Waktu</label>
                        <input type="date" id="tenggat" name="tenggat" class="mt-1 block w-full rounded-md border-slate-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm" required>
                    </div>
                    <div>
                        <label for="detail_tugas" class="block text-sm font-medium text-slate-700">Keterangan</label>
                        <textarea id="detail_tugas" name="detail_tugas" rows="3" class="mt-1 block w-full rounded-md border-slate-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm" placeholder="Jelaskan detail tugas di sini..." required></textarea>
                    </div>
                    <div class="flex justify-end gap-4 pt-4">
                        <button type="button" onclick="closeAddModal()" class="bg-slate-200 text-slate-700 font-semibold py-2 px-4 rounded-lg hover:bg-slate-300 transition">
                            Batal
                        </button>
                        <button type="submit" class="bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg shadow-md hover:bg-blue-700 transition">
                            Simpan
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Detail/Edit Tugas -->
    <div id="detail-modal" class="fixed inset-0 bg-black bg-opacity-50 z-50 items-center justify-center p-4 hidden">
        <div class="bg-white rounded-xl shadow-2xl p-8 w-full max-w-md transform transition-all" onclick="event.stopPropagation()">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-2xl font-bold">Detail Tugas</h3>
                <button onclick="closeDetailModal()" class="text-slate-400 hover:text-slate-600">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                </button>
            </div>
            <form id="edit-task-form" action="" method="POST">
                @csrf
                @method('PUT')
                <div class="space-y-4">
                    <div>
                        <label for="edit_nama_tugas" class="block text-sm font-medium text-slate-700">Nama Tugas</label>
                        <input type="text" id="edit_nama_tugas" name="nama_tugas" class="mt-1 block w-full rounded-md border-slate-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm" required>
                    </div>
                    <div>
                        <label for="edit_matkul" class="block text-sm font-medium text-slate-700">Mata Kuliah</label>
                        <input type="text" id="edit_matkul" name="matkul" class="mt-1 block w-full rounded-md border-slate-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm" required>
                    </div>
                    <div>
                        <label for="edit_tenggat" class="block text-sm font-medium text-slate-700">Tenggat</label>
                        <input type="date" id="edit_tenggat" name="tenggat" class="mt-1 block w-full rounded-md border-slate-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm" required>
                    </div>
                    <div>
                        <label for="edit_status" class="block text-sm font-medium text-slate-700">Status</label>
                        <select id="edit_status" name="status" class="mt-1 block w-full rounded-md border-slate-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                            <option value="Open">Open</option>
                            <option value="In Progress">In Progress</option>
                            <option value="Selesai">Selesai</option>
                        </select>
                    </div>
                    <div>
                        <label for="edit_keterangan" class="block text-sm font-medium text-slate-700">Keterangan</label>
                        <textarea id="edit_keterangan" name="keterangan" rows="3" class="mt-1 block w-full rounded-md border-slate-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm" required></textarea>
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
        const addTaskForm = addModal.querySelector('form');

        function openAddModal() {
            addModal.classList.remove('hidden');
            addModal.classList.add('flex');
        }

        function closeAddModal() {
            addModal.classList.remove('flex');
            addModal.classList.add('hidden');
            addTaskForm.reset(); // Reset form ketika modal ditutup
        }

        // --- Fungsi untuk Modal Detail/Edit ---
        const detailModal = document.getElementById('detail-modal');
        const editTaskForm = document.getElementById('edit-task-form');
        const editNamaTugas = document.getElementById('edit_nama_tugas');
        const editMatkul = document.getElementById('edit_matkul');
        const editTenggat = document.getElementById('edit_tenggat');
        const editStatus = document.getElementById('edit_status');
        const editKeterangan = document.getElementById('edit_keterangan');

        function openDetailModal(cardElement) {
            // Mengambil data dari atribut data-* pada kartu yang diklik
            const id = cardElement.getAttribute('data-id');
            const title = cardElement.getAttribute('data-title');
            const status = cardElement.getAttribute('data-status');
            const keterangan = cardElement.getAttribute('data-keterangan');
            const matkul = cardElement.getAttribute('data-matkul');
            const tenggat = cardElement.getAttribute('data-tenggat');

            // Mengisi form di dalam modal dengan data yang didapat
            editNamaTugas.value = title;
            editMatkul.value = matkul;
            editTenggat.value = tenggat;
            editStatus.value = status;
            editKeterangan.value = keterangan;

            // Mengatur action form untuk update
            let updateUrl = "{{ url('tugas') }}/" + id;
            editTaskForm.setAttribute('action', updateUrl);

            detailModal.classList.remove('hidden');
            detailModal.classList.add('flex');
        }

        function closeDetailModal() {
            detailModal.classList.remove('flex');
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