@extends(request()->routeIs('superadmin.*') ? 'layouts.superadmin' : 'layouts.admin')
@section('title', 'Articles - Superadmin')
@section('page_title', 'Blog & Articles')

@section('content')
<div class="card border-0 shadow-sm">
    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
        <h6 class="mb-0 fw-bold">Published Articles</h6>
        <button class="btn btn-primary btn-sm"><i class="bi bi-journal-plus"></i> New Article</button>
    </div>
    <div class="card-body p-0">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Category</th>
                    <th>Views</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><span class="fw-medium">Tips Persiapan Fisik Sebelum Mendaki Rinjani</span></td>
                    <td>Admin</td>
                    <td>Tips & Trik</td>
                    <td>1,245</td>
                    <td><button class="btn btn-sm btn-light"><i class="bi bi-pencil"></i></button></td>
                </tr>
                <tr>
                    <td><span class="fw-medium">Perlengkapan Wajib Naik Gunung di Musim Hujan</span></td>
                    <td>Guide Budi</td>
                    <td>Gear</td>
                    <td>890</td>
                    <td><button class="btn btn-sm btn-light"><i class="bi bi-pencil"></i></button></td>
                </tr>
                <tr>
                    <td><span class="fw-medium">Cerita Pendakian: Menembus Badai Merbabu</span></td>
                    <td>Contributor</td>
                    <td>Story</td>
                    <td>3,402</td>
                    <td><button class="btn btn-sm btn-light"><i class="bi bi-pencil"></i></button></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection
