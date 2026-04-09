<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Withdrawal extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'amount',
        'bank_name',
        'account_number',
        'account_name',
        'status',
        'admin_note'
    ];

    // Tambahkan relasi ke User agar test bisa memanggil $wd->user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}