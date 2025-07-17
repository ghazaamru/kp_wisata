<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengaduan;

class PengaduanController extends Controller
{
    /**
     * Menampilkan formulir pengaduan.
     */
    public function create()
    {
        return view('pengaduan-form');
    }

    /**
     * Menyimpan pengaduan baru dari formulir.
     */
    public function store(Request $request)
    {
        // 1. Validasi input
        $request->validate([
            'nama_pelapor' => 'required|string|max:255',
            'email_pelapor' => 'required|email|max:255',
            'isi_pengaduan' => 'required|string|min:10',
        ]);

        // 2. Simpan data ke database
        Pengaduan::create([
            'nama_pelapor' => $request->nama_pelapor,
            'email_pelapor' => $request->email_pelapor,
            'isi_pengaduan' => $request->isi_pengaduan,
            'status' => 'dikirim', // Status default saat pertama kali dibuat
        ]);

        // 3. Kembali ke halaman form dengan pesan sukses
        return redirect()->route('pengaduan.create')
                         ->with('success', 'Terima kasih! Pesan Anda telah berhasil terkirim. Kami akan segera menindaklanjutinya.');
    }

     // Menampilkan daftar pengaduan untuk admin.
    public function indexAdmin()
    {
        // Pastikan hanya superadmin yang bisa akses
        if (auth()->user()->role !== 'superadmin') {
            abort(403, 'AKSES DITOLAK');
        }

        $semuaPengaduan = Pengaduan::latest()->get();
        return view('admin.pengaduan.index', compact('semuaPengaduan'));
    }

    
    // Memperbarui status pengaduan.
    public function updateStatus(Request $request, Pengaduan $pengaduan)
    {
        // Pastikan hanya superadmin yang bisa akses
        if (auth()->user()->role !== 'superadmin') {
            abort(403, 'AKSES DITOLAK');
        }

        $request->validate([
            'status' => 'required|in:dikirim,diproses,selesai',
        ]);

        $pengaduan->status = $request->status;
        $pengaduan->save();

        return redirect()->route('admin.pengaduan.index')
                         ->with('success', 'Status pengaduan berhasil diperbarui.');
    }
}
