<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-teal-800 leading-tight flex items-center gap-2">
            <a href="{{ route('admin.templates.index') }}" class="text-stone-400 hover:text-teal-600"><i
                    class="fa-solid fa-arrow-left"></i></a>
            {{ __('Tambah Template Baru') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-orange-50 min-h-screen">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            <form action="{{ route('admin.templates.store') }}" method="POST" enctype="multipart/form-data"
                class="bg-white shadow-sm rounded-2xl overflow-hidden border border-stone-100">
                @csrf

                <div class="p-8 space-y-6">
                    <div>
                        <label class="block text-sm font-bold text-stone-700 mb-2">Nama Template / Tema</label>
                        <input type="text" name="name" placeholder="Contoh: Tosca Modern Minimalis"
                            class="w-full border-stone-200 rounded-xl focus:ring-teal-500 focus:border-teal-500"
                            required>
                    </div>

                    <div class="grid grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-bold text-stone-700 mb-2">Tipe Paket</label>
                            <select name="type"
                                class="w-full border-stone-200 rounded-xl focus:ring-teal-500 focus:border-teal-500"
                                required>
                                <option value="Free">Free</option>
                                <option value="Ekonomi">Ekonomi</option>
                                <option value="Premium">Premium</option>
                                <option value="Platinum">Platinum</option>
                                <option value="Luxury">Luxury</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-stone-700 mb-2">Harga (Rp)</label>
                            <input type="number" name="price" placeholder="Contoh: 49000 (Tulis 0 jika Gratis)"
                                class="w-full border-stone-200 rounded-xl focus:ring-teal-500 focus:border-teal-500"
                                required>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-stone-700 mb-2">Fitur Unggulan</label>
                        <p class="text-xs text-stone-400 mb-2">Pisahkan dengan tanda koma (,). Contoh: Musik, Peta
                            Lokasi, Dark Mode, Amplop Digital</p>
                        <textarea name="features" rows="2"
                            class="w-full border-stone-200 rounded-xl focus:ring-teal-500 focus:border-teal-500"
                            required></textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-stone-700 mb-2">Upload Thumbnail (Gambar
                            Preview)</label>
                        <div
                            class="border-2 border-dashed border-stone-300 rounded-xl p-6 text-center bg-stone-50 hover:bg-teal-50 transition cursor-pointer">
                            <input type="file" name="thumbnail" accept="image/*"
                                class="w-full text-sm text-stone-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-teal-100 file:text-teal-700 hover:file:bg-teal-200"
                                required>
                        </div>
                    </div>
                </div>

                <div class="px-8 py-5 bg-stone-50 border-t border-stone-100 text-right">
                    <button type="submit"
                        class="bg-teal-600 text-white font-bold py-3 px-8 rounded-full hover:bg-teal-700 shadow-md transition transform hover:-translate-y-1">
                        Simpan Template
                    </button>
                </div>
            </form>

        </div>
    </div>
</x-app-layout>