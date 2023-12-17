const gulp = require('gulp'),
	sass = require('gulp-sass')(require('sass')),
	autoprefixer = require('gulp-autoprefixer'),
	cleancss = require('gulp-clean-css'),
	notify = require('gulp-notify');

gulp.task('sass', function () {
	return gulp.src('css/scss/**/*.+(scss|sass)')
		.pipe(sass().on("error", notify.onError("Error: <%= error.message %>")))
		.pipe(autoprefixer({
			grid: true,
			overrideBrowserslist: ['last 10 versions']
		}))
		.pipe(gulp.dest('css'))
		.pipe(cleancss({ level: { 1: { specialComments: 0 } } }))
		.pipe(gulp.dest('css'))
});

gulp.task('sass_blocks', function () {
	return gulp.src('css/scss/blocks/**/*.+(scss|sass)')
		.pipe(sass().on("error", notify.onError("Error: <%= error.message %>")))
		.pipe(autoprefixer({
			grid: true,
			overrideBrowserslist: ['last 10 versions']
		}))
		.pipe(gulp.dest('css/blocks'))
		.pipe(cleancss({ level: { 1: { specialComments: 0 } } }))
		.pipe(gulp.dest('css/blocks'))
});

gulp.task('watch', function () {
	gulp.watch('css/scss/**/*.+(scss|sass)', gulp.parallel('sass'));
	gulp.watch('css/scss/blocks/**/*.+(scss|sass)', gulp.parallel('sass_blocks'));
});

gulp.task('default', gulp.parallel('watch'));
