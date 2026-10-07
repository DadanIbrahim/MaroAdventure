@extends(request()->routeIs('superadmin.*') ? 'layouts.superadmin' : 'layouts.admin')
@section('title', 'Artikel & Berita - ' . (request()->routeIs('superadmin.*') ? 'Superadmin' : 'Admin'))
@section('page_title', 'Manajemen Artikel & Berita')

@section('content')
<div class="card border-0 shadow-sm">
    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
        <h6 class="mb-0 fw-bold">Daftar Konten</h6>
        <a href="{{ route(request()->routeIs('superadmin.*') ? 'superadmin.articles.create' : 'admin.articles.create') }}" class="btn btn-sm btn-primary">
            <i class="bi bi-pencil-square me-1"></i> Tulis Konten Baru
        </a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th width="10%">Thumbnail</th>
                        <th width="30%">Judul</th>
                        <th width="15%">Kategori</th>
                        <th width="15%">Views</th>
                        <th width="15%">Status</th>
                        <th width="15%" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($articles as $article)
                    <tr>
                        <td>
                            @if($article->thumbnail && file_exists(public_path($article->thumbnail)))
                                <img src="{{ asset($article->thumbnail) }}" alt="Thumbnail" class="img-thumbnail" style="width: 60px; height: 60px; object-fit: cover;">
                            @else
                                <img src="{{ $article->thumbnail_url }}" alt="Thumbnail" class="img-thumbnail" style="width: 60px; height: 60px; object-fit: cover;">
                            @endif
                        </td>
                        <td>
                            <strong class="d-block mb-1">{{ $article->title }}</strong>
                            <small class="text-muted">{{ $article->published_at ? $article->published_at->format('d M Y') : 'Belum Terbit' }}</small>
                        </td>
                        <td>
                            <span class="badge bg-light text-dark border">{{ $article->category }}</span>
                        </td>
                        <td><i class="bi bi-eye"></i> {{ $article->views ?? 0 }}</td>
                        <td>
                            @if($article->is_published)
                                <span class="badge bg-success">Published</span>
                            @else
                                <span class="badge bg-secondary">Draft</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <div class="btn-group">
                                <a href="{{ route(request()->routeIs('superadmin.*') ? 'superadmin.articles.edit' : 'admin.articles.edit', $article->id) }}" class="btn btn-sm btn-outline-primary" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route(request()->routeIs('superadmin.*') ? 'superadmin.articles.destroy' : 'admin.articles.destroy', $article->id) }}" method="POST" onsubmit="return confirm('Yakin menghapus konten ini?');" style="display:inline;">
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
                            <i class="bi bi-inbox fs-2 d-block mb-2"></i>
                            Belum ada artikel atau berita.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

