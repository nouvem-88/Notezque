@props ([
    
    ])

<!-- ==================================================================== -->
<!-- CUSTOM CONFIRMATION MODAL -->
<!-- ==================================================================== -->
<style>
    /* Pastikan style modal konsisten */
    .modal {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        display: none;
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

<div id="confirmModal" class="modal">
    <div class="modal-content text-center max-w-sm">
        <h3 class="text-xl font-bold mb-4 text-red-600" id="confirmTitle">Konfirmasi Hapus</h3>
        <p class="text-gray-700 mb-6" id="confirmMessage">Anda yakin ingin menghapus acara ini secara permanen?</p>

        <form id="deleteForm" action="{{ route('kalender.delete') }}" method="POST" class="hidden">
            @csrf
            <input type="hidden" name="id" id="deleteIdInput">
        </form>

        <div class="flex justify-center gap-4">
            <button
                class="flex items-center gap-1.5 px-4 py-2 bg-gray-200 text-gray-700 font-medium rounded-lg hover:bg-gray-300 transition duration-150"
                onclick="cancelConfirmation()">
                Batal
            </button>
            <button id="confirmActionBtn"
                class="save flex items-center gap-1.5 px-4 py-2 bg-red-600 text-white font-medium rounded-lg hover:bg-red-700 transition duration-150"
                onclick="executeDelete()">
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

        document.getElementById('confirmModal').style.display = 'flex';
        if (window.closeSideModal) {
            window.closeSideModal(); // Tutup side modal jika terbuka
        }
    }

    window.cancelConfirmation = function() {
        document.getElementById('confirmModal').style.display = 'none';
    }

    window.executeDelete = function() {
        document.getElementById('deleteForm').submit();
    }
</script>
