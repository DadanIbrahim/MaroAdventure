@extends('layouts.superadmin')

@section('title', 'User Management - Superadmin')
@section('page_title', 'User & Admin Management')

@section('content')

@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm mb-4" role="alert">
        <i class="bi bi-exclamation-circle-fill me-2"></i>{{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if($errors->any())
    <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm mb-4" role="alert">
        <div class="fw-bold mb-1"><i class="bi bi-exclamation-triangle-fill me-2"></i>Terdapat kesalahan pada input form:</div>
        <ul class="mb-0 ps-3 small">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="card border-0 shadow-sm">
    <div class="card-header bg-white py-3 d-flex flex-wrap justify-content-between align-items-center gap-3">
        <div class="d-flex align-items-center gap-2">
            <h6 class="mb-0 fw-bold">All Registered Users</h6>
            <span class="badge bg-primary-subtle text-primary rounded-pill px-3 py-1">
                {{ $users->total() }} Total
            </span>
        </div>

        <div class="d-flex flex-wrap align-items-center gap-2">
            <!-- Search & Filter Form -->
            <form method="GET" action="{{ route('superadmin.users') }}" class="d-flex gap-2">
                <select name="role" class="form-select form-select-sm" onchange="this.form.submit()" style="min-width: 130px;">
                    <option value="">Semua Role</option>
                    <option value="user" {{ request('role') == 'user' ? 'selected' : '' }}>User</option>
                    <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                </select>

                <div class="input-group input-group-sm" style="max-width: 250px;">
                    <input 
                        type="text" 
                        name="search" 
                        class="form-control" 
                        placeholder="Cari nama, email..." 
                        value="{{ request('search') }}"
                    >
                    <button class="btn btn-primary" type="submit">
                        <i class="bi bi-search"></i>
                    </button>
                </div>

                @if(request()->filled('search') || request()->filled('role'))
                    <a href="{{ route('superadmin.users') }}" class="btn btn-light btn-sm text-secondary border" title="Reset filter">
                        <i class="bi bi-x-circle"></i>
                    </a>
                @endif
            </form>

            <!-- Tombol Tambah User -->
            <button type="button" class="btn btn-success btn-sm fw-semibold" data-bs-toggle="modal" data-bs-target="#addUserModal">
                <i class="bi bi-person-plus-fill me-1"></i> Add User
            </button>
        </div>
    </div>

    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>User</th>
                        <th>Email</th>
                        <th>No. Telepon / WA</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th>Registered At</th>
                        <th class="text-end pe-3">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="avatar bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-2 fw-bold" style="width: 36px; height: 36px; font-size: 0.9rem;">
                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                    </div>
                                    <div>
                                        <div class="fw-bold text-dark">{{ $user->name }}</div>
                                        @if($user->id === auth()->id())
                                            <span class="badge bg-secondary-subtle text-secondary" style="font-size: 0.7rem;">Akun Anda</span>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->phone ?? '-' }}</td>
                            <td>
                                @if($user->role === 'superadmin')
                                    <span class="badge bg-danger">Superadmin</span>
                                @elseif($user->role === 'admin')
                                    <span class="badge bg-primary">Admin</span>
                                @else
                                    <span class="badge bg-secondary">User</span>
                                @endif
                            </td>
                            <td>
                                <span class="badge bg-success-subtle text-success border border-success-subtle">
                                    <i class="bi bi-check-circle me-1"></i> Active
                                </span>
                            </td>
                            <td>{{ $user->created_at ? $user->created_at->format('d M Y') : '-' }}</td>
                            <td class="text-end pe-3">
                                <div class="btn-group btn-group-sm">
                                    <!-- Edit Button -->
                                    <button 
                                        type="button" 
                                        class="btn btn-outline-primary btn-edit-user"
                                        title="Edit User"
                                        data-bs-toggle="modal" 
                                        data-bs-target="#editUserModal"
                                        data-id="{{ $user->id }}"
                                        data-name="{{ $user->name }}"
                                        data-email="{{ $user->email }}"
                                        data-phone="{{ $user->phone }}"
                                        data-role="{{ $user->role }}"
                                        data-action="{{ route('superadmin.users.update', $user->id) }}"
                                    >
                                        <i class="bi bi-pencil"></i>
                                    </button>

                                    <!-- Delete Button -->
                                    @if(auth()->id() !== $user->id)
                                        <form 
                                            action="{{ route('superadmin.users.destroy', $user->id) }}" 
                                            method="POST" 
                                            class="d-inline"
                                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus user &quot;{{ $user->name }}&quot;? Data booking terkait juga akan terpengaruh.');"
                                        >
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger" title="Hapus User">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    @else
                                        <button type="button" class="btn btn-outline-secondary" disabled title="Tidak dapat menghapus akun sendiri">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-5 text-muted">
                                <i class="bi bi-people fs-1 d-block mb-2 text-secondary opacity-50"></i>
                                Tidak ada user yang ditemukan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @if($users->hasPages())
        <div class="card-footer bg-white py-3">
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
                <div class="small text-muted">
                    Menampilkan {{ $users->firstItem() }} - {{ $users->lastItem() }} dari {{ $users->total() }} user
                </div>
                <div>
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    @endif
</div>

<!-- ══════════════════════════════════════════════════ -->
<!-- MODAL: ADD USER                                  -->
<!-- ══════════════════════════════════════════════════ -->
<div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title fw-bold" id="addUserModalLabel">
                    <i class="bi bi-person-plus-fill me-1"></i> Tambah User Baru
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('superadmin.users.store') }}" method="POST">
                @csrf
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label for="name" class="form-label fw-semibold">Nama Lengkap <span class="text-danger">*</span></label>
                        <input 
                            type="text" 
                            name="name" 
                            id="name" 
                            class="form-control" 
                            placeholder="Contoh: Dadan Ibrahim" 
                            value="{{ old('name') }}" 
                            required
                        >
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label fw-semibold">Alamat Email <span class="text-danger">*</span></label>
                        <input 
                            type="email" 
                            name="email" 
                            id="email" 
                            class="form-control" 
                            placeholder="user@maroadventure.com" 
                            value="{{ old('email') }}" 
                            required
                        >
                    </div>

                    <div class="mb-3">
                        <label for="phone" class="form-label fw-semibold">Nomor WhatsApp / HP</label>
                        <input 
                            type="tel" 
                            name="phone" 
                            id="phone" 
                            class="form-control" 
                            placeholder="Contoh: 085894535172" 
                            value="{{ old('phone') }}"
                        >
                    </div>

                    <div class="mb-3">
                        <label for="role" class="form-label fw-semibold">Peran (Role) <span class="text-danger">*</span></label>
                        <select name="role" id="role" class="form-select" required>
                            <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>User (Anggota / Pendaki)</option>
                            <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin (Pengelola Operasional)</option>
                        </select>
                    </div>

                    <div class="row g-2 mb-2">
                        <div class="col-md-6">
                            <label for="password" class="form-label fw-semibold">Password <span class="text-danger">*</span></label>
                            <input 
                                type="password" 
                                name="password" 
                                id="password" 
                                class="form-control" 
                                placeholder="Min. 6 karakter" 
                                required
                            >
                        </div>
                        <div class="col-md-6">
                            <label for="password_confirmation" class="form-label fw-semibold">Konfirmasi Password <span class="text-danger">*</span></label>
                            <input 
                                type="password" 
                                name="password_confirmation" 
                                id="password_confirmation" 
                                class="form-control" 
                                placeholder="Ulangi password" 
                                required
                            >
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success btn-sm fw-bold px-3">
                        <i class="bi bi-save me-1"></i> Simpan User
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- ══════════════════════════════════════════════════ -->
<!-- MODAL: EDIT USER                                 -->
<!-- ══════════════════════════════════════════════════ -->
<div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title fw-bold" id="editUserModalLabel">
                    <i class="bi bi-pencil-square me-1"></i> Edit Data User
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editUserForm" method="POST" action="">
                @csrf
                @method('PUT')
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label for="edit_name" class="form-label fw-semibold">Nama Lengkap <span class="text-danger">*</span></label>
                        <input 
                            type="text" 
                            name="name" 
                            id="edit_name" 
                            class="form-control" 
                            required
                        >
                    </div>

                    <div class="mb-3">
                        <label for="edit_email" class="form-label fw-semibold">Alamat Email <span class="text-danger">*</span></label>
                        <input 
                            type="email" 
                            name="email" 
                            id="edit_email" 
                            class="form-control" 
                            required
                        >
                    </div>

                    <div class="mb-3">
                        <label for="edit_phone" class="form-label fw-semibold">Nomor WhatsApp / HP</label>
                        <input 
                            type="tel" 
                            name="phone" 
                            id="edit_phone" 
                            class="form-control"
                        >
                    </div>

                    <div class="mb-3">
                        <label for="edit_role" class="form-label fw-semibold">Peran (Role) <span class="text-danger">*</span></label>
                        <select name="role" id="edit_role" class="form-select" required>
                            <option value="user">User (Anggota / Pendaki)</option>
                            <option value="admin">Admin (Pengelola Operasional)</option>
                        </select>
                    </div>

                    <div class="border-top pt-3 mt-3">
                        <label class="form-label fw-semibold mb-1">Ganti Password (Opsional)</label>
                        <p class="text-muted small mb-2">Kosongkan jika tidak ingin mengubah password user.</p>
                        <div class="row g-2">
                            <div class="col-md-6">
                                <input 
                                    type="password" 
                                    name="password" 
                                    id="edit_password" 
                                    class="form-control" 
                                    placeholder="Password baru"
                                >
                            </div>
                            <div class="col-md-6">
                                <input 
                                    type="password" 
                                    name="password_confirmation" 
                                    id="edit_password_confirmation" 
                                    class="form-control" 
                                    placeholder="Konfirmasi baru"
                                >
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary btn-sm fw-bold px-3">
                        <i class="bi bi-check-lg me-1"></i> Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const editModal = document.getElementById('editUserModal');
    const editForm = document.getElementById('editUserForm');

    if (editModal && editForm) {
        editModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            if (!button) return;

            const name = button.getAttribute('data-name');
            const email = button.getAttribute('data-email');
            const phone = button.getAttribute('data-phone');
            const role = button.getAttribute('data-role');
            const action = button.getAttribute('data-action');

            document.getElementById('edit_name').value = name || '';
            document.getElementById('edit_email').value = email || '';
            document.getElementById('edit_phone').value = phone || '';
            document.getElementById('edit_role').value = role || 'user';
            document.getElementById('edit_password').value = '';
            document.getElementById('edit_password_confirmation').value = '';

            editForm.action = action;
        });
    }

    // Jika terjadi validation error saat submit add user modal, buka modal otomatis
    @if($errors->any() && !old('_method'))
        const addModalEl = document.getElementById('addUserModal');
        if (addModalEl) {
            const addModal = new bootstrap.Modal(addModalEl);
            addModal.show();
        }
    @endif
});
</script>
@endpush
