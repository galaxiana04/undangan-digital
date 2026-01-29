<?php

namespace App\Http\Controllers;

use App\Models\Invitation;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // 1. DATA PORTOFOLIO
        // Mengambil 3 undangan terakhir yang dibuat user asli sebagai contoh
        $portfolios = Invitation::latest()->take(3)->get();

        // 2. DATA PAKET / PRESET (Produk Mbak Riza)
        $presets = collect([
            (object)[
                'name' => 'Free',
                'price' => 'Rp 0',
                'color' => 'gray',
                'features' => ['Masa Aktif 1 Hari', 'Tema Basic', 'Maksimal 20 Tamu', 'Tanpa Musik'],
                'best_value' => false
            ],
            (object)[
                'name' => 'Ekonomi',
                'price' => 'Rp 25.000',
                'color' => 'blue',
                'features' => ['Masa Aktif 3 Hari', 'Pilihan 3 Tema', 'Tamu Unlimited', 'Tanpa Musik'],
                'best_value' => false
            ],
            (object)[
                'name' => 'Premium',
                'price' => 'Rp 49.000',
                'color' => 'pink',
                'features' => ['Masa Aktif Selamanya', 'Musik Latar', 'Peta Lokasi', 'Galeri Foto', 'Amplop Digital'],
                'best_value' => true // Ini yang paling ditonjolkan
            ],
            (object)[
                'name' => 'Platinum',
                'price' => 'Rp 75.000',
                'color' => 'purple',
                'features' => ['Fitur Premium +', 'Domain Custom', 'Prioritas Server', 'RSVP WhatsApp'],
                'best_value' => false
            ],
            (object)[
                'name' => 'Luxury',
                'price' => 'Rp 99.000',
                'color' => 'amber',
                'features' => ['All Access', 'Desain Custom Request', 'Video Undangan', 'Asisten Support 24/7'],
                'best_value' => false
            ],
        ]);

        // 3. DATA TESTIMONI (Dari Bride/Pengantin)
        // Ceritanya ini feedback dari klien yang sudah pesan template
        $testimonials = collect([
            (object)[
                'name' => 'Sari & Budi',
                'date' => 'Menikah 12 Jan 2026',
                'message' => 'Kak Riza makasih banyak ya! Template Luxurynya mewah banget, temen-temen kantor pada muji undangannya elegan. Supportnya juga cepet.',
                'package' => 'Luxury'
            ],
            (object)[
                'name' => 'Dinda & Reza',
                'date' => 'Menikah 3 Feb 2026',
                'message' => 'Buat yang mau hemat tapi bagus, paket Premium udah oke banget sih. Musiknya bikin suasana romantis pas dibuka.',
                'package' => 'Premium'
            ],
            (object)[
                'name' => 'Amel & Dimas',
                'date' => 'Menikah 20 Des 2025',
                'message' => 'Awalnya ragu mau pesen online, tapi ternyata gampang banget. Tinggal isi data, langsung jadi linknya. Sukses terus Riza Invitation!',
                'package' => 'Platinum'
            ],
        ]);

        return view('welcome', compact('portfolios', 'presets', 'testimonials'));
    }
}