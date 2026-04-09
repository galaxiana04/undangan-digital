<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DesignRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'invitation_id',
        'vendor_id',
        'user_notes',
        'vendor_reply',
        'status'
    ];

    // Relasi ke tabel Invitation (Undangan)
    public function invitation()
    {
        return $this->belongsTo(Invitation::class);
    }

    // Relasi ke tabel User (Vendor)
    public function vendor()
    {
        return $this->belongsTo(User::class, 'vendor_id');
    }
}