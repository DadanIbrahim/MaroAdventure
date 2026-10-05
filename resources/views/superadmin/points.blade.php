@extends('layouts.superadmin')
@section('title', 'Points - Superadmin')
@section('page_title', 'User Points & Gamification')

@section('content')
<div class="row g-4 mb-4">
    <div class="col-md-6">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body text-center py-5">
                <i class="bi bi-coin text-warning display-4 mb-3 d-block"></i>
                <h4 class="fw-bold">Points Settings</h4>
                <p class="text-muted small">Configure how points are distributed to users.</p>
                <hr>
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <span>Points per Rp 100.000 spent</span>
                    <input type="number" class="form-control form-control-sm w-25 text-center" value="10">
                </div>
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <span>Points for writing a review</span>
                    <input type="number" class="form-control form-control-sm w-25 text-center" value="50">
                </div>
                <button class="btn btn-primary btn-sm mt-3 w-100">Save Configuration</button>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-header bg-white py-3">
                <h6 class="mb-0 fw-bold">Top Point Earners</h6>
            </div>
            <div class="card-body p-0">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item d-flex justify-content-between align-items-center py-3">
                        <div class="d-flex align-items-center">
                            <div class="fs-4 text-warning me-3"><i class="bi bi-trophy-fill"></i></div>
                            <div>
                                <h6 class="mb-0 fw-bold">Ahmad Syauqi</h6>
                                <small class="text-muted">Master Hiker</small>
                            </div>
                        </div>
                        <span class="badge bg-primary rounded-pill fs-6">12,500 Pts</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center py-3">
                        <div class="d-flex align-items-center">
                            <div class="fs-4 text-secondary me-3"><i class="bi bi-trophy-fill"></i></div>
                            <div>
                                <h6 class="mb-0 fw-bold">Budi Waseso</h6>
                                <small class="text-muted">Advanced Hiker</small>
                            </div>
                        </div>
                        <span class="badge bg-primary rounded-pill fs-6">8,420 Pts</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center py-3">
                        <div class="d-flex align-items-center">
                            <div class="fs-4 text-warning" style="color: #cd7f32 !important;"><i class="bi bi-trophy-fill"></i></div>
                            <div class="ms-3">
                                <h6 class="mb-0 fw-bold">Citra Lestari</h6>
                                <small class="text-muted">Explorer</small>
                            </div>
                        </div>
                        <span class="badge bg-primary rounded-pill fs-6">5,100 Pts</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
