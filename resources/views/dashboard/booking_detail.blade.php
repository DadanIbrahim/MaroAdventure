@extends('layouts.app')

@section('title', 'Detail Booking ' . $booking->booking_code . ' - Maro Adventure')

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
                            <p class="text-muted small text-uppercase tracking-wide mb-1 font-monospace">
                                BOOKING ID: <strong class="text-primary">{{ $booking->booking_code }}</strong>
                            </p>
                            <h2 class="fw-bold mb-1" style="color: var(--color-dark);">
                                {{ $booking->trip->name ?? 'Trip Petualangan' }}
                            </h2>
                            <p class="text-muted mb-0">
                                <i class="bi bi-calendar3 me-1"></i> {{ date('d M Y', strtotime($booking->booking_date)) }} 
                                &bull; <i class="bi bi-people me-1"></i> {{ $booking->participants }} peserta
                            </p>
                        </div>

                        <a href="{{ route('dashboard.bookings') }}" class="btn btn-outline-secondary btn-sm rounded-pill px-3">
                            <i class="bi bi-arrow-left me-1"></i> Kembali ke My Booking
                        </a>
                    </div>

                    <!-- Top Details Row -->
                    <div class="row g-4 mb-4">
                        <!-- Image -->
                        <div class="col-md-7">
                            <div class="rounded-4 overflow-hidden shadow-sm h-100 bg-secondary bg-opacity-10 position-relative" style="min-height: 250px;">
                                @if($booking->trip && $booking->trip->image)
                                    <img 
                                        src="{{ asset('storage/' . $booking->trip->image) }}" 
                                        alt="{{ $booking->trip->name }}" 
                                        class="w-100 h-100 object-fit-cover position-absolute top-0 start-0"
                                    >
                                @else
                                    <img 
                                        src="{{ asset('assets/images/destinasi/burangrang.jpg') }}" 
                                        alt="Gunung Maro" 
                                        class="w-100 h-100 object-fit-cover position-absolute top-0 start-0"
                                        onerror="this.src='https://images.unsplash.com/photo-1464822759023-fed622ff2c3b?auto=format&fit=crop&w=800&q=80'"
                                    >
                                @endif
                            </div>
                        </div>

                        <!-- Trip Summary -->
                        <div class="col-md-5">
                            <div class="card border-0 shadow-sm rounded-4 h-100 bg-white">
                                <div class="card-body p-4 d-flex flex-column justify-content-between">
                                    <div>
                                        <h5 class="fw-bold mb-3">Ringkasan Pesanan</h5>
                                        
                                        @if($booking->trip && $booking->trip->mountain)
                                            <p class="text-muted small mb-2">
                                                <i class="bi bi-geo-alt text-primary me-1"></i>
                                                {{ $booking->trip->mountain->name }} &bull; {{ $booking->trip->mountain->elevation ?? '2000' }} MDPL
                                            </p>
                                        @endif

                                        <p class="text-muted small mb-2">
                                            <i class="bi bi-clock me-1"></i> Durasi: {{ $booking->trip->duration ?? '2 Hari 1 Malam' }}
                                        </p>
                                        <p class="text-muted small mb-2">
                                            <i class="bi bi-calendar-event me-1"></i> Tanggal: {{ date('d M Y', strtotime($booking->booking_date)) }}
                                        </p>
                                        <p class="text-muted small mb-3 border-bottom pb-3">
                                            <i class="bi bi-people me-1"></i> Peserta: {{ $booking->participants }} &times; {{ $booking->trip ? $booking->trip->formatted_price : '-' }}
                                        </p>
                                        
                                        <div class="mb-4">
                                            <span class="text-muted small d-block">Total Pembayaran:</span>
                                            <h4 class="fw-bold text-primary mb-0">{{ $booking->formatted_price }}</h4>
                                        </div>
                                    </div>

                                    <div class="d-flex flex-wrap gap-2">
                                        <!-- Booking Status Badge -->
                                        @if($booking->status === 'confirmed')
                                            <span class="badge bg-primary bg-opacity-10 text-primary border border-primary-subtle rounded-pill px-3 py-2 fw-medium">
                                                <i class="bi bi-check-circle me-1"></i> Booking Confirmed
                                            </span>
                                        @elseif($booking->status === 'completed')
                                            <span class="badge bg-success bg-opacity-10 text-success border border-success-subtle rounded-pill px-3 py-2 fw-medium">
                                                <i class="bi bi-trophy me-1"></i> Trip Completed
                                            </span>
                                        @elseif($booking->status === 'cancelled')
                                            <span class="badge bg-danger bg-opacity-10 text-danger border border-danger-subtle rounded-pill px-3 py-2 fw-medium">
                                                <i class="bi bi-x-circle me-1"></i> Canceled
                                            </span>
                                        @else
                                            <span class="badge bg-secondary bg-opacity-10 text-secondary border border-secondary-subtle rounded-pill px-3 py-2 fw-medium">
                                                <i class="bi bi-hourglass-split me-1"></i> Menunggu Konfirmasi
                                            </span>
                                        @endif

                                        <!-- Payment Status Badge -->
                                        @if($booking->payment_status === 'paid')
                                            <span class="badge bg-success bg-opacity-10 text-success border border-success-subtle rounded-pill px-3 py-2 fw-medium">
                                                <i class="bi bi-patch-check-fill me-1"></i> Lunas (Paid)
                                            </span>
                                        @else
                                            <span class="badge bg-warning bg-opacity-10 text-warning-emphasis border border-warning-subtle rounded-pill px-3 py-2 fw-medium">
                                                <i class="bi bi-clock-history me-1"></i> Belum Lunas
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Participant & Emergency Details Section -->
                    <div class="mb-4">
                        <h5 class="fw-bold mb-3" style="color: var(--color-dark);">Data Pemesan & Catatan Khusus</h5>
                        
                        <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-4">
                            <ul class="list-group list-group-flush border-0">
                                <li class="list-group-item px-4 py-3 text-muted border-0 border-bottom">
                                    <div class="row align-items-center">
                                        <div class="col-sm-4 fw-medium text-dark">Ketua Rombongan / Pemesan</div>
                                        <div class="col-sm-8 text-dark fw-semibold">
                                            {{ $booking->customer_name }}
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item px-4 py-3 text-muted border-0 border-bottom">
                                    <div class="row align-items-center">
                                        <div class="col-sm-4 fw-medium text-dark">Nomor WhatsApp / HP</div>
                                        <div class="col-sm-8 text-dark">
                                            {{ $booking->customer_phone ?? '-' }}
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item px-4 py-3 text-muted border-0 border-bottom">
                                    <div class="row align-items-center">
                                        <div class="col-sm-4 fw-medium text-dark">Email Akun</div>
                                        <div class="col-sm-8 text-dark">
                                            {{ $booking->user->email ?? auth()->user()->email ?? '-' }}
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item px-4 py-3 text-muted border-0">
                                    <div class="row align-items-start">
                                        <div class="col-sm-4 fw-medium text-dark">Kontak Darurat & Catatan</div>
                                        <div class="col-sm-8 text-dark">
                                            {{ $booking->notes ?? 'Tidak ada catatan medis atau permintaan khusus.' }}
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>

                        <!-- Action Buttons -->
                        <div class="d-flex flex-wrap gap-3">
                            @if($booking->payment_status !== 'paid' && $booking->status !== 'cancelled')
                                <a href="{{ route('checkout.payment', ['booking_code' => $booking->booking_code]) }}" class="btn btn-primary px-4 py-2 fw-semibold rounded-2 shadow-sm">
                                    <i class="bi bi-credit-card me-1"></i> Bayar Sekarang
                                </a>
                            @endif

                            <a href="https://wa.me/6285894535172?text=Halo%20Maro%20Adventure%2C%20saya%20ingin%20menanyakan%20detail%20pemesanan%20ID%3A%20{{ $booking->booking_code }}." target="_blank" class="btn btn-outline-success px-4 py-2 fw-semibold rounded-2">
                                <i class="bi bi-whatsapp me-1"></i> Hubungi Tim Pemandu / CS
                            </a>

                            <a href="{{ route('dashboard.bookings') }}" class="btn btn-outline-secondary px-4 py-2 fw-semibold rounded-2">
                                Kembali ke Daftar
                            </a>
                        </div>
                    </div>

                </div>
            </div>
            
        </div>
    </div>
</div>
@endsection
