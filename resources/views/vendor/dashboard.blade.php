<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-teal-800 leading-tight">
            {{ __('Ruang Kreator (Vendor)') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-orange-50/50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            @if(session('success'))
                <div
                    class="bg-teal-50 border border-teal-200 text-teal-700 px-6 py-4 rounded-2xl flex items-center gap-3 shadow-sm font-bold">
                    <i class="fa-solid fa-circle-check text-xl"></i> {{ session('success') }}
                </div>
            @endif

            <div
                class="bg-gradient-to-br from-teal-700 to-teal-900 rounded-3xl p-8 shadow-lg text-white flex flex-col md:flex-row justify-between items-center gap-6 relative overflow-hidden">
                <div class="absolute -top-24 -right-24 w-64 h-64 bg-white/10 rounded-full blur-3xl"></div>

                <div class="relative z-10 text-center md:text-left">
                    <span
                        class="bg-teal-600 text-teal-100 text-[10px] font-bold px-3 py-1 rounded-full uppercase tracking-widest mb-4 inline-block shadow-sm">
                        Mode Penjual Aktif
                    </span>
                    <h3 class="text-3xl font-serif font-bold mb-2">Toko {{ Auth::user()->name }} 🎨</h3>
                    <p class="text-teal-100 text-sm max-w-xl leading-relaxed">
                        Ini adalah pusat kendali untuk mengelola karya desainmu, memantau penjualan, dan menarik
                        penghasilan. Mari hasilkan karya hebat hari ini!
                    </p>
                </div>

                <div class="relative z-10 shrink-0">
                    <a href="{{ route('vendor.templates.create') }}"
                        class="bg-white text-teal-800 px-8 py-4 rounded-full font-bold shadow-xl hover:bg-teal-50 hover:scale-105 transition duration-300 transform flex items-center gap-2">
                        <i class="fa-solid fa-cloud-arrow-up"></i> Upload Desain Baru
                    </a>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-stone-100 flex items-center gap-5">
                    <div
                        class="w-14 h-14 bg-green-50 border border-green-100 rounded-2xl flex items-center justify-center text-green-500 text-2xl">
                        <i class="fa-solid fa-wallet"></i>
                    </div>
                    <div>
                        <p class="text-[10px] font-bold text-stone-400 uppercase tracking-wider mb-1">Pendapatan Bulan
                            Ini</p>
                        <h4 class="text-2xl font-bold text-stone-800">Rp
                            {{ number_format($totalPendapatan, 0, ',', '.') }}</h4>
                    </div>
                </div>
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-stone-100 flex items-center gap-5">
                    <div
                        class="w-14 h-14 bg-blue-50 border border-blue-100 rounded-2xl flex items-center justify-center text-blue-500 text-2xl">
                        <i class="fa-solid fa-palette"></i>
                    </div>
                    <div>
                        <p class="text-[10px] font-bold text-stone-400 uppercase tracking-wider mb-1">Total Desain Aktif
                        </p>
                        <h4 class="text-2xl font-bold text-stone-800">{{ $templates->count() }} <span
                                class="text-sm font-normal text-stone-400">Karya</span></h4>
                    </div>
                </div>
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-stone-100 flex items-center gap-5">
                    <div
                        class="w-14 h-14 bg-orange-50 border border-orange-100 rounded-2xl flex items-center justify-center text-orange-500 text-2xl">
                        <i class="fa-solid fa-cart-shopping"></i>
                    </div>
                    <div>
                        <p class="text-[10px] font-bold text-stone-400 uppercase tracking-wider mb-1">Template Terjual
                        </p>
                        <h4 class="text-2xl font-bold text-stone-800">{{ $totalTerjual }} <span
                                class="text-sm font-normal text-stone-600">Kali</span></h4>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <div class="lg:col-span-2 bg-white rounded-3xl shadow-sm border border-stone-100 overflow-hidden">
                    <div class="p-6 border-b border-stone-100 flex justify-between items-center bg-stone-50/30">
                        <h3 class="font-bold text-lg text-stone-800"><i
                                class="fa-solid fa-layer-group text-teal-500 mr-2"></i> Karya Desain Saya</h3>
                    </div>

                    @if($templates->isEmpty())
                        <div class="p-16 text-center flex flex-col items-center justify-center">
                            <div
                                class="w-24 h-24 bg-stone-50 rounded-full flex items-center justify-center text-4xl mb-6 border border-stone-100 shadow-inner">
                                🖼️</div>
                            <h4 class="text-xl font-bold text-stone-800 mb-2">Toko Masih Kosong</h4>
                            <p class="text-stone-500 text-sm max-w-sm mb-8 leading-relaxed">Mulai langkah pertamamu! Unggah
                                template undangan buatanmu.</p>
                            <a href="{{ route('vendor.templates.create') }}"
                                class="text-teal-700 bg-teal-50 px-6 py-3 rounded-full font-bold border border-teal-200 hover:bg-teal-600 hover:text-white transition shadow-sm inline-block">
                                <i class="fa-solid fa-plus mr-1"></i> Mulai Upload Karya
                            </a>
                        </div>
                    @else
                        <div class="p-0 overflow-x-auto">
                            <table class="w-full text-sm text-left text-stone-600">
                                <thead class="text-xs text-stone-400 uppercase bg-stone-50 border-b border-stone-100">
                                    <tr>
                                        <th class="px-6 py-4">Karya Desain</th>
                                        <th class="px-6 py-4">Harga Jual</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($templates as $item)
                                        <tr class="bg-white border-b border-stone-50 hover:bg-stone-50/50 transition">
                                            <td class="px-6 py-4 flex items-center gap-4">
                                                <div
                                                    class="w-16 h-16 rounded-lg overflow-hidden border border-stone-200 bg-stone-100">
                                                    <img src="{{ asset('storage/' . $item->thumbnail) }}"
                                                        class="w-full h-full object-cover">
                                                </div>
                                                <div>
                                                    <h4 class="font-bold text-stone-800">{{ $item->name }}</h4>
                                                    <span
                                                        class="text-[10px] bg-teal-50 text-teal-600 px-2 py-1 rounded font-bold uppercase">{{ $item->type }}</span>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 font-bold text-teal-600">
                                                {{ $item->price == 0 ? 'Gratis' : 'Rp ' . number_format($item->price, 0, ',', '.') }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>

                <div class="bg-white rounded-3xl shadow-sm border border-stone-100 overflow-hidden flex flex-col">
                    <div class="p-6 border-b border-stone-100 bg-stone-50/30">
                        <h3 class="font-bold text-lg text-stone-800"><i
                                class="fa-solid fa-receipt text-teal-500 mr-2"></i> Penjualan Terbaru</h3>
                    </div>
                    <div class="mt-6 space-y-4">
                        @forelse ($transaksiTerbaru as $trx)
                            <div class="flex justify-between items-center border-b border-stone-100 pb-4">
                                <div>
                                    <p class="font-bold text-stone-800 text-sm">{{ $trx->user->name }}</p>
                                    <p class="text-xs text-stone-500">Membeli:
                                        {{ $trx->invitation->preset_name ?? 'Template' }}</p>
                                </div>
                                <div class="text-right">
                                    <p class="font-bold text-teal-600 text-sm">+ Rp
                                        {{ number_format($trx->amount, 0, ',', '.') }}</p>
                                    <p class="text-[10px] text-stone-400">{{ $trx->created_at->diffForHumans() }}</p>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-8">
                                <i class="fa-solid fa-chart-line text-4xl text-stone-200 mb-2"></i>
                                <p class="text-stone-400 text-sm">Belum Ada Transaksi</p>
                            </div>
                        @endforelse
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>