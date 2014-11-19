var gulp = require('gulp'),
    plumber = require('gulp-plumber'),
    sass = require('gulp-ruby-sass'),
    autoprefixer = require('gulp-autoprefixer'),
    minifycss = require('gulp-minify-css'),
    uglify = require('gulp-uglify'),
    concat = require('gulp-concat'),
    rename = require('gulp-rename'),
    jshint = require('gulp-jshint'),
    newer = require('gulp-newer'),
    imagemin = require('gulp-imagemin'),
    livereload = require('gulp-livereload'),
    lr = require('tiny-lr'),
    server = lr();

    // CSS Task
    gulp.task('styles', function(){
    return gulp.src('scss/style.scss', {base: 'scss'})
        .pipe(plumber())
        .pipe(sass({ 
        	style: 'expanded',
            //compass: true, 
            //require: ['susy']
            }))
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

    // Scripts Task

    gulp.task('scripts', function() {
    return gulp.src('assets/js/**/*.js')
        .pipe(plumber())
        .pipe(concat('all.js'))
        .pipe(gulp.dest('assets'))
        .pipe(rename('theme.min.js'))
        .pipe(uglify())
        .pipe(gulp.dest('assets'));
    });

    // Linting our scripts

    gulp.task('lint', function() {
    return gulp.src('assets/js/**/*.js')
        .pipe(jshint())
        .pipe(jshint.reporter('default'));
    });


	// Our default Gulp task!
	gulp.task('default', ['styles', 'images', 'scripts', 'lint']);

	//Gulp watch task - runs whenever you type 'gulp watch' into the terminal
	gulp.task('watch', function() {
  	// Listen on port 35729
	  server.listen(35729, function (err) {
	      if (err) {
	        return console.log(err)
	      };

	      // Watch .scss, image, & js files
	      gulp.watch('scss/*.scss', ['styles']);
	      gulp.watch('scss/**/*.scss', ['styles']);
	      gulp.watch('assets/images/originals/**', ['images']);
          gulp.watch('assets/js/**/*.js', ['lint', 'scripts']);

	    });

	});
