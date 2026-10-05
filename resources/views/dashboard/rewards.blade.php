@extends('layouts.app')

@section('title', 'My Rewards - Maro Adventure')

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
                    <div class="mb-4 d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
                        <div>
                            <h2 class="fw-bold mb-1" style="color: var(--color-dark);">My Rewards</h2>
                            <p class="text-muted mb-0">Daftar voucher dan hadiah yang telah Anda tukarkan.</p>
                        </div>
                        <a href="{{ route('dashboard.points') }}#rewards" class="btn btn-outline-primary rounded-pill px-4">Tukar Poin Lainnya</a>
                    </div>

                    <!-- Filter Tabs -->
                    <ul class="nav nav-pills mb-4 gap-2" id="rewardTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active rounded-pill px-4 py-2" id="active-tab" data-bs-toggle="pill" data-bs-target="#active" type="button" role="tab">Active</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link rounded-pill px-4 py-2 text-dark bg-white border" id="history-tab" data-bs-toggle="pill" data-bs-target="#history" type="button" role="tab">History / Used</button>
                        </li>
                    </ul>

                    <!-- Tabs Content -->
                    <div class="tab-content" id="rewardTabsContent">
                        
                        <!-- ACTIVE REWARDS TAB -->
                        <div class="tab-pane fade show active" id="active" role="tabpanel" tabindex="0">
                            <div class="row g-4">
                                
                                <!-- Voucher Item 1 -->
                                <div class="col-md-6">
                                    <div class="card border-0 shadow-sm rounded-4 h-100 overflow-hidden">
                                        <div class="card-body p-0 d-flex">
                                            <div class="bg-primary bg-opacity-10 text-primary d-flex flex-column align-items-center justify-content-center p-4 text-center" style="min-width: 120px; border-right: 2px dashed #cfe2ff;">
                                                <i class="bi bi-ticket-perforated fs-1 mb-2"></i>
                                                <span class="small fw-bold">VOUCHER</span>
                                            </div>
                                            <div class="p-4 flex-grow-1 d-flex flex-column justify-content-center">
                                                <h6 class="fw-bold mb-1">Diskon Trip Rp 50.000</h6>
                                                <p class="text-muted small mb-3">Berlaku untuk semua Open Trip.</p>
                                                
                                                <div class="d-flex justify-content-between align-items-center mt-auto">
                                                    <div class="small">
                                                        <span class="d-block text-muted" style="font-size: 0.75rem;">Berlaku hingga</span>
                                                        <span class="fw-semibold">31 Des 2026</span>
                                                    </div>
                                                    <button class="btn btn-sm btn-dark px-3 rounded-1">Gunakan</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Voucher Item 2 -->
                                <div class="col-md-6">
                                    <div class="card border-0 shadow-sm rounded-4 h-100 overflow-hidden">
                                        <div class="card-body p-0 d-flex">
                                            <div class="bg-success bg-opacity-10 text-success d-flex flex-column align-items-center justify-content-center p-4 text-center" style="min-width: 120px; border-right: 2px dashed #d1e7dd;">
                                                <i class="bi bi-house-door fs-1 mb-2"></i>
                                                <span class="small fw-bold">LAYANAN</span>
                                            </div>
                                            <div class="p-4 flex-grow-1 d-flex flex-column justify-content-center">
                                                <h6 class="fw-bold mb-1">Gratis Sewa Tenda</h6>
                                                <p class="text-muted small mb-3">Tenda kapasitas 2 orang (1 Malam).</p>
                                                
                                                <div class="d-flex justify-content-between align-items-center mt-auto">
                                                    <div class="small">
                                                        <span class="d-block text-muted" style="font-size: 0.75rem;">Berlaku hingga</span>
                                                        <span class="fw-semibold">15 Nov 2026</span>
                                                    </div>
                                                    <button class="btn btn-sm btn-dark px-3 rounded-1">Gunakan</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <!-- HISTORY / USED TAB -->
                        <div class="tab-pane fade" id="history" role="tabpanel" tabindex="0">
                            <div class="row g-4 opacity-75">
                                
                                <!-- Used Item -->
                                <div class="col-md-6">
                                    <div class="card border-0 shadow-sm rounded-4 h-100 overflow-hidden bg-light">
                                        <div class="card-body p-0 d-flex">
                                            <div class="bg-secondary bg-opacity-10 text-secondary d-flex flex-column align-items-center justify-content-center p-4 text-center" style="min-width: 120px; border-right: 2px dashed #e2e3e5;">
                                                <i class="bi bi-cup-hot fs-1 mb-2"></i>
                                                <span class="small fw-bold">USED</span>
                                            </div>
                                            <div class="p-4 flex-grow-1 d-flex flex-column justify-content-center">
                                                <h6 class="fw-bold mb-1 text-muted">Gratis Coffee di Basecamp</h6>
                                                <p class="text-muted small mb-3">Telah digunakan pada 12 Okt 2026.</p>
                                                
                                                <div class="d-flex justify-content-between align-items-center mt-auto">
                                                    <span class="badge bg-secondary">Telah Terpakai</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Physical Item -->
                                <div class="col-md-6">
                                    <div class="card border-0 shadow-sm rounded-4 h-100 overflow-hidden bg-light">
                                        <div class="card-body p-0 d-flex">
                                            <div class="bg-secondary bg-opacity-10 text-secondary d-flex flex-column align-items-center justify-content-center p-4 text-center" style="min-width: 120px; border-right: 2px dashed #e2e3e5;">
                                                <i class="bi bi-bag-check fs-1 mb-2"></i>
                                                <span class="small fw-bold">CLAIMED</span>
                                            </div>
                                            <div class="p-4 flex-grow-1 d-flex flex-column justify-content-center">
                                                <h6 class="fw-bold mb-1 text-muted">Merchandise Kaos Maro</h6>
                                                <p class="text-muted small mb-3">Diambil di basecamp saat trip G. Prau.</p>
                                                
                                                <div class="d-flex justify-content-between align-items-center mt-auto">
                                                    <span class="badge bg-success bg-opacity-10 text-success border border-success">Selesai Diambil</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
    .nav-pills .nav-link.active {
        background-color: var(--color-primary, #0EA5E9);
        color: white !important;
    }
</style>
@endsection
