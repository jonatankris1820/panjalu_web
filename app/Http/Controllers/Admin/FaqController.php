<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function index()
    {
        $faqs = Faq::orderBy('sort_order')->orderByDesc('created_at')->get();
        return view('admin.faqs.index', compact('faqs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'pertanyaan' => ['required', 'string'],
            'jawaban'    => ['required', 'string'],
        ], [
            'pertanyaan.required' => 'Pertanyaan wajib diisi.',
            'jawaban.required'    => 'Jawaban wajib diisi.',
        ]);

        Faq::create([
            'pertanyaan' => $request->pertanyaan,
            'jawaban'    => $request->jawaban,
            'is_active'  => $request->boolean('is_active', true),
            'sort_order' => (Faq::max('sort_order') ?? 0) + 1,
        ]);

        return response()->json(['success' => true, 'message' => 'FAQ berhasil ditambahkan.']);
    }

    public function edit(Faq $faq)
    {
        return response()->json(['success' => true, 'data' => $faq]);
    }

    public function update(Request $request, Faq $faq)
    {
        $request->validate([
            'pertanyaan' => ['required', 'string'],
            'jawaban'    => ['required', 'string'],
        ]);

        $faq->update([
            'pertanyaan' => $request->pertanyaan,
            'jawaban'    => $request->jawaban,
            'is_active'  => $request->boolean('is_active', true),
        ]);

        return response()->json(['success' => true, 'message' => 'FAQ berhasil diperbarui.']);
    }

    public function destroy(Faq $faq)
    {
        $faq->delete();
        return response()->json(['success' => true, 'message' => 'FAQ berhasil dihapus.']);
    }
}
