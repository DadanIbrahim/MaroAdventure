@extends('layouts.app')

@section('title', 'Dashboard - Maro Adventure')

@section('content')
<div class="bg-light pb-5" style="min-height: 100vh; padding-top: 100px;">
    <div class="container py-4">
        <div class="row">
            
            <!-- Sidebar -->
            <div class="col-lg-3 mb-4 mb-lg-0">
                @include('dashboard.partials.sidebar')
            </div>

            <!-- Main Content -->
            <div class="col-lg-9">
                <div class="ps-lg-4">
                    
                    <!-- Header Section -->
                    <div class="mb-4 d-flex justify-content-between align-items-center flex-wrap gap-3">
                        <div>
                            <h2 class="fw-bold mb-1" style="color: var(--color-dark);">
                                Welcome back, {{ explode(' ', Auth::user()->name)[0] }}! 👋
                            </h2>
                            <p class="text-muted mb-0">Berikut ringkasan aktivitas petualangan dan pesanan trip Anda di MARO Adventure.</p>
                        </div>
                        <a href="{{ route('checkout.index') }}" class="btn btn-primary rounded-pill px-4 py-2 fw-semibold shadow-sm d-flex align-items-center gap-2">
                            <i class="bi bi-compass-fill"></i> Pesan Trip Baru
                        </a>
                    </div>

                    <!-- Stats Cards -->
                    <div class="row g-3 mb-4">
                        <!-- Total Trips -->
                        <div class="col-md-4">
                            <div class="card border-0 shadow-sm rounded-4 h-100">
                                <div class="card-body p-4 d-flex flex-column justify-content-between">
                                    <div class="d-flex justify-content-between align-items-start mb-2">
                                        <p class="text-muted small fw-medium mb-0">Total Perjalanan</p>
                                        <div class="bg-primary bg-opacity-10 text-primary rounded-circle p-2 d-flex align-items-center justify-content-center" style="width: 36px; height: 36px;">
                                            <i class="bi bi-backpack2-fill"></i>
                                        </div>
                                    </div>
                                    <h3 class="fw-bold mb-2">{{ $totalTrips }}</h3>
                                    <div>
                                        @if($activeTrips > 0)
                                            <span class="text-primary small fw-semibold">
                                                <i class="bi bi-clock-history me-1"></i> {{ $activeTrips }} trip aktif / upcoming
                                            </span>
                                        @else
                                            <span class="text-muted small">
                                                <i class="bi bi-check2-all me-1"></i> {{ $completedTrips }} trip selesai
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Maro Points -->
                        <div class="col-md-4">
                            <div class="card border-0 shadow-sm rounded-4 h-100">
                                <div class="card-body p-4 d-flex flex-column justify-content-between">
                                    <div class="d-flex justify-content-between align-items-start mb-2">
                                        <p class="text-muted small fw-medium mb-0">Saldo Poin</p>
                                        <div class="bg-warning bg-opacity-10 text-warning-emphasis rounded-circle p-2 d-flex align-items-center justify-content-center" style="width: 36px; height: 36px;">
                                            <i class="bi bi-star-fill"></i>
                                        </div>
                                    </div>
                                    <h3 class="fw-bold mb-2" style="color: var(--color-primary);">
                                        {{ number_format($userPoints, 0, ',', '.') }}
                                    </h3>
                                    <div>
                                        <a href="{{ route('dashboard.points') }}" class="text-primary text-decoration-none small fw-semibold">
                                            <i class="bi bi-gift me-1"></i> Tukar Hadiah &amp; Voucher &rarr;
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Cerita Komunitas -->
                        <div class="col-md-4">
                            <div class="card border-0 shadow-sm rounded-4 h-100">
                                <div class="card-body p-4 d-flex flex-column justify-content-between">
                                    <div class="d-flex justify-content-between align-items-start mb-2">
                                        <p class="text-muted small fw-medium mb-0">Cerita Komunitas</p>
                                        <div class="bg-success bg-opacity-10 text-success rounded-circle p-2 d-flex align-items-center justify-content-center" style="width: 36px; height: 36px;">
                                            <i class="bi bi-chat-heart-fill"></i>
                                        </div>
                                    </div>
                                    <h3 class="fw-bold mb-2">{{ $userStoriesCount }}</h3>
                                    <div>
                                        <a href="{{ route('dashboard.community') }}" class="text-success text-decoration-none small fw-semibold">
                                            <i class="bi bi-pencil-square me-1"></i> Tulis Cerita Pendakian &rarr;
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Highlight: Next Upcoming Trip (Jika ada) -->
                    @php
                        $nextTrip = $recentBookings->whereIn('status', ['confirmed', 'pending'])->first();
                    @endphp

                    @if($nextTrip)
                        <div class="card border-0 shadow-sm rounded-4 mb-4 text-white overflow-hidden position-relative" style="background: linear-gradient(135deg, var(--color-navy) 0%, var(--color-primary-dark) 100%);">
                            <div class="card-body p-4 p-md-4 position-relative" style="z-index: 2;">
                                <div class="row align-items-center g-3">
                                    <div class="col-md-8">
                                        <span class="badge bg-white bg-opacity-25 text-white rounded-pill px-3 py-1 mb-2">
                                            <i class="bi bi-calendar-check me-1"></i> Perjalanan Terdekat
                                        </span>
                                        <h4 class="fw-bold mb-1">{{ $nextTrip->trip->name ?? 'Trip Petualangan' }}</h4>
                                        <p class="text-white-50 small mb-0">
                                            <i class="bi bi-geo-alt me-1"></i> {{ $nextTrip->trip->mountain->name ?? 'Pegunungan' }} 
                                            &bull; Berangkat: {{ date('d M Y', strtotime($nextTrip->booking_date)) }} 
                                            &bull; {{ $nextTrip->participants }} peserta
                                        </p>
                                    </div>
                                    <div class="col-md-4 text-md-end">
                                        <a href="{{ route('dashboard.bookings.show', $nextTrip->id) }}" class="btn btn-light rounded-pill px-4 py-2 fw-bold text-primary shadow-sm">
                                            Lihat Tiket &rarr;
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Recent Activity Section -->
                    <div>
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5 class="fw-bold mb-0" style="color: var(--color-dark);">Aktivitas &amp; Pesanan Terbaru</h5>
                            <a href="{{ route('dashboard.bookings') }}" class="text-primary text-decoration-none small fw-semibold">
                                Lihat Semua Pesanan &rarr;
                            </a>
                        </div>
                        
                        <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                            <div class="list-group list-group-flush border-0">
                                
                                @forelse($recentBookings as $booking)
                                    <div class="list-group-item d-flex align-items-center justify-content-between px-4 py-3 border-0 border-bottom">
                                        <div class="d-flex align-items-center gap-3">
                                            <!-- Status Icon -->
                                            <div class="rounded-circle d-flex align-items-center justify-content-center flex-shrink-0" style="width: 44px; height: 44px; background: #F0F9FF;">
                                                @if($booking->status === 'confirmed')
                                                    <i class="bi bi-check-circle-fill text-primary fs-5"></i>
                                                @elseif($booking->status === 'completed')
                                                    <i class="bi bi-trophy-fill text-success fs-5"></i>
                                                @elseif($booking->status === 'cancelled')
                                                    <i class="bi bi-x-circle-fill text-danger fs-5"></i>
                                                @else
                                                    <i class="bi bi-clock-fill text-warning fs-5"></i>
                                                @endif
                                            </div>

                                            <div>
                                                <div class="d-flex align-items-center gap-2 flex-wrap">
                                                    <h6 class="mb-0 fw-bold text-dark">{{ $booking->trip->name ?? 'Trip Pendakian' }}</h6>
                                                    <span class="badge bg-light text-muted border font-monospace" style="font-size: 0.7rem;">
                                                        {{ $booking->booking_code }}
                                                    </span>
                                                </div>
                                                <p class="mb-0 text-muted small mt-1">
                                                    <i class="bi bi-calendar3 me-1"></i> {{ date('d M Y', strtotime($booking->booking_date)) }} 
                                                    &bull; {{ $booking->participants }} peserta 
                                                    &bull; <strong class="text-dark">{{ $booking->formatted_price }}</strong>
                                                </p>
                                            </div>
                                        </div>

                                        <div class="d-flex align-items-center gap-2">
                                            @if($booking->payment_status === 'paid')
                                                <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-3 py-1 small d-none d-sm-inline-block">
                                                    Lunas
                                                </span>
                                            @else
                                                <span class="badge bg-warning bg-opacity-10 text-warning-emphasis rounded-pill px-3 py-1 small d-none d-sm-inline-block">
                                                    Belum Bayar
                                                </span>
                                            @endif

                                            <a href="{{ route('dashboard.bookings.show', $booking->id) }}" class="btn btn-sm btn-outline-secondary rounded-pill px-3">
                                                Detail
                                            </a>
                                        </div>
                                    </div>
                                @empty
                                    <div class="text-center py-5">
                                        <div class="d-inline-flex align-items-center justify-content-center rounded-circle bg-light text-muted mb-3" style="width: 60px; height: 60px;">
                                            <i class="bi bi-calendar-x fs-3"></i>
                                        </div>
                                        <h6 class="fw-bold text-dark mb-1">Belum Ada Aktivitas Perjalanan</h6>
                                        <p class="text-muted small mb-3">Mulai petualangan outdoor pertamamu bersama guide profesional Maro.</p>
                                        <a href="{{ route('checkout.index') }}" class="btn btn-sm btn-primary rounded-pill px-4">
                                            Jelajahi &amp; Pesan Trip
                                        </a>
                                    </div>
                                @endforelse

                            </div>
                        </div>

                    </div>
                </div>
            </div>
            
        </div>
    </div>
</div>
@endsection
