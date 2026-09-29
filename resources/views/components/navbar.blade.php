<nav
    x-data
    :class="scrolled
        ? 'bg-white/95 shadow-md'
        : 'bg-transparent'"
    class="fixed top-0 left-0 right-0 z-50 transition-all duration-300"
>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-20">

            {{-- Logo --}}
            <a
                href="{{ route('home') }}"
                class="flex items-center gap-3"
            >
                <div class="w-11 h-11 rounded-full bg-green-700 flex items-center justify-center text-white font-bold text-lg">
                    M
                </div>

                <div class="leading-tight">
                    <div class="font-extrabold text-xl tracking-wide text-green-800">
                        MARO
                    </div>

                    <div class="text-xs tracking-[0.25em] text-gray-600">
                        ADVENTURE
                    </div>
                </div>
            </a>

            {{-- Desktop Menu --}}
            <div class="hidden md:flex items-center gap-8">

                <a
                    href="#home"
                    class="font-medium text-gray-700 hover:text-green-700 transition"
                >
                    Home
                </a>

                <a
                    href="#about"
                    class="font-medium text-gray-700 hover:text-green-700 transition"
                >
                    Tentang
                </a>

                <a
                    href="#services"
                    class="font-medium text-gray-700 hover:text-green-700 transition"
                >
                    Layanan
                </a>

                <a
                    href="#packages"
                    class="font-medium text-gray-700 hover:text-green-700 transition"
                >
                    Perjalanan
                </a>

                <a
                    href="#gallery"
                    class="font-medium text-gray-700 hover:text-green-700 transition"
                >
                    Galeri
                </a>

                <a
                    href="#contact"
                    class="px-5 py-2.5 rounded-full bg-green-700 text-white font-semibold hover:bg-green-800 transition"
                >
                    Hubungi Kami
                </a>

            </div>

            {{-- Mobile Button --}}
            <button
                type="button"
                @click="mobileMenu = !mobileMenu"
                class="md:hidden p-2 rounded-lg text-gray-700 hover:bg-gray-100"
                aria-label="Toggle menu"
            >
                <svg
                    x-show="!mobileMenu"
                    xmlns="http://www.w3.org/2000/svg"
                    class="w-7 h-7"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M4 6h16M4 12h16M4 18h16"
                    />
                </svg>

                <svg
                    x-show="mobileMenu"
                    x-cloak
                    xmlns="http://www.w3.org/2000/svg"
                    class="w-7 h-7"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M6 18L18 6M6 6l12 12"
                    />
                </svg>
            </button>

        </div>

        {{-- Mobile Menu --}}
        <div
            x-show="mobileMenu"
            x-cloak
            x-transition
            @click.outside="mobileMenu = false"
            class="md:hidden pb-5"
        >
            <div class="bg-white rounded-2xl shadow-xl p-4 space-y-2">

                <a
                    href="#home"
                    @click="mobileMenu = false"
                    class="block px-4 py-3 rounded-xl hover:bg-gray-100"
                >
                    Home
                </a>

                <a
                    href="#about"
                    @click="mobileMenu = false"
                    class="block px-4 py-3 rounded-xl hover:bg-gray-100"
                >
                    Tentang
                </a>

                <a
                    href="#services"
                    @click="mobileMenu = false"
                    class="block px-4 py-3 rounded-xl hover:bg-gray-100"
                >
                    Layanan
                </a>

                <a
                    href="#packages"
                    @click="mobileMenu = false"
                    class="block px-4 py-3 rounded-xl hover:bg-gray-100"
                >
                    Perjalanan
                </a>

                <a
                    href="#gallery"
                    @click="mobileMenu = false"
                    class="block px-4 py-3 rounded-xl hover:bg-gray-100"
                >
                    Galeri
                </a>

                <a
                    href="#contact"
                    @click="mobileMenu = false"
                    class="block px-4 py-3 rounded-xl bg-green-700 text-white text-center font-semibold"
                >
                    Hubungi Kami
                </a>

            </div>
        </div>

    </div>
</nav>