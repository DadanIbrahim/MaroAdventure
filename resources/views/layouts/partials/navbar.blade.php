<nav id="mainNavbar" class="navbar navbar-expand-lg fixed-top">
    <div class="container">

        <!-- Brand -->
        <a class="navbar-brand" href="#hero" id="navbar-brand">
            <div class="brand-icon">
                <img
                    src="{{ asset('assets/images/brand_maro.png') }}"
                    alt="Logo Maro Adventure Indonesia"
                    class="img-fluid"
                />
            </div>
            <span class="brand-text">Maro Adventure Indonesia</span>
        </a>

        <!-- Mobile Toggle -->
        <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarMenu"
            aria-controls="navbarMenu"
            aria-expanded="false"
            aria-label="Buka menu navigasi"
        >
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navigation -->
        <div class="collapse navbar-collapse" id="navbarMenu">

            <ul class="navbar-nav mx-auto gap-1">
                <li class="nav-item">
                    <a class="nav-link" href="#hero">Home</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#tentang">Tentang </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#layanan">Layanan</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#paket">Perjalanan</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#galeri">Galeri</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#testimoni">Cerita Mereka</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#kontak">Kontak</a>
                </li>
            </ul>

            <div class="d-flex mt-3 mt-lg-0">
                <!-- GANTI NOMOR WHATSAPP -->
                <a
                    href="https://wa.me/6285894535172?text=Halo%20Maro%20Adventure%2C%20saya%20ingin%20bertanya%20tentang%20perjalanan."
                    class="btn-booking-nav btn-wa"
                    target="_blank"
                    rel="noopener noreferrer"
                    id="navbar-booking-btn"
                >
                    <i class="bi bi-whatsapp me-1"></i>
                    Mulai Bicara
                </a>
            </div>

        </div>
    </div>
</nav>
