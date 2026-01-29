<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pilih Template - Riza Sukma Invitation</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>body { font-family: 'Poppins', sans-serif; }</style>
</head>
<body class="bg-gray-50 text-gray-800 antialiased">

    <div class="bg-white shadow-sm sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex justify-between items-center">
            <div class="font-bold text-xl tracking-tight">Riza Sukma<span class="text-pink-600">.inv</span></div>
            <a href="{{ route('dashboard') }}" class="text-sm font-semibold text-gray-500 hover:text-pink-600">
                &larr; Kembali ke Dashboard
            </a>
        </div>
    </div>

    <div class="text-center py-12 px-4">
        <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Pilih Desain Undangan</h1>
        <p class="text-gray-500 max-w-2xl mx-auto">
            Pilih template yang paling cocok dengan tema pernikahanmu. <br>
            Klik tombol <span class="font-bold text-pink-600">"Pilih Template"</span> untuk mulai mengisi data.
        </p>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-20">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            
            @foreach($templates as $template)
            <div class="bg-white rounded-2xl shadow-sm hover:shadow-xl border border-gray-100 overflow-hidden transition duration-300 flex flex-col h-full group">
                
                <div class="relative h-64 {{ $template->color }} flex items-center justify-center overflow-hidden">
                    <div class="text-center">
                        <span class="block text-4xl mb-2">🎨</span>
                        <span class="font-bold text-lg opacity-50">{{ $template->name }}</span>
                    </div>

                    <div class="absolute top-4 right-4">
                        @if($template->type == 'Free')
                            <span class="bg-green-100 text-green-700 text-xs font-bold px-3 py-1 rounded-full border border-green-200">Gratis</span>
                        @else
                            <span class="bg-amber-100 text-amber-700 text-xs font-bold px-3 py-1 rounded-full border border-amber-200">👑 {{ $template->type }}</span>
                        @endif
                    </div>

                    <div class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition duration-300 flex items-center justify-center">
                        <button class="bg-white text-gray-900 px-5 py-2 rounded-full font-bold text-sm shadow-lg transform translate-y-4 group-hover:translate-y-0 transition duration-300">
                            👁️ Lihat Demo
                        </button>
                    </div>
                </div>

                <div class="p-6 flex-1 flex flex-col justify-between">
                    <div>
                        <div class="flex justify-between items-center mb-2">
                            <h3 class="text-xl font-bold text-gray-900">{{ $template->name }}</h3>
                            <p class="text-lg font-bold text-pink-600">{{ $template->price }}</p>
                        </div>
                        
                        <ul class="space-y-2 mb-6">
                            @foreach($template->features as $fitur)
                            <li class="flex items-center text-xs text-gray-500">
                                <svg class="w-4 h-4 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                {{ $fitur }}
                            </li>
                            @endforeach
                        </ul>
                    </div>

                    <a href="{{ route('invitation.create', ['preset' => $template->code]) }}" class="block w-full bg-gray-900 text-white text-center py-3 rounded-xl font-bold hover:bg-pink-600 transition shadow-lg hover:shadow-pink-500/30">
                        Pilih Template Ini &rarr;
                    </a>
                </div>
            </div>
            @endforeach

        </div>
    </div>

</body>
</html>