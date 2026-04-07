<?php

namespace App\Http\Controllers;

use App\Models\Invitation;
use App\Models\Template;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // 1. Ambil Semua Produk Template dari Database (Yang diinput Admin)
        $presets = Template::all(); 

        // 2. Ambil Portofolio (Undangan yang sudah jadi dibuat user)
        $portfolios = Invitation::with('template')->latest()->take(6)->get();

        // 3. Testimoni (Sementara Dummy, nanti bisa bikin tabel sendiri)
        $testimonials = collect([
            (object)[ 'name' => 'Sari & Budi', 'message' => 'Suka banget sama tema Luxury-nya!', 'package' => 'Luxury' ],
            (object)[ 'name' => 'Dinda & Raka', 'message' => 'Admin fast respon, template Tosca-nya elegan.', 'package' => 'Premium' ],
        ]);

        return view('welcome', compact('presets', 'portfolios', 'testimonials'));
    }
}