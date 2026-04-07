<x-guest-layout>
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="mb-8 text-center">
        <h2 class="text-2xl font-bold text-stone-800">Selamat Datang Kembali</h2>
        <p class="text-sm text-stone-500 mt-1">Masuk untuk mengelola undanganmu</p>
    </div>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div>
            <label for="email" class="block font-medium text-sm text-stone-700">Alamat Email</label>
            <input id="email"
                class="block mt-1 w-full border border-stone-200 px-4 py-2 focus:border-teal-500 focus:ring-teal-500 rounded-xl shadow-sm outline-none"
                type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-500 text-xs" />
        </div>

        <div class="mt-4">
            <label for="password" class="block font-medium text-sm text-stone-700">Password</label>
            <input id="password"
                class="block mt-1 w-full border border-stone-200 px-4 py-2 focus:border-teal-500 focus:ring-teal-500 rounded-xl shadow-sm outline-none"
                type="password" name="password" required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-500 text-xs" />
        </div>

        <div class="flex justify-between items-center mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox"
                    class="rounded border-stone-300 text-teal-600 shadow-sm focus:ring-teal-500" name="remember">
                <span class="ml-2 text-sm text-stone-600">Ingat Saya</span>
            </label>

            @if (Route::has('password.request'))
                <a class="text-sm text-stone-500 hover:text-teal-600 hover:underline"
                    href="{{ route('password.request') }}">
                    Lupa password?
                </a>
            @endif
        </div>

        <div class="mt-8">
            <button type="submit"
                class="w-full justify-center inline-flex items-center px-8 py-3 bg-teal-600 border border-transparent rounded-full font-bold text-sm text-white hover:bg-teal-700 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:ring-offset-2 transition ease-in-out duration-150 shadow-lg hover:shadow-teal-500/40">
                Masuk ke Dashboard
            </button>
        </div>

        <div class="mt-8 text-center text-sm text-stone-500 border-t border-stone-100 pt-6">
            Belum punya akun? <a href="{{ route('register') }}" class="font-bold text-teal-600 hover:underline">Daftar
                sekarang</a>
        </div>
    </form>
</x-guest-layout>