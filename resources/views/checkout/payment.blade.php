@extends('layouts.app')

@section('title', 'Pembayaran Pemesanan — Maro Adventure Indonesia')

@push('styles')
<style>
/* ── Page Hero ── */
.checkout-hero {
    background: linear-gradient(135deg, var(--color-navy) 0%, var(--color-primary-dark) 100%);
    padding: 110px 0 50px;
    position: relative;
    overflow: hidden;
}

.checkout-hero::before {
    content: '';
    position: absolute;
    top: -50%;
    right: -10%;
    width: 450px;
    height: 450px;
    background: radial-gradient(circle, rgba(56,189,248,0.12) 0%, transparent 70%);
    border-radius: 50%;
}

.checkout-badge {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: rgba(255,255,255,0.12);
    border: 1px solid rgba(255,255,255,0.2);
    border-radius: 50px;
    padding: 6px 16px;
    color: #38BDF8;
    font-size: 0.85rem;
    font-weight: 600;
}

/* ── Stepper ── */
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
    transition: all 0.3s ease;
}

.step-item.active .step-icon {
    background: var(--color-primary);
    color: #ffffff;
    box-shadow: 0 0 0 4px rgba(14, 165, 233, 0.2);
}

.step-item.completed .step-icon {
    background: #10B981;
    color: #ffffff;
}

.step-item.upcoming .step-icon {
    background: #E2E8F0;
    color: #64748B;
}

.step-content {
    line-height: 1.2;
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
    background: #E2E8F0;
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

/* ── Payment Cards ── */
.payment-card {
    background: #ffffff;
    border-radius: 18px;
    padding: 28px;
    box-shadow: 0 4px 20px rgba(12, 74, 110, 0.05);
    border: 1px solid #E2E8F0;
    margin-bottom: 24px;
}

.bank-row {
    background: #F8FAFC;
    border: 1.5px solid #E2E8F0;
    border-radius: 12px;
    padding: 16px 20px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 14px;
    transition: all 0.2s ease;
}

.bank-row:hover {
    border-color: var(--color-primary);
    background: #F0F9FF;
}

.bank-badge {
    font-weight: 800;
    padding: 6px 12px;
    border-radius: 8px;
    font-size: 0.95rem;
    display: inline-block;
}

.countdown-box {
    background: #FFFBEB;
    border: 1.5px solid #FDE68A;
    border-radius: 14px;
    padding: 16px 20px;
    color: #92400E;
    font-size: 0.9rem;
}
</style>
@endpush

@section('content')

<!-- ── HERO BANNER ── -->
<div class="checkout-hero text-white">
    <div class="container text-center">
        <div class="checkout-badge mb-3">
            <i class="bi bi-clock-history"></i>
            Menunggu Penyelesaian Pembayaran
        </div>
        <h1 class="fw-bold mb-2">Instruksi Pembayaran</h1>
        <p class="text-white-50 mb-0" style="max-width: 600px; margin: 0 auto; font-size: 0.95rem;">
            Silakan transfer tepat sesuai nominal yang tertera agar pemesanan terverifikasi otomatis.
        </p>
    </div>
</div>

<div class="container pb-5">

    <!-- ── STEPPER ── -->
    <div class="checkout-stepper mb-4">
        <div class="d-flex align-items-center justify-content-between">
            
            <!-- Step 1 (Completed) -->
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

            <!-- Step 2 (Active) -->
            <div class="step-item active">
                <div class="step-icon">
                    <i class="bi bi-credit-card"></i>
                </div>
                <div class="step-content">
                    <div class="step-title">2. Pembayaran</div>
                    <div class="step-desc">Transfer & verifikasi</div>
                </div>
            </div>

            <div class="step-divider"></div>

            <!-- Step 3 (Upcoming) -->
            <div class="step-item upcoming">
                <div class="step-icon">
                    <i class="bi bi-check-circle"></i>
                </div>
                <div class="step-content">
                    <div class="step-title">3. Tiket Selesai</div>
                    <div class="step-desc">Konfirmasi & e-ticket</div>
                </div>
            </div>

        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show rounded-3 mb-4" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row g-4">

        <!-- ── LEFT COLUMN: METODE PEMBAYARAN ── -->
        <div class="col-lg-8">

            <!-- Countdown Alert -->
            <div class="countdown-box mb-4 d-flex align-items-center justify-content-between flex-wrap gap-2">
                <div class="d-flex align-items-center gap-2">
                    <i class="bi bi-exclamation-triangle-fill fs-5 text-warning"></i>
                    <span>Selesaikan pembayaran dalam: <strong id="timerDisplay">23 jam 59 menit 40 detik</strong></span>
                </div>
                <span class="badge bg-warning text-dark fw-bold px-3 py-2">Menunggu Transfer</span>
            </div>

            <!-- Pilihan Rekening Bank -->
            <div class="payment-card">
                <h4 class="fw-bold text-dark mb-1">Transfer Bank (Verifikasi Manual/Otomatis)</h4>
                <p class="text-muted small mb-4">Transfer dari bank mana pun ke salah satu rekening resmi Maro Adventure Indonesia berikut:</p>

                <!-- BCA -->
                <div class="bank-row">
                    <div class="d-flex align-items-center gap-3">
                        <span class="bank-badge bg-primary text-white">BCA</span>
                        <div>
                            <div class="fw-bold text-dark" style="font-size: 1.05rem;">8420-9988-12</div>
                            <div class="text-muted small">a/n PT Maro Adventure Indonesia</div>
                        </div>
                    </div>
                    <button type="button" class="btn btn-outline-primary btn-sm px-3 copy-btn" data-clipboard="8420998812">
                        <i class="bi bi-copy me-1"></i> Salin
                    </button>
                </div>

                <!-- Mandiri -->
                <div class="bank-row">
                    <div class="d-flex align-items-center gap-3">
                        <span class="bank-badge bg-warning text-dark">Mandiri</span>
                        <div>
                            <div class="fw-bold text-dark" style="font-size: 1.05rem;">1300-0987-65432</div>
                            <div class="text-muted small">a/n PT Maro Adventure Indonesia</div>
                        </div>
                    </div>
                    <button type="button" class="btn btn-outline-primary btn-sm px-3 copy-btn" data-clipboard="1300098765432">
                        <i class="bi bi-copy me-1"></i> Salin
                    </button>
                </div>

                <!-- BRI -->
                <div class="bank-row">
                    <div class="d-flex align-items-center gap-3">
                        <span class="bank-badge bg-info text-white">BRI</span>
                        <div>
                            <div class="fw-bold text-dark" style="font-size: 1.05rem;">0341-0100-2233-509</div>
                            <div class="text-muted small">a/n Maro Adventure Group</div>
                        </div>
                    </div>
                    <button type="button" class="btn btn-outline-primary btn-sm px-3 copy-btn" data-clipboard="034101002233509">
                        <i class="bi bi-copy me-1"></i> Salin
                    </button>
                </div>
            </div>

            <!-- QRIS & E-Wallet Option -->
            <div class="payment-card">
                <h4 class="fw-bold text-dark mb-1">Pembayaran Instan QRIS</h4>
                <p class="text-muted small mb-3">Mendukung GoPay, OVO, ShopeePay, Dana, LinkAja, BCA Mobile, Livin', dan semua aplikasi QRIS.</p>

                <div class="text-center p-4 bg-light rounded-3 border">
                    <div class="d-inline-block p-3 bg-white rounded-3 shadow-sm mb-3">
                        <img 
                            src="https://api.qrserver.com/v1/create-qr-code/?size=180x180&data=MARO-{{ $booking->booking_code ?? 'TEST' }}" 
                            alt="QRIS Code Maro Adventure" 
                            class="img-fluid" 
                            style="width: 180px; height: 180px;"
                        />
                    </div>
                    <div class="small text-muted">
                        NMID: ID1020098765432 • <strong>Maro Adventure Outdoor</strong>
                    </div>
                </div>
            </div>

            <!-- Panduan & Aksi Konfirmasi -->
            <div class="payment-card bg-light border-0">
                <div class="d-flex flex-column flex-sm-row gap-3">
                    <a 
                        href="{{ route('checkout.success', ['booking_code' => $booking->booking_code ?? '']) }}" 
                        class="btn btn-primary btn-lg flex-grow-1 fw-bold py-3 shadow-sm text-center"
                    >
                        <i class="bi bi-check2-circle me-1"></i> Saya Sudah Transfer
                    </a>
                    
                    <a 
                        href="https://wa.me/6285894535172?text=Halo%20Maro%20Adventure%2C%20saya%20sudah%20melakukan%20pembayaran%20untuk%20Booking%20ID%3A%20{{ $booking->booking_code ?? '' }}." 
                        target="_blank" 
                        class="btn btn-success btn-lg fw-bold py-3 px-4 shadow-sm text-center"
                    >
                        <i class="bi bi-whatsapp me-1"></i> Konfirmasi WA
                    </a>
                </div>
            </div>

        </div>

        <!-- ── RIGHT COLUMN: RINGKASAN ORDER ── -->
        <div class="col-lg-4">

            <div class="payment-card">
                <h5 class="fw-bold text-dark mb-3">Detail Pesanan</h5>

                <div class="mb-3 pb-3 border-bottom">
                    <span class="small text-muted d-block">Kode Booking (Penting):</span>
                    <div class="d-flex align-items-center justify-content-between mt-1">
                        <span class="fw-bold font-monospace fs-5 text-dark">{{ $booking->booking_code ?? 'BKG-MARO-SAMPLE' }}</span>
                        <button type="button" class="btn btn-light btn-sm border copy-btn" data-clipboard="{{ $booking->booking_code ?? 'BKG-MARO-SAMPLE' }}">
                            <i class="bi bi-copy"></i>
                        </button>
                    </div>
                </div>

                <div class="mb-3 pb-3 border-bottom">
                    <span class="small text-muted d-block">Paket Perjalanan:</span>
                    <strong class="text-dark">{{ $booking->trip->name ?? 'Burangrang Weekend Camp' }}</strong>
                    <div class="text-muted small mt-1">
                        <i class="bi bi-geo-alt me-1"></i> {{ $booking->trip->mountain->name ?? 'Gunung Burangrang' }}
                    </div>
                </div>

                <div class="mb-3 pb-3 border-bottom">
                    <span class="small text-muted d-block">Ketua Rombongan:</span>
                    <strong class="text-dark">{{ $booking->customer_name ?? auth()->user()->name ?? 'Pendaki' }}</strong>
                    <div class="text-muted small">{{ $booking->customer_phone ?? '-' }}</div>
                </div>

                <div class="d-flex justify-content-between mb-2 small text-muted">
                    <span>Tanggal Keberangkatan</span>
                    <span class="text-dark fw-medium">{{ $booking ? date('d M Y', strtotime($booking->booking_date)) : date('d M Y') }}</span>
                </div>

                <div class="d-flex justify-content-between mb-3 small text-muted">
                    <span>Jumlah Peserta</span>
                    <span class="badge bg-secondary-subtle text-secondary">{{ $booking->participants ?? 1 }} Pax</span>
                </div>

                <hr class="text-secondary opacity-25">

                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div>
                        <span class="small text-muted d-block">Total Tagihan:</span>
                        <span class="small text-success fw-medium">Bebas Biaya Admin</span>
                    </div>
                    <span class="fs-4 fw-bold text-primary">
                        {{ $booking ? $booking->formatted_price : 'Rp 350.000' }}
                    </span>
                </div>

                <div class="alert alert-info py-2 px-3 small rounded-3 mb-0">
                    <i class="bi bi-info-circle me-1"></i> Tiket elektronik akan diterbitkan otomatis setelah konfirmasi kami terima.
                </div>
            </div>

        </div>

    </div>

</div>

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    // Copy button
    document.querySelectorAll('.copy-btn').forEach(button => {
        button.addEventListener('click', function () {
            const textToCopy = this.getAttribute('data-clipboard');
            if (navigator.clipboard) {
                navigator.clipboard.writeText(textToCopy).then(() => {
                    const originalHtml = this.innerHTML;
                    this.innerHTML = '<i class="bi bi-check2"></i> Disalin!';
                    this.classList.add('btn-success');
                    this.classList.remove('btn-outline-primary', 'btn-light');
                    setTimeout(() => {
                        this.innerHTML = originalHtml;
                        this.classList.remove('btn-success');
                        if (this.getAttribute('data-clipboard').length > 15) {
                            this.classList.add('btn-light');
                        } else {
                            this.classList.add('btn-outline-primary');
                        }
                    }, 2000);
                });
            }
        });
    });

    // Countdown Timer (24 hours)
    let totalSeconds = 24 * 60 * 60 - 20;
    const timerDisplay = document.getElementById('timerDisplay');
    if (timerDisplay) {
        setInterval(() => {
            if (totalSeconds <= 0) return;
            totalSeconds--;
            const hours = Math.floor(totalSeconds / 3600);
            const minutes = Math.floor((totalSeconds % 3600) / 60);
            const seconds = totalSeconds % 60;
            timerDisplay.textContent = `${hours} jam ${minutes} menit ${seconds} detik`;
        }, 1000);
    }
});
</script>
@endpush

