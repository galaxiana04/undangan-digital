<!DOCTYPE html>
<html lang="id">

<head>
    <title>Katalog Tema - Riza Sukma</title>
    <link rel="icon" type="image/svg+xml"
        href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><rect width='100' height='100' rx='20' fill='%230f766e'/><text x='50%' y='50%' dominant-baseline='central' text-anchor='middle' font-size='60' font-family='sans-serif' font-weight='bold' fill='white'>R</text></svg>">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Poppins:wght@300;400;600&display=swap"
        rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; }
        h1 { font-family: 'Playfair Display', serif; }
    </style>
</head>

<body class="bg-orange-50 min-h-screen">

    <div class="bg-white shadow-sm py-4 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-6 flex justify-between items-center">
            <a href="{{ url('/') }}" class="font-bold text-xl text-teal-800">Riza Sukma<span class="text-teal-500">.inv</span></a>
            
            @auth
                <a href="{{ route('dashboard') }}" class="text-sm font-bold text-teal-700 bg-teal-50 px-4 py-2 rounded-full hover:bg-teal-600 hover:text-white transition flex items-center gap-2 border border-teal-100 shadow-sm">
                    <i class="fa-solid fa-arrow-left"></i> Kembali ke Dashboard
                </a>
            @else
                <a href="{{ route('home') }}" class="text-sm font-semibold text-gray-500 hover:text-teal-600 flex items-center gap-2">
                    <i class="fa-solid fa-house"></i> Kembali ke Home
                </a>
            @endauth

        </div>
    </div>

    <div class="text-center py-16 px-4">
        <h1 class="text-4xl font-bold text-gray-800 mb-4">Pilih Desain Impianmu</h1>
        <p class="text-gray-500">Karya terbaik dari para kreator untuk hari bahagiamu.</p>
    </div>

    <div class="max-w-7xl mx-auto px-6 pb-20">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach($templates as $template)
                <div class="bg-white rounded-2xl shadow-sm hover:shadow-2xl transition duration-300 overflow-hidden group border border-teal-50 flex flex-col">

                    <div class="h-72 w-full flex items-center justify-center relative bg-stone-100 overflow-hidden">
                        @if($template->thumbnail)
                            <img src="{{ asset('storage/' . $template->thumbnail) }}" alt="{{ $template->name }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                        @else
                            <div class="w-full h-full {{ $template->color ?? 'bg-teal-100' }} flex items-center justify-center">
                                <div class="text-center">
                                    <div class="text-4xl mb-2 text-teal-800/50">❦</div>
                                    <span class="font-serif text-xl font-bold text-teal-900 opacity-60">{{ $template->name }}</span>
                                </div>
                            </div>
                        @endif

                        <span class="absolute top-4 right-4 bg-white/90 backdrop-blur text-teal-800 text-xs font-bold px-3 py-1 rounded-full shadow-sm">
                            {{ $template->type }}
                        </span>
                        
                        <div class="absolute inset-0 bg-teal-900/40 opacity-0 group-hover:opacity-100 transition flex items-center justify-center">
                            <button class="bg-white text-teal-900 px-6 py-2 rounded-full font-bold text-sm shadow-lg transform translate-y-4 group-hover:translate-y-0 transition">Lihat Detail</button>
                        </div>
                    </div>

                    <div class="p-6 flex-1 flex flex-col">
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <h3 class="text-xl font-bold text-gray-800 leading-tight">{{ $template->name }}</h3>
                                <p class="text-xs text-stone-400 mt-1"><i class="fa-solid fa-palette"></i> By: {{ $template->vendor ? $template->vendor->name : 'Riza Sukma.inv' }}</p>
                            </div>
                            <div class="text-right shrink-0 ml-4">
                                <p class="text-teal-600 font-bold text-lg">
                                    {{ is_numeric($template->price) && $template->price == 0 ? 'Gratis' : (is_numeric($template->price) ? 'Rp ' . number_format($template->price, 0, ',', '.') : $template->price) }}
                                </p>
                            </div>
                        </div>
                        
                        <ul class="space-y-2 mb-6 flex-1">
                            @php
                                $features = is_string($template->features) ? json_decode($template->features, true) ?? explode(',', $template->features) : $template->features;
                            @endphp
                            
                            @if(is_array($features) || is_object($features))
                                @foreach($features as $f)
                                    <li class="text-xs text-gray-500 flex gap-2"><span class="text-teal-400">✓</span> {{ trim($f) }}</li>
                                @endforeach
                            @endif
                        </ul>
                        
                        <a href="{{ route('invitation.create', ['preset' => Str::slug($template->name), 'template_id' => $template->id]) }}" class="block w-full bg-teal-700 text-white text-center py-3 rounded-xl font-bold hover:bg-teal-800 transition shadow-lg hover:shadow-teal-500/30 transform hover:-translate-y-1">
                            Pilih Desain Ini →
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

</body>
</html>