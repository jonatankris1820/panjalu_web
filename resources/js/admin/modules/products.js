import { createIcons, icons } from 'lucide';

/* ── Helpers ── */
const $ = (id) => document.getElementById(id);

const slugify = (str) => str.toLowerCase().trim()
    .replace(/[^a-z0-9\s-]/g, '')
    .replace(/\s+/g, '-')
    .replace(/-+/g, '-');

/* ── Preset Warna Kaosintim ── */
const PRESET_COLORS = [
    // === Putih & Netral ===
    { hex: '#ffffff', nama: 'Putih', has_border: true },
    { hex: '#000000', nama: 'Hitam' },
    { hex: '#54504d', nama: 'Charcoal' },
    { hex: '#414149', nama: 'Abu Tua' },
    { hex: '#d1d1d1', nama: 'Ash Sport' },
    { hex: '#c6c6c6', nama: 'Abu Misty' },
    { hex: '#ede8dd', nama: 'Cream' },
    { hex: '#c4b190', nama: 'Coksu' },
    { hex: '#412f31', nama: 'Coklat' },
    { hex: '#c19b5f', nama: 'Kubus' },

    // === Merah & Pink ===
    { hex: '#e21423', nama: 'Merah' },
    { hex: '#600b15', nama: 'Maroon' },
    { hex: '#511733', nama: 'Burgundy' },
    { hex: '#f5a3a1', nama: 'Salem' },
    { hex: '#f95578', nama: 'Fanta' },
    { hex: '#c1216a', nama: 'Pink Fanta' },
    { hex: '#f9c0d3', nama: 'Pink Baby' },
    { hex: '#c19791', nama: 'Dusty Pink' },
    { hex: '#93462e', nama: 'Teracota' },
    { hex: '#da6e3b', nama: 'Bata' },

    // === Orange & Kuning ===
    { hex: '#f97e2b', nama: 'Orange' },
    { hex: '#f4a738', nama: 'Golden Yellow' },
    { hex: '#ffca55', nama: 'Mustard' },
    { hex: '#f9b653', nama: 'Kuning Mas' },
    { hex: '#ffd008', nama: 'Kuning' },
    { hex: '#e3d373', nama: 'Pale Yellow' },
    { hex: '#b3e261', nama: 'Stabilo' },

    // === Hijau ===
    { hex: '#68991c', nama: 'Moss Green' },
    { hex: '#3a5622', nama: 'Army' },
    { hex: '#5e6623', nama: 'Hijau Army' },
    { hex: '#878e7b', nama: 'Sage Green' },
    { hex: '#51ad58', nama: 'Hijau Fuji' },
    { hex: '#9fd85d', nama: 'Hijau Neon' },
    { hex: '#0d422b', nama: 'Hijau Botol' },
    { hex: '#68bca4', nama: 'Tosca Muda' },
    { hex: '#4ca5ac', nama: 'Tosca Tua' },
    { hex: '#0d92a0', nama: 'Tosca' },

    // === Biru ===
    { hex: '#0041a0', nama: 'Benhur' },
    { hex: '#00315e', nama: 'Navy' },
    { hex: '#005b93', nama: 'Classic Blue' },
    { hex: '#4f77b7', nama: 'Steel Blue' },
    { hex: '#1c96d3', nama: 'Turkish' },
    { hex: '#69bbe8', nama: 'Biru Laut' },
    { hex: '#94c2ed', nama: 'Ocean Blue' },
    { hex: '#91c8f2', nama: 'Telur Asin' },
    { hex: '#91cbe2', nama: 'Biru Baby' },
    { hex: '#c1e0e5', nama: 'Biru Muda' },

    // === Ungu ===
    { hex: '#702e7c', nama: 'Violet' },
    { hex: '#803ea8', nama: 'Ungu Tua' },
    { hex: '#c598df', nama: 'Ungu Muda' },
    { hex: '#c3a1d1', nama: 'Lilac' },
];

/* ── Toast ── */
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
    el.innerHTML  = `<span>${message}</span>
        <button onclick="this.parentElement.remove()" class="ml-auto opacity-60 hover:opacity-100 cursor-pointer">✕</button>`;
    document.body.appendChild(el);

    setTimeout(() => {
        el.style.transition = 'opacity 0.4s';
        el.style.opacity    = '0';
        setTimeout(() => el.remove(), 400);
    }, 4000);
}

/* ── Error Handling ── */
function clearErrors() {
    document.querySelectorAll('#modal-product [data-error]').forEach(el => {
        el.textContent = '';
        el.classList.add('hidden');
    });
    document.querySelectorAll('#modal-product .admin-input').forEach(el => {
        el.classList.remove('admin-input-error');
    });
}

function showErrors(errors) {
    Object.entries(errors).forEach(([field, messages]) => {
        const errEl   = document.querySelector(`#modal-product [data-error="${field}"]`);
        const inputEl = document.querySelector(`#modal-product [name="${field}"]`);
        if (errEl) {
            errEl.textContent = Array.isArray(messages) ? messages[0] : messages;
            errEl.classList.remove('hidden');
        }
        if (inputEl) inputEl.classList.add('admin-input-error');
    });
}

/* ── Tab Switch ── */
window.switchTab = (tabId) => {
    document.querySelectorAll('.tab-panel').forEach(el => el.classList.add('hidden'));
    document.querySelectorAll('.modal-tab').forEach(el => {
        el.classList.remove('border-var10', 'text-var10');
        el.classList.add('border-transparent', 'text-var7');
    });
    $(tabId)?.classList.remove('hidden');
    const activeBtn = document.querySelector(`[data-tab="${tabId}"]`);
    activeBtn?.classList.add('border-var10', 'text-var10');
    activeBtn?.classList.remove('border-transparent', 'text-var7');
};

/* ── Color Checkbox Grid ── */
function renderColorCheckboxes(selectedColors = []) {
    const container = $('color-list');
    if (!container) return;
    container.innerHTML = '';

    const selectedHexes = selectedColors.map(c =>
        (typeof c === 'string' ? c : (c.hex ?? '')).toLowerCase()
    );

    const grid      = document.createElement('div');
    grid.className  = 'grid grid-cols-11 gap-x-2 gap-y-4';

    PRESET_COLORS.forEach((color) => {
        const isChecked  = selectedHexes.includes(color.hex.toLowerCase());
        const needBorder = color.has_border ?? false;

        const label      = document.createElement('label');
        label.className  = 'flex flex-col items-center gap-1 cursor-pointer select-none group';
        label.innerHTML  = `
            <div class="relative">
                <div class="w-8 h-8 rounded-full ${needBorder ? 'border border-var5' : ''} transition-all duration-150" style="background-color:${color.hex}"></div>
                <input type="checkbox" name="colors_preset[]" value="${color.hex}" data-nama="${color.nama}" data-border="${needBorder ? '1' : '0'}" class="color-checkbox sr-only" ${isChecked ? 'checked' : ''}>
                <div class="color-check-indicator absolute -top-1 -right-1 w-4 h-4 rounded-full bg-var10 text-white flex items-center justify-center pointer-events-none ${isChecked ? '' : 'hidden'}" style="font-size:9px;font-weight:700">✓</div>
            </div>
            <span class="text-center text-var8 group-hover:text-var9 leading-tight" style="font-size:13px;">${color.nama}</span>`;

        label.querySelector('.color-checkbox').addEventListener('change', (e) => {
            label.querySelector('.color-check-indicator').classList.toggle('hidden', !e.target.checked);
        });

        grid.appendChild(label);
    });

    container.appendChild(grid);
}

/* ── Sync kolom nilai sizeRow dengan jumlah header ── */
function syncSizeRowColumns() {
    const headerCount = $('size-header-list')?.children.length ?? 0;
    if (headerCount === 0) return;

    document.querySelectorAll('#size-row-list > div').forEach(row => {
        const wrapper   = row.querySelector('.size-nilai-wrapper');
        if (!wrapper) return;

        const currCount = wrapper.querySelectorAll('input').length;

        if (headerCount > currCount) {
            /* Tambah kolom */
            for (let i = currCount; i < headerCount; i++) {
                const input       = document.createElement('input');
                input.type        = 'text';
                input.name        = 'size_rows[][nilai][]';
                input.placeholder = '–';
                input.className   = 'admin-input w-15 text-center text-sm shrink-0';
                wrapper.appendChild(input);
            }
        } else if (headerCount < currCount) {
            /* Hapus kolom berlebih dari belakang */
            for (let i = currCount; i > headerCount; i--) {
                wrapper.lastChild?.remove();
            }
        }
    });
}

/* ── Modal Open/Close ── */
window.closeProductModal = () => {
    $('modal-product').classList.add('hidden');
    $('form-product').reset();
    clearErrors();
    resetDynamicLists();
    switchTab('tab-info');
    $('f-slug').value = '';
    $('cover-preview').classList.add('hidden');
    $('previews-container').innerHTML = '';
};

window.openCreateModal = () => {
    $('modal-product-title').textContent = 'Tambah Produk';
    $('product-id').value                = '';
    $('f-active').checked                = true;
    $('f-best-seller').checked           = false;
    resetDynamicLists();
    initDefaultRows();
    renderColorCheckboxes([]);
    $('modal-product').classList.remove('hidden');
    switchTab('tab-info');
};

window.openEditModal = async (id) => {
    $('modal-product-title').textContent = 'Edit Produk';
    $('product-id').value                = id;

    const res  = await fetch(ROUTES.edit(id), {
        headers: { 'Accept': 'application/json', 'X-CSRF-TOKEN': CSRF },
    });
    const json = await res.json();
    if (!json.success) { showToast('Gagal memuat data produk.', 'error'); return; }

    const p = json.data;

    /* ── Isi field dasar ── */
    $('f-name').value              = p.name              ?? '';
    $('f-slug').value              = p.slug              ?? '';
    $('f-harga').value             = p.harga_mulai       ?? '';
    $('f-spesifikasi').value       = p.spesifikasi       ?? '';
    $('f-deskripsi-singkat').value = p.deskripsi_singkat ?? '';
    $('f-detail-deskripsi').value  = p.detail_deskripsi  ?? '';
    $('f-toleransi').value         = p.ukuran_toleransi  ?? '';
    $('f-best-seller').checked     = !!p.is_best_seller;
    $('f-active').checked          = !!p.is_active;

    /* ── Cover preview ── */
    if (p.cover_image) {
        $('cover-preview-img').src = `/storage/${p.cover_image}`;
        $('cover-preview').classList.remove('hidden');
    } else {
        $('cover-preview').classList.add('hidden');
    }

    /* ── Reset & isi dynamic lists ── */
    resetDynamicLists();

    p.features    ?.forEach(f => addFitur(f.fitur));
    p.price_tiers ?.forEach(t => addPriceTier(t.kualitas, t.harga));
    p.price_notes ?.forEach(n => addPriceNote(n.catatan));

    /* Size headers — skip kolom pertama 'SIZE' yang selalu ada */
    (p.size_header?.headers ?? []).slice(1).forEach(h => addSizeHeader(h));

    /* Size rows — setelah header diisi agar kolom nilai sync */
    p.size_rows?.forEach(r => addSizeRow(r.label, r.nilai ?? []));

    /* Colors */
    renderColorCheckboxes(p.colors ?? []);

    $('modal-product').classList.remove('hidden');
    switchTab('tab-info');
    createIcons({ icons });
};

/* ── Submit ── */
window.submitProduct = async () => {
    clearErrors();

    const id     = $('product-id').value;
    const isEdit = !!id;

    /* ── Bangun FormData dari scratch agar array nested benar ── */
    const formEl = $('form-product');
    const data   = new FormData();

    /* Method */
    if (isEdit) data.append('_method', 'POST');

    /* Field teks biasa */
    const textFields = [
        'name', 'harga_mulai', 'spesifikasi',
        'deskripsi_singkat', 'detail_deskripsi', 'ukuran_toleransi',
    ];
    textFields.forEach(field => {
        const el = formEl.querySelector(`[name="${field}"]`);
        if (el) data.append(field, el.value ?? '');
    });

    /* Checkbox */
    data.append('is_active',      $('f-active').checked      ? '1' : '0');
    data.append('is_best_seller', $('f-best-seller').checked ? '1' : '0');

    /* Cover image */
    const coverFile = $('f-cover')?.files?.[0];
    if (coverFile) data.append('cover_image', coverFile);

    /* Preview images */
    const previewFiles = $('f-previews')?.files;
    if (previewFiles) {
        Array.from(previewFiles).slice(0, 4).forEach(file => {
            data.append('preview_images[]', file);
        });
    }

    /* ── Fitur ── */
    formEl.querySelectorAll('#fitur-list input[name="fitur[]"]').forEach((el, i) => {
        if (el.value.trim()) data.append(`fitur[${i}]`, el.value.trim());
    });

    /* ── Price Tiers ── */
    const tierRows = formEl.querySelectorAll('#price-tier-list tr');
    let tierIdx = 0;
    tierRows.forEach(tr => {
        const kualitas = tr.querySelector('input[name="price_tiers[][kualitas]"]')?.value?.trim();
        const harga    = tr.querySelector('input[name="price_tiers[][harga]"]')?.value?.trim();
        if (kualitas && harga) {
            data.append(`price_tiers[${tierIdx}][kualitas]`, kualitas);
            data.append(`price_tiers[${tierIdx}][harga]`,    harga);
            tierIdx++;
        }
    });

    /* ── Price Notes ── */
    formEl.querySelectorAll('#price-note-list input[name="price_notes[]"]').forEach((el, i) => {
        if (el.value.trim()) data.append(`price_notes[${i}]`, el.value.trim());
    });

    /* ── Size Headers ── */
    const headerInputs = formEl.querySelectorAll('#size-header-list input[name="size_headers[]"]');
    let headerIdx = 0;
    headerInputs.forEach(el => {
        if (el.value.trim()) {
            data.append(`size_headers[${headerIdx}]`, el.value.trim());
            headerIdx++;
        }
    });

    /* ── Size Rows ── */
    const sizeRowDivs = formEl.querySelectorAll('#size-row-list > div');
    let rowIdx = 0;
    sizeRowDivs.forEach(div => {
        const labelEl = div.querySelector('select[name="size_rows[][label]"]');
        const nilaiEls = div.querySelectorAll('.size-nilai-wrapper input');
        const label   = labelEl?.value?.trim();
        if (!label) return;

        data.append(`size_rows[${rowIdx}][label]`, label);

        let nilaiIdx = 0;
        nilaiEls.forEach(input => {
            const val = input.value.trim();
            if (val !== '') {
                data.append(`size_rows[${rowIdx}][nilai][${nilaiIdx}]`, val);
                nilaiIdx++;
            }
        });

        rowIdx++;
    });

    /* ── Colors ── */
    let colorIdx = 0;
    formEl.querySelectorAll('.color-checkbox:checked').forEach(cb => {
        data.append(`colors[${colorIdx}][hex]`,        cb.value);
        data.append(`colors[${colorIdx}][nama]`,       cb.dataset.nama);
        data.append(`colors[${colorIdx}][has_border]`, cb.dataset.border);
        colorIdx++;
    });

    /* ── Kirim ── */
    const url = isEdit ? ROUTES.update(id) : ROUTES.store;
    const res = await fetch(url, {
        method:  'POST',
        headers: { 'X-CSRF-TOKEN': CSRF, 'Accept': 'application/json' },
        body:    data,
    });
    const json = await res.json();

    if (!res.ok) {
        if (json.errors) showErrors(json.errors);
        showToast(json.message ?? 'Terjadi kesalahan.', 'error');
        return;
    }

    closeProductModal();
    showToast(json.message);
    setTimeout(() => location.reload(), 800);
};

/* ── Delete ── */
window.deleteProduct = async (id, name) => {
    if (!confirm(`Hapus produk "${name}"? Tindakan ini tidak dapat dibatalkan.`)) return;

    const res  = await fetch(ROUTES.destroy(id), {
        method:  'POST',
        headers: { 'X-CSRF-TOKEN': CSRF, 'Accept': 'application/json' },
        body:    new URLSearchParams({ _method: 'DELETE' }),
    });
    const json = await res.json();

    showToast(json.message, json.success ? 'success' : 'error');
    if (json.success) setTimeout(() => location.reload(), 800);
};

/* ── DOMContentLoaded ── */
document.addEventListener('DOMContentLoaded', () => {

    /* Slug auto-generate saat create */
    $('f-name')?.addEventListener('input', (e) => {
        if (!$('product-id').value) {
            $('f-slug').value = slugify(e.target.value);
        }
    });

    /* Cover preview */
    $('f-cover')?.addEventListener('change', (e) => {
        const file = e.target.files[0];
        if (!file) return;
        $('cover-preview-img').src = URL.createObjectURL(file);
        $('cover-preview').classList.remove('hidden');
    });

    /* Preview images */
    $('f-previews')?.addEventListener('change', (e) => {
        const container   = $('previews-container');
        container.innerHTML = '';
        Array.from(e.target.files).slice(0, 4).forEach(file => {
            const img     = document.createElement('img');
            img.src       = URL.createObjectURL(file);
            img.className = 'h-32 w-32 object-cover rounded-xl border border-var4';
            container.appendChild(img);
        });
    });

    /* Tutup modal klik backdrop */
    $('modal-product')?.addEventListener('click', function (e) {
        if (e.target === this) closeProductModal();
    });
});

/* ── Dynamic Lists ── */
function resetDynamicLists() {
    $('fitur-list').innerHTML       = '';
    $('price-tier-list').innerHTML  = '';
    $('price-note-list').innerHTML  = '';
    $('size-header-list').innerHTML = '';
    $('size-row-list').innerHTML    = '';
    $('color-list').innerHTML       = '';
}

function initDefaultRows() {
    addPriceTier('Micro: 1-5 pcs',      '');
    addPriceTier('Kecil: 6-23 pcs',     '');
    addPriceTier('Menengah: 24-72 pcs', '');
    addPriceTier('Besar: 72+ pcs',      '');
    /* Size row TIDAK auto-add — admin isi header dulu, baru tambah baris */
}

/* ── Fitur ── */
window.addFitur = (value = '') => {
    const div     = document.createElement('div');
    div.className = 'flex items-center gap-2';
    div.innerHTML = `
        <input type="text" name="fitur[]" value="${value}" placeholder="mis. Bahan: 100% Cotton Combed" class="admin-input flex-1 text-sm">
        <button type="button" onclick="this.parentElement.remove()" class="btn-icon bg-red-50 hover:bg-red-100 text-red-500 shrink-0">
            <i data-lucide="x" class="w-4 h-4"></i>
        </button>`;
    $('fitur-list').appendChild(div);
    createIcons({ icons });
};

/* ── Price Tier ── */
window.addPriceTier = (kualitas = '', harga = '') => {
    const tr      = document.createElement('tr');
    tr.className  = 'border-t border-var4';
    tr.innerHTML  = `
        <td class="px-3 py-2">
            <input type="text" name="price_tiers[][kualitas]" value="${kualitas}" placeholder="mis. Micro: 1-5 pcs" class="admin-input text-sm">
        </td>
        <td class="px-3 py-2">
            <input type="text" name="price_tiers[][harga]" value="${harga}" placeholder="mis. Rp 94.000 per pcs" class="admin-input text-sm">
        </td>
        <td class="px-2 py-2 text-center">
            <button type="button" onclick="this.closest('tr').remove()" class="btn-icon bg-red-50 hover:bg-red-100 text-red-500">
                <i data-lucide="x" class="w-4 h-4"></i>
            </button>
        </td>`;
    $('price-tier-list').appendChild(tr);
    createIcons({ icons });
};

/* ── Price Note ── */
window.addPriceNote = (value = '') => {
    const div     = document.createElement('div');
    div.className = 'flex items-center gap-2';
    div.innerHTML = `
        <input type="text" name="price_notes[]" value="${value}" placeholder="mis. Harga sudah termasuk sablon 1 titik" class="admin-input flex-1 text-sm">
        <button type="button" onclick="this.parentElement.remove()" class="btn-icon bg-red-50 hover:bg-red-100 text-red-500 shrink-0">
            <i data-lucide="x" class="w-4 h-4"></i>
        </button>`;
    $('price-note-list').appendChild(div);
    createIcons({ icons });
};

/* ── Size Header ── */
window.addSizeHeader = (value = '') => {
    const div     = document.createElement('div');
    div.className = 'flex items-center gap-2';
    div.innerHTML = `
        <input type="text" name="size_headers[]" value="${value}" placeholder="XL" class="admin-input w-14 text-center text-sm">
        <button type="button" onclick="removeSizeHeader(this)" class="btn-icon bg-red-50 hover:bg-red-100 text-red-500 shrink-0 w-9 h-9">
            <i data-lucide="x" class="w-4 h-4"></i>
        </button>`;
    $('size-header-list').appendChild(div);
    syncSizeRowColumns();
    createIcons({ icons });
};

window.removeSizeHeader = (btn) => {
    btn.parentElement.remove();
    syncSizeRowColumns();
};

/* ── Size Row — kolom nilai mengikuti jumlah header yang sudah ada ── */
window.addSizeRow = (label = '', nilai = []) => {
    const headerCount = $('size-header-list')?.children.length ?? 0;

    /* Jika belum ada header sama sekali, tetap buat 1 kolom placeholder */
    const inputCount = headerCount > 0 ? headerCount : 1;

    const nilaiInputs = Array.from({ length: inputCount }, (_, i) => `
        <input type="text" name="size_rows[][nilai][]" value="${nilai[i] ?? ''}" placeholder="–" class="admin-input w-15 text-center text-sm shrink-0">
    `).join('');

    const div     = document.createElement('div');
    div.className = 'flex items-center gap-2';
    div.innerHTML = `
        <select name="size_rows[][label]" class="admin-input w-32 text-sm shrink-0">
            <option value="P"  ${label === 'P'  ? 'selected' : ''}>P (Panjang)</option>
            <option value="L"  ${label === 'L'  ? 'selected' : ''}>L (Lebar)</option>
            <option value="PL" ${label === 'PL' ? 'selected' : ''}>PL (P. Lengan)</option>
        </select>
        <div class="flex gap-1 flex-wrap flex-1 size-nilai-wrapper">
            ${nilaiInputs}
        </div>
        <button type="button" onclick="this.parentElement.remove()" class="btn-icon bg-red-50 hover:bg-red-100 text-red-500 shrink-0">
            <i data-lucide="x" class="w-4 h-4"></i>
        </button>`;
    $('size-row-list').appendChild(div);
    createIcons({ icons });
};