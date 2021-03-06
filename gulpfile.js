const elixir = require('laravel-elixir');

require('laravel-elixir-vue');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(mix => {
    mix.sass('app.scss')
       .webpack('app.js');
});
elixir(function(mix) {
    mix.scripts(['frontend/jquery-1.11.1.min.js', 
    	'frontend/move-top.js', 
    	'frontend/easing.js',
    	'frontend/jstarbox.js'
    	],
    	'public/js/frontend/general.js');
});
elixir(function(mix) {
    mix.styles([
        'frontend/bootstrap.css',
        'frontend/font-awesome.css',
        'frontend/jstarbox.css',
        'frontend/style.css'
    ],
    	'public/css/frontend/general.css');
});
elixir(function(mix) {
    mix.styles('././bower_components/sweetalert/dist/sweetalert.css','public/css/frontend/sweetalert.css');
});
elixir(function(mix) {
    mix.scripts('././bower_components/sweetalert/dist/sweetalert.min.js','public/js/frontend/sweetalert.js');
});
elixir(function(mix) {
    mix.styles('././bower_components/jquery-typeahead/dist/jquery.typeahead.min.css','public/css/frontend/jquery-typeahead.css');
});
elixir(function(mix) {
    mix.scripts('././bower_components/jquery-typeahead/dist/jquery.typeahead.min.js','public/js/frontend/jquery-typeahead.js');
});
elixir(function(mix) {
     mix.scripts('frontend/filter.js', 'public/js/frontend/filter.js');
     mix.copy('././bower_components/AdminLTE/dist/css', 'public/css/backend/css');
      mix.copy('././bower_components/AdminLTE/boostrap', 'public/css/backend/boostrap');
     mix.copy('././bower_components/AdminLTE/dist/js', 'public/js/backend/js');
     mix.copy('././bower_components/AdminLTE/plugins', 'public/plugins/backend/plugins');
});

