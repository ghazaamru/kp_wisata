<?php

namespace App\Http\Controllers;

use App\Models\Wisata;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class WisataController extends Controller
{
    /**
     * Menampilkan daftar data wisata.
     */
    public function index()
    {
        $user = Auth::user();
        
        if ($user->role === 'superadmin') {
            $semuaWisata = Wisata::with('user')->latest()->get();
        } 
        else {
            $semuaWisata = Wisata::where('user_id', $user->id)->latest()->get();
        }

        return view('admin.wisata.index', compact('semuaWisata'));
    }

    /**
     * Menampilkan form untuk membuat data baru.
     */
    public function create()
    {
        $kategori = Kategori::all();
        return view('admin.wisata.create', compact('kategori'));
    }

    /**
     * Menyimpan data baru ke database.
     * INI ADALAH SATU-SATUNYA METHOD STORE YANG BENAR
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_obyek_wisata' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'lokasi' => 'required|string',
            'kategori_id' => 'required|exists:kategori,id',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi gambar
        ]);

        $data = $request->all();

        // Cek jika ada file gambar yang di-upload
        if ($request->hasFile('gambar')) {
            // Simpan gambar ke storage/app/public/wisata dan simpan path-nya
            $path = $request->file('gambar')->store('wisata', 'public');
            $data['gambar'] = $path;
        }

        $data['user_id'] = Auth::id();
        Wisata::create($data);

        return redirect()->route('admin.wisata.index')
                         ->with('success', 'Data wisata berhasil ditambahkan.');
    }

    /**
     * Menampilkan form untuk mengedit data.
     */
    public function edit(Wisata $wisata)
    {
        // Otorisasi: Hanya superadmin atau pemilik data yang boleh edit
        if (auth()->user()->role !== 'superadmin' && $wisata->user_id !== auth()->id()) {
            abort(403, 'AKSES DITOLAK');
        }

        $kategori = Kategori::all();
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
            'kategori_id' => 'required|exists:kategori,id',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();

        // Cek jika ada file gambar baru yang di-upload
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($wisata->gambar) {
                Storage::disk('public')->delete($wisata->gambar);
            }

            // Simpan gambar baru dan update path-nya
            $path = $request->file('gambar')->store('wisata', 'public');
            $data['gambar'] = $path;
        }

        $wisata->update($data);

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

        // Hapus juga gambar dari storage saat data dihapus
        if ($wisata->gambar) {
            Storage::disk('public')->delete($wisata->gambar);
        }

        $wisata->delete();
        return redirect()->route('admin.wisata.index')
                         ->with('success', 'Data wisata berhasil dihapus.');
    }

    /**
     * Menampilkan halaman detail untuk satu wisata.
     */
    public function show(Wisata $wisata)
    {
        // Mengirim data wisata yang dipilih ke view 'destinasi-detail'
        return view('destinasi-detail', compact('wisata'));
    }
}
