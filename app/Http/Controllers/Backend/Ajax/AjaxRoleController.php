<?php

namespace App\Http\Controllers\Backend\Ajax;

use App\Http\Controllers\Controller;
use App\Repositories\Backend\RoleRepository;
use Yajra\DataTables\Facades\DataTables;

class AjaxRoleController extends Controller
{
    /**
     * @var RoleRepository
     */
    protected $roleRepository;

    /**
     * @param RoleRepository $roleRepository
     */
    public function __construct(RoleRepository $roleRepository)
    {
        $this->roleRepository = $roleRepository;
    }

    /**
     * @return mixed
     */
    public function get()
    {
        return DataTables::of($this->roleRepository->getRolesData())
            ->escapeColumns(['title'])
            ->editColumn('permissions', function ($role) {
                return $role->permissionsLabel;
            })
            ->addColumn('actions', function ($role) {
                return $role->actionButtons;
            })
            ->make(true);
    }
}
