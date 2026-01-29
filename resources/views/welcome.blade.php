<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riza Sukma Invitation - Jasa Undangan Digital</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        .scroll-hide::-webkit-scrollbar {
            display: none;
        }
    </style>
</head>

<body class="bg-slate-50 text-gray-700">

    <nav class="bg-white/90 backdrop-blur-md fixed w-full z-50 shadow-sm top-0 transition-all">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">

            <a href="{{ url('/') }}" class="flex items-center gap-2 group">
                <div
                    class="w-8 h-8 bg-pink-600 text-white rounded-lg flex items-center justify-center font-bold text-lg group-hover:rotate-12 transition">
                    R</div>
                <span class="text-xl font-bold text-gray-800 tracking-tight">Riza Sukma<span
                        class="text-pink-600">.inv</span></span>
            </a>

            <div class="hidden md:flex space-x-8 text-sm font-semibold text-gray-600">
                <a href="{{ route('katalog') }}" class="hover:text-pink-600 transition">Katalog Tema</a>
                <a href="#portfolio" class="hover:text-pink-600 transition">Portofolio</a>
                <a href="#harga" class="hover:text-pink-600 transition">Harga Paket</a>
            </div>

            <div class="flex items-center gap-3">
                @auth
                    <div class="flex items-center gap-4">
                        <span class="text-xs text-gray-500 font-bold hidden md:block">Halo, {{ Auth::user()->name }}</span>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                class="border border-red-200 text-red-500 px-4 py-2 rounded-full text-xs font-bold hover:bg-red-50 transition flex items-center gap-2">
                                <i class="fa-solid fa-right-from-bracket"></i> Keluar
                            </button>
                        </form>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="text-sm font-bold text-gray-500 hover:text-pink-600 px-3 py-2">
                        Masuk
                    </a>
                    <a href="{{ route('katalog') }}"
                        class="bg-gray-900 text-white px-5 py-2.5 rounded-full text-sm font-bold shadow-lg hover:bg-pink-600 transition transform hover:-translate-y-1">
                        Pilih Tema
                    </a>
                @endauth
            </div>

        </div>
    </nav>

    <header class="pt-36 pb-20 px-6 text-center relative overflow-hidden">
        <div class="absolute top-0 left-0 w-full h-full bg-gradient-to-b from-pink-50 to-transparent -z-10"></div>

        <span
            class="text-pink-600 font-bold tracking-widest text-xs uppercase bg-pink-100 px-3 py-1 rounded-full">Official
            Website Riza Sukma</span>
        <h1 class="text-4xl md:text-6xl font-bold text-gray-900 mt-6 mb-6 leading-tight">
            Undangan Pernikahan Digital <br> <span class="text-pink-600">Elegan & Berkelas</span>
        </h1>
        <p class="text-gray-500 mb-10 max-w-2xl mx-auto text-lg">
            Pilih template impianmu, dari paket Ekonomi hingga Luxury. <br>Sebar kabar bahagia tanpa batas, kapan saja
            dan di mana saja.
        </p>
        <div class="flex justify-center gap-4">
            <a href="#presets"
                class="bg-pink-600 text-white px-8 py-3 rounded-full font-bold shadow-lg hover:bg-pink-700 transition">
                Lihat Pilihan Paket
            </a>
        </div>
    </header>

    <section id="presets" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-bold text-gray-900">Pilihan Paket & Template</h2>
                <p class="text-gray-500 mt-2">Sesuaikan dengan kebutuhan dan budget pernikahanmu</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-5 gap-4 items-start">
                @foreach($presets as $plan)
                    <div
                        class="relative bg-white border {{ $plan->best_value ? 'border-pink-500 ring-4 ring-pink-500/20 z-10 scale-105 shadow-2xl' : 'border-gray-200 hover:border-pink-300 shadow-sm hover:shadow-xl' }} rounded-2xl p-6 transition duration-300 flex flex-col h-full">

                        @if($plan->best_value)
                            <div
                                class="absolute -top-4 left-1/2 transform -translate-x-1/2 bg-gradient-to-r from-pink-500 to-purple-500 text-white text-[10px] font-bold px-3 py-1 rounded-full uppercase tracking-wide">
                                Paling Laris
                            </div>
                        @endif

                        <h3 class="font-bold text-lg text-gray-800 mb-2">{{ $plan->name }}</h3>
                        <div class="text-2xl font-bold text-pink-600 mb-4">{{ $plan->price }}</div>

                        <ul class="space-y-3 mb-8 flex-1">
                            @foreach($plan->features as $feature)
                                <li class="text-xs text-gray-600 flex items-start gap-2">
                                    <i class="fa-solid fa-check text-green-500 mt-0.5"></i>
                                    {{ $feature }}
                                </li>
                            @endforeach
                        </ul>

                        <a href="{{ route('register') }}"
                            class="w-full block text-center py-2.5 rounded-xl text-sm font-bold transition {{ $plan->best_value ? 'bg-pink-600 text-white hover:bg-pink-700' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
                            Pilih {{ $plan->name }}
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section id="portfolio" class="py-20 bg-slate-50">
        <div class="max-w-6xl mx-auto px-6">
            <div class="flex justify-between items-end mb-10">
                <div>
                    <h2 class="text-3xl font-bold text-gray-900">Portofolio Karya</h2>
                    <p class="text-gray-500 mt-2">Undangan yang telah dipesan oleh klien kami</p>
                </div>
                <a href="#" class="text-pink-600 font-bold text-sm hover:underline">Lihat Semua Karya &rarr;</a>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                @forelse($portfolios as $item)
                    <div
                        class="group bg-white rounded-2xl overflow-hidden shadow-md hover:shadow-2xl transition duration-500">
                        <div class="h-64 bg-gray-200 relative overflow-hidden">
                            @if($item->custom_photo)
                                <img src="{{ asset('storage/' . $item->custom_photo) }}"
                                    class="w-full h-full object-cover group-hover:scale-110 transition duration-700">
                            @else
                                <div class="w-full h-full flex items-center justify-center bg-gray-100 text-gray-300 text-5xl">
                                    ❤️</div>
                            @endif

                            <div
                                class="absolute inset-0 bg-black/60 opacity-0 group-hover:opacity-100 transition duration-300 flex flex-col items-center justify-center text-white">
                                <p class="font-bold text-lg mb-2">Tema: {{ ucfirst($item->preset_name) }}</p>
                                <a href="{{ url('/' . $item->slug) }}" target="_blank"
                                    class="border border-white px-6 py-2 rounded-full hover:bg-white hover:text-black transition font-bold text-sm">
                                    Buka Undangan
                                </a>
                            </div>
                        </div>

                        <div class="p-6">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h3 class="font-bold text-lg text-gray-800">{{ $item->groom_nickname }} &
                                        {{ $item->bride_nickname }}</h3>
                                    <p class="text-sm text-gray-500">Acara:
                                        {{ \Carbon\Carbon::parse($item->event_date)->format('d M Y') }}</p>
                                </div>
                                <div
                                    class="w-8 h-8 bg-pink-50 rounded-full flex items-center justify-center text-pink-500 text-xs">
                                    <i class="fa-solid fa-heart"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-3 text-center py-12 text-gray-400 border-2 border-dashed rounded-xl">
                        Belum ada portofolio yang ditampilkan.
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <section class="py-20 bg-white">
        <div class="max-w-5xl mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-bold text-gray-900">Kata Mempelai</h2>
                <p class="text-gray-500 mt-2">Cerita bahagia mereka menggunakan Riza Sukma Invitation</p>
            </div>

            <div class="grid md:grid-cols-3 gap-6">
                @foreach($testimonials as $testi)
                    <div
                        class="bg-pink-50/50 p-8 rounded-2xl relative border border-pink-100 hover:-translate-y-2 transition duration-300">
                        <div class="absolute top-6 right-6 text-pink-200 text-4xl font-serif">"</div>

                        <p class="text-gray-600 text-sm leading-relaxed mb-6 relative z-10">
                            {{ $testi->message }}
                        </p>

                        <div class="flex items-center gap-4">
                            <div
                                class="w-10 h-10 rounded-full bg-gradient-to-tr from-pink-400 to-purple-500 flex items-center justify-center text-white font-bold text-sm">
                                {{ substr($testi->name, 0, 1) }}
                            </div>
                            <div>
                                <h4 class="font-bold text-gray-900 text-sm">{{ $testi->name }}</h4>
                                <p class="text-[10px] text-pink-600 font-bold uppercase tracking-wider">Paket
                                    {{ $testi->package }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <footer class="bg-gray-900 text-white pt-16 pb-8">
        <div class="max-w-7xl mx-auto px-6 grid md:grid-cols-4 gap-12 mb-12">
            <div class="col-span-1 md:col-span-2">
                <h3 class="text-2xl font-bold mb-4">Riza Sukma<span class="text-pink-500">.inv</span></h3>
                <p class="text-gray-400 text-sm leading-relaxed max-w-sm">
                    Platform pembuatan undangan pernikahan digital premium dengan berbagai pilihan tema eksklusif.
                    Abadikan momen bahagiamu bersama kami.
                </p>
            </div>
            <div>
                <h4 class="font-bold mb-4">Navigasi</h4>
                <ul class="space-y-2 text-sm text-gray-400">
                    <li><a href="#presets" class="hover:text-pink-500">Pilihan Paket</a></li>
                    <li><a href="#portfolio" class="hover:text-pink-500">Portofolio</a></li>
                    <li><a href="{{ route('login') }}" class="hover:text-pink-500">Login Member</a></li>
                </ul>
            </div>
            <div>
                <h4 class="font-bold mb-4">Kontak</h4>
                <ul class="space-y-2 text-sm text-gray-400">
                    <li><i class="fa-brands fa-whatsapp w-6"></i> 0812-3456-7890</li>
                    <li><i class="fa-brands fa-instagram w-6"></i> @rzaskma_29</li>
                    <li><i class="fa-solid fa-envelope w-6"></i> rizasukmaaa@gmail.com</li>
                </ul>
            </div>
        </div>
        <div class="border-t border-gray-800 pt-8 text-center text-xs text-gray-500">
            &copy; 2026 Riza Sukma Invitation. All rights reserved.
        </div>
    </footer>

</body>

</html>