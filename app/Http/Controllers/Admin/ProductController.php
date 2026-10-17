<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductPriceTier;
use App\Models\ProductPriceNote;
use App\Models\ProductFeature;
use App\Models\ProductSizeHeader;
use App\Models\ProductSizeRow;
use App\Models\ProductColor;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::orderBy('sort_order')->orderByDesc('created_at')->get();
        return view('admin.products.index', compact('products'));
    }

    public function store(Request $request)
    {
        $this->validateProduct($request);

        if ($request->boolean('is_best_seller')) {
            if (Product::where('is_best_seller', true)->count() >= 3) {
                return response()->json([
                    'success' => false,
                    'message' => 'Maksimal 3 produk Best Seller. Nonaktifkan salah satu terlebih dahulu.',
                ], 422);
            }
        }

        DB::beginTransaction();
        try {
            $product = Product::create([
                'name'              => $request->name,
                'slug'              => Str::slug($request->name),
                'harga_mulai'       => $request->harga_mulai,
                'spesifikasi'       => $request->spesifikasi,
                'wa_link'           => 'https://wa.me/6281273919000',
                'cover_image'       => '',
                'deskripsi_singkat' => $request->deskripsi_singkat,
                'detail_deskripsi'  => $request->detail_deskripsi,
                'ukuran_toleransi'  => $request->ukuran_toleransi,
                'is_best_seller'    => $request->boolean('is_best_seller'),
                'is_active'         => $request->boolean('is_active'),
                'sort_order'        => (Product::max('sort_order') ?? 0) + 1,
            ]);

            /* Cover image */
            if ($request->hasFile('cover_image')) {
                $path = $request->file('cover_image')->store('products', 'public');
                $product->update(['cover_image' => $path]);
            }

            /* Preview images */
            if ($request->hasFile('preview_images')) {
                foreach ($request->file('preview_images') as $i => $file) {
                    ProductImage::create([
                        'product_id' => $product->id,
                        'image_path' => $file->store('products', 'public'),
                        'sort_order' => $i,
                    ]);
                }
            }

            $this->saveRelations($product, $request);

            DB::commit();
            return response()->json(['success' => true, 'message' => 'Produk berhasil ditambahkan.']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => 'Gagal: ' . $e->getMessage()], 500);
        }
    }

    public function edit(Product $product)
    {
        $product->load(['images', 'features', 'priceTiers', 'priceNotes', 'sizeHeader', 'sizeRows', 'colors']);
        return response()->json(['success' => true, 'data' => $product]);
    }

    public function update(Request $request, Product $product)
    {
        $this->validateProduct($request, $product->id);

        if ($request->boolean('is_best_seller') && !$product->is_best_seller) {
            if (Product::where('is_best_seller', true)->where('id', '!=', $product->id)->count() >= 3) {
                return response()->json([
                    'success' => false,
                    'message' => 'Maksimal 3 produk Best Seller.',
                ], 422);
            }
        }

        DB::beginTransaction();
        try {
            $product->update([
                'name'              => $request->name,
                'slug'              => Str::slug($request->name),
                'harga_mulai'       => $request->harga_mulai,
                'spesifikasi'       => $request->spesifikasi,
                'deskripsi_singkat' => $request->deskripsi_singkat,
                'detail_deskripsi'  => $request->detail_deskripsi,
                'ukuran_toleransi'  => $request->ukuran_toleransi,
                'is_best_seller'    => $request->boolean('is_best_seller'),
                'is_active'         => $request->boolean('is_active'),
            ]);

            /* Cover image — hanya update jika ada file baru */
            if ($request->hasFile('cover_image')) {
                if ($product->cover_image) Storage::disk('public')->delete($product->cover_image);
                $product->update(['cover_image' => $request->file('cover_image')->store('products', 'public')]);
            }

            /* Preview images — hapus lama, upload baru jika ada */
            if ($request->hasFile('preview_images')) {
                foreach ($product->images as $img) Storage::disk('public')->delete($img->image_path);
                $product->images()->delete();
                foreach ($request->file('preview_images') as $i => $file) {
                    ProductImage::create([
                        'product_id' => $product->id,
                        'image_path' => $file->store('products', 'public'),
                        'sort_order' => $i,
                    ]);
                }
            }

            /* Hapus relasi lama lalu simpan ulang */
            $product->features()->delete();
            $product->priceTiers()->delete();
            $product->priceNotes()->delete();
            $product->sizeHeader()->delete();
            $product->sizeRows()->delete();
            $product->colors()->delete();

            $this->saveRelations($product, $request);

            DB::commit();
            return response()->json(['success' => true, 'message' => 'Produk berhasil diperbarui.']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => 'Gagal: ' . $e->getMessage()], 500);
        }
    }

    public function destroy(Product $product)
    {
        if ($product->cover_image) Storage::disk('public')->delete($product->cover_image);
        foreach ($product->images as $img) Storage::disk('public')->delete($img->image_path);
        $product->delete();
        return response()->json(['success' => true, 'message' => 'Produk berhasil dihapus.']);
    }

    /* ── Simpan semua relasi produk ── */
    private function saveRelations(Product $product, Request $request): void
    {
        /* Fitur */
        foreach (array_filter((array) $request->input('fitur', [])) as $i => $fitur) {
            ProductFeature::create(['product_id' => $product->id, 'fitur' => $fitur, 'sort_order' => $i]);
        }

        /* Price tiers */
        foreach ((array) $request->input('price_tiers', []) as $i => $tier) {
            if (!empty($tier['kualitas']) && !empty($tier['harga'])) {
                ProductPriceTier::create(['product_id' => $product->id, 'kualitas' => $tier['kualitas'], 'harga' => $tier['harga'], 'sort_order' => $i]);
            }
        }

        /* Price notes */
        foreach (array_filter((array) $request->input('price_notes', [])) as $i => $note) {
            ProductPriceNote::create(['product_id' => $product->id, 'catatan' => $note, 'sort_order' => $i]);
        }

        /* Size headers — selalu prepend 'SIZE' */
        $headers = array_values(array_filter((array) $request->input('size_headers', [])));
        if (!empty($headers)) {
            ProductSizeHeader::create([
                'product_id' => $product->id,
                'headers'    => array_merge(['SIZE'], $headers),
            ]);
        }

        /* Size rows */
        foreach ((array) $request->input('size_rows', []) as $i => $row) {
            if (!empty($row['label'])) {
                $nilai = array_values(array_filter((array) ($row['nilai'] ?? []), fn($v) => $v !== null && $v !== ''));
                ProductSizeRow::create(['product_id' => $product->id, 'label' => $row['label'], 'nilai' => $nilai, 'sort_order' => $i]);
            }
        }

        /* Colors dari checkbox preset */
        foreach ((array) $request->input('colors', []) as $i => $color) {
            if (!empty($color['hex']) && !empty($color['nama'])) {
                ProductColor::create([
                    'product_id' => $product->id,
                    'hex'        => $color['hex'],
                    'nama'       => $color['nama'],
                    'has_border' => !empty($color['has_border']) && $color['has_border'] !== '0',
                    'sort_order' => $i,
                ]);
            }
        }
    }

    private function validateProduct(Request $request, ?int $ignoreId = null): void
    {
        $request->validate([
            'name'                   => ['required', 'string', 'max:150'],
            'harga_mulai'            => ['required', 'string', 'max:50'],
            'spesifikasi'            => ['nullable', 'string', 'max:150'],
            'deskripsi_singkat'      => ['nullable', 'string'],
            'detail_deskripsi'       => ['nullable', 'string'],
            'ukuran_toleransi'       => ['nullable', 'string', 'max:255'],
            'cover_image'            => [$ignoreId ? 'nullable' : 'required', 'image', 'max:2048'],
            'preview_images'         => ['nullable', 'array', 'max:4'],
            'preview_images.*'       => ['image', 'max:2048'],
            'fitur'                  => ['nullable', 'array'],
            'fitur.*'                => ['nullable', 'string', 'max:255'],
            'price_tiers'            => ['nullable', 'array'],
            'price_tiers.*.kualitas' => ['nullable', 'string', 'max:100'],
            'price_tiers.*.harga'    => ['nullable', 'string', 'max:100'],
            'price_notes'            => ['nullable', 'array'],
            'price_notes.*'          => ['nullable', 'string', 'max:255'],
            'size_headers'           => ['nullable', 'array'],
            'size_headers.*'         => ['nullable', 'string', 'max:20'],
            'size_rows'              => ['nullable', 'array'],
            'size_rows.*.label'      => ['nullable', 'string', 'max:10'],
            'size_rows.*.nilai'      => ['nullable', 'array'],
            'colors'                 => ['nullable', 'array'],
            'colors.*.hex'           => ['nullable', 'string', 'max:10'],
            'colors.*.nama'          => ['nullable', 'string', 'max:50'],
        ]);
    }
}
