<div id="modal-product" class="admin-modal-backdrop hidden" role="dialog" aria-modal="true">
    <div class="admin-modal flex flex-col max-w-7xl w-full h-[89vh]">
        {{-- =========== Header =========== --}}
        <div class="admin-modal-header shrink-0">
            <h3 id="modal-product-title" class="font-semibold text-xl -mb-1.5">Tambah Produk</h3>
            <button type="button" onclick="closeProductModal()" class="btn-icon hover:bg-var3 text-var7">
                <i data-lucide="x" class="w-6 h-6"></i>
            </button>
        </div> {{-- =========== End Header =========== --}}

        {{-- =========== Tab Navigation =========== --}}
        <div class="tab-navigation shrink-0 border-b border-var4 px-6 bg-var1 z-10 overflow-x-auto scrollbar-none">
            <div class="flex gap-1">
                @foreach ([
                    ['id' => 'tab-info',   'label' => 'Informasi Dasar'],
                    ['id' => 'tab-detail', 'label' => 'Detail Produk'],
                    ['id' => 'tab-harga',  'label' => 'Detail Harga'],
                    ['id' => 'tab-ukuran', 'label' => 'Ukuran & Warna'],
                    // ['id' => 'tab-gambar', 'label' => 'Gambar'],
                ] as $tab)
                    <button type="button" data-tab="{{ $tab['id'] }}" onclick="switchTab('{{ $tab['id'] }}')" class="modal-tab shrink-0 px-4 py-2.5 text-base font-semibold border-b-3 transition-colors duration-200 -mb-px cursor-pointer {{ $loop->first ? 'border-var10 text-var10' : 'border-transparent text-var7 hover:text-var10' }}">
                        {{ $tab['label'] }}
                    </button>
                @endforeach
            </div>
        </div> {{-- =========== End Tab Navigation =========== --}}

        {{-- =========== Form Input Produk =========== --}}
        <div class="flex-1 overflow-y-auto">
            <form id="form-product" class="admin-modal-body">
                <input type="hidden" id="product-id">

                {{-- ── TAB 1: Informasi Dasar ── --}}
                <div id="tab-info" class="tab-panel space-y-4">
                    <div class="grid grid-cols-2 gap-5">
                        <div>
                            <label class="admin-label">Nama Produk <span class="text-var10">*</span></label>
                            <input type="text" name="name" id="f-name" class="admin-input" placeholder="mis. Polo CVC 24s Lacoste Pique">
                            <p class="admin-error-text hidden" data-error="name"></p>
                        </div>
                        <div>
                            <label class="admin-label">Slug <span class="text-var7 font-normal text-sm">(otomatis dari nama)</span></label>
                            <input type="text" id="f-slug" class="admin-input bg-var3 text-var7 cursor-not-allowed" readonly placeholder="otomatis terisi">
                        </div>
                        <div>
                            <label class="admin-label">Harga Mulai dari <span class="text-var10">*</span></label>
                            <input type="text" name="harga_mulai" id="f-harga" class="admin-input" placeholder="mis. Rp 81.000">
                            <p class="admin-error-text hidden" data-error="harga_mulai"></p>
                        </div>
                        <div>
                            <label class="admin-label">Spesifikasi Singkat</label>
                            <input type="text" name="spesifikasi" id="f-spesifikasi" class="admin-input" placeholder="mis. Lengan Pendek | 18 Warna | S-7XL">
                        </div>
                        <div class="col-span-2">
                            <label class="admin-label">Deskripsi Singkat</label>
                            <textarea name="deskripsi_singkat" id="f-deskripsi-singkat" rows="4" class="admin-input resize-none" placeholder="Deskripsi singkat produk untuk SEO & preview..."></textarea>
                        </div>
                    </div>
                    <div class="flex items-center gap-6 pt-1">
                        <label class="flex items-center gap-2 cursor-pointer select-none">
                            <input type="checkbox" name="is_best_seller" id="f-best-seller" class="w-4 h-4 accent-var10">
                            <span class="text-sm font-medium">Best Seller (maks. 3)</span>
                        </label>
                        <label class="flex items-center gap-2 cursor-pointer select-none">
                            <input type="checkbox" name="is_active" id="f-active" class="w-4 h-4 accent-var10" checked>
                            <span class="text-sm font-medium">Aktif (tampil di website)</span>
                        </label>
                    </div>
                </div>

                {{-- ── TAB 2: Detail Produk ── --}}
                <div id="tab-detail" class="tab-panel hidden space-y-4">
                    <div class="grid grid-cols-2 gap-5">
                        <div>
                            <label class="admin-label">Cover Image <span class="text-var10">*</span> <span class="text-var7 font-normal text-sm">(tampil di daftar produk & best seller. maks 2MB)</span></label>
                            <input type="file" name="cover_image" id="f-cover" accept="image/*" class="admin-input cursor-pointer">
                            <div id="cover-preview" class="mt-2 hidden">
                                <img id="cover-preview-img" src="" alt="Preview cover" class="h-32 w-32 object-cover rounded-xl border border-var4">
                            </div>
                            <p class="admin-error-text hidden" data-error="cover_image"></p>
                        </div>
                        <div>
                            <label class="admin-label">Preview Images <span class="text-var7 font-normal text-sm">(maks. 4 gambar tambahan & file maks. 2MB)</span></label>
                            <input type="file" name="preview_images[]" id="f-previews" accept="image/*" multiple class="admin-input cursor-pointer">
                            <div id="previews-container" class="mt-2 flex flex-wrap gap-2"></div>
                        </div>
                    </div>
                    <div>
                        <label class="admin-label">Deskripsi Lengkap Produk</label>
                        <textarea name="detail_deskripsi" id="f-detail-deskripsi" rows="4" class="admin-input resize-none" placeholder="Deskripsi lengkap produk..."></textarea>
                    </div>
                    <div>
                        <label class="admin-label">Fitur / Spesifikasi <span class="text-var7 font-normal text-sm">(bullet list)</span></label>
                        <div id="fitur-list" class="space-y-2 mb-2"></div>
                        <button type="button" onclick="addFitur()" class="btn-secondary text-sm ps-5.75 pe-7">
                            <i data-lucide="plus" class="w-4 h-4"></i> Tambah Fitur
                        </button>
                    </div>
                </div>

                {{-- ── TAB 3: Detail Harga ── --}}
                <div id="tab-harga" class="tab-panel hidden space-y-5">
                    <div>
                        <label class="admin-label">Tabel Harga per Kuantitas</label>
                        <div class="border border-var4 rounded-xl overflow-hidden">
                            <table class="w-full text-sm">
                                <thead class="bg-var3">
                                    <tr>
                                        <th class="px-4 py-2.5 text-left font-semibold text-var8 w-1/2">Kuantitas</th>
                                        <th class="px-4 py-2.5 text-left font-semibold text-var8 w-1/2">Harga per pcs</th>
                                        <th class="w-10"></th>
                                    </tr>
                                </thead>
                                <tbody id="price-tier-list"></tbody>
                            </table>
                        </div>
                        <button type="button" onclick="addPriceTier()" class="btn-secondary mt-2 text-sm ps-5.75 pe-7">
                            <i data-lucide="plus" class="w-4 h-4"></i> Tambah Baris
                        </button>
                    </div>
                    <div>
                        <label class="admin-label">Catatan Harga <span class="text-var7 font-normal text-sm">(bullet list)</span></label>
                        <div id="price-note-list" class="space-y-2 mb-2"></div>
                        <button type="button" onclick="addPriceNote()" class="btn-secondary text-sm ps-5.75 pe-7">
                            <i data-lucide="plus" class="w-4 h-4"></i> Tambah Catatan
                        </button>
                    </div>
                </div>

                {{-- ── TAB 4: Ukuran & Warna ── --}}
                <div id="tab-ukuran" class="tab-panel hidden space-y-5">
                    {{-- Toleransi --}}
                    <div>
                        <label class="admin-label">Keterangan Toleransi</label>
                        <input type="text" name="ukuran_toleransi" id="f-toleransi" class="admin-input" placeholder="mis. *Toleransi ukuran 1-2cm | Lingkar dada 2x lebar kaos">
                    </div>

                    {{-- Size Chart --}}
                    <div class="space-y-3">
                        <label class="admin-label mb-1">Size Chart <span class="text-var7 font-normal text-sm">(kolom dapat fleksibel)</span></label>
                        <div class="grid grid-cols-[1.7fr_2fr] gap-5">
                            <div>
                                <p class="font-semibold mb-2 text-[15px]">Header Kolom Ukuran <span class="text-var7 font-normal text-sm">(mis. S, M, L, XL, 2XL, dst)</span></p>
                                <div id="size-header-list" class="flex flex-row flex-wrap gap-2 mb-2"></div>
                                <button type="button" onclick="addSizeHeader()" class="btn-secondary text-sm ps-5.75 pe-7">
                                    <i data-lucide="plus" class="w-4 h-4"></i> Tambah Ukuran
                                </button>
                            </div>
                            <div>
                                <p class="font-semibold mb-2 text-[15px]">Baris Ukuran <span class="text-var7 font-normal text-sm">(mis. P, L, PL & baris otomatis, jika header terisi)</span></p>
                                <div id="size-row-list" class="space-y-2 mb-2"></div>
                                <button type="button" onclick="addSizeRow()" class="btn-secondary text-sm ps-5.75 pe-7">
                                    <i data-lucide="plus" class="w-4 h-4"></i> Tambah Baris
                                </button>
                            </div>
                        </div>
                    </div>

                    {{-- Pilihan Warna --}}
                    <div>
                        <label class="admin-label">Pilihan Warna <span class="text-var7 font-normal text-sm">(centang yang tersedia di produk ini)</span></label>
                        <div id="color-list" class="mt-3"></div>
                    </div>
                </div>
            </form> {{-- =========== End Form Input Produk =========== --}}
        </div>

        {{-- =========== Footer Modal =========== --}}
        <div class="admin-modal-footer shrink-0"">
            <button type="button" onclick="closeProductModal()" class="btn-secondary">Batal</button>
            <button type="button" onclick="submitProduct()" class="btn-primary">Simpan</button>
        </div> {{-- =========== End Footer Modal =========== --}}
    </div>
</div>