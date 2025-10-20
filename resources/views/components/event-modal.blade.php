<!-- ==================================================================== -->
<!-- MODAL TAMBAH/EDIT ACARA -->
<!-- ==================================================================== -->
<style>
    /* Styling dasar untuk semua modal */
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
</style>

<div id="eventModal" class="modal">
    <div class="modal-content">
        <div class="flex justify-between items-center pb-3 border-b">
            <h3 class="text-xl font-bold text-gray-800" id="modalTitle">Tambah Acara Baru</h3>
            <button onclick="closeModal()" class="p-1 rounded-full hover:bg-gray-100">
                <iconify-icon icon="mdi:close" class="w-6 h-6 text-gray-500"></iconify-icon>
            </button>
        </div>
        <form id="eventForm" class="mt-4 space-y-4" action="{{ route('kalender.store') }}" method="POST">
            @csrf
            <input type="hidden" id="idAktivitasYangDiedit" name="id">

            <div>
                <label for="title" class="block text-sm font-medium text-gray-700">Judul Acara</label>
                <input type="text" id="title" name="title" required
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-2 border">
            </div>

            <div>
                <label for="desk" class="block text-sm font-medium text-gray-700">Deskripsi</label>
                <textarea id="desk" name="desk" rows="3"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-2 border"></textarea>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="tanggal" class="block text-sm font-medium text-gray-700">Tanggal</label>
                    <input type="date" id="tanggal" name="tanggal" required
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-2 border">
                </div>
                <div>
                    <label for="waktu" class="block text-sm font-medium text-gray-700">Waktu (Opsional)</label>
                    <input type="time" id="waktu" name="waktu"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-2 border">
                </div>
            </div>

            <!-- Reminder Group -->
            <div class="border border-gray-200 p-3 rounded-lg space-y-3">
                <div class="flex items-center justify-between">
                    <label for="reminder_enabled" class="text-sm font-medium text-gray-700">Aktifkan
                        Reminder</label>
                    <input type="checkbox" id="reminder_enabled" name="reminder_enabled" onchange="toggleReminderOptions()"
                        class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                </div>

                <div id="reminderOptions" class="space-y-3 hidden">
                    <div>
                        <label for="reminder_template" class="block text-sm font-medium text-gray-700">Template
                            Waktu</label>
                        <select id="reminder_template" name="reminder_template" onchange="toggleCustomReminder()"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-2 border">
                            <option value="15m">15 Menit Sebelumnya</option>
                            <option value="1h">1 Jam Sebelumnya</option>
                            <option value="custom">Waktu Kustom</option>
                        </select>
                    </div>
                    <div id="customReminderGroup" class="hidden">
                        <label for="custom_reminder_time" class="block text-sm font-medium text-gray-700">Waktu
                            Kustom</label>
                        <input type="datetime-local" id="custom_reminder_time" name="custom_reminder_time"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-2 border">
                    </div>
                </div>
            </div>

            <div class="flex justify-end pt-4 border-t">
                <button type="submit"
                    class="save flex items-center gap-1.5 px-6 py-2 bg-green-600 text-white font-medium rounded-lg hover:bg-green-700 transition duration-150">
                    <iconify-icon icon="mdi:content-save-outline" class="w-5 h-5"></iconify-icon>
                    Simpan Acara
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    // ====================================================================
    // FUNGSI MODAL TAMBAH/EDIT
    // ====================================================================

    window.openModal = function(mode, eventIdOrDate) {
        const form = document.getElementById('eventForm');
        form.reset();
        document.getElementById('reminderOptions').classList.add('hidden');
        document.getElementById('customReminderGroup').classList.add('hidden');
        document.getElementById('idAktivitasYangDiedit').value = ''; // Reset hidden ID field

        if (mode === 'add') {
            document.getElementById('modalTitle').textContent = 'Tambah Acara Baru';
            // Pre-fill tanggal jika dipanggil dari klik tanggal di kalender
            if (eventIdOrDate && typeof eventIdOrDate === 'string' && eventIdOrDate.match(/^\d{4}-\d{2}-\d{2}$/)) {
                document.getElementById('tanggal').value = eventIdOrDate;
            }
        } else if (mode === 'edit' && eventIdOrDate) {
            document.getElementById('modalTitle').textContent = 'Edit Acara';
            const event = window.findEventById(eventIdOrDate);

            if (event) {
                // Set ID untuk edit
                document.getElementById('idAktivitasYangDiedit').value = event.id;
                
                // Fill form dengan data event
                document.getElementById('title').value = event.title || '';
                document.getElementById('desk').value = event.desk || '';
                document.getElementById('tanggal').value = event.date || '';
                document.getElementById('waktu').value = event.time || '';

                // Setup Reminder untuk Edit
                const hasReminder = event.reminder && event.reminder !== 'none';
                document.getElementById('reminder_enabled').checked = hasReminder;
                
                if (hasReminder) {
                    toggleReminderOptions(); // Show reminder options
                    
                    // Set reminder template value
                    const validTemplates = ['15m', '1h', 'custom'];
                    if (validTemplates.includes(event.reminder)) {
                        document.getElementById('reminder_template').value = event.reminder;
                    } else {
                        document.getElementById('reminder_template').value = '15m'; // default
                    }
                    
                    toggleCustomReminder(); // Check if custom time needed
                    
                    // Set custom time if available
                    if (event.reminder === 'custom' && event.customTime) {
                        document.getElementById('custom_reminder_time').value = event.customTime.substring(0, 16);
                    }
                }
            }
        }
        document.getElementById('eventModal').style.display = 'flex';
    }

    window.closeModal = function() {
        document.getElementById('eventModal').style.display = 'none';
        document.getElementById('idAktivitasYangDiedit').value = ''; // Clear ID
    }

    window.toggleReminderOptions = function() {
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

    window.toggleCustomReminder = function() {
        const template = document.getElementById('reminder_template').value;
        const customDiv = document.getElementById('customReminderGroup');
        if (template === 'custom') {
            customDiv.classList.remove('hidden');
        } else {
            customDiv.classList.add('hidden');
        }
    }

    // ====================================================================
    // FUNGSI SAVE EVENT (CRUD MOCKING)
    // ====================================================================

    // Fungsi saveEvent sekarang hanya mengirimkan form, tidak lagi menangani logika
    window.saveEvent = function(e) {
        e.preventDefault();
        document.getElementById('eventForm').submit();
    }
</script>
