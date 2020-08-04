let mix = require('laravel-mix')
const tailwindcss = require('tailwindcss')

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
    //.sass('resources/sass/card.scss', 'css')
