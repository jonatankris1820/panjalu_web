<div id="modal-edit" class="admin-modal-backdrop hidden" role="dialog" aria-modal="true">
    <div class="admin-modal max-w-lg w-full">
        <div class="admin-modal-header">
            <h3 class="font-semibold text-xl -mb-1.5">Edit Brand Colab</h3>
            <button type="button" onclick="closeModal('modal-edit')" class="btn-icon hover:bg-var3 text-var7">
                <i data-lucide="x" class="w-6 h-6"></i>
            </button>
        </div>

        <div class="admin-modal-body space-y-4">
            <input type="hidden" id="e-id">
            <div class="flex items-center gap-4 p-3 bg-var3 rounded-xl">
                <div class="w-20 h-12 bg-var1 rounded-lg flex items-center justify-center p-1.5 shrink-0">
                    <img id="e-current-img" src="" alt="" class="max-h-full max-w-full object-contain">
                </div>
                <p class="text-sm text-var8">Logo saat ini</p>
            </div>
            <div>
                <label class="admin-label">Alt Text</label>
                <input type="text" id="e-alt" class="admin-input" placeholder="Nama brand">
            </div>
            <div>
                <label class="admin-label">Ganti Logo <span class="text-var7 font-normal text-[13px]">(opsional, SVG/PNG maks 150KB)</span></label>
                <input type="file" id="e-image" accept=".svg,.png" class="admin-input cursor-pointer">
            </div>
        </div>

        <div class="admin-modal-footer">
            <button type="button" onclick="closeModal('modal-edit')" class="btn-secondary">Batal</button>
            <button type="button" onclick="submitEdit()" class="btn-primary">Simpan</button>
        </div>
    </div>
</div>