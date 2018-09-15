<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Closure;

class LocaleMiddleware
{
    /**
     * @param Request $request
     * @param Closure $next
     * @return Closure
     */
    public function handle($request, Closure $next)
    {
        if (config('locale.status')
            && session()->has('locale')
            && in_array(session()->get('locale'), array_keys(config('locale.languages')))
        ) {
            app()->setLocale(session()->get('locale'));

            setlocale(LC_TIME, config('locale.languages')[session()->get('locale')][1]);

            Carbon::setLocale(config('locale.languages')[session()->get('locale')][0]);
        }

        return $next($request);
    }
}
