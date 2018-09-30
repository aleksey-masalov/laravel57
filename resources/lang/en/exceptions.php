<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Exceptions Language Lines
    |--------------------------------------------------------------------------
    */

    'backend' => [
        'access' => [
            'users' => [
                'create_error' => 'There was a problem creating this user. Please try again.',
                'update_error' => 'There was a problem updating this user. Please try again.',
                'delete_error' => 'There was a problem deleting this user. Please try again.',
                'status_error' => 'There was a problem updating status for this user. Please try again.',
                'restore_error' => 'There was a problem restoring this user. Please try again.',
                'update_password_error' => 'There was a problem changing this users password. Please try again.',
                'cant_restore' => 'This user is not deleted so it can not be restored.',
                'cant_delete_self' => 'You can not delete yourself.',
                'delete_first' => 'This user must be deleted first before it can be destroyed permanently.',
                'cant_create_admin' => 'You can not create the super administrator.',
                'cant_update_admin' => 'You can not update the super administrator.',
                'cant_delete_admin' => 'You can not delete the super administrator.',
                'cant_deactivate_admin' => 'You can not deactivate the super administrator.',
                'cant_change_password_admin' => 'You can not change password for the super administrator.',
            ],
            'roles' => [
                'create_error' => 'There was a problem creating this role. Please try again.',
                'update_error' => 'There was a problem updating this role. Please try again.',
                'delete_error' => 'There was a problem deleting this role. Please try again.',
                'cant_delete_user_role' => 'You can not delete role with attached users. Please detach this role from users and try again.',
                'cant_delete_admin_role' => 'You can not delete the super administrator role.',
            ],
            'permissions' => [
                'create_error' => 'There was a problem creating this permission. Please try again.',
                'update_error' => 'There was a problem updating this permission. Please try again.',
                'delete_error' => 'There was a problem deleting this permission. Please try again.',
            ]
        ]
    ]
];