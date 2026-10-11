@extends('layouts.app')

@section('title', 'Profile & Pengaturan Akun - Maro Adventure')

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
                    
                    <!-- Header Section -->
                    <div class="mb-4">
                        <h2 class="fw-bold mb-1" style="color: var(--color-dark);">Profile &amp; Pengaturan</h2>
                        <p class="text-muted">Kelola identitas pendaki, nomor WhatsApp untuk koordinasi trip, dan keamanan akunmu.</p>
                    </div>

                    <!-- Alerts -->
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

                    @if($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show rounded-3 mb-4 border-0 shadow-sm" role="alert">
                            <div class="fw-bold mb-1"><i class="bi bi-exclamation-triangle-fill me-2"></i>Terdapat beberapa kesalahan:</div>
                            <ul class="mb-0 ps-3 small">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <!-- CARD 1: INFORMASI PROFIL & KONTAK -->
                    <div class="card border-0 shadow-sm rounded-4 mb-4">
                        <div class="card-header bg-white py-3 px-4 border-bottom">
                            <h5 class="fw-bold mb-0 text-dark">
                                <i class="bi bi-person-badge-fill text-primary me-2"></i> Informasi Pribadi &amp; Kontak
                            </h5>
                        </div>
                        <div class="card-body p-4">
                            <form action="{{ route('dashboard.profile.update') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="row align-items-center g-4">
                                    
                                    <!-- Avatar Column -->
                                    <div class="col-md-4 col-lg-3 text-center">
                                        <div class="position-relative d-inline-block mb-3">
                                            <img 
                                                id="avatarPreview"
                                                src="{{ auth()->user()->avatar_url }}" 
                                                alt="{{ auth()->user()->name }}" 
                                                class="rounded-circle shadow-sm object-fit-cover"
                                                style="width: 130px; height: 130px; border: 3.5px solid #BAE6FD;"
                                            >
                                        </div>
                                        <div>
                                            <input type="file" name="avatar" id="avatarInput" accept="image/png,image/jpeg,image/webp" class="d-none">
                                            <button type="button" id="uploadAvatarBtn" class="btn btn-outline-primary btn-sm px-3 rounded-pill fw-semibold mb-1">
                                                <i class="bi bi-camera me-1"></i> Pilih Foto
                                            </button>
                                            <p class="text-muted small mb-0" style="font-size: 0.75rem;">JPG, PNG, WEBP maks 2MB</p>
                                        </div>
                                    </div>

                                    <!-- Form Inputs Column -->
                                    <div class="col-md-8 col-lg-9">
                                        <div class="row g-3">
                                            
                                            <!-- Nama Lengkap -->
                                            <div class="col-12">
                                                <label for="name" class="form-label small fw-bold text-dark">Nama Lengkap <span class="text-danger">*</span></label>
                                                <input 
                                                    type="text" 
                                                    name="name" 
                                                    id="name"
                                                    class="form-control px-3 py-2" 
                                                    value="{{ old('name', auth()->user()->name) }}"
                                                    placeholder="Nama Anda"
                                                    required
                                                >
                                            </div>

                                            <!-- Email -->
                                            <div class="col-md-6">
                                                <label class="form-label small fw-bold text-dark">Alamat Email</label>
                                                <input 
                                                    type="email" 
                                                    class="form-control px-3 py-2 bg-light text-muted" 
                                                    value="{{ auth()->user()->email }}" 
                                                    readonly
                                                >
                                                <div class="form-text small" style="font-size: 0.75rem;">
                                                    <i class="bi bi-lock-fill me-1"></i> Email permanen untuk login akun.
                                                </div>
                                            </div>

                                            <!-- Nomor WhatsApp -->
                                            <div class="col-md-6">
                                                <label for="phone" class="form-label small fw-bold text-dark">Nomor WhatsApp / HP</label>
                                                <div class="input-group">
                                                    <span class="input-group-text bg-light text-muted fw-semibold">
                                                        <i class="bi bi-whatsapp text-success me-1"></i>
                                                    </span>
                                                    <input 
                                                        type="tel" 
                                                        name="phone" 
                                                        id="phone"
                                                        class="form-control px-3 py-2" 
                                                        value="{{ old('phone', auth()->user()->phone) }}"
                                                        placeholder="Contoh: 085894535172"
                                                    >
                                                </div>
                                                <div class="form-text small" style="font-size: 0.75rem;">
                                                    Digunakan untuk undangan grup WhatsApp briefing pendakian.
                                                </div>
                                            </div>

                                            <!-- Info Badge Bar -->
                                            <div class="col-12 pt-2">
                                                <div class="p-3 bg-light rounded-3 d-flex flex-wrap align-items-center justify-content-between gap-2 border">
                                                    <div>
                                                        <span class="small text-muted me-2">Peran Akun:</span>
                                                        @if(auth()->user()->role === 'superadmin')
                                                            <span class="badge bg-danger">Superadmin</span>
                                                        @elseif(auth()->user()->role === 'admin')
                                                            <span class="badge bg-primary">Admin</span>
                                                        @else
                                                            <span class="badge bg-secondary-subtle text-secondary fw-semibold">Pendaki (Member)</span>
                                                        @endif
                                                    </div>
                                                    <div>
                                                        <span class="small text-muted me-2">Maro Points:</span>
                                                        <span class="badge bg-warning-subtle text-warning-emphasis fw-bold">
                                                            <i class="bi bi-star-fill text-warning me-1"></i> {{ number_format(auth()->user()->points ?? 0, 0, ',', '.') }} Poin
                                                        </span>
                                                    </div>
                                                    <div class="small text-muted">
                                                        <i class="bi bi-calendar-check me-1"></i> Bergabung: {{ auth()->user()->created_at ? auth()->user()->created_at->format('d M Y') : '-' }}
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Submit Button -->
                                            <div class="col-12 mt-4">
                                                <button type="submit" class="btn btn-primary fw-bold px-4 py-2 rounded-2 shadow-sm">
                                                    <i class="bi bi-check2-circle me-1"></i> Simpan Profil
                                                </button>
                                            </div>

                                        </div>
                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- CARD 2: KEAMANAN & GANTI PASSWORD -->
                    <div class="card border-0 shadow-sm rounded-4">
                        <div class="card-header bg-white py-3 px-4 border-bottom">
                            <h5 class="fw-bold mb-0 text-dark">
                                <i class="bi bi-shield-lock-fill text-danger me-2"></i> Keamanan &amp; Kata Sandi
                            </h5>
                        </div>
                        <div class="card-body p-4">
                            <form action="{{ route('dashboard.profile.password') }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="row g-3" style="max-width: 600px;">
                                    
                                    <div class="col-12">
                                        <label for="current_password" class="form-label small fw-bold text-dark">
                                            Password Saat Ini <span class="text-danger">*</span>
                                        </label>
                                        <input 
                                            type="password" 
                                            name="current_password" 
                                            id="current_password" 
                                            class="form-control px-3 py-2" 
                                            placeholder="Masukkan password saat ini"
                                            required
                                        >
                                    </div>

                                    <div class="col-md-6">
                                        <label for="password" class="form-label small fw-bold text-dark">
                                            Password Baru <span class="text-danger">*</span>
                                        </label>
                                        <input 
                                            type="password" 
                                            name="password" 
                                            id="password" 
                                            class="form-control px-3 py-2" 
                                            placeholder="Minimal 6 karakter"
                                            required
                                        >
                                    </div>

                                    <div class="col-md-6">
                                        <label for="password_confirmation" class="form-label small fw-bold text-dark">
                                            Ulangi Password Baru <span class="text-danger">*</span>
                                        </label>
                                        <input 
                                            type="password" 
                                            name="password_confirmation" 
                                            id="password_confirmation" 
                                            class="form-control px-3 py-2" 
                                            placeholder="Konfirmasi password"
                                            required
                                        >
                                    </div>

                                    <div class="col-12 mt-3">
                                        <button type="submit" class="btn btn-outline-dark fw-bold px-4 py-2 rounded-2">
                                            <i class="bi bi-key-fill me-1"></i> Perbarui Password
                                        </button>
                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
            
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const uploadAvatarBtn = document.getElementById('uploadAvatarBtn');
    const avatarInput = document.getElementById('avatarInput');
    const avatarPreview = document.getElementById('avatarPreview');

    if (uploadAvatarBtn && avatarInput) {
        uploadAvatarBtn.addEventListener('click', function () {
            avatarInput.click();
        });

        avatarInput.addEventListener('change', function () {
            if (this.files && this.files[0]) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    if (avatarPreview) {
                        avatarPreview.src = e.target.result;
                    }
                };
                reader.readAsDataURL(this.files[0]);
            }
        });
    }
});
</script>
@endpush
@endsection
