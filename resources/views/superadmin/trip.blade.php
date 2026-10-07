@extends(request()->routeIs('superadmin.*') ? 'layouts.superadmin' : 'layouts.admin')
@section('title', 'Trip Packages - Superadmin')
@section('page_title', 'Trip Packages')

@section('content')
<div class="card border-0 shadow-sm">
    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
        <h6 class="mb-0 fw-bold">All Available Trips</h6>
        <button class="btn btn-primary btn-sm"><i class="bi bi-plus-lg"></i> Add Trip Package</button>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Trip Name</th>
                        <th>Mountain</th>
                        <th>Duration</th>
                        <th>Price</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="fw-medium">Rinjani Summit Via Sembalun</td>
                        <td>Gunung Rinjani</td>
                        <td>4D3N</td>
                        <td>Rp 2.500.000</td>
                        <td><button class="btn btn-sm btn-light"><i class="bi bi-pencil"></i></button></td>
                    </tr>
                    <tr>
                        <td class="fw-medium">Rinjani Lake & Hot Spring</td>
                        <td>Gunung Rinjani</td>
                        <td>3D2N</td>
                        <td>Rp 2.100.000</td>
                        <td><button class="btn btn-sm btn-light"><i class="bi bi-pencil"></i></button></td>
                    </tr>
                    <tr>
                        <td class="fw-medium">Semeru Summit Attack</td>
                        <td>Gunung Semeru</td>
                        <td>4D3N</td>
                        <td>Rp 1.850.000</td>
                        <td><button class="btn btn-sm btn-light"><i class="bi bi-pencil"></i></button></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
