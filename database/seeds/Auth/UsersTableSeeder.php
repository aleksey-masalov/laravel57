<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * @return void
     */
    public function run()
    {
        $userAdministrator = new User();
        $userAdministrator->name = 'Administrator';
        $userAdministrator->email = 'admin@admin.com';
        $userAdministrator->password = bcrypt('1234');
        $userAdministrator->is_active = true;
        $userAdministrator->is_confirmed = true;
        $userAdministrator->save();

        $userManager = new User();
        $userManager->name = 'Manager';
        $userManager->email = 'manager@manager.com';
        $userManager->password = bcrypt('1234');
        $userManager->is_active = true;
        $userManager->is_confirmed = true;
        $userManager->save();

        $userUser = new User();
        $userUser->name = 'User';
        $userUser->email = 'user@user.com';
        $userUser->password = bcrypt('1234');
        $userUser->is_active = true;
        $userUser->is_confirmed = true;
        $userUser->save();
    }
}
