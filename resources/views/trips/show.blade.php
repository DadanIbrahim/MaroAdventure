@extends('layouts.app')

@section('title', $trip->name . ' — Maro Adventure Indonesia')

@push('styles')
<style>
/* ── Page Hero ── */
.trip-detail-hero {
    background: linear-gradient(135deg, var(--color-navy) 0%, var(--color-primary-dark) 100%);
    padding: 110px 0 50px;
    position: relative;
    overflow: hidden;
}

.trip-detail-hero::before {
    content: '';
    position: absolute;
    top: -50%;
    right: -10%;
    width: 450px;
    height: 450px;
    background: radial-gradient(circle, rgba(56,189,248,0.12) 0%, transparent 70%);
    border-radius: 50%;
}

.timeline-item {
    position: relative;
    padding-left: 32px;
    margin-bottom: 24px;
}

.timeline-item::before {
    content: '';
    position: absolute;
    left: 8px;
    top: 6px;
    bottom: -24px;
    width: 2px;
    background-color: #E2E8F0;
}

.timeline-item:last-child::before {
    display: none;
}

.timeline-dot {
    position: absolute;
    left: 0;
    top: 4px;
    width: 18px;
    height: 18px;
    border-radius: 50%;
    background-color: var(--color-primary);
    border: 3px solid #E0F2FE;
}

.detail-card {
    background: #ffffff;
    border-radius: 18px;
    padding: 28px;
    box-shadow: 0 4px 20px rgba(12, 74, 110, 0.05);
    border: 1px solid #E2E8F0;
    margin-bottom: 24px;
}

.sticky-booking-box {
    position: sticky;
    top: 90px;
    background: #ffffff;
    border-radius: 20px;
    padding: 26px;
    box-shadow: 0 10px 30px rgba(12, 74, 110, 0.08);
    border: 1.5px solid #E2E8F0;
}
</style>
@endpush

@section('content')

<!-- ── HERO BANNER ── -->
<div class="trip-detail-hero text-white">
    <div class="container position-relative" style="z-index: 2;">
        
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="mb-3">
            <ol class="breadcrumb mb-0 small">
                <li class="breadcrumb-item"><a href="{{ url('/') }}" class="text-white-50 text-decoration-none">Beranda</a></li>
                <li class="breadcrumb-item"><a href="{{ route('trips.index') }}" class="text-white-50 text-decoration-none">Paket Perjalanan</a></li>
                <li class="breadcrumb-item active text-white" aria-current="page">{{ $trip->name }}</li>
            </ol>
        </nav>

        <div class="d-flex flex-wrap align-items-center gap-2 mb-2">
            @if($trip->mountain)
                <span class="badge bg-white bg-opacity-20 text-white rounded-pill px-3 py-1 font-monospace">
                    <i class="bi bi-geo-alt-fill text-warning me-1"></i> {{ $trip->mountain->name }}
                </span>
            @endif
            @if($trip->duration)
            <span class="badge bg-primary text-white rounded-pill px-3 py-1">
                <i class="bi bi-clock me-1"></i> {{ $trip->duration }}
            </span>
            @endif
        </div>

        <h1 class="fw-bold mb-2 display-6">{{ $trip->name }}</h1>
        <p class="text-white-50 mb-0" style="max-width: 700px;">
            {{ $trip->description ? Str::limit($trip->description, 140) : 'Pendakian terorganisir bersama tim profesional Maro Adventure Indonesia.' }}
        </p>

    </div>
</div>

<div class="container py-5">
    <div class="row g-4">

        <!-- ── LEFT COLUMN: DETAIL CONTENT ── -->
        <div class="col-lg-8">

            <!-- Main Image Banner -->
            <div class="rounded-4 overflow-hidden shadow-sm mb-4 bg-light" style="max-height: 440px;">
                <img 
                    src="{{ $trip->image ? asset('storage/' . $trip->image) : asset('assets/images/destinasi/burangrang.jpg') }}" 
                    alt="{{ $trip->name }}" 
                    class="w-100 h-100 object-fit-cover"
                    style="min-height: 350px; max-height: 440px;"
                    onerror="this.src='https://images.unsplash.com/photo-1464822759023-fed622ff2c3b?auto=format&fit=crop&w=1000&q=80'"
                >
            </div>

            <!-- CARD 1: OVERVIEW & SPESIFIKASI JALUR -->
            <div class="detail-card">
                <h4 class="fw-bold text-dark mb-3">Tentang Perjalanan &amp; Rincian Lengkap</h4>
                <div class="text-secondary mb-0" style="line-height: 1.8; font-size: 0.98rem; white-space: pre-line;">{{ $trip->description ?? 'Paket petualangan mendaki gunung bersama Maro Adventure dirancang khusus untuk memberikan pengalaman outdoor terbaik dengan standar keselamatan ketat. Nikmati panorama alam memukau, kebersamaan di camp area, dan momen sunrise yang tak terlupakan.' }}</div>
            </div>

            @php
                $hasCustomDetails = $trip->description && (
                    str_contains($trip->description, 'Fasilitas Termasuk') || 
                    str_contains($trip->description, 'Rincian & Aktivitas') || 
                    str_contains($trip->description, 'Rundown') ||
                    str_contains($trip->description, 'Include')
                );
            @endphp

            @if(!$hasCustomDetails)
            <!-- CARD 2: ITINERARY / RUNDOWN KEGIATAN -->
            <div class="detail-card">
                <h4 class="fw-bold text-dark mb-1">Rundown Perjalanan (Itinerary)</h4>
                <p class="text-muted small mb-4">Jadwal dapat disesuaikan secara situasional dengan kondisi cuaca di lapangan.</p>

                <!-- Day 1 -->
                <div class="mb-4">
                    <h6 class="fw-bold text-primary mb-3">
                        <i class="bi bi-calendar-check me-1"></i> Hari 1: Registrasi, Trekking, &amp; Sunset Camp
                    </h6>

                    <div class="timeline-item">
                        <div class="timeline-dot"></div>
                        <strong class="text-dark d-block">07.30 - 08.30 &bull; Meeting Point &amp; Briefing</strong>
                        <span class="small text-muted">Kumpul di Basecamp, pemeriksaan peralatan tim, safety briefing, dan doa bersama.</span>
                    </div>

                    <div class="timeline-item">
                        <div class="timeline-dot"></div>
                        <strong class="text-dark d-block">08.30 - 12.30 &bull; Trekking Awal (Basecamp - Pos 2)</strong>
                        <span class="small text-muted">Memulai pendakian melewati hutan pinus dan jalur vegetasi asri. Istirahat singkat di setiap pos.</span>
                    </div>

                    <div class="timeline-item">
                        <div class="timeline-dot"></div>
                        <strong class="text-dark d-block">12.30 - 13.30 &bull; Istirahat Makan Siang</strong>
                        <span class="small text-muted">Makan siang bersama dan rehidrasi di shelter peristirahatan pos bayangan.</span>
                    </div>

                    <div class="timeline-item">
                        <div class="timeline-dot"></div>
                        <strong class="text-dark d-block">13.30 - 16.30 &bull; Menuju Camp Area &amp; Sunset Spot</strong>
                        <span class="small text-muted">Tiba di camp ground, mendirikan tenda tim, bersantai menikmati kopi hangat dan pemandangan golden sunset.</span>
                    </div>

                    <div class="timeline-item">
                        <div class="timeline-dot"></div>
                        <strong class="text-dark d-block">19.00 - 21.00 &bull; Makan Malam Tim &amp; Istirahat</strong>
                        <span class="small text-muted">Makan malam menu hangat outdoor, sharing cerita santai, dan istirahat malam.</span>
                    </div>
                </div>

                <!-- Day 2 -->
                <div>
                    <h6 class="fw-bold text-primary mb-3">
                        <i class="bi bi-calendar-check me-1"></i> Hari 2: Golden Sunrise Puncak &amp; Kembali ke Basecamp
                    </h6>

                    <div class="timeline-item">
                        <div class="timeline-dot"></div>
                        <strong class="text-dark d-block">05.00 - 06.30 &bull; Golden Sunrise Summit</strong>
                        <span class="small text-muted">Menikmati matahari terbit spektakuler di puncak tertinggi dan samudera awan.</span>
                    </div>

                    <div class="timeline-item">
                        <div class="timeline-dot"></div>
                        <strong class="text-dark d-block">06.30 - 08.30 &bull; Sarapan Pagi &amp; Sesi Foto Dokumentasi</strong>
                        <span class="small text-muted">Sarapan bergizi di camp dan dokumentasi foto kenangan bersama kelompok.</span>
                    </div>

                    <div class="timeline-item">
                        <div class="timeline-dot"></div>
                        <strong class="text-dark d-block">08.30 - 09.30 &bull; Packing &amp; Operasi Bersih (Leave No Trace)</strong>
                        <span class="small text-muted">Merapikan tenda dan membawa kembali seluruh sampah pendakian.</span>
                    </div>

                    <div class="timeline-item">
                        <div class="timeline-dot"></div>
                        <strong class="text-dark d-block">09.30 - 13.30 &bull; Trekking Turun Menuju Basecamp</strong>
                        <span class="small text-muted">Tiba di basecamp awal, bersih-bersih, makan siang penutup, dan trip selesai dengan berkesan.</span>
                    </div>
                </div>
            </div>

            <!-- CARD 3: FASILITAS INCLUDE & EXCLUDE -->
            <div class="detail-card">
                <h4 class="fw-bold text-dark mb-3">Fasilitas Perjalanan</h4>

                <div class="row g-4">
                    <!-- Termasuk -->
                    <div class="col-md-6">
                        <h6 class="fw-bold text-success mb-3">
                            <i class="bi bi-check-circle-fill me-1"></i> Sudah Termasuk (Include):
                        </h6>
                        <ul class="list-unstyled mb-0">
                            <li class="small text-secondary mb-2 d-flex align-items-center gap-2">
                                <i class="bi bi-check2 text-success fw-bold"></i> Pemandu Gunung Resmi (Certified Guide APGI)
                            </li>
                            <li class="small text-secondary mb-2 d-flex align-items-center gap-2">
                                <i class="bi bi-check2 text-success fw-bold"></i> Tiket Masuk &amp; Simaksi Resmi Taman Nasional
                            </li>
                            <li class="small text-secondary mb-2 d-flex align-items-center gap-2">
                                <i class="bi bi-check2 text-success fw-bold"></i> Tenda Dome Kapasitas 4 (isi 3 orang)
                            </li>
                            <li class="small text-secondary mb-2 d-flex align-items-center gap-2">
                                <i class="bi bi-check2 text-success fw-bold"></i> Logistik Makanan Selama Pendakian &amp; Cooking Set
                            </li>
                            <li class="small text-secondary mb-2 d-flex align-items-center gap-2">
                                <i class="bi bi-check2 text-success fw-bold"></i> Asuransi Kecelakaan Petualangan Resmi
                            </li>
                            <li class="small text-secondary mb-2 d-flex align-items-center gap-2">
                                <i class="bi bi-check2 text-success fw-bold"></i> P3K Standar &amp; Protokol Evakuasi Darurat
                            </li>
                        </ul>
                    </div>

                    <!-- Tidak Termasuk -->
                    <div class="col-md-6">
                        <h6 class="fw-bold text-danger mb-3">
                            <i class="bi bi-x-circle-fill me-1"></i> Tidak Termasuk (Exclude):
                        </h6>
                        <ul class="list-unstyled mb-0">
                            <li class="small text-secondary mb-2 d-flex align-items-center gap-2">
                                <i class="bi bi-x text-danger fw-bold"></i> Transportasi dari kota asal menuju Meeting Point
                            </li>
                            <li class="small text-secondary mb-2 d-flex align-items-center gap-2">
                                <i class="bi bi-x text-danger fw-bold"></i> Perlengkapan pribadi (Sleeping bag, jaket, sepatu)
                            </li>
                            <li class="small text-secondary mb-2 d-flex align-items-center gap-2">
                                <i class="bi bi-x text-danger fw-bold"></i> Porter pribadi pengangkut carrier individu
                            </li>
                            <li class="small text-secondary mb-2 d-flex align-items-center gap-2">
                                <i class="bi bi-x text-danger fw-bold"></i> Pengeluaran pribadi dan tips sukarela kru
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- CARD 4: PACKING LIST PERSIAPAN -->
            <div class="detail-card">
                <h4 class="fw-bold text-dark mb-1">Perlengkapan Wajib (Packing List)</h4>
                <p class="text-muted small mb-3">Siapkan perlengkapan ini dalam carrier/ransel pribadi Anda demi kenyamanan pendakian:</p>

                <div class="row g-2">
                    <div class="col-sm-6">
                        <div class="p-2 bg-light rounded-2 small text-secondary">
                            <i class="bi bi-check-square-fill text-primary me-2"></i> Sepatu / Sandal Gunung beralas grip
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="p-2 bg-light rounded-2 small text-secondary">
                            <i class="bi bi-check-square-fill text-primary me-2"></i> Jaket Gunung (Windproof / Polar)
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="p-2 bg-light rounded-2 small text-secondary">
                            <i class="bi bi-check-square-fill text-primary me-2"></i> Jas Hujan / Ponco &amp; Pakaian Ganti
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="p-2 bg-light rounded-2 small text-secondary">
                            <i class="bi bi-check-square-fill text-primary me-2"></i> Headlamp / Senter &amp; Baterai Cadangan
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="p-2 bg-light rounded-2 small text-secondary">
                            <i class="bi bi-check-square-fill text-primary me-2"></i> Obat-obatan pribadi / inhaler (jika asma)
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="p-2 bg-light rounded-2 small text-secondary">
                            <i class="bi bi-check-square-fill text-primary me-2"></i> Botol Minum / Tumbler &amp; Snack Pribadi
                        </div>
                    </div>
                </div>
            </div>
            @endif

        </div>

        <!-- ── RIGHT COLUMN: STICKY BOOKING BOX ── -->
        <div class="col-lg-4">
            <div class="sticky-booking-box">
                
                <span class="small text-muted d-block mb-1">Biaya Paket Per Orang:</span>
                <h2 class="fw-bold text-primary mb-3">
                    Rp {{ number_format($trip->price, 0, ',', '.') }}
                    <span class="fs-6 text-muted fw-normal">/ pax</span>
                </h2>

                <div class="bg-light p-3 rounded-3 mb-4 border">
                    <div class="d-flex justify-content-between small text-muted mb-2">
                        <span>Durasi:</span>
                        <strong class="text-dark">{{ $trip->duration ?? 'Lihat Deskripsi' }}</strong>
                    </div>
                    <div class="d-flex justify-content-between small text-muted mb-2">
                        <span>Minimal Peserta:</span>
                        <strong class="text-dark">1 Orang (Bisa Gabung)</strong>
                    </div>
                    <div class="d-flex justify-content-between small text-muted">
                        <span>Asuransi:</span>
                        <span class="badge bg-success-subtle text-success fw-bold">Termasuk</span>
                    </div>
                </div>

                <!-- Form Booking Terintegrasi Menuju Checkout -->
                <form action="{{ route('checkout.index') }}" method="GET" class="mb-3">
                    <input type="hidden" name="trip_id" value="{{ $trip->id }}">

                    <div class="mb-3">
                        <label class="form-label small fw-bold text-secondary mb-1">
                            <i class="bi bi-calendar3 me-1 text-primary"></i> Tanggal Berangkat:
                        </label>
                        <input 
                            type="date" 
                            name="booking_date" 
                            class="form-control" 
                            min="{{ date('Y-m-d') }}" 
                            value="{{ date('Y-m-d', strtotime('+3 days')) }}"
                            required
                        >
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-bold text-secondary mb-1">
                            <i class="bi bi-people-fill me-1 text-primary"></i> Jumlah Peserta:
                        </label>
                        <div class="input-group">
                            <input 
                                type="number" 
                                name="participants" 
                                class="form-control text-center fw-bold" 
                                value="1" 
                                min="1" 
                                max="50"
                                required
                            >
                            <span class="input-group-text bg-light text-muted">Orang (Pax)</span>
                        </div>
                    </div>

                    <!-- Tombol Booking Utama -->
                    @php
                        $isAdminOrSuperadmin = auth()->check() && (auth()->user()->isAdmin() || auth()->user()->isSuperadmin() || in_array(auth()->user()->role, ['admin', 'superadmin']));
                    @endphp

                    @if($isAdminOrSuperadmin)
                        <button type="button" onclick="showAdminBookingAlert()" class="btn btn-primary btn-lg w-100 fw-bold py-3 shadow-sm d-flex align-items-center justify-content-center gap-2 mb-2">
                            <i class="bi bi-calendar2-check-fill"></i> Pesan Tiket Sekarang &rarr;
                        </button>
                        <div class="alert alert-warning py-2 px-3 small border-0 mb-2 rounded-2" style="font-size: 0.78rem;">
                            <i class="bi bi-shield-exclamation me-1"></i> Anda login sebagai <strong>{{ ucfirst(auth()->user()->role) }}</strong>. Silakan gunakan menu <strong>Booking Manual</strong> di Admin Panel.
                        </div>
                    @else
                        <button type="submit" class="btn btn-primary btn-lg w-100 fw-bold py-3 shadow-sm d-flex align-items-center justify-content-center gap-2 mb-2">
                            <i class="bi bi-calendar2-check-fill"></i> Pesan Tiket Sekarang &rarr;
                        </button>
                    @endif
                </form>

                <!-- Tombol Konsultasi WA -->
                <a href="https://wa.me/6285894535172?text=Halo%20Maro%20Adventure%2C%20saya%20tertarik%20dengan%20paket%20trip%20{{ urlencode($trip->name) }}." target="_blank" class="btn btn-outline-success w-100 fw-bold py-2 mb-4">
                    <i class="bi bi-whatsapp me-1"></i> Tanya CS / Buat Private Trip
                </a>

                <!-- Security & Guarantee Badges -->
                <div class="pt-3 border-top text-muted small">
                    <div class="d-flex align-items-center gap-2 mb-2">
                        <i class="bi bi-shield-lock-fill text-success"></i>
                        <span>Reservasi resmi terdaftar &amp; berasuransi</span>
                    </div>
                    <div class="d-flex align-items-center gap-2 mb-2">
                        <i class="bi bi-arrow-repeat text-primary"></i>
                        <span>Bebas jadwal ulang (S&amp;K Berlaku)</span>
                    </div>
                    <div class="d-flex align-items-center gap-2">
                        <i class="bi bi-award-fill text-warning"></i>
                        <span>Pemandu APGI &amp; SOP ramah lingkungan</span>
                    </div>
                </div>

            </div>
        </div>

    </div>

    <!-- ── RELATED TRIPS ── -->
    @if($relatedTrips->isNotEmpty())
        <div class="mt-5 pt-4 border-top">
            <h4 class="fw-bold text-dark mb-4">Paket Perjalanan Lainnya</h4>

            <div class="row g-4">
                @foreach($relatedTrips as $rTrip)
                    <div class="col-md-4">
                        <div class="card border-0 shadow-sm rounded-4 h-100 overflow-hidden border">
                            <img 
                                src="{{ $rTrip->image ? asset('storage/' . $rTrip->image) : asset('assets/images/destinasi/burangrang.jpg') }}" 
                                class="card-img-top object-fit-cover" 
                                style="height: 180px;"
                                alt="{{ $rTrip->name }}"
                                onerror="this.src='https://images.unsplash.com/photo-1464822759023-fed622ff2c3b?auto=format&fit=crop&w=600&q=80'"
                            >
                            <div class="card-body p-4 d-flex flex-column justify-content-between">
                                <div>
                                    <h6 class="fw-bold mb-1 text-dark">{{ $rTrip->name }}</h6>
                                    <p class="text-muted small mb-3">
                                        @if($rTrip->duration)
                                            <i class="bi bi-clock me-1"></i> {{ $rTrip->duration }} &bull;
                                        @endif
                                        {{ $rTrip->mountain->name ?? 'Gunung' }}
                                    </p>
                                </div>
                                <div class="d-flex justify-content-between align-items-center pt-2 border-top">
                                    <strong class="text-primary fs-6">Rp {{ number_format($rTrip->price, 0, ',', '.') }}</strong>
                                    <a href="{{ route('trips.show', $rTrip->id) }}" class="btn btn-sm btn-primary rounded-pill px-3 fw-bold">
                                        Detail &amp; Pemesanan
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

</div>

@endsection

@if($isAdminOrSuperadmin)
@push('scripts')
<script>
function showAdminBookingAlert() {
    Swal.fire({
        icon: 'warning',
        title: 'Akses Dibatasi',
        html: `Akun <strong>Admin/Superadmin</strong> tidak dapat melakukan booking personal lewat halaman ini.<br><br>Silakan gunakan menu <strong>'Booking Manual'</strong> di Admin Panel.`,
        showCancelButton: true,
        confirmButtonText: '<i class="bi bi-calendar2-plus me-1"></i> Buka Booking Manual',
        cancelButtonText: 'Tutup',
        confirmButtonColor: '#0d6efd',
        cancelButtonColor: '#6c757d',
        buttonsStyling: false,
        customClass: {
            popup: 'rounded-4 shadow-lg p-3 text-start',
            title: 'fs-5 fw-bold text-dark pt-2',
            htmlContainer: 'text-secondary small mt-2',
            confirmButton: 'btn btn-primary px-4 py-2 rounded-3 fw-semibold',
            cancelButton: 'btn btn-outline-secondary px-4 py-2 rounded-3 fw-semibold ms-2'
        }
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = "{{ auth()->user() && (auth()->user()->isSuperadmin() || auth()->user()->role === 'superadmin') ? route('superadmin.bookings.create') : route('admin.bookings.create') }}";
        }
    });
}
</script>
@endpush
@endif

