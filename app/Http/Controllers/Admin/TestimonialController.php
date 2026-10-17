<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TestimonialController extends Controller
{
    public function index()
    {
        $testimonials = Testimonial::orderBy('sort_order')->orderByDesc('created_at')->get();
        return view('admin.testimonials.index', compact('testimonials'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama'       => ['required', 'string', 'max:100'],
            'perusahaan' => ['nullable', 'string', 'max:100'],
            'rating'     => ['required', 'integer', 'min:1', 'max:5'],
            'pesan'      => ['required', 'string'],
            'foto'       => ['nullable', 'image', 'max:1024'],
        ], [
            'nama.required'   => 'Nama klien wajib diisi.',
            'rating.required' => 'Rating wajib dipilih.',
            'pesan.required'  => 'Deskripsi testimoni wajib diisi.',
        ]);

        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('testimonials', 'public');
        }

        Testimonial::create([
            'nama'       => $request->nama,
            'perusahaan' => $request->perusahaan,
            'rating'     => $request->rating,
            'pesan'      => $request->pesan,
            'foto_path'  => $fotoPath,
            'is_active'  => $request->boolean('is_active', true),
            'sort_order' => (Testimonial::max('sort_order') ?? 0) + 1,
        ]);

        return response()->json(['success' => true, 'message' => 'Testimoni berhasil ditambahkan.']);
    }

    public function edit(Testimonial $testimonial)
    {
        return response()->json(['success' => true, 'data' => $testimonial]);
    }

    public function update(Request $request, Testimonial $testimonial)
    {
        $request->validate([
            'nama'       => ['required', 'string', 'max:100'],
            'perusahaan' => ['nullable', 'string', 'max:100'],
            'rating'     => ['required', 'integer', 'min:1', 'max:5'],
            'pesan'      => ['required', 'string'],
            'foto'       => ['nullable', 'image', 'max:1024'],
        ]);

        $data = [
            'nama'       => $request->nama,
            'perusahaan' => $request->perusahaan,
            'rating'     => $request->rating,
            'pesan'      => $request->pesan,
            'is_active'  => $request->boolean('is_active', true),
        ];

        if ($request->hasFile('foto')) {
            if ($testimonial->foto_path) Storage::disk('public')->delete($testimonial->foto_path);
            $data['foto_path'] = $request->file('foto')->store('testimonials', 'public');
        }

        /* Hapus foto jika centang hapus foto */
        if ($request->boolean('hapus_foto') && $testimonial->foto_path) {
            Storage::disk('public')->delete($testimonial->foto_path);
            $data['foto_path'] = null;
        }

        $testimonial->update($data);

        return response()->json(['success' => true, 'message' => 'Testimoni berhasil diperbarui.']);
    }

    public function destroy(Testimonial $testimonial)
    {
        if ($testimonial->foto_path) Storage::disk('public')->delete($testimonial->foto_path);
        $testimonial->delete();
        return response()->json(['success' => true, 'message' => 'Testimoni berhasil dihapus.']);
    }
}
