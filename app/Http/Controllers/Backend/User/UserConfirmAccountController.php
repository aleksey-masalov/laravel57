<?php

namespace App\Http\Controllers\Backend\User;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Notifications\ConfirmAccountNotification;
use App\Models\User;
use Illuminate\Http\RedirectResponse;

class UserConfirmAccountController extends Controller
{
    /**
     * UserConfirmAccountController constructor.
     */
    public function __construct()
    {
        $this->middleware('backend.view');
        $this->middleware('permission:' . Permission::PERMISSION_KEY_USER_UPDATE)->only(['resend']);
    }

    /**
     * @param User $user
     * @return RedirectResponse
     */
    public function resend(User $user)
    {
        if ($user->hasConfirmedAccount()) {
            return back()->withFlashWarning(trans('alerts.backend.confirmation.already_confirmed'));
        }

        $user->generateConfirmationToken();
        $user->notify(new ConfirmAccountNotification($user));

        return back()->withFlashSuccess(trans('alerts.backend.confirmation.resent'));
    }
}
