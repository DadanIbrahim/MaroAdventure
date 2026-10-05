@extends('layouts.admin')

@section('title', 'Participants - Admin')
@section('page_title', 'Participants / Users')

@section('content')
<div class="card border-0 shadow-sm">
    <div class="card-header bg-white py-3 d-flex flex-wrap justify-content-between align-items-center gap-3">
        <div class="input-group" style="max-width: 300px;">
            <span class="input-group-text bg-white border-end-0"><i class="bi bi-search text-muted"></i></span>
            <input type="text" class="form-control border-start-0 ps-0" placeholder="Search by name or email...">
        </div>
        <div class="d-flex gap-2">
            <button class="btn btn-outline-secondary btn-sm"><i class="bi bi-filter"></i> Filter</button>
            <button class="btn btn-outline-success btn-sm"><i class="bi bi-file-earmark-excel"></i> Export</button>
        </div>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Participant</th>
                        <th>Contact Info</th>
                        <th>Join Date</th>
                        <th>Total Trips</th>
                        <th>Points</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="avatar bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px;">AS</div>
                                <div>
                                    <div class="fw-bold">Ahmad Syauqi</div>
                                    <div class="small text-muted">Maro Member</div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="small"><i class="bi bi-envelope me-1"></i> ahmad@example.com</div>
                            <div class="small text-muted"><i class="bi bi-telephone me-1"></i> +62 812-3456-7890</div>
                        </td>
                        <td>12 Jan 2023</td>
                        <td>4 Trips</td>
                        <td><span class="fw-bold text-warning">1,250</span></td>
                        <td><span class="badge bg-success">Active</span></td>
                        <td>
                            <button class="btn btn-sm btn-light"><i class="bi bi-eye"></i></button>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="avatar bg-info text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px;">BW</div>
                                <div>
                                    <div class="fw-bold">Budi Waseso</div>
                                    <div class="small text-muted">Maro Member</div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="small"><i class="bi bi-envelope me-1"></i> budi.w@example.com</div>
                            <div class="small text-muted"><i class="bi bi-telephone me-1"></i> +62 813-5555-9999</div>
                        </td>
                        <td>05 Mar 2023</td>
                        <td>2 Trips</td>
                        <td><span class="fw-bold text-warning">500</span></td>
                        <td><span class="badge bg-success">Active</span></td>
                        <td>
                            <button class="btn btn-sm btn-light"><i class="bi bi-eye"></i></button>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="avatar bg-danger text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px;">CS</div>
                                <div>
                                    <div class="fw-bold">Citra Sari</div>
                                    <div class="small text-muted">Maro Member</div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="small"><i class="bi bi-envelope me-1"></i> citra.s@example.com</div>
                            <div class="small text-muted"><i class="bi bi-telephone me-1"></i> +62 856-1234-5678</div>
                        </td>
                        <td>20 Aug 2023</td>
                        <td>1 Trip</td>
                        <td><span class="fw-bold text-warning">200</span></td>
                        <td><span class="badge bg-danger">Banned</span></td>
                        <td>
                            <button class="btn btn-sm btn-light"><i class="bi bi-eye"></i></button>
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
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item"><a class="page-link" href="#">Next</a></li>
            </ul>
        </nav>
    </div>
</div>
@endsection
