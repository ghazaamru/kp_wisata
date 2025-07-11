<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    /**
     * Nama tabel yang terhubung dengan model ini.
     */
    protected $table = 'kategori';

    /**
     * Atribut yang dapat diisi secara massal.
     */
    protected $fillable = [
        'nama_kategori',
        'deskripsi',
    ];
}