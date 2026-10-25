@extends(request()->routeIs('superadmin.*') ? 'layouts.superadmin' : 'layouts.admin')
@section('title', 'Tulis Berita Baru - ' . (request()->routeIs('superadmin.*') ? 'Superadmin' : 'Admin'))
@section('page_title', 'Tulis Berita Baru')

@section('content')
<div class="card border-0 shadow-sm">
    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
        <h6 class="mb-0 fw-bold">Form Berita Baru</h6>
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

        <form id="post-form" action="{{ route(request()->routeIs('superadmin.*') ? 'superadmin.berita.store' : 'admin.berita.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row g-4">
                <div class="col-md-8">
                    <div class="mb-3">
                        <label class="form-label">Judul Berita <span class="text-danger">*</span></label>
                        <input type="text" name="title" class="form-control" value="{{ old('title') }}" placeholder="Contoh: Pembukaan Jalur Pendakian Musim Kemarau 2026" required>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Ringkasan Berita (Excerpt)</label>
                        <textarea name="excerpt" class="form-control" rows="2" placeholder="Ringkasan 1-2 kalimat berita (kosongkan jika ingin otomatis)...">{{ old('excerpt') }}</textarea>
                        <div class="form-text">Teks ringkas yang tampil pada kartu berita dan halaman depan. Jika dikosongkan, ringkasan otomatis diambil dari isi berita.</div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold mb-1">Isi Berita <span class="text-danger">*</span></label>
                        <div class="text-muted small mb-2">Gunakan toolbar untuk memformat berita.</div>
                        <div id="editor-container">{!! old('content') !!}</div>
                        <input type="hidden" name="content" id="content-input" value="{{ old('content') }}">
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
                                <div class="form-text mt-1">Otomatis dipublikasikan ke halaman Berita publik.</div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Tanggal &amp; Waktu Terbit</label>
                                <input 
                                    type="datetime-local" 
                                    name="published_at" 
                                    class="form-control" 
                                    value="{{ old('published_at', now()->format('Y-m-d\TH:i')) }}"
                                >
                                <div class="form-text">Dapat diatur manual sesuai tanggal rilis berita.</div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Status <span class="text-danger">*</span></label>
                                <select name="is_published" id="status-select" class="form-select" required>
                                    <option value="1" {{ old('is_published', '1') == '1' ? 'selected' : '' }}>Published (Terbit)</option>
                                    <option value="0" {{ old('is_published') == '0' ? 'selected' : '' }}>Draft (Konsep)</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Thumbnail Foto Berita</label>
                        <input type="file" name="thumbnail" class="form-control" accept="image/*">
                        <div class="form-text">Format: JPG/PNG/WebP, Max 2MB. Disarankan orientasi landscape (16:9).</div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Galeri / Foto Dokumentasi Pendukung</label>
                        <input type="file" name="gallery[]" class="form-control" accept="image/*" multiple>
                        <div class="form-text">Dapat memilih lebih dari 1 foto pendukung berita.</div>
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
                            <i class="bi bi-send-fill me-1"></i> Terbitkan Berita
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
                Swal.fire({ icon: 'warning', title: 'Perhatian', text: 'Isi berita tidak boleh kosong.', confirmButtonColor: '#0d6efd' });
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

