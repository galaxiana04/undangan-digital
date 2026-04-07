<?php

namespace App\Http\Controllers;

use App\Models\Template;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminTemplateController extends Controller
{
    // 1. HALAMAN DAFTAR TEMPLATE
    public function index()
    {
        $templates = Template::latest()->get();
        return view('admin.templates.index', compact('templates'));
    }

    // 2. HALAMAN FORM TAMBAH TEMPLATE
    public function create()
    {
        return view('admin.templates.create');
    }

    // 3. PROSES SIMPAN KE DATABASE & FOLDER
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

        // Ubah fitur dari string (pisahan koma) menjadi array JSON
        $featuresArray = array_map('trim', explode(',', $request->features));

        Template::create([
            'name' => $request->name,
            'type' => $request->type,
            'price' => $request->price,
            'thumbnail' => $path,
            'features' => json_encode($featuresArray)
        ]);

        return redirect()->route('admin.templates.index')->with('success', 'Template baru berhasil ditambahkan!');
    }

    // 4. PROSES HAPUS TEMPLATE
    public function destroy(Template $template)
    {
        // Hapus file gambar dari penyimpanan
        if ($template->thumbnail) {
            Storage::disk('public')->delete($template->thumbnail);
        }

        // Hapus data dari database
        $template->delete();

        return back()->with('success', 'Template berhasil dihapus!');
    }
}