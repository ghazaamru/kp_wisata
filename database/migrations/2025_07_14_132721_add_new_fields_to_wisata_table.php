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
                // Menambahkan kolom harga tiket setelah kolom deskripsi
                $table->integer('harga_tiket')->nullable()->default(0)->after('deskripsi');
                // Menambahkan kolom jam operasional
                $table->string('jam_operasional')->nullable()->after('harga_tiket');
                // Menambahkan kolom untuk link hotel/booking
                $table->string('link_hotel')->nullable()->after('jam_operasional');
            });
        }

        /**
         * Reverse the migrations.
         */
        public function down(): void
        {
            Schema::table('wisata', function (Blueprint $table) {
                $table->dropColumn(['harga_tiket', 'jam_operasional', 'link_hotel']);
            });
        }
    };
    