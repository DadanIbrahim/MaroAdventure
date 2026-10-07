@extends(request()->routeIs('superadmin.*') ? 'layouts.superadmin' : 'layouts.admin')
@section('title', 'Tambah Reward - ' . (request()->routeIs('superadmin.*') ? 'Superadmin' : 'Admin'))
@section('page_title', 'Tambah Hadiah Baru')

@section('content')
<div class="card border-0 shadow-sm">
    <div class="card-header bg-white py-3">
        <h6 class="mb-0 fw-bold">Form Tambah Reward</h6>
    </div>
    <div class="card-body">
        <form action="{{ route(request()->routeIs('superadmin.*') ? 'superadmin.rewards.store' : 'admin.rewards.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Nama Hadiah / Voucher <span class="text-danger">*</span></label>
                    <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Harga Poin <span class="text-danger">*</span></label>
                    <input type="number" name="points_required" class="form-control" value="{{ old('points_required', 0) }}" min="0" required>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Stok <span class="text-danger">*</span></label>
                    <input type="number" name="stock" class="form-control" value="{{ old('stock', 0) }}" min="0" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Status <span class="text-danger">*</span></label>
                    <select name="is_active" class="form-select" required>
                        <option value="1" {{ old('is_active', '1') == '1' ? 'selected' : '' }}>Active (Tersedia)</option>
                        <option value="0" {{ old('is_active') == '0' ? 'selected' : '' }}>Inactive (Tidak Aktif)</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Foto / Gambar (Opsional)</label>
                    <input type="file" name="image" class="form-control" accept="image/*">
                </div>
                <div class="col-12">
                    <label class="form-label">Deskripsi Hadiah</label>
                    <textarea name="description" class="form-control" rows="3">{{ old('description') }}</textarea>
                </div>
                <div class="col-12 text-end mt-4">
                    <a href="{{ route(request()->routeIs('superadmin.*') ? 'superadmin.rewards.index' : 'admin.rewards.index') }}" class="btn btn-light me-2">Batal</a>
                    <button type="submit" class="btn btn-primary"><i class="bi bi-save me-1"></i> Simpan Reward</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

