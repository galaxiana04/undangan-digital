<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('templates', function (Blueprint $table) {
            // Menambahkan kolom vendor_id.
            // Kita buat nullable() karena template bawaan Admin mungkin tidak punya spesifik vendor.
            $table->foreignId('vendor_id')->nullable()->constrained('users')->cascadeOnDelete()->after('id');
        });
    }

    public function down()
    {
        Schema::table('templates', function (Blueprint $table) {
            $table->dropForeign(['vendor_id']);
            $table->dropColumn('vendor_id');
        });
    }
};