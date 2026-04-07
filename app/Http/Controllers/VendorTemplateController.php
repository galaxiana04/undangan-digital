<?php

namespace App\Http\Controllers;

use App\Models\Template;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class VendorTemplateController extends Controller
{
    // 1. Tampilkan Form Upload Karya
    public function create()
    {
        return view('vendor.templates.create');
    }

    // 2. Proses Simpan Karya ke Database & Folder
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string',
            'price' => 'required|numeric',
            'thumbnail' => 'required|image|max:2048', // Maksimal 2MB
            'features' => 'required|string',
        ]);

        // Simpan Gambar ke folder storage/app/public/templates
        $path = $request->file('thumbnail')->store('templates', 'public');

        // Ubah fitur dari string (pisahan koma) menjadi array
        $featuresArray = array_map('trim', explode(',', $request->features));

        // Simpan ke database, TAPI otomatis masukkan vendor_id yang sedang login!
        Template::create([
            'vendor_id' => Auth::id(), // <--- Kunci utamanya di sini!
            'name' => $request->name,
            'type' => $request->type,
            'price' => $request->price,
            'thumbnail' => $path,
            'features' => json_encode($featuresArray)
        ]);

        return redirect()->route('dashboard')->with('success', 'Karya desainmu berhasil diunggah! Calon pengantin sekarang bisa melihatnya di Katalog.');
    }
}