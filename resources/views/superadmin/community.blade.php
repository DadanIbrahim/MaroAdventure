@extends(request()->routeIs('superadmin.*') ? 'layouts.superadmin' : 'layouts.admin')
@section('title', 'Community - Superadmin')
@section('page_title', 'Community Forum Moderation')

@section('content')
<div class="card border-0 shadow-sm">
    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
        <h6 class="mb-0 fw-bold">All Community Posts</h6>
        <span class="badge bg-primary rounded-pill">{{ $posts->count() }} Posts</span>
    </div>
    <div class="card-body">
        <div class="list-group list-group-flush">
            @forelse($posts as $post)
            <div class="list-group-item px-0 py-3">
                <div class="d-flex justify-content-between align-items-start">
                    <div class="me-3">
                        <div class="d-flex align-items-center mb-2">
                            <h6 class="fw-bold mb-0 me-2">{{ $post->user->name }}</h6>
                            <small class="text-muted">{{ $post->created_at->format('d M Y H:i') }}</small>
                        </div>
                        @if($post->content)
                            <p class="small mb-2">{{ Str::limit($post->content, 150) }}</p>
                        @endif
                        @if($post->image)
                            <div class="mt-2">
                                <img src="{{ Storage::url($post->image) }}" alt="Post image" class="img-thumbnail" style="max-height: 100px;">
                            </div>
                        @endif
                    </div>
                    <div class="text-end">
                        <form action="{{ route(request()->routeIs('superadmin.*') ? 'superadmin.community.destroy' : 'admin.community.destroy', $post->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus postingan ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger">Delete Post</button>
                        </form>
                    </div>
                </div>
            </div>
            @empty
            <div class="text-center py-4 text-muted">
                Belum ada postingan komunitas.
            </div>
            @endforelse
        </div>
    </div>
</div>
@endsection
