<header
    class="maro-navbar"
    :class="{ 'scrolled': scrolled }"
>
    <div class="maro-container">
        <div class="flex h-20 items-center justify-between">

            <a href="#home" class="nav-logo">
                MARO
            </a>

            <!-- Desktop -->
            <nav class="hidden items-center gap-8 md:flex">
                <a href="#home" class="nav-link">Home</a>
                <a href="#tentang" class="nav-link">Tentang</a>
                <a href="#layanan" class="nav-link">Layanan</a>
                <a href="#perjalanan" class="nav-link">Perjalanan</a>
                <a href="#galeri" class="nav-link">Galeri</a>
                <a href="#kontak" class="nav-link">Kontak</a>
            </nav>

            <!-- Mobile Button -->
            <button
                type="button"
                class="md:hidden"
                @click="mobileMenu = !mobileMenu"
                aria-label="Toggle menu"
            >
                <svg
                    x-show="!mobileMenu"
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-7 w-7"
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
                    class="h-7 w-7"
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

        <!-- Mobile Menu -->
        <div
            x-show="mobileMenu"
            x-cloak
            x-transition
            class="border-t border-white/10 py-5 md:hidden"
            :class="scrolled ? 'bg-white' : 'bg-black/20'"
        >
            <div class="flex flex-col gap-5">

                <a
                    href="#home"
                    @click="mobileMenu = false"
                    class="nav-link"
                >
                    Home
                </a>

                <a
                    href="#tentang"
                    @click="mobileMenu = false"
                    class="nav-link"
                >
                    Tentang
                </a>

                <a
                    href="#layanan"
                    @click="mobileMenu = false"
                    class="nav-link"
                >
                    Layanan
                </a>

                <a
                    href="#perjalanan"
                    @click="mobileMenu = false"
                    class="nav-link"
                >
                    Perjalanan
                </a>

                <a
                    href="#galeri"
                    @click="mobileMenu = false"
                    class="nav-link"
                >
                    Galeri
                </a>

                <a
                    href="#kontak"
                    @click="mobileMenu = false"
                    class="nav-link"
                >
                    Kontak
                </a>

            </div>
        </div>
    </div>
</header>