<?php

namespace App\Http\Controllers\Backend\Permission;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Repositories\Backend\PermissionRepository;
use App\Http\Requests\Backend\Permission\PermissionUpdateRequest;
use Illuminate\Http\Response;

class PermissionController extends Controller
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
        $this->middleware('backend.view');
        $this->middleware('permission:' . Permission::PERMISSION_KEY_PERMISSION_VIEW)->only(['index', 'show']);
        $this->middleware('permission:' . Permission::PERMISSION_KEY_PERMISSION_UPDATE)->only(['edit', 'update']);

        $this->permissionRepository = $permissionRepository;
    }

    /**
     * @return Response
     */
    public function index()
    {
        return view('backend.permissions.index');
    }

    /**
     * @param Permission $permission
     * @return Response
     */
    public function show(Permission $permission)
    {
        return view('backend.permissions.show', ['permission' => $permission]);
    }

    /**
     * @param Permission $permission
     * @return Response
     */
    public function edit(Permission $permission)
    {
        return view('backend.permissions.edit', ['permission' => $permission]);
    }

    /**
     * @param PermissionUpdateRequest $request
     * @param Permission $permission
     * @return Response
     */
    public function update(PermissionUpdateRequest $request, Permission $permission)
    {
        $this->permissionRepository->update($request->only(
            'title',
            'description'
        ), $permission);

        return redirect()->route('backend.permissions.index')->withFlashSuccess(trans('alerts.backend.permissions.updated'));
    }
}
