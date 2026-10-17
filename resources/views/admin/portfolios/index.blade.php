@extends('admin.layouts.app')

@section('title', 'Manage Portofolio')
@section('page-title', 'Manage Portofolio')

@section('content')

<section class="bg-var1 rounded-xl border border-var4 overflow-hidden text-[15px]">
    {{-- =========== Header =========== --}}
    <div class="flex items-center justify-between p-5 border-b border-var4">
        <div>
            <h2 class="text-xl font-semibold">Daftar Portofolio</h2>
            <p class="text-var8">{{ $portfolios->count() }} portofolio terdaftar</p>
        </div>
        <button type="button" onclick="openCreateModal()" class="inline-flex items-center gap-1.5 ps-4 pe-5 py-2.5 bg-var10 hover:bg-var11 text-var1 font-semibold rounded-lg transition-colors duration-200 cursor-pointer">
            <i data-lucide="plus" class="w-4.5 h-4.5"></i> Tambah Portofolio
        </button>
    </div> {{-- =========== End Header =========== --}}

    {{-- =========== Table =========== --}}
    <div class="overflow-x-auto">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Gambar</th>
                    <th>Alt Text</th>
                    <th>Kategori</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($portfolios as $item)
                    <tr>
                        <td>
                            <img src="{{ Storage::url($item->image_path) }}" alt="{{ $item->alt }}" class="w-20 h-10 object-cover rounded-lg">
                        </td>
                        <td>{{ $item->alt }}</td>
                        <td>
                            @php
                                $badgeColor = match($item->kategori) {
                                    'Corporate' => 'bg-blue-100 text-blue-700',
                                    'UMKM'      => 'bg-green-100 text-green-700',
                                    'Event'     => 'bg-purple-100 text-purple-700',
                                    default     => 'bg-var4 text-var7',
                                };
                                $dotColor = match($item->kategori) {
                                    'Corporate' => 'bg-blue-500',
                                    'UMKM'      => 'bg-green-500',
                                    'Event'     => 'bg-purple-500',
                                    default     => 'bg-var7',
                                };
                            @endphp
                            <span class="inline-flex items-center gap-1.25 px-4 py-0.75 text-[13px] font-semibold rounded-full {{ $badgeColor }}">
                                <span class="w-1.5 h-1.5 rounded-full {{ $dotColor }}"></span>{{ $item->kategori }}
                            </span>
                        </td>
                        <td>
                            <div class="flex items-center justify-center gap-2">
                                <button type="button" onclick="openEditModal({{ $item->id }})" class="btn-icon bg-var3 hover:bg-var4 text-var8" title="Edit">
                                    <i data-lucide="pencil" class="w-4.5 h-4.5"></i>
                                </button>
                                <button type="button" onclick="deleteItem({{ $item->id }})" class="btn-icon bg-red-50 hover:bg-red-100 text-red-500" title="Hapus">
                                    <i data-lucide="trash-2" class="w-4.5 h-4.5"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center py-10 text-var7">Belum ada portofolio.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div> {{-- =========== Table =========== --}}
</section>

@include('admin.portfolios.modal-create')
@include('admin.portfolios.modal-edit')

@endsection

@push('scripts')
<script>
    const ROUTES = {
        store:   '{{ route('admin.portfolios.store') }}',
        update:  (id) => `/admin/portfolios/${id}`,
        destroy: (id) => `/admin/portfolios/${id}`,
        edit:    (id) => `/admin/portfolios/${id}`,
    };
    const CSRF = '{{ csrf_token() }}';

    /* ── Modal Helpers ── */
    function openModal(id)  { document.getElementById(id).classList.remove('hidden'); }
    function closeModal(id) { document.getElementById(id).classList.add('hidden'); clearErrors(id); }

    function clearErrors(modalId) {
        document.querySelectorAll(`#${modalId} [data-error]`).forEach(el => {
            el.textContent = '';
            el.classList.add('hidden');
        });
    }

    function showErrors(modalId, errors) {
        Object.entries(errors).forEach(([field, messages]) => {
            const el = document.querySelector(`#${modalId} [data-error="${field}"]`);
            if (el) { el.textContent = Array.isArray(messages) ? messages[0] : messages; el.classList.remove('hidden'); }
        });
    }

    function showToast(message, type = 'success') {
        const existing = document.getElementById('toast-js');
        if (existing) existing.remove();
        const colors = {
            success: 'bg-green-50 border-green-200 text-green-800',
            error:   'bg-red-50 border-red-200 text-red-800',
        };
        const el      = document.createElement('div');
        el.id         = 'toast-js';
        el.className  = `fixed top-5 right-5 z-[200] flex items-center gap-3 px-4 py-3 rounded-xl border shadow-md text-sm font-medium max-w-sm ${colors[type]}`;
        el.innerHTML  = `<span>${message}</span><button onclick="this.parentElement.remove()" class="ml-auto opacity-60 hover:opacity-100 cursor-pointer">✕</button>`;
        document.body.appendChild(el);
        setTimeout(() => {
            el.style.transition = 'opacity 0.4s';
            el.style.opacity    = '0';
            setTimeout(() => el.remove(), 400);
        }, 4000);
    }

    /* ── Dropzone Create ── */
    const cInput    = document.getElementById('c-image');
    const cDropzone = document.getElementById('c-dropzone');

    function setCDropzonePreview(file) {
        document.getElementById('c-preview-img').src         = URL.createObjectURL(file);
        document.getElementById('c-dz-filename').textContent = file.name;
        document.getElementById('c-dz-placeholder').classList.add('hidden');
        document.getElementById('c-dz-preview').classList.remove('hidden');
    }

    cInput?.addEventListener('change', (e) => {
        const file = e.target.files[0];
        if (file) setCDropzonePreview(file);
    });

    cDropzone?.addEventListener('dragover', (e) => {
        e.preventDefault();
        cDropzone.classList.add('border-var10', '!bg-red-50');
    });

    cDropzone?.addEventListener('dragleave', () => {
        cDropzone.classList.remove('border-var10', '!bg-red-50');
    });

    cDropzone?.addEventListener('drop', (e) => {
        e.preventDefault();
        cDropzone.classList.remove('border-var10', '!bg-red-50');
        const file = e.dataTransfer.files[0];
        if (!file) return;
        const dt   = new DataTransfer();
        dt.items.add(file);
        cInput.files = dt.files;
        setCDropzonePreview(file);
    });

    /* ── Dropzone Edit ── */
    const eInput    = document.getElementById('e-image');
    const eDropzone = document.getElementById('e-dropzone');

    function setEDropzonePreview(file) {
        document.getElementById('e-preview-img').src = URL.createObjectURL(file);
        const filenameEl = document.getElementById('e-dz-filename');
        filenameEl.textContent = file.name;
        filenameEl.classList.remove('hidden');
    }

    eInput?.addEventListener('change', (e) => {
        const file = e.target.files[0];
        if (file) setEDropzonePreview(file);
    });

    eDropzone?.addEventListener('dragover', (e) => {
        e.preventDefault();
        eDropzone.classList.add('border-var10', '!bg-red-50');
    });

    eDropzone?.addEventListener('dragleave', () => {
        eDropzone.classList.remove('border-var10', '!bg-red-50');
    });

    eDropzone?.addEventListener('drop', (e) => {
        e.preventDefault();
        eDropzone.classList.remove('border-var10', '!bg-red-50');
        const file = e.dataTransfer.files[0];
        if (!file) return;
        const dt   = new DataTransfer();
        dt.items.add(file);
        eInput.files = dt.files;
        setEDropzonePreview(file);
    });

    /* ── Create Modal ── */
    function openCreateModal() {
        document.getElementById('c-kategori').value = '';
        cInput.value = '';
        document.getElementById('c-dz-placeholder').classList.remove('hidden');
        document.getElementById('c-dz-preview').classList.add('hidden');
        document.getElementById('c-dz-filename').textContent = '';
        openModal('modal-create');
    }

    async function submitCreate() {
        clearErrors('modal-create');
        const data = new FormData();
        data.append('kategori', document.getElementById('c-kategori').value);
        const imageFile = cInput.files[0];
        if (imageFile) data.append('image', imageFile);

        const res  = await fetch(ROUTES.store, {
            method:  'POST',
            headers: { 'X-CSRF-TOKEN': CSRF, 'Accept': 'application/json' },
            body:    data,
        });
        const json = await res.json();

        if (!res.ok) {
            if (json.errors) showErrors('modal-create', json.errors);
            showToast(json.message ?? 'Terjadi kesalahan.', 'error');
            return;
        }

        closeModal('modal-create');
        showToast(json.message);
        setTimeout(() => location.reload(), 800);
    }

    /* ── Edit Modal ── */
    async function openEditModal(id) {
        const res  = await fetch(ROUTES.edit(id), {
            headers: { 'Accept': 'application/json', 'X-CSRF-TOKEN': CSRF },
        });
        const json = await res.json();
        if (!json.success) { showToast('Gagal memuat data.', 'error'); return; }

        const d = json.data;
        document.getElementById('e-id').value        = d.id;
        document.getElementById('e-kategori').value  = d.kategori;
        document.getElementById('e-preview-img').src = `/storage/${d.image_path}`;
        document.getElementById('e-dz-filename').classList.add('hidden');
        document.getElementById('e-dz-filename').textContent = '';
        eInput.value = '';

        openModal('modal-edit');
    }

    async function submitEdit() {
        const id   = document.getElementById('e-id').value;
        const data = new FormData();
        data.append('_method',  'POST');
        data.append('kategori', document.getElementById('e-kategori').value);
        const imageFile = eInput.files[0];
        if (imageFile) data.append('image', imageFile);

        const res  = await fetch(ROUTES.update(id), {
            method:  'POST',
            headers: { 'X-CSRF-TOKEN': CSRF, 'Accept': 'application/json' },
            body:    data,
        });
        const json = await res.json();

        if (!res.ok) { showToast(json.message ?? 'Terjadi kesalahan.', 'error'); return; }

        closeModal('modal-edit');
        showToast(json.message);
        setTimeout(() => location.reload(), 800);
    }

    /* ── Delete ── */
    async function deleteItem(id) {
        if (!confirm('Hapus portofolio ini?')) return;
        const res  = await fetch(ROUTES.destroy(id), {
            method:  'POST',
            headers: { 'X-CSRF-TOKEN': CSRF, 'Accept': 'application/json' },
            body:    new URLSearchParams({ _method: 'DELETE' }),
        });
        const json = await res.json();
        showToast(json.message, json.success ? 'success' : 'error');
        if (json.success) setTimeout(() => location.reload(), 800);
    }

    /* ── Backdrop click tutup modal ── */
    ['modal-create', 'modal-edit'].forEach(id => {
        document.getElementById(id)?.addEventListener('click', function (e) {
            if (e.target === this) closeModal(id);
        });
    });
</script>
@endpush