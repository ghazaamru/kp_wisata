<?php
namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Pengaturan;

class PengaturanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Gunakan updateOrCreate untuk membuat atau memperbarui data
        Pengaturan::updateOrCreate(['key' => 'site_title'], ['value' => 'YokWisata']);
        Pengaturan::updateOrCreate(['key' => 'hero_title'], ['value' => 'Jelajahi Keindahan Nusantara']);
        Pengaturan::updateOrCreate(['key' => 'hero_subtitle'], ['value' => 'Temukan destinasi wisata, event menarik, dan layanan pendukung terbaik di seluruh Indonesia.']);
        Pengaturan::updateOrCreate(['key' => 'hero_image'], ['value' => 'images/gunung.jpg']);
        Pengaturan::updateOrCreate(['key' => 'contact_address'], ['value' => 'Semarang, Indonesia']);
        Pengaturan::updateOrCreate(['key' => 'contact_email'], ['value' => 'info@yokwisata.com']);
        Pengaturan::updateOrCreate(['key' => 'contact_phone'], ['value' => '+62 24 1234 5678']);
    }
}
