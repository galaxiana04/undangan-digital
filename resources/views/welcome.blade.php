<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riza Sukma Invitation - Platform Undangan Digital</title>
    <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><rect width='100' height='100' rx='20' fill='%230f766e'/><text x='50%' y='50%' dominant-baseline='central' text-anchor='middle' font-size='60' font-family='sans-serif' font-weight='bold' fill='white'>R</text></svg>">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { font-family: 'Poppins', sans-serif; }
        h1, h2, h3, .font-serif { font-family: 'Playfair Display', serif; }
    </style>
</head>
<body class="bg-orange-50/50 text-gray-700">

    <nav class="bg-white/90 backdrop-blur-md fixed w-full z-50 shadow-sm top-0 transition-all">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <a href="{{ url('/') }}" class="flex items-center gap-2 group">
                <div class="w-10 h-10 bg-teal-700 text-white rounded-tr-xl rounded-bl-xl flex items-center justify-center font-bold text-xl group-hover:bg-teal-800 transition">R</div>
                <div class="leading-tight">
                    <span class="block text-lg font-bold text-teal-900 tracking-tight">Riza Sukma</span>
                    <span class="block text-[10px] text-teal-600 font-semibold tracking-widest uppercase">Invitation</span>
                </div>
            </a>

            <div class="hidden md:flex space-x-8 text-sm font-semibold text-gray-600">
                <a href="#katalog" class="hover:text-teal-700 transition">Katalog</a>
                <a href="#portofolio" class="hover:text-teal-700 transition">Portofolio</a>
                <a href="#fitur" class="hover:text-teal-700 transition">Fitur</a>
            </div>

            <div class="flex items-center gap-3">
                @auth
                    <a href="{{ route('dashboard') }}" class="bg-teal-50 text-teal-700 px-5 py-2 rounded-full text-sm font-bold border border-teal-200 hover:bg-teal-700 hover:text-white transition flex items-center gap-2">
                        <i class="fa-solid fa-user"></i> Dashboard Saya
                    </a>
                @else
                    <a href="{{ route('login') }}" class="text-sm font-bold text-gray-500 hover:text-teal-700">Masuk</a>
                    <a href="{{ route('register') }}" class="bg-teal-700 text-white px-6 py-2.5 rounded-full text-sm font-bold shadow-lg hover:bg-teal-800 transition transform hover:-translate-y-1">
                        Buat Undangan
                    </a>
                @endauth
            </div>
        </div>
    </nav>

    <header class="pt-40 pb-20 px-6 text-center relative overflow-hidden">
        <div class="absolute top-0 left-0 w-full h-full bg-gradient-to-b from-teal-50 to-orange-50/20 -z-10"></div>
        <div class="absolute -top-20 -right-20 w-96 h-96 bg-teal-100 rounded-full blur-3xl opacity-50"></div>
        <div class="absolute top-40 -left-20 w-72 h-72 bg-orange-100 rounded-full blur-3xl opacity-50"></div>

        <span class="text-teal-600 font-bold tracking-[0.2em] text-xs uppercase bg-white border border-teal-100 px-4 py-1.5 rounded-full shadow-sm mb-6 inline-block">Official Website</span>
        
        <h1 class="text-5xl md:text-7xl font-bold text-teal-950 mb-6 leading-tight">
            Undangan Digital <br> <span class="text-teal-600 italic">Berkelas & Eksklusif</span>
        </h1>
        <p class="text-gray-500 mb-10 max-w-2xl mx-auto text-lg leading-relaxed">
            Platform pembuatan undangan pernikahan premium dengan berbagai pilihan tema (Free, Platinum, Luxury). Kelola undanganmu sendiri, terima ucapan, dan balas doa kerabat dengan mudah.
        </p>
        
        <div class="flex flex-col md:flex-row justify-center gap-4">
            <a href="#katalog" class="bg-teal-700 text-white px-8 py-4 rounded-full font-bold shadow-xl hover:bg-teal-800 transition hover:scale-105">
                Lihat Pilihan Tema
            </a>
            <a href="{{ route('register') }}" class="bg-white text-teal-700 border border-teal-200 px-8 py-4 rounded-full font-bold hover:bg-teal-50 transition">
                Daftar Sekarang
            </a>
        </div>
    </header>

    <section id="katalog" class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-serif font-bold text-teal-950 mb-3">Pilihan Paket & Tema</h2>
                <p class="text-gray-500">Sesuaikan dengan budget dan selera pernikahanmu</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @foreach($presets as $template)
                <div class="group bg-white rounded-2xl border border-gray-100 shadow-sm hover:shadow-2xl hover:-translate-y-2 transition duration-500 overflow-hidden flex flex-col h-full">
                    
                    <div class="relative h-60 bg-gray-100 overflow-hidden">
                        <img src="{{ asset('storage/' . $template->thumbnail) }}" alt="{{ $template->name }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-700">
                        
                        <div class="absolute top-3 right-3">
                            <span class="bg-white/90 backdrop-blur text-teal-800 text-[10px] font-bold px-3 py-1 rounded-full shadow border border-teal-100 uppercase tracking-wide">
                                {{ $template->type }}
                            </span>
                        </div>
                    </div>

                    <div class="p-6 flex-1 flex flex-col">
                        <div class="mb-4">
                            <h3 class="text-xl font-bold text-gray-800 mb-1">{{ $template->name }}</h3>
                            <p class="text-2xl font-serif font-bold text-teal-600">
                                {{ $template->price == 0 ? 'Gratis' : 'Rp ' . number_format($template->price, 0, ',', '.') }}
                            </p>
                        </div>

                        <ul class="space-y-2 mb-6 text-sm text-gray-500 flex-1">
                            @foreach(json_decode($template->features) as $feature)
                            <li class="flex items-center gap-2">
                                <i class="fa-solid fa-check text-teal-500 text-xs"></i> {{ $feature }}
                            </li>
                            @endforeach
                        </ul>

                        @auth
                            <a href="{{ route('invitation.create', ['template_id' => $template->id]) }}" class="block w-full text-center bg-teal-700 text-white py-3 rounded-xl font-bold hover:bg-teal-800 transition">
                                Pilih Tema Ini
                            </a>
                        @else
                            <a href="{{ route('login') }}" onclick="alert('Silakan Login atau Daftar dulu untuk menggunakan tema ini 😊')" class="block w-full text-center bg-gray-900 text-white py-3 rounded-xl font-bold hover:bg-gray-800 transition">
                                Pesan Sekarang
                            </a>
                        @endauth
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <section id="portofolio" class="py-24 bg-teal-900 text-teal-50">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex flex-col md:flex-row justify-between items-end mb-12">
                <div>
                    <h2 class="text-4xl font-serif font-bold mb-3">Portofolio Klien</h2>
                    <p class="text-teal-200/70">Mereka yang telah mempercayakan momen bahagianya pada Riza Sukma Inv.</p>
                </div>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                @forelse($portfolios as $inv)
                <div class="bg-teal-800 rounded-xl overflow-hidden hover:bg-teal-700 transition duration-300 group border border-teal-700">
                    <div class="p-6">
                        <div class="flex items-center gap-3 mb-4">
                            <div class="w-10 h-10 rounded-full bg-teal-600 flex items-center justify-center font-bold text-white">
                                {{ substr($inv->groom_nickname, 0, 1) }}
                            </div>
                            <div>
                                <h3 class="font-bold text-lg text-white">{{ $inv->groom_nickname }} & {{ $inv->bride_nickname }}</h3>
                                <p class="text-xs text-teal-300">{{ \Carbon\Carbon::parse($inv->event_date)->format('d M Y') }}</p>
                            </div>
                        </div>
                        <div class="mb-6">
                            <span class="text-[10px] uppercase tracking-wider bg-teal-900/50 px-2 py-1 rounded text-teal-200 border border-teal-600">
                                Tema: {{ $inv->template->name ?? 'Custom' }}
                            </span>
                        </div>
                        <a href="{{ url('/' . $inv->slug) }}" target="_blank" class="block w-full text-center border border-teal-400 text-teal-100 py-2 rounded-lg hover:bg-white hover:text-teal-900 transition font-bold text-sm">
                            Lihat Undangan
                        </a>
                    </div>
                </div>
                @empty
                <div class="col-span-3 text-center py-10 text-teal-400 border-2 border-dashed border-teal-700 rounded-xl">
                    Belum ada portofolio yang ditampilkan.
                </div>
                @endforelse
            </div>
        </div>
    </section>

    <section class="py-24 bg-orange-50/50">
        <div class="max-w-5xl mx-auto px-6 text-center">
            <h2 class="text-3xl font-serif font-bold text-teal-950 mb-16">Kata Pengantin</h2>
            <div class="grid md:grid-cols-2 gap-8">
                @foreach($testimonials as $testi)
                <div class="bg-white p-8 rounded-2xl shadow-sm border border-orange-100 relative text-left">
                    <div class="text-4xl text-orange-200 absolute top-4 right-6 font-serif">"</div>
                    <p class="text-gray-600 italic mb-6 relative z-10">{{ $testi->message }}</p>
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-teal-100 rounded-full flex items-center justify-center text-teal-600 font-bold">
                            {{ substr($testi->name, 0, 1) }}
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-900">{{ $testi->name }}</h4>
                            <p class="text-xs text-teal-600 font-bold uppercase">{{ $testi->package }} Bride</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <footer class="bg-white border-t border-gray-100 py-10 text-center">
        <p class="font-bold text-teal-900 text-lg mb-2">Riza Sukma Invitation</p>
        <p class="text-xs text-gray-400">&copy; 2026. All rights reserved.</p>
    </footer>

</body>
</html>