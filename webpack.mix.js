const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix
    .js('resources/js/app.js', 'public/js')
    .minify('public/js/app.js')

    .js('resources/js/plugins/datatables.js', 'public/js/plugins')
    .minify('public/js/plugins/datatables.js')

    .postCss('resources/css/app.css', 'public/css', [require("tailwindcss")])
    .minify('public/css/app.js')

    .postCss('resources/css/plugins/datatables.css', 'public/css/plugins')
    .minify('public/css/plugins/datatables.js');
