<?php

/**
 * Backend Roles Controllers
 * All route names are prefixed with 'backend.'.
 */

Route::group(['namespace' => 'Role'], function () {

    Route::resource('roles', 'RoleController');

});