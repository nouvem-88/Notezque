<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Catatan; // asumsi model ada
use App\Models\Materi;
use Illuminate\Support\Facades\DB;

class AdminStatistikController extends Controller
{
    public function index(Request $req)
    {
        // contoh metric sederhana
        $totalUsers = User::count();
        $activeUsers = User::whereNotNull('last_login_at')
                          ->where('last_login_at', '>=', now()->subDays(7))
                          ->count();
        $totalCatatan = \App\Models\Note::count();
        $totalMateri = 0; // Bisa ditambahkan jika ada model Materi

        // events per day (notes created by date)
        $events = \DB::table('notes')
            ->select(\DB::raw('DATE(created_at) as date'), \DB::raw('count(*) as cnt'))
            ->groupBy('date')
            ->orderBy('date', 'desc')
            ->limit(14)
            ->get();

        return view('admin.statistik.index', compact('totalUsers', 'activeUsers', 'totalCatatan', 'totalMateri', 'events'));
    }
}
