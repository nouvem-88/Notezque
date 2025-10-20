@extends('layouts.sidenav')

@section('content')
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NotezQue - Kalender Aktivitas</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Iconify CDN for the icons -->
    <script src="https://code.iconify.design/iconify-icon/2.1.0/iconify-icon.min.js"></script>
    <style>
        /* Menggunakan font Inter dan memastikan tampilan dasar bagus */
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f3f4f6;
            /* Warna latar belakang abu-abu terang */
        }

        /* Container utama app */
        .app-container {
            display: flex;
            gap: 2rem;
            padding: 2rem;
            max-width: 1400px;
            margin: 0 auto;
            flex-wrap: wrap;
        }

        #main {
            flex: 2;
            min-width: 350px;
        }

        .side-listAcara {
            flex: 1;
            min-width: 350px;
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        /* Styling Modal */
        .modal {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            display: none;
            /* Default hidden */
            align-items: center;
            justify-content: center;
            z-index: 1000;
        }

        .modal-content {
            background-color: white;
            padding: 24px;
            border-radius: 12px;
            box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1);
            max-width: 90%;
            width: 500px;
            animation: slideIn 0.3s ease-out;
        }

        /* Animasi masuk modal */
        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(-20px) scale(0.95);
            }

            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        /* Side Modal Styling (Detail Acara) */
        .side-modal {
            position: fixed;
            top: 0;
            right: 0;
            height: 100%;
            width: 380px;
            max-width: 90vw;
            background-color: #fff;
            box-shadow: -4px 0 10px rgba(0, 0, 0, 0.1);
            transform: translateX(100%);
            transition: transform 0.3s ease-out;
            z-index: 1000;
            display: flex;
            flex-direction: column;
        }

        .side-modal.open {
            transform: translateX(0);
        }

        .side-modal-body {
            flex-grow: 1;
            overflow-y: auto;
            padding: 24px;
        }

        .side-modal-footer {
            padding: 16px 24px;
            border-top: 1px solid #e5e7eb;
            display: flex;
            gap: 1rem;
            justify-content: flex-end;
            /* Posisikan tombol di kanan */
        }

        /* Custom styles for calendar cells */
        .tglBln .tanggal-cell {
            height: 110px;
            /* Fixed height for consistency */
            padding: 4px;
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            overflow: hidden;
            position: relative;
        }

        .tglBln .date-number {
            font-weight: 600;
            margin-bottom: 4px;
            align-self: flex-start;
        }

        .tglBln .hari-ini .date-number {
            background-color: #2563eb;
            color: white;
            border-radius: 9999px;
            width: 24px;
            height: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .events-list-in-cell {
            width: 100%;
            display: flex;
            flex-direction: column;
            gap: 2px;
        }

        .event-marker-in-cell {
            font-size: 0.7rem;
            padding: 1px 4px;
            border-radius: 4px;
            background-color: #e0e7ff;
            color: #4338ca;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            border-left: 3px solid #818cf8;
        }

        .more-events-marker {
            font-size: 0.7rem;
            font-weight: bold;
            color: #1e40af;
            background-color: #bfdbfe;
        }


        /* Responsif */
        @media (max-width: 1024px) {
            .app-container {
                flex-direction: column;
                padding: 1rem;
            }

            #main,
            .side-listAcara {
                min-width: 100%;
            }

            .side-modal {
                width: 100%;
                /* Penuh di mobile */
            }
        }
    </style>
</head>

<body>

    <div class="app-container">

        <!-- Bagian Kiri: Kalender Utama -->
        <main id="main">
            <!-- Tombol Tambah Acara -->
            <div class="">
                <button onclick="openModal('add')"
                    class="w-full flex items-center justify-center gap-2 px-6 py-3 bg-blue-600 text-white font-semibold rounded-lg shadow-md hover:bg-blue-700 transition duration-200">
                    <iconify-icon icon="mdi:plus-circle-outline" class="w-5 h-5"></iconify-icon>
                    Tambah Acara Baru
                </button>
            </div>
            <div class="bg-white p-6 rounded-xl shadow-lg">
                @include('components.calendar')
            </div>
        </main>

        <!-- Bagian Kanan: Daftar Aktivitas dan Filter -->
        <aside class="side-listAcara">
            <div class="bg-white p-6 rounded-xl shadow-lg">
                <h3 class="text-xl font-bold mb-4 text-gray-800">Daftar Aktivitas Bulan Ini</h3>

                <!-- Filter dan Sort -->
                <div class="flex justify-between items-center mb-4 gap-2">
                    <select id="sortFilter"
                        class="flex-grow p-2 border border-gray-300 rounded-lg text-sm focus:ring-blue-500 focus:border-blue-500">
                        <option value="tanggal_asc">Tanggal Terdekat</option>
                        <option value="tanggal_desc">Tanggal Terjauh</option>
                        <option value="judul">Judul (A-Z)</option>
                    </select>
                    <button class="p-2 bg-gray-100 rounded-lg text-gray-600 hover:bg-gray-200 transition"
                        onclick="applyFilter()">
                        <iconify-icon icon="mdi:filter-menu-outline" class="w-5 h-5"></iconify-icon>
                    </button>
                </div>

                <!-- Kontainer Daftar Acara (Scrollable) -->
                <div class="acara-container space-y-3 max-h-[400px] overflow-y-auto pr-2">
                    <!-- Aktivitas akan di-generate oleh JS di sini -->
                </div>
            </div>

            <!-- Paginasi-->
            <div id="pagination-container" class="mt-4">
                <nav class="flex items-center justify-between">
                    <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                        <div>
                            <p class="text-sm text-gray-700">
                                Menampilkan
                                <span class="font-medium">1</span>
                                sampai
                                <span class="font-medium">3</span>
                                dari
                                <span class="font-medium">10</span>
                                hasil
                            </p>
                        </div>

                        <div>
                            <span class="relative z-0 inline-flex shadow-sm rounded-md">
                                <button
                                    class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 cursor-not-allowed">
                                    <iconify-icon icon="mdi:chevron-left" class="w-5 h-5"></iconify-icon>
                                </button>
                                <span
                                    class="relative inline-flex items-center px-4 py-2 -ml-px border border-gray-300 bg-blue-600 text-sm font-medium text-white z-10">1</span>
                                <button
                                    class="relative inline-flex items-center px-4 py-2 -ml-px border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">2</button>
                                <button
                                    class="relative inline-flex items-center px-4 py-2 -ml-px border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">3</button>
                                <button
                                    class="relative inline-flex items-center px-2 py-2 -ml-px rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                                    <iconify-icon icon="mdi:chevron-right" class="w-5 h-5"></iconify-icon>
                                </button>
                            </span>
                        </div>
                    </div>
                </nav>
            </div>
        </aside>
    </div>

    <!-- ==================================================================== -->
    <!-- MODAL TAMBAH/EDIT ACARA -->
    <!-- ==================================================================== -->
    <!-- ==================================================================== -->
    <!-- MODAL TAMBAH/EDIT ACARA -->
    <!-- ==================================================================== -->
    @include('components.event-modal')


    <!-- ==================================================================== -->
    <!-- SIDE MODAL DETAIL ACARA -->


    <!-- ==================================================================== -->
    <!-- SIDE MODAL DETAIL ACARA -->
    <!-- ==================================================================== -->
    <div id="sideModalDetail" class="side-modal">
        <!-- Header -->
        <div class="p-6 border-b flex items-center justify-between bg-blue-50">
            <h3 class="text-xl font-extrabold text-blue-800" id="sideDetailTitle">Detail Acara</h3>
            <button onclick="closeSideModal()" class="p-1 rounded-full hover:bg-gray-100">
                <iconify-icon icon="mdi:close" class="w-6 h-6 text-gray-500"></iconify-icon>
            </button>
        </div>

        <!-- Body Detail -->
        <div class="side-modal-body space-y-6">
            <div class="space-y-1">
                <strong class="text-sm font-semibold text-gray-500 block">JUDUL AKTIVITAS</strong>
                <p id="sideDetailNamaAcara" class="text-2xl font-bold text-gray-800">Judul Acara di Sini</p>
            </div>

            <div class="space-y-1">
                <strong class="text-sm font-semibold text-gray-500 block">DESKRIPSI</strong>
                <p id="sideDetailDesc" class="text-gray-600 leading-relaxed italic">Deskripsi lengkap dari acara. Ini
                    bisa sangat panjang.</p>
            </div>

            <div class="space-y-4 p-4 bg-gray-50 rounded-lg">
                <h4 class="font-bold text-lg text-gray-700 border-b pb-2">Informasi Waktu</h4>
                <div class="flex items-center gap-2 text-gray-700">
                    <strong>
                        <iconify-icon icon="mdi:calendar-range" width="16" height="16"></iconify-icon>
                        Tanggal:
                    </strong>
                    <p id="sideDetailTanggal">19 Januari 2025</p>
                </div>
                <div class="flex items-center gap-2 text-gray-700">
                    <strong>
                        <iconify-icon icon="mdi:clock-outline" width="16" height="16"></iconify-icon>
                        Waktu:
                    </strong>
                    <p id="sideDetailWaktu">10:00 AM</p>
                </div>
            </div>

            <div class="space-y-1">
                <strong class="text-sm font-semibold text-gray-500 block">REMINDER</strong>
                <p id="sideDetailReminder" class="text-gray-600 italic">Reminder disetel 15 menit sebelumnya.</p>
            </div>
        </div>

        <!-- Footer Tombol Aksi -->
        <div class="side-modal-footer">
            <button id="editSideAcaraBtn"
                class="flex items-center gap-1.5 px-4 py-2 bg-yellow-500 text-white font-medium rounded-lg hover:bg-yellow-600 transition duration-150"
                onclick="event.stopPropagation(); openModal('edit', '${event.id}')">
                <iconify-icon icon="mdi:pencil" width="18" height="18"></iconify-icon>
                Edit
            </button>
            <button id="hapusSideAcaraBtn"
                class="flex items-center gap-1.5 px-4 py-2 bg-red-600 text-white font-medium rounded-lg hover:bg-red-700 transition duration-150"
                onclick="event.stopPropagation(); confirmDelete(idAktivitasYangDihapus )">
                <iconify-icon icon="mdi:trash-can-outline" width="18" height="18"></iconify-icon>
                Hapus
            </button>
        </div>
    </div>

    <!-- ==================================================================== -->
    <!-- CUSTOM CONFIRMATION MODAL (Menggantikan window.confirm/alert) -->
    <!-- ==================================================================== -->
    @include('components.confirm-delete-modal')
    <script>
        /**
         * ===============================================
         * SISTEM KALENDER AKTIVITAS & MOCK CRUD LOGIC
         * Berdasarkan 6kalender.js
         * ===============================================
         */

        // ==================== VARIABEL GLOBAL ====================
        var tanggalHariIni = new Date();
        // Gunakan tanggal saat ini sebagai default
        var bulanSekarang = tanggalHariIni.getMonth(); // 0-11
        var tahunSekarang = tanggalHariIni.getFullYear();
        var idAktivitasYangDiedit = null; // Untuk CRUD
        var idAktivitasYangDihapus = null; // Untuk konfirmasi hapus

        // Variabel untuk Pagination
        var currentPage = 1;
        var itemsPerPage = 3; // Jumlah item per halaman

        // Contoh data aktivitas (Mock data, bukan dari database)
        var daftarAktivitas = [
            { id: '1', title: 'Presentasi Tugas Akhir', desk: 'Presentasi bab 1-3 di depan dosen pembimbing.', date: '2025-10-25', time: '14:00', reminder: '1h', status: 'upcoming' },
            { id: '2', title: 'Rapat Organisasi Kampus', desk: 'Diskusi persiapan acara tahunan.', date: '2025-10-18', time: '18:30', reminder: '15m', status: 'done' },
            { id: '3', title: 'Deadline Proyek Basis Data', desk: 'Kumpulkan laporan proyek via email.', date: '2025-11-05', time: '23:59', reminder: 'custom', customTime: '2025-11-04T20:00', status: 'upcoming' },
            { id: '4', title: 'Bimbingan Skripsi', desk: 'Bertemu Bu Dosen untuk revisi bab 4.', date: '2025-10-18', time: '09:00', reminder: 'none', status: 'upcoming' },
            { id: '5', title: 'Acara Kampus', desk: 'Festival seni dan budaya.', date: '2025-10-25', time: '10:00', reminder: 'none', status: 'upcoming' },
            { id: '6', title: 'Lomba Coding', desk: 'Kompetisi pemrograman tingkat nasional.', date: '2025-10-25', time: '08:00', reminder: 'none', status: 'upcoming' },
            { id: '7', title: 'Rapat Final Project', desk: 'Finalisasi proyek NotezQue.', date: '2025-10-25', time: '19:00', reminder: 'none', status: 'upcoming' },
        ];

        // Nama-nama bulan dan hari dalam bahasa Indonesia
        var namaBulan = [
            "Januari", "Februari", "Maret", "April", "Mei", "Juni",
            "Juli", "Agustus", "September", "Oktober", "November", "Desember"
        ];
        var namaHari = ['Min', 'Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab'];

        // Elemen HTML
        var tempatTanggal, judulBulanTahun, containerAktivitas, eventModal, sideModalDetail, confirmModal;

        // ==================== INISIALISASI ====================
        function ambilElemenHTML() {
            tempatTanggal = document.querySelector('.tglBln');
            judulBulanTahun = document.querySelector('.bln-thn');
            containerAktivitas = document.querySelector('.acara-container');
            eventModal = document.getElementById('eventModal');
            sideModalDetail = document.getElementById('sideModalDetail');
            confirmModal = document.getElementById('confirmModal');
        }

        // ==================== FUNGSI UTILITAS ====================
        function formatTanggalTampilan(dateString, timeString = '') {
            try {
                const [year, month, day] = dateString.split('-');
                const date = new Date(year, month - 1, day);
                const namaBulanIndo = namaBulan[date.getMonth()];
                const tanggal = date.getDate();
                const tahun = date.getFullYear();

                let result = `${tanggal} ${namaBulanIndo} ${tahun}`;
                if (timeString) {
                    result += ` pukul ${timeString.substring(0, 5)}`;
                }
                return result;
            } catch (e) {
                return dateString;
            }
        }

        function findEventById(id) {
            return daftarAktivitas.find(e => e.id === id);
        }

        function generateId() {
            return 'temp-' + Date.now();
        }

        // ==================== FUNGSI KALENDER (UPDATE DARI 6KALENDER.JS) ====================

        function tampilkanKalender() {
            if (!tempatTanggal || !judulBulanTahun) return;

            tempatTanggal.innerHTML = '';
            judulBulanTahun.textContent = namaBulan[bulanSekarang] + ' ' + tahunSekarang;

            var tglPertama = new Date(tahunSekarang, bulanSekarang, 1);
            var jmlHariBulanIni = new Date(tahunSekarang, bulanSekarang + 1, 0).getDate();
            var hariPertamaIndex = tglPertama.getDay(); // 0=Minggu, 6=Sabtu
            var jmlHariBulanLalu = new Date(tahunSekarang, bulanSekarang, 0).getDate();

            // Hitung Acara per hari untuk bulan ini
            const eventsPerDay = {};
            daftarAktivitas.forEach(event => {
                const dateObj = new Date(event.date);
                if (dateObj.getMonth() === bulanSekarang && dateObj.getFullYear() === tahunSekarang) {
                    const dayOfMonth = dateObj.getDate();
                    if (!eventsPerDay[dayOfMonth]) {
                        eventsPerDay[dayOfMonth] = [];
                    }
                    eventsPerDay[dayOfMonth].push(event);
                }
            });

            const totalCells = 42; // 6 minggu * 7 hari = 42 sel untuk tinggi konsisten
            let tglCounter = 1;
            let tglBulanBerikutnya = 1;

            for (let i = 0; i < totalCells; i++) {
                const divTanggal = document.createElement('div');
                divTanggal.classList.add('tanggal-cell', 'border', 'border-gray-200');

                // 1. Tanggal bulan lalu
                if (i < hariPertamaIndex) {
                    const tgl = jmlHariBulanLalu - hariPertamaIndex + i + 1;
                    divTanggal.innerHTML = `<span class="date-number text-gray-400">${tgl}</span>`;
                    divTanggal.classList.add('bg-gray-50');
                }
                // 2. Tanggal bulan ini
                else if (tglCounter <= jmlHariBulanIni) {
                    divTanggal.innerHTML = `<span class="date-number">${tglCounter}</span>`;
                    const dateClicked = `${tahunSekarang}-${String(bulanSekarang + 1).padStart(2, '0')}-${String(tglCounter).padStart(2, '0')}`;
                    divTanggal.onclick = () => openModal('add', dateClicked);
                    divTanggal.classList.add('cursor-pointer', 'hover:bg-blue-50');

                    // Cek hari ini
                    const hariIni = new Date();
                    if (tglCounter === hariIni.getDate() && bulanSekarang === hariIni.getMonth() && tahunSekarang === hariIni.getFullYear()) {
                        divTanggal.querySelector('.date-number').classList.add('hari-ini');
                    }

                    // Tampilkan acara
                    if (eventsPerDay[tglCounter] && eventsPerDay[tglCounter].length > 0) {
                        const events = eventsPerDay[tglCounter];
                        const eventsContainer = document.createElement('div');
                        eventsContainer.className = 'events-list-in-cell';

                        // Tampilkan maks 3 acara
                        events.slice(0, 3).forEach(evt => {
                            const eventMarker = document.createElement('div');
                            eventMarker.className = 'event-marker-in-cell';
                            eventMarker.textContent = evt.title;
                            eventMarker.title = evt.title;
                            eventsContainer.appendChild(eventMarker);
                        });

                        // Jika lebih dari 3, tampilkan "+X lagi"
                        if (events.length > 3) {
                            const moreMarker = document.createElement('div');
                            moreMarker.className = 'event-marker-in-cell more-events-marker';
                            moreMarker.textContent = `+${events.length - 3} lagi`;
                            eventsContainer.appendChild(moreMarker);
                        }

                        divTanggal.appendChild(eventsContainer);
                        divTanggal.onclick = () => openSideModalDetail(events[0].id); // Klik tanggal buka detail acara pertama
                    }

                    tglCounter++;
                }
                // 3. Tanggal bulan berikutnya
                else {
                    divTanggal.innerHTML = `<span class="date-number text-gray-400">${tglBulanBerikutnya}</span>`;
                    divTanggal.classList.add('bg-gray-50');
                    tglBulanBerikutnya++;
                }

                tempatTanggal.appendChild(divTanggal);
            }
        }


        function tampilkanDaftarAktivitas() {
            if (!containerAktivitas) return;

            // Filter aktivitas untuk bulan dan tahun yang sedang dilihat
            const filteredList = daftarAktivitas.filter(event => {
                const dateObj = new Date(event.date);
                return dateObj.getMonth() === bulanSekarang && dateObj.getFullYear() === tahunSekarang;
            });

            // Terapkan sort
            const sortValue = document.getElementById('sortFilter').value;
            filteredList.sort((a, b) => {
                if (sortValue === 'judul') {
                    return a.title.localeCompare(b.title);
                }
                const dateA = new Date(a.date + ' ' + (a.time || '00:00'));
                const dateB = new Date(b.date + ' ' + (b.time || '00:00'));
                return sortValue === 'tanggal_asc' ? dateA - dateB : dateB - dateA;
            });

            // Kalkulasi Paginasi
            const totalItems = filteredList.length;
            const totalPages = Math.ceil(totalItems / itemsPerPage);
            if (currentPage > totalPages && totalPages > 0) {
                currentPage = totalPages;
            } else if (totalPages === 0) {
                currentPage = 1;
            }
            const startIndex = (currentPage - 1) * itemsPerPage;
            const endIndex = startIndex + itemsPerPage;
            const paginatedItems = filteredList.slice(startIndex, endIndex);


            containerAktivitas.innerHTML = '';

            if (paginatedItems.length === 0) {
                containerAktivitas.innerHTML = `
                    <div class="text-center p-6 text-gray-500 italic bg-gray-50 rounded-lg">
                        Tidak ada aktivitas terjadwal bulan ini.
                    </div>
                `;
            } else {
                paginatedItems.forEach(event => {
                    const timeDisplay = event.time ? event.time.substring(0, 5) : 'Sepanjang Hari';

                    const item = document.createElement('div');
                    item.classList.add(
                        'bg-white', 'p-4', 'rounded-lg', 'shadow-md', 'border-l-4', 'cursor-pointer',
                        'hover:shadow-lg', 'transition', 'duration-200', 'flex', 'justify-between', 'items-start', 'gap-2'
                    );

                    const borderColor = event.status === 'done' ? 'border-gray-400' : 'border-blue-500';
                    item.classList.add(borderColor);

                    item.innerHTML = `
                        <div class="flex-grow" onclick="openSideModalDetail('${event.id}')">
                            <p class="text-xs font-semibold text-gray-500">${formatTanggalTampilan(event.date)}</p>
                            <h4 class="text-lg font-bold text-gray-800 truncate">${event.title}</h4>
                            <p class="text-sm text-gray-600">${timeDisplay}</p>
                        </div>
                        <div class="flex items-center gap-2">
                            <button class="text-blue-500 hover:text-blue-700 p-1 rounded-full hover:bg-blue-50" title="Edit" onclick="event.stopPropagation(); openModal('edit', '${event.id}')">
                                <iconify-icon icon="mdi:pencil" class="w-5 h-5"></iconify-icon>
                            </button>
                            <button class="text-red-500 hover:text-red-700 p-1 rounded-full hover:bg-red-50" title="Hapus" onclick="event.stopPropagation(); confirmDelete('${event.id}')">
                                <iconify-icon icon="mdi:trash-can-outline" class="w-5 h-5"></iconify-icon>
                            </button>
                        </div>
                    `;
                    containerAktivitas.appendChild(item);
                });
            }
            // Render Paginasi
            renderPagination(totalPages, totalItems, startIndex);
        }

        function renderPagination(totalPages, totalItems, startIndex) {
            const paginationContainer = document.getElementById('pagination-container');
            if (!paginationContainer) return;

            if (totalPages <= 1) {
                paginationContainer.innerHTML = '';
                return;
            }

            let paginationHTML = `
                <nav class="flex items-center justify-between">
                    <div class="flex-1 flex justify-between sm:hidden">
                        <button onclick="changePage(${currentPage - 1})" class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 ${currentPage === 1 ? 'cursor-not-allowed opacity-50' : ''}">
                            Sebelumnya
                        </button>
                        <button onclick="changePage(${currentPage + 1})" class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 ${currentPage === totalPages ? 'cursor-not-allowed opacity-50' : ''}">
                            Selanjutnya
                        </button>
                    </div>
                    <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                        <div>
                            <p class="text-sm text-gray-700">
                                Menampilkan
                                <span class="font-medium">${startIndex + 1}</span>
                                sampai
                                <span class="font-medium">${Math.min(startIndex + itemsPerPage, totalItems)}</span>
                                dari
                                <span class="font-medium">${totalItems}</span>
                                hasil
                            </p>
                        </div>
                        <div>
                            <span class="relative z-0 inline-flex shadow-sm rounded-md">
                                <button onclick="changePage(${currentPage - 1})" class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50 ${currentPage === 1 ? 'cursor-not-allowed opacity-50' : ''}">
                                    <iconify-icon icon="mdi:chevron-left" class="w-5 h-5"></iconify-icon>
                                </button>`;

            for (let i = 1; i <= totalPages; i++) {
                paginationHTML += `<button onclick="changePage(${i})" class="relative inline-flex items-center px-4 py-2 -ml-px border border-gray-300 text-sm font-medium ${i === currentPage ? 'bg-blue-600 text-white z-10' : 'bg-white text-gray-700 hover:bg-gray-50'}">${i}</button>`;
            }

            paginationHTML += `
                                <button onclick="changePage(${currentPage + 1})" class="relative inline-flex items-center px-2 py-2 -ml-px rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50 ${currentPage === totalPages ? 'cursor-not-allowed opacity-50' : ''}">
                                    <iconify-icon icon="mdi:chevron-right" class="w-5 h-5"></iconify-icon>
                                </button>
                            </span>
                        </div>
                    </div>
                </nav>`;

            paginationContainer.innerHTML = paginationHTML;
        }

        function changePage(page) {
            const filteredList = daftarAktivitas.filter(event => {
                const dateObj = new Date(event.date);
                return dateObj.getMonth() === bulanSekarang && dateObj.getFullYear() === tahunSekarang;
            });
            const totalPages = Math.ceil(filteredList.length / itemsPerPage);

            if (page < 1 || page > totalPages) {
                return; // Jangan lakukan apa-apa jika halaman di luar jangkauan
            }
            currentPage = page;
            tampilkanDaftarAktivitas();
        }

        // ==================== NAVIGASI BULAN ====================
        window.prevMonth = function () {
            bulanSekarang--;
            if (bulanSekarang < 0) {
                bulanSekarang = 11;
                tahunSekarang--;
            }
            tampilkanKalender();
            tampilkanDaftarAktivitas();
        }

        window.nextMonth = function () {
            bulanSekarang++;
            if (bulanSekarang > 11) {
                bulanSekarang = 0;
                tahunSekarang++;
            }
            tampilkanKalender();
            tampilkanDaftarAktivitas();
        }

        // ==================== FILTER/SORT ====================
        window.applyFilter = function () {
            // Hanya perlu memanggil ulang fungsi tampilkanDaftarAktivitas karena logika sorting ada di dalamnya
            tampilkanDaftarAktivitas();
            console.log('Filter diterapkan:', document.getElementById('sortFilter').value);
        }

        // ==================== FUNGSI MODAL TAMBAH/EDIT ====================

        window.openModal = function (mode, eventIdOrDate) {
            idAktivitasYangDiedit = null;
            const form = document.getElementById('eventForm');
            form.reset();
            document.getElementById('reminderOptions').classList.add('hidden');
            document.getElementById('customReminderGroup').classList.add('hidden');

            if (mode === 'add') {
                document.getElementById('modalTitle').textContent = 'Tambah Acara Baru';
                // Pre-fill tanggal jika dipanggil dari klik tanggal di kalender
                if (eventIdOrDate && typeof eventIdOrDate === 'string' && eventIdOrDate.match(/^\d{4}-\d{2}-\d{2}$/)) {
                    document.getElementById('tanggal').value = eventIdOrDate;
                }
            } else if (mode === 'edit' && eventIdOrDate) {
                document.getElementById('modalTitle').textContent = 'Edit Acara';
                idAktivitasYangDiedit = eventIdOrDate;
                const event = findEventById(eventIdOrDate);

                if (event) {
                    document.getElementById('title').value = event.title;
                    document.getElementById('desk').value = event.desk;
                    document.getElementById('tanggal').value = event.date;
                    document.getElementById('waktu').value = event.time || '';

                    // Setup Reminder untuk Edit
                    document.getElementById('reminder_enabled').checked = event.reminder !== 'none';
                    toggleReminderOptions();

                    document.getElementById('reminder_template').value = event.reminder in ['15m', '1h', 'custom'] ? event.reminder : 'custom';
                    toggleCustomReminder();

                    if (event.reminder === 'custom' && event.customTime) {
                        document.getElementById('custom_reminder_time').value = event.customTime.substring(0, 16); // YYYY-MM-DDTHH:MM
                    }
                }
            }
            eventModal.style.display = 'flex';
        }

        window.closeModal = function () {
            eventModal.style.display = 'none';
            idAktivitasYangDiedit = null;
        }

        window.toggleReminderOptions = function () {
            const enabled = document.getElementById('reminder_enabled').checked;
            const optionsDiv = document.getElementById('reminderOptions');
            if (enabled) {
                optionsDiv.classList.remove('hidden');
            } else {
                optionsDiv.classList.add('hidden');
                document.getElementById('reminder_template').value = 'none';
                toggleCustomReminder();
            }
        }

        window.toggleCustomReminder = function () {
            const template = document.getElementById('reminder_template').value;
            const customDiv = document.getElementById('customReminderGroup');
            if (template === 'custom') {
                customDiv.classList.remove('hidden');
            } else {
                customDiv.classList.add('hidden');
            }
        }

        // ==================== FUNGSI CRUD (MOCKING) ====================

        window.saveEvent = function (e) {
            e.preventDefault();

            const isEdit = idAktivitasYangDiedit !== null;

            const newEvent = {
                id: isEdit ? idAktivitasYangDiedit : generateId(),
                title: document.getElementById('title').value,
                desk: document.getElementById('desk').value,
                date: document.getElementById('tanggal').value,
                time: document.getElementById('waktu').value,
                reminder: document.getElementById('reminder_enabled').checked ? document.getElementById('reminder_template').value : 'none',
                customTime: document.getElementById('reminder_enabled').checked && document.getElementById('reminder_template').value === 'custom' ? document.getElementById('custom_reminder_time').value + ':00' : null,
                status: 'upcoming'
            };

            if (isEdit) {
                // Logika Edit (Update)
                const index = daftarAktivitas.findIndex(event => event.id === newEvent.id);
                if (index !== -1) {
                    daftarAktivitas[index] = newEvent;
                    console.log(`[CRUD Mock] Acara ID ${newEvent.id} berhasil diubah.`);
                }
            } else {
                // Logika Tambah (Create)
                daftarAktivitas.push(newEvent);
                console.log(`[CRUD Mock] Acara ID ${newEvent.id} berhasil ditambahkan.`);
            }

            closeModal();
            tampilkanKalender();
            tampilkanDaftarAktivitas();
        }

        // ==================== FUNGSI SIDE DETAIL ====================
        window.openSideModalDetail = function (id) {
            const event = findEventById(id);
            if (!event) return;

            idAktivitasYangDiedit = id; // Set ID yang sedang dilihat/diedit

            document.getElementById('sideDetailNamaAcara').textContent = event.title;
            document.getElementById('sideDetailDesc').textContent = event.desk || 'Tidak ada deskripsi.';
            document.getElementById('sideDetailTanggal').textContent = formatTanggalTampilan(event.date);
            document.getElementById('sideDetailWaktu').textContent = event.time ? event.time.substring(0, 5) : 'Sepanjang Hari';
            document.getElementById('sideDetailReminder').textContent = getReminderText(event);

            sideModalDetail.classList.add('open');
        }

        window.closeSideModal = function () {
            sideModalDetail.classList.remove('open');
            idAktivitasYangDiedit = null;
        }

        window.showFirstEventDetail = function (id) {
            // Fungsi yang dipanggil dari klik tanggal di kalender
            openSideModalDetail(id);
        }

        window.getReminderText = function (event) {
            if (event.reminder === 'none' || !event.reminder) return 'Reminder tidak disetel.';

            switch (event.reminder) {
                case '15m': return '15 Menit Sebelum Acara';
                case '1h': return '1 Jam Sebelum Acara';
                case 'custom':
                    const date = event.customTime ? new Date(event.customTime) : null;
                    if (date && !isNaN(date)) {
                        return `Waktu Kustom: ${formatTanggalTampilan(event.customTime.substring(0, 10), event.customTime.substring(11, 16))}`;
                    }
                    return 'Waktu Kustom Disetel';
                default: return 'Reminder Aktif';
            }
        }

        // ==================== FUNGSI CRUD DARI SIDE DETAIL ====================

        window.editFromSide = function () {
            closeSideModal();
            openModal('edit', idAktivitasYangDiedit);
        }

        window.deleteFromSide = function () {
            confirmDelete(idAktivitasYangDihapus);
        }

        // ==================== FUNGSI KONFIRMASI HAPUS ====================

        window.confirmDelete = function (id) {
            const event = findEventById(id);
            if (!event) return;

            idAktivitasYangDihapus = id;
            document.getElementById('confirmMessage').innerHTML = `Anda yakin ingin menghapus acara: <strong>"${event.title}"</strong> secara permanen?`;

            // Atur action untuk tombol konfirmasi
            document.getElementById('confirmActionBtn').onclick = function () {
                executeDelete(idAktivitasYangDihapus);
            };

            confirmModal.style.display = 'flex';
            closeSideModal(); // Tutup side modal jika terbuka
        }

        window.cancelConfirmation = function () {
            confirmModal.style.display = 'none';
            idAktivitasYangDihapus = null;
        }

        window.executeDelete = function (id) {
            // Logika Hapus (Delete)
            daftarAktivitas = daftarAktivitas.filter(event => event.id !== id);
            console.log(`[CRUD Mock] Acara ID ${id} berhasil dihapus.`);

            confirmModal.style.display = 'none';
            idAktivitasYangDiedit = null;

            tampilkanKalender();
            tampilkanDaftarAktivitas();
        }

        // ==================== DOCUMENT READY ====================
        document.addEventListener('DOMContentLoaded', function () {
            ambilElemenHTML();
            tampilkanKalender();
            tampilkanDaftarAktivitas(); // Tampilkan list awal

            // Tutup modal jika klik di luar
            window.onclick = function (event) {
                if (event.target == eventModal) {
                    closeModal();
                }
                if (event.target == confirmModal) {
                    cancelConfirmation();
                }
            }

            console.log("Sistem Kalender NotezQue siap. Mock CRUD aktif.");
        });
    </script>
</body>

</html>

@endsection