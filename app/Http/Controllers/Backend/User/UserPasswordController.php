<?php

namespace App\Http\Controllers\Backend\User;

use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\User\UserPasswordUpdateRequest;
use App\Repositories\Backend\UserRepository;
use App\Models\User;
use App\Models\Permission;

class UserPasswordController extends Controller
{
    /**
     * @var UserRepository
     */
    protected $userRepository;

    /**
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->middleware('backend.view');
        $this->middleware('permission:' . Permission::PERMISSION_KEY_USER_UPDATE)->only(['change', 'update']);

        $this->userRepository = $userRepository;
    }

    /**
     * @param User $user
     * @return Response
     */
    public function change(User $user)
    {
        return view('backend.users.password-change', ['user' => $user]);
    }

    /**
     * @param User $user
     * @param UserPasswordUpdateRequest $request
     *
     * @return Response
     */
    public function update(UserPasswordUpdateRequest $request, User $user)
    {
        $this->userRepository->updatePassword($user, $request->only('password'));

        return redirect()->route('backend.users.index')->withFlashSuccess(trans('alerts.backend.users.password_updated'));
    }
}
