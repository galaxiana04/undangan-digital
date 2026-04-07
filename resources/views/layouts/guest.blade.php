<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Poppins:wght@300;400;600&display=swap"
        rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>

<body class="text-stone-700 antialiased bg-orange-50/50">
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">

        <div>
            <a href="/" class="flex flex-col items-center gap-2 group">
                <div
                    class="w-16 h-16 bg-teal-600 text-white rounded-tr-2xl rounded-bl-2xl flex items-center justify-center font-bold text-4xl shadow-lg transform group-hover:rotate-12 transition">
                    R</div>
                <div class="text-center mt-2">
                    <span class="block text-2xl font-bold text-teal-900 tracking-tight">Riza Sukma</span>
                    <span class="block text-xs text-teal-600 font-semibold tracking-widest uppercase">Invitation</span>
                </div>
            </a>
        </div>

        <div
            class="w-full sm:max-w-md mt-8 px-8 py-8 bg-white shadow-xl border border-stone-100 overflow-hidden sm:rounded-3xl">
            {{ $slot }}
        </div>

    </div>
</body>

</html>