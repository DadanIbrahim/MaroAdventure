@extends('layouts.superadmin')
@section('title', 'Mountains - Superadmin')
@section('page_title', 'Mountain Database')

@section('content')
<div class="row g-4">
    <div class="col-md-4">
        <div class="card border-0 shadow-sm h-100">
            <img src="https://placehold.co/400x200" class="card-img-top" alt="Semeru">
            <div class="card-body">
                <h5 class="card-title fw-bold">Gunung Semeru</h5>
                <p class="card-text text-muted small"><i class="bi bi-geo-alt"></i> Jawa Timur, Indonesia<br><i class="bi bi-arrow-up-circle"></i> 3,676 mdpl</p>
                <span class="badge bg-success mb-3">Active Status</span>
                <div class="d-flex justify-content-between">
                    <button class="btn btn-outline-primary btn-sm">Edit Data</button>
                    <button class="btn btn-outline-secondary btn-sm">View Routes</button>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 shadow-sm h-100">
            <img src="https://placehold.co/400x200" class="card-img-top" alt="Rinjani">
            <div class="card-body">
                <h5 class="card-title fw-bold">Gunung Rinjani</h5>
                <p class="card-text text-muted small"><i class="bi bi-geo-alt"></i> Nusa Tenggara Barat<br><i class="bi bi-arrow-up-circle"></i> 3,726 mdpl</p>
                <span class="badge bg-success mb-3">Active Status</span>
                <div class="d-flex justify-content-between">
                    <button class="btn btn-outline-primary btn-sm">Edit Data</button>
                    <button class="btn btn-outline-secondary btn-sm">View Routes</button>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 shadow-sm h-100 border-dashed bg-light d-flex align-items-center justify-content-center text-center" style="min-height: 350px; cursor: pointer;">
            <div class="p-4">
                <i class="bi bi-plus-circle text-primary mb-2" style="font-size: 3rem;"></i>
                <h5 class="fw-bold mt-2">Add New Mountain</h5>
                <p class="text-muted small">Register a new mountain destination to the system.</p>
            </div>
        </div>
    </div>
</div>
@endsection
