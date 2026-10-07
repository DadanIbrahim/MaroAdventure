@extends('layouts.app')

@section('title', 'Masuk - Maro Adventure Indonesia')

@section('content')
<div class="auth-page-wrapper min-vh-100 py-4 py-md-5 d-flex align-items-center justify-content-center position-relative bg-dark overflow-auto">
    <!-- Nature Background with HD -->
    <div class="position-fixed top-0 start-0 w-100 h-100" style="background-image: url('{{ asset('assets/images/hero_mountain.jpg') }}'); background-size: cover; background-position: center; pointer-events: none; z-index: 0;"></div>
    
    <div class="container position-relative" style="z-index: 1;">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-10 col-xl-9">
                <div class="card border-0 shadow-lg overflow-hidden rounded-4 auth-card bg-transparent">
                    <div class="row g-0">
                        
                        <!-- Left Sidebar -->
                        <div class="col-lg-5 auth-sidebar d-none d-lg-flex flex-column justify-content-between p-4 p-md-5 text-white position-relative overflow-hidden" style="background: rgba(0, 0, 0, 0.5); backdrop-filter: blur(8px); border-right: 1px solid rgba(255,255,255,0.1); min-height: 480px;">
                            
                            <!-- Top Brand -->
                            <div class="position-relative z-1 mb-4">
                                <a class="d-flex align-items-center text-white text-decoration-none" href="{{ url('/') }}">
                                    <div class="brand-icon me-3 bg-white rounded-circle d-flex align-items-center justify-content-center shadow-sm" style="width: 48px; height: 48px;">
                                        <img src="{{ asset('assets/images/brand_maro.png') }}" alt="Logo Maro Adventure" class="img-fluid" style="max-height: 28px; object-fit: contain;">
                                    </div>
                                    <span class="fw-bold fs-3 tracking-wider font-heading mb-0" style="line-height: 1;">Maro Adventure</span>
                                </a>
                            </div>

                            <!-- Bottom Tagline -->
                            <div class="position-relative z-1 mt-auto">
                                <p class="small text-white-75 mb-0 leading-relaxed font-body">
                                    Temukan cerita, gunung, dan perjalanan berikutnya bersama MARO Adventure.
                                </p>
                            </div>
                        </div>

                        <!-- Right Form Container (Mobile & Desktop) -->
                        <div class="col-12 col-lg-7 p-4 p-md-5 d-flex flex-column justify-content-center" style="background: rgba(255, 255, 255, 0.3); backdrop-filter: blur(15px);">
                            <!-- Mobile Brand Header -->
                            <div class="d-lg-none text-center mb-4 d-flex justify-content-center">
                                <a class="d-flex align-items-center text-dark text-decoration-none" href="{{ url('/') }}">
                                    <div class="brand-icon me-3 bg-white rounded-circle d-flex align-items-center justify-content-center shadow-sm border border-light" style="width: 48px; height: 48px;">
                                        <img src="{{ asset('assets/images/brand_maro.png') }}" alt="Logo Maro Adventure" class="img-fluid" style="max-height: 28px; object-fit: contain;">
                                    </div>
                                    <span class="fw-bold fs-2 tracking-wider font-heading mb-0" style="line-height: 1;">Maro Adventure</span>
                                </a>
                            </div>

                            <div class="auth-form-header mb-4">
                                <h2 class="fw-bold text-dark mb-1 font-heading">Welcome Back</h2>
                                <p class="text-muted small">Login untuk melanjutkan petualanganmu.</p>
                            </div>

                            @if(session('success'))
                                <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-4" role="alert">
                                    <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif

                            @if($errors->any())
                                <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm mb-4" role="alert">
                                    <i class="bi bi-exclamation-triangle me-2"></i>{{ $errors->first() }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif

                            <form action="{{ route('login') }}" method="POST" class="auth-form">
                                @csrf

                                <!-- Email or ID -->
                                <div class="mb-3">
                                    <label for="email" class="form-label small fw-semibold text-secondary">Email / Admin ID</label>
                                    <input 
                                        type="text" 
                                        name="email" 
                                        id="email" 
                                        class="form-control form-control-lg @error('email') is-invalid @enderror" 
                                        placeholder="Masukan Email / ID" 
                                        value="{{ old('email') }}" 
                                        required 
                                        autofocus
                                    >
                                </div>

                                <!-- Password -->
                                <div class="mb-3">
                                    <label for="password" class="form-label small fw-semibold text-secondary">Password</label>
                                    <div class="position-relative">
                                        <input 
                                            type="password" 
                                            name="password" 
                                            id="password" 
                                            class="form-control form-control-lg pe-5 @error('password') is-invalid @enderror" 
                                            placeholder="Masukkan kata sandi" 
                                            required
                                        >
                                        <button type="button" id="togglePassword" class="btn border-0 bg-transparent text-muted position-absolute top-50 end-0 translate-middle-y px-3" tabindex="-1">
                                            <i class="bi bi-eye" id="toggleIcon"></i>
                                        </button>
                                    </div>
                                </div>

                                <!-- Remember & Forgot -->
                                <div class="d-flex align-items-center justify-content-between mb-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                        <label class="form-check-label small text-secondary" for="remember">
                                            Remember me
                                        </label>
                                    </div>
                                    <a href="#" class="small text-primary text-decoration-none fw-medium" onclick="alert('Fitur reset password via email akan hadir segera. Silakan hubungi admin Maro jika terkendala.'); return false;">
                                        Forgot password?
                                    </a>
                                </div>

                                <!-- Submit Button -->
                                <button type="submit" class="btn btn-dark w-100 fw-bold rounded-3 py-2 text-uppercase tracking-wider shadow-sm mb-3 btn-auth-submit">
                                    LOGIN
                                </button>

                                <!-- Divider -->
                                <div class="d-flex align-items-center my-3">
                                    <hr class="flex-grow-1 my-0 text-muted opacity-25">
                                    <span class="px-2 small text-muted font-body">atau</span>
                                    <hr class="flex-grow-1 my-0 text-muted opacity-25">
                                </div>

                                <!-- Google Login Button -->
                                <a href="{{ route('auth.google') }}" class="btn btn-outline-secondary w-100 py-2.5 rounded-3 d-flex align-items-center justify-content-center gap-2 font-body fw-semibold mb-4 border-secondary-subtle text-dark shadow-xs text-decoration-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 48 48">
                                        <path fill="#FFC107" d="M43.611 20.083H42V20H24v8h11.303c-1.649 4.657-6.08 8-11.303 8-6.627 0-12-5.373-12-12s5.373-12 12-12c3.059 0 5.842 1.154 7.961 3.039l5.657-5.657C34.046 6.053 29.268 4 24 4 12.955 4 4 12.955 4 24s8.955 20 20 20 20-8.955 20-20c0-1.341-.138-2.65-.389-3.917z"/>
                                        <path fill="#FF3D00" d="m6.306 14.691 6.571 4.819C14.655 15.108 18.961 12 24 12c3.059 0 5.842 1.154 7.961 3.039l5.657-5.657C34.046 6.053 29.268 4 24 4 16.318 4 9.656 8.337 6.306 14.691z"/>
                                        <path fill="#4CAF50" d="M24 44c5.166 0 9.86-1.977 13.409-5.192l-6.19-5.238A11.91 11.91 0 0 1 24 36c-5.202 0-9.619-3.317-11.283-7.946l-6.522 5.025C9.505 39.556 16.227 44 24 44z"/>
                                        <path fill="#1976D2" d="M43.611 20.083H42V20H24v8h11.303a12.04 12.04 0 0 1-4.087 5.571l.003-.002 6.19 5.238C36.971 39.205 44 34 44 24c0-1.341-.138-2.65-.389-3.917z"/>
                                    </svg>
                                    Masuk dengan Google
                                </a>

                                <!-- Register Link -->
                                <div class="text-center">
                                    <span class="small text-muted">Don't have an account? </span>
                                    <a href="{{ route('register') }}" class="small text-primary fw-bold text-decoration-none ms-1">Register</a>
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
    document.addEventListener('DOMContentLoaded', function() {
        const togglePassword = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('password');
        const toggleIcon = document.getElementById('toggleIcon');
        
        if (togglePassword && passwordInput) {
            togglePassword.addEventListener('click', function() {
                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput.setAttribute('type', type);
                
                if (type === 'text') {
                    toggleIcon.classList.remove('bi-eye');
                    toggleIcon.classList.add('bi-eye-slash');
                } else {
                    toggleIcon.classList.remove('bi-eye-slash');
                    toggleIcon.classList.add('bi-eye');
                }
            });
        }
    });
</script>
@endpush

@endsection
