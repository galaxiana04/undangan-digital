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
        Schema::create('wishes', function (Blueprint $table) {
            $table->id();

            // Terhubung ke undangan mana?
            $table->foreignId('invitation_id')->constrained()->onDelete('cascade');

            // Data Pengirim Ucapan
            $table->string('guest_name');
            $table->text('message'); // Isi Doa/Ucapan
            $table->string('attendance')->default('hadir'); // Konfirmasi kehadiran

            // Fitur Balasan (Reply) dari Pengantin
            $table->text('reply_message')->nullable();

            $table->timestamps();
        });
    }
};
