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
            $table->foreignId('wisata_id')->constrained('wisata')->onDelete('cascade');
            $table->string('nama_sektor');
            $table->enum('jenis', ['hotel', 'restoran', 'travel_agent', 'toko_oleh_oleh']);
            $table->text('deskripsi');
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
