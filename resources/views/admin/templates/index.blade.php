<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-teal-800 leading-tight">
            {{ __('Kelola Template Undangan') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-orange-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div
                    class="mb-6 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl relative flex items-center gap-3">
                    <i class="fa-solid fa-circle-check"></i> {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl border border-stone-100">
                <div class="p-6 border-b border-stone-100 flex justify-between items-center bg-stone-50/50">
                    <h3 class="font-bold text-lg text-stone-800">Daftar Template Tersedia</h3>
                    <a href="{{ route('admin.templates.create') }}"
                        class="bg-teal-600 text-white px-5 py-2 rounded-full font-bold text-sm shadow hover:bg-teal-700 transition flex items-center gap-2">
                        <i class="fa-solid fa-plus"></i> Tambah Template Baru
                    </a>
                </div>

                <div class="p-0 overflow-x-auto">
                    <table class="w-full text-sm text-left text-stone-600">
                        <thead class="text-xs text-stone-400 uppercase bg-white border-b border-stone-100">
                            <tr>
                                <th class="px-6 py-4">Thumbnail</th>
                                <th class="px-6 py-4">Nama & Tipe</th>
                                <th class="px-6 py-4">Harga</th>
                                <th class="px-6 py-4 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($templates as $item)
                                <tr class="bg-white border-b border-stone-50 hover:bg-orange-50/30 transition">
                                    <td class="px-6 py-4">
                                        <div
                                            class="w-16 h-16 rounded-lg overflow-hidden border border-stone-200 bg-stone-100 flex items-center justify-center">
                                            @if($item->thumbnail)
                                                <img src="{{ asset('storage/' . $item->thumbnail) }}"
                                                    class="w-full h-full object-cover">
                                            @else
                                                <i class="fa-solid fa-image text-stone-300 text-2xl"></i>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <h4 class="font-bold text-stone-800 text-base">{{ $item->name }}</h4>
                                        <span
                                            class="text-[10px] font-bold uppercase tracking-wider bg-teal-50 text-teal-600 px-2 py-1 rounded">{{ $item->type }}</span>
                                    </td>
                                    <td class="px-6 py-4 font-bold text-teal-600">
                                        {{ $item->price == 0 ? 'Gratis' : 'Rp ' . number_format($item->price, 0, ',', '.') }}
                                    </td>
                                    <td class="px-6 py-4 text-center flex justify-center gap-2">
                                    <td class="px-6 py-4 text-center flex justify-center gap-2">
                                        <a href="{{ route('admin.templates.edit', $item->id) }}"
                                            class="bg-amber-50 text-amber-600 px-3 py-2 rounded-lg text-xs font-bold hover:bg-amber-500 hover:text-white transition"
                                            title="Edit">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>

                                        <form action="{{ route('admin.templates.destroy', $item->id) }}" method="POST"
                                            onsubmit="return confirm('Yakin ingin menghapus template ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="bg-red-50 text-red-500 px-3 py-2 rounded-lg text-xs font-bold hover:bg-red-500 hover:text-white transition"
                                                title="Hapus">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-12 text-center text-stone-400 italic">
                                        Belum ada template. Klik "Tambah Template Baru" untuk mengunggah desain Anda.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>