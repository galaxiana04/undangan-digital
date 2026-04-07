<!DOCTYPE html>
<html lang="id">

<head>
    <title>Isi Data Undangan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>

<body class="bg-orange-50 min-h-screen pb-20">

    <div class="bg-white shadow-sm py-4 mb-8">
        <div class="max-w-3xl mx-auto px-4 flex justify-between items-center">
            <h1 class="text-lg font-bold text-teal-800">Lengkapi Data Pernikahan</h1>
            <a href="{{ route('katalog') }}" class="text-sm text-gray-500 hover:text-teal-600">Ganti Template</a>
        </div>
    </div>

    <div class="max-w-3xl mx-auto px-4">
        <form action="{{ route('invitation.store') }}" method="POST" enctype="multipart/form-data"
            class="bg-white shadow-xl rounded-2xl overflow-hidden border border-teal-50">
            @csrf

            <input type="hidden" name="preset_name" value="{{ $selectedPreset }}">
            <input type="hidden" name="template_id" value="{{ request('template_id', old('template_id')) }}">

            <div class="bg-teal-50 border-b border-teal-100 p-6 flex items-center gap-4">
                <div
                    class="w-12 h-12 bg-white rounded-full flex items-center justify-center text-teal-600 text-xl shadow-sm">
                    🎨</div>
                <div>
                    <p class="text-xs text-teal-600 font-bold uppercase">Template Terpilih:</p>
                    <h2 class="text-xl font-bold text-gray-800 capitalize">{{ str_replace('-', ' ', $selectedPreset) }}
                    </h2>
                </div>
            </div>

            <div class="p-8 space-y-8">

                @if ($errors->any())
                    <div class="bg-red-50 border border-red-200 text-red-600 px-6 py-4 rounded-xl text-sm mb-6">
                        <ul class="list-disc pl-5 font-bold">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div>
                    <h3 class="font-bold text-gray-800 mb-4 border-b pb-2">1. Link & Foto</h3>
                    <div class="grid md:grid-cols-2 gap-4">
                        <div>
                            <label class="text-xs font-bold text-gray-500">Link Website</label>
                            <div class="flex mt-1">
                                <span
                                    class="bg-gray-100 px-3 py-2 text-xs text-gray-500 rounded-l border border-r-0">rizasukma.inv/</span>
                                <input type="text" name="slug" value="{{ old('slug') }}" placeholder="nama-pasangan"
                                    class="w-full border px-3 py-2 text-sm rounded-r focus:ring-teal-500 focus:border-teal-500 outline-none"
                                    required>
                            </div>
                        </div>
                        <div>
                            <label class="text-xs font-bold text-gray-500">Foto Utama (Opsional)</label>
                            <input type="file" name="custom_photo"
                                class="mt-1 block w-full text-xs text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-semibold file:bg-teal-50 file:text-teal-700 hover:file:bg-teal-100">
                        </div>
                    </div>
                </div>

                <div>
                    <h3 class="font-bold text-gray-800 mb-4 border-b pb-2">2. Data Mempelai</h3>
                    <div class="grid md:grid-cols-2 gap-6">
                        <div class="bg-blue-50/50 p-4 rounded-lg">
                            <span class="text-xs font-bold text-blue-800 uppercase">Pria</span>
                            <input type="text" name="groom_name" value="{{ old('groom_name') }}"
                                placeholder="Nama Lengkap" class="w-full mt-2 border p-2 text-sm rounded mb-2" required>
                            <input type="text" name="groom_nickname" value="{{ old('groom_nickname') }}"
                                placeholder="Nama Panggilan" class="w-full border p-2 text-sm rounded" required>
                        </div>
                        <div class="bg-pink-50/50 p-4 rounded-lg">
                            <span class="text-xs font-bold text-pink-800 uppercase">Wanita</span>
                            <input type="text" name="bride_name" value="{{ old('bride_name') }}"
                                placeholder="Nama Lengkap" class="w-full mt-2 border p-2 text-sm rounded mb-2" required>
                            <input type="text" name="bride_nickname" value="{{ old('bride_nickname') }}"
                                placeholder="Nama Panggilan" class="w-full border p-2 text-sm rounded" required>
                        </div>
                    </div>
                </div>

                <div>
                    <h3 class="font-bold text-gray-800 mb-4 border-b pb-2">3. Waktu & Tempat</h3>
                    <div class="grid md:grid-cols-2 gap-4 mb-4">
                        <input type="datetime-local" name="event_date" value="{{ old('event_date') }}"
                            class="border p-2 text-sm rounded w-full" required>
                        <input type="text" name="location_name" value="{{ old('location_name') }}"
                            placeholder="Nama Gedung / Hotel" class="border p-2 text-sm rounded w-full" required>
                    </div>
                    <textarea name="location_address" rows="2" placeholder="Alamat Lengkap"
                        class="border p-2 text-sm rounded w-full mb-2" required>{{ old('location_address') }}</textarea>
                    <input type="url" name="google_maps_link" value="{{ old('google_maps_link') }}"
                        placeholder="Link Google Maps (Opsional)" class="border p-2 text-sm rounded w-full">
                </div>

                <div class="bg-gray-50 p-4 rounded-lg">
                    <h3 class="font-bold text-gray-800 mb-2">Amplop Digital</h3>
                    <div class="grid grid-cols-3 gap-2">
                        <input type="text" name="bank_name" value="{{ old('bank_name') }}" placeholder="Nama Bank (BCA)"
                            class="border p-2 text-sm rounded">
                        <input type="number" name="bank_account_number" value="{{ old('bank_account_number') }}"
                            placeholder="No Rekening" class="border p-2 text-sm rounded">
                        <input type="text" name="bank_account_holder" value="{{ old('bank_account_holder') }}"
                            placeholder="Atas Nama" class="border p-2 text-sm rounded">
                    </div>
                </div>

            </div>

            <div class="p-6 bg-gray-50 text-right border-t">
                <button type="submit"
                    class="bg-teal-600 text-white font-bold py-3 px-8 rounded-full hover:bg-teal-700 shadow-lg hover:shadow-teal-500/30 transition transform hover:-translate-y-1">
                    Buat Undangan Sekarang
                </button>
            </div>

        </form>
    </div>

</body>

</html>