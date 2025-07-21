<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SektorPendukung extends Model
{
    use HasFactory;

        protected $table = 'sektor_pendukung';

        protected $fillable = [
            'wisata_id',
            'nama_sektor',
            'jenis',
            'deskripsi',
            'alamat',
            'kontak',
            'gambar',
        ];

        // Mendefinisikan bahwa satu sektor dimiliki oleh satu wisata
        public function wisata()
        {
            return $this->belongsTo(Wisata::class);
        }
}
