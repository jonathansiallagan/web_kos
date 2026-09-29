<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\GoogleController;

use App\Http\Controllers\UserController;
use App\Http\Controllers\KamarController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PenghuniController;
use App\Http\Controllers\KeuanganController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\MidtransController;
use App\Http\Controllers\TagihanController;

use App\Http\Controllers\UserDashboardController;
use App\Http\Controllers\UserTagihanController;
use App\Http\Controllers\UserLaporanController;
use App\Http\Controllers\PemesananController;
use App\Http\Controllers\NotificationController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// 🏠 Halaman awal diarahkan ke login
Route::get('/', fn() => redirect()->route('login'));


// 🔐 AUTH ROUTES
Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('/login', [AuthenticatedSessionController::class, 'store']);
Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
Route::post('/register', [RegisteredUserController::class, 'store']);
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

// ✉️ Forgot & Reset Password
Route::get('/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('/reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password', [ResetPasswordController::class, 'reset'])->name('password.update');


// 📌 Google Login
Route::get('/auth/google', [GoogleController::class, 'redirect'])->name('google.redirect');
Route::get('/auth/google/callback', [GoogleController::class, 'callback'])->name('google.callback');


// 👑 =======================================================
//                       ADMIN AREA
// ==========================================================
Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->group(function () {

        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // CRUD Kamar
        Route::get('/kamar', [KamarController::class, 'index'])->name('tables');
        Route::get('/kamar/create', [KamarController::class, 'create'])->name('kamar.create');
        Route::post('/kamar', [KamarController::class, 'store'])->name('kamar.store');
        Route::get('/kamar/{kamar}', [KamarController::class, 'show'])->name('kamar.show');
        Route::get('/kamar/{kamar}/edit', [KamarController::class, 'edit'])->name('kamar.edit');
        Route::match(['put', 'patch'], '/kamar/{kamar}', [KamarController::class, 'update'])->name('kamar.update');
        Route::delete('/kamar/{kamar}', [KamarController::class, 'destroy'])->name('kamar.destroy');

        // PENGHUNI AREA
        Route::get('/penghuni', [PenghuniController::class, 'index'])->name('penghuni.index');
        Route::get('/penghuni/create', [PenghuniController::class, 'create'])->name('penghuni.create');
        Route::post('/penghuni', [PenghuniController::class, 'store'])->name('penghuni.store');
        Route::delete('/penghuni/{kamar}', [PenghuniController::class, 'destroy'])->name('penghuni.destroy');
        Route::post('/penghuni/approve/{pemesanan}', [PenghuniController::class, 'approve'])->name('penghuni.approve');
        Route::delete('/penghuni/reject/{pemesanan}', [PenghuniController::class, 'reject'])->name('penghuni.reject');
        Route::post('/penghuni/{id}/lunas', [PenghuniController::class, 'markLunas'])->name('penghuni.markLunas');

        // PEMESANAN
        Route::get('/pemesanan', [PemesananController::class, 'index'])->name('pemesanan.index');
        Route::post('/pemesanan', [PemesananController::class, 'store'])->name('pemesanan.store');
        Route::get('/pemesanan/{pemesanan}', [PemesananController::class, 'show'])->name('admin.pemesanan.show');

        // KEUANGAN
        Route::get('/keuangan', [KeuanganController::class, 'index'])->name('keuangan.index');
        Route::post('/keuangan/pengeluaran', [KeuanganController::class, 'storePengeluaran'])->name('keuangan.storePengeluaran');

        // LAPORAN
        Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
        Route::get('/laporan/create', [LaporanController::class, 'create'])->name('laporan.create');
        Route::post('/laporan', [LaporanController::class, 'store'])->name('laporan.store');
        Route::patch('/laporan/{laporan}', [LaporanController::class, 'updateStatus'])->name('laporan.updateStatus');
        Route::delete('/laporan/{laporan}', [LaporanController::class, 'destroy'])->name('laporan.destroy');

        // MANAJEMEN USER
        Route::get('/user-management', [UserController::class, 'index'])->name('user.index');
        Route::get('/user-management/{user}/edit', [UserController::class, 'edit'])->name('user.edit');
        Route::patch('/user-management/{user}', [UserController::class, 'update'])->name('user.update');
        Route::delete('/user-management/{user}', [UserController::class, 'destroy'])->name('user.destroy');

        // TAGIHAN
        Route::get('/tagihan', [TagihanController::class, 'index'])->name('tagihan.index');
        Route::post('/tagihan/generate', [TagihanController::class, 'generate'])->name('tagihan.generate');
        Route::get('/tagihan/{tagihan}/bayar', [TagihanController::class, 'bayar'])->name('tagihan.bayar');
        Route::patch('/tagihan/{tagihan}', [TagihanController::class, 'update'])->name('tagihan.update');

        // NOTIFIKASI ADMIN
        Route::get('/notifications', [NotificationController::class, 'adminIndex'])
            ->name('admin.notifications.index');
    });


// 👤 =======================================================
//                       USER AREA
// ==========================================================
Route::middleware(['auth', 'role:user'])
    ->prefix('user')
    ->name('user.')
    ->group(function () {

        Route::get('/home', [UserDashboardController::class, 'index'])->name('home');

        // TAGIHAN USER
        Route::get('/tagihan', [UserTagihanController::class, 'index'])->name('tagihan.index');
        Route::get('/tagihan/{tagihan}/bayar', [UserTagihanController::class, 'bayar'])->name('tagihan.bayar');

        // LAPORAN USER
        Route::get('/laporan/create', [LaporanController::class, 'create'])->name('laporan.create');
        Route::post('/laporan', [LaporanController::class, 'store'])->name('laporan.store');

        // PEMESANAN USER
        Route::post('/pemesanan', [PemesananController::class, 'store'])->name('pemesanan.store');

        // NOTIFIKASI USER
        Route::get('/notifications', [NotificationController::class, 'userIndex'])
            ->name('notifications.index');
    });


// 👤 =======================================================
//               PROFILE + NOTIFIKASI GLOBAL
// ==========================================================
Route::middleware(['auth'])->group(function () {

    // PROFILE
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');

    // NOTIFIKASI GLOBAL
    Route::post('/notifications/mark-read', [NotificationController::class, 'markAllRead'])
        ->name('notifications.markRead');
});


// 🌐 MIDTRANS CALLBACK & REDIRECT
Route::middleware(['auth'])->group(function () {
    Route::get('/midtrans/finish', [MidtransController::class, 'finish'])->name('midtrans.finish');
    Route::get('/midtrans/unfinish', [MidtransController::class, 'unfinish'])->name('midtrans.unfinish');
    Route::get('/midtrans/error', [MidtransController::class, 'error'])->name('midtrans.error');
});

// Snap token (AJAX)
Route::post('/get-snap-token', [UserTagihanController::class, 'getSnapToken']);
