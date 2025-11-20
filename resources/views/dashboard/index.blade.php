@extends('layouts.main-nav')

@section('content')
<div class="p-4 md:p-8 bg-v4-background min-h-screen">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
        <!-- Stat Card: Total Tugas -->
        <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl p-6 text-white shadow-xl hover:shadow-2xl transition-all duration-300">
            <div class="flex items-center justify-between mb-4">
                <i data-lucide="clipboard-check" class="w-10 h-10"></i>
                <span class="text-3xl font-bold">{{ Auth::user()->tasks()->where('status', 'selesai')->count() }} / {{ Auth::user()->tasks()->count() }}</span>
            </div>
            <h3 class="text-sm font-semibold opacity-90">Tugas Selesai</h3>
            <p class="text-xs opacity-75 mt-1">{{ Auth::user()->tasks()->where('status', 'pending')->count() }} tugas tersisa</p>
        </div>

        <!-- Stat Card: Deadline Mendekat -->
        <div class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-2xl p-6 text-white shadow-xl hover:shadow-2xl transition-all duration-300">
            <div class="flex items-center justify-between mb-4">
                <i data-lucide="calendar-clock" class="w-10 h-10"></i>
                <span class="text-3xl font-bold">{{ Auth::user()->tasks()->where('due_date', '>=', now())->where('due_date', '<=', now()->addDays(3))->count() }}</span>
            </div>
            <h3 class="text-sm font-semibold opacity-90">Deadline Mendekat</h3>
            <p class="text-xs opacity-75 mt-1">3 hari ke depan</p>
        </div>

        <!-- Stat Card: Total Acara -->
        <div class="bg-gradient-to-br from-pink-500 to-pink-600 rounded-2xl p-6 text-white shadow-xl hover:shadow-2xl transition-all duration-300">
            <div class="flex items-center justify-between mb-4">
                <i data-lucide="file-text" class="w-10 h-10"></i>
                <span class="text-3xl font-bold">{{ Auth::user()->activities()->whereMonth('date', now()->month)->count() }}</span>
            </div>
            <h3 class="text-sm font-semibold opacity-90">Total Acara Bulan Ini</h3>
            <p class="text-xs opacity-75 mt-1">{{ now()->format('F Y') }}</p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        <div class="lg:col-span-8 space-y-8">
            <div>
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-2xl font-bold text-v4-text">Daftar Tugas Mendatang</h3>
                    <a href="#" class="text-sm font-semibold text-v4-primary hover:underline">Lihat Semua</a>
                </div>

                <div class="bg-white rounded-2xl p-6 shadow-xl border border-gray-100">
                    <table class="min-w-full divide-y divide-gray-100">
                        <thead>
                            <tr class="text-left text-xs font-semibold uppercase text-gray-500">
                                <th class="py-3 px-1 md:px-4">Tugas</th>
                                <th class="hidden md:table-cell py-3 px-4">Tenggat</th>
                                <th class="py-3 px-4 text-center">Kategori</th>
                                <th class="py-3 px-4 text-right">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50 text-v4-text">
                            <tr class="hover:bg-v4-subtle/50 transition duration-150 cursor-pointer">
                                <td class="py-4 px-1 md:px-4 flex items-center space-x-3">
                                    <div class="w-2 h-2 rounded-full bg-v4-primary"></div>
                                    <span class="font-medium">Web Design Dasar</span>
                                </td>
                                <td class="hidden md:table-cell py-4 px-4 text-sm text-gray-500">30 Oktober</td>
                                <td class="text-center">
                                    <span class="text-xs font-semibold bg-blue-200 rounded-md py-1 px-6">#TUBES</span>
                                </td>
                                <td class="py-4 px-4 text-right">
                                    <span class="text-xs font-medium text-gray-700 bg-green-300 px-3 py-1 rounded-full">Selesai</span>
                                </td>
                            </tr>

                            <tr class="hover:bg-v4-subtle/50 transition duration-150 cursor-pointer">
                                <td class="py-4 px-1 md:px-4 flex items-center space-x-3">
                                    <div class="w-2 h-2 rounded-full bg-red-400"></div>
                                    <span class="font-medium">Statistika Probabilitas</span>
                                </td>
                                <td class="hidden md:table-cell py-4 px-4 text-sm text-gray-500">14 Mei</td>
                                <td class="text-center">
                                    <span class="text-xs font-semibold bg-blue-200 rounded-md py-1 px-6">#TUBES</span>
                                </td>
                                <td class="py-4 px-4 text-right">
                                    <span class="text-xs font-medium text-gray-700 bg-yellow-300 px-3 py-1 rounded-full">Proses</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div>
                <h3 class="text-2xl font-bold mb-4 text-v4-text">Materi Saat ini</h3>
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                    {{-- Kartu contoh --}}
                    <div class="group bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 cursor-pointer border border-gray-100">
                        <div class="bg-v4-primary/10 p-4 flex items-center justify-center h-24">
                            <i data-lucide="code" class="w-12 h-12 text-v4-primary"></i>
                        </div>
                        <div class="p-4">
                            <h4 class="font-bold text-lg text-v4-text">Algoritma & Struktur Data</h4>
                            <p class="text-sm text-gray-500 mb-3">15 SKS / 6 Tugas Aktif</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="lg:col-span-4 space-y-4">
            <div class="bg-white rounded-2xl p-6 shadow-xl border border-gray-100">
                {{-- <x-calendar hcell="38px" /> --}}
            </div>

            <div class="bg-white rounded-2xl p-6 shadow-xl border border-gray-100">
                <h3 class="text-2xl font-bold text-v4-text mb-4">Acara Mendatang</h3>
                {{-- <x-event-card :activities="$acaraMendatang ?? []" :compact="true" /> --}}
            </div>
        </div>
    </div>
</div>

<script src="https://unpkg.com/lucide@latest"></script>
<script>
document.addEventListener('DOMContentLoaded', () => {
    if (typeof lucide !== 'undefined') {
        lucide.createIcons();
    }
});
</script>
@endsection
