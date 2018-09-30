<?php

namespace App\Repositories\Backend;

use App\Models\Role;
use App\Models\User;
use App\Repositories\BaseRepository;
use App\Exceptions\GeneralException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class UserRepository extends BaseRepository
{
    const MODEL = User::class;

    /**
     * @param array $data
     * @return User
     * @throws GeneralException
     */
    public function create($data)
    {
        return DB::transaction(function () use ($data) {
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'is_active' => (isset($data['isActive']) && $data['isActive'] == '1'),
                'is_confirmed' => (isset($data['isConfirmed']) && $data['isConfirmed'] == '1'),
            ]);

            if ($user) {
                return $this->flushRole($user, $data);
            }

            throw new GeneralException(trans('exceptions.backend.access.users.create_error'));
        });
    }

    /**
     * @param array $data
     * @param User $user
     * @return User
     * @throws ValidationException
     */
    public function update($data, User $user)
    {
        if ($user->isSuperAdmin() && !$user->isCurrentSuperAdmin()) {
            throw ValidationException::withMessages([trans('exceptions.backend.access.users.cant_update_admin')]);
        }

        $role = Role::find((int)$data['associatedRole']);

        if ($role->isSuperAdmin() && !$user->isCurrentSuperAdmin()) {
            throw ValidationException::withMessages([trans('exceptions.backend.access.users.cant_create_admin')]);
        }

        return DB::transaction(function () use ($data, $user) {
            $user->name = $data['name'];
            $user->email = $data['email'];
            $user->is_active = ($user->isSuperAdmin() || (isset($data['isActive']) && $data['isActive'] == '1'));
            $user->is_confirmed = ($user->isSuperAdmin() || (isset($data['isConfirmed']) && $data['isConfirmed'] == '1'));

            if ($user->save()) {
                return $user->isSuperAdmin() ? $user : $this->flushRole($user, $data);
            }

            throw new GeneralException(trans('exceptions.backend.access.users.update_error'));
        });
    }

    /**
     * @param User $user
     * @return bool
     * @throws GeneralException
     * @throws ValidationException
     */
    public function delete(User $user)
    {
        if ($user->isCurrentUser()) {
            throw ValidationException::withMessages([trans('exceptions.backend.access.users.cant_delete_self')]);
        }

        if ($user->isSuperAdmin()) {
            throw ValidationException::withMessages([trans('exceptions.backend.access.users.cant_delete_admin')]);
        }

        if ($user->delete()) {
            return true;
        }

        throw new GeneralException(trans('exceptions.backend.access.users.delete_error'));
    }

    /**
     * @param int $id
     * @return bool
     * @throws GeneralException
     * @throws ValidationException
     */
    public function forceDelete($id)
    {
        $user = User::withTrashed()->find($id);

        if (!$user || !$user->trashed()) {
            throw ValidationException::withMessages([trans('exceptions.backend.access.users.delete_first')]);
        }

        if ($user->isCurrentUser()) {
            throw ValidationException::withMessages([trans('exceptions.backend.access.users.cant_delete_self')]);
        }

        if ($user->isSuperAdmin()) {
            throw ValidationException::withMessages([trans('exceptions.backend.access.users.cant_delete_admin')]);
        }

        DB::transaction(function () use ($user) {
            if ($user->forceDelete()) {
                return true;
            }

            throw new GeneralException(trans('exceptions.backend.access.users.delete_error'));
        });
    }

    /**
     * @param int $id
     * @return bool
     * @throws GeneralException
     * @throws ValidationException
     */
    public function restore($id)
    {
        $user = User::withTrashed()->find($id);

        if (!$user || !$user->trashed()) {
            throw ValidationException::withMessages([trans('exceptions.backend.access.users.cant_restore')]);
        }

        DB::transaction(function () use ($user) {
            if ($user->restore()) {
                return true;
            }

            throw new GeneralException(trans('exceptions.backend.access.users.restore_error'));
        });
    }

    /**
     * @param User $user
     * @param int $status
     * @return bool
     * @throws GeneralException
     * @throws ValidationException
     */
    public function status(User $user, $status)
    {
        if ($user->isSuperAdmin() && !$this->isCurrentSuperAdmin()) {
            throw ValidationException::withMessages([trans('exceptions.backend.access.users.cant_deactivate_admin')]);
        }

        $user->is_active = $status;

        if ($user->save()) {
            return true;
        }

        throw new GeneralException(trans('exceptions.backend.access.users.status_error'));
    }

    /**
     * @param User $user
     * @param array $data
     * @return bool
     * @throws GeneralException
     * @throws ValidationException
     */
    public function updatePassword(User $user, $data)
    {
        if ($user->isSuperAdmin() && !$user->isCurrentSuperAdmin()) {
            throw ValidationException::withMessages([trans('exceptions.backend.access.users.cant_change_password_admin')]);
        }

        $user->password = Hash::make($data['password']);

        if ($user->save()) {
            return true;
        }

        throw new GeneralException(trans('exceptions.backend.access.users.update_password_error'));
    }

    /**
     * @param bool $isActive
     * @param bool $isTrashed
     * @return mixed
     */
    public function getUsersData($isActive, $isTrashed)
    {
        $dataTableQuery = $this->query()
            ->with('roles')
            ->select([
                'users.id',
                'users.name',
                'users.email',
                'users.created_at',
                'users.updated_at',
                'users.deleted_at',
                'users.is_active',
                'users.is_confirmed',
            ]);

        return $isTrashed ? $dataTableQuery->onlyTrashed() : $dataTableQuery->where('is_active', $isActive);
    }

    /**
     * @param User $user
     * @param array $data
     * @return User
     */
    private function flushRole($user, $data)
    {
        $user->roles()->detach();
        $user->roles()->attach((int)$data['associatedRole']);

        return $user;
    }
}
