<div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-4">
    <div class="card-header bg-white border-0 pt-4 pb-2 px-4">
        <a href="{{ url('/') }}" class="d-flex align-items-center gap-2 text-decoration-none mb-3">
            <img src="{{ asset('assets/images/brand_maro.png') }}" alt="Logo Maro Adventure Indonesia" style="width: 40px; height: 40px; object-fit: contain;">
            <span class="fw-bold" style="font-family: var(--font-heading); color: var(--color-navy);">Maro Adventure</span>
        </a>
        <h6 class="text-uppercase text-muted fw-bold mb-0" style="font-size: 0.75rem; letter-spacing: 1px;">User Workspace</h6>
    </div>
    <div class="card-body p-0">
        <div class="list-group list-group-flush border-0">
            <a href="{{ route('dashboard.index') }}" class="list-group-item list-group-item-action py-3 px-4 border-0 {{ request()->routeIs('dashboard.index') ? 'active bg-primary text-white fw-semibold' : 'text-dark' }}">
                <i class="bi bi-grid me-2"></i> Dashboard
            </a>
            <a href="{{ route('dashboard.bookings') }}" class="list-group-item list-group-item-action py-3 px-4 border-0 {{ request()->routeIs('dashboard.bookings') ? 'active bg-primary text-white fw-semibold' : 'text-dark' }}">
                <i class="bi bi-briefcase me-2"></i> My Booking
            </a>
            <a href="{{ route('dashboard.points') }}" class="list-group-item list-group-item-action py-3 px-4 border-0 {{ request()->routeIs('dashboard.points') ? 'active bg-primary text-white fw-semibold' : 'text-dark' }}">
                <i class="bi bi-star me-2"></i> Points & Rewards
            </a>
            <a href="{{ route('dashboard.community') }}" class="list-group-item list-group-item-action py-3 px-4 border-0 {{ request()->routeIs('dashboard.community') ? 'active bg-primary text-white fw-semibold' : 'text-dark' }}">
                <i class="bi bi-people me-2"></i> Community
            </a>
            <a href="{{ route('dashboard.profile') }}" class="list-group-item list-group-item-action py-3 px-4 border-0 {{ request()->routeIs('dashboard.profile') ? 'active bg-primary text-white fw-semibold' : 'text-dark' }}">
                <i class="bi bi-person me-2"></i> Profile
            </a>
        </div>
    </div>
    <div class="card-footer bg-white border-top px-4 py-3 d-flex flex-column gap-2">
        <a href="{{ url('/') }}" class="btn btn-outline-primary btn-sm rounded-pill fw-semibold">
            <i class="bi bi-house-door me-1"></i> Kembali ke Beranda
        </a>
        <form action="{{ route('logout') }}" method="POST" class="m-0">
            @csrf
            <button type="submit" class="btn btn-outline-danger btn-sm rounded-pill fw-semibold w-100">
                <i class="bi bi-box-arrow-right me-1"></i> Logout
            </button>
        </form>
    </div>
</div>

<style>
    /* Styling for active state similar to wireframe */
    .list-group-item.active {
        border-radius: 0;
        background-color: var(--color-primary-light, #38BDF8) !important;
        border-color: var(--color-primary-light, #38BDF8) !important;
    }
    .list-group-item:not(.active):hover {
        background-color: var(--color-light-blue, #E0F2FE);
    }
</style>
