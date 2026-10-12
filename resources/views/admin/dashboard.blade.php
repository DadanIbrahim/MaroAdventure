@extends('layouts.admin')

@section('title', 'Admin Dashboard - Maro Adventure')
@section('page_title', 'Overview Dashboard')

@section('content')
<!-- Statistik Utama -->
<div class="row g-4 mb-4">
    <div class="col-12 col-md-6 col-lg-3">
        <div class="card h-100 border-0 shadow-sm">
            <div class="card-body d-flex align-items-center">
                <div class="bg-primary bg-opacity-10 text-primary p-3 rounded-3 me-3">
                    <i class="bi bi-wallet2 fs-3"></i>
                </div>
                <div>
                    <h6 class="text-muted small mb-1">Total Revenue</h6>
                    <h4 class="mb-0 fw-bold">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</h4>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-6 col-lg-3">
        <div class="card h-100 border-0 shadow-sm">
            <div class="card-body d-flex align-items-center">
                <div class="bg-success bg-opacity-10 text-success p-3 rounded-3 me-3">
                    <i class="bi bi-compass fs-3"></i>
                </div>
                <div>
                    <h6 class="text-muted small mb-1">Paket Trip Aktif</h6>
                    <h4 class="mb-0 fw-bold">{{ $totalTrips }} Paket</h4>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-6 col-lg-3">
        <div class="card h-100 border-0 shadow-sm">
            <div class="card-body d-flex align-items-center">
                <div class="bg-info bg-opacity-10 text-info p-3 rounded-3 me-3">
                    <i class="bi bi-people fs-3"></i>
                </div>
                <div>
                    <h6 class="text-muted small mb-1">Total Member / Peserta</h6>
                    <h4 class="mb-0 fw-bold">{{ $totalParticipants }} User</h4>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-6 col-lg-3">
        <div class="card h-100 border-0 shadow-sm">
            <div class="card-body d-flex align-items-center">
                <div class="bg-warning bg-opacity-10 text-warning p-3 rounded-3 me-3">
                    <i class="bi bi-hourglass-split fs-3"></i>
                </div>
                <div>
                    <h6 class="text-muted small mb-1">Pending Bookings</h6>
                    <h4 class="mb-0 fw-bold">{{ $pendingBookings }}</h4>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    <!-- Tabel Pemesanan Terbaru -->
    <div class="col-12 col-xl-8">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                <h6 class="mb-0 fw-bold">Pemesanan Terbaru</h6>
                <a href="{{ route('admin.bookings.index') }}" class="btn btn-sm btn-outline-primary">Lihat Semua</a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="ps-3">Kode Booking</th>
                                <th>Peserta / User</th>
                                <th>Paket Trip</th>
                                <th>Status</th>
                                <th class="text-center pe-3">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentBookings as $booking)
                            <tr>
                                <td class="ps-3 fw-bold text-primary">#{{ $booking->booking_code }}</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-2" style="width: 32px; height: 32px; font-size: 13px;">
                                            {{ substr($booking->user->name ?? $booking->customer_name, 0, 1) }}
                                        </div>
                                        <div>
                                            <span class="fw-semibold">{{ $booking->user->name ?? $booking->customer_name }}</span>
                                            @if($booking->customer_phone)
                                                <div class="small text-muted" style="font-size: 0.75rem;">{{ $booking->customer_phone }}</div>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="fw-medium">{{ $booking->trip ? ($booking->trip->title ?? $booking->trip->name) : 'Trip' }}</div>
                                    <small class="text-muted">{{ $booking->participants }} Peserta</small>
                                </td>
                                <td>{!! $booking->status_badge !!}</td>
                                <td class="text-center pe-3">
                                    <a href="{{ route('admin.bookings.edit', $booking->id) }}" class="btn btn-sm btn-light" title="Detail Booking">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center py-4 text-muted">
                                    Belum ada transaksi pemesanan terbaru.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Destinasi Populer -->
    <div class="col-12 col-xl-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                <h6 class="mb-0 fw-bold">Destinasi Populer</h6>
                <a href="{{ route('admin.trips.index') }}" class="btn btn-sm btn-outline-primary">Kelola Trip</a>
            </div>
            <div class="card-body">
                @forelse($popularTrips as $trip)
                <div class="d-flex align-items-center mb-4">
                    <img src="{{ $trip->image_url ?? asset('assets/images/hero_mountain.jpg') }}" 
                         class="rounded border shadow-sm" width="56" height="56" style="object-fit: cover;" 
                         alt="{{ $trip->title ?? $trip->name }}" 
                         onerror="this.src='{{ asset('assets/images/hero_mountain.jpg') }}'">
                    <div class="ms-3 flex-grow-1">
                        <h6 class="mb-1 fw-bold text-dark">{{ $trip->title ?? $trip->name }}</h6>
                        <div class="text-muted small">
                            <i class="bi bi-ticket-detailed me-1"></i>{{ $trip->bookings_count }} Pemesanan
                        </div>
                    </div>
                    <div class="fw-bold text-primary small">
                        Rp {{ number_format($trip->price, 0, ',', '.') }}
                    </div>
                </div>
                @empty
                <div class="text-center py-4 text-muted">
                    <p class="small mb-0">Belum ada paket trip yang dipesan.</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
