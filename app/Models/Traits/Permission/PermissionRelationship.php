<?php

namespace App\Models\Traits\Permission;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Models\Role;

trait PermissionRelationship
{
    /**
     * @return BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_permission', 'permission_id', 'role_id');
    }
}