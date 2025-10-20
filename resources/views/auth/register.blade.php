@extends('layouts.topnav-landing')

@section('title', 'Daftar Akun | Notezque')

@section('content')
<div class="flex justify-center items-center min-h-[80vh]">
  <div class="bg-white p-8 rounded-2xl shadow-xl w-full max-w-md">
    <h2 class="text-2xl font-bold text-center text-v4-text mb-2">Buat Akun Baru</h2>
    <p class="text-gray-500 text-center mb-6">Daftar untuk mulai menggunakan Notezque.</p>

    <form action="{{ url('/login') }}" method="GET">
      <div class="mb-4">
        <label class="block text-sm font-medium text-gray-600">Nama</label>
        <input type="text" required class="mt-1 w-full border rounded-lg px-4 py-2 focus:ring-v4-primary focus:outline-none">
      </div>

      <div class="mb-4">
        <label class="block text-sm font-medium text-gray-600">Email</label>
        <input type="email" required class="mt-1 w-full border rounded-lg px-4 py-2 focus:ring-v4-primary focus:outline-none">
      </div>

      <div class="mb-6">
        <label class="block text-sm font-medium text-gray-600">Kata Sandi</label>
        <input type="password" required class="mt-1 w-full border rounded-lg px-4 py-2 focus:ring-v4-primary focus:outline-none">
      </div>

      <button type="submit" class="w-full bg-v4-primary text-white py-2 rounded-lg hover:opacity-90 transition">
        Daftar Sekarang
      </button>
    </form>

    <p class="text-sm text-center text-gray-500 mt-6">
      Sudah punya akun? <a href="{{ url('/login') }}" class="text-v4-primary font-semibold hover:underline">Masuk di sini</a>
    </p>
  </div>
</div>
@endsection
