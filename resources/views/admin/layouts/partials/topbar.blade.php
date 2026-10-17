<header class="h-16 bg-var1 border-b border-var4 flex items-center justify-between px-6 shrink-0 sticky top-0 z-10">
    {{-- Page Title --}}
    <h1 class="text-xl font-semibold">@yield('page-title', 'Dashboard')</h1>

    {{-- Right: User Dropdown --}}
    <div class="relative" id="user-dropdown-wrapper">
        <button id="user-dropdown-btn" type="button" class="flex items-center gap-2 px-3 py-2 rounded-lg hover:bg-var3 transition-colors duration-200 cursor-pointer" aria-haspopup="true" aria-expanded="false">
            {{-- Avatar Inisial --}}
            <div class="w-9.5 h-9.5 rounded-full bg-var10 text-var1 flex items-center justify-center text-sm font-semibold shrink-0">
                {{ Auth::user()->initials }}
            </div>
            <div class="text-left">
                <p class="text-[15px] font-semibold leading-tight">{{ Auth::user()->name }}</p>
                <p class="text-[13px] text-var7 leading-tight">{{ Auth::user()->isSuperAdmin() ? 'Super Admin' : 'Admin' }}</p>
            </div>
            <i data-lucide="chevron-down" id="user-chevron" class="w-4.5 h-4.5 transition-transform duration-200 shrink-0"></i>
        </button>

        {{-- Dropdown Menu --}}
        <div id="user-dropdown-menu" class="absolute right-0 top-full mt-1 w-48 bg-var1 border border-var4 rounded-lg shadow-lg py-0.5 hidden z-50">
            @if (Auth::user()->isAdmin())
                <a href="{{ \Illuminate\Support\Facades\Route::has('admin.profile.edit') ? route('admin.profile.edit') : '#' }}" class="flex items-center gap-2.5 px-4 py-2.5 text-sm hover:bg-var3 transition-colors duration-200">
                    <i data-lucide="user" class="w-4 h-4"></i>
                    Kelola Profile
                </a>
                <hr class="border-var4 my-0.5">
            @endif

            <form method="POST" action="{{ route('admin.logout') }}">
                @csrf
                <button type="submit" class="w-full flex items-center gap-2.5 px-4 py-2.5 text-sm text-var10 hover:bg-red-50 transition-colors duration-200 cursor-pointer">
                    <i data-lucide="log-out" class="w-4 h-4"></i>
                    Logout
                </button>
            </form>
        </div>
    </div>
</header>