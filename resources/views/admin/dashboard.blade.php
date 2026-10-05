@extends('layouts.admin')

@section('title', 'Admin Dashboard - Maro Adventure')
@section('page_title', 'Overview Dashboard')

@section('content')
<div class="row g-4 mb-4">
    <div class="col-12 col-md-6 col-lg-3">
        <div class="card h-100 border-0 shadow-sm">
            <div class="card-body d-flex align-items-center">
                <div class="bg-primary bg-opacity-10 text-primary p-3 rounded-3 me-3">
                    <i class="bi bi-wallet2 fs-3"></i>
                </div>
                <div>
                    <h6 class="text-muted mb-1">Total Revenue</h6>
                    <h3 class="mb-0 fw-bold">Rp 125M</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-6 col-lg-3">
        <div class="card h-100 border-0 shadow-sm">
            <div class="card-body d-flex align-items-center">
                <div class="bg-success bg-opacity-10 text-success p-3 rounded-3 me-3">
                    <i class="bi bi-check-circle fs-3"></i>
                </div>
                <div>
                    <h6 class="text-muted mb-1">Completed Trips</h6>
                    <h3 class="mb-0 fw-bold">42</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-6 col-lg-3">
        <div class="card h-100 border-0 shadow-sm">
            <div class="card-body d-flex align-items-center">
                <div class="bg-info bg-opacity-10 text-info p-3 rounded-3 me-3">
                    <i class="bi bi-people fs-3"></i>
                </div>
                <div>
                    <h6 class="text-muted mb-1">Active Participants</h6>
                    <h3 class="mb-0 fw-bold">1,204</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-6 col-lg-3">
        <div class="card h-100 border-0 shadow-sm">
            <div class="card-body d-flex align-items-center">
                <div class="bg-warning bg-opacity-10 text-warning p-3 rounded-3 me-3">
                    <i class="bi bi-hourglass-split fs-3"></i>
                </div>
                <div>
                    <h6 class="text-muted mb-1">Pending Bookings</h6>
                    <h3 class="mb-0 fw-bold">18</h3>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    <div class="col-12 col-xl-8">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                <h6 class="mb-0 fw-bold">Recent Bookings</h6>
                <a href="{{ route('admin.booking') }}" class="btn btn-sm btn-outline-primary">View All</a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Booking ID</th>
                                <th>Participant</th>
                                <th>Trip Package</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="fw-medium">#BK-1029</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar bg-secondary text-white rounded-circle d-flex align-items-center justify-content-center me-2" style="width: 32px; height: 32px; font-size: 14px;">AS</div>
                                        <span>Ahmad Syauqi</span>
                                    </div>
                                </td>
                                <td>Mount Rinjani Summit (4D3N)</td>
                                <td><span class="badge bg-warning text-dark">Pending Payment</span></td>
                                <td><button class="btn btn-sm btn-light"><i class="bi bi-eye"></i></button></td>
                            </tr>
                            <tr>
                                <td class="fw-medium">#BK-1028</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar bg-secondary text-white rounded-circle d-flex align-items-center justify-content-center me-2" style="width: 32px; height: 32px; font-size: 14px;">BW</div>
                                        <span>Budi Waseso</span>
                                    </div>
                                </td>
                                <td>Bromo Sunrise Tour (1D)</td>
                                <td><span class="badge bg-success">Confirmed</span></td>
                                <td><button class="btn btn-sm btn-light"><i class="bi bi-eye"></i></button></td>
                            </tr>
                            <tr>
                                <td class="fw-medium">#BK-1027</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar bg-secondary text-white rounded-circle d-flex align-items-center justify-content-center me-2" style="width: 32px; height: 32px; font-size: 14px;">CS</div>
                                        <span>Citra Sari</span>
                                    </div>
                                </td>
                                <td>Mount Semeru Trekking (3D2N)</td>
                                <td><span class="badge bg-success">Confirmed</span></td>
                                <td><button class="btn btn-sm btn-light"><i class="bi bi-eye"></i></button></td>
                            </tr>
                            <tr>
                                <td class="fw-medium">#BK-1026</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar bg-secondary text-white rounded-circle d-flex align-items-center justify-content-center me-2" style="width: 32px; height: 32px; font-size: 14px;">DI</div>
                                        <span>Deni Irawan</span>
                                    </div>
                                </td>
                                <td>Ijen Crater Blue Fire (2D1N)</td>
                                <td><span class="badge bg-danger">Cancelled</span></td>
                                <td><button class="btn btn-sm btn-light"><i class="bi bi-eye"></i></button></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-xl-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-header bg-white py-3">
                <h6 class="mb-0 fw-bold">Popular Trips</h6>
            </div>
            <div class="card-body">
                <div class="d-flex align-items-center mb-4">
                    <img src="{{ asset('assets/images/rinjani.jpg') }}" class="rounded" width="60" height="60" style="object-fit: cover;" alt="Rinjani" onerror="this.src='https://placehold.co/60x60'">
                    <div class="ms-3 flex-grow-1">
                        <h6 class="mb-1">Mount Rinjani Summit</h6>
                        <div class="text-muted small">120 Bookings this month</div>
                    </div>
                    <div class="fw-bold text-success">+15%</div>
                </div>
                <div class="d-flex align-items-center mb-4">
                    <img src="{{ asset('assets/images/bromo.jpg') }}" class="rounded" width="60" height="60" style="object-fit: cover;" alt="Bromo" onerror="this.src='https://placehold.co/60x60'">
                    <div class="ms-3 flex-grow-1">
                        <h6 class="mb-1">Bromo Sunrise</h6>
                        <div class="text-muted small">98 Bookings this month</div>
                    </div>
                    <div class="fw-bold text-success">+5%</div>
                </div>
                <div class="d-flex align-items-center mb-4">
                    <img src="{{ asset('assets/images/semeru.jpg') }}" class="rounded" width="60" height="60" style="object-fit: cover;" alt="Semeru" onerror="this.src='https://placehold.co/60x60'">
                    <div class="ms-3 flex-grow-1">
                        <h6 class="mb-1">Mount Semeru</h6>
                        <div class="text-muted small">65 Bookings this month</div>
                    </div>
                    <div class="fw-bold text-danger">-2%</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
