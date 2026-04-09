<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-teal-800 leading-tight">
            {{ __('Ruang Kreator (Vendor)') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-orange-50/50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            @if(session('success'))
                <div class="bg-teal-50 border border-teal-200 text-teal-700 px-6 py-4 rounded-2xl flex items-center gap-3 shadow-sm font-bold">
                    <i class="fa-solid fa-circle-check text-xl"></i> {{ session('success') }}
                </div>
            @endif

            <div class="bg-gradient-to-br from-teal-700 to-teal-900 rounded-[2.5rem] p-8 shadow-lg text-white flex flex-col md:flex-row justify-between items-center gap-6 relative overflow-hidden">
                <div class="absolute -top-24 -right-24 w-64 h-64 bg-white/10 rounded-full blur-3xl"></div>
                <div class="relative z-10 text-center md:text-left">
                    <span class="bg-teal-600 text-teal-100 text-[10px] font-bold px-3 py-1 rounded-full uppercase tracking-widest mb-4 inline-block shadow-sm">
                        Mode Penjual Aktif
                    </span>
                    <h3 class="text-3xl font-serif font-bold mb-2">Toko {{ Auth::user()->name }} 🎨</h3>
                    <p class="text-teal-100 text-sm max-w-xl leading-relaxed opacity-80">
                        Kelola desain, pantau pendapatan, dan bantu pengantin mewujudkan undangan impian mereka.
                    </p>
                </div>
                <div class="relative z-10 shrink-0">
                    <a href="{{ route('vendor.templates.create') }}"
                        class="bg-white text-teal-800 px-8 py-4 rounded-2xl font-bold shadow-xl hover:bg-teal-50 hover:scale-105 transition duration-300 flex items-center gap-2">
                        <i class="fa-solid fa-cloud-arrow-up"></i> Upload Desain Baru
                    </a>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-white p-6 rounded-[2rem] shadow-sm border border-stone-100 flex items-center gap-5">
                    <div class="w-14 h-14 bg-green-50 rounded-2xl flex items-center justify-center text-green-500 text-2xl">
                        <i class="fa-solid fa-wallet"></i>
                    </div>
                    <div>
                        <p class="text-[10px] font-bold text-stone-400 uppercase tracking-wider mb-1">Saldo Bisa Ditarik</p>
                        <h4 class="text-2xl font-black text-stone-800">Rp {{ number_format($saldoVendor, 0, ',', '.') }}</h4>
                        <button onclick="document.getElementById('modalWithdraw').classList.remove('hidden')" class="text-teal-600 text-[10px] font-bold uppercase mt-1 hover:underline italic">Tarik Sekarang &rarr;</button>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-[2rem] shadow-sm border border-stone-100 flex items-center gap-5">
                    <div class="w-14 h-14 bg-orange-50 rounded-2xl flex items-center justify-center text-orange-500 text-2xl">
                        <i class="fa-solid fa-chart-line"></i>
                    </div>
                    <div>
                        <p class="text-[10px] font-bold text-stone-400 uppercase tracking-wider mb-1">Total Penjualan</p>
                        <h4 class="text-2xl font-black text-stone-800">Rp {{ number_format($totalPenjualan, 0, ',', '.') }}</h4>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-[2rem] shadow-sm border border-stone-100 flex items-center gap-5">
                    <div class="w-14 h-14 bg-blue-50 rounded-2xl flex items-center justify-center text-blue-500 text-2xl">
                        <i class="fa-solid fa-cart-shopping"></i>
                    </div>
                    <div>
                        <p class="text-[10px] font-bold text-stone-400 uppercase tracking-wider mb-1">Total Laku</p>
                        <h4 class="text-2xl font-black text-stone-800">{{ $totalTerjual }} <span class="text-sm font-normal text-stone-400 uppercase">Kali</span></h4>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">
                
                <div class="lg:col-span-2 space-y-8">
                    
                    <div class="bg-white rounded-[2.5rem] shadow-sm border border-stone-100 overflow-hidden">
                        <div class="px-8 py-6 border-b border-stone-50 flex justify-between items-center bg-stone-50/30">
                            <h3 class="font-bold text-lg text-stone-800 flex items-center gap-3">
                                <div class="w-8 h-8 bg-teal-500 rounded-lg flex items-center justify-center text-white shadow-sm">
                                    <i class="fa-solid fa-layer-group text-sm"></i>
                                </div>
                                Karya Desain Saya
                            </h3>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="w-full text-sm text-left">
                                <thead class="text-[10px] text-stone-400 uppercase bg-stone-50/50 font-bold tracking-widest border-b border-stone-50">
                                    <tr>
                                        <th class="px-8 py-4">Informasi Desain</th>
                                        <th class="px-8 py-4 text-right">Harga Jual</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-stone-50">
                                    @forelse($templates as $item)
                                        <tr class="hover:bg-teal-50/10 transition group">
                                            <td class="px-8 py-5 flex items-center gap-5">
                                                <img src="{{ asset('storage/' . $item->thumbnail) }}" class="w-12 h-12 rounded-xl object-cover border border-stone-100">
                                                <div>
                                                    <p class="font-bold text-stone-800 leading-none mb-1">{{ $item->name }}</p>
                                                    <span class="text-[9px] bg-teal-50 text-teal-600 px-2 py-0.5 rounded font-black uppercase border border-teal-100">{{ $item->type }}</span>
                                                </div>
                                            </td>
                                            <td class="px-8 py-5 text-right font-black text-teal-700">
                                                {{ $item->price == 0 ? 'Gratis' : 'Rp ' . number_format($item->price, 0, ',', '.') }}
                                            </td>
                                        </tr>
                                    @empty
                                        <tr><td colspan="2" class="px-8 py-10 text-center opacity-30 italic">Belum ada karya</td></tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="bg-white rounded-[2.5rem] shadow-sm border border-stone-100 overflow-hidden">
                        <div class="px-8 py-6 border-b border-stone-50 flex justify-between items-center bg-teal-50/20">
                            <h3 class="font-bold text-lg text-teal-800 flex items-center gap-3">
                                <div class="w-8 h-8 bg-teal-600 rounded-lg flex items-center justify-center text-white shadow-sm">
                                    <i class="fa-solid fa-wand-magic-sparkles text-sm"></i>
                                </div>
                                Permintaan Edit Kustom
                            </h3>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="w-full text-sm text-left">
                                <thead class="text-[10px] text-stone-400 uppercase bg-stone-50/50 font-bold tracking-widest border-b border-stone-50">
                                    <tr>
                                        <th class="px-8 py-4">Pengantin</th>
                                        <th class="px-8 py-4">Catatan</th>
                                        <th class="px-8 py-4 text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-stone-50">
                                    @forelse($designRequests as $req)
                                        <tr class="hover:bg-stone-50 transition">
                                            <td class="px-8 py-5 whitespace-nowrap">
                                                <p class="font-bold text-stone-800">{{ $req->invitation->user->name }}</p>
                                                <span class="text-[10px] text-teal-600 font-medium italic">Template: {{ $req->invitation->template->name }}</span>
                                            </td>
                                            <td class="px-8 py-5">
                                                <p class="text-[11px] text-stone-500 line-clamp-2 leading-relaxed">"{{ $req->user_notes }}"</p>
                                            </td>
                                            <td class="px-8 py-5 text-center">
                                                <a href="{{ route('vendor.editor', $req->invitation_id) }}" class="inline-flex items-center gap-2 bg-teal-800 text-white px-4 py-2 rounded-xl text-[10px] font-bold hover:bg-teal-900 shadow-md">
                                                    <i class="fa-solid fa-pen-nib"></i> Edit
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr><td colspan="3" class="px-8 py-10 text-center opacity-30 italic">Belum ada antrean kustom</td></tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-[2.5rem] shadow-sm border border-stone-100 overflow-hidden flex flex-col">
                    <div class="p-6 border-b border-stone-100 bg-stone-50/30">
                        <h3 class="font-bold text-lg text-stone-800 flex items-center gap-3">
                            <div class="w-8 h-8 bg-orange-500 rounded-lg flex items-center justify-center text-white shadow-sm">
                                <i class="fa-solid fa-receipt text-sm"></i>
                            </div>
                            Penjualan
                        </h3>
                    </div>
                    <div class="p-4 space-y-3">
                        @forelse ($transaksiTerbaru as $trx)
                            <div class="flex justify-between items-center p-4 rounded-[1.5rem] bg-stone-50/50 border border-transparent hover:border-teal-100 transition">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-full bg-teal-600 flex items-center justify-center text-white text-[10px] font-bold">{{ substr($trx->user->name, 0, 1) }}</div>
                                    <div>
                                        <p class="font-bold text-stone-800 text-xs leading-none mb-1">{{ $trx->user->name }}</p>
                                        <p class="text-[9px] text-stone-400">Membeli: {{ $trx->invitation->template->name ?? 'Premium' }}</p>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <p class="font-black text-teal-600 text-xs">+ Rp {{ number_format($trx->amount * 0.9, 0, ',', '.') }}</p>
                                    <p class="text-[9px] text-stone-300">{{ $trx->created_at->diffForHumans() }}</p>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-12 opacity-30 italic text-xs">Belum ada transaksi</div>
                        @endforelse
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div id="modalWithdraw" class="fixed inset-0 z-[100] hidden overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen px-4">
            <div class="fixed inset-0 bg-stone-900/60 backdrop-blur-sm" onclick="document.getElementById('modalWithdraw').classList.add('hidden')"></div>
            <div class="relative bg-white w-full max-w-md p-10 rounded-[3rem] shadow-2xl">
                <h3 class="text-2xl font-serif font-bold text-stone-800 mb-2 text-center text-teal-800">Tarik Saldo 💸</h3>
                <form action="{{ route('vendor.withdraw.store') }}" method="POST" class="space-y-6 mt-6">
                    @csrf
                    <div>
                        <label class="block text-[10px] font-bold text-stone-400 uppercase tracking-widest mb-2">Nominal (Maks: Rp {{ number_format($saldoVendor, 0) }})</label>
                        <input type="number" name="amount" max="{{ $saldoVendor }}" placeholder="Min. Rp 10.000" required class="w-full border-stone-100 bg-stone-50 rounded-2xl focus:ring-teal-500 font-black text-2xl text-teal-700 py-4 text-center">
                    </div>
                    <div class="space-y-4">
                        <input type="text" name="bank_name" placeholder="Nama Bank (BCA/BRI/BNI)" required class="w-full border-stone-100 bg-stone-50 rounded-xl text-sm">
                        <input type="text" name="account_number" placeholder="Nomor Rekening" required class="w-full border-stone-100 bg-stone-50 rounded-xl text-sm">
                        <input type="text" name="account_name" placeholder="Nama Pemilik Rekening" required class="w-full border-stone-100 bg-stone-50 rounded-xl text-sm">
                    </div>
                    <button type="submit" class="w-full bg-teal-800 text-white py-4 rounded-2xl font-bold shadow-xl hover:bg-teal-900 transition-all">Konfirmasi Penarikan</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>