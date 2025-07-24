<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    // Menampilkan semua kategori
    public function index()
    {
        $semuaKategori = Kategori::latest()->get();
        return view('admin.kategori.index', compact('semuaKategori'));
    }

    // menampilkan satu kategori
    public function show(Kategori $kategori)
        {
            // Ambil semua wisata yang memiliki kategori_id ini, dengan pagination
            $destinasi = $kategori->wisata()->latest()->paginate(9);

            // Kirim data kategori dan destinasi ke view baru
            return view('kategori-show', [
                'kategori' => $kategori,
                'destinasi' => $destinasi,
            ]);
        }

    // Menampilkan form tambah kategori
    public function create()
    {
        return view('admin.kategori.create');
    }

    // Menyimpan kategori baru
    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|string|unique:kategori|max:255',
            'deskripsi' => 'nullable|string',
        ]);

        Kategori::create($request->all());

        return redirect()->route('admin.kategori.index')
                         ->with('success', 'Kategori berhasil ditambahkan.');
    }
    
    // Menampilkan form edit
    public function edit(Kategori $kategori)
    {
        return view('admin.kategori.edit', compact('kategori'));
    }

    // Memperbarui kategori
    public function update(Request $request, Kategori $kategori)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255|unique:kategori,nama_kategori,' . $kategori->id,
            'deskripsi' => 'nullable|string',
        ]);

        $kategori->update($request->all());

        return redirect()->route('admin.kategori.index')
                         ->with('success', 'Kategori berhasil diperbarui.');
    }

    // Menghapus kategori
    public function destroy(Kategori $kategori)
    {
        $kategori->delete();

        return redirect()->route('admin.kategori.index')
                         ->with('success', 'Kategori berhasil dihapus.');
    }
}