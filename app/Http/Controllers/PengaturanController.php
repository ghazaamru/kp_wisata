<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengaturan;
use Illuminate\Support\Facades\Storage;

class PengaturanController extends Controller
 {
        /**
         * Menampilkan halaman form pengaturan.
         */
        public function index()
        {
            // Pastikan hanya superadmin yang bisa akses
            if (auth()->user()->role !== 'superadmin') {
                abort(403, 'AKSES DITOLAK');
            }

            // Ambil semua pengaturan dan ubah menjadi format yang mudah diakses di view
            $pengaturan = Pengaturan::all()->keyBy('key');

            return view('admin.pengaturan.index', compact('pengaturan'));
        }

        /**
         * Memperbarui data pengaturan.
         */
        public function update(Request $request)
        {
            if (auth()->user()->role !== 'superadmin') {
                abort(403, 'AKSES DITOLAK');
            }

            // Loop melalui semua data yang dikirim dari form, kecuali token CSRF
            foreach ($request->except('_token', '_method') as $key => $value) {
                // Khusus untuk file gambar
                if ($key == 'hero_image' && $request->hasFile('hero_image')) {
                    $request->validate(['hero_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048']);

                    // Hapus gambar lama
                    $oldImage = Pengaturan::where('key', 'hero_image')->first()->value;
                    if ($oldImage) {
                        Storage::disk('public')->delete($oldImage);
                    }

                    // Simpan gambar baru dan dapatkan path-nya
                    $path = $request->file('hero_image')->store('settings', 'public');
                    $value = $path;
                }
                
                // Update atau buat data pengaturan di database
                Pengaturan::updateOrCreate(
                    ['key' => $key],
                    ['value' => $value]
                );
            }

            return redirect()->route('admin.pengaturan.index')
                             ->with('success', 'Pengaturan berhasil diperbarui.');
        }
}
    
