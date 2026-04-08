<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-teal-800 leading-tight">
            {{ __('Dashboard Pengelola (Admin)') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-orange-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            <div
                class="bg-white p-8 rounded-[2rem] shadow-sm border border-stone-100 flex flex-col md:flex-row justify-between items-center gap-4 transition-all hover:shadow-md">
                <div class="flex items-center gap-5">
                    <div
                        class="w-16 h-16 bg-teal-100 rounded-full flex items-center justify-center text-teal-600 font-bold text-3xl shadow-inner">
                        👑
                    </div>
                    <div>
                        <h3 class="text-2xl font-serif font-bold text-stone-800">Halo, {{ Auth::user()->name }}!</h3>
                        <p class="text-stone-500 text-sm mt-1 uppercase tracking-widest font-semibold text-[10px]">
                            Administrator Platform</p>
                    </div>
                </div>
                <div class="flex gap-3">
                    <a href="{{ route('admin.templates.index') }}"
                        class="bg-stone-800 text-white px-6 py-3 rounded-full font-bold text-sm shadow-md hover:bg-teal-700 transition flex items-center gap-2">
                        <i class="fa-solid fa-palette"></i> Kelola Template
                    </a>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <div
                    class="bg-white p-6 rounded-3xl border border-stone-100 shadow-sm flex items-center gap-4 border-l-4 border-l-teal-500 transition-transform hover:-translate-y-1">
                    <div class="p-3 bg-teal-50 rounded-2xl text-teal-600 text-xl">
                        <i class="fa-solid fa-users"></i>
                    </div>
                    <div>
                        <p class="text-[10px] font-bold text-stone-400 uppercase tracking-widest">Pengguna</p>
                        <h4 class="text-2xl font-black text-stone-800">{{ \App\Models\User::count() }}</h4>
                    </div>
                </div>

                <div
                    class="bg-white p-6 rounded-3xl border border-stone-100 shadow-sm flex items-center gap-4 border-l-4 border-l-orange-400 transition-transform hover:-translate-y-1">
                    <div class="p-3 bg-orange-50 rounded-2xl text-orange-500 text-xl">
                        <i class="fa-solid fa-envelope-open-text"></i>
                    </div>
                    <div>
                        <p class="text-[10px] font-bold text-stone-400 uppercase tracking-widest">Undangan</p>
                        <h4 class="text-2xl font-black text-stone-800">{{ \App\Models\Invitation::count() }}</h4>
                    </div>
                </div>

                <div
                    class="bg-white p-6 rounded-3xl border border-stone-100 shadow-sm flex items-center gap-4 border-l-4 border-l-blue-500 transition-transform hover:-translate-y-1">
                    <div class="p-3 bg-blue-50 rounded-2xl text-blue-600 text-xl">
                        <i class="fa-solid fa-money-bill-transfer"></i>
                    </div>
                    <div>
                        <p class="text-[10px] font-bold text-stone-400 uppercase tracking-widest">Total Omzet</p>
                        <h4 class="text-xl font-black text-stone-800">
                            Rp
                            {{ number_format(\App\Models\Transaction::where('status', 'PAID')->sum('amount'), 0, ',', '.') }}
                        </h4>
                    </div>
                </div>

                <div
                    class="bg-teal-900 p-6 rounded-3xl shadow-xl border border-teal-800 flex items-center gap-4 transition-transform hover:-translate-y-1 relative overflow-hidden">
                    <div class="p-3 bg-white/10 rounded-2xl text-teal-300 text-xl relative z-10">
                        <i class="fa-solid fa-sack-dollar"></i>
                    </div>
                    <div class="relative z-10">
                        <p class="text-[10px] font-bold text-teal-300 uppercase tracking-widest">Profit (10%)</p>
                        <h4 class="text-xl font-black text-white">
                            @php
                                $totalPaid = \App\Models\Transaction::where('status', 'PAID')->sum('amount');
                                $hasilAdmin = $totalPaid * 0.10;
                            @endphp
                            Rp {{ number_format($hasilAdmin, 0, ',', '.') }}
                        </h4>
                    </div>
                    <div class="absolute -right-2 -bottom-2 opacity-10 text-6xl text-white">✨</div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm rounded-[2rem] border border-stone-100">
                <div class="p-6 border-b border-stone-100 bg-stone-50/50 flex justify-between items-center">
                    <h3 class="font-bold text-lg text-stone-800 flex items-center gap-2">
                        <i class="fa-solid fa-clock-rotate-left text-teal-600"></i> Aktivitas Undangan Terbaru
                    </h3>
                </div>
                <div class="p-0 overflow-x-auto">
                    <table class="w-full text-sm text-left text-stone-600">
                        <thead class="text-[10px] text-stone-400 uppercase bg-white border-b border-stone-100">
                            <tr>
                                <th class="px-8 py-4">Pasangan</th>
                                <th class="px-8 py-4">Pembuat</th>
                                <th class="px-8 py-4 text-center">Acara</th>
                                <th class="px-8 py-4 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-stone-50">
                            @forelse(\App\Models\Invitation::with('user')->latest()->take(5)->get() as $inv)
                                <tr class="hover:bg-teal-50/30 transition">
                                    <td class="px-8 py-4">
                                        <p class="font-bold text-stone-800">{{ $inv->groom_nickname }} &
                                            {{ $inv->bride_nickname }}</p>
                                    </td>
                                    <td class="px-8 py-4">
                                        <div class="flex flex-col">
                                            <span
                                                class="text-stone-800 font-medium">{{ $inv->user->name ?? 'Unknown' }}</span>
                                            <span class="text-[10px] text-stone-400">ID: #{{ $inv->user_id }}</span>
                                        </div>
                                    </td>
                                    <td class="px-8 py-4 text-center">
                                        <span
                                            class="bg-stone-100 text-stone-600 px-3 py-1 rounded-full text-[10px] font-bold">
                                            {{ \Carbon\Carbon::parse($inv->event_date)->format('d M Y') }}
                                        </span>
                                    </td>
                                    <td class="px-8 py-4 text-center">
                                        <a href="{{ url('/' . $inv->slug) }}" target="_blank"
                                            class="inline-flex items-center gap-1 text-teal-600 font-bold hover:text-teal-800 transition text-xs">
                                            Preview <i class="fa-solid fa-arrow-up-right-from-square text-[10px]"></i>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-8 py-12 text-center">
                                        <div class="flex flex-col items-center opacity-30">
                                            <i class="fa-solid fa-folder-open text-4xl mb-2"></i>
                                            <p class="italic">Belum ada aktivitas terbaru.</p>
                                        </div>
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