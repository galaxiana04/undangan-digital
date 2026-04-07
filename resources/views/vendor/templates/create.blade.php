<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-teal-800 leading-tight flex items-center gap-2">
            <a href="{{ route('dashboard') }}" class="text-stone-400 hover:text-teal-600 transition"><i
                    class="fa-solid fa-arrow-left"></i></a>
            {{ __('Upload Desain Baru') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-orange-50/50 min-h-screen">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            <div
                class="bg-white shadow-xl shadow-teal-900/5 rounded-3xl overflow-hidden border border-stone-100 relative">
                <div class="absolute top-0 right-0 w-64 h-64 bg-teal-50 rounded-bl-full -z-10"></div>

                <div class="p-8 border-b border-stone-100">
                    <h3 class="text-2xl font-serif font-bold text-teal-900 mb-1">Rilis Karyamu 🚀</h3>
                    <p class="text-stone-500 text-sm">Pastikan gambar thumbnail terlihat menarik agar banyak calon
                        pengantin yang memilih desainmu.</p>
                </div>

                <form action="{{ route('vendor.templates.store') }}" method="POST" enctype="multipart/form-data"
                    class="p-8 space-y-6">
                    @csrf

                    @if ($errors->any())
                        <div class="bg-red-50 border border-red-200 text-red-600 px-6 py-4 rounded-xl text-sm">
                            <ul class="list-disc pl-5 font-bold">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div>
                        <label class="block text-sm font-bold text-stone-700 mb-2">Nama Tema / Desain</label>
                        <input type="text" name="name" placeholder="Contoh: Elegan Rustic Tosca"
                            class="w-full bg-stone-50 border border-stone-200 text-stone-700 text-sm rounded-xl focus:ring-4 focus:ring-teal-500/20 focus:border-teal-500 block p-4 outline-none transition duration-200"
                            required>
                    </div>

                    <div class="grid grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-bold text-stone-700 mb-2">Kategori Harga</label>
                            <select name="type"
                                class="w-full bg-stone-50 border border-stone-200 text-stone-700 text-sm rounded-xl focus:ring-4 focus:ring-teal-500/20 focus:border-teal-500 block p-4 outline-none transition duration-200 appearance-none"
                                required>
                                <option value="Free">Gratis (Bagus untuk Promosi)</option>
                                <option value="Premium">Premium</option>
                                <option value="Luxury">Luxury</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-stone-700 mb-2">Harga Jual (Rp)</label>
                            <input type="number" name="price" placeholder="Contoh: 50000 (Tulis 0 jika Gratis)"
                                class="w-full bg-stone-50 border border-stone-200 text-stone-700 text-sm rounded-xl focus:ring-4 focus:ring-teal-500/20 focus:border-teal-500 block p-4 outline-none transition duration-200"
                                required>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-stone-700 mb-2">Fitur Unggulan Template Ini</label>
                        <p class="text-xs text-stone-400 mb-2">Pisahkan dengan tanda koma (,). Contoh: Galeri Foto,
                            Countdown Timer, Musik Autoplay</p>
                        <textarea name="features" rows="3" placeholder="Ketik fitur di sini..."
                            class="w-full bg-stone-50 border border-stone-200 text-stone-700 text-sm rounded-xl focus:ring-4 focus:ring-teal-500/20 focus:border-teal-500 block p-4 outline-none transition duration-200 resize-y"
                            required></textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-stone-700 mb-2">Upload Thumbnail (Wajib)</label>
                        <div
                            class="border-2 border-dashed border-teal-200 rounded-2xl p-8 text-center bg-teal-50/50 hover:bg-teal-50 transition cursor-pointer group relative overflow-hidden">
                            <div class="text-4xl text-teal-300 mb-2 group-hover:scale-110 transition transform"><i
                                    class="fa-solid fa-cloud-arrow-up"></i></div>
                            <p class="text-sm text-teal-700 font-bold mb-1">Klik untuk memilih gambar</p>
                            <p class="text-xs text-stone-400">PNG, JPG atau WEBP (Maks. 2MB)</p>
                            <input type="file" name="thumbnail" accept="image/*"
                                class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" required>
                        </div>
                    </div>

                    <div class="pt-6">
                        <button type="submit"
                            class="w-full bg-teal-600 text-white font-bold py-4 rounded-xl hover:bg-teal-700 shadow-lg shadow-teal-600/30 transition transform hover:-translate-y-1">
                            🚀 Rilis Desain Sekarang
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</x-app-layout>