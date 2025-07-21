<?php

namespace App\Http\Controllers;

use App\Models\Wisata;
use App\Models\SektorPendukung;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SektorPendukungController extends Controller
{
    /**
     * Menampilkan daftar sektor pendukung untuk sebuah wisata.
     */
    public function index(Wisata $wisata)
    {
        $sektors = $wisata->sektorPendukung()->latest()->get();
        return view('admin.sektor_pendukung.index', compact('wisata', 'sektors'));
    }

    /**
     * Menampilkan form untuk membuat sektor pendukung baru.
     */
    public function create(Wisata $wisata)
    {
        return view('admin.sektor_pendukung.create', compact('wisata'));
    }

    /**
     * Menyimpan sektor pendukung baru ke database.
     */
    public function store(Request $request, Wisata $wisata)
    {
        $request->validate([
            'nama_sektor' => 'required|string|max:255',
            'jenis' => 'required|in:akomodasi,restoran,transportasi,atraksi,toko_suvenir,fasilitas_umum',
            'deskripsi' => 'nullable|string',
            'alamat' => 'required|string|max:255',
            'kontak' => 'nullable|string|max:255',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('gambar')) {
            $path = $request->file('gambar')->store('sektor-pendukung', 'public');
            $data['gambar'] = $path;
        }

        // Membuat data anak melalui relasi, 'wisata_id' akan terisi otomatis
        $wisata->sektorPendukung()->create($data);

        return redirect()->route('admin.wisata.sektor-pendukung.index', $wisata->id)
                         ->with('success', 'Sektor Pendukung berhasil ditambahkan.');
    }

    /**
     * Menampilkan form untuk mengedit sektor pendukung.
     * Note: Laravel secara otomatis akan mencocokkan {sektor_pendukung} dari URL
     * dengan variabel $sektorPendukung.
     */
    public function edit(Wisata $wisata, SektorPendukung $sektorPendukung)
    {
        return view('admin.sektor_pendukung.edit', compact('wisata', 'sektorPendukung'));
    }

    /**
     * Memperbarui sektor pendukung di database.
     */
    public function update(Request $request, Wisata $wisata, SektorPendukung $sektorPendukung)
    {
        $request->validate([
            'nama_sektor' => 'required|string|max:255',
            'jenis' => 'required|in:akomodasi,restoran,transportasi,atraksi,toko_suvenir,fasilitas_umum',
            'deskripsi' => 'nullable|string',
            'alamat' => 'required|string|max:255',
            'kontak' => 'nullable|string|max:255',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('gambar')) {
            if ($sektorPendukung->gambar) {
                Storage::disk('public')->delete($sektorPendukung->gambar);
            }
            $path = $request->file('gambar')->store('sektor-pendukung', 'public');
            $data['gambar'] = $path;
        }

        $sektorPendukung->update($data);

        return redirect()->route('admin.wisata.sektor-pendukung.index', $wisata->id)
                         ->with('success', 'Sektor Pendukung berhasil diperbarui.');
    }

    /**
     * Menghapus sektor pendukung dari database.
     */
    public function destroy(Wisata $wisata, SektorPendukung $sektorPendukung)
    {
        if ($sektorPendukung->gambar) {
            Storage::disk('public')->delete($sektorPendukung->gambar);
        }
        
        $sektorPendukung->delete();

        return redirect()->route('admin.wisata.sektor-pendukung.index', $wisata->id)
                         ->with('success', 'Sektor Pendukung berhasil dihapus.');
    }
}
