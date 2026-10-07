@extends(request()->routeIs('superadmin.*') ? 'layouts.superadmin' : 'layouts.admin')
@section('title', 'Tambah Trip - ' . (request()->routeIs('superadmin.*') ? 'Superadmin' : 'Admin'))
@section('page_title', 'Tambah Paket Trip')

@section('content')
<div class="card border-0 shadow-sm">
    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
        <h6 class="mb-0 fw-bold">Form Tambah Trip</h6>
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

        <form action="{{ route(request()->routeIs('superadmin.*') ? 'superadmin.trips.store' : 'admin.trips.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Nama Paket Trip <span class="text-danger">*</span></label>
                    <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Gunung Tujuan <span class="text-danger">*</span></label>
                    <select name="mountain_id" class="form-select" required>
                        <option value="">-- Pilih Gunung --</option>
                        @foreach($mountains as $mountain)
                            <option value="{{ $mountain->id }}" {{ old('mountain_id') == $mountain->id ? 'selected' : '' }}>
                                {{ $mountain->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Harga (Rp) <span class="text-danger">*</span></label>
                    <input type="text" name="price" id="price_input" class="form-control" value="{{ old('price') }}" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Durasi <span class="text-danger">*</span></label>
                    <input type="text" name="duration" class="form-control" value="{{ old('duration') }}" required>
                    <div class="form-text">Misal: 3 Hari 2 Malam</div>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Status <span class="text-danger">*</span></label>
                    <select name="status" class="form-select" required>
                        <option value="1" {{ old('status', '1') == '1' ? 'selected' : '' }}>Active (Buka)</option>
                        <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Inactive (Tutup)</option>
                    </select>
                </div>
                <div class="col-12">
                    <label class="form-label">Deskripsi Fasilitas & Trip</label>
                    <textarea name="description" class="form-control" rows="4">{{ old('description') }}</textarea>
                </div>
                <div class="col-12">
                    <label class="form-label">Foto Trip</label>
                    <input type="file" name="image" class="form-control" accept="image/*">
                    <div class="form-text">Format didukung: JPG, PNG, JPEG. Ukuran maksimal 2MB.</div>
                </div>
                <div class="col-12 mt-4">
                    <button type="submit" class="btn btn-primary"><i class="bi bi-save me-1"></i> Simpan Data</button>
                    <button type="reset" class="btn btn-light">Reset</button>
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
        let number_string = angka.replace(/[^,\d]/g, '').toString(),
            split   		= number_string.split(','),
            sisa     		= split[0].length % 3,
            rupiah     		= split[0].substr(0, sisa),
            ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);

        // tambahkan titik jika yang di input sudah menjadi angka ribuan
        if(ribuan){
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix == undefined ? rupiah : (rupiah ? 'Rp ' + rupiah : '');
    }
    
    // Trigger format if there is an old value
    if(priceInput.value) {
        priceInput.value = formatRupiah(priceInput.value, 'Rp ');
    }
</script>
@endpush

