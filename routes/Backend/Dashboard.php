<?php

/**
 * Backend Dashboard Controllers
 * All route names are prefixed with 'backend.'.
 */
Route::get('/dashboard', 'DashboardController@dashboard')->name('dashboard');