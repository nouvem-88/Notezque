<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        // Ambil semua aktivitas user dari database
        $all_aktivitas = Auth::user()->activities;

        // Ambil acara mendatang (max 3) untuk dashboard
        $acaraMendatang = $all_aktivitas
            ->filter(function ($activity) {
                return \Carbon\Carbon::parse($activity->date)->isFuture() || \Carbon\Carbon::parse($activity->date)->isToday();
            })
            ->sortBy(function ($activity) {
                return $activity->date . ' ' . ($activity->time ?? '00:00');
            })
            ->take(3)
            ->values();

        // Kirim data ke view
        return view('pages.dash', [
            'acaraMendatang' => $acaraMendatang,
            'semua_aktivitas' => $all_aktivitas,
        ]);
    }
}
