<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\KontenStatis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // -------------------------------
    // LOGIN
    // -------------------------------
    public function loginPage()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            
            // Update last login
            Auth::user()->update(['last_login_at' => now()]);
            
            // Cek apakah user adalah admin
            if (Auth::user()->is_admin) {
                return redirect()->route('admin.dashboard');
            }
            
            return redirect()->intended('/dashboard');
        }

        return back()->withErrors([
            'email' => 'Email atau password salah!',
        ])->onlyInput('email');
    }

    // -------------------------------
    // REGISTER
    // -------------------------------
    public function registerPage()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        Auth::login($user);
        $request->session()->regenerate();

        return redirect('/dashboard')->with('success', 'Registrasi berhasil!');
    }

    // -------------------------------
    // FORGOT PASSWORD
    // -------------------------------
    public function forgotPasswordPage()
    {
        return view('auth.forgot-password');
    }

    public function forgotPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->with('error', 'Email tidak ditemukan!');
        }

        // Simpan email untuk proses reset
        session(['reset_email' => $request->email]);
        return redirect('/change-password')->with('info', 'Email terverifikasi! Silakan ubah kata sandi.');
    }

    // -------------------------------
    // CHANGE PASSWORD
    // -------------------------------
    public function changePasswordPage()
    {
        if (!session()->has('reset_email')) {
            return redirect('/forgot-password')->with('error', 'Akses ditolak. Harap verifikasi email dulu.');
        }

        return view('auth.change-password');
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'new_password' => 'required|min:6',
            'confirm_password' => 'required|same:new_password',
        ]);

        $user = User::where('email', session('reset_email'))->first();

        if (!$user) {
            return redirect('/login')->with('error', 'User tidak ditemukan!');
        }

        $user->update([
            'password' => Hash::make($request->new_password),
        ]);

        session()->forget('reset_email');

        return redirect('/login')->with('success', 'Kata sandi berhasil diubah!');
    }

    // -------------------------------
    // DASHBOARD
    // -------------------------------
    public function dashboard()
    {
        $user = Auth::user();

        if (!$user) {
            return redirect('/login');
        }

        // Ambil aktivitas terdekat milik user
        $acaraMendatang = $user->activities()
            ->orderBy('date')
            ->orderBy('time')
            ->take(3)
            ->get();

        // Ambil semua aktivitas untuk kalender
        $semua_aktivitas = $user->activities()
            ->orderBy('date')
            ->get();

        // Ambil konten statis
        $kontenStatis = KontenStatis::pluck('value', 'key');

        return view('pages.dash', [
            'acaraMendatang' => $acaraMendatang,
            'semua_aktivitas' => $semua_aktivitas,
            'kontenStatis' => $kontenStatis,
        ]);
    }

    // -------------------------------
    // PROFIL USER
    // -------------------------------
    public function profile()
    {
        $user = Auth::user();

        if (!$user) {
            return redirect('/login')->with('error', 'Silakan login terlebih dahulu.');
        }

        // Ambil konten statis
        $kontenStatis = KontenStatis::pluck('value', 'key');

        return view('pages.profile', compact('user', 'kontenStatis'));
    }

    // -------------------------------
    // LOGOUT
    // -------------------------------
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('info', 'Kamu sudah logout.');
    }
}
