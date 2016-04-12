'use strict';

var gulp = require('gulp');
var sass = require('gulp-sass');
var path = {
      SASS_SRC: './assets/sass/main.scss',
      SASS_WATCH: [
        './assets/sass/*.scss',
        './assets/sass/**/*.scss',
        './assets/sass/**/**/*.scss'
      ],
      SASS_BLD: './assets/css/'
    };

gulp.task('sass', function () {
  gulp.src(path.SASS_SRC)
    .pipe(sass().on('error', sass.logError))
    .pipe(gulp.dest(path.SASS_BLD));
});

gulp.task('watch', function () {
  gulp.watch(path.SASS_WATCH, ['sass']);
});

gulp.task('default', ['sass', 'watch']);
