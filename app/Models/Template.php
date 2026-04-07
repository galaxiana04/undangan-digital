<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Template extends Model
{
    use HasFactory;

    protected $fillable = [
        'vendor_id', // <--- Tambahan Baru
        'name',
        'type',
        'price',
        'thumbnail',
        'features',
    ];

    // Relasi: 1 Template ini milik 1 User (Vendor/Admin)
    public function vendor()
    {
        return $this->belongsTo(User::class, 'vendor_id');
    }

    // Relasi yang sudah ada: 1 Template bisa dipakai banyak Undangan
    public function invitations()
    {
        return $this->hasMany(Invitation::class);
    }
}