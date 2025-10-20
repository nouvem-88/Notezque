@extends('layouts.topnav-landing')
@section('title','Masuk | Notezque')
@section('content')
<div class="flex justify-center items-center min-h-[80vh]">
  <div class="bg-white p-8 rounded-2xl shadow-xl w-full max-w-md">
    <h2 class="text-2xl font-bold text-center text-v4-text mb-2">Masuk ke Akun Anda</h2>
    <p class="text-gray-500 text-center mb-6">Gunakan akun Notezque kamu untuk melanjutkan.</p>

    @if ($errors->any())
      <div class="mb-4 text-red-600 text-sm">
        {{ $errors->first() }}
      </div>
    @endif

    @if(session('status'))
      <div class="mb-4 text-green-600 text-sm">
        {{ session('status') }}
      </div>
    @endif

    <form action="{{ route('login.post') }}" method="POST">
      @csrf
      <div class="mb-4">
        <label class="block text-sm font-medium text-gray-600">Email</label>
        <input type="email" name="email" required value="{{ old('email') }}" class="mt-1 w-full border rounded-lg px-4 py-2 focus:ring-v4-primary focus:outline-none">
      </div>

      <div class="mb-4">
        <label class="block text-sm font-medium text-gray-600">Kata Sandi</label>
        <input type="password" name="password" required class="mt-1 w-full border rounded-lg px-4 py-2 focus:ring-v4-primary focus:outline-none">
      </div>

      <div class="flex justify-between items-center mb-6">
        <a href="{{ route('forgot') }}" class="text-sm text-v4-primary hover:underline">Lupa kata sandi?</a>
      </div>

      <button type="submit" class="w-full bg-v4-primary text-white py-2 rounded-lg hover:opacity-90 transition">
        Masuk
      </button>
    </form>

    <p class="text-sm text-center text-gray-500 mt-6">
      Belum punya akun? <a href="{{ route('register') }}" class="text-v4-primary font-semibold hover:underline">Daftar Sekarang</a>
    </p>
  </div>
</div>
@endsection
