@extends(request()->routeIs('superadmin.*') ? 'layouts.superadmin' : 'layouts.admin')
@section('title', 'Catat Pembayaran - ' . (request()->routeIs('superadmin.*') ? 'Superadmin' : 'Admin'))
@section('page_title', 'Catat Pembayaran Manual')

@section('content')
<div class="card border-0 shadow-sm">
    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
        <h6 class="mb-0 fw-bold">Form Catat Pembayaran</h6>
        <a href="{{ route(request()->routeIs('superadmin.*') ? 'superadmin.payments.index' : 'admin.payments.index') }}" class="btn btn-sm btn-outline-secondary">
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

        <form action="{{ route(request()->routeIs('superadmin.*') ? 'superadmin.payments.store' : 'admin.payments.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row g-4">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Pilih Booking (Unpaid) <span class="text-danger">*</span></label>
                        <select name="booking_id" class="form-select" required>
                            <option value="">-- Pilih Kode Booking --</option>
                            @foreach($bookings as $booking)
                                <option value="{{ $booking->id }}" {{ old('booking_id') == $booking->id ? 'selected' : '' }}>
                                    {{ $booking->booking_code }} - {{ $booking->customer_name }} (Tagihan: {{ $booking->formatted_price }})
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Metode Pembayaran <span class="text-danger">*</span></label>
                        <input type="text" name="payment_method" class="form-control" value="{{ old('payment_method') }}" placeholder="Contoh: Transfer BCA, Tunai" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nominal Bayar (Rp) <span class="text-danger">*</span></label>
                        <input type="text" name="amount" id="amount" class="form-control fw-bold text-success" value="{{ old('amount') }}" required>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Tanggal Bayar <span class="text-danger">*</span></label>
                        <input type="date" name="payment_date" class="form-control" value="{{ old('payment_date', date('Y-m-d')) }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Status Verifikasi <span class="text-danger">*</span></label>
                        <select name="status" class="form-select" required>
                            <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending (Menunggu)</option>
                            <option value="verified" {{ old('status', 'verified') == 'verified' ? 'selected' : '' }}>Verified (Lunas)</option>
                            <option value="rejected" {{ old('status') == 'rejected' ? 'selected' : '' }}>Rejected (Tolak)</option>
                        </select>
                        <div class="form-text">Jika diset ke Verified, status booking otomatis jadi Paid (Lunas).</div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Bukti Transfer (Opsional)</label>
                        <input type="file" name="payment_proof" class="form-control" accept="image/*">
                    </div>
                </div>

                <div class="col-12 mt-2">
                    <label class="form-label">Catatan Tambahan</label>
                    <textarea name="notes" class="form-control" rows="2">{{ old('notes') }}</textarea>
                </div>

                <div class="col-12 mt-4 text-end">
                    <button type="submit" class="btn btn-primary px-4"><i class="bi bi-save me-1"></i> Simpan Pembayaran</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    const amountInput = document.getElementById('amount');
    
    amountInput.addEventListener('keyup', function(e) {
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
    
    if(amountInput.value) {
        amountInput.value = formatRupiah(amountInput.value, 'Rp ');
    }
</script>
@endpush

