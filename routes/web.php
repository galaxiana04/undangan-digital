<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InvitationController;
use App\Http\Controllers\HomeController;
use App\Models\Invitation;
use App\Models\Template;
use App\Models\Transaction;


// --- 1. PUBLIK (Bisa Diakses Tanpa Login) ---
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/katalog-tema', [InvitationController::class, 'katalog'])->name('katalog');

// --- 2. AREA MEMBER (Harus Login) ---
Route::middleware(['auth', 'verified'])->group(function () {

    // --- PEMISAH JALAN (ROUTING DASHBOARD MULTI-ROLE) ---
    Route::get('/dashboard', function () {
        $user = auth()->user();

        if ($user->role === 'admin') {
            return view('admin.dashboard');
        } elseif ($user->role === 'vendor') {
            // Langsung lempar ke Controller saja biar rapi
            return redirect()->route('vendor.dashboard');
        } else {
            // Customer biasa
            $invitations = App\Models\Invitation::where('user_id', $user->id)->get();
            return view('dashboard', compact('invitations'));
        }
    })->name('dashboard');

    // --- FITUR GANTI MODE UNTUK VENDOR ---
    Route::get('/dashboard/pembeli', function () {
        $user = auth()->user();
        $invitations = App\Models\Invitation::where('user_id', $user->id)->get();
        return view('dashboard', compact('invitations'));
    })->name('dashboard.pembeli');

    // --- FITUR UPGRADE AKUN JADI VENDOR ---
    Route::post('/upgrade-vendor', function () {
        $user = auth()->user();
        $user->role = 'vendor';
        $user->save();

        return redirect()->route('dashboard')->with('success', 'Selamat! Akun Anda telah di-upgrade menjadi Kreator/Vendor.');
    })->name('upgrade.vendor');

    // --- FITUR KREATOR / VENDOR (Kode dari Mbak Riza ada di sini) ---
    Route::prefix('vendor')->name('vendor.')->group(function () {
        Route::get('/upload-karya', [App\Http\Controllers\VendorTemplateController::class, 'create'])->name('templates.create');
        Route::post('/simpan-karya', [App\Http\Controllers\VendorTemplateController::class, 'store'])->name('templates.store');
    });

    // --- FITUR CATIN ---
    Route::get('/buat-undangan', [InvitationController::class, 'create'])->name('invitation.create');
    Route::post('/simpan-undangan', [InvitationController::class, 'store'])->name('invitation.store');
    Route::post('/wish/{id}/reply', [App\Http\Controllers\InvitationController::class, 'replyWish'])->name('wish.reply');

    // --- FITUR ADMIN ---
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::resource('templates', App\Http\Controllers\AdminTemplateController::class);

        // --- TAMBAHKAN INI UNTUK FIX ERROR 404 TADI ---
        Route::get('/withdrawals', [App\Http\Controllers\Admin\WithdrawalController::class, 'index'])->name('withdrawals.index');
        Route::put('/withdrawals/{id}', [App\Http\Controllers\Admin\WithdrawalController::class, 'update'])->name('withdrawals.update');
    });

    // --- FITUR VENDOR (UPDATE KODE MBAK RIZA) ---
    Route::prefix('vendor')->name('vendor.')->group(function () {
        Route::get('/dashboard', [App\Http\Controllers\VendorTemplateController::class, 'dashboard'])->name('dashboard');
        Route::get('/upload-karya', [App\Http\Controllers\VendorTemplateController::class, 'create'])->name('templates.create');
        Route::post('/simpan-karya', [App\Http\Controllers\VendorTemplateController::class, 'store'])->name('templates.store');

        // Rute untuk vendor minta tarik uang
        Route::post('/withdraw', [App\Http\Controllers\VendorTemplateController::class, 'withdraw'])->name('withdraw.store');
    });

    // --- PROFILE BAWAAN BREEZE ---
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// --- 3. AUTH (Login/Register/Logout) ---
require __DIR__ . '/auth.php';

// --- 4. UNDANGAN JADI (Publik) ---
Route::post('/kirim-ucapan', [InvitationController::class, 'storeWish'])->name('wish.store');
Route::get('/{slug}', [InvitationController::class, 'show'])->name('invitation.show');

// --- FITUR KASIR / CHECKOUT ---
Route::get('/checkout/{order_id}', [App\Http\Controllers\CheckoutController::class, 'show'])->name('checkout.show');

// Rute untuk menerima laporan otomatis dari Midtrans
Route::post('/payment/callback', [App\Http\Controllers\PaymentCallbackController::class, 'receive']);