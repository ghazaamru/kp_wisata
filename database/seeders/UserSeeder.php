<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User; // Import model User
use Illuminate\Support\Facades\Hash; // Import Hash untuk enkripsi password

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Membuat Super Admin
        // firstOrCreate akan mencari user dengan email tersebut,
        // jika tidak ada, maka akan membuatnya. Ini mencegah duplikat.
        User::firstOrCreate(
            ['email' => 'admin@wisata.com'],
            [
                'name' => 'Super Admin',
                'password' => Hash::make('password123'),
                'role' => 'superadmin'
            ]
        );

        // Membuat Contributor
        User::firstOrCreate(
            ['email' => 'contributor@wisata.com'],
            [
                'name' => 'Budi',
                'password' => Hash::make('password123'),
                'role' => 'contributor'
            ]
        );
    }
}
