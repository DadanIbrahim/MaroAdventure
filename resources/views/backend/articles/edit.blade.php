@extends(request()->routeIs('superadmin.*') ? 'layouts.superadmin' : 'layouts.admin')
@section('title', 'Edit Artikel - ' . (request()->routeIs('superadmin.*') ? 'Superadmin' : 'Admin'))
@section('page_title', 'Edit Artikel')

@section('content')
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
            <h6 class="mb-0 fw-bold">Edit Artikel: {{ Str::limit($article->title, 40) }}</h6>
            <a href="{{ route(request()->routeIs('superadmin.*') ? 'superadmin.articles.index' : 'admin.articles.index') }}"
                class="btn btn-sm btn-outline-secondary">
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

            <form id="post-form"
                action="{{ route(request()->routeIs('superadmin.*') ? 'superadmin.articles.update' : 'admin.articles.update', $article->id) }}"
                method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row g-4">
                    <div class="col-md-8">
                        <div class="mb-3">
                            <label class="form-label">Judul Artikel <span class="text-danger">*</span></label>
                            <input type="text" name="title" class="form-control" value="{{ old('title', $article->title) }}"
                                required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Ringkasan (Excerpt)</label>
                            <textarea name="excerpt" class="form-control" rows="2"
                                placeholder="Tulis ringkasan singkat atau kosongkan untuk otomatis...">{{ old('excerpt', $article->excerpt) }}</textarea>
                            <div class="form-text">Teks ringkasan ini yang ditampilkan pada kartu cuplikan. Jika
                                dikosongkan, ringkasan otomatis diambil dari isi artikel.</div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold mb-1">Isi Artikel <span class="text-danger">*</span></label>
                            <div class="text-muted small mb-2">Gunakan toolbar untuk memformat artikel.</div>
                            <div id="editor-container">{!! old('content', $article->formatted_content) !!}</div>
                            <input type="hidden" name="content" id="content-input"
                                value="{{ old('content', $article->content) }}">
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card border border-light bg-light shadow-none mb-3">
                            <div class="card-body">
                                <h6 class="fw-bold mb-3 border-bottom pb-2">Pengaturan Publikasi</h6>

                                <div class="mb-3">
                                    <div class="d-flex justify-content-between align-items-center mb-1">
                                        <label class="form-label mb-0">Kategori <span class="text-danger">*</span></label>
                                        <a href="{{ route(request()->routeIs('superadmin.*') ? 'superadmin.categories.index' : 'admin.categories.index') }}" class="small text-decoration-none">
                                            + Kelola Kategori
                                        </a>
                                    </div>
                                    <select name="category" class="form-select" required>
                                        <option value="">— Pilih Kategori —</option>
                                        @php
                                            $artCategories = \App\Models\Article::articleCategories();
                                            if ($article->category && !in_array($article->category, $artCategories)) {
                                                $artCategories[] = $article->category;
                                            }
                                        @endphp
                                        @foreach($artCategories as $cat)
                                            <option value="{{ $cat }}" {{ old('category', $article->category) === $cat ? 'selected' : '' }}>
                                                {{ $cat }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Waktu Dibuat</label>
                                    <input type="text" class="form-control bg-light text-muted"
                                        value="{{ $article->created_at ? $article->created_at->format('d M Y, H:i') : '-' }}" readonly disabled>
                                    <div class="form-text">Tercatat otomatis saat artikel pertama kali dibuat.</div>
                                </div>

                                <div class="mb-3" id="published-at-group">
                                    <label class="form-label">Waktu Dipublish</label>
                                    <input type="datetime-local" name="published_at" id="published-at-input" class="form-control"
                                        value="{{ old('published_at', $article->published_at ? $article->published_at->format('Y-m-d\TH:i') : '') }}">
                                    <div class="form-text">Terpisah dari waktu dibuat. Hanya berlaku jika status Published.</div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Status <span class="text-danger">*</span></label>
                                    <select name="is_published" id="status-select" class="form-select" required>
                                        <option value="1" {{ old('is_published', $article->is_published) == 1 ? 'selected' : '' }}>Published (Terbit)</option>
                                        <option value="0" {{ old('is_published', $article->is_published) == 0 ? 'selected' : '' }}>Draft (Konsep)</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Thumbnail Saat Ini</label>
                            @if($article->thumbnail)
                                <div class="mb-2 p-2 bg-light rounded border d-inline-block">
                                    <img src="{{ $article->thumbnail_url }}" alt="Preview" class="img-thumbnail d-block"
                                        style="max-height: 150px; object-fit: cover;">
                                    <div class="text-muted small mt-1 font-monospace" style="font-size: 0.72rem;">
                                        <i class="bi bi-link-45deg"></i> {{ $article->thumbnail }}
                                    </div>
                                </div>
                            @else
                                <div class="text-muted small mb-2">Belum ada thumbnail</div>
                            @endif

                            <label class="form-label mt-2">Ganti Thumbnail Baru</label>
                            <input type="file" name="thumbnail" class="form-control" accept="image/*">
                            <div class="form-text">Maksimal 15MB (JPG, PNG, WebP). Kosongkan jika ingin tetap mempertahankan thumbnail yang sudah ada.</div>
                        </div>

                        @include('backend.partials.gallery-uploader', [
                            'label' => 'Galeri Foto Tambahan (Slider)',
                            'hint' => 'Pilih foto satu per satu atau sekaligus untuk slider bergeser.',
                            'existingGallery' => $article->gallery
                        ])
                    </div>

                    <div
                        class="col-12 mt-4 pt-3 border-top d-flex justify-content-between align-items-center flex-wrap gap-2">
                        <button type="button" id="btn-reset-form" class="btn btn-outline-secondary">
                            <i class="bi bi-trash3 me-1"></i> Kosongkan Form
                        </button>
                        <div class="d-flex align-items-center gap-2">
                            <button type="submit" class="btn btn-primary px-4">
                                <i class="bi bi-save me-1"></i> Update Konten
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
                placeholder: 'Mulai tulis isi artikel di sini...',
                modules: {
                    toolbar: [
                        [{ 'header': [1, 2, 3, false] }],
                        ['bold', 'italic', 'underline', 'strike'],
                        [{ 'list': 'ordered' }, { 'list': 'bullet' }],
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
                contentInput.dispatchEvent(new Event('input', { bubbles: true }));
            });

            form.addEventListener('submit', function (e) {
                const text = quill.getText().trim();
                if (text.length === 0 && !quill.root.querySelector('img')) {
                    e.preventDefault();
                    Swal.fire({ icon: 'warning', title: 'Perhatian', text: 'Isi artikel tidak boleh kosong.', confirmButtonColor: '#0d6efd' });
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