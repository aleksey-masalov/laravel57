<?php

namespace App\Repositories\Backend;

use App\Repositories\BaseRepository;
use App\Models\Role;
use App\Exceptions\GeneralException;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Validation\ValidationException;

class RoleRepository extends BaseRepository
{
    const MODEL = Role::class;

    /**
     * @param array $data
     * @return Role
     * @throws GeneralException
     */
    public function create($data)
    {
        $role = self::MODEL;
        $role = new $role;
        $role->title = $data['title'];
        $role->description = $data['description'];
        $role->key = str_slug($role->title, '-');

        if ($role->save()) {
            return $this->flushPermissions($role, $data);
        }

        throw new GeneralException(trans('exceptions.backend.access.roles.create_error'));
    }

    /**
     * @param array $data
     * @param Role $role
     * @return Role
     * @throws GeneralException
     */
    public function update($data, Role $role)
    {
        $role->title = $data['title'];
        $role->description = $data['description'];

        if ($role->save()) {
            return $this->flushPermissions($role, $data);
        }

        throw new GeneralException(trans('exceptions.backend.access.roles.update_error'));
    }

    /**
     * @param Role $role
     * @return bool
     * @throws GeneralException
     * @throws ValidationException
     */
    public function delete(Role $role)
    {
        if ($role->isSuperAdmin()) {
            throw ValidationException::withMessages([trans('exceptions.backend.access.roles.cant_delete_admin_role')]);
        }

        if ($role->users()->count()) {
            throw ValidationException::withMessages([trans('exceptions.backend.access.roles.cant_delete_user_role')]);
        }

        if ($role->delete()) {
            return true;
        }

        throw new GeneralException(trans('exceptions.backend.access.roles.delete_error'));
    }

    /**
     * @return Collection
     */
    public function getRolesExceptSuperAdmin()
    {
        return $this
            ->query()
            ->where('key', '<>', Role::ROLE_SUPER_ADMIN)
            ->orderBy('title')
            ->get();
    }

    /**
     * @return mixed
     */
    public function getRolesData()
    {
        return $this->query()
            ->with('permissions')
            ->select([
                'roles.id',
                'roles.title',
                'roles.key',
                'roles.description',
                'roles.updated_at',
            ]);
    }

    /**
     * @param Role $role
     * @param array $data
     * @return Role
     */
    private function flushPermissions($role, $data)
    {
        if(!$role->isSuperAdmin()){
            $role->permissions()->detach();
        }

        if(!isset($data['associatedPermissions'])){
            return $role;
        }

        $role->permissions()->attach($data['associatedPermissions']);

        return $role;
    }
}