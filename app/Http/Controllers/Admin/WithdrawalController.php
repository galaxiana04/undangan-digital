<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Withdrawal;
use Illuminate\Http\Request;

class WithdrawalController extends Controller
{
    // Tampilkan semua permintaan penarikan
    public function index()
    {
        $withdrawals = Withdrawal::with('user')->latest()->get();
        return view('admin.withdrawals.index', compact('withdrawals'));
    }

    // Proses Update Status (Setuju/Tolak)
    public function update(Request $request, $id)
    {
        $withdrawal = Withdrawal::findOrFail($id);
        
        $request->validate([
            'status' => 'required|in:SUCCESS,REJECTED',
            'admin_note' => 'nullable|string'
        ]);

        $withdrawal->update([
            'status' => $request->status,
            'admin_note' => $request->admin_note
        ]);

        $pesan = $request->status == 'SUCCESS' ? 'Dana berhasil dicairkan!' : 'Penarikan ditolak.';
        return back()->with('success', $pesan);
    }
}