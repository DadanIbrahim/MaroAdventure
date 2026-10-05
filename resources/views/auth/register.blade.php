@extends('layouts.app')

@section('title', 'Daftar - Maro Adventure Indonesia')

@section('content')
<div class="auth-page-wrapper min-vh-100 d-flex align-items-center justify-content-center py-4 py-md-5 bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-10 col-xl-9">
                <div class="card border-0 shadow-lg overflow-hidden rounded-4 auth-card">
                    <div class="row g-0">
                        
                        <!-- Left Sidebar (Desktop Only: Full Image Background) -->
                        <div class="col-lg-5 auth-sidebar d-none d-lg-flex flex-column justify-content-between p-4 p-md-5 text-white position-relative overflow-hidden" style="background-image: url('{{ asset('assets/images/hero_mountain.jpg') }}'); background-size: cover; background-position: center; min-height: 480px;">
                            <!-- Dark Overlay for readability -->
                            <div class="position-absolute inset-0" style="background: rgba(0, 0, 0, 0.45); top:0; bottom:0; left:0; right:0;"></div>
                            
                            <!-- Top Brand -->
                            <div class="position-relative z-1 mb-4">
                                <a href="{{ url('/') }}" class="text-white text-decoration-none fw-bold fs-3 tracking-wider font-heading d-inline-block">
                                    MARO
                                </a>
                            </div>

                            <!-- Bottom Tagline -->
                            <div class="position-relative z-1 mt-auto">
                                <p class="small text-white-50 mb-0 leading-relaxed font-body">
                                    Temukan cerita, gunung, dan perjalanan berikutnya bersama MARO Adventure.
                                </p>
                            </div>
                        </div>

                        <!-- Right Form Container (Mobile & Desktop) -->
                        <div class="col-12 col-lg-7 p-4 p-md-5 bg-white d-flex flex-column justify-content-center">
                            <!-- Mobile Brand Header -->
                            <div class="d-lg-none text-center mb-4">
                                <a href="{{ url('/') }}" class="text-dark text-decoration-none fw-bold fs-2 tracking-wider font-heading d-inline-block">
                                    MARO
                                </a>
                            </div>

                            <div class="auth-form-header mb-4">
                                <h2 class="fw-bold text-dark mb-1 font-heading">Create Account</h2>
                                <p class="text-muted small">Daftar dan mulai perjalanan bersama MARO.</p>
                            </div>

                            @if($errors->any())
                                <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm mb-4" role="alert">
                                    <i class="bi bi-exclamation-triangle me-2"></i>{{ $errors->first() }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif

                            <form action="{{ route('register') }}" method="POST" class="auth-form">
                                @csrf

                                <!-- Name -->
                                <div class="mb-3">
                                    <label for="name" class="form-label small fw-semibold text-secondary">Name</label>
                                    <input 
                                        type="text" 
                                        name="name" 
                                        id="name" 
                                        class="form-control form-control-lg @error('name') is-invalid @enderror" 
                                        placeholder="Nama lengkap Anda" 
                                        value="{{ old('name') }}" 
                                        required 
                                        autofocus
                                    >
                                </div>

                                <!-- Email -->
                                <div class="mb-3">
                                    <label for="email" class="form-label small fw-semibold text-secondary">Email</label>
                                    <input 
                                        type="email" 
                                        name="email" 
                                        id="email" 
                                        class="form-control form-control-lg @error('email') is-invalid @enderror" 
                                        placeholder="Masukkan Email" 
                                        value="{{ old('email') }}" 
                                        required
                                    >
                                </div>

                                <!-- Phone -->
                                <div class="mb-3">
                                    <label for="phone" class="form-label small fw-semibold text-secondary">Phone</label>
                                    <input 
                                        type="tel" 
                                        name="phone" 
                                        id="phone" 
                                        class="form-control form-control-lg @error('phone') is-invalid @enderror" 
                                        placeholder="Masukkan Nomor HP" 
                                        value="{{ old('phone') }}" 
                                        required
                                    >
                                </div>

                                <!-- Password -->
                                <div class="mb-3">
                                    <label for="password" class="form-label small fw-semibold text-secondary">Password</label>
                                    <input 
                                        type="password" 
                                        name="password" 
                                        id="password" 
                                        class="form-control form-control-lg @error('password') is-invalid @enderror" 
                                        placeholder="Minimal 8 karakter" 
                                        required
                                    >
                                </div>

                                <!-- Confirm Password -->
                                <div class="mb-4">
                                    <label for="password_confirmation" class="form-label small fw-semibold text-secondary">Confirm Password</label>
                                    <input 
                                        type="password" 
                                        name="password_confirmation" 
                                        id="password_confirmation" 
                                        class="form-control form-control-lg" 
                                        placeholder="Ulangi kata sandi" 
                                        required
                                    >
                                </div>

                                <!-- Submit Button -->
                                <button type="submit" class="btn btn-dark btn-lg w-100 fw-bold rounded-3 py-3 text-uppercase tracking-wider shadow-sm mb-3 btn-auth-submit">
                                    REGISTER
                                </button>

                                <!-- Divider -->
                                <div class="d-flex align-items-center my-3">
                                    <hr class="flex-grow-1 my-0 text-muted opacity-25">
                                    <span class="px-2 small text-muted font-body">atau</span>
                                    <hr class="flex-grow-1 my-0 text-muted opacity-25">
                                </div>

                                <!-- Google Register Button -->
                                <a href="{{ route('auth.google') }}" class="btn btn-outline-secondary w-100 py-2.5 rounded-3 d-flex align-items-center justify-content-center gap-2 font-body fw-semibold mb-4 border-secondary-subtle text-dark shadow-xs text-decoration-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 48 48">
                                        <path fill="#FFC107" d="M43.611 20.083H42V20H24v8h11.303c-1.649 4.657-6.08 8-11.303 8-6.627 0-12-5.373-12-12s5.373-12 12-12c3.059 0 5.842 1.154 7.961 3.039l5.657-5.657C34.046 6.053 29.268 4 24 4 12.955 4 4 12.955 4 24s8.955 20 20 20 20-8.955 20-20c0-1.341-.138-2.65-.389-3.917z"/>
                                        <path fill="#FF3D00" d="m6.306 14.691 6.571 4.819C14.655 15.108 18.961 12 24 12c3.059 0 5.842 1.154 7.961 3.039l5.657-5.657C34.046 6.053 29.268 4 24 4 16.318 4 9.656 8.337 6.306 14.691z"/>
                                        <path fill="#4CAF50" d="M24 44c5.166 0 9.86-1.977 13.409-5.192l-6.19-5.238A11.91 11.91 0 0 1 24 36c-5.202 0-9.619-3.317-11.283-7.946l-6.522 5.025C9.505 39.556 16.227 44 24 44z"/>
                                        <path fill="#1976D2" d="M43.611 20.083H42V20H24v8h11.303a12.04 12.04 0 0 1-4.087 5.571l.003-.002 6.19 5.238C36.971 39.205 44 34 44 24c0-1.341-.138-2.65-.389-3.917z"/>
                                    </svg>
                                    Daftar dengan Google
                                </a>

                                <!-- Login Link -->
                                <div class="text-center">
                                    <span class="small text-muted">Already have an account? </span>
                                    <a href="{{ route('login') }}" class="small text-primary fw-bold text-decoration-none ms-1">Login</a>
                                </div>
                            </form>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
