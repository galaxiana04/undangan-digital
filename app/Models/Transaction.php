<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'user_id',
        'vendor_id',
        'invitation_id',
        'amount',
        'status',
        'payment_url',
        'snap_token',
    ];

    // Transaksi ini milik 1 Pembeli (Catin)
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Transaksi ini memberikan penghasilan ke 1 Vendor
    public function vendor()
    {
        return $this->belongsTo(User::class, 'vendor_id');
    }

    // Transaksi ini untuk mengaktifkan 1 Undangan
    public function invitation()
    {
        return $this->belongsTo(Invitation::class);
    }
}