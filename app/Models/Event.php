<!-- <?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    /**
     * Nama tabel yang terhubung dengan model ini.
     *
     * @var string
     */
    protected $table = 'events';

    /**
     * Atribut yang dapat diisi secara massal.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'nama_event',
        'deskripsi',
        'lokasi',
        'tanggal_mulai',
        'tanggal_selesai',
        'gambar',
    ];

    /**
     * Tipe data native dari atribut yang seharusnya di-cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'tanggal_mulai' => 'date',
        'tanggal_selesai' => 'date',
    ];


    /*
    |--------------------------------------------------------------------------
    | RELASI ELOQUENT
    |--------------------------------------------------------------------------
    */

    /**
     * Mendefinisikan relasi "belongsTo" ke model User.
     * Sebuah event diposting oleh satu user.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
} -->