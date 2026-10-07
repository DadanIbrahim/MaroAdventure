@extends(request()->routeIs('superadmin.*') ? 'layouts.superadmin' : 'layouts.admin')
@section('title', 'Manajemen Reward - ' . (request()->routeIs('superadmin.*') ? 'Superadmin' : 'Admin'))
@section('page_title', 'Daftar Hadiah (Rewards)')

@section('content')
<div class="card border-0 shadow-sm">
    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
        <h6 class="mb-0 fw-bold">Data Rewards</h6>
        <a href="{{ route(request()->routeIs('superadmin.*') ? 'superadmin.rewards.create' : 'admin.rewards.create') }}" class="btn btn-sm btn-primary">
            <i class="bi bi-plus-lg me-1"></i> Tambah Reward
        </a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th width="10%">Foto</th>
                        <th width="25%">Nama Hadiah</th>
                        <th width="15%">Harga Poin</th>
                        <th width="10%">Stok</th>
                        <th width="15%">Status</th>
                        <th width="15%" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($rewards as $reward)
                    <tr>
                        <td>
                            @if($reward->image)
                                <img src="{{ asset('storage/' . $reward->image) }}" class="img-thumbnail" style="width: 60px; height: 60px; object-fit: cover;">
                            @else
                                <div class="bg-light d-flex align-items-center justify-content-center text-secondary rounded" style="width: 60px; height: 60px;">
                                    <i class="bi bi-gift"></i>
                                </div>
                            @endif
                        </td>
                        <td class="fw-bold">{{ $reward->name }}</td>
                        <td><span class="badge bg-warning text-dark"><i class="bi bi-coin"></i> {{ number_format($reward->points_required, 0, ',', '.') }}</span></td>
                        <td>{{ $reward->stock }}</td>
                        <td>{!! $reward->status_badge !!}</td>
                        <td class="text-center">
                            <div class="btn-group">
                                <a href="{{ route(request()->routeIs('superadmin.*') ? 'superadmin.rewards.edit' : 'admin.rewards.edit', $reward->id) }}" class="btn btn-sm btn-outline-primary" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route(request()->routeIs('superadmin.*') ? 'superadmin.rewards.destroy' : 'admin.rewards.destroy', $reward->id) }}" method="POST" onsubmit="return confirm('Hapus reward ini?');" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" title="Hapus">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-4 text-muted">Belum ada reward yang tersedia.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

