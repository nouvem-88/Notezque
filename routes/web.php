<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    LandingController,
    KalenderController,
    AuthController,
    TugasController,
    MateriController,
    CatatanController
};

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/
Route::get('/', [LandingController::class, 'index'])->name('landing');

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

// Protected Routes (requires authentication)
Route::middleware('auth')->group(function () {
    // Logout
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

    // Dashboard
    Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');

    // Profile
    Route::get('/profile', [AuthController::class, 'profile'])->name('profile');

    // Catatan Routes
    Route::get('/catatan', [CatatanController::class, 'index'])->name('catatan');
    Route::post('/catatan/tambah', [CatatanController::class, 'store'])->name('catatan.store');
    Route::post('/catatan/edit/{id}', [CatatanController::class, 'update'])->name('catatan.update');
    Route::get('/catatan/hapus/{id}', [CatatanController::class, 'destroy'])->name('catatan.delete');

    // Tugas Routes
    Route::controller(TugasController::class)->prefix('tugas')->name('tugas.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/', 'store')->name('store');
        Route::put('/{id}', 'update')->name('update');
        Route::patch('/{id}/complete', 'complete')->name('complete');
        Route::delete('/{id}', 'destroy')->name('destroy');
    });

    // Kalender Routes
    Route::controller(KalenderController::class)->prefix('kalender')->name('kalender.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/', 'store')->name('store');
        Route::put('/{id}', 'update')->name('update');
        Route::delete('/{id}', 'destroy')->name('destroy');
    });

    // Materi Routes
    Route::get('/materi', [MateriController::class, 'index'])->name('materi');
});
