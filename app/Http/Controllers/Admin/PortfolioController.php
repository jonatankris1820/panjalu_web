<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Portfolio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PortfolioController extends Controller
{
    public function index()
    {
        $portfolios = Portfolio::orderBy('sort_order')->orderByDesc('created_at')->get();
        return view('admin.portfolios.index', compact('portfolios'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kategori'    => ['required', 'in:Corporate,UMKM,Event'],
            'image'       => ['required', 'image', 'max:2048'],
        ], [
            'kategori.required' => 'Kategori wajib dipilih.',
            'image.required'    => 'Gambar wajib diupload.',
            'image.image'       => 'File harus berupa gambar.',
            'image.max'         => 'Ukuran gambar maksimal 2MB.',
        ]);

        $file = $request->file('image');
        $path = $file->store('portfolios', 'public');
        $alt  = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);

        Portfolio::create([
            'image_path' => $path,
            'alt'        => $alt,
            'kategori'   => $request->kategori,
            'sort_order' => (Portfolio::max('sort_order') ?? 0) + 1,
        ]);

        return response()->json(['success' => true, 'message' => 'Portofolio berhasil ditambahkan.']);
    }

    public function edit(Portfolio $portfolio)
    {
        return response()->json(['success' => true, 'data' => $portfolio]);
    }

    public function update(Request $request, Portfolio $portfolio)
    {
        $request->validate([
            'kategori' => ['required', 'in:Corporate,UMKM,Event'],
            'image'    => ['nullable', 'image', 'max:2048'],
        ]);

        $data = ['kategori' => $request->kategori];

        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($portfolio->image_path);
            $file        = $request->file('image');
            $data['image_path'] = $file->store('portfolios', 'public');
            $data['alt']        = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        }

        $portfolio->update($data);

        return response()->json(['success' => true, 'message' => 'Portofolio berhasil diperbarui.']);
    }

    public function destroy(Portfolio $portfolio)
    {
        Storage::disk('public')->delete($portfolio->image_path);
        $portfolio->delete();
        return response()->json(['success' => true, 'message' => 'Portofolio berhasil dihapus.']);
    }
}