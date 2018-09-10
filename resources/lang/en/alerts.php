<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Alerts Language Lines
    |--------------------------------------------------------------------------
    */

//    'general' => [
//        'are_you_sure' => 'Are you sure you want to do this?',
//        'delete_user_confirm' => "Are you sure you want to delete this user permanently? Anywhere in the application that references this user's id will most likely error. Proceed at your own risk. This can not be un-done.",
//    ],
    'auth' => [
        'confirmation' => [
            'sent' => 'Thanks for signing up! Please check your email.',
            'resent' => 'Confirmation email has been sent.',
            'confirmed' => 'Your account has been successfully confirmed.',
            'already_confirmed' => 'Your account is already confirmed.',
            'mismatch' => 'Your confirmation code does not match.',
            'not_exist' => 'Your email does not exist.',
            'resend' => 'Your account is not confirmed. Please click the confirmation button in your email. <a href="' . route('account.confirm.resend') . '?email=:email">Resend the confirmation email.</a>',
        ],
        'password' => [
            'changed' => 'Password changed successfully. Please confirm your account',
        ]
    ]

];