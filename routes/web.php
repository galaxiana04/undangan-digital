<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InvitationController;

Route::get('/', function () {
    return view('welcome');
});
// Route untuk Halaman Admin
Route::get('/admin/buat', [InvitationController::class, 'create'])->name('invitation.create');
Route::post('/admin/simpan', [InvitationController::class, 'store'])->name('invitation.store');

// Route Undangan 
Route::get('/{slug}', [InvitationController::class, 'show']);

