<nav id="mainNavbar" class="navbar navbar-expand-lg fixed-top">
    <div class="container">

        <!-- Brand -->
        <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}" id="navbar-brand">
            <div class="brand-icon me-2">
                <img
                    src="{{ asset('assets/images/brand_maro.png') }}"
                    alt="Logo Maro Adventure Indonesia"
                    class="img-fluid"
                />
            </div>
            <span class="brand-text">Maro Adventure</span>
        </a>

        <!-- Mobile Toggle -->
        <button
            class="navbar-toggler border-0 shadow-none p-2"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarMenu"
            aria-controls="navbarMenu"
            aria-expanded="false"
            aria-label="Buka menu navigasi"
        >
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navigation Menu -->
        <div class="collapse navbar-collapse" id="navbarMenu">

            <ul class="navbar-nav mx-auto align-items-lg-center gap-1 gap-lg-2 py-2 py-lg-0">
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="{{ url('/') }}">
                        <i class="bi bi-house-door me-1 opacity-75 d-lg-none"></i> Beranda
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/#paket') }}">
                        <i class="bi bi-compass me-1 opacity-75 d-lg-none"></i> Perjalanan & Jasa
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('artikel.*') ? 'active' : '' }}" href="{{ route('artikel.index') }}">
                        <i class="bi bi-newspaper me-1 opacity-75 d-lg-none"></i> Artikel & Berita
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/#tentang') }}">
                        <i class="bi bi-info-circle me-1 opacity-75 d-lg-none"></i> Tentang
                    </a>
                </li>

                <!-- Dropdown for secondary items -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-grid me-1 opacity-75 d-lg-none"></i> Lainnya
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end border-0 shadow-lg" aria-labelledby="navbarDropdown">
                        <li>
                            <a class="dropdown-item py-2" href="{{ url('/#galeri') }}">
                                <i class="bi bi-images text-primary me-2"></i> Galeri foto
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item py-2" href="{{ url('/#testimoni') }}">
                                <i class="bi bi-chat-heart text-primary me-2"></i> Cerita Pendaki
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item py-2" href="{{ url('/#kenapa') }}">
                                <i class="bi bi-shield-check text-primary me-2"></i> Mengapa Maro
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>

            <!-- Right Actions (Auth Button / Profile Dropdown) -->
            <div class="d-flex flex-column flex-lg-row align-items-stretch align-items-lg-center gap-2 pt-2 pt-lg-0 border-top border-lg-0 border-light-subtle">
                @guest
                    <!-- Login/Register CTA -->
                    <a
                        href="{{ route('login') }}"
                        class="btn btn-primary btn-sm rounded-pill px-4 py-2 text-white text-decoration-none fw-medium d-flex align-items-center justify-content-center shadow-sm"
                        id="navbar-login-btn"
                    >
                        <i class="bi bi-person-circle me-1"></i> Masuk / Daftar
                    </a>
                @endguest

                @auth
                    <!-- User Profile Dropdown -->
                    <div class="dropdown">
                        <button class="btn btn-outline-primary btn-sm rounded-pill px-3 py-2 dropdown-toggle d-flex align-items-center gap-2 w-100" type="button" id="userMenuDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 24px; height: 24px; font-size: 0.75rem;">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </div>
                            <span class="fw-semibold text-truncate" style="max-width: 130px;">{{ Auth::user()->name }}</span>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end border-0 shadow-lg" aria-labelledby="userMenuDropdown">
                            <li class="px-3 py-2 border-bottom">
                                <span class="d-block small text-muted">Signed in as</span>
                                <span class="fw-bold text-dark text-truncate d-block small">{{ Auth::user()->email }}</span>
                            </li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger py-2">
                                        <i class="bi bi-box-arrow-right me-2"></i> Keluar
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                @endauth
            </div>

        </div>
    </div>
</nav>
