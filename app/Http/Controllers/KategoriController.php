<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KategoriController extends Controller
{
    public function index()
    {
        $semuaKategori = Kategori::latest()->get();
        return view('admin.kategori.index', compact('semuaKategori'));
    }

    public function create()
    {
        return view('admin.kategori.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|string|unique:kategori|max:255',
            'deskripsi' => 'nullable|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('gambar')) {
            $path = $request->file('gambar')->store('kategori', 'public');
            $data['gambar'] = $path;
        }

        Kategori::create($data);

        return redirect()->route('admin.kategori.index')
                         ->with('success', 'Kategori berhasil ditambahkan.');
    }
    
    public function edit(Kategori $kategori)
    {
        return view('admin.kategori.edit', compact('kategori'));
    }

    public function update(Request $request, Kategori $kategori)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255|unique:kategori,nama_kategori,' . $kategori->id,
            'deskripsi' => 'nullable|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('gambar')) {
            if ($kategori->gambar) {
                Storage::disk('public')->delete($kategori->gambar);
            }
            $path = $request->file('gambar')->store('kategori', 'public');
            $data['gambar'] = $path;
        }

        $kategori->update($data);

        return redirect()->route('admin.kategori.index')
                         ->with('success', 'Kategori berhasil diperbarui.');
    }

    public function destroy(Kategori $kategori)
    {
        if ($kategori->gambar) {
            Storage::disk('public')->delete($kategori->gambar);
        }
        $kategori->delete();

        return redirect()->route('admin.kategori.index')
                         ->with('success', 'Kategori berhasil dihapus.');
    }

    // Method untuk halaman publik
    public function indexPublic()
    {
        $semuaKategori = Kategori::orderBy('nama_kategori')->get();
        return view('kategori-index', ['semuaKategori' => $semuaKategori]);
    }

    public function show(Kategori $kategori)
    {
        $destinasi = $kategori->wisata()->latest()->paginate(9);
        return view('kategori-show', ['kategori' => $kategori, 'destinasi' => $destinasi]);
    }
}
