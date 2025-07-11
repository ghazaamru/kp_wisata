<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\WisataController;
use App\Http\Controllers\SektorPendukungController;
use App\Http\Controllers\KategoriController;
use Illuminate\Support\Facades\Route;

// Route Halaman Utama (Publik)
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/destinasi/{wisata}', [WisataController::class, 'show'])->name('destinasi.show');


// Route Otentikasi
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.process');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


// Grup untuk route yang memerlukan login
Route::middleware(['auth'])->group(function () {

    // Route untuk Super Admin Dashboard
    Route::get('/admin/dashboard', function () {
        if (auth()->user()->role !== 'superadmin') abort(403);
        return view('admin.dashboard');
    })->name('admin.dashboard'); // <-- Pastikan ini ada

    // Route untuk Contributor Dashboard
    Route::get('/contributor/dashboard', function () {
        if (auth()->user()->role !== 'contributor') abort(403);
        return view('contributor.dashboard');
    })->name('contributor.dashboard'); // <-- INI YANG MENYEBABKAN ERROR, PASTIKAN ADA

    // Route untuk Manajemen Wisata
    Route::resource('/admin/wisata', WisataController::class)->parameters([
    'wisata' => 'wisata'
    ])->names('admin.wisata');

    //route sektor pendukung
    Route::resource('wisata.sektor-pendukung', SektorPendukungController::class)->names('admin.wisata.sektor-pendukung');

    // Route untuk Manajemen Kategori
    Route::resource('/admin/kategori', KategoriController::class)->names('admin.kategori');

    
});