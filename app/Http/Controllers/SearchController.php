<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wisata;
use App\Models\Kategori;

class SearchController extends Controller
{
    /**
     * Menampilkan halaman hasil pencarian dengan filter.
     */
    public function index(Request $request)
    {
        $kategori = Kategori::orderBy('nama_kategori')->get();
        $query = $request->input('query');
        $kategoriId = $request->input('kategori_id');

        // Mulai membangun query pencarian
        $resultsQuery = Wisata::query();

        // Tambahkan kondisi pencarian berdasarkan kata kunci jika ada
        if ($query) {
            $resultsQuery->where(function ($q) use ($query) {
                $q->where('nama_obyek_wisata', 'LIKE', "%{$query}%")
                  ->orWhere('lokasi', 'LIKE', "%{$query}%")
                  ->orWhere('deskripsi', 'LIKE', "%{$query}%")
                  // PERUBAHAN DI SINI: Menambahkan pencarian berdasarkan nama kategori
                  ->orWhereHas('kategori', function ($subQuery) use ($query) {
                      $subQuery->where('nama_kategori', 'LIKE', "%{$query}%");
                  });
            });
        }

        // Tambahkan kondisi filter berdasarkan kategori jika dipilih
        if ($kategoriId) {
            $resultsQuery->where('kategori_id', $kategoriId);
        }

        // Eksekusi query dengan pagination
        $results = $resultsQuery->latest()->paginate(9);

        // Kirim semua data yang dibutuhkan ke view
        return view('search-results', [
            'query' => $query,
            'kategori' => $kategori,
            'results' => $results,
        ]);
    }
}
