<?php

namespace App\Models;

// 1. Pastikan baris ini ada untuk mengimpor trait HasFactory
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GaleriWisata extends Model
{
    // 2. Baris ini menggunakan trait yang sudah diimpor
    use HasFactory;

    protected $table = 'galeri_wisata';

    protected $fillable = [
        'wisata_id',
        'path_gambar',
    ];

    // Mendefinisikan bahwa satu foto galeri dimiliki oleh satu wisata
    public function wisata()
    {
        return $this->belongsTo(Wisata::class);
    }
}
