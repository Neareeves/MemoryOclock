'use strict';
 

var gulp = require('gulp');
var sass = require('gulp-sass');
 
sass.compiler = require('sass');
 
gulp.task('sass', function () {
  return gulp.src('assets/scss/style.scss')
    .pipe(sass())
    .pipe(gulp.dest('assets/css'));
});
 
gulp.task('sass:watch', function () {
  gulp.watch('assets/scss/style.scss', sass);
});

gulp.task('hello', function() {
  console.log('Hello Zell');
});
