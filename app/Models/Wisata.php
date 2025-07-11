<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wisata extends Model
{
    use HasFactory;

    /**
     * Nama tabel yang terhubung dengan model ini.
     *
     * @var string
     */
    protected $table = 'wisata'; // <-- TAMBAHKAN BARIS INI

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
        'gambar'
    ];

    // ... sisa kode relasi ...
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    // app/Models/Wisata.php

    public function sektorPendukung()
    {
        return $this->hasMany(SektorPendukung::class);
    }
}