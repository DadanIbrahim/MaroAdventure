@extends('layouts.superadmin')
@section('title', 'Superadmin Dashboard - Maro Adventure')
@section('page_title', 'Overview Dashboard')

@section('content')

{{-- Selamat Datang --}}
<div class="mb-4">
    <h4 class="fw-bold mb-0" style="font-family: 'Outfit', sans-serif;">
        Selamat datang, <span class="text-primary">{{ auth()->user()->name }}</span> 👋
    </h4>
    <p class="text-muted mb-0 small">Ringkasan lengkap sistem Maro Adventure</p>
</div>

{{-- Statistik Utama --}}
<div class="row g-4 mb-4">
    <div class="col-12 col-md-6 col-lg-3">
        <div class="card h-100 border-0 shadow-sm">
            <div class="card-body d-flex align-items-center">
                <div class="bg-primary bg-opacity-10 text-primary p-3 rounded-3 me-3">
                    <i class="bi bi-people-fill fs-3"></i>
                </div>
                <div>
                    <h6 class="text-muted small mb-1">Total Member</h6>
                    <h4 class="mb-0 fw-bold">{{ number_format($totalUsers, 0, ',', '.') }}</h4>
                    <small class="text-muted">{{ $totalAdmins }} Admin aktif</small>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-6 col-lg-3">
        <div class="card h-100 border-0 shadow-sm">
            <div class="card-body d-flex align-items-center">
                <div class="bg-success bg-opacity-10 text-success p-3 rounded-3 me-3">
                    <i class="bi bi-wallet2 fs-3"></i>
                </div>
                <div>
                    <h6 class="text-muted small mb-1">Total Revenue</h6>
                    <h4 class="mb-0 fw-bold">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</h4>
                    <small class="text-muted">Dari transaksi lunas</small>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-6 col-lg-3">
        <div class="card h-100 border-0 shadow-sm">
            <div class="card-body d-flex align-items-center">
                <div class="bg-info bg-opacity-10 text-info p-3 rounded-3 me-3">
                    <i class="bi bi-ticket-detailed fs-3"></i>
                </div>
                <div>
                    <h6 class="text-muted small mb-1">Total Booking</h6>
                    <h4 class="mb-0 fw-bold">{{ number_format($totalBookings, 0, ',', '.') }}</h4>
                    <small class="text-muted">{{ $pendingBookings }} menunggu konfirmasi</small>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-6 col-lg-3">
        <div class="card h-100 border-0 shadow-sm">
            <div class="card-body d-flex align-items-center">
                <div class="bg-warning bg-opacity-10 text-warning p-3 rounded-3 me-3">
                    <i class="bi bi-map fs-3"></i>
                </div>
                <div>
                    <h6 class="text-muted small mb-1">Paket Trip</h6>
                    <h4 class="mb-0 fw-bold">{{ $totalTrips }}</h4>
                    <small class="text-muted">Paket tersedia</small>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Tabel Booking Terbaru & Quick Actions --}}
<div class="row g-4">
    {{-- Tabel Booking Terbaru --}}
    <div class="col-12 col-xl-8">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                <h6 class="mb-0 fw-bold">Booking Terbaru</h6>
                <a href="{{ route('superadmin.bookings.index') }}" class="btn btn-sm btn-outline-primary">Lihat Semua</a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="ps-3">Kode Booking</th>
                                <th>Member</th>
                                <th>Trip</th>
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
                                    <a href="{{ route('superadmin.bookings.edit', $booking->id) }}" class="btn btn-sm btn-light" title="Detail Booking">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center py-4 text-muted">
                                    Belum ada transaksi pemesanan.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- Quick Actions & System Info --}}
    <div class="col-12 col-xl-4">
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-white py-3">
                <h6 class="mb-0 fw-bold">Quick Actions</h6>
            </div>
            <div class="card-body d-grid gap-2">
                <a href="{{ route('superadmin.users') }}" class="btn btn-outline-primary btn-sm text-start">
                    <i class="bi bi-people-fill me-2"></i> Kelola User & Admin
                </a>
                <a href="{{ route('superadmin.trips.create') }}" class="btn btn-outline-success btn-sm text-start">
                    <i class="bi bi-plus-circle me-2"></i> Tambah Trip Baru
                </a>
                <a href="{{ route('superadmin.mountains.index') }}" class="btn btn-outline-secondary btn-sm text-start">
                    <i class="bi bi-geo-alt me-2"></i> Kelola Gunung
                </a>
                <a href="{{ route('superadmin.articles.index') }}" class="btn btn-outline-info btn-sm text-start">
                    <i class="bi bi-journal-text me-2"></i> Kelola Artikel & Berita
                </a>
                <a href="{{ route('superadmin.reports') }}" class="btn btn-outline-warning btn-sm text-start">
                    <i class="bi bi-graph-up me-2"></i> Lihat Laporan
                </a>
            </div>
        </div>

        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white py-3">
                <h6 class="mb-0 fw-bold">Status Sistem</h6>
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <span class="small text-muted">Database</span>
                    <span class="badge bg-success-subtle text-success border border-success-subtle">Online</span>
                </div>
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <span class="small text-muted">Aplikasi</span>
                    <span class="badge bg-success-subtle text-success border border-success-subtle">Running</span>
                </div>
                <div class="d-flex justify-content-between align-items-center">
                    <span class="small text-muted">Versi Laravel</span>
                    <span class="badge bg-secondary-subtle text-secondary">{{ app()->version() }}</span>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
