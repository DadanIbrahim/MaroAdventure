@extends(request()->routeIs('superadmin.*') ? 'layouts.superadmin' : 'layouts.admin')
@section('title', 'Edit Reward - ' . (request()->routeIs('superadmin.*') ? 'Superadmin' : 'Admin'))
@section('page_title', 'Edit Hadiah: ' . $reward->name)

@section('content')
<div class="card border-0 shadow-sm">
    <div class="card-header bg-white py-3">
        <h6 class="mb-0 fw-bold">Form Edit Reward</h6>
    </div>
    <div class="card-body">
        <form action="{{ route(request()->routeIs('superadmin.*') ? 'superadmin.rewards.update' : 'admin.rewards.update', $reward->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Nama Hadiah / Voucher <span class="text-danger">*</span></label>
                    <input type="text" name="name" class="form-control" value="{{ old('name', $reward->name) }}" required>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Harga Poin <span class="text-danger">*</span></label>
                    <input type="number" name="points_required" class="form-control" value="{{ old('points_required', $reward->points_required) }}" min="0" required>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Stok <span class="text-danger">*</span></label>
                    <input type="number" name="stock" class="form-control" value="{{ old('stock', $reward->stock) }}" min="0" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Status <span class="text-danger">*</span></label>
                    <select name="is_active" class="form-select" required>
                        <option value="1" {{ old('is_active', $reward->is_active) == 1 ? 'selected' : '' }}>Active (Tersedia)</option>
                        <option value="0" {{ old('is_active', $reward->is_active) == 0 ? 'selected' : '' }}>Inactive (Tidak Aktif)</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Foto / Gambar Baru (Opsional)</label>
                    <input type="file" name="image" class="form-control" accept="image/*">
                    @if($reward->image)
                        <div class="mt-2">
                            <img src="{{ asset('storage/' . $reward->image) }}" class="img-thumbnail" style="height:80px;">
                        </div>
                    @endif
                </div>
                <div class="col-12">
                    <label class="form-label">Deskripsi Hadiah</label>
                    <textarea name="description" class="form-control" rows="3">{{ old('description', $reward->description) }}</textarea>
                </div>
                <div class="col-12 text-end mt-4">
                    <a href="{{ route(request()->routeIs('superadmin.*') ? 'superadmin.rewards.index' : 'admin.rewards.index') }}" class="btn btn-light me-2">Batal</a>
                    <button type="submit" class="btn btn-primary"><i class="bi bi-save me-1"></i> Update Reward</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

