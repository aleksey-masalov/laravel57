<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Foundation\Auth\ResetsPasswords;

class ResetPasswordController extends Controller
{
    use ResetsPasswords;

    /**
     * ResetPasswordController constructor.
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * @param string $response
     * @return Response
     */
    protected function sendResetResponse($response)
    {
        if (config('auth.confirm_account_enabled') && !$this->guard()->user()->hasConfirmedAccount()) {
            $this->guard()->logout();

            return redirect(route('login'))->withFlashWarning(trans('alerts.auth.password.changed'));
        }

        return redirect($this->redirectTo())->withFlashSuccess(trans($response));
    }

    /**
     * @return string
     */
    protected function redirectTo()
    {
        return homeRoute();
    }
}
