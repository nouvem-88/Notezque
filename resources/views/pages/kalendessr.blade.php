@extends('layouts.main-nav')

@section('title', 'Kalender')
@section('subtitle', 'Lihat dan kelola aktivitas Anda dengan mudah menggunakan kalender interaktif kami.')

@section('content')
<div class="min-h-screen">
    <main class="flex-grow bg-white rounded-tl-3xl p-6 md:p-10">
        <div class="max-w-7xl mx-auto">
            <!-- Header: match Materi style -->
            <div class="flex flex-wrap justify-between items-center gap-4 mb-8">
                <div class="flex items-center gap-3">
                    <h2 class="text-2xl md:text-3xl font-bold text-slate-800">Kalender</h2>
                    <div class="p-2 bg-slate-100 rounded-lg text-slate-600">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-5 w-5">
                            <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                            <line x1="16" y1="2" x2="16" y2="6"></line>
                            <line x1="8" y1="2" x2="8" y2="6"></line>
                            <line x1="3" y1="10" x2="21" y2="10"></line>
                        </svg>
                    </div>
                </div>
            </div>
    <!-- Main Grid Layout -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
        
        <!-- Left Sidebar - Upcoming Events -->
        <div class="lg:col-span-4 xl:col-span-3">
            <div class="bg-slate-50 rounded-xl p-4 shadow-sm border border-slate-200">
                <h3 class="text-sm font-semibold text-slate-500 uppercase tracking-wider mb-4">Upcoming Events</h3>
                
                <button onclick="openAddModal()" class="w-full mb-4 p-2 rounded-lg bg-blue-50 text-blue-600 hover:bg-blue-100 transition flex items-center justify-center gap-2">
                    <i data-lucide="plus" class="w-5 h-5"></i>
                    <span class="font-medium">Add Event</span>
                </button>
                
                <!-- Events List -->
                <div class="space-y-2">
                    @php
                        $upcomingEvents = ($aktivitasBulanIni ?? collect())->filter(function($event) {
                            return \Carbon\Carbon::parse($event->date)->isFuture() || \Carbon\Carbon::parse($event->date)->isToday();
                        })->sortBy('date')->take(10);
                    @endphp
                    
                    @forelse($upcomingEvents as $event)
                        <div class="p-4 rounded-xl hover:bg-slate-50 cursor-pointer border border-slate-200 bg-white" onclick="openEditModalById({{ $event->id }})">
                            <div class="flex items-start justify-between mb-2">
                                <span class="text-xs font-semibold text-slate-400 uppercase">
                                    {{ \Carbon\Carbon::parse($event->date)->format('M d, Y') }}
                                </span>
                                <span class="text-xs px-2 py-1 rounded-full {{ $event->status === 'selesai' ? 'bg-green-100 text-green-700' : 'bg-blue-100 text-blue-700' }}">
                                    {{ $event->status === 'selesai' ? 'Done' : 'Pending' }}
                                </span>
                            </div>
                            <h3 class="font-bold text-slate-800 text-sm mb-1">{{ $event->title }}</h3>
                            @if($event->desk)
                                <p class="text-xs text-slate-500 line-clamp-2">{{ $event->desk }}</p>
                            @endif
                            @if($event->time)
                                <p class="text-xs text-slate-400 mt-2">⏰ {{ substr($event->time, 0, 5) }}</p>
                            @endif
                        </div>
                    @empty
                        <div class="text-center py-8 text-slate-400">
                            <i data-lucide="calendar-x" class="w-12 h-12 mx-auto mb-2 opacity-50"></i>
                            <p class="text-sm">No upcoming events</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Right Side - Calendar -->
        <div class="lg:col-span-8 xl:col-span-9">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                <!-- View Tabs -->
                <div class="flex items-center justify-between mb-4 border-b border-gray-200 pb-4">
                    <div class="flex gap-2">
                        <button onclick="calendar.changeView('timeGridDay')" class="view-btn px-4 py-2 rounded-lg text-sm font-medium transition bg-gray-100 text-gray-600 hover:bg-gray-200">Day</button>
                        <button onclick="calendar.changeView('timeGridWeek')" class="view-btn px-4 py-2 rounded-lg text-sm font-medium transition bg-gray-100 text-gray-600 hover:bg-gray-200">Week</button>
                        <button onclick="calendar.changeView('dayGridMonth')" class="view-btn active px-4 py-2 rounded-lg text-sm font-medium transition bg-blue-600 text-white">Month</button>
                    </div>
                </div>
                
                <div id="calendar"></div>
            </div>
        </div>
    </div>
        </div>
    </main>
</div>

<!-- Modal Tambah/Edit Acara -->
<div id="eventModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center">
    <div class="bg-white rounded-2xl p-6 max-w-md w-full mx-4 shadow-xl">
        <div class="flex justify-between items-center mb-6">
            <h3 id="modalTitle" class="text-xl font-bold text-gray-900">Tambah Acara</h3>
            <button type="button" onclick="closeEventModal()" class="text-gray-400 hover:text-gray-600">
                <i data-lucide="x" class="w-6 h-6"></i>
            </button>
        </div>
        
        <form id="eventForm" method="POST" action="{{ route('kalender.store') }}">
            @csrf
            <input type="hidden" id="methodInput" name="_method" value="POST">
            <input type="hidden" id="eventId" name="event_id">
            
            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    <i data-lucide="type" class="w-4 h-4 inline mr-1"></i>
                    Judul
                </label>
                <input type="text" name="title" id="inputTitle" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="Masukkan judul acara" required>
            </div>
            
            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    <i data-lucide="file-text" class="w-4 h-4 inline mr-1"></i>
                    Deskripsi
                </label>
                <textarea name="desk" id="inputDesk" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" rows="3" placeholder="Tambahkan deskripsi (opsional)"></textarea>
            </div>
            
            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        <i data-lucide="calendar" class="w-4 h-4 inline mr-1"></i>
                        Tanggal
                    </label>
                    <input type="date" name="date" id="inputDate" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
                </div>
                
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        <i data-lucide="clock" class="w-4 h-4 inline mr-1"></i>
                        Waktu
                    </label>
                    <input type="time" name="time" id="inputTime" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>
            </div>
            
            <div class="mb-6">
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    <i data-lucide="check-circle" class="w-4 h-4 inline mr-1"></i>
                    Status
                </label>
                <select name="status" id="inputStatus" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    <option value="pending">Pending</option>
                    <option value="selesai">Selesai</option>
                </select>
            </div>
            
            <div class="flex gap-3">
                <button type="submit" class="flex-1 bg-blue-600 text-white px-4 py-2.5 rounded-lg hover:bg-blue-700 font-medium transition flex items-center justify-center gap-2">
                    <i data-lucide="save" class="w-4 h-4"></i>
                    <span>Simpan</span>
                </button>
                <button type="button" id="deleteBtn" onclick="deleteEvent()" class="hidden bg-red-600 text-white px-4 py-2.5 rounded-lg hover:bg-red-700 font-medium transition">
                    <i data-lucide="trash-2" class="w-4 h-4"></i>
                </button>
                <button type="button" onclick="closeEventModal()" class="bg-gray-200 text-gray-700 px-4 py-2.5 rounded-lg hover:bg-gray-300 font-medium transition">
                    Batal
                </button>
            </div>
        </form>
    </div>
</div>

<script>
// Auto reload after form submission to show new events
document.addEventListener('DOMContentLoaded', function() {
    const eventForm = document.getElementById('eventForm');
    if (eventForm) {
        eventForm.addEventListener('submit', function(e) {
            setTimeout(() => {
                window.location.reload();
            }, 200);
        });
    }
});
</script>

<!-- FullCalendar CSS -->
<link href='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.css' rel='stylesheet' />

<!-- FullCalendar JS -->
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js'></script>
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/locales/id.global.min.js'></script>
<script src="https://unpkg.com/lucide@latest"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize Lucide icons
    if (typeof lucide !== 'undefined') {
        lucide.createIcons();
    }

    // Activities data from controller
    const activities = @json($aktivitasBulanIni ?? []);
    
    // Convert activities to FullCalendar events
    const events = activities.map(activity => {
        // Parse date properly - handle both string and object formats
        let dateStr = activity.date;
        if (typeof dateStr === 'object' && dateStr.date) {
            dateStr = dateStr.date.split(' ')[0]; // Get YYYY-MM-DD from timestamp
        } else if (typeof dateStr === 'string' && dateStr.includes('T')) {
            dateStr = dateStr.split('T')[0]; // Get YYYY-MM-DD from ISO string
        }
        
        return {
            id: activity.id,
            title: activity.title,
            start: dateStr + (activity.time ? 'T' + activity.time : ''),
            description: activity.desk,
            status: activity.status,
            className: 'fc-event-' + activity.status,
            backgroundColor: activity.status === 'selesai' ? '#10b981' : '#3b82f6',
            borderColor: activity.status === 'selesai' ? '#059669' : '#2563eb',
            extendedProps: {
                description: activity.desk,
                status: activity.status
            }
        };
    });

    // Initialize FullCalendar
    const calendarEl = document.getElementById('calendar');
    const calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        locale: 'id',
        headerToolbar: {
            left: 'prev,next',
            center: 'title',
            right: ''
        },
        buttonText: {
            today: 'Today',
            month: 'Month',
            week: 'Week',
            day: 'Day'
        },
        views: {
            dayGridMonth: {
                dayMaxEvents: 2,
                moreLinkText: 'more'
            },
            timeGridWeek: {
                slotDuration: '01:00:00',
                slotLabelInterval: '01:00',
                slotMinTime: '06:00:00',
                slotMaxTime: '22:00:00',
                allDaySlot: true,
                allDayText: 'All Day'
            }
        },
        events: events,
        eventClick: function(info) {
            info.jsEvent.preventDefault();
            openEditModal(info.event);
        },
        dateClick: function(info) {
            openAddModal(info.dateStr);
        },
        eventMouseEnter: function(info) {
            info.el.style.transform = 'scale(1.02)';
            info.el.style.zIndex = '10';
        },
        eventMouseLeave: function(info) {
            info.el.style.transform = 'scale(1)';
            info.el.style.zIndex = '1';
        },
        editable: false,
        selectable: true,
        selectMirror: true,
        dayMaxEvents: true,
        weekends: true,
        height: 'auto',
        aspectRatio: 2,
        firstDay: 0,
        nowIndicator: true,
        eventDisplay: 'block',
        displayEventTime: true,
        displayEventEnd: false,
        slotLabelFormat: {
            hour: '2-digit',
            minute: '2-digit',
            hour12: false
        },
        eventTimeFormat: {
            hour: '2-digit',
            minute: '2-digit',
            hour12: false
        }
    });

    calendar.render();

    // Make calendar globally accessible
    window.calendar = calendar;
    
    // View switcher buttons
    document.querySelectorAll('.view-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            document.querySelectorAll('.view-btn').forEach(b => {
                b.classList.remove('active', 'bg-blue-600', 'text-white');
                b.classList.add('bg-gray-100', 'text-gray-600');
            });
            this.classList.add('active', 'bg-blue-600', 'text-white');
            this.classList.remove('bg-gray-100', 'text-gray-600');
        });
    });
});

function openAddModal(date = null) {
    const modal = document.getElementById('eventModal');
    const form = document.getElementById('eventForm');
    const modalTitle = document.getElementById('modalTitle');
    const deleteBtn = document.getElementById('deleteBtn');
    
    modal.classList.remove('hidden');
    modalTitle.textContent = 'Tambah Acara Baru';
    form.action = '{{ route("kalender.store") }}';
    document.getElementById('methodInput').value = 'POST';
    deleteBtn.classList.add('hidden');
    form.reset();
    
    if (date) {
        document.getElementById('inputDate').value = date;
    }
    
    // Re-initialize icons
    setTimeout(() => lucide.createIcons(), 10);
}

function openEditModal(event) {
    const modal = document.getElementById('eventModal');
    const form = document.getElementById('eventForm');
    const modalTitle = document.getElementById('modalTitle');
    const deleteBtn = document.getElementById('deleteBtn');
    
    modal.classList.remove('hidden');
    modalTitle.textContent = 'Edit Acara';
    form.action = `/kalender/${event.id}`;
    document.getElementById('methodInput').value = 'PUT';
    deleteBtn.classList.remove('hidden');
    
    document.getElementById('eventId').value = event.id;
    document.getElementById('inputTitle').value = event.title;
    document.getElementById('inputDesk').value = event.extendedProps.description || '';
    
    const startDate = new Date(event.start);
    document.getElementById('inputDate').value = startDate.toISOString().split('T')[0];
    
    if (event.start.toTimeString) {
        const time = startDate.toTimeString().slice(0, 5);
        document.getElementById('inputTime').value = time;
    }
    
    document.getElementById('inputStatus').value = event.extendedProps.status || 'pending';
    
    // Re-initialize icons
    setTimeout(() => lucide.createIcons(), 10);
}

function openEditModalById(eventId) {
    const activities = @json($aktivitasBulanIni ?? []);
    const activity = activities.find(a => a.id === eventId);
    
    if (activity) {
        const modal = document.getElementById('eventModal');
        const form = document.getElementById('eventForm');
        const modalTitle = document.getElementById('modalTitle');
        const deleteBtn = document.getElementById('deleteBtn');
        
        modal.classList.remove('hidden');
        modalTitle.textContent = 'Edit Acara';
        form.action = `/kalender/${activity.id}`;
        document.getElementById('methodInput').value = 'PUT';
        deleteBtn.classList.remove('hidden');
        
        document.getElementById('eventId').value = activity.id;
        document.getElementById('inputTitle').value = activity.title;
        document.getElementById('inputDesk').value = activity.desk || '';
        
        // Parse date properly
        let dateStr = activity.date;
        if (typeof dateStr === 'object' && dateStr.date) {
            dateStr = dateStr.date.split(' ')[0];
        } else if (typeof dateStr === 'string' && dateStr.includes('T')) {
            dateStr = dateStr.split('T')[0];
        }
        
        document.getElementById('inputDate').value = dateStr;
        document.getElementById('inputTime').value = activity.time || '';
        document.getElementById('inputStatus').value = activity.status || 'pending';
        
        // Re-initialize icons
        setTimeout(() => lucide.createIcons(), 10);
    }
}

function deleteEvent() {
    const eventId = document.getElementById('eventId').value;
    if (!eventId) return;
    
    if (confirm('Yakin ingin menghapus acara ini?')) {
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = `/kalender/${eventId}`;
        
        const csrfToken = document.createElement('input');
        csrfToken.type = 'hidden';
        csrfToken.name = '_token';
        csrfToken.value = '{{ csrf_token() }}';
        
        const methodField = document.createElement('input');
        methodField.type = 'hidden';
        methodField.name = '_method';
        methodField.value = 'DELETE';
        
        form.appendChild(csrfToken);
        form.appendChild(methodField);
        document.body.appendChild(form);
        form.submit();
    }
}

function closeEventModal() {
    const modal = document.getElementById('eventModal');
    modal.classList.add('hidden');
}

// Close modal on outside click
document.getElementById('eventModal')?.addEventListener('click', function(e) {
    if (e.target === this) {
        closeEventModal();
    }
});
</script>

<style>
/* Modern Calendar Styling */
.fc {
    font-family: 'Inter', sans-serif;
    --fc-border-color: #e5e7eb;
    --fc-today-bg-color: #eff6ff;
}

/* Header */
.fc .fc-toolbar {
    padding: 0 0 1rem 0;
    margin-bottom: 0;
}

.fc-toolbar-title {
    font-size: 1.25rem !important;
    font-weight: 700 !important;
    color: #111827;
}

.fc .fc-button {
    background: white !important;
    border: 1px solid #e5e7eb !important;
    color: #374151 !important;
    border-radius: 0.5rem !important;
    padding: 0.5rem 1rem !important;
    font-weight: 500 !important;
    transition: all 0.2s !important;
    box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05) !important;
}

.fc .fc-button:hover {
    background: #f9fafb !important;
    border-color: #d1d5db !important;
}

.fc .fc-button:active,
.fc .fc-button-active {
    background: #f3f4f6 !important;
    border-color: #9ca3af !important;
}

/* Day headers */
.fc .fc-col-header-cell {
    padding: 0.75rem 0.5rem;
    background: #f9fafb;
    border-color: #e5e7eb !important;
    font-weight: 600;
    font-size: 0.75rem;
    color: #6b7280;
    text-transform: uppercase;
    letter-spacing: 0.05em;
}

/* Time labels in week view */
.fc .fc-timegrid-slot-label {
    font-size: 0.75rem;
    color: #9ca3af;
    font-weight: 500;
    border-color: #f3f4f6 !important;
}

.fc .fc-timegrid-slot {
    height: 3rem;
    border-color: #f3f4f6 !important;
}

/* Day cells */
.fc .fc-day {
    background: white;
}

.fc .fc-day-today {
    background: #eff6ff !important;
}

.fc .fc-daygrid-day-number {
    font-size: 0.875rem;
    font-weight: 600;
    color: #374151;
    padding: 0.5rem;
}

.fc .fc-day-today .fc-daygrid-day-number {
    background: #3b82f6;
    color: white;
    border-radius: 50%;
    width: 2rem;
    height: 2rem;
    display: flex;
    align-items: center;
    justify-content: center;
}

/* Events */
.fc-event {
    border: none !important;
    border-radius: 0.5rem !important;
    padding: 0.375rem 0.5rem !important;
    margin: 0.125rem 0 !important;
    cursor: pointer !important;
    font-weight: 500 !important;
    font-size: 0.8125rem !important;
    transition: all 0.2s !important;
    box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05) !important;
}

.fc-event:hover {
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1) !important;
}

.fc-event.fc-event-pending {
    background: #3b82f6 !important;
    color: white !important;
}

.fc-event.fc-event-selesai {
    background: #10b981 !important;
    color: white !important;
}

.fc-event-title {
    font-weight: 600;
}

.fc-event-time {
    font-weight: 500;
    font-size: 0.75rem;
}

/* Now indicator */
.fc .fc-timegrid-now-indicator-line {
    border-color: #ef4444;
    border-width: 2px;
}

.fc .fc-timegrid-now-indicator-arrow {
    border-color: #ef4444;
}

/* Scrollbar */
.fc-scroller::-webkit-scrollbar {
    width: 6px;
}

.fc-scroller::-webkit-scrollbar-track {
    background: #f3f4f6;
    border-radius: 3px;
}

.fc-scroller::-webkit-scrollbar-thumb {
    background: #d1d5db;
    border-radius: 3px;
}

.fc-scroller::-webkit-scrollbar-thumb:hover {
    background: #9ca3af;
}

/* View buttons active state */
.view-btn.active {
    background: #3b82f6 !important;
    color: white !important;
}

/* Sidebar scrollbar */
.lg\:col-span-4 .overflow-y-auto::-webkit-scrollbar {
    width: 4px;
}

.lg\:col-span-4 .overflow-y-auto::-webkit-scrollbar-track {
    background: transparent;
}

.lg\:col-span-4 .overflow-y-auto::-webkit-scrollbar-thumb {
    background: #d1d5db;
    border-radius: 2px;
}

.lg\:col-span-4 .overflow-y-auto::-webkit-scrollbar-thumb:hover {
    background: #9ca3af;
}

/* Line clamp utility */
.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

/* Responsive */
@media (max-width: 1024px) {
    .fc-toolbar-title {
        font-size: 1.125rem !important;
    }
    
    .fc .fc-button {
        padding: 0.375rem 0.75rem !important;
        font-size: 0.875rem !important;
    }
}
</style>
@endsection
