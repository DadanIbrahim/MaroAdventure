@extends(request()->routeIs('superadmin.*') ? 'layouts.superadmin' : 'layouts.admin')
@section('title', 'Edit Berita - ' . (request()->routeIs('superadmin.*') ? 'Superadmin' : 'Admin'))
@section('page_title', 'Edit Berita')

@section('content')
<div class="card border-0 shadow-sm">
    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
        <h6 class="mb-0 fw-bold">Edit Berita: {{ Str::limit($article->title, 40) }}</h6>
        <a href="{{ route(request()->routeIs('superadmin.*') ? 'superadmin.berita.index' : 'admin.berita.index') }}" class="btn btn-sm btn-outline-secondary">
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

        <form id="post-form" action="{{ route(request()->routeIs('superadmin.*') ? 'superadmin.berita.update' : 'admin.berita.update', $article->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row g-4">
                <div class="col-md-8">
                    <div class="mb-3">
                        <label class="form-label">Judul Berita <span class="text-danger">*</span></label>
                        <input type="text" name="title" class="form-control" value="{{ old('title', $article->title) }}" required>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Ringkasan Berita (Excerpt)</label>
                        <textarea name="excerpt" class="form-control" rows="2" placeholder="Tulis ringkasan singkat atau kosongkan untuk otomatis...">{{ old('excerpt', $article->excerpt) }}</textarea>
                        <div class="form-text">Teks ringkasan ini yang ditampilkan pada kartu cuplikan di Beranda. Jika dikosongkan, ringkasan otomatis diambil dari isi berita.</div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold mb-1">Isi Berita <span class="text-danger">*</span></label>
                        <div class="text-muted small mb-2">Gunakan toolbar untuk memformat berita.</div>
                        <div id="editor-container">{!! old('content', $article->formatted_content) !!}</div>
                        <input type="hidden" name="content" id="content-input" value="{{ old('content', $article->content) }}">
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card border border-light bg-light shadow-none mb-3">
                        <div class="card-body">
                            <h6 class="fw-bold mb-3 border-bottom pb-2">Pengaturan Publikasi</h6>
                            
                            <div class="mb-3">
                                <label class="form-label">Tipe Konten</label>
                                <div>
                                    <span class="badge bg-primary px-3 py-2 fs-6">
                                        <i class="bi bi-newspaper me-1"></i> Berita & Kabar Terkini
                                    </span>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Tanggal &amp; Waktu Terbit</label>
                                <input 
                                    type="datetime-local" 
                                    name="published_at" 
                                    class="form-control" 
                                    value="{{ old('published_at', $article->published_at ? $article->published_at->format('Y-m-d\TH:i') : '') }}"
                                >
                                <div class="form-text">Dapat diatur manual sesuai tanggal rilis berita.</div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Status <span class="text-danger">*</span></label>
                                <select name="is_published" id="status-select" class="form-select" required>
                                    <option value="1" {{ old('is_published', $article->is_published) == 1 ? 'selected' : '' }}>Published (Terbit)</option>
                                    <option value="0" {{ old('is_published', $article->is_published) == 0 ? 'selected' : '' }}>Draft (Konsep)</option>
                                </select>
                            </div>

                            <div class="text-muted small">
                                <div><strong>Dilihat:</strong> {{ $article->views ?? 0 }} kali</div>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Thumbnail Foto Berita</label>
                        @if($article->thumbnail)
                            <div class="mb-2">
                                <img src="{{ $article->thumbnail_url }}" alt="Thumbnail" class="img-thumbnail" style="max-height: 120px;">
                            </div>
                        @endif
                        <input type="file" name="thumbnail" class="form-control" accept="image/*">
                        <div class="form-text">Biarkan kosong jika tidak ingin mengganti thumbnail.</div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Galeri / Foto Dokumentasi Pendukung</label>
                        @if(!empty($article->gallery) && is_array($article->gallery))
                            <div class="d-flex flex-wrap gap-2 mb-2">
                                @foreach($article->gallery as $gImg)
                                    <img src="{{ Str::startsWith($gImg, ['http://', 'https://']) ? $gImg : asset('storage/'.$gImg) }}" class="img-thumbnail" style="width: 50px; height: 50px; object-fit: cover;">
                                @endforeach
                            </div>
                        @endif
                        <input type="file" name="gallery[]" class="form-control" accept="image/*" multiple>
                        <div class="form-text">Upload foto baru untuk menambahkan ke galeri.</div>
                    </div>
                </div>

                <div class="col-12 mt-4 pt-3 border-top d-flex justify-content-between align-items-center flex-wrap gap-2">
                    <button type="button" id="btn-reset-form" class="btn btn-outline-secondary">
                        <i class="bi bi-trash3 me-1"></i> Kosongkan Form
                    </button>
                    <div class="d-flex align-items-center gap-2">
                        <button type="button" id="btn-save-draft" class="btn btn-outline-primary px-3">
                            <i class="bi bi-file-earmark me-1"></i> Simpan Draf
                        </button>
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="bi bi-save me-1"></i> Perbarui Berita
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.snow.css" rel="stylesheet">
<style>
    .ql-toolbar.ql-snow {
        border-top-left-radius: 0.5rem;
        border-top-right-radius: 0.5rem;
        border-color: #dee2e6;
        background-color: #f8fafc;
    }
    .ql-container.ql-snow {
        border-bottom-left-radius: 0.5rem;
        border-bottom-right-radius: 0.5rem;
        border-color: #dee2e6;
        font-family: inherit;
        font-size: 0.95rem;
        min-height: 280px;
        background-color: #ffffff;
    }
    .ql-editor {
        min-height: 280px;
        line-height: 1.6;
    }
    .ql-editor.ql-blank::before {
        color: #94a3b8;
        font-style: normal;
    }
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const quill = new Quill('#editor-container', {
            theme: 'snow',
            placeholder: 'Mulai tulis isi berita di sini...',
            modules: {
                toolbar: [
                    [{ 'header': [1, 2, 3, false] }],
                    ['bold', 'italic', 'underline', 'strike'],
                    [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                    [{ 'align': [] }],
                    ['blockquote', 'link'],
                    ['clean']
                ]
            }
        });

        const form = document.getElementById('post-form');
        const contentInput = document.getElementById('content-input');
        const statusSelect = document.getElementById('status-select');

        // Selalu sinkronkan saat teks berubah di Quill
        quill.on('text-change', function () {
            contentInput.value = quill.root.innerHTML;
        });

        form.addEventListener('submit', function (e) {
            const text = quill.getText().trim();
            if (text.length === 0 && !quill.root.querySelector('img')) {
                e.preventDefault();
                alert('Isi berita tidak boleh kosong.');
                quill.focus();
                return false;
            }
            contentInput.value = quill.root.innerHTML;
        });

        // Sinkronkan juga saat tombol submit diklik langsung
        form.querySelectorAll('button[type="submit"]').forEach(btn => {
            btn.addEventListener('click', function () {
                contentInput.value = quill.root.innerHTML;
            });
        });

        const draftBtn = document.getElementById('btn-save-draft');
        if (draftBtn && statusSelect) {
            draftBtn.addEventListener('click', function () {
                statusSelect.value = '0';
                contentInput.value = quill.root.innerHTML;
                form.requestSubmit();
            });
        }

        const resetBtn = document.getElementById('btn-reset-form');
        if (resetBtn) {
            resetBtn.addEventListener('click', function () {
                if (confirm('Apakah Anda yakin ingin mengosongkan form?')) {
                    form.reset();
                    quill.setContents([]);
                    contentInput.value = '';
                }
            });
        }
    });
</script>
@endpush

