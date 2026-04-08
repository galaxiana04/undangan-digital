<nav x-data="{ open: false }"
    class="bg-white border-b border-stone-100 sticky top-0 z-50 shadow-sm backdrop-blur-md bg-white/90">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <div class="shrink-0 flex items-center">
                    <div class="shrink-0 flex items-center">
                        <a href="{{ route('home') }}" class="flex items-center gap-2 group">
                            <div class="shrink-0 flex items-center">
                                <a href="{{ route('home') }}" class="flex items-center gap-3 group">
                                    <div class="shrink-0 flex items-center">
                                        <a href="{{ route('home') }}" class="flex items-center gap-3">
                                            <img src="{{ asset('images/logo-toko.png') }}" alt="Logo"
                                                class="h-10 w-auto">

                                            <div class="flex flex-col border-l border-stone-200 pl-3">
                                                <span
                                                    class="font-bold text-lg leading-none text-teal-900 uppercase tracking-tight">Riza
                                                    Sukma</span>
                                                <span
                                                    class="text-[10px] font-bold text-teal-600 uppercase tracking-[0.2em]">Invitation</span>
                                            </div>
                                        </a>
                                    </div>
                                </a>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard') || request()->routeIs('dashboard.pembeli')"
                        class="text-stone-600 hover:text-teal-600 font-bold border-teal-500">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                    <x-nav-link :href="route('katalog')"
                        class="text-stone-600 hover:text-teal-600 font-bold border-teal-500">
                        {{ __('Katalog Tema') }}
                    </x-nav-link>
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <span
                    class="bg-teal-50 text-teal-700 text-[10px] font-bold px-2 py-1 rounded-full uppercase tracking-wider mr-3 border border-teal-100">
                    {{ Auth::user()->role === 'vendor' && request()->routeIs('dashboard.pembeli') ? 'Pembeli' : Auth::user()->role }}
                </span>
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button
                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-bold rounded-full text-stone-600 bg-stone-50 hover:text-teal-600 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->name }}</div>
                            <div class="ml-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')"
                            class="hover:bg-teal-50 hover:text-teal-700 font-medium">
                            <i class="fa-solid fa-user mr-2 text-stone-400"></i> {{ __('Profile Saya') }}
                        </x-dropdown-link>

                        @if(Auth::user()->role === 'vendor')
                            <div class="border-t border-stone-100 my-1"></div>

                            @if(request()->routeIs('dashboard.pembeli'))
                                <x-dropdown-link :href="route('dashboard')"
                                    class="hover:bg-teal-50 hover:text-teal-700 font-medium">
                                    <i class="fa-solid fa-store mr-2 text-teal-500"></i> {{ __('Beralih ke Penjual') }}
                                </x-dropdown-link>
                            @else
                                <x-dropdown-link :href="route('dashboard.pembeli')"
                                    class="hover:bg-orange-50 hover:text-orange-700 font-medium">
                                    <i class="fa-solid fa-heart mr-2 text-orange-400"></i> {{ __('Beralih ke Pembeli') }}
                                </x-dropdown-link>
                            @endif

                            <div class="border-t border-stone-100 my-1"></div>
                        @endif

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();"
                                class="text-red-500 hover:bg-red-50 hover:text-red-700 font-medium mt-1">
                                <i class="fa-solid fa-right-from-bracket mr-2"></i> {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-stone-400 hover:text-teal-500 hover:bg-teal-50 focus:outline-none focus:bg-teal-50 focus:text-teal-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div :class="{'block': open, 'hidden': ! open}"
        class="hidden sm:hidden bg-white border-b border-stone-100 shadow-lg absolute w-full">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')"
                class="text-stone-700 hover:bg-teal-50 hover:text-teal-700 font-bold">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('katalog')"
                class="text-stone-700 hover:bg-teal-50 hover:text-teal-700 font-bold">
                {{ __('Katalog Tema') }}
            </x-responsive-nav-link>
        </div>

        <div class="pt-4 pb-1 border-t border-stone-100 bg-stone-50">
            <div class="px-4">
                <div class="font-bold text-base text-stone-800">{{ Auth::user()->name }}</div>
                <div class="font-medium text-xs text-stone-500 mb-2">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')"
                    class="text-stone-600 hover:bg-teal-100 hover:text-teal-800">
                    <i class="fa-solid fa-user mr-2"></i> {{ __('Profile') }}
                </x-responsive-nav-link>

                @if(Auth::user()->role === 'vendor')
                    @if(request()->routeIs('dashboard.pembeli'))
                        <x-responsive-nav-link :href="route('dashboard')"
                            class="text-teal-600 hover:bg-teal-100 hover:text-teal-800 font-bold">
                            <i class="fa-solid fa-store mr-2"></i> {{ __('Beralih ke Penjual') }}
                        </x-responsive-nav-link>
                    @else
                        <x-responsive-nav-link :href="route('dashboard.pembeli')"
                            class="text-orange-500 hover:bg-orange-100 hover:text-orange-700 font-bold">
                            <i class="fa-solid fa-heart mr-2"></i> {{ __('Beralih ke Pembeli') }}
                        </x-responsive-nav-link>
                    @endif
                @endif

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                        onclick="event.preventDefault(); this.closest('form').submit();"
                        class="text-red-500 hover:bg-red-100 hover:text-red-700 font-bold">
                        <i class="fa-solid fa-right-from-bracket mr-2"></i> {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>