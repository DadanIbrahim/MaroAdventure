@extends('layouts.admin')

@section('title', 'Schedule - Admin')
@section('page_title', 'Upcoming Trip Schedules')

@section('content')
<div class="row mb-4">
    <div class="col-12">
        <div class="card border-0 shadow-sm">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center">
                    <div class="input-group" style="max-width: 300px;">
                        <span class="input-group-text bg-white"><i class="bi bi-calendar3"></i></span>
                        <input type="month" class="form-control border-start-0" value="{{ date('Y-m') }}">
                    </div>
                    <select class="form-select ms-3" style="max-width: 200px;">
                        <option value="">All Destinations</option>
                        <option value="rinjani">Mount Rinjani</option>
                        <option value="bromo">Mount Bromo</option>
                        <option value="semeru">Mount Semeru</option>
                    </select>
                </div>
                <button class="btn btn-primary"><i class="bi bi-plus-lg me-1"></i> Add Schedule</button>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    <div class="col-12 col-md-4">
        <div class="card border-0 shadow-sm h-100 border-top border-primary border-4">
            <div class="card-body">
                <div class="d-flex justify-content-between mb-3">
                    <span class="badge bg-primary-subtle text-primary fw-semibold">Oct 15 - Oct 18</span>
                    <span class="badge bg-success">Confirmed</span>
                </div>
                <h5 class="fw-bold mb-1">Mount Rinjani Summit</h5>
                <p class="text-muted small mb-3">Guide: Mas Joko (Trekking Guide)</p>
                
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-secondary small">Participants</span>
                    <span class="fw-bold">12 / 15</span>
                </div>
                <div class="progress mb-3" style="height: 8px;">
                    <div class="progress-bar bg-primary" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                
                <div class="d-flex justify-content-between mt-4">
                    <button class="btn btn-sm btn-outline-secondary">Edit</button>
                    <button class="btn btn-sm btn-primary">View Manifest</button>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-12 col-md-4">
        <div class="card border-0 shadow-sm h-100 border-top border-warning border-4">
            <div class="card-body">
                <div class="d-flex justify-content-between mb-3">
                    <span class="badge bg-primary-subtle text-primary fw-semibold">Oct 20</span>
                    <span class="badge bg-warning text-dark">Almost Full</span>
                </div>
                <h5 class="fw-bold mb-1">Bromo Sunrise Tour</h5>
                <p class="text-muted small mb-3">Guide: Budi & Team</p>
                
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-secondary small">Participants</span>
                    <span class="fw-bold">18 / 20</span>
                </div>
                <div class="progress mb-3" style="height: 8px;">
                    <div class="progress-bar bg-warning" role="progressbar" style="width: 90%" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                
                <div class="d-flex justify-content-between mt-4">
                    <button class="btn btn-sm btn-outline-secondary">Edit</button>
                    <button class="btn btn-sm btn-primary">View Manifest</button>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12 col-md-4">
        <div class="card border-0 shadow-sm h-100 border-top border-info border-4">
            <div class="card-body">
                <div class="d-flex justify-content-between mb-3">
                    <span class="badge bg-primary-subtle text-primary fw-semibold">Oct 25 - Oct 27</span>
                    <span class="badge bg-info text-white">Open</span>
                </div>
                <h5 class="fw-bold mb-1">Mount Semeru Trekking</h5>
                <p class="text-muted small mb-3">Guide: TBA</p>
                
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-secondary small">Participants</span>
                    <span class="fw-bold">4 / 15</span>
                </div>
                <div class="progress mb-3" style="height: 8px;">
                    <div class="progress-bar bg-info" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                
                <div class="d-flex justify-content-between mt-4">
                    <button class="btn btn-sm btn-outline-secondary">Edit</button>
                    <button class="btn btn-sm btn-primary">View Manifest</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
