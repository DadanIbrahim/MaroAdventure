@extends('layouts.superadmin')
@section('title', 'Superadmin Dashboard - Maro')
@section('page_title', 'Superadmin Overview')

@section('content')
<div class="row g-4 mb-4">
    <div class="col-md-3">
        <div class="card bg-primary text-white h-100 border-0 shadow-sm">
            <div class="card-body">
                <h6>Total Users</h6>
                <h2>12,450</h2>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-success text-white h-100 border-0 shadow-sm">
            <div class="card-body">
                <h6>Total Transactions</h6>
                <h2>Rp 2.4B</h2>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-info text-white h-100 border-0 shadow-sm">
            <div class="card-body">
                <h6>Active Content</h6>
                <h2>342</h2>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-warning text-dark h-100 border-0 shadow-sm">
            <div class="card-body">
                <h6>Pending Approvals</h6>
                <h2>28</h2>
            </div>
        </div>
    </div>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-header bg-white py-3">
        <h6 class="mb-0 fw-bold">System Status</h6>
    </div>
    <div class="card-body">
        <p>All systems running normally. Storage at 45% capacity. Database connections stable.</p>
    </div>
</div>
@endsection
