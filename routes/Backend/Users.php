<?php

/**
 * Backend Users Controllers
 * All route names are prefixed with 'backend.'.
 */

Route::group(['namespace' => 'User'], function () {

    Route::group(['prefix' => 'users'], function () {
        Route::get('deactivated', 'UserController@deactivated')->name('users.deactivated');
        Route::get('deleted', 'UserController@deleted')->name('users.deleted');

        Route::group(['prefix' => '{user}'], function () {
            Route::get('status/{status}', 'UserController@status')->name('users.status')->where(['status' => '[0,1]']);
            Route::get('password/change', 'UserPasswordController@change')->name('users.password.change');
            Route::patch('password/change', 'UserPasswordController@update')->name('users.password.change.patch');
            Route::get('account/confirm/resend', 'UserConfirmAccountController@resend')->name('users.account.confirm.resend');
        });

        Route::group(['prefix' => '{deleted}'], function () {
            Route::delete('delete', 'UserDeletedController@delete')->name('users.delete-permanently');
            Route::get('restore', 'UserDeletedController@restore')->name('users.restore');
        });
    });

    Route::resource('users', 'UserController');

});