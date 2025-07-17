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

// Tambahkan use statement untuk Model yang akan digunakan
use App\Models\Wisata;
use App\Models\Kategori;
use App\Models\Event;
use App\Models\User;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// ROUTE PUBLIK (Bisa diakses tanpa login)
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/destinasi/{wisata}', [WisataController::class, 'show'])->name('destinasi.show');
Route::get('/kontak-kami', [PengaduanController::class, 'create'])->name('pengaduan.create');
Route::post('/kontak-kami', [PengaduanController::class, 'store'])->name('pengaduan.store');

// ROUTE OTENTIKASI
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.process');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


// ROUTE YANG WAJIB LOGIN
Route::middleware(['auth'])->group(function () {

    // Route untuk Super Admin Dashboard (VERSI BARU)
    Route::get('/admin/dashboard', function () {
        if (auth()->user()->role !== 'superadmin') abort(403);

        // Ambil data statistik untuk admin
        $stats = [
            'wisata' => Wisata::count(),
            'kategori' => Kategori::count(),
            'events' => Event::count(),
            'users' => User::count(),
        ];

        return view('admin.dashboard', compact('stats'));
    })->name('admin.dashboard');

    // Route untuk Contributor Dashboard (VERSI BARU)
    Route::get('/contributor/dashboard', function () {
        if (auth()->user()->role !== 'contributor') abort(403);
        $userId = auth()->id();

        // Ambil data statistik khusus untuk kontributor
        $stats = [
            'wisata' => Wisata::where('user_id', $userId)->count(),
            'kategori' => Kategori::count(),
            'events' => Event::where('user_id', $userId)->count(),
        ];
        return view('contributor.dashboard', compact('stats'));
    })->name('contributor.dashboard');

    // Route untuk Manajemen Wisata
    Route::resource('/admin/wisata', WisataController::class)->parameters([
        'wisata' => 'wisata'
    ])->names('admin.wisata');

    // Route Sektor Pendukung
    Route::resource('wisata.sektor-pendukung', SektorPendukungController::class)->names('admin.wisata.sektor-pendukung');

    // Route untuk Manajemen Kategori
    Route::resource('/admin/kategori', KategoriController::class)->names('admin.kategori');

    //Route untuk manajemen events
    Route::resource('/admin/events', EventController::class)->names('admin.events');

    // ROUTE UNTUK MANAJEMEN PENGADUAN (KHUSUS SUPER ADMIN)
    Route::get('/admin/pengaduan', [PengaduanController::class, 'indexAdmin'])->name('admin.pengaduan.index');
    Route::patch('/admin/pengaduan/{pengaduan}', [PengaduanController::class, 'updateStatus'])->name('admin.pengaduan.updateStatus');

    Route::get('/admin/pengaturan', [PengaturanController::class, 'index'])->name('admin.pengaturan.index');
    Route::post('/admin/pengaturan', [PengaturanController::class, 'update'])->name('admin.pengaturan.update');
});
