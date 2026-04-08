<?php

namespace App\Http\Controllers;

use App\Models\Template;
use App\Models\Transaction;
use App\Models\Withdrawal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VendorTemplateController extends Controller
{
    /**
     * Tampilkan Dashboard Khusus Vendor
     */
    public function dashboard()
    {
        $user = Auth::user();

        // 1. Hitung Total Penjualan Kotor (Bruto)
        $totalPenjualan = Transaction::whereHas('invitation.template', function ($q) use ($user) {
            $q->where('user_id', $user->id);
        })->where('status', 'PAID')->sum('amount');

        // 2. Potong Komisi Platform 10% (Jatah Mbak Riza)
        $komisiPlatform = $totalPenjualan * 0.10;
        $pendapatanBersihVendor = $totalPenjualan - $komisiPlatform;

        // 3. Hitung Total yang Sudah Berhasil Ditarik
        $totalDitarik = Withdrawal::where('user_id', $user->id)
            ->where('status', 'SUCCESS')
            ->sum('amount');

        // 4. Saldo Akhir yang Bisa Ditarik Vendor
        $saldoVendor = $pendapatanBersihVendor - $totalDitarik;

        // Data Tambahan untuk UI Dashboard
        $templates = Template::where('user_id', $user->id)->latest()->get();
        $transaksiTerbaru = Transaction::whereHas('invitation.template', function ($q) use ($user) {
            $q->where('user_id', $user->id);
        })->latest()->take(5)->get();

        return view('vendor.dashboard', compact(
            'saldoVendor',
            'templates',
            'transaksiTerbaru',
            'totalPenjualan',
            'komisiPlatform'
        ));
    }

    /**
     * Proses Simpan Template Baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string',
            'price' => 'required|numeric|min:0',
            'thumbnail' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'features' => 'required|string',
        ]);

        // Upload file ke storage
        $path = $request->file('thumbnail')->store('templates', 'public');

        // Bersihkan input fitur (koma menjadi array)
        $featuresArray = array_map('trim', explode(',', $request->features));

        Template::create([
            'user_id' => Auth::id(),
            'name' => $request->name,
            'type' => $request->type,
            'price' => $request->price,
            'thumbnail' => $path,
            'features' => json_encode($featuresArray)
        ]);

        return redirect()->route('dashboard')->with('success', 'Template berhasil diunggah!');
    }

    /**
     * Proses Permintaan Penarikan Saldo
     */
    public function withdraw(Request $request)
    {
        $user = Auth::user();

        // Re-calculate Saldo untuk Keamanan (Security Check)
        $totalPenjualan = Transaction::whereHas('invitation.template', function ($q) use ($user) {
            $q->where('user_id', $user->id);
        })->where('status', 'PAID')->sum('amount');

        $pendapatanBersih = $totalPenjualan * 0.90; // 90% milik vendor
        $totalDitarik = Withdrawal::where('user_id', $user->id)->where('status', 'SUCCESS')->sum('amount');
        $saldoAktif = $pendapatanBersih - $totalDitarik;

        $request->validate([
            'amount' => 'required|numeric|min:10000|max:' . $saldoAktif,
            'bank_name' => 'required|string',
            'account_number' => 'required|string',
            'account_name' => 'required|string', // Tambahkan nama pemilik rekening
        ]);

        Withdrawal::create([
            'user_id' => $user->id,
            'amount' => $request->amount,
            'bank_name' => $request->bank_name,
            'account_number' => $request->account_number,
            'account_name' => $request->account_name,
            'status' => 'PENDING'
        ]);

        return back()->with('success', 'Permintaan penarikan saldo telah dikirim ke Admin!');
    }
}