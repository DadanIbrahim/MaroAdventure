@extends(request()->routeIs('superadmin.*') ? 'layouts.superadmin' : 'layouts.admin')
@section('title', 'Edit Artikel - ' . (request()->routeIs('superadmin.*') ? 'Superadmin' : 'Admin'))
@section('page_title', 'Edit Artikel / Berita')

@section('content')
<div class="card border-0 shadow-sm">
    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
        <h6 class="mb-0 fw-bold">Edit Konten: {{ Str::limit($article->title, 40) }}</h6>
        <a href="{{ route(request()->routeIs('superadmin.*') ? 'superadmin.articles.index' : 'admin.articles.index') }}" class="btn btn-sm btn-outline-secondary">
            <i class="bi bi-arrow-left me-1"></i> Kembali
        </a>
    </div>
    <div class="card-body">
        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route(request()->routeIs('superadmin.*') ? 'superadmin.articles.update' : 'admin.articles.update', $article->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row g-4">
                <div class="col-md-8">
                    <div class="mb-3">
                        <label class="form-label">Judul Konten <span class="text-danger">*</span></label>
                        <input type="text" name="title" class="form-control" value="{{ old('title', $article->title) }}" required>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Ringkasan (Excerpt)</label>
                        <textarea name="excerpt" class="form-control" rows="2">{{ old('excerpt', $article->excerpt) }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Isi Tulisan (Content) <span class="text-danger">*</span></label>
                        <textarea name="content" class="form-control" rows="15" required>{{ old('content', $article->content) }}</textarea>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card border border-light bg-light shadow-none mb-3">
                        <div class="card-body">
                            <h6 class="fw-bold mb-3 border-bottom pb-2">Pengaturan Publikasi</h6>
                            
                            <div class="mb-3">
                                <label class="form-label">Kategori <span class="text-danger">*</span></label>
                                <select name="category" class="form-select" required>
                                    @foreach(\App\Models\Article::allCategories() as $cat)
                                        <option value="{{ $cat }}" {{ old('category', $article->category) == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Status <span class="text-danger">*</span></label>
                                <select name="is_published" class="form-select" required>
                                    <option value="1" {{ old('is_published', $article->is_published) == 1 ? 'selected' : '' }}>Published (Terbit)</option>
                                    <option value="0" {{ old('is_published', $article->is_published) == 0 ? 'selected' : '' }}>Draft (Konsep)</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Thumbnail Saat Ini</label>
                        @if($article->thumbnail)
                            <div class="mb-2">
                                <img src="{{ asset('storage/' . $article->thumbnail) }}" alt="Preview" class="img-thumbnail" style="max-height: 150px;">
                            </div>
                        @else
                            <div class="text-muted small mb-2">Belum ada thumbnail</div>
                        @endif
                        
                        <label class="form-label mt-2">Ganti Thumbnail Baru</label>
                        <input type="file" name="thumbnail" class="form-control" accept="image/*">
                        <div class="form-text">Kosongkan jika tidak ingin mengganti.</div>
                    </div>
                </div>

                <div class="col-12 mt-4 text-end">
                    <button type="submit" class="btn btn-primary px-4"><i class="bi bi-save me-1"></i> Update Konten</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

