<!-- Flatpickr Date/Time Picker JS -->
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/id.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        if (typeof flatpickr === 'undefined') return;

        // Date + Time Picker (input[type="datetime-local"] atau .datetimepicker)
        document.querySelectorAll('input[type="datetime-local"], input.datetimepicker').forEach(function (el) {
            if (el.value && el.value.includes('T')) {
                el.value = el.value.replace('T', ' ');
            }
            flatpickr(el, {
                locale: 'id',
                enableTime: true,
                time_24hr: true,
                dateFormat: 'Y-m-d H:i',
                altInput: true,
                altFormat: 'd F Y, H:i',
                allowInput: true,
                minDate: el.getAttribute('min') || null,
                maxDate: el.getAttribute('max') || null,
                onChange: function () {
                    el.dispatchEvent(new Event('change', { bubbles: true }));
                }
            });
        });

        // Date Picker (input[type="date"] atau .datepicker)
        document.querySelectorAll('input[type="date"], input.datepicker').forEach(function (el) {
            flatpickr(el, {
                locale: 'id',
                enableTime: false,
                dateFormat: 'Y-m-d',
                altInput: true,
                altFormat: 'd F Y',
                allowInput: true,
                minDate: el.getAttribute('min') || null,
                maxDate: el.getAttribute('max') || null,
                onChange: function () {
                    el.dispatchEvent(new Event('change', { bubbles: true }));
                }
            });
        });

        // ── Disable tombol Save/Update pada form Edit (PUT/PATCH) jika belum ada perubahan ──
        function serializeEditForm(form) {
            const parts = [];
            form.querySelectorAll('input, select, textarea').forEach(function (field) {
                if (field.name === '_token' || field.name === '_method') return;
                if (!field.name && field.type !== 'file') return;

                if (field.type === 'file') {
                    const files = field.files ? Array.from(field.files).map(f => f.name + ':' + f.size).join(',') : '';
                    parts.push((field.name || 'file') + '=' + files);
                } else if (field.type === 'checkbox' || field.type === 'radio') {
                    parts.push(field.name + '=' + (field.checked ? field.value : ''));
                } else {
                    parts.push(field.name + '=' + (field.value ?? ''));
                }
            });
            return parts.join('&');
        }

        document.querySelectorAll('form').forEach(function (form) {
            const methodInput = form.querySelector('input[name="_method"]');
            if (!methodInput) return;

            const method = (methodInput.value || '').toUpperCase();
            if (method !== 'PUT' && method !== 'PATCH') return;

            const submitBtns = form.querySelectorAll('button[type="submit"], input[type="submit"], #btn-save-draft');
            if (!submitBtns.length) return;

            let initialState = '';

            function setButtonsDisabled(disabled) {
                submitBtns.forEach(function (btn) {
                    btn.disabled = disabled;
                });
            }

            function captureBaseline() {
                // Sinkronkan input tersembunyi Quill editor (jika ada) sebelum menyimpan state awal
                const quillEditor = form.querySelector('.ql-editor');
                const contentInput = form.querySelector('#content-input');
                if (quillEditor && contentInput) {
                    contentInput.value = quillEditor.innerHTML;
                }
                initialState = serializeEditForm(form);
                setButtonsDisabled(true);
            }

            function checkDirty() {
                const currentState = serializeEditForm(form);
                setButtonsDisabled(currentState === initialState);
            }

            // Tunggu inisialisasi komponen (Quill, format Rupiah, Flatpickr) selesai
            setTimeout(captureBaseline, 120);

            form.addEventListener('input', checkDirty);
            form.addEventListener('change', checkDirty);
            form.addEventListener('keyup', checkDirty);
            form.addEventListener('reset', function () {
                setTimeout(checkDirty, 50);
            });

            // Jika form berada di dalam Bootstrap Modal (mis. Edit Kategori / Edit User),
            // rekam ulang state awal setiap kali modal dibuka
            const parentModal = form.closest('.modal');
            if (parentModal) {
                parentModal.addEventListener('shown.bs.modal', function () {
                    setTimeout(captureBaseline, 50);
                });
            }
        });
    });
</script>
