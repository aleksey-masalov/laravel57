<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Notifications\ConfirmAccountNotification;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    use RegistersUsers;

    /**
     * RegisterController constructor.
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        $user = $this->create($request->all());

        return $this->registered($request, $user);
    }

    /**
     * @param Request $request
     * @param User $user
     * @return Response
     */
    protected function registered(Request $request, $user)
    {
        if (config('auth.confirm_account_enabled')) {
            $user->generateConfirmationToken($user);
            $user->notify(new ConfirmAccountNotification($user));

            return redirect($this->redirectTo())->withFlashSuccess(trans('alerts.auth.confirmation.sent'));
        }

        $this->guard()->login($user);

        return redirect($this->redirectTo());
    }

    /**
     * @param array $data
     * @return Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * @param array $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password'])
        ]);
    }

    /**
     * @return string
     */
    protected function redirectTo()
    {
        return homeRoute();
    }
}
