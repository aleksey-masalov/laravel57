<?php

namespace App\Repositories\Backend;

use App\Repositories\BaseRepository;
use App\Models\Permission;
use App\Exceptions\GeneralException;
use Illuminate\Database\Eloquent\Collection;

class PermissionRepository extends BaseRepository
{
    const MODEL = Permission::class;

    /**
     * @param array $data
     * @param Permission $permission
     * @return Permission
     * @throws GeneralException
     */
    public function update($data, Permission $permission)
    {
        $permission->title = $data['title'];
        $permission->description = $data['description'];

        if ($permission->save()) {
            return $permission;
        }

        throw new GeneralException(trans('exceptions.backend.access.permissions.update_error'));
    }

    /**
     * @return Collection
     */
    public function getPermissions()
    {
        return $this
            ->query()
            ->orderBy('title')
            ->get();
    }

    /**
     * @return mixed
     */
    public function getPermissionsData()
    {
        return $this->query()
            ->select([
                'permissions.id',
                'permissions.title',
                'permissions.description',
                'permissions.created_at',
                'permissions.updated_at',
            ]);
    }
}