<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Superadmin Dashboard - Maro Adventure')</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Custom CSS (Assuming existing style.css has base styles) -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

    <style>
        :root {
            --sidebar-width: 250px;
            --sidebar-bg: #f8f9fa;
            --sidebar-hover: #e9ecef;
            --sidebar-active: #e2e6ea;
            --sidebar-color: #333;
        }
        
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #f4f6f9;
        }

        h1, h2, h3, h4, h5, h6 {
            font-family: 'Outfit', sans-serif;
        }

        .admin-wrapper {
            display: flex;
            min-height: 100vh;
            width: 100%;
            overflow-x: hidden;
        }

        /* Sidebar Styles */
        .admin-sidebar {
            width: var(--sidebar-width);
            background-color: var(--sidebar-bg);
            border-right: 1px solid #dee2e6;
            flex-shrink: 0;
            display: flex;
            flex-direction: column;
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            z-index: 1000;
        }

        .sidebar-brand {
            padding: 1.5rem;
            font-size: 1.5rem;
            font-weight: 700;
            color: #000;
            text-decoration: none;
            text-align: center;
            border-bottom: 1px solid #dee2e6;
            letter-spacing: 2px;
        }

        .sidebar-menu {
            list-style: none;
            padding: 0;
            margin: 0;
            flex-grow: 1;
            overflow-y: auto;
        }

        .sidebar-menu li a {
            display: flex;
            align-items: center;
            padding: 0.8rem 1.5rem;
            color: var(--sidebar-color);
            text-decoration: none;
            font-weight: 500;
            transition: all 0.2s ease;
            font-size: 0.95rem;
        }

        .sidebar-menu li a:hover {
            background-color: var(--sidebar-hover);
        }

        .sidebar-menu li.active a {
            background-color: var(--sidebar-active);
            font-weight: 600;
        }

        .sidebar-menu li a i {
            margin-right: 12px;
            font-size: 1.1rem;
            width: 20px;
            text-align: center;
        }

        .sidebar-footer {
            padding: 1rem;
            border-top: 1px solid #dee2e6;
        }

        /* Main Content */
        .admin-main {
            flex-grow: 1;
            margin-left: var(--sidebar-width);
            width: calc(100% - var(--sidebar-width));
            max-width: calc(100% - var(--sidebar-width));
            min-width: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        /* Topbar */
        .admin-topbar {
            height: 70px;
            background-color: #fff;
            border-bottom: 1px solid #dee2e6;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 2rem;
            position: sticky;
            top: 0;
            z-index: 999;
        }

        .admin-content {
            padding: 2rem;
            flex-grow: 1;
        }

        /* Card Adjustments */
        .card {
            border: none;
            box-shadow: 0 0.125rem 0.25rem rgba(0,0,0,0.075);
            border-radius: 0.5rem;
        }

        .card-header {
            background-color: #fff;
            border-bottom: 1px solid rgba(0,0,0,0.05);
            font-weight: 600;
        }

        /* Table adjustments */
        .table > :not(caption) > * > * {
            padding: 1rem;
        }
        
        @media (max-width: 768px) {
            .admin-sidebar {
                transform: translateX(-100%);
                transition: transform 0.3s ease;
            }
            .admin-sidebar.show {
                transform: translateX(0);
            }
            .admin-main {
                margin-left: 0;
                width: 100%;
                max-width: 100%;
            }
        }
    </style>
    @stack('styles')
</head>
<body>

    <div class="admin-wrapper">
        <!-- Sidebar -->
        <aside class="admin-sidebar" id="adminSidebar">
            <a href="{{ route('superadmin.dashboard') }}" class="sidebar-brand font-heading text-primary">
                MARO <span class="d-block fs-6 text-muted fw-normal mt-1">Superadmin</span>
            </a>
            
            <ul class="sidebar-menu mt-2">
                <li class="{{ request()->routeIs('superadmin.dashboard') ? 'active' : '' }}">
                    <a href="{{ route('superadmin.dashboard') }}">
                        <i class="bi bi-grid"></i> Dashboard
                    </a>
                </li>
                <li class="{{ request()->routeIs('superadmin.users') ? 'active' : '' }}">
                    <a href="{{ route('superadmin.users') }}">
                        <i class="bi bi-people-fill"></i> User Management
                    </a>
                </li>
                <li class="{{ request()->routeIs('superadmin.participants') ? 'active' : '' }}">
                    <a href="{{ route('superadmin.participants') }}">
                        <i class="bi bi-person-badge"></i> Participants
                    </a>
                </li>
                <li class="{{ request()->routeIs('superadmin.content') ? 'active' : '' }}">
                    <a href="{{ route('superadmin.content') }}">
                        <i class="bi bi-file-earmark-richtext"></i> Content
                    </a>
                </li>

                <li class="{{ request()->routeIs('superadmin.berita.*') || request()->routeIs('superadmin.berita') || request()->routeIs('superadmin.news.*') ? 'active' : '' }}">
                    <a href="{{ route('superadmin.berita.index') }}">
                        <i class="bi bi-newspaper"></i> Berita
                    </a>
                </li>
                <li class="{{ request()->routeIs('superadmin.articles.*') || request()->routeIs('superadmin.articles') ? 'active' : '' }}">
                    <a href="{{ route('superadmin.articles.index') }}">
                        <i class="bi bi-journal-text"></i> Artikel
                    </a>
                </li>
                <li class="{{ request()->routeIs('superadmin.mountains.*') || request()->routeIs('superadmin.mountains') || request()->routeIs('superadmin.destinasi.*') ? 'active' : '' }}">
                    <a href="{{ route('superadmin.mountains.index') }}">
                        <i class="bi bi-geo-alt"></i> Destinasi
                    </a>
                </li>
                <li class="{{ request()->routeIs('superadmin.trips.*') || request()->routeIs('superadmin.trips') ? 'active' : '' }}">
                    <a href="{{ route('superadmin.trips.index') }}">
                        <i class="bi bi-map"></i> Trip
                    </a>
                </li>
                <li class="{{ request()->routeIs('superadmin.bookings.*') || request()->routeIs('superadmin.bookings') ? 'active' : '' }}">
                    <a href="{{ route('superadmin.bookings.index') }}">
                        <i class="bi bi-ticket-detailed"></i> Booking
                    </a>
                </li>
                <li class="{{ request()->routeIs('superadmin.payments.*') || request()->routeIs('superadmin.payments') ? 'active' : '' }}">
                    <a href="{{ route('superadmin.payments.index') }}">
                        <i class="bi bi-credit-card"></i> Payment
                    </a>
                </li>
                <li class="{{ request()->routeIs('superadmin.community.*') || request()->routeIs('superadmin.community') ? 'active' : '' }}">
                    <a href="{{ route('superadmin.community.index') }}">
                        <i class="bi bi-people"></i> Community
                    </a>
                </li>
                <li class="{{ request()->routeIs('superadmin.points.*') || request()->routeIs('superadmin.points') ? 'active' : '' }}">
                    <a href="{{ route('superadmin.points.index') }}">
                        <i class="bi bi-coin"></i> Points
                    </a>
                </li>
                <li class="{{ request()->routeIs('superadmin.rewards.*') || request()->routeIs('superadmin.rewards') ? 'active' : '' }}">
                    <a href="{{ route('superadmin.rewards.index') }}">
                        <i class="bi bi-gift"></i> Rewards
                    </a>
                </li>
                <li class="{{ request()->routeIs('superadmin.reports') ? 'active' : '' }}">
                    <a href="{{ route('superadmin.reports') }}">
                        <i class="bi bi-graph-up"></i> Reports
                    </a>
                </li>
            </ul>

            <div class="sidebar-footer">
                <div class="d-flex align-items-center mb-3 px-2">
                    <div class="avatar bg-danger text-white rounded-circle d-flex align-items-center justify-content-center me-2 fw-bold" style="width: 40px; height: 40px;">
                        {{ strtoupper(substr(Auth::user()->name ?? 'S', 0, 1)) }}
                    </div>
                    <div class="overflow-hidden">
                        <div class="fw-bold fs-6 text-truncate" style="max-width: 140px;">{{ Auth::user()->name }}</div>
                        <div class="text-muted small text-capitalize">{{ Auth::user()->role }}</div>
                    </div>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-outline-danger w-100 btn-sm">
                        <i class="bi bi-box-arrow-right me-1"></i> Logout
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="admin-main">
            <!-- Topbar -->
            <header class="admin-topbar">
                <div class="d-flex align-items-center">
                    <button class="btn btn-light d-md-none me-3" id="sidebarToggle">
                        <i class="bi bi-list fs-4"></i>
                    </button>
                    <h4 class="mb-0 fw-bold text-primary">@yield('page_title', 'Dashboard')</h4>
                </div>
                
                <div class="d-flex align-items-center gap-3">
                    <div class="position-relative">
                        <i class="bi bi-bell fs-5 text-secondary"></i>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size: 0.6rem;">
                            9+
                        </span>
                    </div>
                    <a href="{{ url('/') }}" class="btn btn-sm btn-outline-primary" target="_blank">
                        <i class="bi bi-box-arrow-up-right me-1"></i> View Site
                    </a>
                </div>
            </header>

            <!-- Page Content -->
            <div class="admin-content">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm" role="alert">
                        <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                @if(session('warning'))
                    <div class="alert alert-warning alert-dismissible fade show border-0 shadow-sm" role="alert">
                        <i class="bi bi-exclamation-triangle me-2"></i>{{ session('warning') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm" role="alert">
                        <i class="bi bi-x-circle me-2"></i>{{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                
                @yield('content')
            </div>
        </main>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.getElementById('sidebarToggle')?.addEventListener('click', function() {
            document.getElementById('adminSidebar').classList.toggle('show');
        });

        // Global SweetAlert2 Toast
        window.Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3500,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer);
                toast.addEventListener('mouseleave', Swal.resumeTimer);
            }
        });

        @if(session('success'))
            Toast.fire({
                icon: 'success',
                title: "{{ addslashes(session('success')) }}"
            });
        @endif

        @if(session('warning'))
            Toast.fire({
                icon: 'warning',
                title: "{{ addslashes(session('warning')) }}"
            });
        @endif

        @if(session('error'))
            Toast.fire({
                icon: 'error',
                title: "{{ addslashes(session('error')) }}"
            });
        @endif

        @if(session('info'))
            Toast.fire({
                icon: 'info',
                title: "{{ addslashes(session('info')) }}"
            });
        @endif
    </script>
    @stack('scripts')
</body>
</html>
