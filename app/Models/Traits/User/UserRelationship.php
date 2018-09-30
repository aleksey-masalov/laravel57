<?php

namespace App\Models\Traits\User;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Models\Role;

trait UserRelationship
{
    /**
     * @return BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'user_role', 'user_id', 'role_id');
    }
}