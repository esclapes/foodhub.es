var gulp       = require('gulp');
var elixir     = require('laravel-elixir');
var livereload = require('gulp-livereload');

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

var paths = {
        bootstrap: 'node_modules/bootstrap/dist/'
    };

elixir(function(mix) {
    mix.sass('app.scss')
       .browserify('app/app.js')
       .copy(paths.bootstrap + 'fonts', 'public/fonts/bootstrap');
});

/**
 * Logic for LiveReload to work properly on watch task.
 */
gulp.on('task_start', function (e) {
    // only start LiveReload server if task is 'watch'
    if (e.task === 'watch') {
        livereload.listen();
    }
});
gulp.task('watch-lr-css', function () {
    // notify a CSS change, so that livereload can update it without a page refresh
    livereload.changed('app.css');
});
gulp.task('watch-lr', function () {
    // notify any other changes, so that livereload can refresh the page
    livereload.changed('app.js');
});