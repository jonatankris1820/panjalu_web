@extends('admin.layouts.app')

@section('title', 'Kelola Profile')
@section('page-title', 'Kelola Profile')

@section('content')

<section class="bg-var1 rounded-xl border border-var4 overflow-hidden">
    {{-- ====== Header ====== --}}
    <div class="p-5 border-b border-var4">
        <h2 class="text-xl font-semibold">Informasi Akun</h2>
        <p class="text-var8">Ubah nama, email, atau password akun Anda.</p>
    </div>

    {{-- ====== Avatar ====== --}}
    <div class="p-5 flex items-center gap-3">
        <div class="w-16 h-16 rounded-full bg-var10 text-var1 flex items-center justify-center text-2xl font-semibold shrink-0">
            {{ $user->initials }}
        </div>
        <div>
            <p class="font-semibold text-xl mb-1.5">{{ $user->name }}</p>
            <span class="{{ $user->isSuperAdmin() ? 'badge-role-super' : 'badge-role-admin' }} px-4 py-1">
                {{ $user->isSuperAdmin() ? 'Super Admin' : 'Admin' }}
            </span>
        </div>
    </div>

    {{-- ====== Form ====== --}}
    <form method="POST" action="{{ route('admin.profile.update') }}" class="px-5 pb-5 pt-2 text-[15px]">
        @csrf
        {{-- Nama --}}
        <div class="grid grid-cols-2 gap-5">
            <div>
                <label for="name" class="admin-label">Nama <span class="text-var10">*</span></label>
                <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" class="admin-input @error('name') admin-input-error @enderror" placeholder="Nama lengkap" autocomplete="name">
                @error('name')
                    <p class="admin-error-text">{{ $message }}</p>
                @enderror
            </div>
    
            {{-- Email --}}
            <div>
                <label for="email" class="admin-label">Email <span class="text-var10">*</span></label>
                <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" class="admin-input @error('email') admin-input-error @enderror" placeholder="email@kaosintim.id" autocomplete="email">
                @error('email')
                    <p class="admin-error-text">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <hr class="border-var4 my-7">

        <div class="grid grid-cols-2 gap-5">
            {{-- Password Baru --}}
            <div>
                <label for="password" class="admin-label">Password Baru <span class="text-var7 font-normal text-[13px]">(kosongkan jika tidak ingin mengubah)</span></label>
                <div class="relative">
                    <input type="password" id="password" name="password" class="admin-input pr-11 @error('password') admin-input-error @enderror" placeholder="Minimal 6 karakter" autocomplete="new-password">
                    <button type="button" id="togglePassword" class="absolute right-3.5 top-1/2 -translate-y-1/2 text-var7 hover:text-var9 cursor-pointer" aria-label="Tampilkan password">
                        <svg id="eye-show" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.75"><path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/></svg>
                        <svg id="eye-hide" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.75"><path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88"/></svg>
                    </button>
                </div>
                @error('password')
                    <p class="admin-error-text">{{ $message }}</p>
                @enderror
            </div>
    
            {{-- Konfirmasi Password --}}
            <div>
                <label for="password_confirmation" class="admin-label">Konfirmasi Password Baru</label>
                <input type="password" id="password_confirmation" name="password_confirmation" class="admin-input" placeholder="Ulangi password baru" autocomplete="new-password">
            </div>
        </div>

        {{-- Submit --}}
        <div class="grid grid-cols-1 mt-7">
            <button type="submit" class="inline-flex items-center justify-center gap-2 px-4 py-3 bg-var10 hover:bg-var11 text-var1 font-semibold rounded-lg transition-colors duration-200 cursor-pointer">
                <i data-lucide="save" class="w-5 h-5"></i>
                Simpan Perubahan
            </button>
        </div>
    </form>
</section>

@endsection

@push('scripts')
<script>
    const toggleBtn = document.getElementById('togglePassword');
    const pwInput   = document.getElementById('password');
    const eyeShow   = document.getElementById('eye-show');
    const eyeHide   = document.getElementById('eye-hide');

    toggleBtn?.addEventListener('click', () => {
        const isHidden   = pwInput.type === 'password';
        pwInput.type     = isHidden ? 'text' : 'password';
        eyeShow.classList.toggle('hidden',  isHidden);
        eyeHide.classList.toggle('hidden', !isHidden);
    });
</script>
@endpush