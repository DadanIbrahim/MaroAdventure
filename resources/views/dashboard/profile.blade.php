@extends('layouts.app')

@section('title', 'Profile - Maro Adventure')

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
                        <h2 class="fw-bold mb-1" style="color: var(--color-dark);">Profile</h2>
                        <p class="text-muted">Kelola informasi pribadi dan kontak akunmu.</p>
                    </div>

                    <!-- Profile Content -->
                    <div class="row gx-lg-5 mt-5">
                        
                        <!-- Left Column: Avatar -->
                        <div class="col-md-4 col-lg-3 mb-4 mb-md-0 text-center">
                            <div class="bg-primary bg-opacity-10 rounded-circle mx-auto d-flex align-items-center justify-content-center mb-4 text-primary" style="width: 150px; height: 150px; font-size: 4rem; font-weight: bold;">
                                {{ auth()->check() ? strtoupper(substr(auth()->user()->name, 0, 1)) : 'U' }}
                            </div>
                            <button class="btn btn-outline-dark fw-medium px-4 py-2 rounded-1 mb-2">Upload Photo</button>
                            <p class="text-muted small">JPEG, PNG, maks 2MB</p>
                        </div>

                        <!-- Right Column: Form -->
                        <div class="col-md-8 col-lg-9">
                            <form action="#" method="POST">
                                @csrf
                                <!-- We will add method spoofing PUT when the route is ready -->
                                <div class="mb-4">
                                    <label class="form-label small fw-bold text-dark">Name</label>
                                    <input type="text" name="name" class="form-control px-3 py-2" value="{{ auth()->user()->name ?? 'User Name' }}">
                                </div>
                                
                                <div class="mb-4">
                                    <label class="form-label small fw-bold text-dark">Email</label>
                                    <input type="email" name="email" class="form-control px-3 py-2" value="{{ auth()->user()->email ?? 'user@example.com' }}">
                                </div>
                                
                                <div class="mb-4">
                                    <label class="form-label small fw-bold text-dark">Phone</label>
                                    <input type="text" name="phone" class="form-control px-3 py-2" value="{{ auth()->user()->phone ?? '' }}" placeholder="Enter phone number">
                                </div>
                                
                                <div class="mb-4">
                                    <label class="form-label small fw-bold text-dark">Location</label>
                                    <input type="text" name="location" class="form-control px-3 py-2" value="{{ auth()->user()->location ?? '' }}" placeholder="Enter your location">
                                </div>

                                <div class="mt-4 pt-2">
                                    <button type="submit" class="btn btn-dark fw-bold px-4 py-2 rounded-1" onclick="alert('Fitur Update Profil akan segera diaktifkan!'); return false;">Save Changes</button>
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
