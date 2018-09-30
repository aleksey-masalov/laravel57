<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;

class UsersTableSeeder extends Seeder
{
    /**
     * @return void
     */
    public function run()
    {
        $roleAdministrator = Role::where('key', Role::ROLE_KEY_ADMINISTRATOR)->first();
        $roleManager = Role::where('key', Role::ROLE_KEY_MANAGER)->first();
        $roleUser = Role::where('key', Role::ROLE_KEY_USER)->first();

        $userAdministrator = new User();
        $userAdministrator->name = ucfirst(Role::ROLE_KEY_ADMINISTRATOR);
        $userAdministrator->email = 'admin@admin.com';
        $userAdministrator->password = bcrypt('1234');
        $userAdministrator->is_active = true;
        $userAdministrator->is_confirmed = true;
        $userAdministrator->save();
        $userAdministrator->roles()->attach($roleAdministrator);

        $userManager = new User();
        $userManager->name = ucfirst(Role::ROLE_KEY_MANAGER);
        $userManager->email = 'manager@manager.com';
        $userManager->password = bcrypt('1234');
        $userManager->is_active = true;
        $userManager->is_confirmed = true;
        $userManager->save();
        $userManager->roles()->attach($roleManager);

        $userUser = new User();
        $userUser->name = ucfirst(Role::ROLE_KEY_USER);
        $userUser->email = 'user@user.com';
        $userUser->password = bcrypt('1234');
        $userUser->is_active = true;
        $userUser->is_confirmed = true;
        $userUser->save();
        $userUser->roles()->attach($roleUser);
    }
}
