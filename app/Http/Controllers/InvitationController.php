<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invitation;
use App\Models\Wish;

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
    // MENYIMPAN UCAPAN TAMU
    public function storeWish(Request $request)
    {
        // 1. Validasi
        $request->validate([
            'invitation_id' => 'required',
            'guest_name' => 'required',
            'message' => 'required',
            'attendance' => 'required',
        ]);

        // 2. Simpan ke Database
        Wish::create($request->all());

        // 3. Kembali ke halaman undangan (dengan pesan sukses)
        return back()->with('success', 'Terima kasih, ucapan Anda telah terkirim!');
    }
    // MENAMPILKAN HALAMAN PILIH TEMPLATE
    public function katalog()
    {
        // Data Template (Ceritanya ini database produk Mbak Riza)
        $templates = collect([
            (object)[
                'code' => 'flower-pink',
                'name' => 'Flower Pink',
                'type' => 'Free',
                'price' => 'Gratis',
                'color' => 'bg-pink-100', // Warna background preview
                'image' => 'https://via.placeholder.com/300x400/fbcfe8/db2777?text=Flower+Pink', // Nanti diganti foto asli
                'features' => ['Simple', 'Clean Design']
            ],
            (object)[
                'code' => 'rustic-brown',
                'name' => 'Rustic Brown',
                'type' => 'Premium',
                'price' => 'Rp 49.000',
                'color' => 'bg-amber-100',
                'image' => 'https://via.placeholder.com/300x400/fef3c7/b45309?text=Rustic+Brown',
                'features' => ['Elegan', 'Warna Hangat', 'Musik']
            ],
            (object)[
                'code' => 'elegant-gold',
                'name' => 'Elegant Gold',
                'type' => 'Luxury',
                'price' => 'Rp 99.000',
                'color' => 'bg-gray-800',
                'image' => 'https://via.placeholder.com/300x400/1f2937/fbbf24?text=Elegant+Gold',
                'features' => ['Mewah', 'Dark Mode', 'Full Animasi']
            ],
        ]);

        return view('katalog', compact('templates'));
    }
}
