<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;
use App\Models\Wisata;

class HomeController extends Controller
{
    public function index()
    {
        // Ambil data dari database
        $categories = Kategori::take(4)->get();
        $destinations = Wisata::latest()->take(6)->get();

        // Gunakan data dummy untuk events
        $events = [
            [
                'nama_event' => 'Festival Kota Lama',
                'tanggal_mulai' => now()->addDays(10),
                'lokasi' => 'Semarang, Indonesia',
                'deskripsi' => 'Festival seni dan budaya tahunan.'
            ],
            [
                'nama_event' => 'Dieng Culture Festival',
                'tanggal_mulai' => now()->addDays(35),
                'lokasi' => 'Dataran Tinggi Dieng',
                'deskripsi' => 'Acara pemotongan rambut gimbal yang ikonik.'
            ]
        ];

        // Kirim semua data ke view
        return view('halaman-utama', [
            'categories' => $categories,
            'destinations' => $destinations,
            'events' => $events
        ]);
    }
}