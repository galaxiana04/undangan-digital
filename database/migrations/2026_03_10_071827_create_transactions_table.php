<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            // Kode unik struk belanja (Contoh: INV-123456)
            $table->string('order_id')->unique();

            // Relasi ke tabel lain
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete(); // Siapa yang beli (Catin)
            $table->foreignId('vendor_id')->nullable()->constrained('users')->nullOnDelete(); // Uangnya buat siapa (Vendor)
            $table->foreignId('invitation_id')->constrained('invitations')->cascadeOnDelete(); // Undangan mana yang diaktifkan

            // Detail Harga & Pembayaran
            $table->integer('amount'); // Total tagihan (Misal: 50000)
            $table->string('status')->default('PENDING'); // Status: PENDING, PAID, FAILED, EXPIRED

            // Persiapan untuk Payment Gateway (Midtrans/Tripay)
            $table->string('payment_url')->nullable(); // Link halaman pembayaran
            $table->string('snap_token')->nullable(); // Kode rahasia Midtrans

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};