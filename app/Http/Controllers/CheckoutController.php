<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Midtrans\Config;
use Midtrans\Snap;

class CheckoutController extends Controller
{
    public function show($order_id)
    {
        $transaction = Transaction::where('order_id', $order_id)
                                  ->where('user_id', auth()->id())
                                  ->with(['invitation', 'vendor']) 
                                  ->firstOrFail();

        // --- KONFIGURASI MIDTRANS ---
        Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        Config::$isProduction = env('MIDTRANS_IS_PRODUCTION', false);
        Config::$isSanitized = true;
        Config::$is3ds = true;

        // Jika transaksi ini belum punya Snap Token, kita mintakan ke Midtrans
        if (!$transaction->snap_token) {
            $params = [
                'transaction_details' => [
                    'order_id' => $transaction->order_id,
                    'gross_amount' => $transaction->amount, // Harga total
                ],
                'customer_details' => [
                    'first_name' => auth()->user()->name,
                    'email' => auth()->user()->email,
                ]
            ];

            try {
                // Minta kode Snap ke Midtrans
                $snapToken = Snap::getSnapToken($params);
                
                // Simpan kode Snap tersebut ke database kita
                $transaction->snap_token = $snapToken;
                $transaction->save();
            } catch (\Exception $e) {
                return back()->with('error', 'Gagal memanggil Midtrans: ' . $e->getMessage());
            }
        }

        return view('checkout', compact('transaction'));
    }
}