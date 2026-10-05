@extends('layouts.app')

@section('title', 'Booking Success - Maro Adventure')

@section('content')
<div class="bg-light d-flex align-items-center justify-content-center" style="min-height: 100vh; padding-top: 80px; padding-bottom: 80px;">
    <div class="container py-4">
        
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="card border-0 shadow-sm rounded-4 p-5 text-center bg-white">
                    
                    <!-- Success Icon -->
                    <div class="d-inline-flex align-items-center justify-content-center rounded-circle bg-secondary bg-opacity-10 mb-4" style="width: 80px; height: 80px;">
                        <i class="bi bi-check-lg text-secondary" style="font-size: 2.5rem; stroke-width: 2px;"></i>
                    </div>

                    <!-- Texts -->
                    <h3 class="fw-bold mb-2">Booking berhasil dibuat</h3>
                    <p class="text-muted mb-4">ID MARO-2026-10-123</p>

                    <!-- Status Badge -->
                    <div class="mb-5">
                        <span class="badge border border-secondary text-secondary rounded-pill px-4 py-2 fw-medium bg-transparent" style="font-size: 0.9rem;">
                            Status: Menunggu Pembayaran
                        </span>
                    </div>

                    <!-- Actions -->
                    <div class="d-flex flex-column flex-sm-row justify-content-center gap-3">
                        <a href="{{ route('dashboard.bookings.show', 'MARO-2026-10-123') }}" class="btn btn-dark px-4 py-2 fw-bold rounded-1">View Booking</a>
                        <a href="{{ url('/') }}" class="btn btn-outline-dark bg-white px-4 py-2 fw-bold rounded-1">Back to Home</a>
                    </div>

                </div>
            </div>
        </div>

    </div>
</div>
@endsection

