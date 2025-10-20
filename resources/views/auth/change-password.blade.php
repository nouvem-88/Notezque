@extends('layouts.topnav-landing')

@section('title', 'Ubah Kata Sandi | Notezque')

@section('content')
<div class="flex justify-center items-center min-h-[80vh]">
    <div class="bg-white p-8 rounded-2xl shadow-xl w-full max-w-md">
        <h2 class="text-2xl font-bold text-center text-v4-text mb-2">Ubah Kata Sandi</h2>
        <p class="text-center text-gray-500 mb-6">Masukkan kata sandi baru kamu.</p>

        @if (session('error'))
            <div class="bg-red-100 text-red-600 px-4 py-2 rounded-lg mb-4 text-sm">{{ session('error') }}</div>
        @endif
        @if (session('success'))
            <div class="bg-green-100 text-green-600 px-4 py-2 rounded-lg mb-4 text-sm">{{ session('success') }}</div>
        @endif

        <form action="{{ route('change.post') }}" method="POST">
            @csrf
            <div class="mb-5">
                <label class="block text-sm font-medium text-gray-600 mb-1">Password Baru</label>
                <input type="password" name="new_password" required
                    class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-v4-primary focus:outline-none">
            </div>

            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-600 mb-1">Konfirmasi Password Baru</label>
                <input type="password" name="confirm_password" required
                    class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-v4-primary focus:outline-none">
            </div>

            <button type="submit"
                class="w-full py-3 rounded-lg bg-v4-primary text-white font-semibold hover:opacity-90 transition">
                Simpan Kata Sandi
            </button>
        </form>

        <div class="text-center mt-4">
            <a href="/login" class="text-v4-primary text-sm hover:underline">Kembali ke Login</a>
        </div>
    </div>
</div>
@endsection
