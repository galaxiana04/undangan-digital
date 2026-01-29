<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InvitationController;
use App\Http\Controllers\HomeController;
use App\Models\Invitation;

Route::get('/', function () {
    return view('welcome');
});
// Halaman Depan (Landing Page)
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth'])->group(function () {
    // Dashboard User (Kita ubah arahnya nanti ke list undangan)
    Route::get('/dashboard', function () {
        // Ambil undangan milik user yang sedang login
        $invitations = Invitation::where('user_id', auth()->id())->get();
        return view('dashboard', compact('invitations'));
    })->name('dashboard');

    // FITUR UNDANGAN (Hanya bisa diakses kalau sudah login)
    Route::get('/buat-undangan', [InvitationController::class, 'create'])->name('invitation.create');
    Route::post('/simpan-undangan', [InvitationController::class, 'store'])->name('invitation.store');

    // Profile bawaan Breeze
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    // Route Katalog Template
    Route::get('/pilih-tema', [InvitationController::class, 'katalog'])->name('katalog');

});

// Route PUBLIC (Bisa diakses siapa saja/tamu)
Route::get('/{slug}', [InvitationController::class, 'show'])->name('invitation.show');

require __DIR__ . '/auth.php';

// Route untuk kirim ucapan
Route::post('/kirim-ucapan', [InvitationController::class, 'storeWish'])->name('wish.store');

Route::get('/{slug}', [InvitationController::class, 'show'])->name('invitation.show'); // Ini yg lama

