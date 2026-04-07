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
        Schema::create('templates', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nama Template (misal: Tosca Modern)
            $table->string('type'); // Free, Ekonomi, Premium, Luxury
            $table->decimal('price', 10, 2); // Harga
            $table->string('thumbnail'); // Foto Cover Template
            $table->json('features'); // Fitur-fiturnya (disimpan sebagai JSON)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('templates');
    }
};
