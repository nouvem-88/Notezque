@extends('layouts.sidenav')

@section('title', 'Kalender')

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
        <!-- Alpine.js CDN for interactive components -->
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
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
                    <!-- Kalender Header dengan Navigasi -->
                    <div class="flex justify-between items-center mb-4">
                        <button onclick="bulanSebelumnya()" class="p-2 rounded-lg hover:bg-gray-100 transition">
                            <iconify-icon icon="mdi:chevron-left" class="w-6 h-6 text-gray-700"></iconify-icon>
                        </button>
                        <h2 class="text-xl font-bold bln-thn text-gray-800"></h2>
                        <button onclick="bulanBerikutnya()" class="p-2 rounded-lg hover:bg-gray-100 transition">
                            <iconify-icon icon="mdi:chevron-right" class="w-6 h-6 text-gray-700"></iconify-icon>
                        </button>
                    </div>

                    <!-- Hari dalam Seminggu -->
                    <div class="grid grid-cols-7 gap-1 text-center font-semibold text-sm text-gray-600 mb-2">
                        <div>Min</div>
                        <div>Sen</div>
                        <div>Sel</div>
                        <div>Rab</div>
                        <div>Kam</div>
                        <div>Jum</div>
                        <div>Sab</div>
                    </div>

                    <!-- Grid Tanggal Kalender -->
                    <div class="grid grid-cols-7 gap-1 tglBln">
                        <!-- Tanggal akan di-generate oleh JavaScript -->
                    </div>
                </div>
            </main>

            <!-- Bagian Kanan: Daftar Aktivitas dan Filter -->
            <aside class="side-listAcara">
                <div class="bg-white p-6 rounded-xl shadow-lg">
                <h3 class="text-xl font-bold mb-4 text-gray-800">Daftar Aktivitas Bulan Ini</h3>

                <!-- Filter dan Sort -->
                <div class="flex justify-between items-center mb-4 gap-2">
                    <select id="sortFilter" onchange="applySortFilter()"
                        class="flex-grow p-2 border border-gray-300 rounded-lg text-sm focus:ring-blue-500 focus:border-blue-500">
                        <option value="date_asc" {{ request('sort') == 'date_asc' ? 'selected' : '' }}>Tanggal Terdekat</option>
                        <option value="date_desc" {{ request('sort') == 'date_desc' ? 'selected' : '' }}>Tanggal Terjauh</option>
                        <option value="title_asc" {{ request('sort') == 'title_asc' ? 'selected' : '' }}>Judul (A-Z)</option>
                        <option value="title_desc" {{ request('sort') == 'title_desc' ? 'selected' : '' }}>Judul (Z-A)</option>
                    </select>
                    <button class="p-2 bg-blue-100 rounded-lg text-blue-600 hover:bg-blue-200 transition" onclick="resetFilter()" title="Reset Filter">
                        <iconify-icon icon="mdi:refresh"></iconify-icon>
                    </button>
                </div>

                    <!-- Kontainer Daftar Acara (Scrollable) -->
                    <div class="space-y-3 max-h-[400px] overflow-y-auto pr-2" id="activity-list-container">
                            <x-event-card 
                                :activities="$aktivitasBulanIni ?? []"
                                :showActions="true"
                                :showPagination="true"
                                :itemsPerPage="3"
                            />
                    </div>
                </div>
            </aside>
        </div>

 
        <!-- MODAL TAMBAH/EDIT ACARA -->
        @include('components.event-modal')



        <!-- SIDE MODAL DETAIL ACARA -->
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
                    onclick="editFromSide()">
                    <iconify-icon icon="mdi:pencil" width="18" height="18"></iconify-icon>
                    Edit
                </button>
                <button id="hapusSideAcaraBtn"
                    class="flex items-center gap-1.5 px-4 py-2 bg-red-600 text-white font-medium rounded-lg hover:bg-red-700 transition duration-150"
                    onclick="deleteFromSide()">
                    <iconify-icon icon="mdi:trash-can-outline" width="18" height="18"></iconify-icon>
                    Hapus
                </button>
            </div>
        </div>
        
        <!-- CUSTOM CONFIRMATION MODAL (Menggantikan window.confirm/alert) -->
        @include('components.confirm-delete-modal')
        <script>
            /**
             * ===============================================
             * SISTEM KALENDER AKTIVITAS UTAMA
             * ===============================================
             */

            // ==================== VARIABEL GLOBAL ====================
            let tanggalHariIni = new Date();
            let bulanSekarang = tanggalHariIni.getMonth(); // 0-11
            let tahunSekarang = tanggalHariIni.getFullYear();
            let idAktivitasYangDilihat = null; // Untuk side modal detail

            // Data utama aplikasi, diisi oleh data dari controller
            let daftarAktivitas = JSON.parse('{!! $daftarAktivitasJson !!}');

            // Nama-nama bulan dalam bahasa Indonesia
            const namaBulan = [
                "Januari", "Februari", "Maret", "April", "Mei", "Juni",
                "Juli", "Agustus", "September", "Oktober", "November", "Desember"
            ];

            // Elemen HTML yang di-cache
            let tempatTanggal, judulBulanTahun, sideModalDetail;

            // ==================== INISIALISASI ====================
            function ambilElemenHTML() {
                tempatTanggal = document.querySelector('.tglBln');
                judulBulanTahun = document.querySelector('.bln-thn');
                sideModalDetail = document.getElementById('sideModalDetail');
            }

            // ==================== FUNGSI UTILITAS (GLOBAL) ====================
            function formatTanggalTampilan(dateString, timeString = '') {
                if (!dateString) return 'Tanggal tidak valid';
                try {
                    const [year, month, day] = dateString.split('-');
                    const date = new Date(year, month - 1, day);
                    if (isNaN(date)) return 'Tanggal tidak valid';

                    const namaBulanIndo = namaBulan[date.getMonth()];
                    const tanggal = date.getDate();
                    const tahun = date.getFullYear();

                    let result = `${tanggal} ${namaBulanIndo} ${tahun}`;
                    if (timeString) {
                        result += ` pukul ${timeString.substring(0, 5)}`;
                    }
                    return result;
                } catch (e) {
                    console.error("Error formatting date:", dateString, e);
                    return dateString; // Fallback
                }
            }

            // Dibuat global agar bisa diakses dari komponen modal
            window.findEventById = function(id) {
                return daftarAktivitas.find(e => e.id == id);
            }

            // ==================== FUNGSI RENDER UTAMA ====================
            function tampilkanKalender() {
                if (!tempatTanggal || !judulBulanTahun) return;

                tempatTanggal.innerHTML = '';
                judulBulanTahun.textContent = namaBulan[bulanSekarang] + ' ' + tahunSekarang;

                let tglPertama = new Date(tahunSekarang, bulanSekarang, 1);
                let jmlHariBulanIni = new Date(tahunSekarang, bulanSekarang + 1, 0).getDate();
                let hariPertamaIndex = tglPertama.getDay(); // 0=Minggu, 6=Sabtu
                let jmlHariBulanLalu = new Date(tahunSekarang, bulanSekarang, 0).getDate();

                // Kelompokkan acara per hari
                const eventsPerDay = {};
                daftarAktivitas.forEach(event => {
                    const dateObj = new Date(event.date);
                    if (dateObj.getMonth() === bulanSekarang && dateObj.getFullYear() === tahunSekarang) {
                        const dayOfMonth = dateObj.getDate();
                        if (!eventsPerDay[dayOfMonth]) eventsPerDay[dayOfMonth] = [];
                        eventsPerDay[dayOfMonth].push(event);
                    }
                });

                const totalCells = 42;
                let tglCounter = 1;
                let tglBulanBerikutnya = 1;

                for (let i = 0; i < totalCells; i++) {
                    const divTanggal = document.createElement('div');
                    divTanggal.classList.add('tanggal-cell', 'border', 'border-gray-200');

                    if (i < hariPertamaIndex) {
                        const tgl = jmlHariBulanLalu - hariPertamaIndex + i + 1;
                        divTanggal.innerHTML = `<span class="date-number text-gray-400">${tgl}</span>`;
                        divTanggal.classList.add('bg-gray-50');
                    } else if (tglCounter <= jmlHariBulanIni) {
                        const dateString = `${tahunSekarang}-${String(bulanSekarang + 1).padStart(2, '0')}-${String(tglCounter).padStart(2, '0')}`;
                        divTanggal.innerHTML = `<span class="date-number">${tglCounter}</span>`;
                        divTanggal.classList.add('cursor-pointer', 'hover:bg-blue-50');

                        const hariIni = new Date();
                        if (tglCounter === hariIni.getDate() && bulanSekarang === hariIni.getMonth() && tahunSekarang === hariIni.getFullYear()) {
                            divTanggal.querySelector('.date-number').classList.add('bg-blue-600', 'text-white', 'rounded-full', 'w-6', 'h-6', 'flex', 'items-center', 'justify-center');
                        }

                        const events = eventsPerDay[tglCounter];
                        if (events && events.length > 0) {
                            const eventsContainer = document.createElement('div');
                            eventsContainer.className = 'events-list-in-cell';
                            events.slice(0, 3).forEach(evt => {
                                const eventMarker = document.createElement('div');
                                eventMarker.className = 'event-marker-in-cell';
                                eventMarker.textContent = evt.title;
                                eventMarker.onclick = (e) => { e.stopPropagation(); openSideModalDetail(evt.id); };
                                eventsContainer.appendChild(eventMarker);
                            });

                            if (events.length > 3) {
                                const moreMarker = document.createElement('div');
                                moreMarker.className = 'more-events-marker';
                                moreMarker.textContent = `+${events.length - 3} lagi`;
                                eventsContainer.appendChild(moreMarker);
                            }
                            divTanggal.appendChild(eventsContainer);
                            divTanggal.onclick = () => openSideModalDetail(events[0].id);
                        } else {
                            divTanggal.onclick = () => window.openModal('add', dateString);
                        }
                        tglCounter++;
                    } else {
                        divTanggal.innerHTML = `<span class="date-number text-gray-400">${tglBulanBerikutnya}</span>`;
                        divTanggal.classList.add('bg-gray-50');
                        tglBulanBerikutnya++;
                    }
                    tempatTanggal.appendChild(divTanggal);
                }
            }



            // ==================== FUNGSI SIDE DETAIL ====================
            window.openSideModalDetail = function(id) {
                const event = findEventById(id);
                if (!event) return;

                idAktivitasYangDilihat = id;
                document.getElementById('sideDetailNamaAcara').textContent = event.title;
                document.getElementById('sideDetailDesc').textContent = event.desk || 'Tidak ada deskripsi.';
                document.getElementById('sideDetailTanggal').textContent = formatTanggalTampilan(event.date);
                document.getElementById('sideDetailWaktu').textContent = event.time ? event.time.substring(0, 5) : 'Sepanjang Hari';
                document.getElementById('sideDetailReminder').textContent = getReminderText(event);
                sideModalDetail.classList.add('open');
            }

            window.closeSideModal = function() {
                sideModalDetail.classList.remove('open');
                idAktivitasYangDilihat = null;
            }

            window.getReminderText = function(event) {
                if (event.reminder === 'none' || !event.reminder) return 'Reminder tidak disetel.';
                switch (event.reminder) {
                    case '15m': return '15 Menit Sebelum Acara';
                    case '1h': return '1 Jam Sebelum Acara';
                    case 'custom':
                        return event.customTime ? `Kustom: ${formatTanggalTampilan(event.customTime.substring(0, 10), event.customTime.substring(11, 16))}` : 'Waktu Kustom Disetel';
                    default: return 'Reminder Aktif';
                }
            }

            // ==================== AKSI DARI SIDE DETAIL ====================
            window.editFromSide = function() {
                if (!idAktivitasYangDilihat) return;
                window.openModal('edit', idAktivitasYangDilihat);
                closeSideModal();
            }

            window.deleteFromSide = function() {
                if (!idAktivitasYangDilihat) return;
                window.confirmDelete(idAktivitasYangDilihat);
                closeSideModal();
            }

            // ==================== FILTER & SORT ====================
            window.applySortFilter = function() {
                const sortValue = document.getElementById('sortFilter').value;
                const currentUrl = new URL(window.location.href);
                currentUrl.searchParams.set('sort', sortValue);
                currentUrl.searchParams.set('page', '1'); // Reset ke halaman 1
                window.location.href = currentUrl.toString();
            }

            window.resetFilter = function() {
                const currentUrl = new URL(window.location.href);
                currentUrl.searchParams.delete('sort');
                currentUrl.searchParams.delete('page');
                window.location.href = currentUrl.toString();
            }

            // ==================== DOCUMENT READY ====================
            document.addEventListener('DOMContentLoaded', function() {
                ambilElemenHTML();
                // Langsung render dari data yang sudah ada
                tampilkanKalender();
                console.log("Sistem Kalender NotezQue siap.");

                // Tampilkan notifikasi jika ada
                @if (Session::has('status_message'))
                    // Anda bisa menggunakan library notifikasi yang lebih canggih di sini
                    alert("{{ Session::get('status_message') }}");
                @endif
            });
        </script>
    </body>

    </html>

@endsection