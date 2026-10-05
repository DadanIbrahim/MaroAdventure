@extends('layouts.superadmin')
@section('title', 'News - Superadmin')
@section('page_title', 'Flash News & Updates')

@section('content')
<div class="card border-0 shadow-sm">
    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
        <h6 class="mb-0 fw-bold">Recent News</h6>
        <button class="btn btn-primary btn-sm"><i class="bi bi-pencil-square"></i> Write News</button>
    </div>
    <div class="card-body">
        <div class="list-group list-group-flush">
            <div class="list-group-item px-0 py-3">
                <div class="d-flex w-100 justify-content-between">
                    <h6 class="mb-1 fw-bold">Jalur Pendakian Semeru Dibuka Kembali</h6>
                    <small class="text-muted">3 days ago</small>
                </div>
                <p class="mb-1 text-muted small">Mulai 1 November, jalur pendakian Gunung Semeru via Ranu Pani resmi dibuka dengan kuota terbatas.</p>
                <button class="btn btn-sm btn-outline-secondary mt-2">Edit</button>
            </div>
            <div class="list-group-item px-0 py-3">
                <div class="d-flex w-100 justify-content-between">
                    <h6 class="mb-1 fw-bold">Promo Akhir Tahun Maro Adventure</h6>
                    <small class="text-muted">1 week ago</small>
                </div>
                <p class="mb-1 text-muted small">Dapatkan diskon hingga 20% untuk semua paket pendakian ke Gunung Rinjani.</p>
                <button class="btn btn-sm btn-outline-secondary mt-2">Edit</button>
            </div>
        </div>
    </div>
</div>
@endsection
