const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.styles([
        'resources/assets/css/backend/font-awesome.min.css',
        'resources/assets/css/backend/admin-lte.min.css'
    ], 'public/css/backend.css')
    .styles([
        'resources/assets/css/frontend/bootstrap.min.css'
    ], 'public/css/frontend.css')
    .scripts([
        'resources/assets/js/backend/jquery.min.js',
        'resources/assets/js/backend/bootstrap.min.js',
        'resources/assets/js/backend/admin-lte.min.js'
    ], 'public/js/backend.js')
    .scripts([
        'resources/assets/js/frontend/jquery.min.js',
        'resources/assets/js/frontend/bootstrap.min.js'
    ], 'public/js/frontend.js');

if (mix.inProduction()) {
    mix.version();
}
