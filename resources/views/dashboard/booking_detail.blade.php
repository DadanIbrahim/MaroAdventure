@extends('layouts.app')

@section('title', 'Booking Details - Maro Adventure')

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
                        <p class="text-muted small text-uppercase tracking-wide mb-1">BOOKING ID {{ $id }}</p>
                        <h2 class="fw-bold mb-1" style="color: var(--color-dark);">Gunung Prau</h2>
                        <p class="text-muted">12-13 Oct - 2 participants</p>
                    </div>

                    <!-- Top Details Row -->
                    <div class="row g-4 mb-5">
                        <!-- Image -->
                        <div class="col-md-7">
                            <div class="bg-secondary bg-opacity-25 rounded-3 d-flex align-items-center justify-content-center w-100 h-100" style="min-height: 250px;">
                                <div class="text-center text-muted">
                                    <i class="bi bi-image fs-1"></i>
                                    <div class="small mt-2 fw-medium">TRIP IMAGE</div>
                                </div>
                            </div>
                        </div>

                        <!-- Trip Summary -->
                        <div class="col-md-5">
                            <div class="card border-0 shadow-sm rounded-3 h-100 bg-white">
                                <div class="card-body p-4">
                                    <h5 class="fw-bold mb-3">Trip Summary</h5>
                                    
                                    <p class="text-muted small mb-2">Gunung Prau 2026 - Jawa Tengah</p>
                                    <p class="text-muted small mb-2">Date: 12-13 Oct 2026</p>
                                    <p class="text-muted small mb-3 border-bottom pb-3">Participants: 2 &times; Rp 650.000</p>
                                    
                                    <p class="fw-bold mb-4">Total: Rp 1.300.000</p>

                                    <div class="d-flex flex-wrap gap-2">
                                        <span class="badge border border-dark text-dark bg-transparent rounded-pill px-3 py-2 fw-medium">Booking Confirmed</span>
                                        <span class="badge border border-dark text-dark bg-transparent rounded-pill px-3 py-2 fw-medium">Payment Paid</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Participant Details Section -->
                    <div class="mb-4">
                        <h5 class="fw-bold mb-3" style="color: var(--color-dark);">Participant Details</h5>
                        <div class="card border-0 shadow-sm rounded-3 overflow-hidden mb-4">
                            <ul class="list-group list-group-flush border-0">
                                <li class="list-group-item px-4 py-3 text-muted border-0 border-bottom">
                                    <span class="fw-medium text-dark">Raka Pratama</span> &bull; Male &bull; +62 812 3456 7890
                                </li>
                                <li class="list-group-item px-4 py-3 text-muted border-0">
                                    <span class="fw-medium text-dark">Nadia Putri</span> &bull; Female &bull; +62 812 9001 0203
                                </li>
                            </ul>
                        </div>

                        <!-- Action Buttons -->
                        <div class="d-flex flex-wrap gap-3">
                            <button class="btn btn-dark px-4 py-2 fw-medium rounded-1">Download Invoice</button>
                            <button class="btn btn-outline-dark bg-white px-4 py-2 fw-medium rounded-1">Contact Operator</button>
                            <button class="btn btn-outline-dark bg-white px-4 py-2 fw-medium rounded-1">Cancel Booking</button>
                        </div>
                    </div>

                </div>
            </div>
            
        </div>
    </div>
</div>
@endsection
