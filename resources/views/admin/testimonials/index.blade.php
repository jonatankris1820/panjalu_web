@extends('admin.layouts.app')

@section('title', 'Manage Testimoni')
@section('page-title', 'Manage Testimoni')

@section('content')

<section class="bg-var1 rounded-xl border border-var4 overflow-hidden">
    {{-- =========== Header =========== --}}
    <div class="flex items-center justify-between p-5 border-b border-var4">
        <div>
            <h2 class="text-xl font-semibold">Daftar Testimoni</h2>
            <p class="text-var8">{{ $testimonials->count() }} testimoni terdaftar</p>
        </div>
        <button type="button" onclick="openCreateModal()" class="inline-flex items-center gap-1.5 ps-4 pe-5 py-2.5 bg-var10 hover:bg-var11 text-var1 font-semibold rounded-lg transition-colors duration-200 cursor-pointer">
            <i data-lucide="plus" class="w-4.5 h-4.5"></i> Tambah Testimoni
        </button>
    </div> {{-- =========== End Header =========== --}}

    {{-- =========== Tabel =========== --}}
    <div class="overflow-x-auto">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Klien</th>
                    <th>Perusahaan</th>
                    <th>Rating</th>
                    <th>Testimoni</th>
                    <th class="text-center">Status</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($testimonials as $item)
                    <tr>
                        <td>
                            <div class="flex items-center gap-3">
                                @if ($item->foto_path)
                                    <img src="{{ Storage::url($item->foto_path) }}" alt="{{ $item->nama }}" class="w-9 h-9 rounded-full object-cover shrink-0">
                                @else
                                    <div class="w-9 h-9 rounded-full bg-var10 text-var1 flex items-center justify-center text-xs font-semibold shrink-0">
                                        {{ $item->initials }}
                                    </div>
                                @endif
                                <p class="font-medium">{{ $item->nama }}</p>
                            </div>
                        </td>
                        <td>{{ $item->perusahaan ?? '–' }}</td>
                        <td>
                            <div class="flex items-center gap-1">
                                @for ($s = 1; $s <= 5; $s++)
                                    <i data-lucide="star" class="w-4 h-4 {{ $s <= $item->rating ? 'text-amber-400 fill-amber-400' : 'text-var5' }}"></i>
                                @endfor
                            </div>
                        </td>
                        <td class="max-w-xs truncate">{{ $item->pesan }}</td>
                        <td class="text-center">
                            @if ($item->is_active)
                                <span class="badge-active"><span class="w-1.5 h-1.5 rounded-full bg-green-500"></span>Aktif</span>
                            @else
                                <span class="badge-inactive"><span class="w-1.5 h-1.5 rounded-full bg-var7"></span>Nonaktif</span>
                            @endif
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
                        <td colspan="6" class="text-center py-10 text-var7">Belum ada testimoni.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div> {{-- =========== End Tabel =========== --}}
</section>

@include('admin.testimonials.modal-create')
@include('admin.testimonials.modal-edit')

@endsection

@push('scripts')
<script>
    const ROUTES = {
        store:   '{{ route('admin.testimonials.store') }}',
        update:  (id) => `/admin/testimonials/${id}`,
        destroy: (id) => `/admin/testimonials/${id}`,
        edit:    (id) => `/admin/testimonials/${id}`,
    };
    const CSRF = '{{ csrf_token() }}';

    function openModal(id)  { document.getElementById(id).classList.remove('hidden'); }
    function closeModal(id) {
        document.getElementById(id).classList.add('hidden');
        document.querySelectorAll(`#${id} [data-error]`).forEach(el => { el.textContent = ''; el.classList.add('hidden'); });
    }

    function showToast(message, type = 'success') {
        const existing = document.getElementById('toast-js');
        if (existing) existing.remove();
        const colors = { success: 'bg-green-50 border-green-200 text-green-800', error: 'bg-red-50 border-red-200 text-red-800' };
        const el = document.createElement('div');
        el.id = 'toast-js';
        el.className = `fixed top-5 right-5 z-[200] flex items-center gap-3 px-4 py-3 rounded-xl border shadow-md text-sm font-medium max-w-sm ${colors[type]}`;
        el.innerHTML = `<span>${message}</span><button onclick="this.parentElement.remove()" class="ml-auto opacity-60 hover:opacity-100 cursor-pointer">✕</button>`;
        document.body.appendChild(el);
        setTimeout(() => { el.style.transition = 'opacity 0.4s'; el.style.opacity = '0'; setTimeout(() => el.remove(), 400); }, 4000);
    }

    function setRating(prefix, value) {
        document.getElementById(`${prefix}-rating`).value = value;

        const selector = prefix === 'e' ? '.star-btn-e' : '.star-btn';
        const buttons  = document.querySelectorAll(selector);

        buttons.forEach((btn, i) => {
            /* Lucide sudah render jadi <svg>, cari svg bukan i */
            const svg = btn.querySelector('svg') ?? btn.querySelector('i');
            if (!svg) return;

            if (i < value) {
                svg.setAttribute('fill', '#fbbf24');
                svg.style.color = '#fbbf24';
            } else {
                svg.setAttribute('fill', 'none');
                svg.style.color = '#d1d5db'; /* abu-abu */
            }
        });
    }

    function openCreateModal() {
        document.getElementById('c-nama').value       = '';
        document.getElementById('c-perusahaan').value = '';
        document.getElementById('c-pesan').value      = '';
        document.getElementById('c-rating').value     = '';
        document.getElementById('c-is-active').checked = true;
        document.getElementById('c-foto').value       = '';
        document.getElementById('c-foto-preview').classList.add('hidden');
        setRating('c', 0);
        openModal('modal-create');
    }

    document.getElementById('c-foto')?.addEventListener('change', (e) => {
        const file = e.target.files[0];
        if (!file) return;
        document.getElementById('c-foto-preview-img').src = URL.createObjectURL(file);
        document.getElementById('c-foto-preview').classList.remove('hidden');
    });

    async function submitCreate() {
        const data = new FormData();
        data.append('nama',       document.getElementById('c-nama').value);
        data.append('perusahaan', document.getElementById('c-perusahaan').value);
        data.append('rating',     document.getElementById('c-rating').value);
        data.append('pesan',      document.getElementById('c-pesan').value);
        data.append('is_active',  document.getElementById('c-is-active').checked ? '1' : '0');
        const foto = document.getElementById('c-foto').files[0];
        if (foto) data.append('foto', foto);

        const res  = await fetch(ROUTES.store, { method: 'POST', headers: { 'X-CSRF-TOKEN': CSRF, 'Accept': 'application/json' }, body: data });
        const json = await res.json();
        if (!res.ok) {
            if (json.errors) {
                Object.entries(json.errors).forEach(([field, messages]) => {
                    const el = document.querySelector(`#modal-create [data-error="${field}"]`);
                    if (el) { el.textContent = messages[0]; el.classList.remove('hidden'); }
                });
            }
            showToast(json.message ?? 'Terjadi kesalahan.', 'error');
            return;
        }
        closeModal('modal-create');
        showToast(json.message);
        setTimeout(() => location.reload(), 800);
    }

    async function openEditModal(id) {
        const res  = await fetch(ROUTES.edit(id), { headers: { 'Accept': 'application/json', 'X-CSRF-TOKEN': CSRF } });
        const json = await res.json();
        if (!json.success) { showToast('Gagal memuat data.', 'error'); return; }
        const d = json.data;

        document.getElementById('e-id').value          = d.id;
        document.getElementById('e-nama').value        = d.nama;
        document.getElementById('e-perusahaan').value  = d.perusahaan ?? '';
        document.getElementById('e-pesan').value       = d.pesan;
        document.getElementById('e-is-active').checked = !!d.is_active;
        document.getElementById('e-foto').value        = '';
        document.getElementById('e-hapus-foto').checked = false;
        setRating('e', d.rating);

        if (d.foto_path) {
            document.getElementById('e-foto-current-img').src = `/storage/${d.foto_path}`;
            document.getElementById('e-foto-current').classList.remove('hidden');
        } else {
            document.getElementById('e-foto-current').classList.add('hidden');
        }

        openModal('modal-edit');
    }

    async function submitEdit() {
        const id   = document.getElementById('e-id').value;
        const data = new FormData();
        data.append('_method',    'POST');
        data.append('nama',       document.getElementById('e-nama').value);
        data.append('perusahaan', document.getElementById('e-perusahaan').value);
        data.append('rating',     document.getElementById('e-rating').value);
        data.append('pesan',      document.getElementById('e-pesan').value);
        data.append('is_active',  document.getElementById('e-is-active').checked ? '1' : '0');
        data.append('hapus_foto', document.getElementById('e-hapus-foto').checked ? '1' : '0');
        const foto = document.getElementById('e-foto').files[0];
        if (foto) data.append('foto', foto);

        const res  = await fetch(ROUTES.update(id), { method: 'POST', headers: { 'X-CSRF-TOKEN': CSRF, 'Accept': 'application/json' }, body: data });
        const json = await res.json();
        if (!res.ok) { showToast(json.message ?? 'Terjadi kesalahan.', 'error'); return; }
        closeModal('modal-edit');
        showToast(json.message);
        setTimeout(() => location.reload(), 800);
    }

    async function deleteItem(id) {
        if (!confirm('Hapus testimoni ini?')) return;
        const res  = await fetch(ROUTES.destroy(id), { method: 'POST', headers: { 'X-CSRF-TOKEN': CSRF, 'Accept': 'application/json' }, body: new URLSearchParams({ _method: 'DELETE' }) });
        const json = await res.json();
        showToast(json.message, json.success ? 'success' : 'error');
        if (json.success) setTimeout(() => location.reload(), 800);
    }

    ['modal-create', 'modal-edit'].forEach(id => {
        document.getElementById(id)?.addEventListener('click', function(e) { if (e.target === this) closeModal(id); });
    });
</script>
@endpush