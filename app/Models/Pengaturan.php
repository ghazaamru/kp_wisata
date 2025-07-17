<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengaturan extends Model
{
    use HasFactory;

    protected $table = 'pengaturan';

    protected $fillable = [
        'key',
        'value',
    ];

    // Menonaktifkan timestamps karena kita tidak terlalu membutuhkannya di sini
    public $timestamps = false;
}
