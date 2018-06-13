var gulp = require('gulp');
var minifyCSS = require('gulp-csso');
var sass = require('gulp-sass');
var sourcemaps = require('gulp-sourcemaps');

gulp.task('css', function(){
    return gulp.src('assets/styles/main.scss')
    .pipe(sourcemaps.init())
    .pipe(sass())
    .pipe(minifyCSS())
    .pipe(sourcemaps.write('.'))
    .pipe(gulp.dest('dist/css'));
});

gulp.task('d', ['css'], function(){
    gulp.watch('assets/styles/*.scss', ['css']);
});