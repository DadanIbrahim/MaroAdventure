<div class="gallery-uploader-component mb-3" id="gallery-uploader-root">
    <label class="form-label fw-semibold text-dark d-flex align-items-center justify-content-between mb-1">
        <span>
            <i class="bi bi-images text-primary me-1"></i> {{ $label ?? 'Galeri Foto Pendukung' }}
        </span>
        <span class="badge bg-light text-secondary border fw-normal" id="gallery-total-badge" style="font-size: 0.75rem;">
            0 foto baru
        </span>
    </label>
    <div class="form-text mb-2 text-muted" style="font-size: 0.8rem;">
        {{ $hint ?? 'Pilih foto satu per satu atau sekaligus untuk melengkapi galeri slider (JPG, PNG, WebP. Maks 2MB/foto).' }}
    </div>

    @if(!empty($existingGallery) && is_array($existingGallery) && count($existingGallery) > 0)
        <!-- Foto Galeri Lama (Saat Ini) -->
        <div class="mb-3 p-3 bg-light rounded-3 border">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <span class="small fw-semibold text-dark">
                    <i class="bi bi-collection-fill text-secondary me-1"></i> Foto Galeri Tersimpan ({{ count($existingGallery) }} foto)
                </span>
                <small class="text-muted" style="font-size: 0.72rem;">Klik tombol silang untuk menghapus</small>
            </div>
            <div class="d-flex flex-wrap gap-2" id="existing-gallery-container">
                @foreach($existingGallery as $gImg)
                    @php
                        $imgUrl = Str::startsWith($gImg, ['http://', 'https://']) ? $gImg : asset('storage/' . $gImg);
                    @endphp
                    <div class="position-relative existing-gallery-item" data-path="{{ $gImg }}" style="width: 80px; height: 80px;">
                        <img src="{{ $imgUrl }}" alt="Galeri" class="w-100 h-100 rounded-2 border object-fit-cover shadow-sm">
                        <button type="button" 
                                class="btn btn-danger btn-sm p-0 position-absolute top-0 end-0 rounded-circle btn-remove-existing-gallery shadow" 
                                style="width: 22px; height: 22px; line-height: 1; font-size: 12px; margin-top: -6px; margin-right: -6px; display: flex; align-items: center; justify-content: center;"
                                title="Hapus foto ini dari galeri">
                            <i class="bi bi-x"></i>
                        </button>
                    </div>
                @endforeach
            </div>
            <!-- Wadah input tersembunyi untuk foto yang dihapus -->
            <div id="deleted-gallery-inputs"></div>
        </div>
    @endif

    <!-- Area Trigger / Dropzone -->
    <div class="border border-2 border-dashed rounded-3 p-3 text-center bg-light bg-opacity-50 transition-all mb-2" id="gallery-dropzone">
        <!-- Input Form Sebenarnya yang dikirim ke Controller -->
        <input type="file" id="gallery-actual-input" name="gallery[]" accept="image/jpeg,image/png,image/webp,image/jpg" multiple class="d-none">
        
        <!-- Input Temporary untuk memilih foto satu-satu atau sekaligus berkali-kali -->
        <input type="file" id="gallery-temp-picker" accept="image/jpeg,image/png,image/webp,image/jpg" multiple class="d-none">

        <div class="d-flex flex-column align-items-center justify-content-center py-2">
            <div class="bg-primary bg-opacity-10 text-primary rounded-circle p-2 mb-2 d-flex align-items-center justify-content-center" style="width: 44px; height: 44px;">
                <i class="bi bi-cloud-arrow-up-fill fs-5"></i>
            </div>
            <div class="mb-2">
                <button type="button" class="btn btn-primary btn-sm rounded-pill px-3 fw-semibold shadow-sm" id="btn-trigger-gallery-picker">
                    <i class="bi bi-plus-lg me-1"></i> Tambah Foto Galeri
                </button>
            </div>
            <div class="text-muted small" style="font-size: 0.8rem;">
                Anda dapat memilih foto <strong>satu per satu</strong> atau <strong>sekaligus</strong>.
            </div>
        </div>
    </div>

    <!-- Preview Foto Baru yang Baru Dipilih -->
    <div id="gallery-preview-container" class="d-none mt-3">
        <div class="small fw-semibold text-secondary mb-2 d-flex justify-content-between align-items-center">
            <span><i class="bi bi-check2-circle text-success me-1"></i> Foto Baru yang Dipilih:</span>
            <button type="button" class="btn btn-link btn-sm text-danger text-decoration-none p-0 small" id="btn-clear-all-gallery" style="font-size: 0.75rem;">
                <i class="bi bi-trash3 me-1"></i> Hapus Semua Foto Baru
            </button>
        </div>
        <div class="row g-2" id="gallery-preview-grid"></div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const root = document.getElementById('gallery-uploader-root');
    if (!root) return;

    const actualInput = document.getElementById('gallery-actual-input');
    const tempPicker = document.getElementById('gallery-temp-picker');
    const btnTrigger = document.getElementById('btn-trigger-gallery-picker');
    const previewContainer = document.getElementById('gallery-preview-container');
    const previewGrid = document.getElementById('gallery-preview-grid');
    const countBadge = document.getElementById('gallery-total-badge');
    const btnClearAll = document.getElementById('btn-clear-all-gallery');
    const deletedContainer = document.getElementById('deleted-gallery-inputs');

    let stagedFiles = [];

    // Buka file dialog saat tombol diklik
    btnTrigger.addEventListener('click', function () {
        tempPicker.value = '';
        tempPicker.click();
    });

    // Tangani pemilihan file dari dialog
    tempPicker.addEventListener('change', function () {
        if (!tempPicker.files || tempPicker.files.length === 0) return;

        let addedCount = 0;
        Array.from(tempPicker.files).forEach(file => {
            // Validasi ukuran maks 2MB
            if (file.size > 2 * 1024 * 1024) {
                if (window.Toast) {
                    Toast.fire({
                        icon: 'warning',
                        title: `File "${file.name}" melebihi batas 2MB dan dilewati.`
                    });
                } else {
                    alert(`File "${file.name}" melebihi batas 2MB.`);
                }
                return;
            }

            // Hindari duplikasi file persis sama dalam antrian yang sama
            const isDuplicate = stagedFiles.some(f => f.name === file.name && f.size === file.size);
            if (!isDuplicate) {
                stagedFiles.push(file);
                addedCount++;
            }
        });

        syncInputAndRender();

        if (addedCount > 0 && window.Toast) {
            Toast.fire({
                icon: 'success',
                title: `${addedCount} foto ditambahkan ke daftar galeri.`
            });
        }
    });

    // Sinkronkan stagedFiles ke input file form asli dan render ulang preview
    function syncInputAndRender() {
        const dt = new DataTransfer();
        stagedFiles.forEach(file => dt.items.add(file));
        actualInput.files = dt.files;

        // Panggil event input dan change agar dirty-form tracker mendeteksi perubahan
        actualInput.dispatchEvent(new Event('input', { bubbles: true }));
        actualInput.dispatchEvent(new Event('change', { bubbles: true }));

        renderPreviews();
    }

    function renderPreviews() {
        previewGrid.innerHTML = '';

        if (stagedFiles.length === 0) {
            previewContainer.classList.add('d-none');
            countBadge.textContent = '0 foto baru';
            return;
        }

        previewContainer.classList.remove('d-none');
        countBadge.textContent = `${stagedFiles.length} foto baru`;

        stagedFiles.forEach((file, index) => {
            const col = document.createElement('div');
            col.className = 'col-6 col-sm-4 col-md-3 col-lg-2';

            const card = document.createElement('div');
            card.className = 'card h-100 border rounded-3 position-relative shadow-sm overflow-hidden';

            const objectUrl = URL.createObjectURL(file);

            card.innerHTML = `
                <div style="height: 85px; overflow: hidden; background: #f8f9fa;">
                    <img src="${objectUrl}" alt="${file.name}" class="w-100 h-100" style="object-fit: cover;">
                </div>
                <div class="p-1 px-2 text-truncate small bg-white border-top text-muted" style="font-size: 0.68rem;" title="${file.name}">
                    ${file.name}
                </div>
                <button type="button" class="btn btn-danger btn-sm p-0 position-absolute top-0 end-0 m-1 rounded-circle d-flex align-items-center justify-content-center shadow" style="width: 22px; height: 22px; font-size: 12px; line-height: 1;" title="Hapus foto ini">
                    <i class="bi bi-x"></i>
                </button>
            `;

            const btnRemove = card.querySelector('button');
            btnRemove.addEventListener('click', function (e) {
                e.stopPropagation();
                stagedFiles.splice(index, 1);
                syncInputAndRender();
            });

            col.appendChild(card);
            previewGrid.appendChild(col);
        });
    }

    // Hapus semua foto baru
    if (btnClearAll) {
        btnClearAll.addEventListener('click', function () {
            stagedFiles = [];
            syncInputAndRender();
        });
    }

    // Hapus foto galeri lama (di mode edit)
    root.querySelectorAll('.btn-remove-existing-gallery').forEach(btn => {
        btn.addEventListener('click', function () {
            const item = this.closest('.existing-gallery-item');
            if (!item) return;

            const path = item.getAttribute('data-path');
            if (path && deletedContainer) {
                const hiddenInput = document.createElement('input');
                hiddenInput.type = 'hidden';
                hiddenInput.name = 'deleted_gallery[]';
                hiddenInput.value = path;
                deletedContainer.appendChild(hiddenInput);

                // Tandai ada perubahan
                actualInput.dispatchEvent(new Event('input', { bubbles: true }));
                actualInput.dispatchEvent(new Event('change', { bubbles: true }));
            }

            item.remove();

            if (window.Toast) {
                Toast.fire({
                    icon: 'info',
                    title: 'Foto ditandai dihapus (klik Simpan / Update Konten untuk menerapkan).'
                });
            }
        });
    });

    // Reset jika form di-reset
    const form = actualInput.closest('form');
    if (form) {
        const resetBtn = form.querySelector('#btn-reset-form');
        if (resetBtn) {
            resetBtn.addEventListener('click', function () {
                stagedFiles = [];
                syncInputAndRender();
            });
        }
    }
});
</script>
