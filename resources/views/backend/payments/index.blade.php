@extends(request()->routeIs('superadmin.*') ? 'layouts.superadmin' : 'layouts.admin')
@section('title', 'Manajemen Pembayaran - ' . (request()->routeIs('superadmin.*') ? 'Superadmin' : 'Admin'))
@section('page_title', 'Verifikasi Pembayaran')

@section('content')
<div class="card border-0 shadow-sm">
    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
        <h6 class="mb-0 fw-bold">Daftar Pembayaran Masuk</h6>
        <a href="{{ route(request()->routeIs('superadmin.*') ? 'superadmin.payments.create' : 'admin.payments.create') }}" class="btn btn-sm btn-primary">
            <i class="bi bi-plus-lg me-1"></i> Tambah Manual
        </a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Kode Booking</th>
                        <th>Metode Bayar</th>
                        <th>Tanggal Bayar</th>
                        <th>Nominal</th>
                        <th>Status</th>
                        <th>Bukti</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($payments as $payment)
                    <tr>
                        <td>
                            @if($payment->booking)
                                <strong>{{ $payment->booking->booking_code }}</strong><br>
                                <small class="text-muted">{{ $payment->booking->customer_name }}</small>
                            @else
                                <span class="text-danger">Booking Dihapus</span>
                            @endif
                        </td>
                        <td>{{ $payment->payment_method }}</td>
                        <td>{{ \Carbon\Carbon::parse($payment->payment_date)->format('d M Y') }}</td>
                        <td class="fw-bold text-success">{{ $payment->formatted_amount }}</td>
                        <td>{!! $payment->status_badge !!}</td>
                        <td>
                            @if($payment->payment_proof)
                                <a href="{{ asset('storage/' . $payment->payment_proof) }}" target="_blank" class="btn btn-sm btn-outline-info">
                                    <i class="bi bi-eye"></i> Lihat
                                </a>
                            @else
                                <span class="text-muted small">Tidak ada</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <div class="btn-group">
                                <a href="{{ route(request()->routeIs('superadmin.*') ? 'superadmin.payments.edit' : 'admin.payments.edit', $payment->id) }}" class="btn btn-sm btn-outline-primary" title="Verifikasi/Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route(request()->routeIs('superadmin.*') ? 'superadmin.payments.destroy' : 'admin.payments.destroy', $payment->id) }}" method="POST" onsubmit="return confirm('Yakin menghapus data pembayaran ini?');" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" title="Hapus">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-4 text-muted">
                            <i class="bi bi-inbox fs-2 d-block mb-2"></i>
                            Belum ada data pembayaran.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

