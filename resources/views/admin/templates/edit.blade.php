<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-teal-800 leading-tight flex items-center gap-2">
            <a href="{{ route('admin.templates.index') }}" class="text-stone-400 hover:text-teal-600">
                <i class="fa-solid fa-arrow-left text-sm"></i>
            </a>
            {{ __('Edit Template: ' . $template->name) }}
        </h2>
    </x-slot>

    <div class="py-12 bg-orange-50 min-h-screen">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            <form action="{{ route('admin.templates.update', $template->id) }}" method="POST"
                enctype="multipart/form-data"
                class="bg-white shadow-sm rounded-[2rem] overflow-hidden border border-stone-100">
                @csrf
                @method('PUT')

                <div class="p-8 space-y-6">
                    <div>
                        <label class="block text-sm font-bold text-stone-700 mb-2">Nama Template / Tema</label>
                        <input type="text" name="name" value="{{ old('name', $template->name) }}"
                            class="w-full border-stone-200 rounded-xl focus:ring-teal-500 focus:border-teal-500"
                            required>
                    </div>

                    <div class="grid grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-bold text-stone-700 mb-2">Tipe Paket</label>
                            <select name="type"
                                class="w-full border-stone-200 rounded-xl focus:ring-teal-500 focus:border-teal-500"
                                required>
                                @foreach(['Free', 'Ekonomi', 'Premium', 'Platinum', 'Luxury'] as $option)
                                    <option value="{{ $option }}" {{ $template->type == $option ? 'selected' : '' }}>
                                        {{ $option }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-stone-700 mb-2">Harga (Rp)</label>
                            <input type="number" name="price" value="{{ old('price', $template->price) }}"
                                class="w-full border-stone-200 rounded-xl focus:ring-teal-500 focus:border-teal-500"
                                required>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-stone-700 mb-2">Fitur Unggulan</label>
                        <p class="text-xs text-stone-400 mb-2">Pisahkan dengan tanda koma (,).</p>
                        @php
                            // Mengubah JSON kembali ke string koma agar mudah diedit user
                            $featuresString = implode(', ', json_decode($template->features));
                        @endphp
                        <textarea name="features" rows="2"
                            class="w-full border-stone-200 rounded-xl focus:ring-teal-500 focus:border-teal-500"
                            required>{{ old('features', $featuresString) }}</textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-stone-700 mb-2">Thumbnail (Biarkan kosong jika tidak
                            ingin diganti)</label>
                        <div class="flex items-center gap-4 mb-3">
                            <div class="w-20 h-20 rounded-lg overflow-hidden border border-stone-200">
                                <img src="{{ asset('storage/' . $template->thumbnail) }}"
                                    class="w-full h-full object-cover">
                            </div>
                            <p class="text-[10px] text-stone-400 italic leading-tight">Thumbnail saat ini.<br>Upload
                                file baru untuk menggantinya.</p>
                        </div>
                        <div
                            class="border-2 border-dashed border-stone-300 rounded-xl p-6 text-center bg-stone-50 hover:bg-teal-50 transition cursor-pointer">
                            <input type="file" name="thumbnail" accept="image/*"
                                class="w-full text-sm text-stone-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-teal-100 file:text-teal-700 hover:file:bg-teal-200">
                        </div>
                    </div>
                </div>

                <div class="px-8 py-5 bg-stone-50 border-t border-stone-100 text-right">
                    <button type="submit"
                        class="bg-teal-600 text-white font-bold py-3 px-10 rounded-full hover:bg-teal-700 shadow-lg transition transform hover:-translate-y-1">
                        Simpan Perubahan
                    </button>
                </div>
            </form>

        </div>
    </div>
</x-app-layout>