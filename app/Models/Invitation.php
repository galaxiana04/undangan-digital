<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invitation extends Model
{
    use HasFactory;

    // Izinkan semua kolom diisi (termasuk template_id)
    protected $guarded = [];

    // Relasi 1: Undangan milik User siapa?
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi 2: Undangan pakai Template apa? (INI YANG TADI HILANG)
    public function template()
    {
        return $this->belongsTo(Template::class);
    }

    // Relasi 3: Undangan punya banyak Ucapan
    public function wishes()
    {
        return $this->hasMany(Wish::class);
    }
}