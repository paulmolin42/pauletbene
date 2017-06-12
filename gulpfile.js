var gulp = require('gulp');
var plugins = require('gulp-load-plugins')();

gulp.task('styles', function(){
    gulp.src('app/Resources/assets/sass/**/*css')
        .pipe(plugins.sass())
        .pipe(plugins.concat('style.css'))
        .pipe(gulp.dest('web/css'));
});

gulp.task('scripts', function() {
    gulp.src('app/Resources/assets/js/**/*.js')
        .pipe(plugins.plumber())
        .pipe(plugins.concat('site.js'))
        .pipe(gulp.dest('web/js'));
});

gulp.task('default', ['styles', 'scripts']);