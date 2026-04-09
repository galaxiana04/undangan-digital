<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-teal-800 leading-tight">Kelola Pencairan Dana Vendor</h2>
    </x-slot>

    <div class="py-12 bg-orange-50/30 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-[2rem] shadow-sm border border-stone-100 overflow-hidden">
                <table class="w-full text-sm text-left">
                    <thead class="bg-stone-50 text-[10px] uppercase font-bold text-stone-400">
                        <tr>
                            <th class="px-8 py-4">Vendor</th>
                            <th class="px-8 py-4">Nominal</th>
                            <th class="px-8 py-4">Rekening Tujuan</th>
                            <th class="px-8 py-4">Status</th>
                            <th class="px-8 py-4 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-stone-100">
                        @foreach($withdrawals as $wd)
                        <tr class="hover:bg-teal-50/20">
                            <td class="px-8 py-4">
                                <span class="font-bold text-stone-800">{{ $wd->user->name }}</span>
                            </td>
                            <td class="px-8 py-4 font-black text-teal-700">
                                Rp {{ number_format($wd->amount, 0, ',', '.') }}
                            </td>
                            <td class="px-8 py-4">
                                <p class="text-stone-800 font-bold uppercase">{{ $wd->bank_name }}</p>
                                <p class="text-xs text-stone-500">{{ $wd->account_number }} a/n {{ $wd->account_name }}</p>
                            </td>
                            <td class="px-8 py-4">
                                @if($wd->status == 'PENDING')
                                    <span class="bg-orange-100 text-orange-600 px-3 py-1 rounded-full text-[10px] font-black italic">PROSES</span>
                                @elseif($wd->status == 'SUCCESS')
                                    <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-[10px] font-black">CAIR</span>
                                @else
                                    <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-[10px] font-black">DITOLAK</span>
                                @endif
                            </td>
                            <td class="px-8 py-4 flex justify-center gap-2">
                                @if($wd->status == 'PENDING')
                                    <form action="{{ route('admin.withdrawals.update', $wd->id) }}" method="POST">
                                        @csrf @method('PUT')
                                        <input type="hidden" name="status" value="SUCCESS">
                                        <button class="bg-teal-600 text-white p-2 rounded-lg hover:bg-teal-700 shadow-md" title="Setujui">
                                            <i class="fa-solid fa-check"></i>
                                        </button>
                                    </form>
                                    
                                    <form action="{{ route('admin.withdrawals.update', $wd->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menolak?')">
                                        @csrf @method('PUT')
                                        <input type="hidden" name="status" value="REJECTED">
                                        <button class="bg-red-50 text-red-600 p-2 rounded-lg hover:bg-red-600 hover:text-white border border-red-100" title="Tolak">
                                            <i class="fa-solid fa-xmark"></i>
                                        </button>
                                    </form>
                                @else
                                    <span class="text-[10px] text-stone-300 italic">Selesai</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>