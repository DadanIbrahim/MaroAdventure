@extends(request()->routeIs('superadmin.*') ? 'layouts.superadmin' : 'layouts.admin')
@section('title', 'Destinasi - ' . (request()->routeIs('superadmin.*') ? 'Superadmin' : 'Admin'))
@section('page_title', 'Database Destinasi')

@section('content')
<div class="card border-0 shadow-sm mb-4">
    <div class="card-body py-3 d-flex flex-wrap justify-content-between align-items-center gap-3">
        <div>
            <h5 class="fw-bold mb-1 text-dark">Daftar Destinasi</h5>
            <p class="text-muted small mb-0">Kelola seluruh data destinasi wisata untuk paket trip Anda</p>
        </div>
        <a href="{{ route(request()->routeIs('superadmin.*') ? 'superadmin.mountains.create' : 'admin.mountains.create') }}" class="btn btn-primary d-inline-flex align-items-center gap-2 shadow-sm">
            <i class="bi bi-plus-circle"></i>
            <span>Tambah Destinasi</span>
        </a>
    </div>
</div>

<div class="row g-4">
    @forelse($mountains as $mountain)
    <div class="col-12 col-md-6 col-xl-4">
        <div class="card border-0 shadow-sm h-100 overflow-hidden">
            <div class="position-relative">
                <img src="{{ $mountain->image ? asset('storage/' . $mountain->image) : 'https://placehold.co/400x200?text=No+Image' }}" class="card-img-top" alt="{{ $mountain->name }}" style="height: 200px; object-fit: cover;">
                <span class="position-absolute top-0 end-0 m-2 badge {{ $mountain->status ? 'bg-success' : 'bg-secondary' }} shadow-sm">
                    {{ $mountain->status ? 'Active' : 'Inactive' }}
                </span>
            </div>
            <div class="card-body d-flex flex-column">
                <h5 class="card-title fw-bold text-dark mb-1">{{ $mountain->name }}</h5>
                <p class="card-text text-muted small mb-2">
                    <i class="bi bi-geo-alt text-primary"></i> {{ $mountain->location }}
                </p>
                <p class="card-text small text-muted text-truncate mb-3" style="max-height: 40px;">{{ $mountain->description }}</p>
                
                <div class="mt-auto pt-3 border-top d-flex justify-content-between align-items-center">
                    <a href="{{ route(request()->routeIs('superadmin.*') ? 'superadmin.mountains.edit' : 'admin.mountains.edit', $mountain->id) }}" class="btn btn-outline-primary btn-sm">
                        <i class="bi bi-pencil me-1"></i> Edit Data
                    </a>
                    <form action="{{ route(request()->routeIs('superadmin.*') ? 'superadmin.mountains.destroy' : 'admin.mountains.destroy', $mountain->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus destinasi ini?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger btn-sm">
                            <i class="bi bi-trash me-1"></i> Hapus
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @empty
    <div class="col-12">
        <div class="alert alert-light text-center border-0 shadow-sm py-5">
            <i class="bi bi-geo text-muted mb-3 d-block" style="font-size: 3rem;"></i>
            <h5 class="fw-bold">Belum ada data Destinasi</h5>
            <p class="text-muted mb-4">Tambahkan data destinasi pertama Anda untuk mulai membuat paket trip.</p>
            <a href="{{ route(request()->routeIs('superadmin.*') ? 'superadmin.mountains.create' : 'admin.mountains.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle me-1"></i> Tambah Destinasi Sekarang
            </a>
        </div>
    </div>
    @endforelse
</div>
@endsection

