<div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
    <div
        class="bg-gradient-to-br from-teal-600 to-teal-800 p-8 rounded-[2rem] text-white shadow-xl relative overflow-hidden">
        <div class="relative z-10">
            <p class="text-teal-100 text-xs font-bold uppercase tracking-widest mb-2">Saldo Bisa Ditarik</p>
            <h3 class="text-4xl font-black mb-6">Rp {{ number_format($saldoVendor, 0, ',', '.') }}</h3>
            <button onclick="document.getElementById('modalWithdraw').classList.remove('hidden')"
                class="bg-white text-teal-700 px-6 py-3 rounded-full font-bold text-sm hover:bg-teal-50 transition shadow-lg">
                Tarik Saldo <i class="fa-solid fa-paper-plane ml-2"></i>
            </button>
        </div>
        <i class="fa-solid fa-wallet absolute -bottom-10 -right-10 text-9xl text-white/10 rotate-12"></i>
    </div>

    <div class="bg-white p-8 rounded-[2rem] border border-stone-100 shadow-sm flex flex-col justify-center">
        <h4 class="text-stone-400 text-[10px] font-bold uppercase mb-4">Metode Pencairan</h4>
        <div class="flex items-center gap-4">
            <div
                class="w-12 h-12 bg-stone-50 rounded-2xl flex items-center justify-center text-teal-600 border border-stone-100">
                <i class="fa-solid fa-university text-xl"></i>
            </div>
            <div>
                <p class="font-bold text-stone-800">Transfer Bank Manual</p>
                <p class="text-xs text-stone-500 italic">Proses 1-3 hari kerja</p>
            </div>
        </div>
    </div>
</div>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-teal-800 leading-tight">
            {{ __('Dashboard Pengantin') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-orange-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div
                class="bg-white p-6 rounded-2xl shadow-sm border border-teal-50 mb-8 flex flex-col md:flex-row justify-between items-center gap-4">
                <div>
                    <h3 class="text-2xl font-serif font-bold text-gray-800">Halo, {{ Auth::user()->name }}! 👋</h3>
                    <p class="text-gray-500 text-sm mt-1">Selamat datang di panel kontrol pernikahanmu.</p>
                </div>
                <a href="{{ route('katalog') }}"
                    class="bg-teal-600 text-white px-6 py-3 rounded-full font-bold text-sm shadow-lg hover:bg-teal-700 transition transform hover:-translate-y-1 flex items-center gap-2">
                    <i class="fa-solid fa-plus"></i> Buat Undangan Baru
                </a>
            </div>

            @if(Auth::user()->role === 'customer')
                <div
                    class="bg-gradient-to-r from-stone-800 to-teal-900 rounded-2xl p-6 mb-8 text-white shadow-lg flex flex-col md:flex-row items-center justify-between gap-4">
                    <div class="flex items-center gap-4">
                        <div
                            class="w-14 h-14 bg-white/20 rounded-full flex items-center justify-center text-2xl backdrop-blur-sm">
                            🎨
                        </div>
                        <div>
                            <h4 class="font-bold text-lg font-serif">Punya Keahlian Desain?</h4>
                            <p class="text-sm text-stone-300">Dapatkan penghasilan tambahan dengan menjual template undangan
                                karyamu di platform kami.</p>
                        </div>
                    </div>
                    <form action="{{ route('upgrade.vendor') }}" method="POST"
                        onsubmit="return confirm('Apakah Anda yakin ingin membuka toko dan menjadi Penjual Desain?');">
                        @csrf
                        <button type="submit"
                            class="bg-teal-500 hover:bg-teal-400 text-white font-bold py-3 px-6 rounded-full text-sm transition shadow-md whitespace-nowrap">
                            Buka Toko Sekarang
                        </button>
                    </form>
                </div>
            @endif

            @if($invitations->isEmpty())
                <div class="text-center py-16 bg-white rounded-2xl border-2 border-dashed border-gray-300">
                    <div class="text-6xl mb-4 opacity-50">💌</div>
                    <h3 class="text-xl font-bold text-gray-700 mb-2">Belum ada undangan</h3>
                    <p class="text-gray-500 mb-6">Yuk, mulai buat undangan digital pertamamu sekarang!</p>
                    <a href="{{ route('katalog') }}" class="text-teal-600 font-bold hover:underline">Pilih Template di
                        Katalog &rarr;</a>
                </div>
            @else

                @foreach($invitations as $invitation)
                    <div
                        class="bg-white overflow-hidden shadow-sm sm:rounded-2xl border border-gray-100 mb-8 transition hover:shadow-md">

                        <div
                            class="bg-teal-50/50 p-6 border-b border-teal-100 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                            <div class="flex items-center gap-4">
                                <div
                                    class="w-14 h-14 bg-teal-600 rounded-full flex items-center justify-center text-white font-bold text-2xl shadow-sm">
                                    💍
                                </div>
                                <div>
                                    <h4 class="font-serif font-bold text-xl text-gray-800">{{ $invitation->groom_nickname }} &
                                        {{ $invitation->bride_nickname }}
                                    </h4>
                                    <div class="flex items-center gap-2 mt-1">
                                        <a href="{{ url('/' . $invitation->slug) }}" target="_blank"
                                            class="text-xs text-teal-600 hover:underline font-mono bg-white px-2 py-1 rounded border border-teal-100">
                                            {{ url('/' . $invitation->slug) }} 🔗
                                        </a>
                                        <span class="text-xs text-gray-400">|</span>
                                        <span class="text-xs text-gray-500">📅
                                            {{ \Carbon\Carbon::parse($invitation->event_date)->format('d M Y') }}</span>
                                    </div>
                                </div>
                            </div>

                            <div>
                                @if(optional($invitation->template)->type == 'Free')
                                    <span
                                        class="bg-gray-100 text-gray-600 text-xs font-bold px-3 py-1 rounded-full border border-gray-200">Free
                                        Plan</span>
                                @else
                                    <span
                                        class="bg-amber-100 text-amber-700 text-xs font-bold px-3 py-1 rounded-full border border-amber-200 flex items-center gap-1">
                                        👑 {{ $invitation->template->type ?? 'Premium' }}
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="px-6 py-4 bg-gray-50 border-b border-gray-100 flex gap-3 overflow-x-auto">
                            <a href="https://wa.me/?text={{ urlencode('Halo! Mohon doa restu di pernikahan kami: ' . url('/' . $invitation->slug)) }}"
                                target="_blank"
                                class="flex items-center gap-2 bg-green-500 text-white px-4 py-2 rounded-lg text-xs font-bold hover:bg-green-600 transition shadow-sm">
                                <i class="fa-brands fa-whatsapp text-lg"></i> Bagikan ke WA
                            </a>

                            <a href="{{ url('/' . $invitation->slug) }}" target="_blank"
                                class="flex items-center gap-2 bg-blue-500 text-white px-4 py-2 rounded-lg text-xs font-bold hover:bg-blue-600 transition shadow-sm">
                                <i class="fa-solid fa-eye"></i> Lihat Web
                            </a>

                            <button onclick="alert('Fitur edit sedang dikembangkan!')"
                                class="flex items-center gap-2 bg-yellow-400 text-white px-4 py-2 rounded-lg text-xs font-bold hover:bg-yellow-500 transition shadow-sm">
                                <i class="fa-solid fa-pen-to-square"></i> Edit
                            </button>
                        </div>

                        <div class="p-6">
                            <div class="flex justify-between items-center mb-4">
                                <h5 class="font-bold text-gray-700 flex items-center gap-2">
                                    💬 Ucapan & Doa
                                    <span
                                        class="bg-teal-100 text-teal-800 text-xs font-bold px-2 py-0.5 rounded-full">{{ $invitation->wishes->count() }}</span>
                                </h5>
                            </div>

                            <div class="space-y-4 max-h-80 overflow-y-auto pr-2 scroll-smooth">
                                @forelse($invitation->wishes as $wish)
                                    <div class="bg-white p-4 rounded-xl border border-gray-100 shadow-sm">
                                        <div class="flex justify-between items-start mb-2">
                                            <div class="flex items-center gap-2">
                                                <div
                                                    class="w-6 h-6 rounded-full bg-gray-200 flex items-center justify-center text-[10px] font-bold text-gray-600">
                                                    {{ substr($wish->guest_name, 0, 1) }}
                                                </div>
                                                <span class="font-bold text-gray-800 text-sm">{{ $wish->guest_name }}</span>
                                            </div>
                                            <span class="text-[10px] text-gray-400">{{ $wish->created_at->diffForHumans() }}</span>
                                        </div>

                                        <p class="text-gray-600 text-sm italic mb-3 pl-8">"{{ $wish->message }}"</p>

                                        <div class="pl-8">
                                            @if($wish->reply_message)
                                                <div class="border-l-2 border-teal-500 bg-teal-50 p-3 rounded-r-lg">
                                                    <p class="text-[10px] font-bold text-teal-700 mb-1 flex items-center gap-1">
                                                        <i class="fa-solid fa-check-circle"></i> Balasan Anda:
                                                    </p>
                                                    <p class="text-xs text-gray-700">{{ $wish->reply_message }}</p>
                                                </div>
                                            @else
                                                <form action="{{ route('wish.reply', $wish->id) }}" method="POST" class="flex gap-2">
                                                    @csrf
                                                    <input type="text" name="reply_message" placeholder="Ketik balasan ucapan..."
                                                        class="w-full text-xs border border-gray-300 rounded-lg px-3 py-2 focus:border-teal-500 focus:ring-teal-500 outline-none transition"
                                                        required>
                                                    <button type="submit"
                                                        class="bg-teal-600 text-white text-xs px-4 py-2 rounded-lg font-bold hover:bg-teal-700 transition">
                                                        Kirim
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </div>
                                @empty
                                    <div class="text-center py-6 text-gray-400 text-sm">
                                        Belum ada ucapan dari tamu. Bagikan undanganmu sekarang!
                                    </div>
                                @endforelse
                            </div>
                        </div>

                    </div>
                @endforeach
            @endif

        </div>
    </div>
    <div id="modalWithdraw" class="fixed inset-0 z-[60] hidden overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen px-4">
            <div class="fixed inset-0 bg-stone-900/60 backdrop-blur-sm"
                onclick="this.parentElement.parentElement.classList.add('hidden')"></div>

            <div class="relative bg-white w-full max-w-md p-8 rounded-[2.5rem] shadow-2xl">
                <h3 class="text-2xl font-serif font-bold text-stone-800 mb-2">Tarik Saldo 💸</h3>
                <p class="text-stone-500 text-sm mb-6">Pastikan data rekening sudah benar agar proses transfer lancar.
                </p>

                <form action="{{ route('vendor.withdraw.store') }}" method="POST" class="space-y-5">
                    @csrf
                    <div>
                        <label class="block text-xs font-bold text-stone-400 uppercase mb-2">Nominal Penarikan</label>
                        <input type="number" name="amount" max="{{ $saldoVendor }}" placeholder="Min. Rp 10.000"
                            class="w-full border-stone-100 bg-stone-50 rounded-2xl focus:ring-teal-500 font-bold text-lg">
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-stone-400 uppercase mb-2">Nama Bank</label>
                            <input type="text" name="bank_name" placeholder="BCA/BRI/BNI"
                                class="w-full border-stone-100 bg-stone-50 rounded-xl text-sm">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-stone-400 uppercase mb-2">No. Rekening</label>
                            <input type="text" name="account_number"
                                class="w-full border-stone-100 bg-stone-50 rounded-xl text-sm">
                        </div>
                    </div>

                    <button type="submit"
                        class="w-full bg-teal-600 text-white py-4 rounded-2xl font-bold shadow-lg hover:bg-teal-700 transition">
                        Konfirmasi Penarikan
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>