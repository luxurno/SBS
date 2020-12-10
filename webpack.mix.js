const mix = require('laravel-mix');

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

// mix.babelConfig({
//     "presets": [
//         "@babel/preset-env",
//         "@babel/preset-react"
//     ],
//     "plugins": [
//         "@babel/plugin-proposal-class-properties",
//         "@babel/plugin-transform-runtime",
//         ["@babel/plugin-transform-typescript", { "allowNamespaces": true }]
//     ]
// })

mix.webpackConfig({
    module: {
        rules: [
            {
                test: /\.tsx?$/,
                loader: "ts-loader",
                exclude: /node_modules/
            }
        ]
    }
});

mix.react('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css');
