<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, string ...$roles): mixed
    {
        if (! Auth::check()) {
            return redirect()->route('admin.login');
        }

        /** @var \App\Models\User $user */
        $user = Auth::user();

        if (! in_array($user->role, $roles)) {
            if ($user->isSuperAdmin()) {
                return redirect()->route('admin.super.dashboard');
            }
            return redirect()->route('admin.dashboard');
        }

        return $next($request);
    }
}
