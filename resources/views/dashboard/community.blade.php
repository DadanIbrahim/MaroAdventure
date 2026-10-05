@extends('layouts.app')

@section('title', 'Community - Maro Adventure')

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
                        <h2 class="fw-bold mb-1" style="color: var(--color-dark);">Community</h2>
                        <p class="text-muted">Bagikan cerita dan temukan inspirasi dari pendaki lain.</p>
                    </div>

                    <!-- Create Post -->
                    <div class="card border-0 shadow-sm rounded-4 mb-5">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center mb-3">
                                <div class="bg-secondary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 48px; height: 48px;">
                                    <i class="bi bi-person text-secondary fs-4"></i>
                                </div>
                                <input type="text" class="form-control border-0 bg-light rounded-pill px-4 py-2" placeholder="What's your adventure story?">
                            </div>
                            <div class="d-flex justify-content-end">
                                <button class="btn btn-dark fw-medium px-4 rounded-pill">Create Post</button>
                            </div>
                        </div>
                    </div>

                    <!-- Posts Grid -->
                    <div class="row g-4">
                        <!-- Post 1 -->
                        <div class="col-md-6">
                            <div class="card border-0 shadow-sm rounded-4 h-100">
                                <div class="card-body p-4">
                                    <h6 class="fw-bold mb-0">Dimas Arya <span class="fw-normal text-muted small ms-2">17 Sep 2026</span></h6>
                                    <p class="mt-2 mb-3 text-dark">Sunrise dari Gunung Prau pagi ini benar-benar luar biasa...</p>
                                    
                                    <div class="bg-secondary bg-opacity-25 rounded-3 d-flex align-items-center justify-content-center mb-3" style="height: 200px;">
                                        <div class="text-center text-muted">
                                            <i class="bi bi-image fs-1"></i>
                                            <div class="small mt-2 fw-medium">POST IMAGE</div>
                                        </div>
                                    </div>

                                    <div class="d-flex align-items-center text-muted small gap-4">
                                        <div class="cursor-pointer d-flex align-items-center gap-1"><i class="bi bi-heart"></i> 24 Likes</div>
                                        <div class="cursor-pointer d-flex align-items-center gap-1"><i class="bi bi-chat"></i> 5 Comments</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Post 2 -->
                        <div class="col-md-6">
                            <div class="card border-0 shadow-sm rounded-4 h-100">
                                <div class="card-body p-4">
                                    <h6 class="fw-bold mb-0">Sari Putri <span class="fw-normal text-muted small ms-2">15 Sep 2026</span></h6>
                                    <p class="mt-2 mb-3 text-dark">Langkah kecil di Papandayan, cerita besar bersama teman baru.</p>
                                    
                                    <div class="bg-secondary bg-opacity-25 rounded-3 d-flex align-items-center justify-content-center mb-3" style="height: 200px;">
                                        <div class="text-center text-muted">
                                            <i class="bi bi-image fs-1"></i>
                                            <div class="small mt-2 fw-medium">POST IMAGE</div>
                                        </div>
                                    </div>

                                    <div class="d-flex align-items-center text-muted small gap-4">
                                        <div class="cursor-pointer d-flex align-items-center gap-1"><i class="bi bi-heart"></i> 18 Likes</div>
                                        <div class="cursor-pointer d-flex align-items-center gap-1"><i class="bi bi-chat"></i> 3 Comments</div>
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
    .cursor-pointer {
        cursor: pointer;
    }
</style>
@endsection
