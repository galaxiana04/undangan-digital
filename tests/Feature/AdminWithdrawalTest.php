<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Withdrawal;
use Illuminate\Foundation\Testing\RefreshDatabase;
// 1. TAMBAHKAN IMPORT INI
use PHPUnit\Framework\Attributes\Test;

class AdminWithdrawalTest extends TestCase
{
    use RefreshDatabase;

    // 2. GANTI /** @test */ JADI #[Test]
    #[Test]
    public function halaman_daftar_penarikan_dapat_diakses_oleh_admin()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $response = $this->actingAs($admin)->get('/admin/withdrawals');
        $response->assertStatus(200);
    }

    #[Test]
    public function admin_dapat_menyetujui_penarikan_dana_vendor()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $vendor = User::factory()->create(['role' => 'vendor']);

        $wd = Withdrawal::create([
            'user_id' => $vendor->id,
            'amount' => 50000,
            'bank_name' => 'BCA',
            'account_number' => '123',
            'account_name' => 'Vendor A',
            'status' => 'PENDING'
        ]);

        $response = $this->actingAs($admin)->put("/admin/withdrawals/{$wd->id}", [
            'status' => 'SUCCESS'
        ]);

        $this->assertDatabaseHas('withdrawals', [
            'id' => $wd->id,
            'status' => 'SUCCESS'
        ]);
    }
}