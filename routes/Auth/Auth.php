<?php

/**
 * Auth Controllers
 */
Route::get('login', 'LoginController@showLoginForm')->name('login');
Route::post('login', 'LoginController@login');
Route::post('logout', 'LoginController@logout')->name('logout');

if (config('auth.registration_enabled')) {
    Route::get('register', 'RegisterController@showRegistrationForm')->name('register');
    Route::post('register', 'RegisterController@register');
}

Route::get('password/reset', 'ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'ForgotPasswordController@sendResetLinkEmail')->name('password.email');

Route::get('password/reset/{token}', 'ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'ResetPasswordController@reset')->name('password.update');

if (config('auth.confirm_account_enabled')) {
    Route::get('account/confirm/resend', 'ConfirmAccountController@resend')->name('account.confirm.resend');
    Route::get('account/confirm/token/{token}', 'ConfirmAccountController@confirm')->name('account.confirm');
}
