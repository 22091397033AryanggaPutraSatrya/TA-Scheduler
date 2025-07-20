<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Dosen\BimbinganController as DosenBimbinganController;
use App\Http\Controllers\Dosen\JadwalController as DosenJadwalController;
use App\Http\Controllers\Mahasiswa\BookingController as MahasiswaBookingController;
use App\Http\Controllers\Mahasiswa\DraftController as MahasiswaDraftController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Di sini Anda dapat mendaftarkan rute web untuk aplikasi Anda. Rute-rute
| ini dimuat oleh RouteServiceProvider dan semuanya akan
| ditugaskan ke grup middleware "web". Buat sesuatu yang hebat!
|
*/

// Route Halaman Awal
Route::get('/', function () {
    // Jika tamu, arahkan ke login. Jika sudah login, arahkan ke dashboard.
    return redirect()->guest(route('login'));
});

// === ROUTE UNTUK TAMU (GUEST) ===
// Grup route ini hanya bisa diakses jika pengguna BELUM login
Route::middleware('guest')->group(function () {
    // Registrasi
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);

    // Login
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
});


// === ROUTE UNTUK PENGGUNA TERAUTENTIKASI ===
// Grup route ini hanya bisa diakses jika pengguna SUDAH login
Route::middleware('auth')->group(function () {
    // Logout
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    // Dashboard utama yang akan mengarahkan berdasarkan role
    Route::get('/dashboard', DashboardController::class)->name('dashboard');

    // --- GRUP ROUTE UNTUK MAHASISWA ---
    Route::middleware('role:mahasiswa')->prefix('mahasiswa')->name('mahasiswa.')->group(function () {
        // Booking Bimbingan
        Route::get('/booking', [MahasiswaBookingController::class, 'index'])->name('booking');
        Route::post('/booking', [MahasiswaBookingController::class, 'store'])->name('booking.store');
        Route::get('/booking/slots', [MahasiswaBookingController::class, 'fetchAvailableSlots'])->name('booking.slots');
        
        // Draft Tugas Akhir
        Route::get('/draft', [MahasiswaDraftController::class, 'index'])->name('draft.index');
        Route::post('/draft', [MahasiswaDraftController::class, 'store'])->name('draft.store');
    });

    // --- GRUP ROUTE UNTUK DOSEN ---
    Route::middleware('role:dosen')->prefix('dosen')->name('dosen.')->group(function () {
        // Manajemen Jadwal
        Route::get('/jadwal', [DosenJadwalController::class, 'index'])->name('jadwal.index');
        Route::post('/jadwal', [DosenJadwalController::class, 'store'])->name('jadwal.store');
        Route::delete('/jadwal/{jadwal}', [DosenJadwalController::class, 'destroy'])->name('jadwal.destroy');

        // Manajemen Bimbingan (Booking)
        Route::get('/bimbingan', [DosenBimbinganController::class, 'index'])->name('bimbingan.index');
        Route::patch('/bimbingan/{bimbingan}', [DosenBimbinganController::class, 'update'])->name('bimbingan.update');
    });

    // Anda bisa menambahkan grup untuk 'admin' di sini jika diperlukan
    // Route::middleware('role:admin')->prefix('admin')->name('admin.')->group(function () {
    //     // ... route admin
    // });
});