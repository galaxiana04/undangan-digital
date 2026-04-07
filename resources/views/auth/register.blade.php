<x-guest-layout>
    <div class="mb-8 text-center">
        <h2 class="text-2xl font-bold text-stone-800">Buat Akun Baru</h2>
        <p class="text-sm text-stone-500 mt-1">Mulai buat undangan digital impianmu</p>
    </div>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div>
            <label for="name" class="block font-medium text-sm text-stone-700">Nama Lengkap</label>
            <input id="name"
                class="block mt-1 w-full border border-stone-200 px-4 py-2 focus:border-teal-500 focus:ring-teal-500 rounded-xl shadow-sm outline-none"
                type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2 text-red-500 text-xs" />
        </div>

        <div class="mt-4">
            <label for="email" class="block font-medium text-sm text-stone-700">Alamat Email</label>
            <input id="email"
                class="block mt-1 w-full border border-stone-200 px-4 py-2 focus:border-teal-500 focus:ring-teal-500 rounded-xl shadow-sm outline-none"
                type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-500 text-xs" />
        </div>

        <div class="mt-4">
            <label for="password" class="block font-medium text-sm text-stone-700">Password</label>
            <input id="password"
                class="block mt-1 w-full border border-stone-200 px-4 py-2 focus:border-teal-500 focus:ring-teal-500 rounded-xl shadow-sm outline-none"
                type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-500 text-xs" />
        </div>

        <div class="mt-4">
            <label for="password_confirmation" class="block font-medium text-sm text-stone-700">Konfirmasi
                Password</label>
            <input id="password_confirmation"
                class="block mt-1 w-full border border-stone-200 px-4 py-2 focus:border-teal-500 focus:ring-teal-500 rounded-xl shadow-sm outline-none"
                type="password" name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-red-500 text-xs" />
        </div>

        <div class="flex items-center justify-between mt-8">
            <a class="text-sm text-teal-600 font-semibold hover:underline" href="{{ route('login') }}">
                Sudah punya akun?
            </a>

            <button type="submit"
                class="inline-flex items-center px-8 py-3 bg-teal-600 border border-transparent rounded-full font-bold text-sm text-white hover:bg-teal-700 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:ring-offset-2 transition ease-in-out duration-150 shadow-lg hover:shadow-teal-500/40 transform hover:-translate-y-1">
                Daftar Sekarang
            </button>
        </div>
    </form>
</x-guest-layout>