@extends(request()->routeIs('superadmin.*') ? 'layouts.superadmin' : 'layouts.admin')
@section('title', 'Edit Gunung - ' . (request()->routeIs('superadmin.*') ? 'Superadmin' : 'Admin'))
@section('page_title', 'Edit Gunung: ' . $mountain->name)

@section('content')
<div class="card border-0 shadow-sm">
    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
        <h6 class="mb-0 fw-bold">Form Edit Gunung</h6>
        <a href="{{ route(request()->routeIs('superadmin.*') ? 'superadmin.mountains.index' : 'admin.mountains.index') }}" class="btn btn-sm btn-outline-secondary">
            <i class="bi bi-arrow-left me-1"></i> Kembali
        </a>
    </div>
    <div class="card-body">
        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route(request()->routeIs('superadmin.*') ? 'superadmin.mountains.update' : 'admin.mountains.update', $mountain->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Nama Gunung <span class="text-danger">*</span></label>
                    <input type="text" name="name" class="form-control" value="{{ old('name', $mountain->name) }}" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Lokasi <span class="text-danger">*</span></label>
                    <input type="text" name="location" class="form-control" value="{{ old('location', $mountain->location) }}" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Ketinggian (mdpl) <span class="text-danger">*</span></label>
                    <input type="number" name="elevation" class="form-control" value="{{ old('elevation', $mountain->elevation) }}" required min="0">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Status <span class="text-danger">*</span></label>
                    <select name="status" class="form-select" required>
                        <option value="1" {{ old('status', $mountain->status) == '1' ? 'selected' : '' }}>Active (Buka)</option>
                        <option value="0" {{ old('status', $mountain->status) == '0' ? 'selected' : '' }}>Inactive (Tutup)</option>
                    </select>
                </div>
                <div class="col-12">
                    <label class="form-label">Deskripsi</label>
                    <textarea name="description" class="form-control" rows="4">{{ old('description', $mountain->description) }}</textarea>
                </div>
                <div class="col-12">
                    <label class="form-label">Foto Gunung (Biarkan kosong jika tidak ingin mengubah)</label>
                    @if($mountain->image)
                        <div class="mb-2">
                            <img src="{{ asset('storage/' . $mountain->image) }}" alt="Preview" class="img-thumbnail" style="max-height: 150px;">
                        </div>
                    @endif
                    <input type="file" name="image" class="form-control" accept="image/*">
                    <div class="form-text">Format didukung: JPG, PNG, JPEG. Ukuran maksimal 2MB.</div>
                </div>
                <div class="col-12 mt-4">
                    <button type="submit" class="btn btn-primary"><i class="bi bi-save me-1"></i> Update Data</button>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection

