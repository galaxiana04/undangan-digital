<!DOCTYPE html>
<html>

<head>
    <title>Buat Undangan Baru</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 p-10">

    <div class="max-w-lg mx-auto bg-white p-8 rounded-xl shadow-md">
        <h2 class="text-2xl font-bold mb-6 text-pink-600">Buat Undangan Baru</h2>

        @if ($errors->any())
            <div class="bg-red-100 text-red-500 p-3 mb-4 rounded">
                <ul>@foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach</ul>
            </div>
        @endif

        <form action="{{ route('invitation.store') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label class="block text-sm font-bold mb-1 text-pink-600">Link Website (Slug)</label>
                <input type="text" name="slug" placeholder="contoh: chanyeol-riza"
                    class="w-full border p-2 rounded focus:ring-pink-500 focus:border-pink-500" required>
            </div>

            <div class="bg-blue-50 p-4 rounded-lg border border-blue-200">
                <h3 class="font-bold text-blue-800 mb-2">Mempelai Pria</h3>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold mb-1">Nama Lengkap</label>
                        <input type="text" name="groom_name" placeholder="Park Chanyeol"
                            class="w-full border p-2 rounded" required>
                    </div>
                    <div>
                        <label class="block text-xs font-bold mb-1">Panggilan</label>
                        <input type="text" name="groom_nickname" placeholder="Chanyeol"
                            class="w-full border p-2 rounded" required>
                    </div>
                </div>
            </div>

            <div class="bg-pink-50 p-4 rounded-lg border border-pink-200">
                <h3 class="font-bold text-pink-800 mb-2">Mempelai Wanita</h3>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold mb-1">Nama Lengkap</label>
                        <input type="text" name="bride_name" placeholder="Riza Sukmawardani"
                            class="w-full border p-2 rounded" required>
                    </div>
                    <div>
                        <label class="block text-xs font-bold mb-1">Panggilan</label>
                        <input type="text" name="bride_nickname" placeholder="Riza" class="w-full border p-2 rounded"
                            required>
                    </div>
                </div>
            </div>

            <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                <h3 class="font-bold text-gray-800 mb-2">Detail Acara</h3>
                <div class="space-y-3">
                    <div>
                        <label class="block text-xs font-bold mb-1">Tanggal & Jam</label>
                        <input type="datetime-local" name="event_date" class="w-full border p-2 rounded" required>
                    </div>
                    <div>
                        <label class="block text-xs font-bold mb-1">Nama Gedung/Tempat</label>
                        <input type="text" name="location_name" placeholder="Contoh: Hotel Tentrem Semarang"
                            class="w-full border p-2 rounded" required>
                    </div>
                    <div>
                        <label class="block text-xs font-bold mb-1">Alamat Lengkap (Teks)</label>
                        <textarea name="location_address" rows="2" placeholder="Jl. Gajah Mada No..."
                            class="w-full border p-2 rounded" required></textarea>
                    </div>

                    <div>
                        <label class="block text-xs font-bold mb-1 text-pink-600">Link Google Maps</label>
                        <input type="url" name="google_maps_link" placeholder="https://maps.app.goo.gl/..."
                            class="w-full border p-2 rounded border-pink-300 focus:ring-pink-500">
                        <p class="text-[10px] text-gray-500 mt-1">
                            Cara ambil: Buka Google Maps > Pilih Lokasi > Klik Share > Copy Link
                        </p>
                    </div>
                </div>
            </div>

            <button type="submit"
                class="w-full bg-pink-600 text-white font-bold py-3 rounded-lg hover:bg-pink-700 shadow-lg transition">
                🚀 Buat Undangan Sekarang
            </button>
        </form>
    </div>

</body>

</html>