<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Wedding of {{ $invitation->groom_nickname }} & {{ $invitation->bride_nickname }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&family=Playfair+Display:wght@400;700&display=swap"
        rel="stylesheet">

    <style>
        .font-script {
            font-family: 'Great Vibes', cursive;
        }

        .font-serif {
            font-family: 'Playfair Display', serif;
        }

        /* LOGIKA TEMA (Sederhana) */
        @if($invitation->preset_name == 'rustic-brown')
            /* Tema Rustic */
            .bg-theme {
                background-color: #f7f3e8;
                color: #5c4033;
            }

            .text-accent {
                color: #8b4513;
            }

            .btn-accent {
                background-color: #8b4513;
                color: white;
            }

            .border-accent {
                border-color: #8b4513;
            }

        @elseif($invitation->preset_name == 'elegant-gold')
            /* Tema Elegant */
            .bg-theme {
                background-color: #1a1a1a;
                color: #f3e5ab;
            }

            .text-accent {
                color: #d4af37;
            }

            .btn-accent {
                background-color: #d4af37;
                color: black;
            }

            .border-accent {
                border-color: #d4af37;
            }

        @else

            /* Default: Flower Pink */
            .bg-theme {
                background-color: #fdf2f8;
                color: #374151;
            }

            .text-accent {
                color: #db2777;
            }

            .btn-accent {
                background-color: #db2777;
                color: white;
            }

            .border-accent {
                border-color: #fbcfe8;
            }

        @endif

        /* Foto Bulat Berputar Pelan */
        .photo-cover {
            width: 150px;
            height: 150px;
            object-fit: cover;
            border-radius: 50%;
            border: 4px solid white;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            animation: float 6s ease-in-out infinite;
        }

        @keyframes float {
            0% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-10px);
            }

            100% {
                transform: translateY(0px);
            }
        }

        @keyframes spin {
            100% {
                transform: rotate(360deg);
            }
        }

        .spin-slow {
            animation: spin 4s linear infinite;
        }
    </style>
</head>

<body class="bg-gray-100 font-serif overflow-hidden">

    <audio id="bg-music" loop>
        <source src="{{ asset('audio/music.mp3') }}" type="audio/mpeg">
    </audio>

    <div class="max-w-md mx-auto bg-theme min-h-screen shadow-2xl relative border-x-4 border-white">

        <div id="cover-page"
            class="absolute inset-0 z-50 bg-theme flex flex-col justify-center items-center text-center p-6 transition duration-1000 ease-in-out">

            @if($invitation->custom_photo)
                <img src="{{ asset('storage/' . $invitation->custom_photo) }}" class="photo-cover mb-6">
            @endif

            <p class="tracking-[0.3em] uppercase text-accent font-bold mb-4 text-sm">The Wedding of</p>

            <h1 class="font-script text-6xl text-accent mb-2">{{ $invitation->groom_nickname }}</h1>
            <span class="text-3xl opacity-50 font-script">&</span>
            <h1 class="font-script text-6xl text-accent mt-2">{{ $invitation->bride_nickname }}</h1>

            <div class="mt-10 animate-bounce">
                <p class="text-[10px] uppercase tracking-widest opacity-60 mb-2">Kepada Yth:</p>
                <div class="bg-white/80 backdrop-blur border border-accent px-8 py-2 rounded-full shadow-sm">
                    <h3 class="text-lg font-bold capitalize">{{ $tamu ?? 'Tamu Spesial' }}</h3>
                </div>
            </div>

            <button onclick="bukaUndangan()"
                class="mt-8 btn-accent px-8 py-3 rounded-full font-bold shadow-lg hover:opacity-90 transition transform hover:scale-105 flex items-center gap-2">
                💌 Buka Undangan
            </button>
        </div>


        <div id="main-content"
            class="min-h-screen flex flex-col items-center text-center p-6 pt-20 hidden opacity-0 transition duration-1000">

            <button onclick="toggleMusic()" class="absolute top-4 right-4 bg-white p-2 rounded-full shadow z-10">
                <div id="music-icon"
                    class="w-6 h-6 btn-accent rounded-full flex items-center justify-center text-[10px] spin-slow">🎵
                </div>
            </button>

            <p class="text-sm tracking-[0.2em] mb-6 uppercase opacity-60">Assalamualaikum Wr. Wb.</p>

            <div class="bg-white/80 backdrop-blur-md p-8 rounded-2xl border border-white shadow-sm w-full mb-8">
                <h2 class="font-script text-4xl text-accent mb-6">Akad & Resepsi</h2>

                <p class="font-bold text-xl mb-1">
                    {{ \Carbon\Carbon::parse($invitation->event_date)->isoFormat('dddd, D MMMM Y') }}
                </p>
                <p class="opacity-60 mb-6">Pukul {{ \Carbon\Carbon::parse($invitation->event_date)->format('H:i') }} WIB
                </p>

                <hr class="border-accent opacity-30 my-6">

                <p class="font-bold mb-2">{{ $invitation->location_name }}</p>
                <p class="text-sm opacity-60 mb-6 px-2">{{ $invitation->location_address }}</p>

                @if(!empty($invitation->google_maps_link))
                    <a href="{{ $invitation->google_maps_link }}" target="_blank"
                        class="inline-block btn-accent px-6 py-2 rounded-full text-sm font-bold shadow hover:opacity-90 transition">
                        📍 Google Maps
                    </a>
                @else
                    <a href="https://www.google.com/maps/search/?api=1&query={{ urlencode($invitation->location_name . ' ' . $invitation->location_address) }}"
                        target="_blank"
                        class="inline-block btn-accent px-6 py-2 rounded-full text-sm font-bold shadow hover:opacity-90 transition">
                        📍 Cari Lokasi
                    </a>
                @endif
            </div>

            @if($invitation->bank_account_number)
                <div class="bg-white/80 backdrop-blur-md p-6 rounded-2xl border border-white shadow-sm w-full mb-8">
                    <h2 class="font-script text-3xl text-accent mb-4">Wedding Gift</h2>
                    <p class="text-xs opacity-60 mb-4">Doa restu Anda merupakan karunia yang sangat berarti bagi kami.</p>

                    <div class="border border-dashed border-gray-300 p-4 rounded-lg bg-gray-50">
                        <p class="font-bold text-lg text-gray-700">{{ $invitation->bank_name }}</p>
                        <p class="text-2xl font-mono my-2 tracking-wider select-all">{{ $invitation->bank_account_number }}
                        </p>
                        <p class="text-sm text-gray-500">a.n {{ $invitation->bank_account_holder }}</p>

                        <button onclick="copyRekening('{{ $invitation->bank_account_number }}')"
                            class="mt-3 text-xs bg-gray-200 hover:bg-gray-300 px-3 py-1 rounded text-gray-600 transition">
                            📋 Salin No. Rekening
                        </button>
                    </div>
                </div>
                <div
                    class="bg-white/90 backdrop-blur-md p-6 rounded-2xl border border-white shadow-sm w-full mb-8 text-left">
                    <h2 class="font-script text-3xl text-center text-accent mb-6">Doa & Ucapan</h2>

                    <form action="{{ route('wish.store') }}" method="POST" class="mb-8 space-y-3">
                        @csrf
                        <input type="hidden" name="invitation_id" value="{{ $invitation->id }}">

                        <div>
                            <input type="text" name="guest_name" value="{{ $tamu != 'Tamu Undangan' ? $tamu : '' }}"
                                placeholder="Nama Anda" class="w-full border p-2 rounded bg-gray-50 text-sm" required>
                        </div>
                        <div>
                            <textarea name="message" rows="2" placeholder="Tulis ucapan selamat..."
                                class="w-full border p-2 rounded bg-gray-50 text-sm" required></textarea>
                        </div>
                        <div>
                            <select name="attendance" class="w-full border p-2 rounded bg-gray-50 text-sm">
                                <option value="Hadir">Saya akan Hadir</option>
                                <option value="Tidak Hadir">Maaf, Tidak Bisa Hadir</option>
                                <option value="Ragu-ragu">Masih Ragu-ragu</option>
                            </select>
                        </div>
                        <button type="submit"
                            class="w-full btn-accent text-white py-2 rounded font-bold text-sm hover:opacity-90">
                            Kirim Ucapan
                        </button>
                    </form>

                    <div class="h-64 overflow-y-auto space-y-3 pr-1">
                        @foreach($invitation->wishes()->latest()->get() as $wish)
                            <div class="bg-gray-50 p-3 rounded-lg border border-gray-100 text-sm">
                                <div class="flex justify-between items-start mb-1">
                                    <span class="font-bold text-gray-700">{{ $wish->guest_name }}</span>
                                    <span
                                        class="text-[10px] px-2 py-0.5 rounded-full {{ $wish->attendance == 'Hadir' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                        {{ $wish->attendance }}
                                    </span>
                                </div>
                                <p class="text-gray-600 mb-1">"{{ $wish->message }}"</p>
                                <p class="text-[10px] text-gray-400">{{ $wish->created_at->diffForHumans() }}</p>

                                @if($wish->reply_message)
                                    <div class="mt-2 ml-2 pl-2 border-l-2 border-accent">
                                        <p class="text-[10px] font-bold text-accent">Balasan Pengantin:</p>
                                        <p class="text-xs text-gray-500">{{ $wish->reply_message }}</p>
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <p class="pb-12 text-xs opacity-40">Created with Laravel by Riza</p>
        </div>

    </div>

    <script>
        const music = document.getElementById('bg-music');
        const cover = document.getElementById('cover-page');
        const content = document.getElementById('main-content');
        const musicIcon = document.getElementById('music-icon');
        let isPlaying = false;

        function bukaUndangan() {
            cover.style.transform = 'translateY(-100%)';
            content.classList.remove('hidden');
            setTimeout(() => {
                content.classList.remove('opacity-0');
                document.body.classList.remove('overflow-hidden');
            }, 500);
            music.play();
            isPlaying = true;
        }

        function toggleMusic() {
            if (isPlaying) {
                music.pause();
                musicIcon.classList.remove('spin-slow');
                musicIcon.style.opacity = '0.5';
            } else {
                music.play();
                musicIcon.classList.add('spin-slow');
                musicIcon.style.opacity = '1';
            }
            isPlaying = !isPlaying;
        }

        function copyRekening(text) {
            navigator.clipboard.writeText(text);
            alert('Nomor rekening berhasil disalin!');
        }
    </script>

</body>

</html>