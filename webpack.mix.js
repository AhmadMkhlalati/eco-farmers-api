const mix = require("laravel-mix");
const tailwindcss = require('tailwindcss');
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

mix.js("resources/js/app.js", "public/dist/js")
    .js("resources/js/ckeditor-classic.js", "public/dist/js")
    .js("resources/js/ckeditor-inline.js", "public/dist/js")
    .js("resources/js/ckeditor-balloon.js", "public/dist/js")
    .js("resources/js/ckeditor-balloon-block.js", "public/dist/js")
    .js("resources/js/ckeditor-document.js", "public/dist/js")
    .css("resources/css/app.css", "public/dist/css/app.css")
    .options({
        postCss: [tailwindcss('./tailwind.config.js')],
    })
    .copyDirectory("resources/json", "public/dist/json")
    .copyDirectory("resources/fonts", "public/dist/fonts")
    .copyDirectory("resources/images", "public/dist/images")
    .browserSync({
        proxy: "rubick-html.test",
        files: ["resources/**/*.*"],
    });
