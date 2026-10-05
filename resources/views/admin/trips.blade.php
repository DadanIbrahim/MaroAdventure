@extends('layouts.admin')

@section('title', 'Manage Trips - Admin')
@section('page_title', 'Trips Management')

@section('content')
<div class="card border-0 shadow-sm">
    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
        <h6 class="mb-0 fw-bold">All Trip Packages</h6>
        <button class="btn btn-primary btn-sm"><i class="bi bi-plus-lg me-1"></i> Add New Trip</button>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Trip Name</th>
                        <th>Location</th>
                        <th>Duration</th>
                        <th>Price</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <img src="https://placehold.co/50x50" class="rounded me-3" alt="Rinjani">
                                <div>
                                    <div class="fw-bold">Mount Rinjani Summit</div>
                                    <div class="small text-muted">Trekking & Camping</div>
                                </div>
                            </div>
                        </td>
                        <td>Lombok, NTB</td>
                        <td>4 Days, 3 Nights</td>
                        <td>Rp 2.500.000</td>
                        <td><span class="badge bg-success">Active</span></td>
                        <td>
                            <button class="btn btn-sm btn-light me-1"><i class="bi bi-pencil"></i></button>
                            <button class="btn btn-sm btn-light text-danger"><i class="bi bi-trash"></i></button>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <img src="https://placehold.co/50x50" class="rounded me-3" alt="Bromo">
                                <div>
                                    <div class="fw-bold">Bromo Sunrise Tour</div>
                                    <div class="small text-muted">Sightseeing & Jeep</div>
                                </div>
                            </div>
                        </td>
                        <td>Malang, Jatim</td>
                        <td>1 Day</td>
                        <td>Rp 450.000</td>
                        <td><span class="badge bg-success">Active</span></td>
                        <td>
                            <button class="btn btn-sm btn-light me-1"><i class="bi bi-pencil"></i></button>
                            <button class="btn btn-sm btn-light text-danger"><i class="bi bi-trash"></i></button>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <img src="https://placehold.co/50x50" class="rounded me-3" alt="Semeru">
                                <div>
                                    <div class="fw-bold">Mount Semeru Trekking</div>
                                    <div class="small text-muted">Advanced Trekking</div>
                                </div>
                            </div>
                        </td>
                        <td>Lumajang, Jatim</td>
                        <td>3 Days, 2 Nights</td>
                        <td>Rp 1.800.000</td>
                        <td><span class="badge bg-warning text-dark">Draft</span></td>
                        <td>
                            <button class="btn btn-sm btn-light me-1"><i class="bi bi-pencil"></i></button>
                            <button class="btn btn-sm btn-light text-danger"><i class="bi bi-trash"></i></button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer bg-white py-3">
        <nav aria-label="Page navigation">
            <ul class="pagination mb-0 justify-content-end">
                <li class="page-item disabled"><a class="page-link" href="#">Previous</a></li>
                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">Next</a></li>
            </ul>
        </nav>
    </div>
</div>
@endsection
