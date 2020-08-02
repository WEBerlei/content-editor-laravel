let mix = require('laravel-mix')

mix
    .setPublicPath('dist')
    .js('resources/js/app.js', 'js')
    .extract([
        'trix',
    ])
    .sass('resources/sass/vendor.scss', 'css')
    .sass('resources/sass/app.scss', 'css')
    //.sass('resources/sass/card.scss', 'css')
