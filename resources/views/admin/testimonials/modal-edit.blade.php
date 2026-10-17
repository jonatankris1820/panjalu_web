<div id="modal-edit" class="admin-modal-backdrop hidden" role="dialog" aria-modal="true">
    <div class="admin-modal max-w-3xl w-full">
        <div class="admin-modal-header">
            <h3 class="font-semibold text-xl -mb-1.5">Edit Testimoni</h3>
            <button type="button" onclick="closeModal('modal-edit')" class="btn-icon hover:bg-var3 text-var7">
                <i data-lucide="x" class="w-6 h-6"></i>
            </button>
        </div>

        <div class="admin-modal-body space-y-4">
            <input type="hidden" id="e-id">
            <div class="grid grid-cols-2 gap-5">
                <div>
                    <label class="admin-label">Nama Klien <span class="text-var10">*</span></label>
                    <input type="text" id="e-nama" class="admin-input">
                </div>
                <div>
                    <label class="admin-label">Perusahaan</label>
                    <input type="text" id="e-perusahaan" class="admin-input">
                </div>
            </div>
            <div class="grid grid-cols-2 gap-5">
                <div>
                    <label class="admin-label">Foto Klien <span class="text-var7 font-normal text-sm">(opsional, maks 1MB)</span></label>
                    <div id="e-foto-current" class="mb-2 hidden">
                        <img id="e-foto-current-img" src="" alt="" class="w-14 h-14 rounded-full object-cover border border-var4">
                        <label class="flex items-center gap-2 mt-2 cursor-pointer text-sm">
                            <input type="checkbox" id="e-hapus-foto" class="w-4 h-4 accent-red-500">
                            <span class="text-red-500">Hapus foto ini</span>
                        </label>
                    </div>
                    <input type="file" id="e-foto" accept="image/*" class="admin-input cursor-pointer">
                </div>
                <div>
                    <label class="admin-label">Rating <span class="text-var10">*</span></label>
                    <div class="flex items-center gap-2 mt-1" id="e-star-container">
                        @for ($s = 1; $s <= 5; $s++)
                            <button type="button" data-value="{{ $s }}" class="star-btn-e text-var5 hover:text-amber-400 transition-colors cursor-pointer" onclick="setRating('e', {{ $s }})">
                                <i data-lucide="star" class="w-7 h-7"></i>
                            </button>
                        @endfor
                    </div>
                    <input type="hidden" id="e-rating" value="">
                </div>
            </div>
            <div>
                <label class="admin-label">Deskripsi Testimoni <span class="text-var10">*</span></label>
                <textarea id="e-pesan" rows="5" class="admin-input resize-none"></textarea>
            </div>
            <div>
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" id="e-is-active" class="w-4 h-4 accent-var10">
                    <span class="text-sm font-medium">Aktif (tampil di website)</span>
                </label>
            </div>
        </div>

        <div class="admin-modal-footer">
            <button type="button" onclick="closeModal('modal-edit')" class="btn-secondary">Batal</button>
            <button type="button" onclick="submitEdit()" class="btn-primary">Simpan</button>
        </div>
    </div>
</div>