@extends('layouts.app')

@section('title', 'Points & Rewards - Maro Adventure')

@section('content')
<div class="bg-light pb-5" style="min-height: 100vh; padding-top: 100px;">
    <div class="container py-4">
        <div class="row">
            
            <!-- Sidebar -->
            <div class="col-lg-3 mb-4 mb-lg-0">
                @include('dashboard.partials.sidebar')
            </div>

            <!-- Main Content -->
            <div class="col-lg-9">
                <div class="ps-lg-4">
                    
                    <!-- Flash Messages -->
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show rounded-3 mb-4 border-0 shadow-sm" role="alert">
                            <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show rounded-3 mb-4 border-0 shadow-sm" role="alert">
                            <i class="bi bi-exclamation-circle-fill me-2"></i> {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <!-- Top Card (Points Info) -->
                    @php
                        $levelName = 'Explorer Bronze';
                        $maxLevelPoints = 500;
                        $progressPercent = min(100, round(($userPoints / $maxLevelPoints) * 100));

                        if ($userPoints > 1500) {
                            $levelName = 'Summit Master Gold';
                            $maxLevelPoints = 3000;
                            $progressPercent = min(100, round(($userPoints / $maxLevelPoints) * 100));
                        } elseif ($userPoints > 500) {
                            $levelName = 'Mountain Silver';
                            $maxLevelPoints = 1500;
                            $progressPercent = min(100, round((($userPoints - 500) / 1000) * 100));
                        }
                    @endphp

                    <div class="card border-0 shadow-sm rounded-4 mb-4 text-white overflow-hidden position-relative" style="background: linear-gradient(135deg, var(--color-navy, #0C4A6E) 0%, var(--color-primary-dark, #0369A1) 100%);">
                        <div class="card-body p-4 p-lg-5 position-relative" style="z-index: 2;">
                            <div class="row align-items-center g-4">
                                <div class="col-md-6">
                                    <p class="small text-uppercase tracking-wide text-white-50 mb-1 fw-semibold" style="letter-spacing: 1.5px;">SALDO MARO POINTS</p>
                                    <h1 class="fw-bold mb-0 display-4 text-white">{{ number_format($userPoints, 0, ',', '.') }}</h1>
                                    <p class="small text-white-50 mb-0 mt-2">Dapatkan +500 poin setiap menyelesaikan pendakian resmi Maro.</p>
                                </div>
                                <div class="col-md-6 text-md-end">
                                    <div class="d-flex justify-content-between mb-2">
                                        <span class="fw-bold text-white">{{ $levelName }}</span>
                                        <span class="small text-white-50">Tingkat Keanggotaan</span>
                                    </div>
                                    <div class="progress rounded-pill" style="height: 10px; background-color: rgba(255,255,255,0.2);">
                                        <div class="progress-bar bg-white rounded-pill" role="progressbar" style="width: {{ $progressPercent }}%;" aria-valuenow="{{ $progressPercent }}" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <div class="small text-white-50 mt-2">
                                        Status Poin: Aktif &amp; Siap Ditukarkan
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Navigation Tabs -->
                    <ul class="nav nav-pills mb-4 gap-2" id="pointsTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active rounded-pill px-4 py-2 fw-semibold" id="catalog-tab" data-bs-toggle="pill" data-bs-target="#catalog" type="button" role="tab">
                                <i class="bi bi-gift me-1"></i> Katalog Tukar Poin
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link rounded-pill px-4 py-2 text-dark bg-white border fw-semibold" id="vouchers-tab" data-bs-toggle="pill" data-bs-target="#vouchers" type="button" role="tab">
                                <i class="bi bi-ticket-perforated me-1"></i> Voucher Saya
                                @if(count($myVouchers) > 0)
                                    <span class="badge bg-primary text-white rounded-pill ms-1">{{ count($myVouchers) }}</span>
                                @endif
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link rounded-pill px-4 py-2 text-dark bg-white border fw-semibold" id="history-tab" data-bs-toggle="pill" data-bs-target="#history" type="button" role="tab">
                                <i class="bi bi-clock-history me-1"></i> Riwayat Poin
                            </button>
                        </li>
                    </ul>

                    <!-- Tabs Content -->
                    <div class="tab-content" id="pointsTabsContent">
                        
                        <!-- ══════════════════════════════════════════════════════ -->
                        <!-- TAB 1: KATALOG (REWARDS)                               -->
                        <!-- ══════════════════════════════════════════════════════ -->
                        <div class="tab-pane fade show active" id="catalog" role="tabpanel" tabindex="0">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h5 class="fw-bold mb-0 text-dark">Katalog Hadiah Petualangan</h5>
                                <span class="text-muted small">Tersedia {{ $rewards->count() }} pilihan hadiah</span>
                            </div>

                            <div class="row g-4">
                                @forelse($rewards as $reward)
                                    <div class="col-md-6">
                                        <div class="card border-0 shadow-sm rounded-4 h-100 transition-hover">
                                            <div class="card-body p-4 d-flex flex-column justify-content-between">
                                                
                                                <div>
                                                    <div class="d-flex align-items-center justify-content-between mb-3">
                                                        <div class="d-flex align-items-center">
                                                            <div class="bg-primary bg-opacity-10 text-primary rounded-3 d-flex align-items-center justify-content-center me-3" style="width: 52px; height: 52px;">
                                                                @if(str_contains(strtolower($reward->name), 'diskon'))
                                                                    <i class="bi bi-ticket-perforated fs-4"></i>
                                                                @elseif(str_contains(strtolower($reward->name), 'tenda'))
                                                                    <i class="bi bi-house-door fs-4"></i>
                                                                @elseif(str_contains(strtolower($reward->name), 'kaos'))
                                                                    <i class="bi bi-bag-heart fs-4"></i>
                                                                @else
                                                                    <i class="bi bi-cup-hot fs-4"></i>
                                                                @endif
                                                            </div>
                                                            <div>
                                                                <h6 class="fw-bold mb-1 text-dark">{{ $reward->name }}</h6>
                                                                <div class="fw-bold text-primary mb-0">
                                                                    <i class="bi bi-star-fill text-warning me-1"></i>
                                                                    {{ number_format($reward->points_required, 0, ',', '.') }} pts
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div>
                                                            @if($reward->stock > 0)
                                                                <span class="badge bg-light text-muted border small">
                                                                    Sisa: {{ $reward->stock }}
                                                                </span>
                                                            @else
                                                                <span class="badge bg-danger-subtle text-danger small">
                                                                    Habis
                                                                </span>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <p class="text-muted small mb-4">
                                                        {{ $reward->description ?? 'Tukarkan poin Anda dengan hadiah menarik ini.' }}
                                                    </p>
                                                </div>

                                                <div>
                                                    @if($reward->stock <= 0)
                                                        <button class="btn btn-outline-secondary rounded-2 w-100 py-2 fw-medium" disabled>
                                                            Stok Habis
                                                        </button>
                                                    @elseif($userPoints >= $reward->points_required)
                                                        <button 
                                                            type="button" 
                                                            class="btn btn-primary rounded-2 w-100 py-2 fw-bold btn-tukar-reward shadow-sm" 
                                                            data-bs-toggle="modal" 
                                                            data-bs-target="#modalTukarPoin" 
                                                            data-id="{{ $reward->id }}"
                                                            data-title="{{ $reward->name }}" 
                                                            data-points="{{ number_format($reward->points_required, 0, ',', '.') }}"
                                                        >
                                                            <i class="bi bi-gift me-1"></i> Tukar Poin
                                                        </button>
                                                    @else
                                                        <button class="btn btn-outline-secondary rounded-2 w-100 py-2 fw-medium small" disabled>
                                                            Poin Tidak Cukup (Kurang {{ number_format($reward->points_required - $userPoints, 0, ',', '.') }} pts)
                                                        </button>
                                                    @endif
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <div class="col-12">
                                        <div class="card border-0 shadow-sm rounded-4 p-5 text-center bg-white">
                                            <p class="text-muted mb-0">Belum ada reward yang tersedia saat ini.</p>
                                        </div>
                                    </div>
                                @endforelse
                            </div>
                        </div>

                        <!-- ══════════════════════════════════════════════════════ -->
                        <!-- TAB 2: VOUCHER SAYA (ACTIVE REWARDS)                   -->
                        <!-- ══════════════════════════════════════════════════════ -->
                        <div class="tab-pane fade" id="vouchers" role="tabpanel" tabindex="0">
                            <h5 class="fw-bold mb-3 text-dark">Voucher Aktif Anda</h5>

                            <div class="row g-4">
                                @forelse($myVouchers as $voucher)
                                    <div class="col-12">
                                        <div class="card border-0 shadow-sm rounded-4 overflow-hidden border">
                                            <div class="card-body p-0 d-flex flex-column flex-md-row">
                                                <div class="bg-primary bg-opacity-10 text-primary d-flex flex-column align-items-center justify-content-center p-4 text-center" style="min-width: 150px; border-right: 2px dashed #BAE6FD;">
                                                    <i class="bi bi-ticket-perforated fs-1 mb-2"></i>
                                                    <span class="small fw-bold text-uppercase" style="letter-spacing: 1px;">VOUCHER</span>
                                                </div>
                                                <div class="p-4 flex-grow-1 d-flex flex-column justify-content-center">
                                                    <div class="d-flex justify-content-between align-items-start flex-wrap gap-2 mb-2">
                                                        <div>
                                                            <h5 class="fw-bold mb-1 text-dark">{{ $voucher['title'] }}</h5>
                                                            <p class="text-muted small mb-0">{{ $voucher['description'] ?? 'Voucher resmi penukaran poin Maro Adventure' }}</p>
                                                        </div>
                                                        <span class="badge bg-success-subtle text-success border border-success-subtle px-3 py-1 fw-semibold">
                                                            Aktif &bull; Siap Pakai
                                                        </span>
                                                    </div>

                                                    <div class="bg-light p-3 rounded-3 my-3 d-flex align-items-center justify-content-between flex-wrap gap-2 border">
                                                        <div>
                                                            <span class="small text-muted d-block" style="font-size: 0.75rem;">KODE VOUCHER / KLAIM:</span>
                                                            <strong class="font-monospace fs-5 text-primary tracking-wide user-select-all">{{ $voucher['code'] }}</strong>
                                                        </div>
                                                        <button type="button" class="btn btn-outline-primary btn-sm px-3 rounded-pill btn-copy-code" data-code="{{ $voucher['code'] }}">
                                                            <i class="bi bi-copy me-1"></i> Salin Kode
                                                        </button>
                                                    </div>
                                                    
                                                    <div class="d-flex justify-content-between align-items-center mt-2 flex-wrap gap-2">
                                                        <div class="small text-muted">
                                                            Ditukar: {{ $voucher['redeemed_at'] }} &bull; Berlaku s/d: <strong>{{ $voucher['valid_until'] }}</strong>
                                                        </div>
                                                        <a href="{{ route('checkout.index') }}" class="btn btn-primary btn-sm px-4 rounded-pill fw-semibold shadow-sm">
                                                            Gunakan di Checkout &rarr;
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
                                                <i class="bi bi-ticket-perforated fs-2"></i>
                                            </div>
                                            <h6 class="fw-bold mb-1">Belum Ada Voucher Aktif</h6>
                                            <p class="text-muted small mb-3">Tukarkan poin yang Anda kumpulkan di tab <strong>Katalog Tukar Poin</strong> untuk mendapatkan potongan harga atau layanan gratis.</p>
                                            <div>
                                                <button type="button" class="btn btn-outline-primary btn-sm rounded-pill px-4" onclick="document.getElementById('catalog-tab').click();">
                                                    Lihat Katalog Hadiah
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                @endforelse
                            </div>
                        </div>

                        <!-- ══════════════════════════════════════════════════════ -->
                        <!-- TAB 3: RIWAYAT (HISTORY)                               -->
                        <!-- ══════════════════════════════════════════════════════ -->
                        <div class="tab-pane fade" id="history" role="tabpanel" tabindex="0">
                            <h5 class="fw-bold mb-3 text-dark">Riwayat Perolehan &amp; Pemakaian Poin</h5>
                            <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                                <div class="list-group list-group-flush border-0">
                                    
                                    @foreach($myVouchers as $v)
                                        <div class="list-group-item d-flex justify-content-between align-items-center px-4 py-3 border-0 border-bottom">
                                            <div class="d-flex align-items-center">
                                                <div class="bg-danger bg-opacity-10 text-danger rounded-circle d-flex align-items-center justify-content-center me-3 flex-shrink-0" style="width: 42px; height: 42px;">
                                                    <i class="bi bi-arrow-down-right fs-5"></i>
                                                </div>
                                                <div>
                                                    <span class="fw-bold text-dark d-block">Penukaran: {{ $v['title'] }}</span>
                                                    <span class="text-muted small">Kode: {{ $v['code'] }} &bull; {{ $v['redeemed_at'] }}</span>
                                                </div>
                                            </div>
                                            <span class="fw-bold text-danger fs-6">-{{ number_format($v['points_spent'], 0, ',', '.') }} pts</span>
                                        </div>
                                    @endforeach

                                    <!-- Riwayat Pendaftaran / Poin Awal -->
                                    <div class="list-group-item d-flex justify-content-between align-items-center px-4 py-3 border-0 border-bottom">
                                        <div class="d-flex align-items-center">
                                            <div class="bg-success bg-opacity-10 text-success rounded-circle d-flex align-items-center justify-content-center me-3 flex-shrink-0" style="width: 42px; height: 42px;">
                                                <i class="bi bi-arrow-up-right fs-5"></i>
                                            </div>
                                            <div>
                                                <span class="fw-bold text-dark d-block">Poin Registrasi Akun Pendaki</span>
                                                <span class="text-muted small">Selamat bergabung di Maro Adventure Indonesia</span>
                                            </div>
                                        </div>
                                        <span class="fw-bold text-success fs-6">+100 pts</span>
                                    </div>

                                    <div class="list-group-item d-flex justify-content-between align-items-center px-4 py-3 border-0 bg-light">
                                        <div class="d-flex align-items-center">
                                            <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-flex align-items-center justify-content-center me-3 flex-shrink-0" style="width: 42px; height: 42px;">
                                                <i class="bi bi-info-circle fs-5"></i>
                                            </div>
                                            <div>
                                                <span class="fw-bold text-dark d-block">Dapatkan Lebih Banyak Poin</span>
                                                <span class="text-muted small">Ikuti Open Trip atau bagikan cerita petualanganmu di menu Community.</span>
                                            </div>
                                        </div>
                                        <a href="{{ route('checkout.index') }}" class="btn btn-outline-primary btn-sm rounded-pill px-3">
                                            Ikuti Trip
                                        </a>
                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
            
        </div>
    </div>
</div>

<!-- ══════════════════════════════════════════════════ -->
<!-- MODAL: KONFIRMASI TUKAR POIN                     -->
<!-- ══════════════════════════════════════════════════ -->
<div class="modal fade" id="modalTukarPoin" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
            <div class="modal-header bg-primary text-white border-0 py-3">
                <h5 class="modal-title fw-bold">
                    <i class="bi bi-gift-fill me-1"></i> Konfirmasi Penukaran Poin
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('dashboard.points.redeem') }}" method="POST">
                @csrf
                <input type="hidden" name="reward_id" id="modalRewardId">
                <div class="modal-body text-center p-4">
                    <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 76px; height: 76px;">
                        <i class="bi bi-ticket-detailed fs-1"></i>
                    </div>
                    <p class="text-muted mb-1">Anda akan menukarkan <strong id="modalPointsValue" class="text-primary"></strong> poin untuk:</p>
                    <h4 class="fw-bold mb-3 text-dark" id="modalRewardTitle">Nama Hadiah</h4>
                    
                    <div class="alert alert-info border-0 small text-start mb-0 rounded-3">
                        <i class="bi bi-info-circle-fill me-1"></i> Poin Anda akan dipotong otomatis. Kode voucher dapat langsung dilihat di tab <strong>Voucher Saya</strong> dan digunakan saat checkout trip.
                    </div>
                </div>
                <div class="modal-footer bg-light border-0 d-flex justify-content-end gap-2">
                    <button type="button" class="btn btn-outline-secondary btn-sm px-4 rounded-pill" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary btn-sm px-4 rounded-pill fw-bold shadow-sm">
                        <i class="bi bi-check2-circle me-1"></i> Tukar Sekarang
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    .nav-pills .nav-link {
        transition: all 0.2s ease;
    }
    .nav-pills .nav-link.active {
        background-color: var(--color-primary, #0EA5E9) !important;
        color: #ffffff !important;
        box-shadow: 0 4px 12px rgba(14, 165, 233, 0.25);
    }
    .transition-hover {
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    .transition-hover:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 24px rgba(12, 74, 110, 0.08) !important;
    }
</style>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Modal Tukar Poin Data Binding
    const modalTukar = document.getElementById('modalTukarPoin');
    if (modalTukar) {
        modalTukar.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            if (!button) return;

            const id = button.getAttribute('data-id');
            const title = button.getAttribute('data-title');
            const points = button.getAttribute('data-points');

            document.getElementById('modalRewardId').value = id;
            document.getElementById('modalRewardTitle').textContent = title;
            document.getElementById('modalPointsValue').textContent = points;
        });
    }

    // Copy Voucher Code Button
    document.querySelectorAll('.btn-copy-code').forEach(btn => {
        btn.addEventListener('click', function () {
            const code = this.getAttribute('data-code');
            if (navigator.clipboard) {
                navigator.clipboard.writeText(code).then(() => {
                    const originalHtml = this.innerHTML;
                    this.innerHTML = '<i class="bi bi-check2"></i> Tersalin!';
                    this.classList.remove('btn-outline-primary');
                    this.classList.add('btn-success');
                    setTimeout(() => {
                        this.innerHTML = originalHtml;
                        this.classList.remove('btn-success');
                        this.classList.add('btn-outline-primary');
                    }, 2000);
                });
            }
        });
    });
});
</script>
@endpush

@endsection
