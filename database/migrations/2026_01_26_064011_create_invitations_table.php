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
    Schema::create('invitations', function (Blueprint $table) {
        $table->id();
        
        // 1. Link Unik
        $table->string('slug')->unique(); 
        
        // 2. Tema
        $table->string('theme')->default('basic');
        
        // 3. Data Pengantin (LENGKAP)
        $table->string('groom_name');      // Nama Lengkap Pria
        $table->string('groom_nickname');  // Panggilan Pria
        $table->string('bride_name');      // Nama Lengkap Wanita
        $table->string('bride_nickname');  // Panggilan Wanita
        
        // 4. Data Acara (LENGKAP)
        $table->dateTime('event_date');    // Tanggal
        $table->string('location_name');   // Nama Tempat
        $table->text('location_address');  // Alamat
        $table->text('google_maps_link')->nullable();
        
        $table->timestamps();
    });
}
};
