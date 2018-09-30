<?php

namespace App\Http\Middleware;

use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Closure;

class BackendViewMiddleware
{
    /**
     * @param Request $request
     * @param Closure $next
     * @return Closure
     */
    public function handle($request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect($this->redirectTo());
        }

        if (!Auth::user()->hasPermission(Permission::PERMISSION_KEY_BACKEND_VIEW)) {
            return redirect($this->redirectTo());
        }

        return $next($request);
    }

    /**
     * @return string
     */
    private function redirectTo()
    {
        return route('frontend.index');
    }
}