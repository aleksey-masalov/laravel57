<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use App\Models\Traits\User\UserAttribute;
use App\Models\Traits\User\UserRelationship;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;
    use UserAttribute;
    use UserRelationship;

    /**
     * @var array
     */
    protected $fillable = ['name', 'email', 'password', 'is_active', 'is_confirmed'];

    /**
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    /**
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * @var bool
     */
    protected $softDelete = true;

    /**
     * @return bool
     */
    public function hasActiveAccount()
    {
        return $this->is_active == 1;
    }

    /**
     * @return bool
     */
    public function hasConfirmedAccount()
    {
        return $this->is_confirmed == 1;
    }

    /**
     * @param string $role
     * @return bool
     */
    public function hasRole($role)
    {
        return !is_null($this->roles()->where('key', $role)->first());
    }

    /**
     * @param string $permission
     * @return boolean
     */
    public function hasPermission($permission)
    {
        foreach ($this->roles as $role) {
            if ($role->permissions()->where('key', $permission)->first()) {
                return true;
            }
        }

        return false;
    }

    /**
     * @return bool
     */
    public function isSuperAdmin()
    {
        return $this->hasRole(Role::ROLE_SUPER_ADMIN);
    }

    /**
     * @return bool
     */
    public function isCurrentUser()
    {
        return auth()->check() && auth()->id() === $this->id;
    }

    /**
     * @return bool
     */
    public function isCurrentSuperAdmin()
    {
        return $this->isCurrentUser() && $this->isSuperAdmin();
    }

    /**
     * @return User
     */
    public function generateConfirmationToken()
    {
        $this->confirmation_token = generateConfirmationToken();
        $this->save();

        return $this;
    }

    /**
     * @return User
     */
    public function confirmAccount()
    {
        $this->confirmation_token = null;
        $this->is_confirmed = true;
        $this->save();

        return $this;
    }
}
