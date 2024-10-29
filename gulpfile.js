var gulp = require('gulp');
var runSequence = require('run-sequence');
var csso = require('gulp-csso');
const minify = require('gulp-minify');
const minifyCss = require('gulp-minify-css');
const rename = require('gulp-rename');

gulp.task('minify', async function () {
    gulp.src(['assets/js/fieldday.js', 'assets/js/widgets.js'])
            .pipe(minify({ext:{
                min:'.min.js'
            }}))
            .pipe(gulp.dest('assets/js'));
    
    gulp.src(['assets/css/fieldday.css', 'assets/css/widgets.css'])
        .pipe(minifyCss({compatibility: 'ie8', keepBreaks:false}))
        .pipe(rename({ suffix: '.min' }))
        .pipe(gulp.dest('assets/css'));
}); 