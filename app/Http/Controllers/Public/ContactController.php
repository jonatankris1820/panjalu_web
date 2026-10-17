<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use App\Mail\ContactMail;

class ContactController extends Controller
{
    public function index()
    {
        return view('public.pages.contact');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama'      => ['required', 'string', 'max:100'],
            'whatsapp'  => ['required', 'string', 'max:20'],
            'email'     => ['required', 'email', 'max:100'],
            'keperluan' => ['required', 'string', 'in:pemasaran,penawaran,kerjasama,lainnya'],
            'pesan'     => ['required', 'string', 'min:10', 'max:2000'],
        ], [
            'nama.required'      => 'Nama lengkap wajib diisi.',
            'whatsapp.required'  => 'Nomor WhatsApp wajib diisi.',
            'email.required'     => 'Email wajib diisi.',
            'email.email'        => 'Format email tidak valid.',
            'keperluan.required' => 'Silakan pilih keperluan.',
            'keperluan.in'       => 'Keperluan tidak valid.',
            'pesan.required'     => 'Pesan wajib diisi.',
            'pesan.min'          => 'Pesan minimal 10 karakter.',
        ]);

        try {
            Log::info('Mencoba mengirim email ke: ' . config('mail.from.address'));

            Mail::to(config('mail.from.address'))->send(new ContactMail($validated));

            Log::info('Email berhasil dikirim');

            // Return JSON dengan header yang benar
            return response()->json([
                'success' => true,
                'message' => 'Pesan Anda berhasil dikirim! Kami akan menghubungi Anda secepatnya.'
            ])->header('Content-Type', 'application/json');
        } catch (\Exception $e) {
            Log::error('Gagal mengirim email: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Gagal mengirim pesan. Error: ' . $e->getMessage()
            ], 500)->header('Content-Type', 'application/json');
        }
    }
}
