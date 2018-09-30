<?php

/**
 * Backend Ajax Controllers
 * All route names are prefixed with 'backend.'.
 */

Route::group(['namespace' => 'Ajax'], function () {

    Route::post('users/get', 'AjaxUserController@get')->name('users.get');
    Route::post('roles/get', 'AjaxRoleController@get')->name('roles.get');
    Route::post('permissions/get', 'AjaxPermissionController@get')->name('permissions.get');

});