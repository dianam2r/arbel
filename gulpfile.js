var gulp = require("gulp"),
    sass = require("gulp-sass"),
    postcss = require("gulp-postcss"),
    autoprefixer = require("autoprefixer"),
    cssnano = require("cssnano"),
    sourcemaps = require("gulp-sourcemaps"),
    concat = require('gulp-concat'),
    browserSync = require("browser-sync").create();;

function style() {
    return (
        gulp
            .src("web/scss/**/*.scss")
            // Initialize sourcemaps before compilation starts
            .pipe(sourcemaps.init())
            .pipe(sass())
            .on("error", sass.logError)
            // Use postcss with autoprefixer and compress the compiled file using cssnano
            .pipe(postcss([autoprefixer(), cssnano()]))
            // Now add/write the sourcemaps
            .pipe(sourcemaps.write())
            .pipe(concat('style.css'))
            .pipe(gulp.dest("web/css"))
            .pipe(browserSync.stream())
    );
}

// Add browsersync initialization at the start of the watch task
function watch() {
    browserSync.init({
        proxy: "http://localhost/arbel/web/index.php"
    });
    gulp.watch("web/scss/**/*.scss", style);
    gulp.watch("web/css/**/*.css").on("change", browserSync.reload);
    gulp.watch("web/js/**/*.js").on("change", browserSync.reload);
}

exports.style = style;
exports.watch = watch;
