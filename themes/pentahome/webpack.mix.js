const mix = require('laravel-mix');
mix.js('resources/js/app.js', 'public/js/app.js');
mix.sass('resources/sass/custom.scss', 'public/css/style.css', {}, [
        require("rtlcss")({}),
    ])
    .sourceMaps() // Enable source maps for both JavaScript and CSS
    .options({
        processCssUrls: true,
    });

mix.webpackConfig({
    stats: {
        children: true,
    },
});
