<?php

namespace App\Http\Controllers\Backend\Ajax;

use App\Http\Controllers\Controller;
use App\Repositories\Backend\PermissionRepository;
use Yajra\DataTables\Facades\DataTables;

class AjaxPermissionController extends Controller
{
    /**
     * @var PermissionRepository
     */
    protected $permissionRepository;

    /**
     * @param PermissionRepository $permissionRepository
     */
    public function __construct(PermissionRepository $permissionRepository)
    {
        $this->permissionRepository = $permissionRepository;
    }

    /**
     * @return mixed
     */
    public function get()
    {
        return DataTables::of($this->permissionRepository->getPermissionsData())
            ->escapeColumns(['title'])
            ->addColumn('actions', function ($permission) {
                return $permission->actionButtons;
            })
            ->make(true);

    }
}
