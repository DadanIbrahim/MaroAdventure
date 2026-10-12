@extends(request()->routeIs('superadmin.*') ? 'layouts.superadmin' : 'layouts.admin')

@section('title', 'Data Peserta & Member - Maro Adventure')
@section('page_title', 'Manajemen Peserta / Member')

@section('content')
<!-- Ringkasan Statistik Peserta -->
<div class="row g-4 mb-4">
    <div class="col-6 col-lg-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body d-flex align-items-center">
                <div class="bg-primary bg-opacity-10 text-primary p-3 rounded-3 me-3">
                    <i class="bi bi-people-fill fs-3"></i>
                </div>
                <div>
                    <h6 class="text-muted small mb-1">Total Member</h6>
                    <h4 class="mb-0 fw-bold">{{ number_format($totalUsers) }}</h4>
                </div>
            </div>
        </div>
    </div>
    <div class="col-6 col-lg-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body d-flex align-items-center">
                <div class="bg-success bg-opacity-10 text-success p-3 rounded-3 me-3">
                    <i class="bi bi-person-check-fill fs-3"></i>
                </div>
                <div>
                    <h6 class="text-muted small mb-1">Pernah Booking</h6>
                    <h4 class="mb-0 fw-bold">{{ number_format($totalTravelers) }}</h4>
                </div>
            </div>
        </div>
    </div>
    <div class="col-6 col-lg-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body d-flex align-items-center">
                <div class="bg-info bg-opacity-10 text-info p-3 rounded-3 me-3">
                    <i class="bi bi-ticket-detailed-fill fs-3"></i>
                </div>
                <div>
                    <h6 class="text-muted small mb-1">Total Transaksi</h6>
                    <h4 class="mb-0 fw-bold">{{ number_format($totalBookings) }}</h4>
                </div>
            </div>
        </div>
    </div>
    <div class="col-6 col-lg-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body d-flex align-items-center">
                <div class="bg-warning bg-opacity-10 text-warning p-3 rounded-3 me-3">
                    <i class="bi bi-coin fs-3"></i>
                </div>
                <div>
                    <h6 class="text-muted small mb-1">Total Poin Beredar</h6>
                    <h4 class="mb-0 fw-bold">{{ number_format($totalPoints) }}</h4>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Kartu Tabel Peserta -->
<div class="card border-0 shadow-sm">
    <div class="card-header bg-white py-3 d-flex flex-wrap justify-content-between align-items-center gap-3">
        <div>
            <h6 class="mb-0 fw-bold">Daftar Peserta & Pelanggan Maro Adventure</h6>
            <small class="text-muted">Total {{ $participants->total() }} member terdaftar</small>
        </div>

        <!-- Toolbar Pencarian & Filter -->
        <form method="GET" action="{{ url()->current() }}" class="d-flex flex-wrap align-items-center gap-2">
            <div class="input-group" style="max-width: 280px;">
                <span class="input-group-text bg-white border-end-0"><i class="bi bi-search text-muted"></i></span>
                <input type="text" name="search" class="form-control border-start-0 ps-0" 
                       placeholder="Cari nama, email, no HP..." value="{{ request('search') }}">
            </div>
            <button type="submit" class="btn btn-primary btn-sm px-3">
                <i class="bi bi-search me-1"></i> Cari
            </button>
            @if(request('search'))
                <a href="{{ url()->current() }}" class="btn btn-outline-secondary btn-sm" title="Reset Pencarian">
                    <i class="bi bi-x-circle"></i> Reset
                </a>
            @endif
        </form>
    </div>

    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-4">Peserta / User</th>
                        <th>Kontak & WhatsApp</th>
                        <th>Bergabung</th>
                        <th class="text-center">Total Trip</th>
                        <th class="text-center">Maro Points</th>
                        <th class="text-center">Status</th>
                        <th class="text-center pe-4">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($participants as $user)
                    <tr>
                        <!-- Profil & Nama -->
                        <td class="ps-4">
                            <div class="d-flex align-items-center">
                                <img src="{{ $user->avatar_url }}" alt="{{ $user->name }}" 
                                     class="rounded-circle me-3 border" style="width: 42px; height: 42px; object-fit: cover;">
                                <div>
                                    <div class="fw-bold text-dark">{{ $user->name }}</div>
                                    @if($user->role === 'superadmin')
                                        <span class="badge bg-danger-subtle text-danger" style="font-size: 0.72rem;">Superadmin</span>
                                    @elseif($user->role === 'admin')
                                        <span class="badge bg-primary-subtle text-primary" style="font-size: 0.72rem;">Admin</span>
                                    @else
                                        <span class="badge bg-secondary-subtle text-secondary" style="font-size: 0.72rem;">Member Maro</span>
                                    @endif
                                </div>
                            </div>
                        </td>

                        <!-- Kontak & WhatsApp -->
                        <td>
                            <div class="small mb-1">
                                <i class="bi bi-envelope text-muted me-1"></i>
                                <a href="mailto:{{ $user->email }}" class="text-decoration-none text-dark">{{ $user->email }}</a>
                            </div>
                            @if($user->phone)
                                @php
                                    $cleanPhone = preg_replace('/[^0-9]/', '', $user->phone);
                                    if (str_starts_with($cleanPhone, '0')) {
                                        $cleanPhone = '62' . substr($cleanPhone, 1);
                                    }
                                @endphp
                                <div class="small">
                                    <i class="bi bi-whatsapp text-success me-1"></i>
                                    <a href="https://wa.me/{{ $cleanPhone }}" target="_blank" class="text-success text-decoration-none fw-medium">
                                        {{ $user->phone }}
                                    </a>
                                </div>
                            @else
                                <div class="small text-muted fst-italic"><i class="bi bi-dash-circle me-1"></i>Belum ada nomor</div>
                            @endif
                        </td>

                        <!-- Tanggal Bergabung -->
                        <td>
                            <div class="small fw-semibold">{{ $user->created_at->format('d M Y') }}</div>
                            <div class="small text-muted" style="font-size: 0.75rem;">{{ $user->created_at->diffForHumans() }}</div>
                        </td>

                        <!-- Total Trip Booked -->
                        <td class="text-center">
                            @if($user->bookings_count > 0)
                                <span class="badge bg-primary-subtle text-primary px-3 py-2 fw-bold rounded-pill">
                                    <i class="bi bi-compass me-1"></i>{{ $user->bookings_count }} Trip
                                </span>
                            @else
                                <span class="badge bg-light text-muted px-2 py-1">0 Trip</span>
                            @endif
                        </td>

                        <!-- Saldo Poin -->
                        <td class="text-center">
                            <span class="fw-bold text-warning">
                                <i class="bi bi-coin me-1"></i>{{ number_format($user->points ?? 0) }}
                            </span>
                        </td>

                        <!-- Status Akun -->
                        <td class="text-center">
                            <span class="badge bg-success-subtle text-success border border-success-subtle px-2 py-1">
                                <i class="bi bi-check-circle-fill me-1"></i>Aktif
                            </span>
                        </td>

                        <!-- Aksi / Detail Modal -->
                        <td class="text-center pe-4">
                            <button type="button" class="btn btn-sm btn-outline-primary" 
                                    data-bs-toggle="modal" data-bs-target="#userModal{{ $user->id }}"
                                    title="Lihat Detail Peserta & Riwayat Booking">
                                <i class="bi bi-eye me-1"></i> Detail
                            </button>
                        </td>
                    </tr>

                    <!-- Modal Detail Peserta -->
                    <div class="modal fade" id="userModal{{ $user->id }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg">
                            <div class="modal-content border-0 shadow">
                                <div class="modal-header bg-light">
                                    <h5 class="modal-title fw-bold">
                                        <i class="bi bi-person-vcard text-primary me-2"></i>Rincian Profil Peserta
                                    </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body p-4">
                                    <!-- Header Info User -->
                                    <div class="d-flex align-items-center p-3 bg-light rounded-3 mb-4">
                                        <img src="{{ $user->avatar_url }}" alt="{{ $user->name }}" 
                                             class="rounded-circle me-3 border shadow-sm" style="width: 64px; height: 64px; object-fit: cover;">
                                        <div>
                                            <h5 class="fw-bold mb-1">{{ $user->name }}</h5>
                                            <div class="text-muted small mb-1">
                                                <i class="bi bi-envelope me-1"></i> {{ $user->email }} 
                                                @if($user->phone)
                                                    • <i class="bi bi-telephone ms-2 me-1"></i> {{ $user->phone }}
                                                @endif
                                            </div>
                                            <span class="badge bg-primary me-2">Maro Points: {{ number_format($user->points ?? 0) }}</span>
                                            <span class="badge bg-success">Total {{ $user->bookings_count }} Pemesanan</span>
                                        </div>
                                    </div>

                                    <!-- Riwayat Booking Peserta -->
                                    <h6 class="fw-bold mb-3"><i class="bi bi-ticket-perforated me-1 text-primary"></i> Riwayat Pemesanan Trip:</h6>
                                    @if($user->bookings->count() > 0)
                                        <div class="table-responsive border rounded-3">
                                            <table class="table table-sm table-striped align-middle mb-0">
                                                <thead class="table-light">
                                                    <tr>
                                                        <th>Kode</th>
                                                        <th>Paket Trip</th>
                                                        <th>Tanggal</th>
                                                        <th>Peserta</th>
                                                        <th>Total Biaya</th>
                                                        <th>Status</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($user->bookings as $booking)
                                                    <tr>
                                                        <td class="fw-bold text-primary">#{{ $booking->booking_code }}</td>
                                                        <td>{{ $booking->trip ? $booking->trip->name : ($booking->trip ? $booking->trip->title : 'Trip') }}</td>
                                                        <td>{{ \Carbon\Carbon::parse($booking->booking_date)->format('d M Y') }}</td>
                                                        <td>{{ $booking->participants }} Org</td>
                                                        <td class="fw-bold text-success">{{ $booking->formatted_price }}</td>
                                                        <td>{!! $booking->status_badge !!}</td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    @else
                                        <div class="text-center py-4 bg-light rounded-3 text-muted">
                                            <i class="bi bi-calendar-x fs-2 d-block mb-2"></i>
                                            Member ini belum melakukan pemesanan trip.
                                        </div>
                                    @endif
                                </div>
                                <div class="modal-footer bg-light py-2">
                                    @if($user->phone)
                                        <a href="https://wa.me/{{ $cleanPhone }}" target="_blank" class="btn btn-sm btn-success">
                                            <i class="bi bi-whatsapp me-1"></i> Hubungi WhatsApp
                                        </a>
                                    @endif
                                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-5 text-muted">
                            <i class="bi bi-people display-4 d-block mb-3 text-secondary opacity-50"></i>
                            <h6 class="fw-bold">Tidak ada data peserta ditemukan</h6>
                            @if(request('search'))
                                <p class="small mb-3">Tidak ada hasil yang cocok dengan kata kunci pencarian "{{ request('search') }}".</p>
                                <a href="{{ url()->current() }}" class="btn btn-sm btn-outline-primary">Tampilkan Semua Peserta</a>
                            @else
                                <p class="small mb-0">Belum ada user yang terdaftar dalam sistem.</p>
                            @endif
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Pagination -->
    @if($participants->hasPages())
    <div class="card-footer bg-white py-3 d-flex justify-content-between align-items-center">
        <small class="text-muted">
            Menampilkan {{ $participants->firstItem() }} sampai {{ $participants->lastItem() }} dari {{ $participants->total() }} peserta
        </small>
        <div>
            {{ $participants->links('pagination::bootstrap-5') }}
        </div>
    </div>
    @endif
</div>
@endsection