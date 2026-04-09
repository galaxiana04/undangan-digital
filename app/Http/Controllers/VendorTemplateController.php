<?php

namespace App\Http\Controllers;

use App\Models\Template;
use App\Models\Transaction;
use App\Models\Withdrawal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\DesignRequest;
class VendorTemplateController extends Controller
{
    /**
     * Tampilkan Dashboard Khusus Vendor
     */
    public function dashboard()
    {
        $user = Auth::user();

        // 1. Ambil data transaksi (Hanya yang PAID untuk hitungan saldo)
        $transaksiTerbaru = Transaction::whereHas('invitation.template', function ($q) use ($user) {
            $q->where('vendor_id', $user->id);
        })
            ->with(['user', 'invitation.template'])
            ->latest()
            ->get();

        // 2. Kalkulasi Keuangan
        $totalPenjualan = $transaksiTerbaru->where('status', 'PAID')->sum('amount');
        $komisiPlatform = $totalPenjualan * 0.10;
        $pendapatanBersihVendor = $totalPenjualan - $komisiPlatform;

        // 3. HITUNG JUMLAH TERJUAL
        $totalTerjual = $transaksiTerbaru->where('status', 'PAID')->count();

        // 4. Hitung Penarikan
        $totalDitarik = Withdrawal::where('user_id', $user->id)
            ->where('status', 'SUCCESS')
            ->sum('amount');

        // 5. Saldo Akhir
        $saldoVendor = $pendapatanBersihVendor - $totalDitarik;

        // 6. Daftar Template
        $templates = Template::where('vendor_id', $user->id)->latest()->get();

        // 7. AMBIL DATA REQUEST EDIT KUSTOM (TUGAS VENDOR) -- INI YANG BARU
        $designRequests = DesignRequest::where('vendor_id', $user->id)
            ->with(['invitation.user', 'invitation.template']) // Eager loading agar tidak berat
            ->latest()
            ->get();

        return view('vendor.dashboard', compact(
            'saldoVendor',
            'templates',
            'transaksiTerbaru',
            'totalPenjualan',
            'komisiPlatform',
            'totalTerjual',
            'designRequests' // PASTIKAN INI IKUT DIKIRIM KE BLADE
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
            'vendor_id' => Auth::id(), // Gunakan vendor_id sesuai database Mbak
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
            $q->where('vendor_id', $user->id);
        })->where('status', 'PAID')->sum('amount');

        $pendapatanBersih = $totalPenjualan * 0.90; // 90% milik vendor
        $totalDitarik = Withdrawal::where('user_id', $user->id)->where('status', 'SUCCESS')->sum('amount');
        $saldoAktif = $pendapatanBersih - $totalDitarik;

        $request->validate([
            'amount' => 'required|numeric|min:10000|max:' . $saldoAktif,
            'bank_name' => 'required|string',
            'account_number' => 'required|string',
            'account_name' => 'required|string',
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