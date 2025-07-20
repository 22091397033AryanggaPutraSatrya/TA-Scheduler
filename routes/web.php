<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController; // Ganti dengan controller Anda
use App\Http\Controllers\Auth\LoginController; // Ganti dengan controller Anda

// Route untuk MENAMPILKAN halaman registrasi
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');

// Route untuk MEMPROSES data registrasi yang dikirim dari form
Route::post('/register', [RegisterController::class, 'register']);

// Route untuk MENAMPILKAN halaman login
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');

// Route untuk MEMPROSES data login yang dikirim dari form
Route::post('/login', [LoginController::class, 'login']);

// Route untuk LOGOUT
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/', function () {
    return view('register');
});
