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
            // 1. Relasi ke User (Agar tahu undangan ini milik siapa)
            // Kita buat nullable dulu biar data Chanyeol yg lama ga error
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');

            // 2. Fitur Bisnis
            $table->boolean('is_premium')->default(false); // 0=Gratis, 1=Bayar
            $table->string('preset_name')->default('flower-pink'); // Pilihan Tema

            // 3. Fitur Custom User
            $table->string('custom_photo')->nullable(); // Foto Prewed Upload Sendiri
            $table->text('whatsapp_message')->nullable(); // Kata pengantar WA

            // 4. Fitur Gift (Amplop Digital)
            $table->string('bank_name')->nullable();           // Misal: BCA / DANA
            $table->string('bank_account_number')->nullable(); // No Rekening
            $table->string('bank_account_holder')->nullable(); // Atas Nama
        });
    }
};
