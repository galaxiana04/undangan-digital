<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invitation;

class InvitationController extends Controller
{
    public function show(Request $request, $slug) // Tambah Request $request
    {
        // 1. Cari data undangan
        $invitation = Invitation::where('slug', $slug)->firstOrFail();

        // 2. Tangkap nama tamu dari URL. Kalau tidak ada, default-nya "Tamu Undangan"
        $tamu = $request->query('to', 'Tamu Undangan');

        // 3. Ganti spasi di URL (misal %20) menjadi spasi biasa (Opsional, Laravel biasanya otomatis)
        // $tamu = urldecode($tamu); 

        // 4. Kirim data undangan DAN data tamu ke view
        return view('invitation', compact('invitation', 'tamu'));
    }

    // MENAMPILKAN FORMULIR
    public function create()
    {
        return view('admin-form');
    }

    // MENYIMPAN DATA KE DATABASE
    public function store(Request $request)
    {
        // 1. Validasi (Wajib diisi)
        $request->validate([
            'slug' => 'required|unique:invitations,slug|alpha_dash', // link harus unik & tanpa spasi
            'groom_name' => 'required',
            'bride_name' => 'required',
        ]);

        // 2. Simpan ke Database
        Invitation::create($request->all());

        // 3. Redirect ke halaman undangan yang barusan dibuat
        return redirect('/' . $request->slug);
    }
}
