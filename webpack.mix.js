const mix = require('laravel-mix');
// const { WebpackLaravelMixManifest } = require('laravel-mix');

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

mix.js('resources/js/app.js', `js`)
    // .sass('resources/sass/app.scss', `css`)
    .postCss('resources/css/app.css', `css`, [
        require('tailwindcss'),
    ])
    .react()
    .extract();

if (mix.inProduction()) {
    mix
        .setPublicPath('public/')
        .version();
} else {
    mix
        .setPublicPath('public/hot/')
        .browserSync('127.0.0.1:8000');
}

mix.disableNotifications();
