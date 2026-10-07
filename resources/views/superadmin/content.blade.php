@extends(request()->routeIs('superadmin.*') ? 'layouts.superadmin' : 'layouts.admin')
@section('title', 'Content Management - Superadmin')
@section('page_title', 'Content Management')

@section('content')
<div class="card border-0 shadow-sm">
    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
        <h6 class="mb-0 fw-bold">Landing Page Sections</h6>
        <button class="btn btn-primary btn-sm"><i class="bi bi-plus-lg"></i> Add Section</button>
    </div>
    <div class="card-body p-0">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th>Section Name</th>
                    <th>Type</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Hero Banner</td>
                    <td>Slider</td>
                    <td><span class="badge bg-success">Active</span></td>
                    <td><button class="btn btn-sm btn-light"><i class="bi bi-pencil"></i></button></td>
                </tr>
                <tr>
                    <td>About Us</td>
                    <td>Text & Image</td>
                    <td><span class="badge bg-success">Active</span></td>
                    <td><button class="btn btn-sm btn-light"><i class="bi bi-pencil"></i></button></td>
                </tr>
                <tr>
                    <td>Testimonials</td>
                    <td>Carousel</td>
                    <td><span class="badge bg-warning">Draft</span></td>
                    <td><button class="btn btn-sm btn-light"><i class="bi bi-pencil"></i></button></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection
