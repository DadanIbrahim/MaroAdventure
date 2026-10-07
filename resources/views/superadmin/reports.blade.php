@extends(request()->routeIs('superadmin.*') ? 'layouts.superadmin' : 'layouts.admin')
@section('title', 'Reports - Superadmin')
@section('page_title', 'Advanced Analytics & Reports')

@section('content')
<div class="row g-4 mb-4">
    <div class="col-12 col-lg-8">
        <div class="row g-4">
            <div class="col-md-6">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body d-flex flex-column justify-content-center text-center py-5">
                        <i class="bi bi-ticket-detailed fs-1 text-primary mb-3"></i>
                        <h3 class="fw-bold mb-1">{{ $totalBookings }}</h3>
                        <p class="text-muted mb-0">Total Successful Bookings</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body d-flex flex-column justify-content-center text-center py-5">
                        <i class="bi bi-people fs-1 text-success mb-3"></i>
                        <h3 class="fw-bold mb-1">{{ $totalUsers }}</h3>
                        <p class="text-muted mb-0">Registered Users</p>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body d-flex flex-column justify-content-center text-center py-5">
                        <i class="bi bi-map fs-1 text-warning mb-3"></i>
                        <h3 class="fw-bold mb-1">{{ $totalTrips }}</h3>
                        <p class="text-muted mb-0">Active Trips</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-lg-4">
        <div class="card border-0 shadow-sm h-100 bg-primary text-white">
            <div class="card-body d-flex flex-column justify-content-center text-center py-5">
                <i class="bi bi-cash-stack display-1 mb-3"></i>
                <h5>Total Net Profit</h5>
                <h2 class="fw-bold mb-4">Rp {{ number_format($totalProfit, 0, ',', '.') }}</h2>
                <p class="small text-white-50">All Time Revenue</p>
                <button class="btn btn-light mt-auto fw-bold text-primary">Download Financial Statement</button>
            </div>
        </div>
    </div>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-header bg-white py-3">
        <h6 class="mb-0 fw-bold">Recent Successful Payments</h6>
    </div>
    <div class="card-body p-0">
        <ul class="list-group list-group-flush">
            @forelse($recentBookings as $booking)
            <li class="list-group-item py-3">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <span class="badge bg-success me-2">Paid</span> 
                        Payment confirmed for booking <strong>#{{ $booking->booking_code }}</strong> by {{ $booking->user->name ?? 'Unknown User' }}
                        <div class="small text-muted mt-1">Trip: {{ $booking->trip->title ?? 'Unknown Trip' }} - Rp {{ number_format($booking->total_price, 0, ',', '.') }}</div>
                    </div>
                    <small class="text-muted">{{ $booking->updated_at->diffForHumans() }}</small>
                </div>
            </li>
            @empty
            <li class="list-group-item py-4 text-center text-muted">
                Belum ada transaksi pembayaran yang berhasil.
            </li>
            @endforelse
        </ul>
    </div>
</div>
@endsection
