<?php

namespace App\Http\Controllers\Backend\User;

use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Repositories\Backend\UserRepository;
use App\Models\Permission;

class UserDeletedController extends Controller
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
        $this->middleware('permission:' . Permission::PERMISSION_KEY_USER_DELETE)->only(['delete', 'restore']);

        $this->userRepository = $userRepository;
    }

    /**
     * @param int $deleted
     * @return Response
     */
    public function delete($deleted)
    {
        $this->userRepository->forceDelete($deleted);

        return redirect()->route('backend.users.deleted')->withFlashSuccess(trans('alerts.backend.users.deleted_permanently'));
    }

    /**
     * @param int $deleted
     * @return Response
     */
    public function restore($deleted)
    {
        $this->userRepository->restore($deleted);

        return redirect()->route('backend.users.index')->withFlashSuccess(trans('alerts.backend.users.restored'));
    }
}
