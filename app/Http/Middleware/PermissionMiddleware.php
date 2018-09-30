<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Closure;

class PermissionMiddleware
{
    /**
     * @param Request $request
     * @param Closure $next
     * @param string $permission
     * @return Closure
     */
    public function handle($request, Closure $next, $permission)
    {
        if (!Auth::check()) {
            return redirect($this->redirectTo());
        }

        if (!Auth::user()->hasPermission($permission)) {
            return redirect($this->redirectTo());
        }

        return $next($request);
    }

    /**
     * @return string
     */
    private function redirectTo()
    {
        return route('backend.dashboard');
    }
}