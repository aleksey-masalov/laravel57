<?php

/**
 * Backend Permissions Controllers
 * All route names are prefixed with 'backend.'.
 */

Route::group(['namespace' => 'Permission'], function () {

    Route::resource('permissions', 'PermissionController')->only([
        'index',
        'show',
        'edit',
        'update',
    ]);

});