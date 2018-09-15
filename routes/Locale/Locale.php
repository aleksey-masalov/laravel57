<?php

/**
 * Locale Controllers
 * All route names are prefixed with 'locale.'.
 */
Route::get('locale/{locale}', 'LocaleController@swap')->name('swap');