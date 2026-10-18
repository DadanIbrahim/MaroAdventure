@extends('layouts.app')

@section('title', 'Paket Petualangan & Pendakian — Maro Adventure Indonesia')

@push('styles')
<style>
/* ── Page Hero ── */
.trips-hero {
    background: linear-gradient(135deg, var(--color-navy) 0%, var(--color-primary-dark) 100%);
    padding: 120px 0 60px;
    position: relative;
    overflow: hidden;
}

.trips-hero::before {
    content: '';
    position: absolute;
    top: -40%;
    right: -10%;
    width: 500px;
    height: 500px;
    background: radial-gradient(circle, rgba(56,189,248,0.15) 0%, transparent 70%);
    border-radius: 50%;
}

.trips-badge {
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

/* ── Trip Cards ── */
.trip-card {
    background: #ffffff;
    border-radius: 18px;
    border: 1.5px solid #E2E8F0;
    overflow: hidden;
    transition: all 0.3s ease;
    display: flex;
    flex-direction: column;
    height: 100%;
}

.trip-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 12px 30px rgba(12, 74, 110, 0.1);
    border-color: var(--color-primary);
}

.trip-card-thumb-wrap {
    position: relative;
    height: 220px;
    overflow: hidden;
    background-color: #F1F5F9;
}

.trip-card-thumb {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.4s ease;
}

.trip-card:hover .trip-card-thumb {
    transform: scale(1.05);
}

.trip-card-badge-top {
    position: absolute;
    top: 14px;
    left: 14px;
    z-index: 2;
}

.trip-card-duration-badge {
    position: absolute;
    bottom: 14px;
    right: 14px;
    z-index: 2;
}

.filter-toolbar {
    background: #ffffff;
    border-radius: 16px;
    padding: 20px 24px;
    box-shadow: 0 4px 20px rgba(12, 74, 110, 0.06);
    border: 1.5px solid #E2E8F0;
    margin-top: -30px;
    position: relative;
    z-index: 10;
}

.feature-box {
    background: #ffffff;
    border-radius: 16px;
    padding: 24px;
    border: 1.5px solid #E2E8F0;
    text-align: center;
    transition: all 0.3s ease;
}

.feature-box:hover {
    border-color: var(--color-primary);
    box-shadow: 0 8px 24px rgba(12, 74, 110, 0.08);
}
</style>
@endpush

@section('content')

<!-- ── HERO BANNER ── -->
<div class="trips-hero text-white text-center">
    <div class="container position-relative" style="z-index: 2;">
        <div class="trips-badge mb-3">
            <i class="bi bi-compass-fill"></i>
            Eksplorasi Puncak Petualangan Nusantara
        </div>
        <h1 class="fw-bold mb-2 display-5">Paket Perjalanan &amp; Pendakian</h1>
        <p class="text-white-50 mb-0" style="max-width: 650px; margin: 0 auto; font-size: 1rem;">
            Temukan paket open trip terjadwal dan private trip dengan pendampingan Certified Mountain Guide berlisensi resmi, tenda berkualitas, dan asuransi penuh.
        </p>
    </div>
</div>

<div class="container pb-5">

    <!-- ── FILTER & SEARCH TOOLBAR ── -->
    <div class="filter-toolbar mb-5">
        <form method="GET" action="{{ route('trips.index') }}">
            <div class="row g-3 align-items-center">
                
                <!-- Search Input -->
                <div class="col-lg-5 col-md-6">
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0 text-muted">
                            <i class="bi bi-search"></i>
                        </span>
                        <input 
                            type="text" 
                            name="search" 
                            class="form-control border-start-0" 
                            placeholder="Cari trip atau destinasi..." 
                            value="{{ request('search') }}"
                        >
                    </div>
                </div>

                <!-- Destination Filter -->
                <div class="col-lg-3 col-md-6">
                    <select name="mountain_id" class="form-select" onchange="this.form.submit()">
                        <option value="">Semua Destinasi</option>
                        @foreach($mountains as $mountain)
                            <option value="{{ $mountain->id }}" {{ request('mountain_id') == $mountain->id ? 'selected' : '' }}>
                                {{ $mountain->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Sort Order -->
                <div class="col-lg-3 col-md-6">
                    <select name="sort" class="form-select" onchange="this.form.submit()">
                        <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Terbaru</option>
                        <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Harga: Terendah ke Tertinggi</option>
                        <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Harga: Tertinggi ke Terendah</option>
                    </select>
                </div>

                <!-- Filter Buttons -->
                <div class="col-lg-1 col-md-6 text-end">
                    <button type="submit" class="btn btn-primary w-100 fw-semibold" title="Terapkan Filter">
                        <i class="bi bi-funnel-fill"></i>
                    </button>
                </div>

            </div>

            @if(request()->filled('search') || request()->filled('mountain_id') || request()->filled('sort'))
                <div class="mt-3 pt-2 border-top d-flex align-items-center gap-2">
                    <span class="small text-muted">Filter aktif:</span>
                    <a href="{{ route('trips.index') }}" class="btn btn-outline-secondary btn-sm rounded-pill px-3 py-1" style="font-size: 0.78rem;">
                        <i class="bi bi-x-circle me-1"></i> Reset Semua Filter
                    </a>
                </div>
            @endif
        </form>
    </div>

    <!-- ── TRIPS LIST GRID ── -->
    <div class="row g-4 mb-5">
        @forelse($trips as $trip)
            <div class="col-md-6 col-lg-4">
                <div class="trip-card">
                    
                    <!-- Thumbnail with overlays -->
                    <div class="trip-card-thumb-wrap">
                        <img 
                            src="{{ $trip->image ? asset('storage/' . $trip->image) : asset('assets/images/destinasi/burangrang.jpg') }}" 
                            alt="{{ $trip->name }}" 
                            class="trip-card-thumb"
                            onerror="this.src='https://images.unsplash.com/photo-1464822759023-fed622ff2c3b?auto=format&fit=crop&w=600&q=80'"
                        >
                        
                        <!-- Top Elevation Badge -->
                        @if($trip->mountain && $trip->mountain->elevation)
                            <div class="trip-card-badge-top">
                                <span class="badge bg-dark bg-opacity-75 backdrop-blur text-white px-3 py-2 rounded-pill font-monospace" style="font-size: 0.78rem;">
                                    <i class="bi bi-triangle-fill text-warning me-1"></i> {{ $trip->mountain->elevation }} MDPL
                                </span>
                            </div>
                        @endif

                        @if($trip->duration)
                        <!-- Duration Badge -->
                        <div class="trip-card-duration-badge">
                            <span class="badge bg-primary text-white px-3 py-2 rounded-pill shadow-sm fw-bold" style="font-size: 0.78rem;">
                                <i class="bi bi-clock me-1"></i> {{ $trip->duration }}
                            </span>
                        </div>
                        @endif
                    </div>

                    <!-- Card Body Content -->
                    <div class="card-body p-4 d-flex flex-column justify-content-between flex-grow-1">
                        
                        <div>
                            <!-- Mountain & Location -->
                            @if($trip->mountain)
                                <div class="text-primary small fw-bold text-uppercase tracking-wide mb-1">
                                    <i class="bi bi-geo-alt-fill text-danger me-1"></i>
                                    {{ $trip->mountain->name }} &bull; {{ $trip->mountain->location ?? 'Indonesia' }}
                                </div>
                            @endif

                            <!-- Trip Title -->
                            <h5 class="fw-bold text-dark mb-2">
                                <a href="{{ route('trips.show', $trip->id) }}" class="text-dark text-decoration-none hover-primary">
                                    {{ $trip->name }}
                                </a>
                            </h5>

                            <!-- Excerpt Description -->
                            <p class="text-muted small mb-3">
                                {{ Str::limit($trip->description ?? 'Nikmati pengalaman mendaki gunung spektakuler bersama tim profesional Maro Adventure.', 110) }}
                            </p>

                            <!-- Inclusions Tags -->
                            <div class="d-flex flex-wrap gap-1 mb-4">
                                <span class="badge bg-light text-secondary border px-2 py-1" style="font-size: 0.72rem;">
                                    <i class="bi bi-shield-check text-success me-1"></i> Guide APGI
                                </span>
                                <span class="badge bg-light text-secondary border px-2 py-1" style="font-size: 0.72rem;">
                                    <i class="bi bi-house-door text-primary me-1"></i> Tenda Dome
                                </span>
                                <span class="badge bg-light text-secondary border px-2 py-1" style="font-size: 0.72rem;">
                                    <i class="bi bi-ticket-perforated text-info me-1"></i> Simaksi TN
                                </span>
                                <span class="badge bg-light text-secondary border px-2 py-1" style="font-size: 0.72rem;">
                                    <i class="bi bi-heart-pulse text-danger me-1"></i> P3K Tim
                                </span>
                            </div>
                        </div>

                        <!-- Price & Action Buttons -->
                        <div class="pt-3 border-top mt-auto">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <div>
                                    <span class="small text-muted d-block" style="font-size: 0.75rem;">Mulai dari:</span>
                                    <h4 class="fw-bold text-primary mb-0">
                                        Rp {{ number_format($trip->price, 0, ',', '.') }}
                                        <span class="text-muted fw-normal" style="font-size: 0.8rem;">/ pax</span>
                                    </h4>
                                </div>
                            </div>

                            <div>
                                <a href="{{ route('trips.show', $trip->id) }}" class="btn btn-primary w-100 fw-bold py-2 rounded-2 shadow-sm d-flex align-items-center justify-content-center gap-2">
                                    <i class="bi bi-info-circle me-1"></i> Detail &amp; Pemesanan &rarr;
                                </a>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="card border-0 shadow-sm rounded-4 p-5 text-center bg-white">
                    <div class="d-inline-flex align-items-center justify-content-center rounded-circle bg-light text-muted mx-auto mb-3" style="width: 70px; height: 70px;">
                        <i class="bi bi-compass fs-2"></i>
                    </div>
                    <h5 class="fw-bold text-dark mb-1">Paket Perjalanan Tidak Ditemukan</h5>
                    <p class="text-muted small mb-3">Tidak ada paket trip yang cocok dengan kata kunci atau filter pencarian Anda.</p>
                    <div>
                        <a href="{{ route('trips.index') }}" class="btn btn-primary btn-sm px-4 rounded-pill">
                            Lihat Semua Paket
                        </a>
                    </div>
                </div>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if($trips->hasPages())
        <div class="d-flex justify-content-center mb-5">
            {{ $trips->links() }}
        </div>
    @endif

    <!-- ── TRUST BADGES SECTION ── -->
    <div class="pt-4 border-top">
        <div class="text-center mb-4">
            <h4 class="fw-bold text-dark mb-1">Kenapa Memilih Maro Adventure?</h4>
            <p class="text-muted small">Standar pelayanan outdoor berkelas demi kenyamanan dan keselamatan pendakianmu.</p>
        </div>

        <div class="row g-3">
            <div class="col-md-3">
                <div class="feature-box h-100">
                    <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 50px; height: 50px;">
                        <i class="bi bi-person-badge-fill fs-4"></i>
                    </div>
                    <h6 class="fw-bold mb-1">Guide Bersertifikasi</h6>
                    <p class="text-muted small mb-0">Didampingi pemandu berlisensi resmi APGI yang memahami rute dan mitigasi risiko.</p>
                </div>
            </div>

            <div class="col-md-3">
                <div class="feature-box h-100">
                    <div class="bg-success bg-opacity-10 text-success rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 50px; height: 50px;">
                        <i class="bi bi-shield-check fs-4"></i>
                    </div>
                    <h6 class="fw-bold mb-1">Asuransi Pendakian</h6>
                    <p class="text-muted small mb-0">Semua peserta terdaftar dalam perlindungan asuransi kecelakaan diri resmi.</p>
                </div>
            </div>

            <div class="col-md-3">
                <div class="feature-box h-100">
                    <div class="bg-warning bg-opacity-10 text-warning rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 50px; height: 50px;">
                        <i class="bi bi-house-door-fill fs-4"></i>
                    </div>
                    <h6 class="fw-bold mb-1">Tenda &amp; Logistik Nyaman</h6>
                    <p class="text-muted small mb-0">Tenda dome kapasitas 4 hanya diisi 3 peserta untuk kenyamanan istirahat maksimal.</p>
                </div>
            </div>

            <div class="col-md-3">
                <div class="feature-box h-100">
                    <div class="bg-info bg-opacity-10 text-info rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 50px; height: 50px;">
                        <i class="bi bi-tree-fill fs-4"></i>
                    </div>
                    <h6 class="fw-bold mb-1">Leave No Trace</h6>
                    <p class="text-muted small mb-0">Mendukung kelestarian alam dengan membawa kembali seluruh sampah pendakian.</p>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection

