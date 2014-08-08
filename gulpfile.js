var gulp = require('gulp'),
    plumber = require('gulp-plumber'),
    autoprefixer = require('gulp-autoprefixer'),
    minifycss = require('gulp-minify-css'),
    newer = require('gulp-newer'),
    imagemin = require('gulp-imagemin'),
    livereload = require('gulp-livereload'),
    lr = require('tiny-lr'),
    compass = require('gulp-compass'),
    server = lr();

    // CSS Task
    gulp.task('styles', function(){
    return gulp.src('scss/style.scss', {base: 'scss'})
        .pipe(plumber())
        .pipe(compass({
		    css: 'style.css',
		    sass: 'scss/style.scss',
		    image: 'assets/images',
		    style: 'expanded',
		    comments: 'false',
		    require: ['susy', 'modular-scale'] }))
        .pipe(gulp.dest(''))
        .pipe(autoprefixer('last 2 version', 'safari 5', 'ie 8', 'ie 9', 'opera 12.1', 'ios 6', 'android 4'))
        .pipe(minifycss())
        .pipe(gulp.dest(''))
        .pipe(livereload(server));
	});

    // Images Task

	var imgSrc = 'assets/images/originals/*';
	var imgDest = 'assets/images';

	gulp.task('images', function() {
	  return gulp.src(imgSrc, {base: 'assets/images/originals'})
	        .pipe(newer(imgDest))
	        .pipe(imagemin({ optimizationLevel: 3, progressive: true, interlaced: true }))
	        .pipe(gulp.dest(imgDest));
	});

	// Our default Gulp task!
	gulp.task('default', ['styles', 'images']);

	//Gulp watch task - runs whenever you type 'gulp watch' into the terminal
	gulp.task('watch', function() {
  	// Listen on port 35729
	  server.listen(35729, function (err) {
	      if (err) {
	        return console.log(err)
	      };

	      // Watch .scss and image files
	      gulp.watch('scss/*.scss', ['styles']);
	      gulp.watch('scss/**/*.scss', ['styles']);
	      gulp.watch('assets/images/originals/**', ['images']);

	    });

	});
