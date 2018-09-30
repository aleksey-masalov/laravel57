<?php

namespace App\Http\Controllers\Backend\Role;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Role\RoleStoreRequest;
use App\Http\Requests\Backend\Role\RoleUpdateRequest;
use App\Models\Permission;
use App\Repositories\Backend\PermissionRepository;
use App\Repositories\Backend\RoleRepository;
use App\Models\Role;
use Illuminate\Http\Response;

class RoleController extends Controller
{
    /**
     * @var RoleRepository
     */
    protected $roleRepository;

    /**
     * @var PermissionRepository
     */
    protected $permissionRepository;

    /**
     * @param RoleRepository $roleRepository
     * @param PermissionRepository $permissionRepository
     */
    public function __construct(RoleRepository $roleRepository, PermissionRepository $permissionRepository)
    {
        $this->middleware('backend.view');
        $this->middleware('permission:' . Permission::PERMISSION_KEY_ROLE_VIEW)->only(['index', 'show']);
        $this->middleware('permission:' . Permission::PERMISSION_KEY_ROLE_CREATE)->only(['create', 'store']);
        $this->middleware('permission:' . Permission::PERMISSION_KEY_ROLE_UPDATE)->only(['edit', 'update']);
        $this->middleware('permission:' . Permission::PERMISSION_KEY_ROLE_DELETE)->only(['destroy']);

        $this->roleRepository = $roleRepository;
        $this->permissionRepository = $permissionRepository;
    }

    /**
     * @return Response
     */
    public function index()
    {
        return view('backend.roles.index');
    }

    /**
     * @return Response
     */
    public function create()
    {
        return view('backend.roles.create', [
            'permissions' => $this->permissionRepository->getPermissions()
        ]);
    }

    /**
     * @param RoleStoreRequest $request
     * @return Response
     */
    public function store(RoleStoreRequest $request)
    {
        $this->roleRepository->create($request->only(
            'title',
            'description',
            'associatedPermissions'
        ));

        return redirect()->route('backend.roles.index')->withFlashSuccess(trans('alerts.backend.roles.created'));
    }

    /**
     * @param Role $role
     * @return Response
     */
    public function show(Role $role)
    {
        return view('backend.roles.show', ['role' => $role]);
    }

    /**
     * @param Role $role
     * @return Response
     */
    public function edit(Role $role)
    {
        return view('backend.roles.edit', [
            'role' => $role,
            'permissions' => $this->permissionRepository->getPermissions()
        ]);
    }

    /**
     * @param RoleUpdateRequest $request
     * @param Role $role
     * @return Response
     */
    public function update(RoleUpdateRequest $request, Role $role)
    {
        $this->roleRepository->update($request->only(
            'title',
            'description',
            'associatedPermissions'
        ), $role);

        return redirect()->route('backend.roles.index')->withFlashSuccess(trans('alerts.backend.roles.updated'));
    }

    /**
     * @param Role $role
     * @return Response
     */
    public function destroy(Role $role)
    {
        $this->roleRepository->delete($role);

        return redirect()->route('backend.roles.index')->withFlashSuccess(trans('alerts.backend.roles.deleted'));
    }
}
