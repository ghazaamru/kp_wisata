<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;
use App\Models\Wisata;
use App\Models\Event; // Pastikan ini ada

class HomeController extends Controller
{
    public function index(Request $request)
    {
        // Ambil data destinasi dengan pagination
        $destinations = Wisata::latest()->paginate(6);

        // Cek jika ini adalah permintaan AJAX
        if ($request->ajax()) {
            $view = view('partials.destinasi-paginated', compact('destinations'))->render();
            return response()->json(['html' => $view]);
        }

        // Ambil data lain untuk pemuatan halaman penuh
        $categories = Kategori::take(4)->get();
        
        // PERUBAHAN DI SINI: Mengambil data event dari database
        // Hanya ambil event yang akan datang atau sedang berlangsung
        $events = Event::where('tanggal_mulai', '>=', now()->toDateString())
                       ->latest('tanggal_mulai')
                       ->take(3)
                       ->get();

        return view('halaman-utama', [
            'categories' => $categories,
            'destinations' => $destinations,
            'events' => $events
        ]);
    }
}
