@extends('layouts.superadmin')
@section('title', 'Reports - Superadmin')
@section('page_title', 'Advanced Analytics & Reports')

@section('content')
<div class="row g-4 mb-4">
    <div class="col-12 col-lg-8">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                <h6 class="mb-0 fw-bold">Company Revenue (Superadmin View)</h6>
                <button class="btn btn-sm btn-outline-success"><i class="bi bi-file-earmark-spreadsheet me-1"></i> Download CSV</button>
            </div>
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-center bg-light rounded" style="height: 250px;">
                    <div class="text-center text-muted">
                        <i class="bi bi-graph-up fs-1 mb-2 d-block text-primary"></i>
                        [Detailed Revenue Chart Placeholder]<br>
                        Shows gross revenue, net profit, and taxes.
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-lg-4">
        <div class="card border-0 shadow-sm h-100 bg-primary text-white">
            <div class="card-body d-flex flex-column justify-content-center text-center">
                <i class="bi bi-cash-stack display-1 mb-3"></i>
                <h5>Total Net Profit</h5>
                <h1 class="fw-bold mb-4">Rp 4.2B</h1>
                <p class="small text-white-50">Year-to-date (2023)</p>
                <button class="btn btn-light mt-auto fw-bold text-primary">View Financial Statement</button>
            </div>
        </div>
    </div>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-header bg-white py-3">
        <h6 class="mb-0 fw-bold">Admin Activity Logs</h6>
    </div>
    <div class="card-body p-0">
        <ul class="list-group list-group-flush">
            <li class="list-group-item py-3">
                <div class="d-flex justify-content-between">
                    <div><span class="badge bg-secondary me-2">System</span> Admin "Admin1" approved booking #BK-99201</div>
                    <small class="text-muted">10 mins ago</small>
                </div>
            </li>
            <li class="list-group-item py-3">
                <div class="d-flex justify-content-between">
                    <div><span class="badge bg-secondary me-2">System</span> Content Admin updated "Hero Banner" section</div>
                    <small class="text-muted">1 hour ago</small>
                </div>
            </li>
            <li class="list-group-item py-3">
                <div class="d-flex justify-content-between">
                    <div><span class="badge bg-secondary me-2">System</span> Finance Admin confirmed payment for #TRX-88192</div>
                    <small class="text-muted">3 hours ago</small>
                </div>
            </li>
        </ul>
    </div>
</div>
@endsection
