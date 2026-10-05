@extends('layouts.superadmin')
@section('title', 'Bookings - Superadmin')
@section('page_title', 'All Bookings')

@section('content')
<div class="card border-0 shadow-sm">
    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
        <h6 class="mb-0 fw-bold">Booking History & Active Bookings</h6>
        <div class="input-group" style="width: 250px;">
            <input type="text" class="form-control form-control-sm" placeholder="Search booking ID...">
            <button class="btn btn-primary btn-sm"><i class="bi bi-search"></i></button>
        </div>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Booking ID</th>
                        <th>User</th>
                        <th>Trip Package</th>
                        <th>Total Pax</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="fw-medium">#BK-99201</td>
                        <td>Ahmad Syauqi</td>
                        <td>Rinjani Summit Via Sembalun</td>
                        <td>2</td>
                        <td><span class="badge bg-success">Completed</span></td>
                        <td><button class="btn btn-sm btn-light"><i class="bi bi-eye"></i></button></td>
                    </tr>
                    <tr>
                        <td class="fw-medium">#BK-99202</td>
                        <td>Budi Waseso</td>
                        <td>Semeru Summit Attack</td>
                        <td>4</td>
                        <td><span class="badge bg-warning text-dark">Pending Payment</span></td>
                        <td><button class="btn btn-sm btn-light"><i class="bi bi-eye"></i></button></td>
                    </tr>
                    <tr>
                        <td class="fw-medium">#BK-99203</td>
                        <td>Citra Lestari</td>
                        <td>Rinjani Lake & Hot Spring</td>
                        <td>1</td>
                        <td><span class="badge bg-primary">Confirmed</span></td>
                        <td><button class="btn btn-sm btn-light"><i class="bi bi-eye"></i></button></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
