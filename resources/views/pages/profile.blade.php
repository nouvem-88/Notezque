@extends('layouts.main-nav')

@section('content')
<div class="p-8 bg-v4-background min-h-screen">
    <div class="flex items-center justify-between mb-8">
        <h1 class="text-3xl font-bold text-v4-text">Profil Saya</h1>
        <a href="/dashboard"
            class="text-sm font-semibold text-v4-primary hover:underline transition">
            ← Kembali ke Dashboard
        </a>
    </div>

    @php
        // Ambil data user dari session (biar dinamis)
        $user = session('user_data') ?? [
            'name' => 'Pengguna Default',
            'username' => 'notezque_user',
            'email' => 'user@notezque.test',
            'role' => 'User Default'
        ];
    @endphp

    <div class="bg-white rounded-2xl shadow-lg p-8 border border-gray-100 max-w-3xl mx-auto">
        <div class="flex flex-col md:flex-row md:items-center md:space-x-8">
            <div class="flex-shrink-0 mb-6 md:mb-0">
                <img src="https://placehold.co/120x120/A8A8E6/FFFFFF?text={{ strtoupper(substr($user['username'], 0, 1)) }}" 
                    alt="Profile Picture" 
                    class="rounded-full border-4 border-v4-secondary shadow-md">
            </div>

            <div class="flex-1 space-y-3">
                <h2 class="text-2xl font-bold text-v4-text">{{ $user['name'] }}</h2>
                <p class="text-gray-500 text-sm">Mahasiswa | Universitas Notezque</p>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-4">
                    <div>
                        <p class="text-gray-400 text-xs uppercase tracking-wide">Email</p>
                        <p class="text-sm font-medium text-v4-text">
    {{ is_array($user['email']) ? implode(', ', $user['email']) : $user['email'] }}
</p>
                    </div>
                    <div>
                        <p class="text-gray-400 text-xs uppercase tracking-wide">Username</p>
                        <p class="text-sm font-medium text-v4-text">{{ $user['username'] }}</p>
                    </div>
                    <div>
                        <p class="text-gray-400 text-xs uppercase tracking-wide">Role</p>
                        <p class="text-sm font-medium text-v4-text">{{ $user['role'] }}</p>
                    </div>
                    <div>
                        <p class="text-gray-400 text-xs uppercase tracking-wide">Password</p>
                        <p class="text-sm font-medium text-v4-text">********</p>
                    </div>
                </div>

                <div class="mt-6 flex flex-wrap gap-3">
                    <a href="/change-password"
                        class="px-5 py-2 bg-v4-primary text-white rounded-full text-sm font-semibold shadow-md hover:opacity-90 transition">
                        Ganti Kata Sandi
                    </a>
                    <a href="/logout"
                        class="px-5 py-2 border border-red-400 text-red-500 rounded-full text-sm font-semibold hover:bg-red-50 transition">
                        Keluar
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    if (typeof lucide !== 'undefined') lucide.createIcons();
});
</script>
@endsection
