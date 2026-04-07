<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-teal-800 leading-tight">
            {{ __('Dashboard Pengelola (Admin)') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-orange-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div
                class="bg-white p-8 rounded-2xl shadow-sm border border-stone-100 mb-8 flex flex-col md:flex-row justify-between items-center gap-4">
                <div class="flex items-center gap-4">
                    <div
                        class="w-16 h-16 bg-teal-100 rounded-full flex items-center justify-center text-teal-600 font-bold text-3xl shadow-sm">
                        👑
                    </div>
                    <div>
                        <h3 class="text-2xl font-serif font-bold text-stone-800">Halo, {{ Auth::user()->name }}!</h3>
                        <p class="text-stone-500 text-sm mt-1">Selamat datang di Pusat Kendali Riza Sukma Invitation.
                        </p>
                    </div>
                </div>

                <a href="{{ route('admin.templates.index') }}"
                    class="bg-stone-800 text-white px-6 py-3 rounded-full font-bold text-sm shadow-md hover:bg-teal-600 transition flex items-center gap-2">
                    <i class="fa-solid fa-palette"></i> Kelola Template
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div
                    class="bg-white p-6 rounded-2xl shadow-sm border border-stone-100 flex items-center gap-4 border-l-4 border-l-teal-500">
                    <div class="p-3 bg-teal-50 rounded-xl text-teal-600 text-2xl">
                        <i class="fa-solid fa-users"></i>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-stone-400 uppercase tracking-wider">Total Pengguna</p>
                        <h4 class="text-2xl font-bold text-stone-800">{{ \App\Models\User::count() }} <span
                                class="text-sm font-normal text-stone-400">Akun</span></h4>
                    </div>
                </div>

                <div
                    class="bg-white p-6 rounded-2xl shadow-sm border border-stone-100 flex items-center gap-4 border-l-4 border-l-orange-400">
                    <div class="p-3 bg-orange-50 rounded-xl text-orange-500 text-2xl">
                        <i class="fa-solid fa-envelope-open-text"></i>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-stone-400 uppercase tracking-wider">Undangan Aktif</p>
                        <h4 class="text-2xl font-bold text-stone-800">{{ \App\Models\Invitation::count() }} <span
                                class="text-sm font-normal text-stone-400">Link</span></h4>
                    </div>
                </div>

                <div
                    class="bg-white p-6 rounded-2xl shadow-sm border border-stone-100 flex items-center gap-4 border-l-4 border-l-stone-700">
                    <div class="p-3 bg-stone-100 rounded-xl text-stone-600 text-2xl">
                        <i class="fa-solid fa-layer-group"></i>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-stone-400 uppercase tracking-wider">Template Desain</p>
                        <h4 class="text-2xl font-bold text-stone-800">{{ \App\Models\Template::count() }} <span
                                class="text-sm font-normal text-stone-400">Tema</span></h4>
                    </div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl border border-stone-100">
                <div class="p-6 border-b border-stone-100 bg-stone-50/50">
                    <h3 class="font-bold text-lg text-stone-800">Aktivitas Undangan Terbaru</h3>
                </div>
                <div class="p-0">
                    <table class="w-full text-sm text-left text-stone-600">
                        <thead class="text-xs text-stone-400 uppercase bg-white border-b border-stone-100">
                            <tr>
                                <th class="px-6 py-4">Pasangan</th>
                                <th class="px-6 py-4">Pembuat (User)</th>
                                <th class="px-6 py-4">Tanggal Acara</th>
                                <th class="px-6 py-4 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse(\App\Models\Invitation::with('user')->latest()->take(5)->get() as $inv)
                                <tr class="bg-white border-b border-stone-50 hover:bg-orange-50/30 transition">
                                    <td class="px-6 py-4 font-bold text-stone-800">
                                        {{ $inv->groom_nickname }} & {{ $inv->bride_nickname }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $inv->user->name ?? 'Unknown' }}
                                    </td>
                                    <td class="px-6 py-4 text-stone-500">
                                        {{ \Carbon\Carbon::parse($inv->event_date)->format('d M Y') }}
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <a href="{{ url('/' . $inv->slug) }}" target="_blank"
                                            class="bg-teal-50 text-teal-600 px-3 py-1 rounded-full text-xs font-bold hover:bg-teal-600 hover:text-white transition">
                                            Lihat Web
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-8 text-center text-stone-400 italic">
                                        Belum ada undangan yang dibuat di platform ini.
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