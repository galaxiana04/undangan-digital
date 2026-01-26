<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Wedding of {{ $invitation->groom_nickname }} & {{ $invitation->bride_nickname }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&family=Playfair+Display:wght@400;700&display=swap" rel="stylesheet">
    
    <style>
        .font-script { font-family: 'Great Vibes', cursive; }
        .font-serif { font-family: 'Playfair Display', serif; }
        .bg-flower { background-color: #fdf2f8; background-image: radial-gradient(#fbcfe8 1px, transparent 1px); background-size: 20px 20px; }
        
        /* Animasi Putar Piringan Hitam (Untuk Ikon Musik) */
        @keyframes spin { 100% { transform: rotate(360deg); } }
        .spin-slow { animation: spin 4s linear infinite; }
    </style>
</head>
<body class="bg-gray-200 font-serif text-gray-800 overflow-hidden"> <audio id="bg-music" loop>
        <source src="{{ asset('audio/sampai jadi debu.mp3') }}" type="audio/mpeg">
    </audio>

    <div class="max-w-md mx-auto bg-flower min-h-screen shadow-2xl relative border-x-4 border-white">
        
        <div id="cover-page" class="absolute inset-0 z-50 bg-white/90 backdrop-blur-sm flex flex-col justify-center items-center text-center p-6 transition duration-1000 ease-in-out">
            <p class="tracking-[0.3em] uppercase text-pink-500 font-bold mb-4">You Are Invited to</p>
            
            <h1 class="font-script text-6xl text-pink-600 mb-2">{{ $invitation->groom_nickname }}</h1>
            <span class="text-3xl text-gray-400 font-script">&</span>
            <h1 class="font-script text-6xl text-pink-600 mt-2">{{ $invitation->bride_nickname }}</h1>

            <div class="mt-10 animate-bounce">
                <p class="text-xs text-gray-500 mb-2">Kepada Yth:</p>
                <div class="bg-white border border-pink-300 px-6 py-2 rounded-lg shadow-sm">
                    <h3 class="text-lg font-bold text-gray-800 capitalize">{{ $tamu ?? 'Tamu Spesial' }}</h3>
                </div>
            </div>

            <button onclick="bukaUndangan()" class="mt-8 bg-pink-600 text-white px-8 py-3 rounded-full font-bold shadow-lg hover:bg-pink-700 transition transform hover:scale-105 flex items-center gap-2">
                💌 Buka Undangan
            </button>
        </div>


        <div id="main-content" class="min-h-screen flex flex-col items-center text-center p-6 pt-20 hidden opacity-0 transition duration-1000">
            
            <button onclick="toggleMusic()" class="absolute top-4 right-4 bg-white p-2 rounded-full shadow border border-pink-200 z-10">
                <div id="music-icon" class="w-6 h-6 bg-pink-500 rounded-full flex items-center justify-center text-white text-xs spin-slow">🎵</div>
            </button>

            <p class="text-sm tracking-[0.2em] mb-6 uppercase text-gray-500">Save The Date</p>
            
            <div class="bg-white/60 p-8 rounded-2xl border border-white shadow-sm w-full">
                <h2 class="font-script text-4xl text-pink-600 mb-6">Akad & Resepsi</h2>
                
                <p class="font-bold text-xl mb-1">
                    {{ \Carbon\Carbon::parse($invitation->event_date)->isoFormat('dddd, D MMMM Y') }}
                </p>
                <p class="text-gray-500 mb-6">Pukul {{ \Carbon\Carbon::parse($invitation->event_date)->format('H:i') }} WIB</p>

                <hr class="border-pink-200 my-6">

                <p class="font-bold text-gray-700 mb-2">{{ $invitation->location_name }}</p>
                <p class="text-sm text-gray-500 mb-6 px-2">{{ $invitation->location_address }}</p>

                @if(!empty($invitation->google_maps_link))
                    <a href="{{ $invitation->google_maps_link }}" target="_blank" class="inline-block bg-pink-600 text-white px-6 py-2 rounded-full text-sm font-bold shadow hover:bg-pink-700 transition">
                       📍 Google Maps
                    </a>
                @else
                    <a href="https://www.google.com/maps/search/?api=1&query={{ urlencode($invitation->location_name . ' ' . $invitation->location_address) }}" target="_blank" class="inline-block bg-blue-600 text-white px-6 py-2 rounded-full text-sm font-bold shadow hover:bg-blue-700 transition">
                       📍 Cari Lokasi
                    </a>
                @endif
            </div>

            <p class="mt-12 text-xs text-gray-400">Created with Laravel by Riza</p>
        </div>

    </div>

    <script>
        const music = document.getElementById('bg-music');
        const cover = document.getElementById('cover-page');
        const content = document.getElementById('main-content');
        const musicIcon = document.getElementById('music-icon');
        let isPlaying = false;

        function bukaUndangan() {
            // 1. Hilangkan Cover (Geser ke atas)
            cover.style.transform = 'translateY(-100%)';
            
            // 2. Munculkan Konten
            content.classList.remove('hidden');
            setTimeout(() => {
                content.classList.remove('opacity-0');
                document.body.classList.remove('overflow-hidden'); // Izinkan scroll
            }, 500);

            // 3. Play Musik
            music.play();
            isPlaying = true;
        }

        function toggleMusic() {
            if (isPlaying) {
                music.pause();
                musicIcon.classList.remove('spin-slow'); // Stop animasi
                musicIcon.style.backgroundColor = '#9ca3af'; // Jadi abu-abu
            } else {
                music.play();
                musicIcon.classList.add('spin-slow'); // Putar animasi
                musicIcon.style.backgroundColor = '#ec4899'; // Jadi pink
            }
            isPlaying = !isPlaying;
        }
    </script>

</body>
</html>