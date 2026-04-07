<?php

namespace App\Http\Controllers;

use App\Models\Invitation;
use App\Models\Template;
use App\Models\Wish;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class InvitationController extends Controller
{
    // 1. HALAMAN KATALOG (Pilih Template)
    public function katalog()
    {
        // Coba ambil dari Database (Fitur Admin Platform)
        $templates = Template::all();

        // FALLBACK: Jika Database kosong (Admin belum input), pakai data manual
        // Ini supaya halaman tidak error saat pertama kali dibuka
        if ($templates->isEmpty()) {
            $templates = collect([
                (object) [
                    'id' => 1,
                    'code' => 'flower-pink',
                    'name' => 'Flower Bloom',
                    'type' => 'Free',
                    'price' => 0,
                    'color' => 'bg-orange-50',
                    'thumbnail' => null, // Nanti user lihat placeholder
                    'features' => ['Simple', 'Clean Design']
                ],
                (object) [
                    'id' => 2,
                    'code' => 'rustic-brown',
                    'name' => 'Rustic Nature',
                    'type' => 'Premium',
                    'price' => 49000,
                    'color' => 'bg-stone-100',
                    'thumbnail' => null,
                    'features' => ['Elegan', 'Musik', 'Peta']
                ],
                (object) [
                    'id' => 3,
                    'code' => 'tosca-modern',
                    'name' => 'Tosca Modern',
                    'type' => 'Luxury',
                    'price' => 99000,
                    'color' => 'bg-teal-50',
                    'thumbnail' => null,
                    'features' => ['Mewah', 'Full Animasi', 'Dark Mode']
                ]
            ]);
        }

        return view('katalog', compact('templates'));
    }

    // 2. FORMULIR (Menerima Pilihan Template)
    public function create(Request $request)
    {
        // Tangkap pilihan user dari URL (misal: ?preset=tosca-modern)
        $selectedPreset = $request->query('preset', 'flower-pink');

        // Jika user mengklik dari tombol yang mengirim 'template_id' (versi database)
        if ($request->has('template_id')) {
            $template = Template::find($request->template_id);
            if ($template) {
                // Kita ambil kodenya kalau ada kolom code, atau pakai nama dummy
                // Disini kita defaultkan ke tosca-modern untuk contoh jika pakai ID
                $selectedPreset = 'tosca-modern';
            }
        }

        return view('admin-form', compact('selectedPreset'));
    }

    // 3. SIMPAN UNDANGAN (Proses Pembuatan)
    public function store(Request $request)
    {
        // Validasi Input
        $request->validate([
            'slug' => 'required|unique:invitations,slug|alpha_dash',
            'groom_name' => 'required',
            'bride_name' => 'required',
            'custom_photo' => 'nullable|image|max:2048',
            // Ambil ID Template yang asli dari form (Kita butuh ID ini untuk cek harga)
            'template_id' => 'required|exists:templates,id',
        ]);

        $data = $request->all();
        $data['user_id'] = auth()->id(); // Set Pemilik Undangan

        // Proses Upload Foto
        if ($request->hasFile('custom_photo')) {
            $path = $request->file('custom_photo')->store('photos', 'public');
            $data['custom_photo'] = $path;
        }

        // Simpan Data Undangan ke Database
        $invitation = Invitation::create($data);

        // --- MULAI LOGIKA KASIR (CHECKOUT) ---
        // 1. Cari data desain/template yang baru saja dipilih
        $template = Template::find($request->template_id);

        // 2. Cek apakah harganya lebih dari Rp 0 (Berbayar)
        if ($template && is_numeric($template->price) && $template->price > 0) {

            // Buat Kode Struk Belanja Unik (Misal: INV-2026-X89ABC)
            $orderId = 'INV-' . date('Y') . '-' . strtoupper(substr(uniqid(), -6));

            // Catat tagihan ke tabel transactions
            $transaction = \App\Models\Transaction::create([
                'order_id' => $orderId,
                'user_id' => auth()->id(), // Si Pembeli
                'vendor_id' => $template->vendor_id, // Si Penjual (Bisa null jika template bawaan admin)
                'invitation_id' => $invitation->id, // Undangan yang mau diaktifkan
                'amount' => $template->price, // Harga asli dari template
                'status' => 'PENDING', // Belum dibayar
            ]);

            // Karena berbayar, arahkan ke halaman Invoice / Pembayaran
            return redirect()->route('checkout.show', $transaction->order_id)
                ->with('info', 'Undangan tersimpan! Silakan selesaikan pembayaran untuk mengaktifkannya.');
        }

        // --- JIKA GRATIS (ATAU HARGA 0) ---
        // Jika gratis, langsung arahkan ke dashboard seperti biasa
        return redirect()->route('dashboard')->with('success', 'Undangan gratis berhasil dibuat dan langsung aktif!');
    }

    // 4. MENAMPILKAN UNDANGAN (Public View)
    public function show(Request $request, $slug)
    {
        $invitation = Invitation::where('slug', $slug)->firstOrFail();
        $tamu = $request->query('to', 'Tamu Undangan');

        return view('invitation', compact('invitation', 'tamu'));
    }

    // 5. TAMU KIRIM UCAPAN
    public function storeWish(Request $request)
    {
        $request->validate([
            'invitation_id' => 'required',
            'guest_name' => 'required',
            'message' => 'required',
        ]);

        Wish::create($request->all());

        return back()->with('success', 'Ucapan terkirim!');
    }

    // 6. PENGANTIN BALAS UCAPAN (Fitur Dashboard)
    public function replyWish(Request $request, $id)
    {
        $wish = Wish::findOrFail($id);

        // Pastikan yang balas adalah pemilik undangan
        if ($wish->invitation->user_id != auth()->id()) {
            abort(403);
        }

        $wish->update([
            'reply_message' => $request->reply_message
        ]);

        return back()->with('success', 'Balasan terkirim!');
    }
}