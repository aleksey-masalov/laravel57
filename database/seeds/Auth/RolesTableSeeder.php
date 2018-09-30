<?php

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\Permission;

class RolesTableSeeder extends Seeder
{
    /**
     * @return void
     */
    public function run()
    {
        $permissionBackendView = Permission::where('key', Permission::PERMISSION_KEY_BACKEND_VIEW)->first();
        $permissionUserView = Permission::where('key', Permission::PERMISSION_KEY_USER_VIEW)->first();
        $permissionUserCreate = Permission::where('key', Permission::PERMISSION_KEY_USER_CREATE)->first();
        $permissionUserUpdate = Permission::where('key', Permission::PERMISSION_KEY_USER_UPDATE)->first();
        $permissionUserDelete = Permission::where('key', Permission::PERMISSION_KEY_USER_DELETE)->first();
        $permissionRoleView = Permission::where('key', Permission::PERMISSION_KEY_ROLE_VIEW)->first();
        $permissionRoleCreate = Permission::where('key', Permission::PERMISSION_KEY_ROLE_CREATE)->first();
        $permissionRoleUpdate = Permission::where('key', Permission::PERMISSION_KEY_ROLE_UPDATE)->first();
        $permissionRoleDelete = Permission::where('key', Permission::PERMISSION_KEY_ROLE_DELETE)->first();
        $permissionPermissionView = Permission::where('key', Permission::PERMISSION_KEY_PERMISSION_VIEW)->first();
        $permissionPermissionUpdate = Permission::where('key', Permission::PERMISSION_KEY_PERMISSION_UPDATE)->first();

        $roleAdministrator = new Role();
        $roleAdministrator->key = Role::ROLE_KEY_ADMINISTRATOR;
        $roleAdministrator->title = ucfirst(Role::ROLE_KEY_ADMINISTRATOR);
        $roleAdministrator->save();
        $roleAdministrator->permissions()->attach($permissionBackendView);
        $roleAdministrator->permissions()->attach($permissionUserView);
        $roleAdministrator->permissions()->attach($permissionUserCreate);
        $roleAdministrator->permissions()->attach($permissionUserUpdate);
        $roleAdministrator->permissions()->attach($permissionUserDelete);
        $roleAdministrator->permissions()->attach($permissionRoleView);
        $roleAdministrator->permissions()->attach($permissionRoleCreate);
        $roleAdministrator->permissions()->attach($permissionRoleUpdate);
        $roleAdministrator->permissions()->attach($permissionRoleDelete);
        $roleAdministrator->permissions()->attach($permissionPermissionView);
        $roleAdministrator->permissions()->attach($permissionPermissionUpdate);

        $roleManager = new Role();
        $roleManager->key = Role::ROLE_KEY_MANAGER;
        $roleManager->title = ucfirst(Role::ROLE_KEY_MANAGER);
        $roleManager->save();
        $roleManager->permissions()->attach($permissionBackendView);

        $roleUser = new Role();
        $roleUser->key = Role::ROLE_KEY_USER;
        $roleUser->title = ucfirst(Role::ROLE_KEY_USER);
        $roleUser->save();
    }
}
