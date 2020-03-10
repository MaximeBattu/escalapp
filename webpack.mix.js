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

mix.js('resources/js/app.js', 'public/js')
    .js('resources/js/main.js', 'public/js')
    .js('resources/js/route.js', 'public/js')
    .js('resources/js/profile.js', 'public/js')
    .js('resources/js/admin/room-admin.js', 'public/js/admin')
    .js('resources/js/admin/route-admin.js', 'public/js/admin')
    .js('resources/js/admin/sector-admin.js', 'public/js/admin')
    .js('resources/js/admin/user-admin.js', 'public/js/admin')
    .sass('resources/sass/app.scss', 'public/css')
    .sass('resources/sass/styles.scss', `public/css`)
    .sass('resources/sass/profile.scss', 'public/css')
    .sass('resources/sass/room.scss', 'public/css')
    .sass('resources/sass/route-boulder.scss', 'public/css')
    .sass('resources/sass/admin.scss', 'public/css')
    .sass('resources/sass/contest.scss', 'public/css')
    .sass('resources/sass/user.scss', 'public/css')
    .sass('resources/sass/media-queries.scss', 'public/css');

