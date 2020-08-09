let mix = require('laravel-mix')
const tailwindcss = require('tailwindcss')

require('laravel-mix-purgecss');

mix
    .setPublicPath('dist')
    .js('resources/js/app.js', 'js')
    .extract([
        'trix',
    ])
    .sass('resources/sass/vendor.scss', 'css')
    .sass('resources/sass/app.scss', 'css')
    .options({
        processCssUrls: false,
        postCss: [ tailwindcss('./tailwind.config.js') ],
    })
    .purgeCss({
        enabled: true,
    })
    //.sass('resources/sass/card.scss', 'css')
