@extends('layouts.superadmin')
@section('title', 'Community - Superadmin')
@section('page_title', 'Community Forum Moderation')

@section('content')
<div class="card border-0 shadow-sm">
    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
        <h6 class="mb-0 fw-bold">Reported Threads & Posts</h6>
        <span class="badge bg-danger rounded-pill">4 Reports</span>
    </div>
    <div class="card-body">
        <div class="list-group list-group-flush">
            <div class="list-group-item px-0 py-3">
                <div class="d-flex justify-content-between">
                    <div>
                        <span class="badge bg-danger mb-2">Spam / Scam</span>
                        <h6 class="fw-bold mb-1">Jual Peralatan Mendaki Murah Meriah (Awas Tipu!)</h6>
                        <div class="text-muted small mb-2">Posted by <span class="text-primary">@user9912</span> in "Gear Discussion"</div>
                        <p class="small mb-0">"Halo gan, saya jual carrier osprey cuma 200rb, transfer langsung ke rekening..."</p>
                    </div>
                    <div class="text-end">
                        <button class="btn btn-sm btn-outline-danger mb-2 d-block w-100">Delete Post</button>
                        <button class="btn btn-sm btn-outline-secondary d-block w-100">Ignore</button>
                    </div>
                </div>
            </div>
            <div class="list-group-item px-0 py-3">
                <div class="d-flex justify-content-between">
                    <div>
                        <span class="badge bg-warning text-dark mb-2">Inappropriate Content</span>
                        <h6 class="fw-bold mb-1">Ribut soal jalur pendakian ilegal</h6>
                        <div class="text-muted small mb-2">Posted by <span class="text-primary">@mountainboy</span> in "General Discussion"</div>
                        <p class="small mb-0">"Ah elah aturan ribet amat, mending lewat jalur tikus aja..."</p>
                    </div>
                    <div class="text-end">
                        <button class="btn btn-sm btn-outline-danger mb-2 d-block w-100">Delete Post</button>
                        <button class="btn btn-sm btn-outline-secondary d-block w-100">Ignore</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
