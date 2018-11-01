const gulp = require('gulp');
const plumber = require('gulp-plumber');
const notify = require('gulp-notify');
const debug = require('gulp-debug');
const imagemin = require('gulp-imagemin');
const config = require('../config.js');

module.exports = function() {
    return gulp.src(config.src.images, {since: gulp.lastRun('image')})
      .pipe(plumber({
            errorHandler: notify.onError(err => ({
              title: 'images',
              message: err.message
            }))
          }))
        .pipe(imagemin(
          [
            imagemin.svgo({
              plugins: [
                { optimizationLevel: 3 },
                { progessive: true },
                { interlaced: true },
                { removeViewBox: false },
                { removeUselessStrokeAndFill: false },
                { cleanupIDs: false }
              ]
            }),
          ],
          {
            progressive: true,
            interlaced: true
          })
        )
        .pipe(debug({title: 'images:'}))
        .pipe(gulp.dest(config.built.images));
};