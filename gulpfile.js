'use strict';

const gulp         = require('gulp');
const sourcemaps   = require('gulp-sourcemaps');
const scss         = require('gulp-sass');
const rename       = require('gulp-rename');
const postcss      = require('gulp-postcss');
const autoprefixer = require('autoprefixer');

var paths = {
  styles: ['./admin/scss/**/*.scss'],
  templates: ['./**/*.php']
};

gulp.task('styles', function() {
  return gulp.src(paths.styles)
    .pipe(sourcemaps.init())
      .pipe(scss({outputStyle: 'compressed'}).on('error', scss.logError))
      .pipe(postcss([autoprefixer({browsers: ['last 2 versions']})]))
      .pipe(rename({suffix: '.min'}))
    .pipe(sourcemaps.write())
    .pipe(gulp.dest('./admin/css'));
});

gulp.task('watch', function() {
  gulp.watch(paths.styles, ['styles']);
  gulp.watch(paths.templates, ['styles']);
});

gulp.task('default', ['styles', 'watch']);
