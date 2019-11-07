const gulp = require( 'gulp' );
const plumber = require( 'gulp-plumber' );
const sass = require( 'gulp-sass' );
const postcss = require( 'gulp-postcss' );
const autoprefixer = require( 'autoprefixer' );
const groupmq = require( 'gulp-group-css-media-queries' );
const sassLint = require( 'gulp-sass-lint' );
const beautify = require( 'gulp-jsbeautifier' );
const footer = require( 'gulp-footer' );

const SASS_SOURCES = [
	'./*.scss',
	'assets/styles/**/*.scss',
];

/**
 * Lints Sass.
 */
const lintSass = () => {
	return gulp.src( SASS_SOURCES )
		.pipe( plumber() )
		.pipe( sassLint() )
		.pipe( sassLint.format() );
}
exports.lintSass = lintSass;

/**
 * Watches Sass.
 */
const watchSass = () => {
	return gulp.watch( SASS_SOURCES, gulp.series( lintSass, compileSass ) );
};
exports.watchSass = watchSass;

/**
 * Compiles Sass into CSS.
 */
const compileSass = () => {
	return gulp.src( SASS_SOURCES, { base: './' } )
		.pipe( plumber() )
		.pipe( sass( {
			indentType: 'tab',
			indentWidth: 1,
			outputStyle: 'expanded',
		} ) )
		.on( 'error', sass.logError )
		.pipe( postcss( [
			autoprefixer( {
				cascade: false,
			} )
		] ) )
		.pipe( groupmq() )
		.pipe( beautify( {
			indent_size: 1,
			indent_char: '\t',
		} ) )
		.pipe( footer( '\n' ) )
		.pipe( gulp.dest( '.' ) );
};
exports.compileSass = compileSass;

/**
 * Default gulp task.
 */
exports.default = gulp.series( lintSass, compileSass );
