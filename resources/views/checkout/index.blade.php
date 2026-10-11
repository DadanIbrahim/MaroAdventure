@extends('layouts.app')

@section('title', 'Checkout Pemesanan Trip — Maro Adventure Indonesia')

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

.step-item.upcoming .step-title {
    color: #64748B;
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

/* ── Section Cards ── */
.form-card {
    background: #ffffff;
    border-radius: 18px;
    padding: 28px;
    box-shadow: 0 4px 20px rgba(12, 74, 110, 0.05);
    border: 1px solid #E2E8F0;
    margin-bottom: 24px;
    transition: all 0.3s ease;
}

.form-card:hover {
    border-color: #CBD5E1;
}

.card-heading {
    display: flex;
    align-items: center;
    gap: 12px;
    margin-bottom: 20px;
    padding-bottom: 14px;
    border-bottom: 1px solid #F1F5F9;
}

.card-heading-icon {
    width: 38px;
    height: 38px;
    border-radius: 10px;
    background: var(--color-accent-light);
    color: var(--color-primary-dark);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.15rem;
}

.card-heading-title {
    font-size: 1.1rem;
    font-weight: 700;
    color: var(--color-navy);
    margin: 0;
}

.form-label {
    font-size: 0.88rem;
    font-weight: 600;
    color: #334155;
    margin-bottom: 6px;
}

.form-control, .form-select {
    border-radius: 10px;
    border: 1.5px solid #CBD5E1;
    padding: 10px 14px;
    font-size: 0.92rem;
    color: #1E293B;
    transition: all 0.2s ease;
}

.form-control:focus, .form-select:focus {
    border-color: var(--color-primary);
    box-shadow: 0 0 0 3px rgba(14, 165, 233, 0.15);
}

/* ── Counter Control ── */
.participant-counter-box {
    display: inline-flex;
    align-items: center;
    border: 1.5px solid #CBD5E1;
    border-radius: 12px;
    overflow: hidden;
    background: #ffffff;
}

.counter-btn {
    width: 44px;
    height: 44px;
    border: none;
    background: #F8FAFC;
    color: var(--color-navy);
    font-size: 1.2rem;
    font-weight: bold;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.2s ease;
}

.counter-btn:hover:not(:disabled) {
    background: var(--color-accent-light);
    color: var(--color-primary-dark);
}

.counter-btn:disabled {
    opacity: 0.4;
    cursor: not-allowed;
}

.counter-input {
    width: 65px;
    height: 44px;
    border: none;
    text-align: center;
    font-size: 1.15rem;
    font-weight: 700;
    color: var(--color-navy);
    outline: none;
}

/* ── Trip Preview Box ── */
.trip-preview-card {
    background: #F0F9FF;
    border: 1.5px solid #BAE6FD;
    border-radius: 14px;
    padding: 18px;
    display: flex;
    align-items: center;
    gap: 18px;
}

.trip-preview-thumb {
    width: 80px;
    height: 80px;
    border-radius: 12px;
    object-fit: cover;
    flex-shrink: 0;
}

/* ── Sticky Order Summary ── */
.sticky-summary {
    position: sticky;
    top: 90px;
    background: #ffffff;
    border-radius: 20px;
    padding: 26px;
    box-shadow: 0 10px 30px rgba(12, 74, 110, 0.08);
    border: 1.5px solid #E2E8F0;
}

.summary-thumb {
    width: 100%;
    height: 160px;
    border-radius: 14px;
    object-fit: cover;
    margin-bottom: 16px;
}

.summary-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 12px;
    font-size: 0.9rem;
    color: #475569;
}

.summary-row.total {
    border-top: 1.5px dashed #CBD5E1;
    padding-top: 16px;
    margin-top: 16px;
    margin-bottom: 20px;
}

.price-total-badge {
    font-size: 1.45rem;
    font-weight: 800;
    color: var(--color-primary-dark);
}

/* ── Inclusions List ── */
.inclusion-list {
    list-style: none;
    padding: 0;
    margin: 16px 0 0;
}

.inclusion-list li {
    font-size: 0.82rem;
    color: #475569;
    display: flex;
    align-items: center;
    gap: 8px;
    margin-bottom: 8px;
}
</style>
@endpush

@section('content')

<!-- ── HERO BANNER ── -->
<div class="checkout-hero text-white">
    <div class="container text-center">
        <div class="checkout-badge mb-3">
            <i class="bi bi-shield-check"></i>
            Jaminan Reservasi Resmi & Berasuransi
        </div>
        <h1 class="fw-bold mb-2">Checkout Petualangan</h1>
        <p class="text-white-50 mb-0" style="max-width: 600px; margin: 0 auto; font-size: 0.95rem;">
            Lengkapi data pendakianmu, tentukan tanggal keberangkatan, dan amankan slot perjalanan outdoor bersama Maro Adventure.
        </p>
    </div>
</div>

<div class="container pb-5">

    <!-- ── STEPPER ── -->
    <div class="checkout-stepper mb-4">
        <div class="d-flex align-items-center justify-content-between">
            
            <!-- Step 1 (Active) -->
            <div class="step-item active">
                <div class="step-icon">
                    <i class="bi bi-person-lines-fill"></i>
                </div>
                <div class="step-content">
                    <div class="step-title">1. Data Pesanan</div>
                    <div class="step-desc">Detail trip & pendaki</div>
                </div>
            </div>

            <div class="step-divider"></div>

            <!-- Step 2 (Upcoming) -->
            <div class="step-item upcoming">
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

    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show rounded-3 mb-4" role="alert">
            <div class="d-flex align-items-center gap-2 mb-1">
                <i class="bi bi-exclamation-triangle-fill fs-5"></i>
                <strong class="fw-bold">Mohon periksa kembali formulir Anda:</strong>
            </div>
            <ul class="mb-0 ps-4 small">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- ── MAIN CHECKOUT GRID ── -->
    <form action="{{ route('checkout.store') }}" method="POST" id="checkoutForm">
        @csrf

        <div class="row g-4">

            <!-- ── LEFT COLUMN: FORMS ── -->
            <div class="col-lg-8">

                <!-- CARD 1: PAKET TRIP -->
                <div class="form-card">
                    <div class="card-heading">
                        <div class="card-heading-icon">
                            <i class="bi bi-compass-fill"></i>
                        </div>
                        <div>
                            <h2 class="card-heading-title">1. Pilih Paket Petualangan</h2>
                            <p class="text-muted small mb-0">Tentukan rute destinasi yang ingin kamu jelajahi bersama tim Maro.</p>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="tripSelect" class="form-label">Paket Perjalanan <span class="text-danger">*</span></label>
                        <select 
                            name="trip_id" 
                            id="tripSelect" 
                            class="form-select form-select-lg fw-semibold"
                            required
                        >
                            @foreach($trips as $t)
                                <option 
                                    value="{{ $t->id }}"
                                    data-price="{{ $t->price }}"
                                    data-duration="{{ $t->duration ?? '2 Hari 1 Malam' }}"
                                    data-mountain="{{ $t->mountain->name ?? 'Gunung Indonesia' }}"
                                    data-elevation="{{ $t->mountain->elevation ?? '2000' }}"
                                    data-location="{{ $t->mountain->location ?? 'Indonesia' }}"
                                    data-image="{{ $t->image ? asset('storage/' . $t->image) : asset('assets/images/destinasi/burangrang.jpg') }}"
                                    {{ (old('trip_id', $selectedTrip->id ?? '') == $t->id) ? 'selected' : '' }}
                                >
                                    {{ $t->name }} ({{ $t->mountain->name ?? 'Pegunungan' }}) — Rp {{ number_format($t->price, 0, ',', '.') }} / orang
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Selected Trip Live Preview -->
                    <div class="trip-preview-card mt-3">
                        <img 
                            src="{{ ($selectedTrip && $selectedTrip->image) ? asset('storage/'.$selectedTrip->image) : asset('assets/images/destinasi/burangrang.jpg') }}" 
                            alt="Trip Preview" 
                            id="tripPreviewThumb"
                            class="trip-preview-thumb shadow-sm"
                            onerror="this.src='https://images.unsplash.com/photo-1464822759023-fed622ff2c3b?auto=format&fit=crop&w=300&q=80'"
                        />
                        <div class="flex-grow-1">
                            <div class="d-flex flex-wrap align-items-center gap-2 mb-1">
                                <span class="badge bg-primary-subtle text-primary fw-bold" id="tripBadgeDuration">
                                    <i class="bi bi-clock me-1"></i> {{ $selectedTrip->duration ?? '2 Hari 1 Malam' }}
                                </span>
                                <span class="badge bg-secondary-subtle text-secondary fw-semibold" id="tripBadgeElevation">
                                    <i class="bi bi-triangle me-1"></i> {{ $selectedTrip->mountain->elevation ?? 2050 }} MDPL
                                </span>
                            </div>
                            <h5 class="fw-bold text-dark mb-1" id="tripPreviewTitle">
                                {{ $selectedTrip->name ?? 'Trip Pilihan' }}
                            </h5>
                            <div class="text-muted small" id="tripPreviewLocation">
                                <i class="bi bi-geo-alt-fill text-danger me-1"></i> {{ $selectedTrip->mountain->name ?? 'Gunung Burangrang' }}, {{ $selectedTrip->mountain->location ?? 'Jawa Barat' }}
                            </div>
                        </div>
                    </div>
                </div>

                <!-- CARD 2: JADWAL & JUMLAH PESERTA -->
                <div class="form-card">
                    <div class="card-heading">
                        <div class="card-heading-icon">
                            <i class="bi bi-calendar2-week-fill"></i>
                        </div>
                        <div>
                            <h2 class="card-heading-title">2. Jadwal & Jumlah Peserta</h2>
                            <p class="text-muted small mb-0">Pilih tanggal keberangkatan dan tentukan jumlah anggota rombongan.</p>
                        </div>
                    </div>

                    <div class="row g-3">
                        <!-- Tanggal Keberangkatan -->
                        <div class="col-md-6">
                            <label for="booking_date" class="form-label">Tanggal Mulai Pendakian <span class="text-danger">*</span></label>
                            <input 
                                type="date" 
                                name="booking_date" 
                                id="booking_date" 
                                class="form-control form-control-lg"
                                min="{{ date('Y-m-d') }}"
                                value="{{ old('booking_date', date('Y-m-d', strtotime('+3 days'))) }}"
                                required
                            />
                            <div class="form-text small">Paling lambat reservasi H-2 sebelum keberangkatan.</div>
                        </div>

                        <!-- Jumlah Peserta Counter -->
                        <div class="col-md-6">
                            <label class="form-label">Jumlah Peserta (Pendaki) <span class="text-danger">*</span></label>
                            <div class="d-flex align-items-center gap-3">
                                <div class="participant-counter-box">
                                    <button type="button" class="counter-btn" id="btnMinus" aria-label="Kurangi Peserta">
                                        <i class="bi bi-dash"></i>
                                    </button>
                                    <input 
                                        type="number" 
                                        name="participants" 
                                        id="participantsInput" 
                                        class="counter-input" 
                                        value="{{ old('participants', 1) }}" 
                                        min="1" 
                                        max="50"
                                        required
                                        readonly
                                    />
                                    <button type="button" class="counter-btn" id="btnPlus" aria-label="Tambah Peserta">
                                        <i class="bi bi-plus"></i>
                                    </button>
                                </div>
                                <div>
                                    <span class="badge bg-light text-dark border px-3 py-2 fw-medium" id="paxCounterBadge">
                                        1 Orang Pendaki
                                    </span>
                                </div>
                            </div>
                            <div class="form-text small mt-1">
                                Butuh rombongan > 50 orang? Hubungi kami untuk program Corporate / Komunitas.
                            </div>
                        </div>
                    </div>
                </div>

                <!-- CARD 3: DATA KETUA ROMBONGAN -->
                <div class="form-card">
                    <div class="card-heading">
                        <div class="card-heading-icon">
                            <i class="bi bi-person-badge-fill"></i>
                        </div>
                        <div>
                            <h2 class="card-heading-title">3. Data Pemesan Utama (Ketua Rombongan)</h2>
                            <p class="text-muted small mb-0">Tiket elektronik, panduan logistik (packing list), dan koordinasi grup WA akan dikirim ke kontak ini.</p>
                        </div>
                    </div>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="customer_name" class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                            <input 
                                type="text" 
                                name="customer_name" 
                                id="customer_name" 
                                class="form-control"
                                placeholder="Contoh: Dadan Ibrahim"
                                value="{{ old('customer_name', auth()->user()->name ?? '') }}"
                                required
                            />
                        </div>

                        <div class="col-md-6">
                            <label for="customer_phone" class="form-label">Nomor WhatsApp Aktif <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0 fw-semibold text-muted">
                                    <i class="bi bi-whatsapp text-success me-1"></i> +62
                                </span>
                                <input 
                                    type="tel" 
                                    name="customer_phone" 
                                    id="customer_phone" 
                                    class="form-control border-start-0 ps-1"
                                    placeholder="85894535172"
                                    value="{{ old('customer_phone', auth()->user()->phone ?? '') }}"
                                    required
                                />
                            </div>
                            <div class="form-text small">Digunakan untuk konfirmasi tiket dan undangan grup pendakian.</div>
                        </div>

                        <div class="col-md-12">
                            <label class="form-label">Alamat Email Terdaftar</label>
                            <input 
                                type="email" 
                                class="form-control bg-light" 
                                value="{{ auth()->user()->email ?? '-' }}" 
                                readonly
                            />
                            <div class="form-text small">Salinan invoice & e-voucher otomatis dikirimkan ke email akun Anda.</div>
                        </div>
                    </div>
                </div>

                <!-- CARD 4: KONTAK DARURAT & CATATAN MEDIS -->
                <div class="form-card">
                    <div class="card-heading">
                        <div class="card-heading-icon">
                            <i class="bi bi-heart-pulse-fill"></i>
                        </div>
                        <div>
                            <h2 class="card-heading-title">4. Kontak Darurat & Catatan Khusus</h2>
                            <p class="text-muted small mb-0">Prosedur standar keamanan outdoor & asuransi pendakian resmi Maro Adventure.</p>
                        </div>
                    </div>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="emergency_name" class="form-label">Nama Kontak Darurat (Keluarga / Kerabat)</label>
                            <input 
                                type="text" 
                                name="emergency_name" 
                                id="emergency_name" 
                                class="form-control"
                                placeholder="Contoh: Siti Rahma (Ibu / Kakak)"
                                value="{{ old('emergency_name') }}"
                            />
                        </div>

                        <div class="col-md-6">
                            <label for="emergency_phone" class="form-label">Nomor Telepon Kontak Darurat</label>
                            <input 
                                type="tel" 
                                name="emergency_phone" 
                                id="emergency_phone" 
                                class="form-control"
                                placeholder="Contoh: 08123456789"
                                value="{{ old('emergency_phone') }}"
                            />
                        </div>

                        <div class="col-12">
                            <label for="notes" class="form-label">Catatan Tambahan / Riwayat Kesehatan / Alergi</label>
                            <textarea 
                                name="notes" 
                                id="notes" 
                                class="form-control" 
                                rows="3"
                                placeholder="Contoh: Ada 1 peserta vegetarian, butuh sewa sleeping bag ekstra, atau riwayat asma ringan."
                            >{{ old('notes') }}</textarea>
                            <div class="form-text small">Bantu tim pemandu kami menyiapkan menu konsumsi dan obat-obatan yang tepat.</div>
                        </div>
                    </div>
                </div>

                <!-- CARD 5: PERSETUJUAN & SYARAT -->
                <div class="form-card bg-light border-0">
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" id="agreeTerms" required checked>
                        <label class="form-check-label small text-secondary" for="agreeTerms">
                            Saya telah membaca dan menyetujui <strong>SOP Pendakian & Regulasi Keselamatan</strong> Maro Adventure Indonesia serta bersedia mengikuti arahan Certified Guide sepanjang trip.
                        </label>
                    </div>

                    <div class="d-none d-lg-block">
                        <button type="submit" class="btn btn-primary btn-lg w-100 fw-bold py-3 shadow-sm d-flex align-items-center justify-content-center gap-2">
                            <i class="bi bi-shield-lock-fill"></i>
                            Lanjut ke Pembayaran
                            <i class="bi bi-arrow-right"></i>
                        </button>
                    </div>
                </div>

            </div>

            <!-- ── RIGHT COLUMN: STICKY ORDER SUMMARY ── -->
            <div class="col-lg-4">

                <div class="sticky-summary">

                    <h4 class="fw-bold text-dark mb-3">Ringkasan Pesanan</h4>

                    <!-- Summary Trip Image -->
                    <img 
                        src="{{ ($selectedTrip && $selectedTrip->image) ? asset('storage/'.$selectedTrip->image) : asset('assets/images/destinasi/burangrang.jpg') }}" 
                        alt="Summary Trip" 
                        id="summaryTripThumb"
                        class="summary-thumb shadow-sm"
                        onerror="this.src='https://images.unsplash.com/photo-1464822759023-fed622ff2c3b?auto=format&fit=crop&w=600&q=80'"
                    />

                    <!-- Trip Title & Destination -->
                    <div class="mb-3">
                        <h5 class="fw-bold text-dark mb-1" id="summaryTripName">
                            {{ $selectedTrip->name ?? 'Trip Pilihan' }}
                        </h5>
                        <div class="text-muted small">
                            <i class="bi bi-geo-alt text-primary me-1"></i>
                            <span id="summaryMountainLocation">
                                {{ $selectedTrip->mountain->name ?? 'Gunung Burangrang' }}
                            </span>
                        </div>
                    </div>

                    <hr class="my-3 text-secondary opacity-25">

                    <!-- Breakdown items -->
                    <div class="summary-row">
                        <span>Tanggal Berangkat</span>
                        <strong class="text-dark" id="summaryDateDisplay">
                            {{ date('d M Y', strtotime('+3 days')) }}
                        </strong>
                    </div>

                    <div class="summary-row">
                        <span>Harga per Orang</span>
                        <span class="text-dark fw-medium" id="summaryPricePerPax">
                            Rp {{ number_format($selectedTrip->price ?? 350000, 0, ',', '.') }}
                        </span>
                    </div>

                    <div class="summary-row">
                        <span>Jumlah Peserta</span>
                        <span class="badge bg-secondary-subtle text-secondary fw-semibold px-2 py-1" id="summaryPaxDisplay">
                            1 Pax
                        </span>
                    </div>

                    <div class="summary-row">
                        <span>Asuransi Pendakian Resmi</span>
                        <span class="badge bg-success-subtle text-success fw-semibold">Gratis</span>
                    </div>

                    <div class="summary-row">
                        <span>Biaya Platform & Admin</span>
                        <span class="badge bg-success-subtle text-success fw-semibold">Rp 0 (Promo)</span>
                    </div>

                    <!-- Total Section -->
                    <div class="summary-row total">
                        <div>
                            <span class="d-block small text-muted">Total Pembayaran</span>
                            <span class="small text-muted">(Termasuk Pajak & Simaksi)</span>
                        </div>
                        <div class="text-end">
                            <span class="price-total-badge" id="summaryTotalDisplay">
                                Rp {{ number_format($selectedTrip->price ?? 350000, 0, ',', '.') }}
                            </span>
                        </div>
                    </div>

                    <!-- Inclusions Highlights -->
                    <div class="bg-light rounded-3 p-3 mb-3 border">
                        <div class="fw-bold small text-dark mb-2">
                            <i class="bi bi-patch-check-fill text-primary me-1"></i> Fasilitas Termasuk:
                        </div>
                        <ul class="inclusion-list">
                            <li><i class="bi bi-check-circle-fill text-success"></i> Guide Tersertifikasi APGI / Maro</li>
                            <li><i class="bi bi-check-circle-fill text-success"></i> Simaksi / Tiket Resmi Masuk TN</li>
                            <li><i class="bi bi-check-circle-fill text-success"></i> Tenda Kapasitas 4 (isi 3 orang)</li>
                            <li><i class="bi bi-check-circle-fill text-success"></i> Perlengkapan Masak & P3K Tim</li>
                            <li><i class="bi bi-check-circle-fill text-success"></i> Asuransi Kecelakaan Petualangan</li>
                        </ul>
                    </div>

                    <!-- Submit Button for Mobile & Desktop -->
                    <button type="submit" class="btn btn-primary btn-lg w-100 fw-bold py-3 shadow-sm d-flex align-items-center justify-content-center gap-2 mb-3">
                        <i class="bi bi-shield-lock-fill"></i>
                        Lanjut ke Pembayaran
                        <i class="bi bi-arrow-right"></i>
                    </button>

                    <!-- Trust and Help Box -->
                    <div class="text-center pt-2">
                        <div class="d-flex align-items-center justify-content-center gap-2 text-muted small mb-2">
                            <i class="bi bi-lock-fill text-success"></i>
                            <span>Enkripsi SSL 256-Bit Aman</span>
                        </div>
                        <p class="text-muted small mb-0">
                            Butuh bantuan pemesanan?
                            <a href="https://wa.me/6285894535172?text=Halo%20Maro%20Adventure%2C%20saya%20butuh%20bantuan%20terkait%20checkout%20trip." target="_blank" class="fw-semibold text-primary text-decoration-none">
                                Chat WhatsApp CS <i class="bi bi-box-arrow-up-right"></i>
                            </a>
                        </p>
                    </div>

                </div>

            </div>

        </div>

    </form>

</div>

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const tripSelect = document.getElementById('tripSelect');
    const participantsInput = document.getElementById('participantsInput');
    const btnMinus = document.getElementById('btnMinus');
    const btnPlus = document.getElementById('btnPlus');
    const bookingDateInput = document.getElementById('booking_date');

    // Display elements
    const paxCounterBadge = document.getElementById('paxCounterBadge');
    const tripPreviewThumb = document.getElementById('tripPreviewThumb');
    const tripPreviewTitle = document.getElementById('tripPreviewTitle');
    const tripBadgeDuration = document.getElementById('tripBadgeDuration');
    const tripBadgeElevation = document.getElementById('tripBadgeElevation');
    const tripPreviewLocation = document.getElementById('tripPreviewLocation');

    // Summary elements
    const summaryTripThumb = document.getElementById('summaryTripThumb');
    const summaryTripName = document.getElementById('summaryTripName');
    const summaryMountainLocation = document.getElementById('summaryMountainLocation');
    const summaryDateDisplay = document.getElementById('summaryDateDisplay');
    const summaryPricePerPax = document.getElementById('summaryPricePerPax');
    const summaryPaxDisplay = document.getElementById('summaryPaxDisplay');
    const summaryTotalDisplay = document.getElementById('summaryTotalDisplay');

    // Formatter Rupiah
    function formatRupiah(number) {
        return 'Rp ' + new Intl.NumberFormat('id-ID').format(number);
    }

    // Format Tanggal
    function formatDateIndo(dateStr) {
        if (!dateStr) return '-';
        const date = new Date(dateStr);
        if (isNaN(date.getTime())) return dateStr;
        return date.toLocaleDateString('id-ID', {
            day: 'numeric',
            month: 'short',
            year: 'numeric'
        });
    }

    // Hitung ulang semua nominal
    function recalculate() {
        const selectedOption = tripSelect.options[tripSelect.selectedIndex];
        if (!selectedOption) return;

        const price = parseInt(selectedOption.getAttribute('data-price') || '0', 10);
        const duration = selectedOption.getAttribute('data-duration') || '2 Hari 1 Malam';
        const mountain = selectedOption.getAttribute('data-mountain') || 'Gunung Indonesia';
        const elevation = selectedOption.getAttribute('data-elevation') || '2000';
        const location = selectedOption.getAttribute('data-location') || 'Indonesia';
        const image = selectedOption.getAttribute('data-image') || '';
        const tripName = selectedOption.text.split('(')[0].trim();

        let pax = parseInt(participantsInput.value || '1', 10);
        if (pax < 1) pax = 1;
        if (pax > 50) pax = 50;

        const total = price * pax;

        // Update counter & badge
        paxCounterBadge.textContent = `${pax} Orang Pendaki`;
        summaryPaxDisplay.textContent = `${pax} Pax`;
        btnMinus.disabled = (pax <= 1);
        btnPlus.disabled = (pax >= 50);

        // Update preview card
        tripPreviewTitle.textContent = tripName;
        tripBadgeDuration.innerHTML = `<i class="bi bi-clock me-1"></i> ${duration}`;
        tripBadgeElevation.innerHTML = `<i class="bi bi-triangle me-1"></i> ${elevation} MDPL`;
        tripPreviewLocation.innerHTML = `<i class="bi bi-geo-alt-fill text-danger me-1"></i> ${mountain}, ${location}`;
        if (image) {
            tripPreviewThumb.src = image;
            summaryTripThumb.src = image;
        }

        // Update summary card
        summaryTripName.textContent = tripName;
        summaryMountainLocation.textContent = `${mountain} (${elevation} MDPL)`;
        summaryPricePerPax.textContent = formatRupiah(price);
        summaryTotalDisplay.textContent = formatRupiah(total);

        // Update date summary
        if (bookingDateInput && bookingDateInput.value) {
            summaryDateDisplay.textContent = formatDateIndo(bookingDateInput.value);
        }
    }

    // Event listeners
    if (btnMinus) {
        btnMinus.addEventListener('click', function () {
            let current = parseInt(participantsInput.value || '1', 10);
            if (current > 1) {
                participantsInput.value = current - 1;
                recalculate();
            }
        });
    }

    if (btnPlus) {
        btnPlus.addEventListener('click', function () {
            let current = parseInt(participantsInput.value || '1', 10);
            if (current < 50) {
                participantsInput.value = current + 1;
                recalculate();
            }
        });
    }

    if (tripSelect) {
        tripSelect.addEventListener('change', recalculate);
    }

    if (bookingDateInput) {
        bookingDateInput.addEventListener('change', function () {
            summaryDateDisplay.textContent = formatDateIndo(this.value);
        });
    }

    // Run on init
    recalculate();
});
</script>
@endpush

