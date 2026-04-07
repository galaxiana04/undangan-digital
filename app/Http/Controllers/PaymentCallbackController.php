<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Midtrans\Config;
use Midtrans\Notification;

class PaymentCallbackController extends Controller
{
    public function receive(Request $request)
    {
        // Konfigurasi kunci rahasia
        Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        Config::$isProduction = env('MIDTRANS_IS_PRODUCTION', false);

        try {
            $notification = new Notification();

            $status = $notification->transaction_status;
            $order_id = $notification->order_id;

            // Cari transaksi di database kita
            $transaction = Transaction::where('order_id', $order_id)->first();

            if (!$transaction) {
                return response()->json(['message' => 'Transaksi tidak ditemukan'], 404);
            }

            // Logika perubahan status otomatis
            if ($status == 'capture' || $status == 'settlement') {
                $transaction->update(['status' => 'PAID']);
            } elseif ($status == 'pending') {
                $transaction->update(['status' => 'PENDING']);
            } elseif ($status == 'deny' || $status == 'expire' || $status == 'cancel') {
                $transaction->update(['status' => 'FAILED']);
            }

            return response()->json(['message' => 'Status Berhasil Diperbarui']);

        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
}