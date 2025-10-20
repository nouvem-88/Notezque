@extends('layouts.main-nav')

@section('content')
<div class="p-8 bg-v4-background min-h-screen">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-v4-text">Catatan Saya</h1>
        <button onclick="openModal()" class="bg-v4-primary text-white px-5 py-2 rounded-full text-sm font-semibold shadow-md hover:opacity-90 transition">
            + Tambah Catatan
        </button>
    </div>

    {{-- Alert --}}
    @if(session('success'))
        <div class="bg-green-100 text-green-800 px-4 py-2 rounded-lg mb-4">{{ session('success') }}</div>
    @elseif(session('info'))
        <div class="bg-blue-100 text-blue-800 px-4 py-2 rounded-lg mb-4">{{ session('info') }}</div>
    @elseif(session('error'))
        <div class="bg-red-100 text-red-800 px-4 py-2 rounded-lg mb-4">{{ session('error') }}</div>
    @endif

    <div id="catatanContainer" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse ($notes as $note)
        <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100 relative hover:shadow-xl transition-all">
            <h3 class="text-lg font-bold text-v4-text mb-2">{{ $note['judul'] }}</h3>
            <p class="text-gray-500 text-sm mb-4">{{ $note['isi'] }}</p>
            <div class="flex gap-2">
                <button onclick="editNote('{{ $note['id'] }}', '{{ addslashes($note['judul']) }}', '{{ addslashes($note['isi']) }}')"
                    class="text-v4-primary hover:underline text-xs font-medium">Edit</button>
                <a href="{{ route('catatan.delete', $note['id']) }}"
                    class="text-red-500 hover:underline text-xs font-medium">Hapus</a>
            </div>
        </div>
        @empty
        <p class="text-gray-500 text-sm italic">Belum ada catatan 😴</p>
        @endforelse
    </div>

    {{-- Modal Tambah/Edit --}}
    <div id="modalCatatan"
        class="hidden fixed inset-0 bg-black/40 flex justify-center items-center z-50 backdrop-blur-sm">
        <div class="bg-white rounded-2xl shadow-xl p-6 w-full max-w-md relative">
            <button onclick="closeModal()" class="absolute top-3 right-3 text-gray-400 hover:text-gray-600 transition">
                <i data-lucide="x" class="w-5 h-5"></i>
            </button>
            <h2 id="modalTitle" class="text-xl font-bold text-v4-text mb-4">Tambah Catatan</h2>
            <form id="catatanForm" method="POST" action="{{ route('catatan.store') }}" class="space-y-4">
                @csrf
                <input type="hidden" name="edit_id" id="edit_id">
                <div>
                    <label for="judul" class="text-sm font-semibold text-gray-600">Judul</label>
                    <input id="judul" name="judul" type="text" required
                        class="w-full mt-1 border border-gray-200 rounded-xl px-3 py-2 focus:ring-2 focus:ring-v4-primary focus:outline-none text-sm">
                </div>
                <div>
                    <label for="isi" class="text-sm font-semibold text-gray-600">Isi Catatan</label>
                    <textarea id="isi" name="isi" rows="4" required
                        class="w-full mt-1 border border-gray-200 rounded-xl px-3 py-2 focus:ring-2 focus:ring-v4-primary focus:outline-none text-sm"></textarea>
                </div>
                <div class="flex justify-end space-x-3">
                    <button type="button" onclick="closeModal()" class="px-4 py-2 text-sm border rounded-full text-gray-600 hover:bg-gray-50 transition">Batal</button>
                    <button type="submit" class="px-5 py-2 text-sm font-semibold bg-v4-primary text-white rounded-full hover:opacity-90 transition">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://unpkg.com/lucide@latest"></script>
<script>
document.addEventListener("DOMContentLoaded", () => lucide.createIcons());

function openModal() {
    document.getElementById("modalTitle").innerText = "Tambah Catatan";
    document.getElementById("catatanForm").action = "{{ route('catatan.store') }}";
    document.getElementById("edit_id").value = "";
    document.getElementById("judul").value = "";
    document.getElementById("isi").value = "";
    document.getElementById("modalCatatan").classList.remove("hidden");
}

function closeModal() {
    document.getElementById("modalCatatan").classList.add("hidden");
}

function editNote(id, judul, isi) {
    document.getElementById("modalTitle").innerText = "Edit Catatan";
    document.getElementById("catatanForm").action = "/catatan/edit/" + id;
    document.getElementById("judul").value = judul;
    document.getElementById("isi").value = isi;
    document.getElementById("modalCatatan").classList.remove("hidden");
}
</script>
@endsection
