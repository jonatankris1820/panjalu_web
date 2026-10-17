<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | PT Kaosintim UMKM Indonesia</title>
    
    {{-- =========== Favicon =========== --}}
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="icon" type="image/svg+xml" href="{{ asset('images/favicon/favicon.svg') }}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('images/favicon/favicon-96x96.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('images/favicon/apple-touch-icon.png') }}">
    <link rel="manifest" href="{{ asset('images/favicon/site.webmanifest') }}">

    @vite(['resources/css/app.css'])
</head>

<body class="bg-var3 h-screen flex items-center justify-center p-4">
    <div class="w-full max-w-md">
        {{-- Card --}}
        <div class="bg-var1 rounded-2xl shadow-sm p-8">
            <img src="{{ asset('images/logo-kaosintim-light.svg') }}" alt="Logo Kaosintim" class="h-7 mx-auto mb-8">
            <h1 class="text-2xl font-semibold mb-0.5">Selamat Datang</h1>
            <p>Masuk ke panel admin Kaosintim.</p>

            <form method="POST" action="{{ route('admin.login') }}" class="space-y-4.5 mt-5">
                @csrf
                {{-- Email --}}
                <div>
                    <label for="email" class="block font-semibold mb-1.5">Email <span class="text-var10">*</span></label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="Masukkan email Anda disini" autocomplete="email" class="w-full border border-var5 rounded-xl px-4 py-3 bg-var1 focus:outline-none focus:border-var10 transition-colors duration-300 @error('email') @enderror" required>
                </div>

                {{-- Password --}}
                <div>
                    <label for="password" class="block font-semibold mb-1.5">Password <span class="text-var10">*</span></label>
                    <div class="relative">
                        <input type="password" id="password" name="password" placeholder="Masukkan password Anda disini" autocomplete="current-password" class="w-full border border-var5 rounded-xl px-4 py-3 pr-12 bg-var1 focus:outline-none focus:border-var10 transition-colors duration-300" required>
                        {{-- Toggle show/hide password --}}
                        <button type="button" id="togglePassword" class="absolute right-4 top-1/2 -translate-y-1/2 text-var7 hover:text-var9 transition-colors cursor-pointer" aria-label="Tampilkan atau sembunyikan password">
                            <svg id="eyeIcon" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.75"><path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/></svg>
                            <svg id="eyeOffIcon" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.75"><path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88"/></svg>
                        </button>
                    </div>
                </div>

                {{-- Error Global --}}
                @if ($errors->any())
                    <div class="bg-red-50 border border-red-200 text-red-700 rounded-xl px-4 py-3 mb-5 text-sm">
                        {{ $errors->first() }}
                    </div>
                @endif
                
                {{-- Remember Me --}}
                <label class="flex items-center gap-2.5 cursor-pointer select-none w-fit">
                    <input type="checkbox" name="remember" id="remember" class="w-4 h-4 accent-var10 cursor-pointer" {{ old('remember') ? 'checked' : '' }}>
                    <span>Ingat saya</span>
                </label>

                {{-- Submit --}}
                <button type="submit" class="w-full py-3 bg-var10 hover:bg-var11 text-base text-var1 font-semibold rounded-xl transition-colors duration-300 cursor-pointer mt-2">Masuk</button>
            </form>
        </div>

        <p class="text-center text-var8 text-sm mt-6">&copy;2026 PT Kaosintim UMKM Indonesia. All Rights Reserved.</p>
    </div>

    <script>
        const toggle   = document.getElementById('togglePassword');
        const input    = document.getElementById('password');
        const eyeOn    = document.getElementById('eyeIcon');
        const eyeOff   = document.getElementById('eyeOffIcon');

        toggle.addEventListener('click', () => {
            const isHidden = input.type === 'password';
            input.type     = isHidden ? 'text' : 'password';
            eyeOn.classList.toggle('hidden',  isHidden);
            eyeOff.classList.toggle('hidden', !isHidden);
        });
    </script>
</body>

</html>