<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Labels Language Lines
    |--------------------------------------------------------------------------
    */

    'auth' => [
        'register' => [
            'title' => 'Register',
            'form' => [
                'name' => 'Name',
                'email' => 'E-Mail Address',
                'password' => 'Password',
                'password_confirm' => 'Confirm Password',
            ]
        ],
        'login' => [
            'title' => 'Login',
            'form' => [
                'login' => 'Login',
                'password' => 'Password',
            ],
            'remember_me' => 'Remember Me',
            'forgot_password' => 'Forgot Your Password?'
        ],
        'logout' => [
            'title' => 'Logout',
        ],
        'password_reset' => [
            'title' => 'Reset Password',
            'form' => [
                'email' => 'E-Mail Address',
                'password' => 'Password',
                'password_confirm' => 'Confirm Password',
            ]
        ],
        'password_reset_link' => [
            'title' => 'Reset Password',
            'form' => [
                'email' => 'E-Mail Address',
            ]
        ],
    ],
    'backend' => [
        'access' => [
            'users' => [
                'table' => [
                    'id' => 'ID',
                    'name' => 'Name',
                    'email' => 'Email',
                    'roles' => 'Roles',
                    'confirmed' => 'Confirmed',
                    'created' => 'Created At',
                    'updated' => 'Updated At',
                    'deleted' => 'Deleted At',
                    'active' => 'Active',
                    'password' => 'Password',
                    'password_confirmation' => 'Password Confirmation',
                    'associated_roles' => 'Associated Roles',
                ],
                'tabs' => [
                    'titles' => [
                        'overview' => 'Overview',
                    ],
                    'content' => [
                        'overview' => [
                            'id' => 'ID',
                            'name' => 'Name',
                            'email' => 'E-mail',
                            'status' => 'Status',
                            'confirmed' => 'Confirmed',
                            'created' => 'Created At',
                            'updated' => 'Updated At',
                            'deleted' => 'Deleted At',
                        ]
                    ]
                ]
            ],
            'roles' => [
                'table' => [
                    'id' => 'ID',
                    'title' => 'Title',
                    'description' => 'Description',
                    'permissions' => 'Permissions',
                    'updated' => 'Updated At',
                ],
                'tabs' => [
                    'titles' => [
                        'overview' => 'Overview',
                    ],
                    'content' => [
                        'overview' => [
                            'id' => 'ID',
                            'title' => 'Title',
                            'description' => 'Description',
                            'key' => 'Key',
                            'permissions' => 'Permissions',
                            'created' => 'Created At',
                            'updated' => 'Updated At',
                        ]
                    ]
                ]
            ],
            'permissions' => [
                'table' => [
                    'id' => 'ID',
                    'title' => 'Title',
                    'description' => 'Description',
                    'created_at' => 'Created At',
                    'updated_at' => 'Updated At',
                ],
                'tabs' => [
                    'titles' => [
                        'overview' => 'Overview',
                    ],
                    'content' => [
                        'overview' => [
                            'id' => 'ID',
                            'title' => 'Title',
                            'description' => 'Description',
                            'key' => 'Key',
                            'created' => 'Created At',
                            'updated' => 'Updated At',
                        ]
                    ]
                ]
            ]
        ]
    ],
    'general' => [
        'actions' => 'Actions',
        'yes' => 'Yes',
        'no' => 'No',
        'none' => 'None',
        'active' => 'Active',
        'deactivated' => 'Deactivated',
    ]
];