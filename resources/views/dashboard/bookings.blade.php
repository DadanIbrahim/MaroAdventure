@extends('layouts.app')

@section('title', 'My Booking - Maro Adventure')

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
                    <div class="mb-4">
                        <h2 class="fw-bold mb-1" style="color: var(--color-dark);">My Booking</h2>
                        <p class="text-muted">Daftar perjalanan yang pernah dan sedang diikuti.</p>
                    </div>

                    <!-- Search and Filters -->
                    <div class="d-flex flex-column flex-md-row gap-3 mb-4">
                        <div class="flex-grow-1 position-relative">
                            <i class="bi bi-search position-absolute top-50 start-0 translate-middle-y ms-3 text-muted"></i>
                            <input type="text" class="form-control rounded-pill ps-5 py-2 border-0 shadow-sm" placeholder="Search booking">
                        </div>
                        <div class="d-flex gap-2 overflow-auto pb-2 pb-md-0 hide-scroll">
                            <button class="btn btn-outline-secondary rounded-pill px-4 text-nowrap">Upcoming</button>
                            <button class="btn btn-outline-secondary rounded-pill px-4 text-nowrap">Completed</button>
                            <button class="btn btn-outline-secondary rounded-pill px-4 text-nowrap">Canceled</button>
                        </div>
                    </div>

                    <!-- Bookings List -->
                    <div class="d-flex flex-column gap-3">
                        
                        <!-- Booking 1 -->
                        <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                            <div class="card-body p-0 d-flex flex-column flex-md-row">
                                <div class="bg-light d-flex align-items-center justify-content-center p-4 text-center" style="min-width: 140px; border-right: 1px solid #f3f4f6;">
                                    <div>
                                        <i class="bi bi-image text-muted fs-3"></i>
                                        <div class="small text-muted mt-2 fw-medium text-uppercase tracking-wide">TRIP</div>
                                    </div>
                                </div>
                                <div class="p-4 flex-grow-1 d-flex flex-column justify-content-center">
                                    <h5 class="fw-bold mb-1">Gunung Prau</h5>
                                    <p class="text-muted small mb-2"><i class="bi bi-calendar3 me-1"></i> 12-13 Oct 2026 &bull; <i class="bi bi-people me-1"></i> 2 participant</p>
                                    <p class="fw-bold mb-0">Rp 1.300.000</p>
                                </div>
                                <div class="p-4 d-flex flex-column align-items-end justify-content-center border-start-md border-light">
                                    <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-3 py-2 mb-3">Confirmed</span>
                                    <a href="{{ route('dashboard.bookings.show', 'MARO-2026-10-123') }}" class="text-dark fw-bold text-decoration-none small">View details <i class="bi bi-arrow-right ms-1"></i></a>
                                </div>
                            </div>
                        </div>

                        <!-- Booking 2 -->
                        <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                            <div class="card-body p-0 d-flex flex-column flex-md-row">
                                <div class="bg-light d-flex align-items-center justify-content-center p-4 text-center" style="min-width: 140px; border-right: 1px solid #f3f4f6;">
                                    <div>
                                        <i class="bi bi-image text-muted fs-3"></i>
                                        <div class="small text-muted mt-2 fw-medium text-uppercase tracking-wide">TRIP</div>
                                    </div>
                                </div>
                                <div class="p-4 flex-grow-1 d-flex flex-column justify-content-center">
                                    <h5 class="fw-bold mb-1">Gunung Gede</h5>
                                    <p class="text-muted small mb-2"><i class="bi bi-calendar3 me-1"></i> 20-21 Jul 2026 &bull; <i class="bi bi-people me-1"></i> 3 participant</p>
                                    <p class="fw-bold mb-0">Rp 725.000</p>
                                </div>
                                <div class="p-4 d-flex flex-column align-items-end justify-content-center border-start-md border-light">
                                    <span class="badge bg-secondary bg-opacity-10 text-secondary rounded-pill px-3 py-2 mb-3">Completed</span>
                                    <a href="{{ route('dashboard.bookings.show', 'MARO-2026-10-123') }}" class="text-dark fw-bold text-decoration-none small">View details <i class="bi bi-arrow-right ms-1"></i></a>
                                </div>
                            </div>
                        </div>

                        <!-- Booking 3 -->
                        <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                            <div class="card-body p-0 d-flex flex-column flex-md-row">
                                <div class="bg-light d-flex align-items-center justify-content-center p-4 text-center" style="min-width: 140px; border-right: 1px solid #f3f4f6;">
                                    <div>
                                        <i class="bi bi-image text-muted fs-3"></i>
                                        <div class="small text-muted mt-2 fw-medium text-uppercase tracking-wide">TRIP</div>
                                    </div>
                                </div>
                                <div class="p-4 flex-grow-1 d-flex flex-column justify-content-center">
                                    <h5 class="fw-bold mb-1">Papandayan</h5>
                                    <p class="text-muted small mb-2"><i class="bi bi-calendar3 me-1"></i> 18 May 2026 &bull; <i class="bi bi-people me-1"></i> 2 participant</p>
                                    <p class="fw-bold mb-0">Rp 450.000</p>
                                </div>
                                <div class="p-4 d-flex flex-column align-items-end justify-content-center border-start-md border-light">
                                    <span class="badge bg-danger bg-opacity-10 text-danger rounded-pill px-3 py-2 mb-3">Canceled</span>
                                    <a href="{{ route('dashboard.bookings.show', 'MARO-2026-10-123') }}" class="text-dark fw-bold text-decoration-none small">View details <i class="bi bi-arrow-right ms-1"></i></a>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
            
        </div>
    </div>
</div>

<style>
    /* Utility to hide scrollbar for filter pills on mobile */
    .hide-scroll::-webkit-scrollbar {
        display: none;
    }
    .hide-scroll {
        -ms-overflow-style: none;
        scrollbar-width: none;
    }
    
    @media (min-width: 768px) {
        .border-start-md {
            border-left: 1px solid #f3f4f6;
        }
    }
</style>
@endsection
