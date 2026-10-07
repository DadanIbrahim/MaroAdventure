@extends(request()->routeIs('superadmin.*') ? 'layouts.superadmin' : 'layouts.admin')
@section('title', 'Tambah Booking - ' . (request()->routeIs('superadmin.*') ? 'Superadmin' : 'Admin'))
@section('page_title', 'Tambah Data Pemesanan')

@section('content')
<div class="card border-0 shadow-sm">
    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
        <h6 class="mb-0 fw-bold">Buat Booking Baru (Manual)</h6>
        <a href="{{ route(request()->routeIs('superadmin.*') ? 'superadmin.bookings.index' : 'admin.bookings.index') }}" class="btn btn-sm btn-outline-secondary">
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

        <form action="{{ route(request()->routeIs('superadmin.*') ? 'superadmin.bookings.store' : 'admin.bookings.store') }}" method="POST">
            @csrf
            <div class="row g-4">
                <div class="col-md-6">
                    <h6 class="fw-bold mb-3 border-bottom pb-2">Informasi Pelanggan</h6>
                    <div class="mb-3">
                        <label class="form-label">Nama Pelanggan <span class="text-danger">*</span></label>
                        <input type="text" name="customer_name" class="form-control" value="{{ old('customer_name') }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">No. Telepon / WhatsApp</label>
                        <input type="text" name="customer_phone" class="form-control" value="{{ old('customer_phone') }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Paket Trip <span class="text-danger">*</span></label>
                        <select name="trip_id" class="form-select" required>
                            <option value="">-- Pilih Trip --</option>
                            @foreach($trips as $trip)
                                <option value="{{ $trip->id }}" {{ old('trip_id') == $trip->id ? 'selected' : '' }}>
                                    {{ $trip->name }} ({{ $trip->formatted_price }})
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-md-6">
                    <h6 class="fw-bold mb-3 border-bottom pb-2">Detail Keberangkatan & Harga</h6>
                    <div class="row g-3 mb-3">
                        <div class="col-6">
                            <label class="form-label">Tanggal Berangkat <span class="text-danger">*</span></label>
                            <input type="date" name="booking_date" class="form-control" value="{{ old('booking_date') }}" required>
                        </div>
                        <div class="col-6">
                            <label class="form-label">Jml. Peserta <span class="text-danger">*</span></label>
                            <input type="number" name="participants" class="form-control" value="{{ old('participants', 1) }}" min="1" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Total Harga (Rp) <span class="text-danger">*</span></label>
                        <input type="text" name="total_price" id="total_price" class="form-control fw-bold text-success" value="{{ old('total_price') }}" placeholder="Rp 0" required>
                    </div>
                    
                    <div class="row g-3 mb-3">
                        <div class="col-6">
                            <label class="form-label">Status Booking <span class="text-danger">*</span></label>
                            <select name="status" class="form-select" required>
                                <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending (Menunggu)</option>
                                <option value="confirmed" {{ old('status') == 'confirmed' ? 'selected' : '' }}>Confirmed (Dikonfirmasi)</option>
                                <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>Completed (Selesai)</option>
                            </select>
                        </div>
                        <div class="col-6">
                            <label class="form-label">Status Bayar <span class="text-danger">*</span></label>
                            <select name="payment_status" class="form-select" required>
                                <option value="unpaid" {{ old('payment_status') == 'unpaid' ? 'selected' : '' }}>Unpaid (Belum Lunas)</option>
                                <option value="paid" {{ old('payment_status') == 'paid' ? 'selected' : '' }}>Paid (Lunas)</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="col-12 mt-2">
                    <label class="form-label">Catatan Pemesanan</label>
                    <textarea name="notes" class="form-control" rows="3" placeholder="Catatan tambahan...">{{ old('notes') }}</textarea>
                </div>

                <div class="col-12 mt-4 text-end">
                    <button type="reset" class="btn btn-light me-2">Reset</button>
                    <button type="submit" class="btn btn-primary px-4"><i class="bi bi-save me-1"></i> Simpan Booking</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    const priceInput = document.getElementById('total_price');
    
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
    
    if(priceInput.value) {
        priceInput.value = formatRupiah(priceInput.value, 'Rp ');
    }
</script>
@endpush

