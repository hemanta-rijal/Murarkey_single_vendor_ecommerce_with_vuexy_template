var gulp = require('gulp');
var elixir = require('laravel-elixir');


var vendors = '../../vendor/';


var paths = {
    'jquery': vendors + '/jquery/dist',
    'bootstrap': vendors + '/bootstrap/dist',
    'fontawesome': vendors + '/font-awesome',
    'admin_lte': vendors + '/admin-lte/dist',
    'toastr': vendors + '/toastr',
};

elixir.config.sourcemaps = false;

elixir(function (mix) {

    // // Copy fonts straight to public
    mix.copy('resources/vendor/bootstrap/dist/fonts/**', 'public/assets/fonts');
    mix.copy('resources/vendor/font-awesome/fonts/**', 'public/assets/fonts');

    // // Merge Site CSSs.
    mix.styles([
        paths.bootstrap + '/css/bootstrap.min.css',
        paths.fontawesome + '/css/font-awesome.css',
        paths.toastr + '/toastr.min.css',
        paths.admin_lte + '/css/AdminLTE.min.css',
        paths.admin_lte + '/css/skins/skin-blue.min.css',
        'admin.css'
    ], 'public/assets/css/admin.css');

    // Merge Site scripts.
    mix.scripts([
        paths.jquery + '/jquery.min.js',
        paths.bootstrap + '/js/bootstrap.min.js',
        paths.admin_lte + '/js/app.min.js',
        paths.toastr + '/toastr.min.js',
    ], 'public/assets/js/admin.js');

});
