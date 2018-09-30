<?php

namespace App\Http\Controllers\Backend\Ajax;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Backend\UserRepository;
use Yajra\DataTables\Facades\DataTables;

class AjaxUserController extends Controller
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
        $this->userRepository = $userRepository;
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function get(Request $request)
    {
        $isActive = $request->get('isActive');
        $isActive = $isActive === 'true';

        $isTrashed = $request->get('isTrashed');
        $isTrashed = $isTrashed === 'true';

        return DataTables::of($this->userRepository->getUsersData($isActive, $isTrashed))
            ->escapeColumns(['name', 'email'])
            ->editColumn('confirmed', function ($user) {
                return $user->isConfirmedLabel;
            })
            ->editColumn('roles', function ($user) {
                return $user->rolesLabel;
            })
            ->addColumn('actions', function ($user) {
                return $user->actionButtons;
            })
            ->make(true);
    }
}
