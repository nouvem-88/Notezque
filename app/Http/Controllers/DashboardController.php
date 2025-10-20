<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class DashboardController extends Controller
{
    private function getAktivitas()
    {
        return Session::get('mock_aktivitas', config('users.aktivitas'));
    }

    public function index()
    {
        $all_aktivitas = $this->getAktivitas();

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
}
