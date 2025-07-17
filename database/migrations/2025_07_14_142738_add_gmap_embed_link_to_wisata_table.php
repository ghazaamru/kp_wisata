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
            Schema::table('wisata', function (Blueprint $table) {
                // Menambahkan kolom untuk menyimpan kode embed GMap
                // Tipe TEXT digunakan karena kodenya bisa panjang
                $table->text('gmap_embed_link')->nullable()->after('link_hotel');
            });
        }

        /**
         * Reverse the migrations.
         */
        public function down(): void
        {
            Schema::table('wisata', function (Blueprint $table) {
                $table->dropColumn('gmap_embed_link');
            });
        }
    };
    