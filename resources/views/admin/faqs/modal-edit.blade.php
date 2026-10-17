<div id="modal-edit" class="admin-modal-backdrop hidden" role="dialog" aria-modal="true">
    <div class="admin-modal max-w-2xl w-full">
        <div class="admin-modal-header">
            <h3 class="font-semibold text-xl -mb-1.5">Edit FAQ</h3>
            <button type="button" onclick="closeModal('modal-edit')" class="btn-icon hover:bg-var3 text-var7">
                <i data-lucide="x" class="w-6 h-6"></i>
            </button>
        </div>

        <div class="admin-modal-body space-y-3">
            <input type="hidden" id="e-id">
            <div>
                <label class="admin-label">Pertanyaan <span class="text-var10">*</span></label>
                <textarea id="e-pertanyaan" rows="3" class="admin-input resize-none"></textarea>
            </div>
            <div>
                <label class="admin-label">Jawaban <span class="text-var10">*</span></label>
                <textarea id="e-jawaban" rows="5" class="admin-input resize-none"></textarea>
            </div>
            <label class="flex items-center gap-2 cursor-pointer">
                <input type="checkbox" id="e-is-active" class="w-4 h-4 accent-var10">
                <span class="text-sm font-medium">Aktif (tampil di website)</span>
            </label>
        </div>
        
        <div class="admin-modal-footer">
            <button type="button" onclick="closeModal('modal-edit')" class="btn-secondary">Batal</button>
            <button type="button" onclick="submitEdit()" class="btn-primary">Simpan</button>
        </div>
    </div>
</div>