@extends(request()->routeIs('superadmin.*') ? 'layouts.superadmin' : 'layouts.admin')
@section('title', 'Mountains - ' . (request()->routeIs('superadmin.*') ? 'Superadmin' : 'Admin'))
@section('page_title', 'Mountain Database')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h5 class="fw-bold mb-0">Daftar Gunung</h5>
    <a href="{{ route(request()->routeIs('superadmin.*') ? 'superadmin.mountains.create' : 'admin.mountains.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle me-1"></i> Tambah Gunung
    </a>
</div>

<div class="row g-4">
    @forelse($mountains as $mountain)
    <div class="col-md-4">
        <div class="card border-0 shadow-sm h-100">
            <img src="{{ $mountain->image ? asset('storage/' . $mountain->image) : 'https://placehold.co/400x200?text=No+Image' }}" class="card-img-top" alt="{{ $mountain->name }}" style="height: 200px; object-fit: cover;">
            <div class="card-body">
                <h5 class="card-title fw-bold">{{ $mountain->name }}</h5>
                <p class="card-text text-muted small mb-2">
                    <i class="bi bi-geo-alt"></i> {{ $mountain->location }}<br>
                    <i class="bi bi-arrow-up-circle"></i> {{ number_format($mountain->elevation, 0, ',', '.') }} mdpl
                </p>
                <p class="card-text small text-truncate" style="max-height: 40px;">{{ $mountain->description }}</p>
                <span class="badge {{ $mountain->status ? 'bg-success' : 'bg-secondary' }} mb-3">
                    {{ $mountain->status ? 'Active' : 'Inactive' }}
                </span>
                <div class="d-flex justify-content-between">
                    <a href="{{ route(request()->routeIs('superadmin.*') ? 'superadmin.mountains.edit' : 'admin.mountains.edit', $mountain->id) }}" class="btn btn-outline-primary btn-sm">Edit Data</a>
                    <form action="{{ route(request()->routeIs('superadmin.*') ? 'superadmin.mountains.destroy' : 'admin.mountains.destroy', $mountain->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus gunung ini?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger btn-sm">Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @empty
    <div class="col-12">
        <div class="alert alert-light text-center border-0 shadow-sm py-5">
            <i class="bi bi-geo text-muted mb-3 d-block" style="font-size: 3rem;"></i>
            <h5 class="fw-bold">Belum ada data Gunung</h5>
            <p class="text-muted mb-4">Tambahkan data gunung pertama Anda untuk mulai membuat paket trip.</p>
            <a href="{{ route(request()->routeIs('superadmin.*') ? 'superadmin.mountains.create' : 'admin.mountains.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle me-1"></i> Tambah Gunung Sekarang
            </a>
        </div>
    </div>
    @endforelse
</div>
@endsection

