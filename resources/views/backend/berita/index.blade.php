@extends(request()->routeIs('superadmin.*') ? 'layouts.superadmin' : 'layouts.admin')
@section('title', 'Berita - ' . (request()->routeIs('superadmin.*') ? 'Superadmin' : 'Admin'))
@section('page_title', 'Manajemen Berita')

@section('content')
<div class="card border-0 shadow-sm">
    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
        <h6 class="mb-0 fw-bold">Daftar Berita & Pengumuman</h6>
        <a href="{{ route(request()->routeIs('superadmin.*') ? 'superadmin.berita.create' : 'admin.berita.create') }}" class="btn btn-sm btn-primary">
            <i class="bi bi-plus-lg me-1"></i> Tulis Berita Baru
        </a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th width="10%">Thumbnail</th>
                        <th width="35%">Judul Berita</th>
                        <th width="15%">Tanggal Terbit</th>
                        <th width="10%">Views</th>
                        <th width="15%">Status</th>
                        <th width="15%" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($news as $item)
                    <tr>
                        <td>
                            <img src="{{ $item->thumbnail_url }}" alt="Thumbnail" class="img-thumbnail" style="width: 60px; height: 60px; object-fit: cover;">
                        </td>
                        <td>
                            <strong class="d-block mb-1">{{ $item->title }}</strong>
                            <small class="text-muted">{{ Str::limit($item->short_excerpt, 70) }}</small>
                        </td>
                        <td>
                            <small class="text-muted">
                                <i class="bi bi-calendar-event me-1"></i>
                                {{ $item->published_at ? $item->published_at->format('d M Y, H:i') : 'Belum Terbit' }}
                            </small>
                        </td>
                        <td><i class="bi bi-eye"></i> {{ $item->views ?? 0 }}</td>
                        <td>
                            @if($item->is_published)
                                <span class="badge bg-success">Published</span>
                            @else
                                <span class="badge bg-secondary">Draft</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <div class="btn-group">
                                <a href="{{ route(request()->routeIs('superadmin.*') ? 'superadmin.berita.edit' : 'admin.berita.edit', $item->id) }}" class="btn btn-sm btn-outline-primary" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route(request()->routeIs('superadmin.*') ? 'superadmin.berita.destroy' : 'admin.berita.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus berita ini?');" style="display:inline;">
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
                        <td colspan="6" class="text-center py-4 text-muted">
                            <i class="bi bi-newspaper fs-2 d-block mb-2"></i>
                            Belum ada berita atau pengumuman yang diterbitkan.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

