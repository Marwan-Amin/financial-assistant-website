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

   mix.js('resources/js/events/create.js','public/js/events/create.js');
   mix.js('resources/js/events/edit.js','public/js/events/edit.js');
   mix.js('resources/js/functions/delete.js','public/js/functions/delete.js');
   mix.js('resources/js/tensorflow.js', 'public/js/tensorflow.js');
   mix.js('resources/js/savings/create.js', 'public/js/savings/create.js');
   mix.js('resources/js/profile/profile.js', 'public/js/profile/profile.js');
   mix.js('resources/js/calendar.js', 'public/js/calendar.js');
   mix.js('resources/js/targets/create.js','public/js/targets/create.js');

