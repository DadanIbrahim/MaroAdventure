@extends('layouts.app')

@section('title', 'Pemesanan Berhasil — Maro Adventure Indonesia')

@push('styles')
<style>
.checkout-hero {
    background: linear-gradient(135deg, var(--color-navy) 0%, var(--color-primary-dark) 100%);
    padding: 100px 0 50px;
    position: relative;
    overflow: hidden;
}

.checkout-stepper {
    background: #ffffff;
    border-radius: 16px;
    padding: 18px 24px;
    box-shadow: 0 4px 20px rgba(12, 74, 110, 0.06);
    margin-top: -30px;
    position: relative;
    z-index: 10;
}

.step-item {
    display: flex;
    align-items: center;
    gap: 12px;
    position: relative;
    flex: 1;
}

.step-icon {
    width: 38px;
    height: 38px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    font-size: 0.95rem;
}

.step-item.completed .step-icon {
    background: #10B981;
    color: #ffffff;
}

.step-title {
    font-size: 0.88rem;
    font-weight: 700;
    color: var(--color-navy);
    margin-bottom: 2px;
}

.step-desc {
    font-size: 0.75rem;
    color: #94A3B8;
}

.step-divider {
    flex: 0 0 40px;
    height: 2px;
    background: #10B981;
    margin: 0 10px;
}

@media (max-width: 768px) {
    .step-desc {
        display: none;
    }
    .step-divider {
        flex: 0 0 15px;
        margin: 0 5px;
    }
    .checkout-stepper {
        padding: 14px 16px;
    }
}
</style>
@endpush

@section('content')

<!-- ── HERO BANNER ── -->
<div class="checkout-hero text-white text-center">
    <div class="container">
        <h1 class="fw-bold mb-2">Reservasi Berhasil Dikirim</h1>
        <p class="text-white-50 mb-0" style="max-width: 550px; margin: 0 auto; font-size: 0.95rem;">
            Terima kasih! Permintaan pemesanan perjalanan outdoor Anda telah kami catat dalam sistem.
        </p>
    </div>
</div>

<div class="container pb-5">

    <!-- ── STEPPER ── -->
    <div class="checkout-stepper mb-5">
        <div class="d-flex align-items-center justify-content-between">
            
            <div class="step-item completed">
                <div class="step-icon">
                    <i class="bi bi-check-lg"></i>
                </div>
                <div class="step-content">
                    <div class="step-title">1. Data Pesanan</div>
                    <div class="step-desc">Tersimpan</div>
                </div>
            </div>

            <div class="step-divider"></div>

            <div class="step-item completed">
                <div class="step-icon">
                    <i class="bi bi-check-lg"></i>
                </div>
                <div class="step-content">
                    <div class="step-title">2. Pembayaran</div>
                    <div class="step-desc">Terkonfirmasi</div>
                </div>
            </div>

            <div class="step-divider"></div>

            <div class="step-item completed">
                <div class="step-icon">
                    <i class="bi bi-check-circle-fill"></i>
                </div>
                <div class="step-content">
                    <div class="step-title">3. Tiket Selesai</div>
                    <div class="step-desc">Siap diproses</div>
                </div>
            </div>

        </div>
    </div>

    <!-- ── SUCCESS CARD ── -->
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card border-0 shadow-sm rounded-4 p-4 p-md-5 text-center bg-white border">
                
                <!-- Success Icon -->
                <div class="d-inline-flex align-items-center justify-content-center rounded-circle bg-success bg-opacity-10 text-success mx-auto mb-4" style="width: 84px; height: 84px;">
                    <i class="bi bi-check-circle-fill" style="font-size: 3rem;"></i>
                </div>

                <!-- Texts -->
                <h3 class="fw-bold text-dark mb-1">Pemesanan Berhasil!</h3>
                <p class="text-muted mb-3 font-monospace fw-semibold" style="letter-spacing: 1px;">
                    ID BOOKING: <span class="text-primary">{{ $booking->booking_code ?? 'BKG-MARO-SUCCESS' }}</span>
                </p>

                <!-- Status Badge -->
                <div class="mb-4">
                    <span class="badge bg-warning-subtle text-warning-emphasis border border-warning-subtle rounded-pill px-3 py-2 fw-semibold">
                        <i class="bi bi-hourglass-split me-1"></i> Status: Menunggu Verifikasi Pembayaran
                    </span>
                </div>

                <!-- Detail Singkat -->
                @if($booking)
                <div class="bg-light rounded-3 p-3 text-start mb-4 border">
                    <div class="d-flex justify-content-between small text-muted mb-1">
                        <span>Paket Perjalanan:</span>
                        <strong class="text-dark">{{ $booking->trip->name ?? 'Trip Pilihan' }}</strong>
                    </div>
                    <div class="d-flex justify-content-between small text-muted mb-1">
                        <span>Tanggal Berangkat:</span>
                        <span class="text-dark fw-medium">{{ date('d M Y', strtotime($booking->booking_date)) }}</span>
                    </div>
                    <div class="d-flex justify-content-between small text-muted mb-1">
                        <span>Peserta:</span>
                        <span class="text-dark fw-medium">{{ $booking->participants }} Orang</span>
                    </div>
                    <div class="d-flex justify-content-between small text-muted pt-2 border-top mt-2">
                        <span>Total Biaya:</span>
                        <strong class="text-primary fs-6">{{ $booking->formatted_price }}</strong>
                    </div>
                </div>
                @endif

                <p class="small text-muted mb-4">
                    Pemberitahuan invoice dan undangan grup koordinasi briefing pendakian akan dikirimkan ke nomor WhatsApp Anda.
                </p>

                <!-- Actions -->
                <div class="d-flex flex-column flex-sm-row justify-content-center gap-3">
                    @auth
                        <a href="{{ route('dashboard.bookings') }}" class="btn btn-primary px-4 py-2 fw-bold rounded-2">
                            <i class="bi bi-journal-text me-1"></i> Riwayat Booking
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-primary px-4 py-2 fw-bold rounded-2">
                            <i class="bi bi-box-arrow-in-right me-1"></i> Masuk Akun Anda
                        </a>
                    @endauth
                    <a href="{{ url('/') }}" class="btn btn-outline-secondary px-4 py-2 fw-semibold rounded-2">
                        <i class="bi bi-house me-1"></i> Kembali ke Beranda
                    </a>
                </div>

            </div>
        </div>
    </div>

</div>
@endsection
