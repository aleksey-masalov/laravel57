<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Notifications\ConfirmAccountNotification;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class ConfirmAccountController extends Controller
{
    /**
     * ConfirmAccountController constructor.
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function resend(Request $request)
    {
        $user = $request->user();

        if (!$user) {
            return redirect(homeRoute())->withFlashDanger(trans('alerts.auth.confirmation.not_exist'));
        }

        if ($user->hasConfirmedAccount()) {
            return redirect(homeRoute())->withFlashWarning(trans('alerts.auth.confirmation.already_confirmed'));
        }

        $this->sendConfirmAccountNotification($user);

        return redirect(homeRoute())->withFlashSuccess(trans('alerts.auth.confirmation.resent'));
    }

    /**
     * @param Request $request
     * @param string $token
     * @return RedirectResponse
     */
    public function confirm(Request $request, $token)
    {
        $user = $request->user();

        if (!$user) {
            return redirect(homeRoute())->withFlashDanger(trans('alerts.auth.confirmation.not_exist'));
        }

        if ($user->hasConfirmedAccount()) {
            return redirect(homeRoute())->withFlashWarning(trans('alerts.auth.confirmation.already_confirmed'));
        }

        if (!$this->markAccountAsConfirmed($user, $token)) {
            return redirect(homeRoute())->withFlashDanger(trans('alerts.auth.confirmation.mismatch'));
        }

        return redirect(route('login'))->withFlashSuccess(trans('alerts.auth.confirmation.confirmed'));
    }

    /**
     * @param User $user
     * @param string $token
     * @return boolean
     */
    private function markAccountAsConfirmed(User $user, $token)
    {
        if($user->confirmation_token !== $token){
            return false;
        }

        if(!$user->confirmAccount()){
            return false;
        }

        return true;
    }

    /**
     * @param User $user
     * @return void
     */
    private function sendConfirmAccountNotification(User $user)
    {
        $user->generateConfirmationToken();
        $user->notify(new ConfirmAccountNotification($user));
    }
}