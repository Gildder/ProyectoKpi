var elixir = require('laravel-elixir');

require('laravel-elixir-vueify');
require('laravel-elixir-livereload');
require("laravel-elixir-babel");

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

elixir(function(mix) {
    mix.browserify('app-vue.js', 'public/dist/js/app-vue.js');
    mix.livereload();
    mix.babel("app-vue.js", {
        srcDir: "resources/assets/js",
        output: "public/dist/js/app-babel.js",
        sourceMaps: true
    });


});
