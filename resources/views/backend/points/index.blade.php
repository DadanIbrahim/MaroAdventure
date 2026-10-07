@extends(request()->routeIs('superadmin.*') ? 'layouts.superadmin' : 'layouts.admin')
@section('title', 'Manajemen Poin - ' . (request()->routeIs('superadmin.*') ? 'Superadmin' : 'Admin'))
@section('page_title', 'Daftar Saldo Poin Pelanggan')

@section('content')
<div class="card border-0 shadow-sm">
    <div class="card-header bg-white py-3">
        <h6 class="mb-0 fw-bold">Data Poin Pengguna</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th width="5%">No</th>
                        <th width="30%">Nama Pengguna</th>
                        <th width="25%">Email</th>
                        <th width="20%">Total Poin</th>
                        <th width="20%" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $index => $user)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td class="fw-bold">{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            <span class="badge bg-warning text-dark fs-6"><i class="bi bi-coin"></i> {{ number_format($user->points, 0, ',', '.') }}</span>
                        </td>
                        <td class="text-center">
                            <a href="{{ route(request()->routeIs('superadmin.*') ? 'superadmin.points.edit' : 'admin.points.edit', $user->id) }}" class="btn btn-sm btn-outline-primary" title="Sesuaikan Poin">
                                <i class="bi bi-pencil-square me-1"></i> Sesuaikan Poin
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-4 text-muted">Belum ada data pengguna.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

