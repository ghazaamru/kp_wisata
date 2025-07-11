<?php

namespace App\Http\Controllers;

use App\Models\Wisata;
use App\Models\Kategori; // Nanti akan kita butuhkan untuk form
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WisataController extends Controller
{
    /**
     * Menampilkan daftar data wisata.
     */
   public function index()
    {
    $user = \Illuminate\Support\Facades\Auth::user();
    
    if ($user->role === 'superadmin') {
        // Menggunakan with() untuk Eager Loading, lebih efisien
        $semuaWisata = \App\Models\Wisata::with('user')->latest()->get();
    } 
    else {
        $semuaWisata = \App\Models\Wisata::where('user_id', $user->id)->latest()->get();
    }

    return view('admin.wisata.index', compact('semuaWisata'));
    }

    /**
     * Menampilkan form untuk membuat data baru.
     */
    public function create()
    {
        // $kategori = Kategori::all(); // Nanti untuk dropdown kategori
        // 1. Ambil semua data dari tabel 'kategori'
        $kategori = Kategori::all();

        // 2. Kirim data tersebut ke view menggunakan 'compact'
        return view('admin.wisata.create', compact('kategori'));
    }

    /**
     * Menyimpan data baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_obyek_wisata' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'lokasi' => 'required|string',
            // 'kategori_id' => 'required|exists:kategori,id',
        ]);

        $wisata = new Wisata($request->all());
        $wisata->user_id = Auth::id(); // Set user_id dari user yang login
        //$wisata->kategori_id = 1; // Placeholder, ganti dengan data dari form
        $wisata->save();

        return redirect()->route('admin.wisata.index')
                         ->with('success', 'Data wisata berhasil ditambahkan.');
    }

    /**
     * Menampilkan form untuk mengedit data.
     */
    public function edit(\App\Models\Wisata $wisata)
{
    // Otorisasi: Hanya superadmin atau pemilik data yang boleh edit
    if (auth()->user()->role !== 'superadmin' && $wisata->user_id !== auth()->id()) {
        abort(403, 'AKSES DITOLAK');
    }

    $kategori = \App\Models\Kategori::all();

    // Pastikan Anda mengirim $wisata yang di-inject oleh Laravel, bukan yang lain.
    // Jangan ada baris seperti $wisata = new Wisata() di sini.
    return view('admin.wisata.edit', compact('wisata', 'kategori'));
}

    /**
     * Memperbarui data di database.
     */
    public function update(Request $request, Wisata $wisata)
    {
        // Otorisasi: Hanya superadmin atau pemilik data yang boleh update
        if (Auth::user()->role !== 'superadmin' && $wisata->user_id !== Auth::id()) {
            abort(403, 'AKSES DITOLAK');
        }

        $request->validate([
            'nama_obyek_wisata' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'lokasi' => 'required|string',
        ]);

        $wisata->update($request->all());

        return redirect()->route('admin.wisata.index')
                         ->with('success', 'Data wisata berhasil diperbarui.');
    }

    /**
     * Menghapus data dari database.
     */
    public function destroy(Wisata $wisata)
    {
        // Otorisasi: Hanya superadmin atau pemilik data yang boleh hapus
        if (Auth::user()->role !== 'superadmin' && $wisata->user_id !== Auth::id()) {
            abort(403, 'AKSES DITOLAK');
        }

        $wisata->delete();
        return redirect()->route('admin.wisata.index')
                         ->with('success', 'Data wisata berhasil dihapus.');
    }
}