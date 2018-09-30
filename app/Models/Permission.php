<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\Permission\PermissionAttribute;
use App\Models\Traits\Permission\PermissionRelationship;

class Permission extends Model
{
    use PermissionAttribute;
    use PermissionRelationship;

    const PERMISSION_KEY_BACKEND_VIEW = 'backend-view';
    const PERMISSION_KEY_USER_VIEW = 'user-view';
    const PERMISSION_KEY_USER_CREATE = 'user-create';
    const PERMISSION_KEY_USER_UPDATE = 'user-update';
    const PERMISSION_KEY_USER_DELETE = 'user-delete';
    const PERMISSION_KEY_ROLE_VIEW = 'role-view';
    const PERMISSION_KEY_ROLE_CREATE = 'role-create';
    const PERMISSION_KEY_ROLE_UPDATE = 'role-update';
    const PERMISSION_KEY_ROLE_DELETE = 'role-delete';
    const PERMISSION_KEY_PERMISSION_VIEW = 'permission-view';
    const PERMISSION_KEY_PERMISSION_UPDATE = 'permission-update';

    /**
     * @var array
     */
    protected $fillable = ['title', 'description'];

}
