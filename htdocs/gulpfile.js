var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Less
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {
    mix.sass('app.scss');

    mix.styles([
        'libs/bootstrap.css',
        'app.css'
    ]).styles([
        'sortingAndFiltering.css'
    ], 'public/css/sortingAndFiltering.css');

    mix.scripts([
        'libs/jquery.js',
        'libs/bootstrap.js',
        'my-scripts.js'
    ]).scripts([
        'libs/jquery.mixitup.js',
        'my-scripts.js'
    ], 'public/js/mixitup.js').scripts([
        'libs/skulpt.min.js',
        'libs/skulpt-stdlib.js',
        'skulpt-functions.js'
    ], 'public/js/skulpt.js');
});
