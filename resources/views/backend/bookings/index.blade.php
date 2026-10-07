@extends(request()->routeIs('superadmin.*') ? 'layouts.superadmin' : 'layouts.admin')
@section('title', 'Manajemen Booking - ' . (request()->routeIs('superadmin.*') ? 'Superadmin' : 'Admin'))
@section('page_title', 'Data Pemesanan (Booking)')

@section('content')
<div class="card border-0 shadow-sm">
    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
        <h6 class="mb-0 fw-bold">Daftar Booking Terbaru</h6>
        <a href="{{ route(request()->routeIs('superadmin.*') ? 'superadmin.bookings.create' : 'admin.bookings.create') }}" class="btn btn-sm btn-primary">
            <i class="bi bi-plus-lg me-1"></i> Tambah Booking
        </a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Kode</th>
                        <th>Pelanggan</th>
                        <th>Trip</th>
                        <th>Tanggal</th>
                        <th>Peserta</th>
                        <th>Total Harga</th>
                        <th>Status Booking</th>
                        <th>Pembayaran</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($bookings as $booking)
                    <tr>
                        <td><strong>{{ $booking->booking_code }}</strong></td>
                        <td>
                            {{ $booking->customer_name }}
                            @if($booking->customer_phone)
                                <br><small class="text-muted"><i class="bi bi-telephone"></i> {{ $booking->customer_phone }}</small>
                            @endif
                        </td>
                        <td>{{ $booking->trip ? $booking->trip->name : '-' }}</td>
                        <td>{{ \Carbon\Carbon::parse($booking->booking_date)->format('d M Y') }}</td>
                        <td>{{ $booking->participants }} Orang</td>
                        <td class="fw-bold text-success">{{ $booking->formatted_price }}</td>
                        <td>{!! $booking->status_badge !!}</td>
                        <td>{!! $booking->payment_badge !!}</td>
                        <td class="text-center">
                            <div class="btn-group">
                                <a href="{{ route(request()->routeIs('superadmin.*') ? 'superadmin.bookings.edit' : 'admin.bookings.edit', $booking->id) }}" class="btn btn-sm btn-outline-primary" title="Edit/Update Status">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route(request()->routeIs('superadmin.*') ? 'superadmin.bookings.destroy' : 'admin.bookings.destroy', $booking->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data booking ini?');" style="display:inline;">
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
                        <td colspan="9" class="text-center py-4 text-muted">
                            <i class="bi bi-inbox fs-2 d-block mb-2"></i>
                            Belum ada data pesanan (booking).
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

