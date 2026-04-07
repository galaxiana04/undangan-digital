<x-app-layout>
    <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-teal-800 leading-tight flex items-center gap-2">
            <a href="{{ route('dashboard') }}" class="text-stone-400 hover:text-teal-600 transition"><i class="fa-solid fa-arrow-left"></i></a> 
            {{ __('Selesaikan Pembayaran') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-orange-50/50 min-h-screen">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            
            <div class="bg-white rounded-3xl shadow-xl shadow-teal-900/5 overflow-hidden border border-stone-100">
                <div class="bg-teal-700 p-8 text-center relative overflow-hidden">
                    <div class="absolute -top-24 -right-24 w-64 h-64 bg-white/10 rounded-full blur-3xl"></div>
                    <div class="w-16 h-16 bg-white/20 backdrop-blur rounded-2xl flex items-center justify-center text-white text-3xl mx-auto mb-4 shadow-inner">
                        <i class="fa-solid fa-file-invoice-dollar"></i>
                    </div>
                    <h3 class="text-2xl font-serif font-bold text-white mb-1">Menunggu Pembayaran</h3>
                    <p class="text-teal-100 text-sm">Selesaikan pembayaran agar undanganmu segera aktif dan bisa disebarkan.</p>
                </div>

                <div class="p-8">
                    <div class="flex justify-between items-center mb-6 pb-6 border-b border-stone-100 border-dashed">
                        <div>
                            <p class="text-xs font-bold text-stone-400 uppercase tracking-wider mb-1">Nomor Tagihan</p>
                            <p class="font-mono font-bold text-stone-700">{{ $transaction->order_id }}</p>
                        </div>
                        <div class="text-right">
                            <span class="bg-amber-50 text-amber-600 text-[10px] font-bold px-3 py-1 rounded-full uppercase tracking-widest border border-amber-200">
                                {{ $transaction->status }}
                            </span>
                        </div>
                    </div>

                    <div class="space-y-4 mb-8">
                        <div class="flex justify-between items-center">
                            <div>
                                <h4 class="font-bold text-stone-800">Template Premium</h4>
                                <p class="text-xs text-stone-500">Karya: {{ $transaction->vendor ? $transaction->vendor->name : 'Riza Sukma Official' }}</p>
                            </div>
                            <p class="font-bold text-stone-700">Rp {{ number_format($transaction->amount, 0, ',', '.') }}</p>
                        </div>
                        <div class="flex justify-between items-center">
                            <div>
                                <h4 class="font-bold text-stone-800">Biaya Layanan</h4>
                                <p class="text-xs text-stone-500">Pemeliharaan server</p>
                            </div>
                            <p class="font-bold text-green-600">Gratis</p>
                        </div>
                    </div>

                    <div class="bg-stone-50 p-6 rounded-2xl flex justify-between items-center mb-8 border border-stone-100">
                        <h3 class="text-lg font-bold text-stone-600">Total Pembayaran</h3>
                        <h2 class="text-3xl font-black text-teal-700">Rp {{ number_format($transaction->amount, 0, ',', '.') }}</h2>
                    </div>

                    <button id="pay-button" class="w-full bg-teal-600 text-white font-bold py-4 rounded-xl hover:bg-teal-700 shadow-lg shadow-teal-600/30 transition transform hover:-translate-y-1 flex justify-center items-center gap-2">
                        <i class="fa-solid fa-credit-card"></i> Bayar Sekarang
                    </button>
                    
                    <script type="text/javascript">
                        document.getElementById('pay-button').onclick = function(){
                            window.snap.pay('{{ $transaction->snap_token }}');
                        };
                    </script>

                    <p class="text-center text-xs text-stone-400 mt-4"><i class="fa-solid fa-lock"></i> Pembayaran dijamin aman oleh Midtrans</p>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>