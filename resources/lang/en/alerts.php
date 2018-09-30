<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Alerts Language Lines
    |--------------------------------------------------------------------------
    */

    'general' => [
        'are_you_sure' => 'Are you sure you want to do this?',
        'delete_user_confirm' => "Are you sure you want to delete this user permanently? Anywhere in the application that references this user's id will most likely error. Proceed at your own risk. This can not be un-done.",
    ],
    'auth' => [
        'confirmation' => [
            'sent' => 'Thanks for signing up! Please check your email.',
            'resent' => 'Confirmation email has been sent.',
            'confirmed' => 'Your account has been successfully confirmed.',
            'already_confirmed' => 'Your account is already confirmed.',
            'mismatch' => 'Your confirmation code does not match.',
            'not_exist' => 'Your email does not exist.',
            'resend' => config('auth.confirm_account_enabled') ? 'Your account is not confirmed. Please click the confirmation button in your email. <a href="' . route('account.confirm.resend') . '?email=:email">Resend the confirmation email.</a>' : '',
        ],
        'password' => [
            'changed' => 'Password changed successfully. Please confirm your account',
        ]
    ],
    'backend' => [
        'users' => [
            'created' => 'The user was successfully created.',
            'updated' => 'The user was successfully updated.',
            'deleted' => 'The user was successfully deleted.',
            'restored' => 'The user was successfully restored.',
            'deleted_permanently' => 'The user was deleted permanently.',
            'password_updated' => 'The user\'s password was successfully updated.',
        ],
        'confirmation' => [
            'resent' => 'Confirmation email has been sent.',
            'already_confirmed' => 'This account is already confirmed.',
        ],
        'roles' => [
            'created' => 'The role was successfully created.',
            'updated' => 'The role was successfully updated.',
            'deleted' => 'The role was successfully deleted.',
        ],
        'permissions' => [
            'created' => 'The permission was successfully created.',
            'updated' => 'The permission was successfully updated.',
            'deleted' => 'The permission was successfully deleted.',
        ],
    ]
];