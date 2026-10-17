<div id="modal-create" class="admin-modal-backdrop hidden" role="dialog" aria-modal="true">
    <div class="admin-modal max-w-lg w-full">
        <div class="admin-modal-header">
            <h3 class="font-semibold text-xl -mb-1.5">Tambah Brand Colab</h3>
            <button type="button" onclick="closeModal('modal-create')" class="btn-icon hover:bg-var3 text-var7">
                <i data-lucide="x" class="w-6 h-6"></i>
            </button>
        </div>

        <div class="admin-modal-body space-y-4">
            <div>
                <label class="admin-label">Upload Logo <span class="text-var10">*</span></label>
                <p class="text-[13px] text-var8 -mt-1 mb-3">Format SVG atau PNG. Maks 150KB per file. Bisa pilih banyak sekaligus.</p>
                <input type="file" id="c-images" accept=".svg,.png" multiple class="admin-input cursor-pointer">
                <div id="c-previews" class="mt-3 flex flex-wrap gap-3"></div>
                <p class="admin-error-text hidden" data-error="images"></p>
            </div>
        </div>

        <div class="admin-modal-footer">
            <button type="button" onclick="closeModal('modal-create')" class="btn-secondary">Batal</button>
            <button type="button" onclick="submitCreate()" class="btn-primary">Simpan</button>
        </div>
    </div>
</div>