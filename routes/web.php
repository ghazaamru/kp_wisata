<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\WisataController;
use App\Http\Controllers\SektorPendukungController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\PengaduanController;
use App\Http\Controllers\PengaturanController;
use App\Http\Controllers\GaleriController;
use App\Http\Controllers\SearchController;

// Import semua Model yang akan digunakan di dalam route
use App\Models\Wisata;
use App\Models\Kategori;
use App\Models\Event;
use App\Models\User;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// ===================================================
// ROUTE PUBLIK (Bisa diakses tanpa login)
// ===================================================
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/destinasi/{wisata}', [WisataController::class, 'show'])->name('destinasi.show');
Route::get('/kontak-kami', [PengaduanController::class, 'create'])->name('pengaduan.create');
Route::post('/kontak-kami', [PengaduanController::class, 'store'])->name('pengaduan.store');
Route::get('/search', [SearchController::class, 'index'])->name('search');
Route::get('/kategori/{kategori}', [KategoriController::class, 'show'])->name('kategori.show');


// ===================================================
// ROUTE OTENTIKASI
// ===================================================
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.process');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


// ===================================================
// ROUTE YANG WAJIB LOGIN (PANEL ADMIN)
// ===================================================
Route::middleware(['auth'])->group(function () {

    // Route untuk Dashboard
    Route::get('/admin/dashboard', function () {
        if (auth()->user()->role !== 'superadmin') abort(403);
        $stats = [
            'wisata' => Wisata::count(),
            'kategori' => Kategori::count(),
            'events' => Event::count(),
            'users' => User::count(),
        ];
        return view('admin.dashboard', compact('stats'));
    })->name('admin.dashboard');

    Route::get('/contributor/dashboard', function () {
        if (auth()->user()->role !== 'contributor') abort(403);
        $userId = auth()->id();
        $stats = [
            'wisata' => Wisata::where('user_id', $userId)->count(),
            'kategori' => Kategori::count(),
            'events' => Event::where('user_id', $userId)->count(),
        ];
        return view('contributor.dashboard', compact('stats'));
    })->name('contributor.dashboard');

    // Route untuk Manajemen Resource
    Route::resource('/admin/wisata', WisataController::class)->parameters(['wisata' => 'wisata'])->names('admin.wisata');
    
    // PERBAIKAN DI SINI: Mengubah cara definisi route nested
    Route::resource('/admin/wisata/{wisata}/sektor-pendukung', SektorPendukungController::class)->names('admin.wisata.sektor-pendukung');
    
    Route::resource('/admin/kategori', KategoriController::class)->names('admin.kategori');
    Route::resource('/admin/events', EventController::class)->names('admin.events');

    // Route Khusus Super Admin
    
        Route::get('/admin/pengaduan', [PengaduanController::class, 'indexAdmin'])->name('admin.pengaduan.index');
        Route::patch('/admin/pengaduan/{pengaduan}', [PengaduanController::class, 'updateStatus'])->name('admin.pengaduan.updateStatus');
        Route::get('/admin/pengaturan', [PengaturanController::class, 'index'])->name('admin.pengaturan.index');
        Route::post('/admin/pengaturan', [PengaturanController::class, 'update'])->name('admin.pengaturan.update');
    
    Route::get('/admin/wisata/{wisata}/galeri', [GaleriController::class, 'index'])->name('admin.galeri.index');
    Route::post('/admin/wisata/{wisata}/galeri', [GaleriController::class, 'store'])->name('admin.galeri.store');
    Route::delete('/admin/galeri/{id}', [GaleriController::class, 'destroy'])->name('admin.galeri.destroy');
});
