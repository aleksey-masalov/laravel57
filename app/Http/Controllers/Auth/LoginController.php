<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * LoginController constructor.
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    /**
     * @param Request $request
     * @param User $user
     * @return Response
     */
    protected function authenticated(Request $request, $user)
    {
        if (config('auth.confirm_account_enabled') && !$user->hasConfirmedAccount()) {
            $this->guard()->logout();

            return redirect($this->redirectTo())->withFlashWarning(trans('alerts.auth.confirmation.resend', ['email' => $user->email]));
        }

        return redirect($this->redirectTo());
    }

    /**
     * @return string
     */
    protected function redirectTo()
    {
        return homeRoute();
    }
}
