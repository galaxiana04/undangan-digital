<!DOCTYPE html>
<html lang="id">
<head>
    <title>Isi Data Undangan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>body { font-family: 'Poppins', sans-serif; }</style>
</head>
<body class="bg-gray-100 min-h-screen pb-20">

    <div class="bg-white shadow-sm py-4 mb-8">
        <div class="max-w-3xl mx-auto px-4 flex justify-between items-center">
            <h1 class="text-xl font-bold text-gray-800">Lengkapi Data Pernikahan</h1>
            <a href="{{ route('katalog') }}" class="text-sm text-pink-600 hover:underline">Ganti Template</a>
        </div>
    </div>

    <div class="max-w-3xl mx-auto px-4">
        
        <form action="{{ route('invitation.store') }}" method="POST" enctype="multipart/form-data" class="bg-white shadow-xl rounded-2xl overflow-hidden">
            @csrf

            <div class="bg-pink-50 border-b border-pink-100 p-6 flex items-center gap-4">
                <div class="w-16 h-16 rounded-lg bg-white shadow-sm flex items-center justify-center text-2xl border border-pink-100">
                    🎨
                </div>
                <div>
                    <p class="text-xs text-pink-600 font-bold uppercase tracking-wider">Template Terpilih:</p>
                    <h2 class="text-xl font-bold text-gray-800 capitalize">{{ str_replace('-', ' ', $selectedPreset ?? 'Default') }}</h2>
                    
                    <input type="hidden" name="preset_name" value="{{ $selectedPreset ?? 'flower-pink' }}">
                </div>
            </div>

            <div class="p-8 border-b border-gray-100">
                <h2 class="text-lg font-bold text-gray-800 mb-4">🔗 Link & Foto</h2>
                <div class="grid md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-bold mb-2 text-gray-600">Link Website (Slug)</label>
                        <div class="flex">
                            <span class="bg-gray-100 border border-r-0 rounded-l px-3 flex items-center text-gray-500 text-sm">website.com/</span>
                            <input type="text" name="slug" placeholder="romeo-juliet" class="w-full border p-2 rounded-r focus:ring-pink-500 focus:border-pink-500 outline-none" required>
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-bold mb-2 text-gray-600">Foto Prewed (Opsional)</label>
                        <input type="file" name="custom_photo" accept="image/*" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-pink-50 file:text-pink-700 hover:file:bg-pink-100">
                    </div>
                </div>
            </div>

            <div class="p-8 border-b border-gray-100">
                <h2 class="text-lg font-bold text-gray-800 mb-4">💍 Data Mempelai</h2>
                <div class="grid md:grid-cols-2 gap-8">
                    <div class="bg-blue-50/50 p-4 rounded-xl border border-blue-50">
                        <h3 class="font-bold text-blue-800 mb-3 border-b border-blue-100 pb-2">Mempelai Pria</h3>
                        <div class="space-y-3">
                            <div>
                                <label class="text-xs font-semibold text-gray-500">Nama Lengkap</label>
                                <input type="text" name="groom_name" class="w-full border p-2 rounded focus:ring-blue-500 outline-none" required>
                            </div>
                            <div>
                                <label class="text-xs font-semibold text-gray-500">Nama Panggilan</label>
                                <input type="text" name="groom_nickname" class="w-full border p-2 rounded focus:ring-blue-500 outline-none" required>
                            </div>
                        </div>
                    </div>

                    <div class="bg-pink-50/50 p-4 rounded-xl border border-pink-50">
                        <h3 class="font-bold text-pink-800 mb-3 border-b border-pink-100 pb-2">Mempelai Wanita</h3>
                        <div class="space-y-3">
                            <div>
                                <label class="text-xs font-semibold text-gray-500">Nama Lengkap</label>
                                <input type="text" name="bride_name" class="w-full border p-2 rounded focus:ring-pink-500 outline-none" required>
                            </div>
                            <div>
                                <label class="text-xs font-semibold text-gray-500">Nama Panggilan</label>
                                <input type="text" name="bride_nickname" class="w-full border p-2 rounded focus:ring-pink-500 outline-none" required>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="p-8 border-b border-gray-100">
                <h2 class="text-lg font-bold text-gray-800 mb-4">📅 Waktu & Lokasi</h2>
                <div class="space-y-4">
                    <div class="grid md:grid-cols-2 gap-4">
                        <div>
                            <label class="text-xs font-bold text-gray-600">Tanggal & Waktu</label>
                            <input type="datetime-local" name="event_date" class="w-full border p-2 rounded outline-none focus:border-pink-500" required>
                        </div>
                        <div>
                            <label class="text-xs font-bold text-gray-600">Nama Gedung/Tempat</label>
                            <input type="text" name="location_name" class="w-full border p-2 rounded outline-none focus:border-pink-500" required>
                        </div>
                    </div>
                    <div>
                        <label class="text-xs font-bold text-gray-600">Alamat Lengkap</label>
                        <textarea name="location_address" rows="2" class="w-full border p-2 rounded outline-none focus:border-pink-500" required></textarea>
                    </div>
                    <div>
                        <label class="text-xs font-bold text-blue-600">Link Google Maps (Opsional)</label>
                        <input type="url" name="google_maps_link" placeholder="https://maps.google.com/..." class="w-full border p-2 rounded outline-none focus:border-blue-500">
                    </div>
                </div>
            </div>

            <div class="p-8 bg-gray-50">
                <h2 class="text-lg font-bold text-gray-800 mb-4">🎁 Amplop Digital</h2>
                <div class="grid md:grid-cols-3 gap-4">
                    <div>
                        <label class="text-xs font-bold text-gray-500">Bank / E-Wallet</label>
                        <input type="text" name="bank_name" placeholder="BCA" class="w-full border p-2 rounded">
                    </div>
                    <div>
                        <label class="text-xs font-bold text-gray-500">No. Rekening</label>
                        <input type="number" name="bank_account_number" placeholder="12345678" class="w-full border p-2 rounded">
                    </div>
                    <div>
                        <label class="text-xs font-bold text-gray-500">Atas Nama</label>
                        <input type="text" name="bank_account_holder" placeholder="Riza Sukma" class="w-full border p-2 rounded">
                    </div>
                </div>
            </div>

            <div class="p-6 bg-gray-100 text-right border-t border-gray-200">
                <button type="submit" class="bg-pink-600 text-white font-bold py-4 px-10 rounded-full hover:bg-pink-700 shadow-lg hover:shadow-pink-500/40 transition transform hover:-translate-y-1">
                    ✨ Buat Undangan Sekarang
                </button>
            </div>

        </form>
    </div>

</body>
</html>