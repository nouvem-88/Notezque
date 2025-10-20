@props ([
    'hcell' => null,
    'activities' => []
])

@php
    $cellHeight = $hcell ?? config('components.calendar.cell_height', '90px');
    $calendarDays = config('components.calendar.days', ['Min', 'Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab']);
@endphp

<style>
    /* Custom styles for calendar cells */
    .calendar-component .tglBln .tanggal-cell {
        height: {{ $cellHeight }};
        /* Adjusted for mini-calendar */
        padding: 4px;
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        overflow: hidden;
        position: relative;
        font-size: 0.8rem;
    }

    .calendar-component .tglBln .date-number {
        font-weight: 600;
        margin-bottom: 4px;
        align-self: center;
        /* Center the number */
        width: 24px;
        height: 24px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .calendar-component .tglBln .hari-ini .date-number {
        background-color: #2563eb;
        color: white;
        border-radius: 9999px;
    }

    .calendar-component .events-list-in-cell {
        width: 100%;
        display: flex;
        flex-direction: column;
        gap: 2px;
    }

    .calendar-component .event-marker-in-cell {
        font-size: 0.65rem;
        padding: 1px 3px;
        border-radius: 3px;
        background-color: #e0e7ff;
        color: #4338ca;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        border-left: 2px solid #818cf8;
    }

    .calendar-component .more-events-marker {
        font-weight: bold;
        color: #1e40af;
        background-color: #bfdbfe;
    }
</style>

<div class="calendar-component">
    <!-- Header Kalender dan Navigasi -->
    <div class="flex justify-between items-center mb-4">
        <button onclick="calendarComponent.prevMonth()" class="p-1 rounded-full hover:bg-gray-100 transition">
            <i data-lucide="chevron-left" class="w-5 h-5 text-gray-700"></i>
        </button>
        <h2 class="text-lg font-bold bln-thn text-gray-800"></h2>
        <button onclick="calendarComponent.nextMonth()" class="p-1 rounded-full hover:bg-gray-100 transition">
            <i data-lucide="chevron-right" class="w-5 h-5 text-gray-700"></i>
        </button>
    </div>

    <!-- Hari-hari dalam Seminggu -->
    <div class="grid grid-cols-7 gap-1 text-center font-semibold text-xs text-gray-500 mb-2">
        @foreach($calendarDays as $day)
            <div>{{ $day }}</div>
        @endforeach
    </div>

    <!-- Grid Tanggal Kalender -->
    <div class="grid grid-cols-7 gap-1 tglBln">
        <!-- Tanggal akan di-generate oleh JS di sini -->
    </div>
</div>

<script>
    // Self-invoking function to encapsulate the calendar logic
    const calendarComponent = (function() {
        let bulanSekarang;
        let tahunSekarang;

        // Data from Laravel controller via props
        var daftarAktivitas = @json($activities);
        var namaBulan = ["Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Agu", "Sep", "Okt", "Nov", "Des"];

        function init() {
            // Find all calendar components on the page and initialize them
            const calendarRoots = document.querySelectorAll('.calendar-component');
            if (calendarRoots.length === 0) return;

            const tanggalHariIni = new Date();
            bulanSekarang = tanggalHariIni.getMonth();
            tahunSekarang = tanggalHariIni.getFullYear();

            calendarRoots.forEach(calendarRoot => {
                const tanggalContainer = calendarRoot.querySelector('.tglBln');
                const judulContainer = calendarRoot.querySelector('.bln-thn');
                tampilkanKalender(tanggalContainer, judulContainer, bulanSekarang, tahunSekarang);
            });
            
            if (typeof lucide !== 'undefined') {
                lucide.createIcons();
            }
        }
        
        function tampilkanKalender(container, judulElem, bulan, tahun) {
            if (!container || !judulElem) return;

            container.innerHTML = '';
            judulElem.textContent = namaBulan[bulan] + ' ' + tahun;

            const tglPertama = new Date(tahun, bulan, 1);
            const jmlHariBulanIni = new Date(tahun, bulan + 1, 0).getDate();
            const hariPertamaIndex = tglPertama.getDay();
            const jmlHariBulanLalu = new Date(tahun, bulan, 0).getDate();

            const eventsPerDay = {};
            daftarAktivitas.forEach(event => {
                const dateObj = new Date(event.date);
                if (dateObj.getMonth() === bulan && dateObj.getFullYear() === tahun) {
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
                divTanggal.classList.add('tanggal-cell');

                if (i < hariPertamaIndex) {
                    const tgl = jmlHariBulanLalu - hariPertamaIndex + i + 1;
                    divTanggal.innerHTML = `<span class="date-number text-gray-300">${tgl}</span>`;
                    divTanggal.classList.add('bg-gray-50/50');
                } else if (tglCounter <= jmlHariBulanIni) {
                    divTanggal.innerHTML = `<span class="date-number">${tglCounter}</span>`;
                    
                    const hariIni = new Date();
                    if (tglCounter === hariIni.getDate() && bulan === hariIni.getMonth() && tahun === hariIni.getFullYear()) {
                        divTanggal.classList.add('hari-ini');
                    }

                    if (eventsPerDay[tglCounter] && eventsPerDay[tglCounter].length > 0) {
                        const events = eventsPerDay[tglCounter];
                        const eventsContainer = document.createElement('div');
                        eventsContainer.className = 'events-list-in-cell';

                        events.slice(0, 2).forEach(evt => {
                            const eventMarker = document.createElement('div');
                            eventMarker.className = 'event-marker-in-cell';
                            eventMarker.textContent = evt.title;
                            eventMarker.title = evt.title;
                            eventsContainer.appendChild(eventMarker);
                        });

                        if (events.length > 2) {
                            const moreMarker = document.createElement('div');
                            moreMarker.className = 'event-marker-in-cell more-events-marker';
                            moreMarker.textContent = `+${events.length - 2} lagi`;
                            eventsContainer.appendChild(moreMarker);
                        }
                        divTanggal.appendChild(eventsContainer);
                    }
                    tglCounter++;
                } else {
                    divTanggal.innerHTML = `<span class="date-number text-gray-300">${tglBulanBerikutnya}</span>`;
                    divTanggal.classList.add('bg-gray-50/50');
                    tglBulanBerikutnya++;
                }
                container.appendChild(divTanggal);
            }
        }

        function changeMonth(direction) {
            if (direction === 'prev') {
                bulanSekarang--;
                if (bulanSekarang < 0) {
                    bulanSekarang = 11;
                    tahunSekarang--;
                }
            } else {
                bulanSekarang++;
                if (bulanSekarang > 11) {
                    bulanSekarang = 0;
                    tahunSekarang++;
                }
            }
            
            const calendarRoots = document.querySelectorAll('.calendar-component');
            calendarRoots.forEach(calendarRoot => {
                const tanggalContainer = calendarRoot.querySelector('.tglBln');
                const judulContainer = calendarRoot.querySelector('.bln-thn');
                tampilkanKalender(tanggalContainer, judulContainer, bulanSekarang, tahunSekarang);
            });
        }

        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', init);
        } else {
            init();
        }

        // Public API
        return {
            prevMonth: () => changeMonth('prev'),
            nextMonth: () => changeMonth('next')
        };
    })();
</script>
