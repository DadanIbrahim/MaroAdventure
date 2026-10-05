@extends('layouts.admin')

@section('title', 'Bookings - Admin')
@section('page_title', 'Transaction & Booking')

@section('content')
<div class="row g-4 mb-4">
    <div class="col-6 col-md-3">
        <div class="card border-0 shadow-sm border-start border-primary border-4">
            <div class="card-body">
                <div class="text-muted small fw-semibold">Total Bookings</div>
                <h3 class="mb-0 fw-bold">1,452</h3>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="card border-0 shadow-sm border-start border-warning border-4">
            <div class="card-body">
                <div class="text-muted small fw-semibold">Pending Payment</div>
                <h3 class="mb-0 fw-bold">18</h3>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="card border-0 shadow-sm border-start border-success border-4">
            <div class="card-body">
                <div class="text-muted small fw-semibold">Confirmed</div>
                <h3 class="mb-0 fw-bold">1,390</h3>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="card border-0 shadow-sm border-start border-danger border-4">
            <div class="card-body">
                <div class="text-muted small fw-semibold">Cancelled</div>
                <h3 class="mb-0 fw-bold">44</h3>
            </div>
        </div>
    </div>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-header bg-white py-3">
        <ul class="nav nav-tabs card-header-tabs" id="bookingTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="all-tab" data-bs-toggle="tab" data-bs-target="#all" type="button" role="tab">All Bookings</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="pending-tab" data-bs-toggle="tab" data-bs-target="#pending" type="button" role="tab">Pending <span class="badge bg-warning ms-1">18</span></button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="confirmed-tab" data-bs-toggle="tab" data-bs-target="#confirmed" type="button" role="tab">Confirmed</button>
            </li>
        </ul>
    </div>
    <div class="card-body p-0">
        <div class="tab-content" id="bookingTabsContent">
            <!-- All Bookings Tab -->
            <div class="tab-pane fade show active" id="all" role="tabpanel">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Booking ID</th>
                                <th>Date</th>
                                <th>Customer</th>
                                <th>Trip Package</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="fw-medium">#BK-1029</td>
                                <td><div class="small">15 Oct 2023<br><span class="text-muted">14:30 WIB</span></div></td>
                                <td>
                                    <div class="fw-bold">Ahmad Syauqi</div>
                                    <div class="small text-muted">ahmad@example.com</div>
                                </td>
                                <td>Mount Rinjani Summit<br><span class="badge bg-light text-dark">4 Pax</span></td>
                                <td>Rp 10.000.000</td>
                                <td><span class="badge bg-warning text-dark">Pending Payment</span></td>
                                <td>
                                    <button class="btn btn-sm btn-outline-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        Action
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0">
                                        <li><a class="dropdown-item" href="#"><i class="bi bi-eye me-2"></i> View Detail</a></li>
                                        <li><a class="dropdown-item" href="#"><i class="bi bi-check-circle me-2"></i> Confirm Manually</a></li>
                                        <li><hr class="dropdown-divider"></li>
                                        <li><a class="dropdown-item text-danger" href="#"><i class="bi bi-x-circle me-2"></i> Cancel</a></li>
                                    </ul>
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-medium">#BK-1028</td>
                                <td><div class="small">14 Oct 2023<br><span class="text-muted">09:15 WIB</span></div></td>
                                <td>
                                    <div class="fw-bold">Budi Waseso</div>
                                    <div class="small text-muted">budi.w@example.com</div>
                                </td>
                                <td>Bromo Sunrise Tour<br><span class="badge bg-light text-dark">2 Pax</span></td>
                                <td>Rp 900.000</td>
                                <td><span class="badge bg-success">Confirmed</span></td>
                                <td>
                                    <button class="btn btn-sm btn-outline-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        Action
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0">
                                        <li><a class="dropdown-item" href="#"><i class="bi bi-eye me-2"></i> View Detail</a></li>
                                        <li><a class="dropdown-item" href="#"><i class="bi bi-printer me-2"></i> Print Invoice</a></li>
                                    </ul>
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-medium">#BK-1027</td>
                                <td><div class="small">12 Oct 2023<br><span class="text-muted">16:45 WIB</span></div></td>
                                <td>
                                    <div class="fw-bold">Citra Sari</div>
                                    <div class="small text-muted">citra.s@example.com</div>
                                </td>
                                <td>Mount Semeru Trekking<br><span class="badge bg-light text-dark">1 Pax</span></td>
                                <td>Rp 1.800.000</td>
                                <td><span class="badge bg-danger">Cancelled</span></td>
                                <td>
                                    <button class="btn btn-sm btn-outline-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        Action
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0">
                                        <li><a class="dropdown-item" href="#"><i class="bi bi-eye me-2"></i> View Detail</a></li>
                                    </ul>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            
            <!-- Other tabs would go here (omitted for brevity) -->
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
