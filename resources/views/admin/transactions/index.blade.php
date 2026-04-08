<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-teal-800 leading-tight">
            {{ __('Laporan Penjualan Seluruh Platform') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-orange-50/30 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                <div class="bg-white p-6 rounded-3xl border border-stone-100 shadow-sm">
                    <p class="text-[10px] font-bold text-stone-400 uppercase tracking-widest mb-1">Total Omzet</p>
                    <h4 class="text-xl font-bold text-teal-700">Rp {{ number_format($transactions->where('status', 'PAID')->sum('amount'), 0, ',', '.') }}</h4>
                </div>
                </div>

            <div class="bg-white rounded-[2rem] shadow-sm border border-stone-100 overflow-hidden">
                <div class="p-8 border-b border-stone-100 flex flex-col md:flex-row justify-between gap-4 bg-stone-50/50">
                    <h3 class="font-bold text-lg text-stone-800">Data Transaksi</h3>
                    <form action="" method="GET" class="relative">
                        <input type="text" name="search" placeholder="Cari nama atau invoice..." 
                               class="pl-10 pr-4 py-2 border-stone-200 rounded-full text-sm focus:ring-teal-500 w-full md:w-64">
                        <i class="fa-solid fa-magnifying-glass absolute left-4 top-3 text-stone-400"></i>
                    </form>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-stone-600">
                        <thead class="text-[10px] text-stone-400 uppercase bg-stone-50/50 border-b border-stone-100">
                            <tr>
                                <th class="px-8 py-4">Pembeli</th>
                                <th class="px-8 py-4">Template</th>
                                <th class="px-8 py-4">Nominal</th>
                                <th class="px-8 py-4">Status</th>
                                <th class="px-8 py-4">Waktu</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-stone-50">
                            @foreach($transactions as $trx)
                            <tr class="hover:bg-teal-50/30 transition">
                                <td class="px-8 py-4">
                                    <p class="font-bold text-stone-800">{{ $trx->user->name }}</p>
                                    <p class="text-[10px] text-stone-400 italic">Inv: #TRX-{{ $trx->id }}</p>
                                </td>
                                <td class="px-8 py-4">
                                    <span class="bg-stone-100 px-2 py-1 rounded text-[10px] font-bold uppercase text-stone-600">
                                        {{ $trx->invitation->template->name ?? 'Custom' }}
                                    </span>
                                </td>
                                <td class="px-8 py-4 font-bold text-stone-800">
                                    Rp {{ number_format($trx->amount, 0, ',', '.') }}
                                </td>
                                <td class="px-8 py-4">
                                    @if($trx->status === 'PAID')
                                        <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-[10px] font-black">LUNAS</span>
                                    @elseif($trx->status === 'PENDING')
                                        <span class="bg-orange-100 text-orange-700 px-3 py-1 rounded-full text-[10px] font-black">MENUNGGU</span>
                                    @else
                                        <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-[10px] font-black">BATAL</span>
                                    @endif
                                </td>
                                <td class="px-8 py-4 text-stone-400 text-xs">
                                    {{ $trx->created_at->diffForHumans() }}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>