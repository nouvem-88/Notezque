<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    private $defaultEmail = 'user@notezque.test';
    private $defaultPassword = 'password123';
    private $defaultUsername = 'notezque_user';
    private $defaultName = 'User NotezQu';

    public function __construct()
    {
        // Simpan password default ke session kalau belum ada
        if (!session()->has('user_password')) {
            session(['user_password' => $this->defaultPassword]);
        }
    }

    // -------------------------------
    // LOGIN
    // -------------------------------
    public function loginPage()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $email = $request->email;
        
        $password = $request->password;
        $savedPassword = session('user_password', $this->defaultPassword);

        // Cek login sederhana
        if ($email === $this->defaultEmail && $password === $savedPassword) {
            // Simpan info user ke session (pastikan email string tunggal)
            session([
                'user' => [
                    'name' => $this->defaultName,
                    'username' => $this->defaultUsername,
                    'email' => $this->defaultEmail,
                    'role' => 'User Default',
                ]
            ]);

            return redirect('/dashboard');
        } else if ($email === 'admin@notezque.org' && $password === "admin") {
            session([
                'admin' => [
                    'name' => 'admin',
                    'username' => 'admin',
                    'email' => 'admin@notezque.org',
                    'role' => 'admin'
                ]
            ]);
            return redirect('/admin/dashboard');
        }

        return back()->with('error', 'Email atau password salah!');
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
        // Simulasi register (belum nyimpen ke database)
        return redirect('/login')->with('success', 'Registrasi berhasil! Silakan login.');
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
        $email = $request->email;

        if ($email !== $this->defaultEmail) {
            return back()->with('error', 'Email tidak ditemukan!');
        }

        // Simulasi konfirmasi email
        session(['reset_email_verified' => true]);
        return redirect('/change-password')->with('info', 'Email terverifikasi! Silakan ubah kata sandi.');
    }

    // -------------------------------
    // CHANGE PASSWORD
    // -------------------------------
    public function changePasswordPage()
    {
        if (!session()->has('reset_email_verified')) {
            return redirect('/forgot-password')->with('error', 'Akses ditolak. Harap verifikasi email dulu.');
        }

        return view('auth.change-password');
    }

    public function changePassword(Request $request)
    {
        $newPass = $request->new_password;
        $confirm = $request->confirm_password;

        if ($newPass !== $confirm) {
            return back()->with('error', 'Konfirmasi password tidak sama!');
        }

        // Simpan password baru ke session
        session(['user_password' => $newPass]);
        session()->forget('reset_email_verified');

        return redirect('/login')->with('success', 'Kata sandi berhasil diubah!');
    }

    // -------------------------------
    // DASHBOARD
    // -------------------------------
    public function dashboard()
    {
        if (!session()->has('user')) {
            return redirect('/login');
        }

        // Ambil data aktivitas dari session atau config
        $all_aktivitas = Session::get('mock_aktivitas', config('users.aktivitas'));

        // Ambil semua acara dan urutkan berdasarkan tanggal (terdekat dulu)
        $acaraMendatang = collect($all_aktivitas)
            ->sortBy(function ($item) {
                // Urutkan berdasarkan tanggal dan waktu
                return $item['date'] . ' ' . ($item['time'] ?? '00:00');
            })
            ->take(3) // Batasi maksimal 3 acara untuk dashboard
            ->values() // Reset array keys agar berurutan dari 0
            ->toArray(); // Convert ke array untuk komponen

        // Kirim data yang sudah difilter dan diurutkan ke view
        return view('pages.dash', [
            'acaraMendatang' => $acaraMendatang,
            'semua_aktivitas' => $all_aktivitas, // Untuk komponen kalender
        ]);
    }

    // -------------------------------
    // PROFIL USER
    // -------------------------------
    public function profile()
    {
        $user = session('user');

        if (!$user || !is_array($user)) {
            return redirect('/login')->with('error', 'Silakan login terlebih dahulu.');
        }

        // Pastikan email tetap string (bukan array)
        if (is_array($user['email'])) {
            $user['email'] = $user['email'][0] ?? '';
        }

        return view('pages.profile', compact('user'));
    }

    // -------------------------------
    // LOGOUT
    // -------------------------------
    public function logout()
    {
        session()->forget(['user', 'user_password', 'reset_email_verified']);
        return redirect('/login')->with('info', 'Kamu sudah logout.');
    }
}
