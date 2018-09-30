<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * @param Request $request
     * @param Closure $next
     * @param string $role
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        if (!Auth::check()) {
            return redirect($this->redirectTo());
        }

        if (!Auth::user()->hasRole($role)) {
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
