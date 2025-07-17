<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wisata extends Model
{
    use HasFactory;

    protected $table = 'wisata';

    /**
     * Atribut yang dapat diisi secara massal.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nama_obyek_wisata',
        'deskripsi',
        'lokasi',
        'kategori_id',
        'user_id',
        'gambar',
        'harga_tiket',
        'jam_operasional',
        'link_hotel',
        'gmap_embed_link', // <-- PASTIKAN BARIS INI ADA
    ];

    // ... (kode relasi Anda yang lain) ...
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }
    
    public function sektorPendukung()
    {
        return $this->hasMany(SektorPendukung::class);
    }
}
