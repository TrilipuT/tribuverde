const browserSync = require('browser-sync').create();
const config = require('../config.js');

module.exports = function () {
    let serveFunction = () => {
        browserSync.init({
            /*server: {
                baseDir: config.built.dir,
                directory: true
            },*/
            proxy: {
                target: "http://tribuverde.local"
            },

            // tunnel: true,
            open: false,
            notify: false
        });

        let watch_folders = [
            config.built.all,
            '*.php',
            'templates/*.php',
            'parts/**/*.php'
        ];
        browserSync.watch(watch_folders).on('change', browserSync.reload);
    }
    return serveFunction();
};