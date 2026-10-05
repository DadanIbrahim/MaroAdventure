@extends('layouts.superadmin')
@section('title', 'Rewards - Superadmin')
@section('page_title', 'Reward Catalog Management')

@section('content')
<div class="card border-0 shadow-sm">
    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
        <h6 class="mb-0 fw-bold">Active Reward Catalog</h6>
        <button class="btn btn-primary btn-sm"><i class="bi bi-plus-lg"></i> Add Reward</button>
    </div>
    <div class="card-body p-0">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th>Reward Item</th>
                    <th>Points Required</th>
                    <th>Stock/Quota</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <div class="fw-bold text-primary">Voucher Diskon Rp 50.000</div>
                        <div class="small text-muted">Voucher Potongan Harga Trip</div>
                    </td>
                    <td class="fw-bold text-warning">500 Pts</td>
                    <td>Unlimited</td>
                    <td><span class="badge bg-success">Active</span></td>
                    <td><button class="btn btn-sm btn-light"><i class="bi bi-pencil"></i></button></td>
                </tr>
                <tr>
                    <td>
                        <div class="fw-bold text-primary">Free T-Shirt Eksklusif Maro</div>
                        <div class="small text-muted">Merchandise Fisik</div>
                    </td>
                    <td class="fw-bold text-warning">2,500 Pts</td>
                    <td>45 left</td>
                    <td><span class="badge bg-success">Active</span></td>
                    <td><button class="btn btn-sm btn-light"><i class="bi bi-pencil"></i></button></td>
                </tr>
                <tr>
                    <td>
                        <div class="fw-bold text-primary">Gratis Trip Bromo 1D</div>
                        <div class="small text-muted">Reward Utama</div>
                    </td>
                    <td class="fw-bold text-warning">10,000 Pts</td>
                    <td>5 left</td>
                    <td><span class="badge bg-success">Active</span></td>
                    <td><button class="btn btn-sm btn-light"><i class="bi bi-pencil"></i></button></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection
