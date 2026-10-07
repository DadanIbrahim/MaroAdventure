@extends(request()->routeIs('superadmin.*') ? 'layouts.superadmin' : 'layouts.admin')
@section('title', 'Sesuaikan Poin - ' . (request()->routeIs('superadmin.*') ? 'Superadmin' : 'Admin'))
@section('page_title', 'Sesuaikan Saldo Poin')

@section('content')
<div class="card border-0 shadow-sm" style="max-width: 600px; margin: 0 auto;">
    <div class="card-header bg-white py-3">
        <h6 class="mb-0 fw-bold">Edit Poin: {{ $user->name }}</h6>
    </div>
    <div class="card-body">
        <form action="{{ route(request()->routeIs('superadmin.*') ? 'superadmin.points.update' : 'admin.points.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="mb-3">
                <label class="form-label text-muted">Nama Pengguna</label>
                <input type="text" class="form-control bg-light" value="{{ $user->name }}" readonly>
            </div>
            
            <div class="mb-4">
                <label class="form-label text-muted">Email</label>
                <input type="text" class="form-control bg-light" value="{{ $user->email }}" readonly>
            </div>

            <div class="mb-4">
                <label class="form-label fw-bold">Saldo Poin Saat Ini <span class="text-danger">*</span></label>
                <div class="input-group">
                    <span class="input-group-text bg-warning text-dark"><i class="bi bi-coin"></i></span>
                    <input type="number" name="points" class="form-control form-control-lg text-end fw-bold" value="{{ old('points', $user->points) }}" min="0" required>
                </div>
                <div class="form-text">Anda dapat menambah atau mengurangi poin pengguna secara manual dari sini.</div>
            </div>

            <div class="text-end">
                <a href="{{ route(request()->routeIs('superadmin.*') ? 'superadmin.points.index' : 'admin.points.index') }}" class="btn btn-light me-2">Batal</a>
                <button type="submit" class="btn btn-primary"><i class="bi bi-save me-1"></i> Simpan Poin</button>
            </div>
        </form>
    </div>
</div>
@endsection

