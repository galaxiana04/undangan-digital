<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-teal-800 leading-tight">
            {{ __('Dashboard Pengantin') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-orange-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white p-6 rounded-2xl shadow-sm border border-teal-50 mb-8 flex flex-col md:flex-row justify-between items-center gap-4">
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
                <div class="bg-gradient-to-r from-stone-800 to-teal-900 rounded-2xl p-6 mb-8 text-white shadow-lg flex flex-col md:flex-row items-center justify-between gap-4">
                    <div class="flex items-center gap-4">
                        <div class="w-14 h-14 bg-white/20 rounded-full flex items-center justify-center text-2xl backdrop-blur-sm">
                            🎨
                        </div>
                        <div>
                            <h4 class="font-bold text-lg font-serif">Punya Keahlian Desain?</h4>
                            <p class="text-sm text-stone-300">Dapatkan penghasilan tambahan dengan menjual template undangan karyamu di platform kami.</p>
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
                    <a href="{{ route('katalog') }}" class="text-teal-600 font-bold hover:underline">Pilih Template di Katalog &rarr;</a>
                </div>
            @else
                @foreach($invitations as $invitation)
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl border border-gray-100 mb-8 transition hover:shadow-md">
                        <div class="bg-teal-50/50 p-6 border-b border-teal-100 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                            <div class="flex items-center gap-4">
                                <div class="w-14 h-14 bg-teal-600 rounded-full flex items-center justify-center text-white font-bold text-2xl shadow-sm">
                                    💍
                                </div>
                                <div>
                                    <h4 class="font-serif font-bold text-xl text-gray-800">
                                        {{ $invitation->groom_nickname }} & {{ $invitation->bride_nickname }}
                                    </h4>
                                    <div class="flex items-center gap-2 mt-1">
                                        <a href="{{ url('/' . $invitation->slug) }}" target="_blank"
                                            class="text-xs text-teal-600 hover:underline font-mono bg-white px-2 py-1 rounded border border-teal-100">
                                            {{ url('/' . $invitation->slug) }} 🔗
                                        </a>
                                        <span class="text-xs text-gray-400">|</span>
                                        <span class="text-xs text-gray-500">📅 {{ \Carbon\Carbon::parse($invitation->event_date)->format('d M Y') }}</span>
                                    </div>
                                </div>
                            </div>
                            <div>
                                @if(optional($invitation->template)->type == 'Free')
                                    <span class="bg-gray-100 text-gray-600 text-xs font-bold px-3 py-1 rounded-full border border-gray-200">Free Plan</span>
                                @else
                                    <span class="bg-amber-100 text-amber-700 text-xs font-bold px-3 py-1 rounded-full border border-amber-200 flex items-center gap-1">
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
                        </div>
                    </div>
                @endforeach
            @endif

        </div>
    </div>
</x-app-layout>