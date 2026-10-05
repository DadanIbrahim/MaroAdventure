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
                    
                    <!-- Top Card (Points Info) -->
                    <div class="card border-0 shadow-sm rounded-4 mb-4" style="background-color: var(--color-dark, #0C4A6E);">
                        <div class="card-body p-4 p-lg-5 text-white">
                            <div class="row align-items-center">
                                <div class="col-md-6 mb-4 mb-md-0">
                                    <p class="small text-uppercase tracking-wide opacity-75 mb-1">MARO POINTS</p>
                                    <h1 class="fw-bold mb-0 display-5">2.450</h1>
                                </div>
                                <div class="col-md-6 text-md-end">
                                    <div class="d-flex justify-content-between mb-2">
                                        <span class="fw-bold">Silver Level</span>
                                        <span class="small opacity-75">550 points to next level</span>
                                    </div>
                                    <div class="progress" style="height: 8px; background-color: rgba(255,255,255,0.2);">
                                        <div class="progress-bar bg-white" role="progressbar" style="width: 75%;" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Navigation Tabs -->
                    <ul class="nav nav-pills mb-4 gap-2" id="pointsTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active rounded-pill px-4 py-2" id="catalog-tab" data-bs-toggle="pill" data-bs-target="#catalog" type="button" role="tab">Katalog Tukar Poin</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link rounded-pill px-4 py-2 text-dark bg-white border" id="vouchers-tab" data-bs-toggle="pill" data-bs-target="#vouchers" type="button" role="tab">Voucher Saya</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link rounded-pill px-4 py-2 text-dark bg-white border" id="history-tab" data-bs-toggle="pill" data-bs-target="#history" type="button" role="tab">Riwayat Poin & Hadiah</button>
                        </li>
                    </ul>

                    <!-- Tabs Content -->
                    <div class="tab-content" id="pointsTabsContent">
                        
                        <!-- TAB 1: KATALOG (REWARDS) -->
                        <div class="tab-pane fade show active" id="catalog" role="tabpanel" tabindex="0">
                            <h5 class="fw-bold mb-3 mt-2">Katalog Hadiah</h5>
                            <div class="row g-4">
                                <!-- Reward 1 -->
                                <div class="col-md-6">
                                    <div class="card border-0 shadow-sm rounded-4 h-100">
                                        <div class="card-body p-4 d-flex flex-column">
                                            <div class="d-flex align-items-center mb-3">
                                                <div class="bg-primary bg-opacity-10 text-primary rounded-3 d-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px;">
                                                    <i class="bi bi-ticket-perforated fs-4"></i>
                                                </div>
                                                <div>
                                                    <h6 class="fw-bold mb-1">Diskon Trip 50K</h6>
                                                    <div class="fw-bold text-primary mb-1">1.200 pts</div>
                                                </div>
                                            </div>
                                            <p class="text-muted small mb-4 flex-grow-1">Potongan langsung Rp 50.000 untuk pendaftaran trip selanjutnya.</p>
                                            <button type="button" class="btn btn-dark rounded-1 w-100 py-2 fw-medium" data-bs-toggle="modal" data-bs-target="#modalTukarPoin" data-title="Diskon Trip 50K" data-points="1.200">Tukar Poin</button>
                                        </div>
                                    </div>
                                </div>
                                <!-- Reward 2 -->
                                <div class="col-md-6">
                                    <div class="card border-0 shadow-sm rounded-4 h-100">
                                        <div class="card-body p-4 d-flex flex-column">
                                            <div class="d-flex align-items-center mb-3">
                                                <div class="bg-success bg-opacity-10 text-success rounded-3 d-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px;">
                                                    <i class="bi bi-house-door fs-4"></i>
                                                </div>
                                                <div>
                                                    <h6 class="fw-bold mb-1">Sewa Tenda (1 Malam)</h6>
                                                    <div class="fw-bold text-success mb-1">1.500 pts</div>
                                                </div>
                                            </div>
                                            <p class="text-muted small mb-4 flex-grow-1">Gratis sewa tenda kapasitas 2 orang untuk 1 malam.</p>
                                            <button type="button" class="btn btn-dark rounded-1 w-100 py-2 fw-medium" data-bs-toggle="modal" data-bs-target="#modalTukarPoin" data-title="Sewa Tenda (1 Malam)" data-points="1.500">Tukar Poin</button>
                                        </div>
                                    </div>
                                </div>
                                <!-- Reward 3 -->
                                <div class="col-md-6">
                                    <div class="card border-0 shadow-sm rounded-4 h-100 opacity-75">
                                        <div class="card-body p-4 d-flex flex-column">
                                            <div class="d-flex align-items-center mb-3">
                                                <div class="bg-warning bg-opacity-10 text-warning rounded-3 d-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px;">
                                                    <i class="bi bi-bag-heart fs-4"></i>
                                                </div>
                                                <div>
                                                    <h6 class="fw-bold mb-1">Kaos Exclusive Maro</h6>
                                                    <div class="fw-bold text-muted mb-1">3.000 pts</div>
                                                </div>
                                            </div>
                                            <p class="text-muted small mb-4 flex-grow-1">Merchandise eksklusif edisi terbatas untuk pendaki sejati.</p>
                                            <button class="btn btn-outline-secondary rounded-1 w-100 py-2 fw-medium" disabled>Poin Tidak Cukup</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- TAB 2: VOUCHER SAYA (ACTIVE REWARDS) -->
                        <div class="tab-pane fade" id="vouchers" role="tabpanel" tabindex="0">
                            <h5 class="fw-bold mb-3 mt-2">Voucher Aktif Anda</h5>
                            <div class="row g-4">
                                <!-- Voucher Item 1 -->
                                <div class="col-12">
                                    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                                        <div class="card-body p-0 d-flex flex-column flex-md-row">
                                            <div class="bg-primary bg-opacity-10 text-primary d-flex flex-column align-items-center justify-content-center p-4 text-center" style="min-width: 140px; border-right: 2px dashed #cfe2ff;">
                                                <i class="bi bi-ticket-perforated fs-1 mb-2"></i>
                                                <span class="small fw-bold text-uppercase">VOUCHER</span>
                                            </div>
                                            <div class="p-4 flex-grow-1 d-flex flex-column justify-content-center">
                                                <h5 class="fw-bold mb-1">Diskon Trip Rp 50.000</h5>
                                                <p class="text-muted small mb-3">Kode: <span class="fw-bold text-dark user-select-all">MARO-50K-XYZ</span></p>
                                                
                                                <div class="d-flex justify-content-between align-items-center mt-auto">
                                                    <div class="small">
                                                        <span class="d-block text-muted" style="font-size: 0.75rem;">Berlaku hingga</span>
                                                        <span class="fw-semibold">31 Des 2026</span>
                                                    </div>
                                                    <button type="button" class="btn btn-dark px-4 rounded-1 fw-medium" data-bs-toggle="modal" data-bs-target="#modalGunakanVoucher" data-code="MARO-50K-XYZ" data-title="Diskon Trip Rp 50.000">Gunakan</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Voucher Item 2 -->
                                <div class="col-12">
                                    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                                        <div class="card-body p-0 d-flex flex-column flex-md-row">
                                            <div class="bg-success bg-opacity-10 text-success d-flex flex-column align-items-center justify-content-center p-4 text-center" style="min-width: 140px; border-right: 2px dashed #d1e7dd;">
                                                <i class="bi bi-house-door fs-1 mb-2"></i>
                                                <span class="small fw-bold text-uppercase">LAYANAN</span>
                                            </div>
                                            <div class="p-4 flex-grow-1 d-flex flex-column justify-content-center">
                                                <h5 class="fw-bold mb-1">Gratis Sewa Tenda</h5>
                                                <p class="text-muted small mb-3">Tunjukkan e-voucher ini ke petugas di Basecamp.</p>
                                                
                                                <div class="d-flex justify-content-between align-items-center mt-auto">
                                                    <div class="small">
                                                        <span class="d-block text-muted" style="font-size: 0.75rem;">Berlaku hingga</span>
                                                        <span class="fw-semibold">15 Nov 2026</span>
                                                    </div>
                                                    <button type="button" class="btn btn-dark px-4 rounded-1 fw-medium" data-bs-toggle="modal" data-bs-target="#modalGunakanLayanan" data-title="Gratis Sewa Tenda">Lihat Barcode</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- TAB 3: RIWAYAT (HISTORY) -->
                        <div class="tab-pane fade" id="history" role="tabpanel" tabindex="0">
                            <h5 class="fw-bold mb-3 mt-2">Riwayat Aktivitas</h5>
                            <div class="card border-0 shadow-sm rounded-4">
                                <div class="list-group list-group-flush border-0 rounded-4">
                                    <!-- History Items -->
                                    <div class="list-group-item d-flex justify-content-between align-items-center px-4 py-3 border-0 border-bottom">
                                        <div class="d-flex align-items-center">
                                            <div class="bg-danger bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px;">
                                                <i class="bi bi-arrow-down-right text-danger"></i>
                                            </div>
                                            <div>
                                                <span class="fw-bold text-dark d-block">Tukar Poin: Diskon Trip 50K</span>
                                                <span class="text-muted small">5 Okt 2026</span>
                                            </div>
                                        </div>
                                        <span class="fw-bold text-danger">-1.200 pts</span>
                                    </div>
                                    
                                    <div class="list-group-item d-flex justify-content-between align-items-center px-4 py-3 border-0 border-bottom">
                                        <div class="d-flex align-items-center">
                                            <div class="bg-success bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px;">
                                                <i class="bi bi-arrow-up-right text-success"></i>
                                            </div>
                                            <div>
                                                <span class="fw-bold text-dark d-block">Selesai Open Trip G. Prau</span>
                                                <span class="text-muted small">4 Okt 2026</span>
                                            </div>
                                        </div>
                                        <span class="fw-bold text-success">+500 pts</span>
                                    </div>
                                    
                                    <div class="list-group-item d-flex justify-content-between align-items-center px-4 py-3 border-0 border-bottom">
                                        <div class="d-flex align-items-center">
                                            <div class="bg-success bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px;">
                                                <i class="bi bi-arrow-up-right text-success"></i>
                                            </div>
                                            <div>
                                                <span class="fw-bold text-dark d-block">Memberikan Ulasan</span>
                                                <span class="text-muted small">2 Okt 2026</span>
                                            </div>
                                        </div>
                                        <span class="fw-bold text-success">+100 pts</span>
                                    </div>

                                    <div class="list-group-item d-flex justify-content-between align-items-center px-4 py-3 border-0 bg-light opacity-75">
                                        <div class="d-flex align-items-center">
                                            <div class="bg-secondary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px;">
                                                <i class="bi bi-cup-hot text-secondary"></i>
                                            </div>
                                            <div>
                                                <span class="fw-bold text-dark d-block text-decoration-line-through">Voucher Dipakai: Gratis Kopi</span>
                                                <span class="text-muted small">15 Sep 2026</span>
                                            </div>
                                        </div>
                                        <span class="badge bg-secondary">Selesai</span>
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

<style>
    /* Styling for Pills */
    .nav-pills .nav-link {
        transition: all 0.2s ease;
    }
    .nav-pills .nav-link:hover:not(.active) {
        background-color: #f8f9fa !important;
    }
    .nav-pills .nav-link.active {
        background-color: var(--color-primary, #0EA5E9) !important;
        color: white !important;
        border-color: var(--color-primary, #0EA5E9) !important;
    }
    
    @media (max-width: 768px) {
        .nav-pills {
            flex-wrap: nowrap;
            overflow-x: auto;
            padding-bottom: 10px;
        }
        .nav-pills::-webkit-scrollbar {
            display: none;
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Simple logic to switch between tabs
        const tabBtns = document.querySelectorAll('[data-bs-toggle="pill"]');
        
        tabBtns.forEach(btn => {
            btn.addEventListener('shown.bs.tab', function (event) {
                // Set the active styling appropriately
                tabBtns.forEach(b => {
                    b.classList.remove('active', 'bg-primary', 'text-white');
                    b.classList.add('text-dark', 'bg-white');
                });
                
                event.target.classList.add('active');
                event.target.classList.remove('text-dark', 'bg-white');
            });
        });
    });
</script>

<!-- Modal Tukar Poin -->
<div class="modal fade" id="modalTukarPoin" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fw-bold">Konfirmasi Penukaran</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center py-4">
                <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 70px; height: 70px;">
                    <i class="bi bi-gift fs-1"></i>
                </div>
                <p class="mb-1">Anda akan menukarkan <strong id="modal-poin" class="text-primary"></strong> pts untuk hadiah:</p>
                <h4 class="fw-bold mb-4" id="modal-hadiah-title">Nama Hadiah</h4>
                <div class="alert alert-secondary border-0 small text-start mb-0">
                    <i class="bi bi-info-circle me-1"></i> Poin akan langsung dipotong dari saldo Anda. Hadiah dapat dilihat di tab <strong>Voucher Saya</strong> setelah ditukarkan.
                </div>
            </div>
            <div class="modal-footer border-0 pt-0 d-flex gap-2 justify-content-center">
                <button type="button" class="btn btn-outline-dark rounded-1 px-4" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-dark rounded-1 px-4" data-bs-dismiss="modal" onclick="alert('Berhasil ditukarkan! (Hanya simulasi)')">Tukar Sekarang</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Gunakan Voucher -->
<div class="modal fade" id="modalGunakanVoucher" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fw-bold" id="modal-voucher-title">Diskon Trip Rp 50.000</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center py-4">
                <p class="text-muted small mb-2">Gunakan kode ini saat melakukan checkout</p>
                <div class="d-flex justify-content-center align-items-center gap-2 mb-4">
                    <div class="bg-light border border-2 border-dark rounded-3 px-4 py-3">
                        <h3 class="fw-bold tracking-wide mb-0" style="letter-spacing: 2px;" id="modal-voucher-code">MARO-50K-XYZ</h3>
                    </div>
                </div>
                <button type="button" class="btn btn-dark rounded-1 px-4 py-2" onclick="navigator.clipboard.writeText(document.getElementById('modal-voucher-code').innerText); alert('Kode berhasil disalin!');">
                    <i class="bi bi-copy me-2"></i>Salin Kode
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Gunakan Layanan (Barcode) -->
<div class="modal fade" id="modalGunakanLayanan" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fw-bold" id="modal-layanan-title">Gratis Sewa Tenda</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center py-4">
                <p class="text-muted small mb-3">Tunjukkan QR Code ini kepada admin/petugas kami di basecamp untuk divalidasi.</p>
                <div class="bg-light rounded-3 d-inline-block p-3 mb-3 border">
                    <i class="bi bi-qr-code text-dark" style="font-size: 8rem; line-height: 1;"></i>
                </div>
                <p class="fw-bold mb-0">ID: SRV-789-QWERT</p>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Modal Tukar Poin Data Binding
        const modalTukar = document.getElementById('modalTukarPoin');
        if(modalTukar) {
            modalTukar.addEventListener('show.bs.modal', function (event) {
                const button = event.relatedTarget;
                const title = button.getAttribute('data-title');
                const points = button.getAttribute('data-points');
                
                document.getElementById('modal-hadiah-title').textContent = title;
                document.getElementById('modal-poin').textContent = points;
            });
        }

        // Modal Gunakan Voucher Data Binding
        const modalVoucher = document.getElementById('modalGunakanVoucher');
        if(modalVoucher) {
            modalVoucher.addEventListener('show.bs.modal', function (event) {
                const button = event.relatedTarget;
                const title = button.getAttribute('data-title');
                const code = button.getAttribute('data-code');
                
                document.getElementById('modal-voucher-title').textContent = title;
                document.getElementById('modal-voucher-code').textContent = code;
            });
        }
        
        // Modal Layanan Data Binding
        const modalLayanan = document.getElementById('modalGunakanLayanan');
        if(modalLayanan) {
            modalLayanan.addEventListener('show.bs.modal', function (event) {
                const button = event.relatedTarget;
                const title = button.getAttribute('data-title');
                document.getElementById('modal-layanan-title').textContent = title;
            });
        }
    });
</script>

@endsection
