<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sektor_pendukung', function (Blueprint $table) {
                $table->id();
                // Kolom ini menghubungkan setiap sektor ke satu wisata
                $table->foreignId('wisata_id')->constrained('wisata')->onDelete('cascade');
                
                $table->string('nama_sektor');
                // Enum untuk jenis-jenis sektor yang sudah ditentukan
                $table->enum('jenis', ['akomodasi', 'restoran', 'transportasi', 'atraksi', 'toko_suvenir', 'fasilitas_umum']);
                $table->text('deskripsi')->nullable();
                $table->string('alamat');
                $table->string('kontak')->nullable();
                $table->string('gambar')->nullable();
                $table->timestamps();
            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sektor_pendukung');
    }
};
