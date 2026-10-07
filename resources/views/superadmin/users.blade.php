@extends('layouts.superadmin')
@section('title', 'User Management - Superadmin')
@section('page_title', 'User & Admin Management')

@section('content')
<div class="card border-0 shadow-sm">
    <div class="card-header bg-white py-3 d-flex flex-wrap justify-content-between align-items-center gap-3">
        <h6 class="mb-0 fw-bold">All Registered Users</h6>
        <div class="d-flex gap-2">
            <div class="input-group" style="max-width: 250px;">
                <input type="text" class="form-control form-control-sm" placeholder="Search users...">
                <button class="btn btn-primary btn-sm"><i class="bi bi-search"></i></button>
            </div>
            <button class="btn btn-success btn-sm"><i class="bi bi-person-plus"></i> Add User</button>
        </div>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th>Registered At</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <div class="fw-bold">Super Administrator</div>
                        </td>
                        <td>superadmin123@maroadventure.com</td>
                        <td><span class="badge bg-danger">Superadmin</span></td>
                        <td><span class="badge bg-success">Active</span></td>
                        <td>12 Oct 2023</td>
                        <td>
                            <button class="btn btn-sm btn-light" disabled><i class="bi bi-pencil"></i></button>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="fw-bold">Administrator</div>
                        </td>
                        <td>admin123@maroadventure.com</td>
                        <td><span class="badge bg-primary">Admin</span></td>
                        <td><span class="badge bg-success">Active</span></td>
                        <td>12 Oct 2023</td>
                        <td>
                            <button class="btn btn-sm btn-light"><i class="bi bi-pencil"></i></button>
                            <button class="btn btn-sm btn-light text-danger"><i class="bi bi-trash"></i></button>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="fw-bold">Ahmad Syauqi</div>
                        </td>
                        <td>ahmad@example.com</td>
                        <td><span class="badge bg-secondary">User</span></td>
                        <td><span class="badge bg-success">Active</span></td>
                        <td>10 Jan 2023</td>
                        <td>
                            <button class="btn btn-sm btn-light"><i class="bi bi-pencil"></i></button>
                            <button class="btn btn-sm btn-light text-danger"><i class="bi bi-trash"></i></button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

