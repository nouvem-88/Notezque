<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    /**
     * Halaman Dashboard Utama
     */
    public function index()
    {
        $users = collect(config('admin.users'))->take(5);
        
        return view('admin.dashboard', [
            'statistics' => config('admin.statistics'),
            'users' => $users,
            'recent_activities' => config('admin.activities')
        ]);
    }

    /**
     * Halaman Pengguna
     */
    public function users()
    {
        $users = collect(config('admin.users'));
        
        return view('admin.users', [
            'users' => $users,
            'total_users' => $users->count(),
            'active_users' => $users->where('status', 'Active')->count(),
            'inactive_users' => $users->where('status', 'Inactive')->count(),
            'pending_users' => $users->where('status', 'Pending')->count()
        ]);
    }

    /**
     * Halaman Konten Statis
     */
    public function content()
    {
        $contents = collect(config('admin.contents'));
        
        return view('admin.content', [
            'contents' => $contents,
            'total_content' => $contents->count(),
            'published_content' => $contents->where('status', 'Published')->count(),
            'draft_content' => $contents->where('status', 'Draft')->count(),
            'total_views' => $contents->sum('views')
        ]);
    }

    /**
     * Halaman Statistik
     */
    public function statistics()
    {
        $users = collect(config('admin.users'));
        
        return view('admin.statistics', [
            'daily_stats' => config('admin.daily_stats'),
            'category_stats' => config('admin.category_stats'),
            'top_users' => $users->sortByDesc('tasks_completed')->take(5)->values(),
            'summary' => config('admin.statistics')
        ]);
    }
}
