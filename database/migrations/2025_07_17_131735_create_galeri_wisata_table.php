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
        Schema::create('galeri_wisata', function (Blueprint $table) {
            $table->id();
                $table->foreignId('wisata_id')->constrained('wisata')->onDelete('cascade');
                $table->string('path_gambar');
                $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('galeri_wisata');
    }
};
