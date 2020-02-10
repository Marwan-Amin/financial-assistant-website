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
   .sass('resources/sass/app.scss', 'public/css');

   mix.js('resources/js/bootstrap.js', 'public/js')

   mix.js('resources/js/expenses/create.js','public/js/expenses/create.js');
   mix.js('resources/js/expenses/index.js','public/js/expenses/index.js');

   mix.js('resources/js/events/create.js','public/js/events/create.js');
   mix.js('resources/js/events/index.js','public/js/events/index.js');
   mix.js('resources/js/events/edit.js','public/js/events/edit.js');