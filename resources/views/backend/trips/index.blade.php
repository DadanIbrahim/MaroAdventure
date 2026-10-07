@extends(request()->routeIs('superadmin.*') ? 'layouts.superadmin' : 'layouts.admin')
@section('title', 'Manajemen Trip - ' . (request()->routeIs('superadmin.*') ? 'Superadmin' : 'Admin'))
@section('page_title', 'Manajemen Paket Trip')

@section('content')
<div class="card border-0 shadow-sm">
    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
        <h6 class="mb-0 fw-bold">Data Paket Trip</h6>
        <a href="{{ route(request()->routeIs('superadmin.*') ? 'superadmin.trips.create' : 'admin.trips.create') }}" class="btn btn-sm btn-primary">
            <i class="bi bi-plus-lg me-1"></i> Tambah Trip
        </a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th width="5%">No</th>
                        <th width="10%">Foto</th>
                        <th width="20%">Nama Trip</th>
                        <th width="15%">Gunung</th>
                        <th width="15%">Harga</th>
                        <th width="15%">Durasi</th>
                        <th width="10%">Status</th>
                        <th width="10%" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($trips as $index => $trip)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>
                            @if($trip->image)
                                <img src="{{ asset('storage/' . $trip->image) }}" alt="Trip" class="img-thumbnail" style="width: 60px; height: 60px; object-fit: cover;">
                            @else
                                <div class="bg-light text-secondary d-flex align-items-center justify-content-center rounded" style="width: 60px; height: 60px;">
                                    <i class="bi bi-image"></i>
                                </div>
                            @endif
                        </td>
                        <td class="fw-medium">{{ $trip->name }}</td>
                        <td>{{ $trip->mountain ? $trip->mountain->name : '-' }}</td>
                        <td class="fw-bold text-success">{{ $trip->formatted_price }}</td>
                        <td>{{ $trip->duration }}</td>
                        <td>
                            @if($trip->status)
                                <span class="badge bg-success">Active</span>
                            @else
                                <span class="badge bg-secondary">Inactive</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <div class="btn-group">
                                <a href="{{ route(request()->routeIs('superadmin.*') ? 'superadmin.trips.edit' : 'admin.trips.edit', $trip->id) }}" class="btn btn-sm btn-outline-primary" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route(request()->routeIs('superadmin.*') ? 'superadmin.trips.destroy' : 'admin.trips.destroy', $trip->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus trip ini?');" style="display:inline;">
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
                        <td colspan="8" class="text-center py-4 text-muted">
                            <i class="bi bi-inbox fs-2 d-block mb-2"></i>
                            Belum ada data paket trip.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

