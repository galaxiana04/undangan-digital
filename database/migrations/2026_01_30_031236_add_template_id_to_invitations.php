<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('invitations', function (Blueprint $table) {
            // Hapus kolom preset_name yang lama, ganti dengan relasi ke tabel templates
            // $table->dropColumn('preset_name'); // (Opsional, kalau mau bersih)
            $table->foreignId('template_id')->nullable()->constrained()->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('invitations', function (Blueprint $table) {
            //
        });
    }
};
