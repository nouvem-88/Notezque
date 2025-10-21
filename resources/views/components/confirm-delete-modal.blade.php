@props ([
    
    ])

<!-- ==================================================================== -->
<!-- CUSTOM CONFIRMATION MODAL -->
<!-- ==================================================================== -->

<div id="confirmModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 items-center justify-center p-4 hidden">
    <div class="bg-white rounded-xl shadow-2xl p-8 w-full max-w-md transform transition-all text-center" onclick="event.stopPropagation()">
        <h3 class="text-2xl font-bold mb-4 text-red-600" id="confirmTitle">Konfirmasi Hapus</h3>
        <p class="text-slate-700 mb-6" id="confirmMessage">Anda yakin ingin menghapus acara ini secara permanen?</p>

        <form id="deleteForm" action="{{ route('kalender.delete') }}" method="POST" class="hidden">
            @csrf
            <input type="hidden" name="id" id="deleteIdInput">
        </form>

        <div class="flex justify-center gap-4">
            <button type="button" onclick="cancelConfirmation()" class="bg-slate-200 text-slate-700 font-semibold py-2 px-6 rounded-lg hover:bg-slate-300 transition">
                Batal
            </button>
            <button type="button" onclick="executeDelete()" class="bg-red-600 text-white font-semibold py-2 px-6 rounded-lg shadow-md hover:bg-red-700 transition">
                Hapus
            </button>
        </div>
    </div>
</div>

<script>
    // ====================================================================
    // FUNGSI KONFIRMASI HAPUS
    // ====================================================================

    window.confirmDelete = function(id) {
        const event = findEventById(id);
        if (!event) return;

        document.getElementById('deleteIdInput').value = id;
        document.getElementById('confirmMessage').innerHTML =
            `Anda yakin ingin menghapus acara: <strong>"${event.title}"</strong> secara permanen?`;

        const confirmModal = document.getElementById('confirmModal');
        confirmModal.classList.remove('hidden');
        confirmModal.classList.add('flex');
        
        if (window.closeSideModal) {
            window.closeSideModal(); // Tutup side modal jika terbuka
        }
    }

    window.cancelConfirmation = function() {
        const confirmModal = document.getElementById('confirmModal');
        confirmModal.classList.remove('flex');
        confirmModal.classList.add('hidden');
    }

    window.executeDelete = function() {
        document.getElementById('deleteForm').submit();
    }
</script>
