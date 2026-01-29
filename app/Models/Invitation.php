<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invitation extends Model
{
    use HasFactory;

    protected $guarded = [];
    // Relasi: Undangan ini milik User siapa?
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi: Undangan ini punya banyak Ucapan
    public function wishes()
    {
        return $this->hasMany(Wish::class);
    }
    public function store(Request $request)
    {
        // 1. Validasi
        $request->validate([
            'slug' => 'required|unique:invitations,slug|alpha_dash',
            'groom_name' => 'required',
            'bride_name' => 'required',
            'custom_photo' => 'nullable|image|max:2048', // Validasi foto (maks 2MB)
        ]);

        // 2. Ambil semua data input
        $data = $request->all();

        // 3. Masukkan ID User yang sedang login (PENTING!)
        $data['user_id'] = auth()->id();

        // 4. Cek apakah ada file foto yang diupload?
        if ($request->hasFile('custom_photo')) {
            // Simpan ke folder: storage/app/public/photos
            $path = $request->file('custom_photo')->store('photos', 'public');
            $data['custom_photo'] = $path;
        }

        // 5. Simpan ke Database
        Invitation::create($data);

        // 6. Redirect ke halaman undangan
        return redirect('/' . $request->slug);
    }
}