<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard - Maro Adventure')</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
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
            padding: 1rem 1.5rem;
            color: var(--sidebar-color);
            text-decoration: none;
            font-weight: 500;
            transition: all 0.2s ease;
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
        }

        .sidebar-footer {
            padding: 1rem;
            border-top: 1px solid #dee2e6;
        }

        /* Main Content */
        .admin-main {
            flex-grow: 1;
            margin-left: var(--sidebar-width);
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
            }
        }
    </style>
    @stack('styles')
</head>
<body>

    <div class="admin-wrapper">
        <!-- Sidebar -->
        <aside class="admin-sidebar" id="adminSidebar">
            <a href="{{ route('admin.dashboard') }}" class="sidebar-brand font-heading">
                MARO <span class="d-block fs-6 text-muted fw-normal mt-1">Admin Panel</span>
            </a>
            
            <ul class="sidebar-menu mt-3">
                <li class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <a href="{{ route('admin.dashboard') }}">
                        <i class="bi bi-grid"></i> Dashboard
                    </a>
                </li>
                <li class="{{ request()->routeIs('admin.trips') ? 'active' : '' }}">
                    <a href="{{ route('admin.trips') }}">
                        <i class="bi bi-map"></i> Trips
                    </a>
                </li>
                <li class="{{ request()->routeIs('admin.schedule') ? 'active' : '' }}">
                    <a href="{{ route('admin.schedule') }}">
                        <i class="bi bi-calendar-event"></i> Schedule
                    </a>
                </li>
                <li class="{{ request()->routeIs('admin.participants') ? 'active' : '' }}">
                    <a href="{{ route('admin.participants') }}">
                        <i class="bi bi-people"></i> Participants
                    </a>
                </li>
                <li class="{{ request()->routeIs('admin.booking') ? 'active' : '' }}">
                    <a href="{{ route('admin.booking') }}">
                        <i class="bi bi-ticket-detailed"></i> Booking
                    </a>
                </li>
                <li class="{{ request()->routeIs('admin.reports') ? 'active' : '' }}">
                    <a href="{{ route('admin.reports') }}">
                        <i class="bi bi-graph-up"></i> Reports
                    </a>
                </li>
            </ul>

            <div class="sidebar-footer">
                <div class="d-flex align-items-center mb-3 px-2">
                    <div class="avatar bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-2" style="width: 40px; height: 40px;">
                        {{ substr(Auth::user()->name ?? 'A', 0, 1) }}
                    </div>
                    <div>
                        <div class="fw-bold fs-6">{{ Auth::user()->name ?? 'Admin' }}</div>
                        <div class="text-muted small">Administrator</div>
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
                    <h4 class="mb-0 fw-bold">@yield('page_title', 'Dashboard')</h4>
                </div>
                
                <div class="d-flex align-items-center gap-3">
                    <div class="position-relative">
                        <i class="bi bi-bell fs-5 text-secondary"></i>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size: 0.6rem;">
                            3
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
                
                @yield('content')
            </div>
        </main>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        document.getElementById('sidebarToggle')?.addEventListener('click', function() {
            document.getElementById('adminSidebar').classList.toggle('show');
        });
    </script>
    @stack('scripts')
</body>
</html>
