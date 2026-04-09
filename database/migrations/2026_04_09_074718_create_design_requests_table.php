<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('design_requests', function (Blueprint $table) {
            $table->id();

            // Menghubungkan ke undangan mana yang mau diedit
            $table->foreignId('invitation_id')
                ->constrained()
                ->onDelete('cascade');

            // Menghubungkan ke Vendor mana yang dimintai tolong
            $table->foreignId('vendor_id')
                ->constrained('users')
                ->onDelete('cascade');

            // Catatan khusus dari Pengantin (Catin)
            $table->text('user_notes')->nullable();

            // Balasan atau catatan dari Vendor setelah selesai edit
            $table->text('vendor_reply')->nullable();

            // Alur kerja permintaan
            $table->enum('status', ['pending', 'process', 'completed', 'rejected'])
                ->default('pending');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('design_requests');
    }
};