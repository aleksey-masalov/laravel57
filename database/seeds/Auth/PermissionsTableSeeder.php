<?php

use Illuminate\Database\Seeder;
use App\Models\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * @return void
     */
    public function run()
    {
        $permission = new Permission();
        $permission->key = Permission::PERMISSION_KEY_BACKEND_VIEW;
        $permission->title = ucfirst(Permission::PERMISSION_KEY_BACKEND_VIEW);
        $permission->save();

        $permission = new Permission();
        $permission->key = Permission::PERMISSION_KEY_USER_VIEW;
        $permission->title = ucfirst(Permission::PERMISSION_KEY_USER_VIEW);
        $permission->save();

        $permission = new Permission();
        $permission->key = Permission::PERMISSION_KEY_USER_CREATE;
        $permission->title = ucfirst(Permission::PERMISSION_KEY_USER_CREATE);
        $permission->save();

        $permission = new Permission();
        $permission->key = Permission::PERMISSION_KEY_USER_UPDATE;
        $permission->title = ucfirst(Permission::PERMISSION_KEY_USER_UPDATE);
        $permission->save();

        $permission = new Permission();
        $permission->key = Permission::PERMISSION_KEY_USER_DELETE;
        $permission->title = ucfirst(Permission::PERMISSION_KEY_USER_DELETE);
        $permission->save();

        $permission = new Permission();
        $permission->key = Permission::PERMISSION_KEY_ROLE_VIEW;
        $permission->title = ucfirst(Permission::PERMISSION_KEY_ROLE_VIEW);
        $permission->save();

        $permission = new Permission();
        $permission->key = Permission::PERMISSION_KEY_ROLE_CREATE;
        $permission->title = ucfirst(Permission::PERMISSION_KEY_ROLE_CREATE);
        $permission->save();

        $permission = new Permission();
        $permission->key = Permission::PERMISSION_KEY_ROLE_UPDATE;
        $permission->title = ucfirst(Permission::PERMISSION_KEY_ROLE_UPDATE);
        $permission->save();

        $permission = new Permission();
        $permission->key = Permission::PERMISSION_KEY_ROLE_DELETE;
        $permission->title = ucfirst(Permission::PERMISSION_KEY_ROLE_DELETE);
        $permission->save();

        $permission = new Permission();
        $permission->key = Permission::PERMISSION_KEY_PERMISSION_VIEW;
        $permission->title = ucfirst(Permission::PERMISSION_KEY_PERMISSION_VIEW);
        $permission->save();

        $permission = new Permission();
        $permission->key = Permission::PERMISSION_KEY_PERMISSION_UPDATE;
        $permission->title = ucfirst(Permission::PERMISSION_KEY_PERMISSION_UPDATE);
        $permission->save();
    }
}
