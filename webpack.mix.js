const mix = require('laravel-mix');
const path = require('path');
const Tesseract = require('tesseract.js');


mix.js('resources/js/app.js', 'public/js')
.webpackConfig({
    module: {
        rules: [
            {
                test: require.resolve('tesseract.js'),
                loader: 'expose-loader',
                options: {
                    exposes: 'Tesseract'
                }
            }
        ]
    },
})
.copy('node_modules/@techstark/opencv-js/dist/opencv.js', 'public/js')
.sass('resources/sass/app.scss', 'public/css')
.sourceMaps();

  