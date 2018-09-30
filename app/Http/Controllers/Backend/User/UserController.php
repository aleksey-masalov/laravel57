<?php

namespace App\Http\Controllers\Backend\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\User\UserStoreRequest;
use App\Http\Requests\Backend\User\UserUpdateRequest;
use App\Repositories\Backend\UserRepository;
use App\Repositories\Backend\RoleRepository;
use App\Models\User;
use App\Models\Permission;
use Illuminate\Http\Response;

class UserController extends Controller
{
    /**
     * @var UserRepository
     */
    protected $userRepository;

    /**
     * @var RoleRepository
     */
    protected $roleRepository;

    /**
     * @param UserRepository $userRepository
     * @param RoleRepository $roleRepository
     */
    public function __construct(UserRepository $userRepository, RoleRepository $roleRepository)
    {
        $this->middleware('backend.view');
        $this->middleware('permission:' . Permission::PERMISSION_KEY_USER_VIEW)->only(['index', 'deactivated', 'deleted', 'show']);
        $this->middleware('permission:' . Permission::PERMISSION_KEY_USER_CREATE)->only(['create', 'store']);
        $this->middleware('permission:' . Permission::PERMISSION_KEY_USER_UPDATE)->only(['edit', 'update', 'status']);
        $this->middleware('permission:' . Permission::PERMISSION_KEY_USER_DELETE)->only(['destroy']);

        $this->userRepository = $userRepository;
        $this->roleRepository = $roleRepository;
    }

    /**
     * @return Response
     */
    public function index()
    {
        return view('backend.users.index');
    }

    /**
     * @return Response
     */
    public function deactivated()
    {
        return view('backend.users.deactivated');
    }

    /**
     * @return Response
     */
    public function deleted()
    {
        return view('backend.users.deleted');
    }

    /**
     * @return Response
     */
    public function create()
    {
        return view('backend.users.create', [
            'roles' => $this->roleRepository->getRolesExceptSuperAdmin()
        ]);
    }

    /**
     * @param UserStoreRequest $request
     * @return Response
     */
    public function store(UserStoreRequest $request)
    {
        $this->userRepository->create($request->only(
            'name',
            'email',
            'password',
            'isActive',
            'isConfirmed',
            'associatedRole'
        ));

        return redirect()->route('backend.users.index')->withFlashSuccess(trans('alerts.backend.users.created'));
    }

    /**
     * @param User $user
     * @return Response
     */
    public function show(User $user)
    {
        return view('backend.users.show', [
            'user' => $user
        ]);
    }

    /**
     * @param User $user
     * @return Response
     */
    public function edit(User $user)
    {
        return view('backend.users.edit', [
            'user' => $user,
            'roles' => $this->roleRepository->getRolesExceptSuperAdmin(),
        ]);
    }

    /**
     * @param UserUpdateRequest $request
     * @param User $user
     * @return Response
     */
    public function update(UserUpdateRequest $request, User $user)
    {
        $this->userRepository->update($request->only(
            'name',
            'email',
            'isActive',
            'isConfirmed',
            'associatedRole'
        ), $user);

        switch(true){
            case $user->trashed():
                $redirectRoute = 'backend.users.deleted';
                break;
            case !$user->hasActiveAccount():
                $redirectRoute = 'backend.users.deactivated';
                break;
            default:
                $redirectRoute = 'backend.users.index';
        }

        return redirect()->route($redirectRoute)->withFlashSuccess(trans('alerts.backend.users.updated'));
    }

    /**
     * @param User $user
     * @return Response
     */
    public function destroy(User $user)
    {
        $this->userRepository->delete($user);

        return redirect()->route('backend.users.deleted')->withFlashSuccess(trans('alerts.backend.users.deleted'));
    }

    /**
     * @param User $user
     * @param string $status
     * @return Response
     */
    public function status(User $user, $status)
    {
        $this->userRepository->status($user, $status);

        return redirect()->route($status == 1 ? 'backend.users.index' : 'backend.users.deactivated')->withFlashSuccess(trans('alerts.backend.users.updated'));
    }
}
