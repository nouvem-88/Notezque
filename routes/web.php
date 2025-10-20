<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    DashboardController,
    LandingController,
    KalenderController,
    AdminDashboardController,
    AuthController,
    TugasController,
    MateriController
};

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/
Route::get('/', [LandingController::class, 'index'])->name('landing');

/*
|--------------------------------------------------------------------------
| User Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['web'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Kalender Module
    Route::controller(KalenderController::class)->prefix('kalender')->name('kalender.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/', 'store')->name('store');
        Route::post('/delete', 'delete')->name('delete');
    });
});

// Login
Route::get('/login', [AuthController::class, 'loginPage'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

// Register
Route::get('/register', [AuthController::class, 'registerPage'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');

// Forgot & Change Password
Route::get('/forgot-password', [AuthController::class, 'forgotPasswordPage'])->name('forgot');
Route::post('/forgot-password', [AuthController::class, 'forgotPassword'])->name('forgot.post');

Route::get('/change-password', [AuthController::class, 'changePasswordPage'])->name('change');
Route::post('/change-password', [AuthController::class, 'changePassword'])->name('change.post');

// Logout
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// -------------------------------
// 🔹 Dashboard (Butuh Login)
// -------------------------------
Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');

// Catatan
Route::get('/catatan', function () {
    return view('catatan.index');
})->name('catatan');

// -------------------------------
// 🔹 Profil Dinamis
// -------------------------------
Route::get('/profile', [AuthController::class, 'profile'])->name('profile');

use App\Http\Controllers\CatatanController;

// Catatan (tanpa database, pakai session)
Route::get('/catatan', [CatatanController::class, 'index'])->name('catatan');
Route::post('/catatan/tambah', [CatatanController::class, 'store'])->name('catatan.store');
Route::post('/catatan/edit/{id}', [CatatanController::class, 'update'])->name('catatan.update');
Route::get('/catatan/hapus/{id}', [CatatanController::class, 'destroy'])->name('catatan.delete');

/*
|--------------------------------------------------------------------------
| Materi Routes
|--------------------------------------------------------------------------
*/
Route::get('/materi', [MateriController::class, 'index'])->name('materi');

/*
|--------------------------------------------------------------------------
| Tugas Routes
|--------------------------------------------------------------------------
*/
Route::get('/tugas', [TugasController::class, 'index'])->name('kelola-tugas');

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/
Route::controller(AdminDashboardController::class)->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', 'index')->name('dashboard');
    Route::get('/users', 'users')->name('users');
    Route::get('/content', 'content')->name('content');
    Route::get('/statistics', 'statistics')->name('statistics');
});


