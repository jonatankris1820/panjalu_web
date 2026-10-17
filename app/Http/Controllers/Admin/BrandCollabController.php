<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BrandCollab;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BrandCollabController extends Controller
{
    public function index()
    {
        $brands = BrandCollab::orderBy('sort_order')->orderByDesc('created_at')->get();
        return view('admin.brands.index', compact('brands'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'images'   => ['required', 'array', 'min:1'],
            'images.*' => ['required', 'file', 'mimes:svg,png', 'max:150'],
        ], [
            'images.required'  => 'Minimal upload 1 logo.',
            'images.*.mimes'   => 'File harus berformat SVG atau PNG.',
            'images.*.max'     => 'Ukuran file maksimal 150KB.',
        ]);

        $count = 0;
        foreach ($request->file('images') as $file) {
            $path = $file->store('brands', 'public');
            $alt  = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);

            BrandCollab::create([
                'image_path' => $path,
                'alt'        => $alt,
                'sort_order' => (BrandCollab::max('sort_order') ?? 0) + 1,
            ]);
            $count++;
        }

        return response()->json(['success' => true, 'message' => "{$count} logo brand berhasil ditambahkan."]);
    }

    public function edit(BrandCollab $brand)
    {
        return response()->json(['success' => true, 'data' => $brand]);
    }

    public function update(Request $request, BrandCollab $brand)
    {
        $request->validate([
            'alt'   => ['nullable', 'string', 'max:255'],
            'image' => ['nullable', 'file', 'mimes:svg,png', 'max:150'],
        ], [
            'image.mimes' => 'File harus berformat SVG atau PNG.',
            'image.max'   => 'Ukuran file maksimal 150KB.',
        ]);

        $data = ['alt' => $request->alt ?? $brand->alt];

        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($brand->image_path);
            $file              = $request->file('image');
            $data['image_path'] = $file->store('brands', 'public');
            $data['alt']        = $request->alt ?? pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        }

        $brand->update($data);

        return response()->json(['success' => true, 'message' => 'Brand berhasil diperbarui.']);
    }

    public function destroy(BrandCollab $brand)
    {
        Storage::disk('public')->delete($brand->image_path);
        $brand->delete();
        return response()->json(['success' => true, 'message' => 'Brand berhasil dihapus.']);
    }
}
