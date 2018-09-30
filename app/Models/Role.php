<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\Role\RoleAttribute;
use App\Models\Traits\Role\RoleRelationship;

class Role extends Model
{
    use RoleAttribute;
    use RoleRelationship;

    const ROLE_KEY_ADMINISTRATOR = 'administrator';
    const ROLE_KEY_MANAGER = 'manager';
    const ROLE_KEY_USER = 'user';

    const ROLE_SUPER_ADMIN = self::ROLE_KEY_ADMINISTRATOR;

    /**
     * @var array
     */
    protected $fillable = ['title', 'description'];

    /**
     * @param string $permission
     * @return bool
     */
    public function hasPermission($permission)
    {
        return !is_null($this->permissions()->where('key', $permission)->first());
    }

    /**
     * @return bool
     */
    public function isSuperAdmin()
    {
        return $this->key === self::ROLE_SUPER_ADMIN;
    }
}
