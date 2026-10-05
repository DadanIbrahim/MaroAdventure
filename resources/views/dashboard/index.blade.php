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
                    <div class="mb-4">
                        <h2 class="fw-bold mb-1" style="color: var(--color-dark);">Welcome back, {{ explode(' ', Auth::user()->name)[0] }}</h2>
                        <p class="text-muted">Berikut ringkasan aktivitas terbaru di MARO Adventure.</p>
                    </div>

                    <!-- Stats Cards -->
                    <div class="row g-3 mb-5">
                        <div class="col-md-4">
                            <div class="card border-0 shadow-sm rounded-4 h-100">
                                <div class="card-body p-4">
                                    <p class="text-muted small fw-medium mb-2">Trips</p>
                                    <h3 class="fw-bold mb-3">3</h3>
                                    <p class="text-muted small mb-0"><i class="bi bi-clock-history me-1"></i> Updated today</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card border-0 shadow-sm rounded-4 h-100">
                                <div class="card-body p-4">
                                    <p class="text-muted small fw-medium mb-2">Reviews</p>
                                    <h3 class="fw-bold mb-3">4</h3>
                                    <p class="text-muted small mb-0"><i class="bi bi-clock-history me-1"></i> Updated today</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card border-0 shadow-sm rounded-4 h-100">
                                <div class="card-body p-4">
                                    <p class="text-muted small fw-medium mb-2">Points</p>
                                    <h3 class="fw-bold mb-3" style="color: var(--color-primary);">2.450</h3>
                                    <p class="text-muted small mb-0"><i class="bi bi-clock-history me-1"></i> Updated today</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Recent Activity Section -->
                    <div>
                        <h5 class="fw-bold mb-4" style="color: var(--color-dark);">Recent & Upcoming Activity</h5>
                        
                        <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                            <div class="list-group list-group-flush border-0">
                                
                                <!-- Item 1 -->
                                <div class="list-group-item d-flex align-items-center justify-content-between px-4 py-3 border-0 border-bottom">
                                    <div class="d-flex align-items-center">
                                        <div class="bg-light rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px;">
                                            <i class="bi bi-calendar-event text-primary"></i>
                                        </div>
                                        <div>
                                            <p class="mb-0 fw-medium">Open Trip Gunung Prau dijadwalkan 12-13 Oct</p>
                                        </div>
                                    </div>
                                    <span class="text-muted small">Hari ini</span>
                                </div>

                                <!-- Item 2 -->
                                <div class="list-group-item d-flex align-items-center justify-content-between px-4 py-3 border-0 border-bottom">
                                    <div class="d-flex align-items-center">
                                        <div class="bg-light rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px;">
                                            <i class="bi bi-pencil-square text-success"></i>
                                        </div>
                                        <div>
                                            <p class="mb-0 fw-medium">Review Gunung Gede berhasil dipublikasikan</p>
                                        </div>
                                    </div>
                                    <span class="text-muted small">2 hari lalu</span>
                                </div>

                                <!-- Item 3 -->
                                <div class="list-group-item d-flex align-items-center justify-content-between px-4 py-3 border-0 border-bottom">
                                    <div class="d-flex align-items-center">
                                        <div class="bg-light rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px;">
                                            <i class="bi bi-star-fill text-warning"></i>
                                        </div>
                                        <div>
                                            <p class="mb-0 fw-medium">+500 points dari Completed Open Trip</p>
                                        </div>
                                    </div>
                                    <span class="text-muted small">3 hari lalu</span>
                                </div>

                                <!-- Item 4 -->
                                <div class="list-group-item d-flex align-items-center justify-content-between px-4 py-3 border-0">
                                    <div class="d-flex align-items-center">
                                        <div class="bg-light rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px;">
                                            <i class="bi bi-ticket-perforated text-info"></i>
                                        </div>
                                        <div>
                                            <p class="mb-0 fw-medium">Reward Coffee Voucher siap digunakan</p>
                                        </div>
                                    </div>
                                    <span class="text-muted small">4 hari lalu</span>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
            
        </div>
    </div>
</div>
@endsection
