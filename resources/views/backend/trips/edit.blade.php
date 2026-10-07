@extends(request()->routeIs('superadmin.*') ? 'layouts.superadmin' : 'layouts.admin')
@section('title', 'Edit Trip - ' . (request()->routeIs('superadmin.*') ? 'Superadmin' : 'Admin'))
@section('page_title', 'Edit Paket Trip: ' . $trip->name)

@section('content')
<div class="card border-0 shadow-sm">
    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
        <h6 class="mb-0 fw-bold">Form Edit Trip</h6>
        <a href="{{ route(request()->routeIs('superadmin.*') ? 'superadmin.trips.index' : 'admin.trips.index') }}" class="btn btn-sm btn-outline-secondary">
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

        <form action="{{ route(request()->routeIs('superadmin.*') ? 'superadmin.trips.update' : 'admin.trips.update', $trip->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Nama Paket Trip <span class="text-danger">*</span></label>
                    <input type="text" name="name" class="form-control" value="{{ old('name', $trip->name) }}" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Gunung Tujuan <span class="text-danger">*</span></label>
                    <select name="mountain_id" class="form-select" required>
                        <option value="">-- Pilih Gunung --</option>
                        @foreach($mountains as $mountain)
                            <option value="{{ $mountain->id }}" {{ old('mountain_id', $trip->mountain_id) == $mountain->id ? 'selected' : '' }}>
                                {{ $mountain->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Harga (Rp) <span class="text-danger">*</span></label>
                    <input type="text" name="price" id="price_input" class="form-control" value="{{ old('price', $trip->price) }}" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Durasi <span class="text-danger">*</span></label>
                    <input type="text" name="duration" class="form-control" value="{{ old('duration', $trip->duration) }}" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Status <span class="text-danger">*</span></label>
                    <select name="status" class="form-select" required>
                        <option value="1" {{ old('status', $trip->status) == '1' ? 'selected' : '' }}>Active (Buka)</option>
                        <option value="0" {{ old('status', $trip->status) == '0' ? 'selected' : '' }}>Inactive (Tutup)</option>
                    </select>
                </div>
                <div class="col-12">
                    <label class="form-label">Deskripsi Fasilitas & Trip</label>
                    <textarea name="description" class="form-control" rows="4">{{ old('description', $trip->description) }}</textarea>
                </div>
                <div class="col-12">
                    <label class="form-label">Foto Trip</label>
                    @if($trip->image)
                        <div class="mb-2">
                            <img src="{{ asset('storage/' . $trip->image) }}" alt="Preview" class="img-thumbnail" style="max-height: 150px;">
                        </div>
                    @endif
                    <input type="file" name="image" class="form-control" accept="image/*">
                    <div class="form-text">Format didukung: JPG, PNG, JPEG. Ukuran maksimal 2MB. Biarkan kosong jika tidak mengubah foto.</div>
                </div>
                <div class="col-12 mt-4">
                    <button type="submit" class="btn btn-primary"><i class="bi bi-save me-1"></i> Update Data</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Format mata uang Rupiah
    const priceInput = document.getElementById('price_input');
    
    priceInput.addEventListener('keyup', function(e) {
        this.value = formatRupiah(this.value, 'Rp ');
    });

    function formatRupiah(angka, prefix){
        let number_string = angka.toString().replace(/[^,\d]/g, ''),
            split   		= number_string.split(','),
            sisa     		= split[0].length % 3,
            rupiah     		= split[0].substr(0, sisa),
            ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);

        if(ribuan){
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix == undefined ? rupiah : (rupiah ? 'Rp ' + rupiah : '');
    }
    
    // Trigger format if there is an existing value
    if(priceInput.value) {
        priceInput.value = formatRupiah(priceInput.value, 'Rp ');
    }
</script>
@endpush

