<?php

namespace App\Http\Controllers;

use App\Models\Wisata;
use App\Models\GaleriWisata;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GaleriController extends Controller
{
   // Menampilkan halaman manajemen galeri untuk satu wisata
        public function index(Wisata $wisata)
        {
            return view('admin.galeri.index', compact('wisata'));
        }

        // Menyimpan gambar baru yang di-upload
        public function store(Request $request, Wisata $wisata)
        {
            $request->validate([
                'gambar' => 'required',
                'gambar.*' => 'image|mimes:jpeg,png,jpg|max:2048'
            ]);

            if ($request->hasFile('gambar')) {
                foreach ($request->file('gambar') as $file) {
                    $path = $file->store('galeri-wisata', 'public');
                    GaleriWisata::create([
                        'wisata_id' => $wisata->id,
                        'path_gambar' => $path,
                    ]);
                }
            }

            return back()->with('success', 'Gambar berhasil ditambahkan ke galeri.');
        }

        // Menghapus gambar dari galeri
        public function destroy($id)
        {
            $gambar = GaleriWisata::findOrFail($id);

            // Hapus file dari storage
            Storage::disk('public')->delete($gambar->path_gambar);

            // Hapus record dari database
            $gambar->delete();

            return back()->with('success', 'Gambar berhasil dihapus dari galeri.');
        }
    
}
