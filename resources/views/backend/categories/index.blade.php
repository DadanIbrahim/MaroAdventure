@extends(request()->routeIs('superadmin.*') ? 'layouts.superadmin' : 'layouts.admin')
@section('title', 'Manajemen Kategori - ' . (request()->routeIs('superadmin.*') ? 'Superadmin' : 'Admin'))
@section('page_title', 'Manajemen Kategori')

@php
    $routePrefix = request()->routeIs('superadmin.*') ? 'superadmin' : 'admin';
@endphp

@section('content')
@if($errors->any())
    <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm mb-4">
        <ul class="mb-0">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<div class="row g-4">
    {{-- KATEGORI ARTIKEL --}}
    <div class="col-lg-6">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="mb-0 fw-bold"><i class="bi bi-journal-text text-primary me-2"></i>Kategori Artikel</h6>
                    <small class="text-muted">Digunakan pada halaman Artikel & Panduan</small>
                </div>
                <span class="badge bg-primary rounded-pill">{{ $articleCategories->count() }} Kategori</span>
            </div>
            <div class="card-body">
                <form action="{{ route($routePrefix . '.categories.store') }}" method="POST" class="mb-4">
                    @csrf
                    <input type="hidden" name="type" value="artikel">
                    <label class="form-label small fw-semibold">Tambah Kategori Artikel Baru</label>
                    <div class="input-group">
                        <input type="text" name="name" class="form-control" placeholder="Contoh: Peralatan, Survival, Kuliner..." required>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-plus-lg me-1"></i> Tambah
                        </button>
                    </div>
                </form>

                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Nama Kategori</th>
                                <th class="text-center" width="25%">Jumlah Artikel</th>
                                <th class="text-end" width="25%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($articleCategories as $cat)
                                <tr>
                                    <td>
                                        <span class="badge bg-light text-dark border px-3 py-2 fs-6 fw-medium">
                                            {{ $cat->name }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <span class="text-muted small">{{ $articleCounts[$cat->name] ?? 0 }} artikel</span>
                                    </td>
                                    <td class="text-end">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#editCatModal{{ $cat->id }}" title="Edit">
                                                <i class="bi bi-pencil"></i>
                                            </button>
                                            <form action="{{ route($routePrefix . '.categories.destroy', $cat->id) }}" method="POST" onsubmit="return confirm('Hapus kategori {{ $cat->name }}?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger" title="Hapus">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </div>

                                        {{-- Edit Modal --}}
                                        <div class="modal fade text-start" id="editCatModal{{ $cat->id }}" tabindex="-1" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <form action="{{ route($routePrefix . '.categories.update', $cat->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="modal-header">
                                                            <h6 class="modal-title fw-bold">Edit Kategori Artikel</h6>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <label class="form-label">Nama Kategori</label>
                                                            <input type="text" name="name" class="form-control" value="{{ $cat->name }}" required>
                                                            <div class="form-text">Mengubah nama kategori akan otomatis memperbarui artikel yang memakai kategori ini.</div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                            <button type="submit" class="btn btn-sm btn-primary">Simpan Perubahan</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center text-muted py-4">Belum ada kategori artikel.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- KATEGORI BERITA --}}
    <div class="col-lg-6">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="mb-0 fw-bold"><i class="bi bi-newspaper text-primary me-2"></i>Kategori Berita</h6>
                    <small class="text-muted">Digunakan pada halaman Berita & Pengumuman</small>
                </div>
                <span class="badge bg-primary rounded-pill">{{ $beritaCategories->count() }} Kategori</span>
            </div>
            <div class="card-body">
                <form action="{{ route($routePrefix . '.categories.store') }}" method="POST" class="mb-4">
                    @csrf
                    <input type="hidden" name="type" value="berita">
                    <label class="form-label small fw-semibold">Tambah Kategori Berita Baru</label>
                    <div class="input-group">
                        <input type="text" name="name" class="form-control" placeholder="Contoh: Promo, Cuaca, Event..." required>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-plus-lg me-1"></i> Tambah
                        </button>
                    </div>
                </form>

                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Nama Kategori</th>
                                <th class="text-center" width="25%">Jumlah Berita</th>
                                <th class="text-end" width="25%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($beritaCategories as $cat)
                                <tr>
                                    <td>
                                        <span class="badge bg-light text-dark border px-3 py-2 fs-6 fw-medium">
                                            {{ $cat->name }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <span class="text-muted small">{{ $beritaCounts[$cat->name] ?? 0 }} berita</span>
                                    </td>
                                    <td class="text-end">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#editCatModal{{ $cat->id }}" title="Edit">
                                                <i class="bi bi-pencil"></i>
                                            </button>
                                            <form action="{{ route($routePrefix . '.categories.destroy', $cat->id) }}" method="POST" onsubmit="return confirm('Hapus kategori {{ $cat->name }}?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger" title="Hapus">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </div>

                                        {{-- Edit Modal --}}
                                        <div class="modal fade text-start" id="editCatModal{{ $cat->id }}" tabindex="-1" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <form action="{{ route($routePrefix . '.categories.update', $cat->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="modal-header">
                                                            <h6 class="modal-title fw-bold">Edit Kategori Berita</h6>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <label class="form-label">Nama Kategori</label>
                                                            <input type="text" name="name" class="form-control" value="{{ $cat->name }}" required>
                                                            <div class="form-text">Mengubah nama kategori akan otomatis memperbarui berita yang memakai kategori ini.</div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                            <button type="submit" class="btn btn-sm btn-primary">Simpan Perubahan</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center text-muted py-4">Belum ada kategori berita.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
